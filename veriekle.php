<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "haanketsitesi";

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Formdan gelen verileri al
$anketadi = $_POST['anketadi'];
$secenekler = $_POST['secenekler'];

// En az üç seçenek olup olmadığını kontrol et
if (count($secenekler) >= 3) {
    // Anketi ekle
    $sql = "INSERT INTO anketler (anketadi) VALUES ('$anketadi')";
    if ($conn->query($sql) === TRUE) {
        $anketid = $conn->insert_id; // Eklenen anketin ID'sini al
       
        // Seçenekleri ekle
        foreach ($secenekler as $secenek) {
            $sql = "INSERT INTO anket_secenekleri (anketid, secenek) VALUES ('$anketid', '$secenek')";
            $conn->query($sql);
        }
       
        echo "Yeni anket başarıyla eklendi!";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "En az üç seçenek eklemelisiniz.";
}

// Bağlantıyı kapat
$conn->close();
?>