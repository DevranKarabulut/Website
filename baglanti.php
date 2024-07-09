<?php
$servername = "localhost";  // Veritabanı sunucusunun adresi
$username = "root";         // Veritabanı kullanıcı adı (XAMPP varsayılan olarak 'root' kullanır)
$password = "";             // Veritabanı şifresi (XAMPP varsayılan olarak boş bırakılır)
$dbname = "anketsecenekleri"; // Veritabanı adı (kendi veritabanı adınızı buraya yazın)

// Veritabanına bağlantı oluştur
$baglanti = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

// Türkçe karakter sorununu önlemek için
$baglanti->set_charset("utf8");

?>
