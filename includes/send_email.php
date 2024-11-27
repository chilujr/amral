<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer (assumes Composer or manual inclusion)
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $name = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // PHPMailer settings
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'chilujr99@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'oiyh ujub aeom mrcd';   // Replace with your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom($email, $name); // Sender's email and name
        $mail->addAddress('chilujr99@gmail.com', 'Your Name'); // Replace with recipient's email and name
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = "Contact Form: $subject";
        $mail->Body = "You have received a new message:\n\nName: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

        // Send email
        $mail->send();
        echo "Thank you for your message! We will get back to you shortly.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
