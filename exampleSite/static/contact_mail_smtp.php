<?php
/**
 * Optional SMTP contact form mail handler for the Alpha Church Hugo theme.
 *
 * An alternative to contact_mail.php (which uses PHP's built-in mail()):
 * sends the form through an SMTP server using PHPMailer — for example your
 * organisation's Google Workspace account, or any other SMTP provider.
 * Select which script the form posts to in hugo.toml:
 *
 *   [params.contact]
 *     service = "php"
 *     php_script = "/contact_mail_smtp.php"
 *
 * Requirements (install with Composer, ideally OUTSIDE the web root):
 *   composer require phpmailer/phpmailer
 *   composer require league/oauth2-google   # only needed for 'oauth2' mode
 *   composer require altcha-org/altcha      # only needed for the captcha
 *
 * Optional captcha: set $captcha_service = 'altcha' (and the secrets below,
 * shared with altcha_challenge.php) to require a solved ALTCHA proof-of-work
 * challenge before sending. See SETUP.md ("Captcha").
 *
 * Three authentication modes are supported (set $smtp_mode below):
 *
 *   'relay'     No SMTP authentication; the server is trusted by IP or
 *               network. For Google Workspace SMTP relay, set
 *               $smtp_host = 'smtp-relay.gmail.com' and ask a Workspace
 *               admin to allow the server's IP under Admin console > Apps >
 *               Google Workspace > Gmail > Routing > SMTP relay service.
 *               The server needs a static IP.
 *
 *   'password'  Username/password SMTP auth. Works with any provider. For
 *               Gmail/Workspace use an app password (the account needs
 *               2-Step Verification, and the Workspace admin must allow app
 *               passwords; note they are revoked when the account password
 *               changes). Google no longer accepts plain account passwords.
 *
 *   'oauth2'    XOAUTH2 with auto-refreshed tokens, using the Google provider
 *               (league/oauth2-google). Most robust long-term for Gmail.
 *               Requires a Google Cloud project and a refresh token for the
 *               sending account — see SETUP.md ("Contact Form") and the
 *               one-time helper contact_oauth_setup.php in exampleSite.
 *               For other providers, swap in the matching league/oauth2-*
 *               provider class below.
 *
 * SECURITY: keep credentials out of the web root. Put them in a separate
 * config file outside the published site (see $config_file below) rather
 * than editing them into this file, and never commit them to git.
 */

# ---- Basic settings --------------------------------------------------------

# Recipient of the mail:
$to = 'admin@example.org';
# The "From" address. With Gmail this must be the authenticated account or a
# verified "send as" alias of it, otherwise Gmail rewrites or rejects it:
$from = 'website@example.org';
$from_name = 'Website contact form';
# Subject of the mail:
$subject = 'Feedback from example.org';
# Forward users to this page when the mail is sent successfully:
$confirm_page = '/contact_thanks';
# If sending fails, forward users to:
$error_page = '/404.html';

# ---- SMTP server and authentication ----------------------------------------

# Any SMTP server; these defaults are for Gmail/Google Workspace:
$smtp_host = 'smtp.gmail.com';
$smtp_port = 587;
# 'tls' (STARTTLS), 'ssl' (implicit TLS, usually port 465), or '' for none:
$smtp_secure = 'tls';

# One of 'relay', 'password' or 'oauth2':
$smtp_mode = 'password';

# For 'password' mode:
$smtp_user = 'website@example.org';
$smtp_password = 'INSERT PASSWORD';     # for Gmail: a 16-character app password

# For 'oauth2' mode (see contact_oauth_setup.php to obtain the refresh token):
$oauth_client_id = 'INSERT CLIENT ID';
$oauth_client_secret = 'INSERT CLIENT SECRET';
$oauth_refresh_token = 'INSERT REFRESH TOKEN';
# The account the refresh token was issued for:
$oauth_user = 'website@example.org';

# ---- Captcha ---------------------------------------------------------------

