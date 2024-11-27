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
        echo "Invalid email format";
        exit;
    }

    // Setup PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chilujr99@gmail.com';
        $mail->Password = 'oiyh ujub aeom mrcd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('chilujr99@gmail.com');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(false);
        $mail->Subject = "$subject";
        $mail->Body = "You have received a new message:\n\nName: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

        $mail->send();

        // JavaScript to show pop-up and redirect back to the contact section
        echo "<script>
            alert('Thank you for your message! We will get back to you shortly.');
            window.location.href = '../index.html#contact';
        </script>";
    } catch (Exception $e) {
        // In case of error
        echo "<script>
            alert('Message could not be sent. Please try again later.');
            window.location.href = '../index.html#contact';
        </script>";
    }
} else {
    echo "Invalid request method.";
}
?>
