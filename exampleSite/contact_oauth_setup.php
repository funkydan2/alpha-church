<?php
/**
 * One-time helper to obtain a Gmail OAuth2 refresh token for contact_mail_smtp.php
 * ('oauth2' mode). Run it from the command line on any machine with PHP and
 * the Composer dependencies installed:
 *
 *   composer require league/oauth2-google
 *   php contact_oauth_setup.php
 *
 * Do NOT upload this file to your web server.
 *
 * Before running, in the Google Cloud console (console.cloud.google.com):
 *   1. Create (or pick) a project belonging to your organisation.
 *   2. Enable the Gmail API for the project.
 *   3. Configure the OAuth consent screen with user type "Internal"
 *      (Workspace-only; internal apps' refresh tokens do not expire after
 *      7 days, unlike external apps in "Testing" mode).
 *   4. Create an OAuth client ID of type "Desktop app" and note the
 *      client ID and client secret.
 *
 * Then run this script, open the printed URL in a browser, sign in with the
 * Workspace account that should send the mail (its address must match $from
 * in contact_mail_smtp.php, or be a verified send-as alias), and consent. The
 * browser is redirected to http://localhost/... which will fail to load -
 * that's fine; copy the full URL from the address bar and paste it here.
 */

require 'vendor/autoload.php'; # adjust if your vendor dir is elsewhere

echo "OAuth client ID: ";
$client_id = trim(fgets(STDIN));
echo "OAuth client secret: ";
$client_secret = trim(fgets(STDIN));

$provider = new League\OAuth2\Client\Provider\Google([
    'clientId' => $client_id,
    'clientSecret' => $client_secret,
    'redirectUri' => 'http://localhost',
]);

# The full Gmail sending scope:
$url = $provider->getAuthorizationUrl([
    'scope' => ['https://mail.google.com/'],
    'accessType' => 'offline', # required to receive a refresh token
    'prompt' => 'consent',     # force a refresh token even on re-runs
]);

echo "\nOpen this URL in a browser and sign in with the sending account:\n\n";
echo $url . "\n\n";
echo "After consenting, paste the full http://localhost/... redirect URL\n";
echo "(or just the value of the 'code' parameter): ";
$input = trim(fgets(STDIN));

$code = $input;
if (filter_var($input, FILTER_VALIDATE_URL)) {
    parse_str((string) parse_url($input, PHP_URL_QUERY), $query);
    $code = $query['code'] ?? '';
}
if ($code === '') {
    fwrite(STDERR, "No authorization code found in input.\n");
    exit(1);
}

$token = $provider->getAccessToken('authorization_code', ['code' => $code]);
$refresh_token = $token->getRefreshToken();
if (!$refresh_token) {
    fwrite(STDERR, "Google did not return a refresh token; re-run and make sure you consent.\n");
    exit(1);
}

echo "\nSuccess! Put these values in your contact_mail_smtp.php config:\n\n";
echo "  \$smtp_mode = 'oauth2';\n";
echo "  \$oauth_client_id = '" . $client_id . "';\n";
echo "  \$oauth_client_secret = '" . $client_secret . "';\n";
echo "  \$oauth_refresh_token = '" . $refresh_token . "';\n";
echo "  \$oauth_user = '<the Workspace account you just signed in with>';\n\n";
echo "Keep them secret: store them outside the web root (see \$config_file\n";
echo "in contact_mail_smtp.php) and never commit them to git.\n";
