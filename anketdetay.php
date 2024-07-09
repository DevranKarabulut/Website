<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anket Detayı</title>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Dosis', sans-serif;
        }
        .header {
            background-color: red;
            color: white;
            padding: 1px;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 20px;
        }
        .anket-detay {
            background-color: darkgray;
            color: white;
            padding: 20px;
            border-radius: 20px;
            width: 80%;
            max-width: 500px; /* Daraltılmış maksimum genişlik */
            margin: 0 auto;
            overflow: hidden; /* İçerik taşmasını engelleme */
            text-align: center; /* İçeriği merkeze hizala */
            margin-top: 2%;
        }
        .anket-detay h2, .anket-detay p {
            text-align: left; /* Metni sol tarafa hizala */
        }
        .anket-detay ul {
            list-style-type: none; /* Liste işaretlerini kaldır */
            padding: 0;
        }
        .anket-detay li {
            background-color: white;
            color: black;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            text-align: left; /* Metni sol tarafa hizala */
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
            max-width: 600px;
            margin: 0 auto;
        }
        .content:hover {
            background-color: gray;
        }
        .content p:hover {
            color: black;
            text-shadow: 0 0 5px black; /* Siyah gölge ekleme */
        }
        .content a {
            text-decoration: none; /* Altı çiziyi kaldır */
            color: inherit; /* Bağlantı rengini miras al */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Anket Detayı</h1>
    </div>
    <div class="content">
        <a href="anasayfa.php"><p>Ana Sayfa</p></a>
        <a href="haberler.php"><p>Haberler</p></a>
        <a href="anketler.php"><p>Anketler</p></a>
        <a href="kampanyalar.php"><p>Kampanyalar</p></a>
    </div>
    <div class="anket-detay">
        <?php
        // Veritabanı bağlantı bilgileri
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

        // Anket ID'sini al
        $anketId = $_GET['anketid'];

        // Ankete tıklanma sayısını artır
        if (isset($anketId)) {
            $sql = "UPDATE anketler SET katilmasayisi = katilmasayisi + 1 WHERE anketid = $anketId";
            $conn->query($sql);
        }

        // Oy gönderildiğinde çalışacak kod
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $secenekId = $_POST['secenek'];
            $sql = "UPDATE anket_secenekleri SET oy_sayisi = oy_sayisi + 1 WHERE secenekid = $secenekId";
            $conn->query($sql);
        }

        // Anket detaylarını al
        $sql = "SELECT anketid, anketadi, katilmasayisi FROM anketler WHERE anketid = $anketId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Anket bilgilerini al
            while($row = $result->fetch_assoc()) {
                $anketAdi = $row["anketadi"];
                $katilmaSayisi = $row["katilmasayisi"];
                echo '<h2>' . $anketAdi . '</h2>';
                echo '<p>Katilma Sayisi: ' . $katilmaSayisi . '</p>';
            }
        } else {
            echo "Anket bulunamadı.";
        }

        // Anket seçeneklerini al
        $sqlSecenekler = "SELECT secenekid, secenek, oy_sayisi FROM anket_secenekleri WHERE anketid = $anketId";
        $resultSecenekler = $conn->query($sqlSecenekler);

        if ($resultSecenekler->num_rows > 0) {
            echo '<form method="post" action="">';
            echo '<h3>Seçenekler:</h3>';
            echo '<ul>';
            while($rowSecenek = $resultSecenekler->fetch_assoc()) {
                echo '<li>';
                echo '<input type="radio" id="secenek' . $rowSecenek["secenekid"] . '" name="secenek" value="' . $rowSecenek["secenekid"] . '">';
                echo '<label for="secenek' . $rowSecenek["secenekid"] . '">' . $rowSecenek["secenek"] . ' (' . $rowSecenek["oy_sayisi"] . ' oy)</label>';
                echo '</li>';
            }
            echo '</ul>';
            echo '<button type="submit">Oy Ver</button>';
            echo '</form>';
        } else {
            echo '<p>Bu anket için seçenek bulunamadı.</p>';
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
        ?>
    </div>
</body>
</html>