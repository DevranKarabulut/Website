<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "haanketSitesi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST["baslik"];
    $icerik = $_POST["icerik"];

    $sql = "INSERT INTO kampanyalar (baslik, icerik) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $baslik, $icerik);

    if ($stmt->execute()) {
        echo "Kampanya başarıyla eklendi!";
    } else {
        echo "Hata: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>