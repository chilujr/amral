<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $name = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Invalid email format. Please enter a valid email.');
            window.location.href = '../index.html#contact';
        </script>";
        exit;
    }

    // Setup PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'amraln.co@gmail.com'; // Your Gmail address
        $mail->Password = 'zzan zuxw rxyi xyvr'; // Your App Password (Replace with a secure method)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('amraln.co@gmail.com'); // Receiving email
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h3>New Contact Form Message</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        ";

        // Send email
        $mail->send();

        // Success response
        echo "<script>
            alert('Thank you for your message! We will get back to you shortly.');
            window.location.href = '../index.html#contact';
        </script>";
    } catch (Exception $e) {
        // Error response
        echo "<script>
            alert('Message could not be sent. Please try again later.');
            window.location.href = '../index.html#contact';
        </script>";
    }
} else {
    echo "Invalid request method.";
}
?>
