<?php
# Edit the following 5 variables to fit your needs!

# Recipient of the Mail:
$to = "admin@example.org";
# The "from" address of the Mail. This should match the domain of the server:
$from = "website@example.org";
# Forward Users to this Page if the mail is successfully sent:
$confirm_page = "/contact_thanks";
# If something goes wrong and sending the mail fails, forward users to:
$error_page = "/404.html";
# Specify the Subject of the Mail:
$subject = "Feedback from example.org";

# ---- Optional captcha (ALTCHA) ---------------------------------------------
# The simple mail() path needs no dependencies by default. To enable the
# captcha, install altcha-org/altcha with Composer, keep altcha_verify.php
# next to this script, and set the secrets in the config file below.
# Without the library the captcha fails closed (submissions are rejected).

# '' (disabled) or 'altcha':
$captcha_service = '';
# Secrets shared with altcha_challenge.php. MUST be long random strings,
# set in the external config file (see $config_file below):
$altcha_hmac_secret = '';
$altcha_key_secret = '';
# Replay-guard strictness when its store is unwritable: false (default)
# accepts with a loud log (signature/expiry still enforced); true rejects.
$altcha_replay_strict = false;
# Path to Composer's autoloader (only needed when the captcha is enabled):
$autoload_path = __DIR__ . '/vendor/autoload.php';

# Optional: load settings from a file OUTSIDE the web root. Any variable set
# there overrides the defaults above (the same file the other contact-form
# scripts load). Recommended place for the captcha secrets:
$config_file = __DIR__ . '/../contact_mail_config.php';
if (is_file($config_file)) {
    require $config_file;
}


if (isset($_POST['send'])) {
    # Honeypot: the hidden "website" field must stay empty (bots fill it in).
    if (!empty($_POST['website'])) {
        header("Location: ".$error_page);
        exit;
    }

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    # Strip line breaks from the name and validate the address, so neither
    # can be used to inject extra mail headers via Reply-To. Cap input lengths.
    $name = str_replace(["\r", "\n"], '', $name);
    if ($name !== '' && mb_strlen($name) <= 200 &&
        filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) <= 254 &&
        $message !== '' && mb_strlen($message) <= 10000) {

        # ALTCHA captcha: verify the solved proof-of-work challenge before
        # sending. Fails closed if the library or the payload is missing.
        if ($captcha_service === 'altcha') {
            if (!is_file($autoload_path)) {
                error_log('contact_mail.php: Composer autoloader not found at ' . $autoload_path . ' - the captcha requires altcha-org/altcha');
                header("Location: ".$error_page);
                exit;
            }
            require $autoload_path;
            require __DIR__ . '/altcha_verify.php';
            try {
                altcha_verify_payload($_POST['altcha'] ?? '');
            } catch (Throwable $e) {
                error_log('contact_mail.php: ' . $e->getMessage());
                header("Location: ".$error_page);
                exit;
            }
        }

        $body = "Name: " . $name . "\n\n"
              . "Email: " . $email . "\n\n"
              . "Message:\n" . $message . "\n";

        # Replies go to the visitor (the validated address), not to the
        # website account.
        $headers = "From: " . $from . "\r\n"
                 . "Reply-To: " . $email . "\r\n"
                 . "Content-Type: text/plain; charset=utf-8\r\n";

        if (mail($to, $subject, $body, $headers)) {
            header("Location: ".$confirm_page);
            exit;
        }
    }
}
header("Location: ".$error_page);
exit;
