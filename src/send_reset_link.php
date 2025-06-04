<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php'; // atau sesuaikan jika manual include

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

    include 'koneksi.php';
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Simpan token ke DB
    $stmt = $conn->prepare("INSERT INTO reset_tokens (email, token, expires_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $token, $expires);
    $stmt->execute();

    // Kirim email menggunakan PHPMailer
    $reset_link = "http://herokost.my.id//reset_password.php?token=$token";

    $mail = new PHPMailer(true);
    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // contoh: smtp.gmail.com
        $mail->SMTPAuth = true;
        $mail->Username = 'ahadiromadhoni@gmail.com'; // Ganti
        $mail->Password = 'vaji goem ddyg nexm'; // Ganti (gunakan App Password, bukan password Gmail biasa)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Pengirim dan penerima
        $mail->setFrom('ahadiromadhoni@gmail.com', 'Kost Hero');
        $mail->addAddress($email);

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password Kost Hero';
        $mail->Body = "Klik link berikut untuk reset password Anda:<br><a href=\"$reset_link\">$reset_link</a><br><br>Jika tidak bisa diklik, salin dan tempel link ini di browser Anda:<br>$reset_link";
        $mail->AltBody = "Klik link ini untuk reset password Anda: $reset_link";

        $mail->send();
        header("Location: login_sebagai.php");
        exit;
    } catch (Exception $e) {
        echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
        header("Location: login_sebagai.php");
        exit;
    }

    $conn->close();
}
?>
