<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Dosis', sans-serif;
        }
        .header {
            background-color: red;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 5px;
        }
        .content {
            background-color: darkgray;
            color: white;
            padding: 7px;
            text-align: center;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            gap: 40px; /* Kelimeler arasındaki boşluk */
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }
        .content2 {
            background-color: darkgray;
            color: white;
            padding: 57px;
            text-align: center;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            gap: 70px; /* Kelimeler arasındaki boşluk */
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            margin-top:3.5%;
        }
       
        .content:hover {
            background-color: gray;
        }
        .header h1 {
            margin: 0;
            font-size: 2.2em;
        }
        .content p:hover {
            color: black;
            text-shadow: 0 0 5px black; /* Siyah gölge ekleme */
        }
       
        .haber-karti {
            background-color: white;
            color: black;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            text-align: center;
            margin-bottom: 20px;
        }
        .haber-karti img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .haber-karti a {
            text-decoration: none;
            color: inherit;
        }
        .haber-karti p {
            margin: 10px 0 0 0;
        }
        .content a {
        text-decoration: none; /* Altı çiziyi kaldır */
        color: inherit; /* Bağlantı rengini miras al */
        }
        .haber-karti a:hover {
            color: blue;
            text-shadow: 0 0 5px black; /* Siyah gölge ekleme */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dünyayı Değiştiren Anket Ağı</h1>
    </div>
    <div class="content">
        <a href="anasayfa.php"><p>Ana Sayfa</p></a>
        <a href="haberler.php"><p>Haberler</p></a>
        <a href="anketler.php"><p>Anketler</p></a>
        <a href="gorus-ve-oneriler.php"><p>Görüş ve Öneriler</p></a>
        <a href="giris-yap.php"><p>Giriş Yap</p></a>
    </div>
    <div class="content2">
    <?php
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
        $sql = "SELECT haberid, haberbaslik, haberfoto FROM haberler";
        $result = $conn->query($sql);
        $photoFolder = "foto/";
        $photoFiles = glob($photoFolder . "*");
        $photoIndex = 0; // Fotoğraf indeksini başlat
       
        if ($result->num_rows > 0) {
            // Her bir satır için verileri diziye ekle
            while($row = $result->fetch_assoc()) {
                $haberId = $row["haberid"];
                $haberBaslik = $row["haberbaslik"];
                $haberFoto = $row["haberfoto"]; // Veritabanındaki haberfoto alanını kullan

                echo '<div class="haber-karti">';
                echo '<a href='' . $haberId . '">';
                if ($haberFoto && file_exists($photoFolder . $haberFoto)) {
                    echo '<img src="' . $photoFolder . $haberFoto . '" alt="' . $haberBaslik . '">';
                } else if ($photoIndex < count($photoFiles)) {
                    $photoFile = $photoFiles[$photoIndex];
                    echo '<img src="' . $photoFile . '" alt="' . $haberBaslik . '">';
                    $photoIndex++; // Fotoğraf indeksini arttır
                }
                echo '<p>' . $haberBaslik . '</p>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "0 sonuç";
        }
        // Veritabanı bağlantısını kapat
        $conn->close();
    ?>
    </div>
</body>
</html>