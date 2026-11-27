<?php
/**
 * ALTCHA challenge endpoint for the Alpha Church Hugo theme's contact form.
 *
 * The ALTCHA widget (served on the contact form) fetches a fresh, signed
 * proof-of-work challenge from this script before the form can be submitted.
 * contact_mail_smtp.php verifies the solved challenge with the same secrets.
 *
 * Requirements:
 *   composer require altcha-org/altcha
 *
 * SECURITY: $altcha_hmac_secret MUST be set to a long random string, kept
 * outside the web root. Put it in the shared config file (see $config_file
 * below), e.g.:
 *
 *   <?php // contact_mail_config.php (outside the web root!)
 *   $altcha_hmac_secret = '<output of: php -r "echo bin2hex(random_bytes(32));">';
 *   $altcha_key_secret  = '<another random string, optional but recommended>';
 *
 * The same secrets must be used by contact_mail_smtp.php (both scripts load the
 * same config file by default).
 */

# REQUIRED: random secret used to sign challenges (see above):
$altcha_hmac_secret = '';
# Optional second secret enabling the fast verification path:
$altcha_key_secret = '';

# Proof-of-work difficulty (PBKDF2 iterations) and solution search range.
# Higher = more work for the visitor's browser (and for bots).
$altcha_cost = 5000;
$altcha_counter_min = 5000;
$altcha_counter_max = 10000;
# Challenge lifetime in seconds:
$altcha_ttl = 300;

# Path to Composer's autoloader (adjust to your server layout):
$autoload_path = __DIR__ . '/vendor/autoload.php';

# Optional: shared settings file OUTSIDE the web root (same file as
# contact_mail_smtp.php). Any variable set there overrides the defaults above.
$config_file = __DIR__ . '/../contact_mail_config.php';
if (is_file($config_file)) {
    require $config_file;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
    http_response_code(405);
    header('Allow: GET');
    exit;
}

if ($altcha_hmac_secret === '') {
    error_log('altcha_challenge.php: $altcha_hmac_secret is not configured');
    http_response_code(500);
    exit;
}

try {
    if (!is_file($autoload_path)) {
        throw new RuntimeException('Composer autoloader not found at ' . $autoload_path
            . ' - run: composer require altcha-org/altcha');
    }
    require $autoload_path;

    $altcha = new AltchaOrg\Altcha\Altcha(
        hmacSignatureSecret: $altcha_hmac_secret,
        hmacKeySignatureSecret: $altcha_key_secret !== '' ? $altcha_key_secret : null,
    );
    $challenge = $altcha->createChallenge(new AltchaOrg\Altcha\CreateChallengeOptions(
        algorithm: new AltchaOrg\Altcha\Algorithm\Pbkdf2(),
        cost: (int) $altcha_cost,
        counter: random_int((int) $altcha_counter_min, (int) $altcha_counter_max),
        expiresAt: time() + (int) $altcha_ttl,
    ));

    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo $challenge->toJson();
} catch (Throwable $e) {
    error_log('altcha_challenge.php: ' . $e->getMessage());
    http_response_code(500);
}
