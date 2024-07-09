<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Veritabanı bağlantısını yap
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "haanketSitesi";

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Verileri al
$gemail = $_POST['eposta'];

$query = "SELECT * FROM kullanici WHERE mail='$gemail'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if ($num_row >= 1) {
    $gideceksifre = $row['sifre'];

    $mail = new PHPMailer();
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'efekunduz180@gmail.com'; // Gmail adresinizi buraya girin
        $mail->Password = 'xtll scwl crct xixx'; // Gmail şifrenizi buraya girin
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('', 'Your Name'); // Gönderen e-posta adresi ve adı
        $mail->addAddress($gemail); // Alıcının e-posta adresi

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Hatirlatma Maili';
        $mail->Body = 'Şifreniz: ' . $gideceksifre;

        $mail->send();
        echo 'Gönderildi';
    } catch (Exception $e) {
        echo 'Gönderilemedi. Mailer Error: ' . $mail->ErrorInfo;
    }
} else {
    echo 'Bu e-posta adresiyle kayıtlı kullanıcı bulunamadı.';
}

$conn->close();
?>