# '' (disabled) or 'altcha' (self-hosted ALTCHA proof-of-work captcha):
$captcha_service = '';
# Secrets shared with altcha_challenge.php. MUST be long random strings,
# set in the external config file (see $config_file below):
$altcha_hmac_secret = '';
$altcha_key_secret = '';
# Replay-guard strictness. The single-use store is a small JSON file in the
# system temp directory. If it is unwritable:
#   false (default) - log loudly and accept the payload (the challenge
#                     signature and expiry are still enforced); keeps the
#                     form working on misconfigured hosts.
#   true            - reject the payload (fail closed).
$altcha_replay_strict = false;

# Path to Composer's autoloader (adjust to your server layout; keeping the
# vendor directory outside the web root is recommended):
$autoload_path = __DIR__ . '/vendor/autoload.php';

# Optional: load settings from a file OUTSIDE the web root. Any variable set
# there overrides the defaults above. Recommended place for credentials:
$config_file = __DIR__ . '/../contact_mail_config.php';
if (is_file($config_file)) {
    require $config_file;
}

# ---- Form handling ---------------------------------------------------------

function fail($page) {
    header('Location: ' . $page);
    exit;
}

if (!isset($_POST['send'])) {
    fail($error_page);
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

# Strip line breaks from the name and validate the address, so neither can
# be used to inject extra mail headers via Reply-To. Cap input lengths.
$name = str_replace(["\r", "\n"], '', $name);
if ($name === '' || mb_strlen($name) > 200 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254 ||
    $message === '' || mb_strlen($message) > 10000) {
    fail($error_page);
}

# Honeypot: the hidden "website" field must stay empty (bots fill it in).
if (!empty($_POST['website'])) {
    fail($error_page);
}

$body = "Name: " . $name . "\n\n"
      . "Email: " . $email . "\n\n"
      . "Message:\n" . $message . "\n";

# ---- Send ------------------------------------------------------------------

try {
    if (!is_file($autoload_path)) {
        throw new RuntimeException('Composer autoloader not found at ' . $autoload_path
            . ' - run: composer require phpmailer/phpmailer');
    }
    require $autoload_path;

    # ALTCHA captcha: verify the solved proof-of-work challenge before sending.
    if ($captcha_service === 'altcha') {
        require __DIR__ . '/altcha_verify.php';
        altcha_verify_payload($_POST['altcha'] ?? '');
    }

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->CharSet = PHPMailer\PHPMailer\PHPMailer::CHARSET_UTF8;
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPSecure = $smtp_secure;
    $mail->Timeout = 30;

    switch ($smtp_mode) {
        case 'relay':
            $mail->SMTPAuth = false;
            # Google's relay service expects a fully qualified domain name in
            # the SMTP HELO; use the sender's domain. Harmless elsewhere.
            $mail->Helo = substr(strrchr($from, '@'), 1);
            break;

        case 'password':
            $mail->SMTPAuth = true;
            $mail->Username = $smtp_user;
            $mail->Password = $smtp_password;
            break;

        case 'oauth2':
            $provider = new League\OAuth2\Client\Provider\Google([
                'clientId' => $oauth_client_id,
                'clientSecret' => $oauth_client_secret,
            ]);
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            # PHPMailer fetches and refreshes access tokens as needed:
            $mail->setOAuth(new PHPMailer\PHPMailer\OAuth([
                'provider' => $provider,
                'clientId' => $oauth_client_id,
                'clientSecret' => $oauth_client_secret,
                'refreshToken' => $oauth_refresh_token,
                'userName' => $oauth_user,
            ]));
            break;

        default:
            throw new RuntimeException('Unknown $smtp_mode: ' . $smtp_mode);
    }

    $mail->setFrom($from, $from_name);
    $mail->addAddress($to);
    # Replies go to the visitor, not to the website account:
    $mail->addReplyTo($email, $name);
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
    header('Location: ' . $confirm_page);
    exit;
} catch (Throwable $e) {
    error_log('contact_mail_smtp.php: ' . $e->getMessage());
    fail($error_page);
}
