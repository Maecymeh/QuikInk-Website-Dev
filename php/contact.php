<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

$config = require __DIR__ . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            // SMTP config
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['email'];
            $mail->Password   = $config['app_password'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            
            $mail->setFrom($config['email'], 'QuikInk Website');
            $mail->addReplyTo($email, $name);
            $mail->addAddress($config['email']);

            $mail->Subject = "Tattoo Inquiry from $name";
            $mail->isHTML(true);
            $mail->Body = '
            <div style="font-family:Segoe UI, Tahoma, sans-serif; background-color:#111; color:#fff; padding:20px; border-radius:10px; max-width:600px; margin:auto;">
                <div style="text-align:center; margin-bottom:20px;">
                    <img src="https://yourdomain.com/images/logo.png" alt="QuikInk Tattoo Logo" style="max-height:70px;">
                    <h2 style="margin-top:10px; color:#fff;">New Tattoo Inquiry</h2>
                </div>
                <p><strong style="color:#ccc;">Name:</strong> ' . $name . '</p>
                <p><strong style="color:#ccc;">Email:</strong> ' . $email . '</p>
                <p><strong style="color:#ccc;">Message:</strong></p>
                <div style="background-color:#222; padding:15px; border-radius:5px; margin:10px 0; color:#ccc;">' . nl2br($message) . '</div>
                <p style="margin-top:20px; font-size:0.85rem; color:#777;">This message was sent from the <strong style="color:#aaa;">QuikInk Tattoo</strong> website.</p>
            </div>';

            // Optional Image Attachment
            if (isset($_FILES['tattooImage']) && $_FILES['tattooImage']['error'] === UPLOAD_ERR_OK) {
                $uploadPath = $_FILES['tattooImage']['tmp_name'];
                $uploadName = $_FILES['tattooImage']['name'];
                $mail->addAttachment($uploadPath, $uploadName);
            }

            $mail->send();

            // Auto-Reply to Client
            $confirmation = new PHPMailer(true);
            $confirmation->isSMTP();
            $confirmation->Host       = 'smtp.gmail.com';
            $confirmation->SMTPAuth   = true;
            $confirmation->Username   = $config['email'];
            $confirmation->Password   = $config['app_password'];
            $confirmation->SMTPSecure = 'tls';
            $confirmation->Port       = 587;

            $confirmation->setFrom($config['email'], 'QuikInk Tattoo');
            $confirmation->addAddress($email, $name);
            $confirmation->Subject = 'Thank you for your inquiry!';
            $confirmation->isHTML(true);
            $confirmation->Body = '
            <div style="font-family:Segoe UI, Tahoma, sans-serif; background:#111; color:#fff; padding:20px; border-radius:10px; max-width:600px; margin:auto;">
                <div style="text-align:center;">
                    <img src="images/logo-hero.png" alt="QuikInk Logo" style="max-height:60px; margin-bottom:15px;">
                    <h2 style="color:#fff;">Thanks for reaching out!</h2>
                </div>
                <p>Hi ' . $name . ',</p>
                <p>We’ve received your inquiry and will get back to you shortly. If it\'s urgent, feel free to message us on Instagram:</p>
                <p style="margin: 10px 0;">
                    <a href="https://www.instagram.com/quik.ink.tattoo/" target="_blank" style="color:#00bcd4; text-decoration:none;">@quik.ink.tattoo</a>
                </p>
                <p style="margin-top:30px; font-size:0.9rem; color:#888;">— QuikInk Tattoo</p>
            </div>';
            $confirmation->send();

            header("Location: ../contact.html?status=success");
            exit();
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Invalid input.";
    }
}
?>