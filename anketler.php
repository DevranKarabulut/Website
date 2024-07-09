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
            max-width: 450px;
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
       
        .content a {
        text-decoration: none; /* Altı çiziyi kaldır */
        color: inherit; /* Bağlantı rengini miras al */
        }
        .content p:hover {
            color: black;
            text-shadow: 0 0 5px black; /* Siyah gölge ekleme */
        }
        .content3 p{
            text-align:center;
            margin: 0;
        }
        .anket-karti {
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
        .content a {
        text-decoration: none; /* Altı çiziyi kaldır */
        color: inherit; /* Bağlantı rengini miras al */
        }
        .anket-karti {
            background-color: white;
            color: black;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            text-align: left;
            width: 100%;
        }
        .anket-karti h2 {
            margin-top: 0;
        }
        .anket-karti p {
            margin: 5px 0;
        }
        .gorun {
            display: inline-block; /* İçeriğin bir arada kalmasını sağlar */
            text-align:center;
        }
        .gorun p{
            max-height: 200px; /* İçeriğin maksimum yüksekliğini ayarlar */
            overflow-y: auto; /* Dikey kaydırma çubuğunu görünür yapar */
            margin-bottom: 10px; /* Alt kenara biraz boşluk ekler */
            text-align:center;
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
    <div class="gorun">
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
        $sql = "SELECT anketid, anketadi, katilmasayisi FROM anketler";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Her bir anket için verileri ekle
            while($row = $result->fetch_assoc()) {
                $anketId = $row["anketid"];
                $anketAdi = $row["anketadi"];
                $katilmaSayisi = $row["katilmasayisi"];
               
                echo '<div class="anket-karti">';
                echo '<a href='' . $anketId . '">';
                echo '<h2>' . $anketAdi . '</h2>';
                echo '</a>';
                echo '<p>Katılma Sayısı: ' . $katilmaSayisi . '</p>';
               
                // Anketin seçeneklerini al
                $sqlSecenekler = "SELECT secenek FROM anket_secenekleri WHERE anketid = '$anketId'";
                $resultSecenekler = $conn->query($sqlSecenekler);

                if ($resultSecenekler->num_rows > 0) {
                    echo '<p>Seçenekler:</p>';
                    echo '<ul>';
                    while($rowSecenek = $resultSecenekler->fetch_assoc()) {
                        echo '<li>' . $rowSecenek["secenek"] . '</li>';
                    }
                    echo '</ul>';
                }
               
                echo '</div>';
            }
        } else {
            echo "0 sonuç";
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
    ?>
    </div>
    </div>
</body>
</html>