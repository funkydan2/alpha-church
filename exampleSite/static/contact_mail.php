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


if (isset($_POST['send'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    # Strip line breaks from the name and validate the address, so neither
    # can be used to inject extra mail headers via Reply-To. Cap input lengths.
    $name = str_replace(["\r", "\n"], '', $name);
    if ($name !== '' && mb_strlen($name) <= 200 &&
        filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) <= 254 &&
        $message !== '' && mb_strlen($message) <= 10000) {

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
