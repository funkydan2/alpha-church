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
    $message = "Name: " . $_POST['name'] . "\r\n\r\n";
    $message .= "Email: " . $_POST['email'] . "\r\n\r\n";
    $message .= "Message: " . $_POST['message'] . "\r\n\r\n";

    $headers = "From: " . $from . "\r\n";
    $headers .= "Content-Type: text/plain; charset: utf-8";
    $email_ok = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($email_ok) {
        $headers .= "\r\nReply-To: $email";
    }
    
    $success = mail($to, $subject, $message, $headers);
    
    if (isset($success) && $success){
        header("Location: ".$confirm_page);
        exit;
    }
} 
header("Location: ".$error_page);
exit;
?>