<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haber Detay</title>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Dosis', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .header {
            background-color: red;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 5px;
            width: 100%;
        }
        .content {
            background-color: darkgray;
            color: white;
            padding: 7px;
            text-align: center;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            gap: 40px;
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
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
            text-shadow: 0 0 5px black;
        }
        .content a {
            text-decoration: none;
            color: inherit;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
            max-width: 1000px;
            margin: 20px auto;
        }
        .haber-detay {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-bottom: 20px;
        }
        .yorum-form {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-bottom: 20px;
        }
        .yorum-listesi {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-bottom: 20px;
        }
        .yorum-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .yorum-item:last-child {
            border-bottom: none;
        }
        .haber-detay img {
            max-width: 5%; /* Fotoğrafın en fazla %5 genişlikte olmasını sağlar */
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .foto-mg img{
            max-width: 5%; /* Fotoğrafın en fazla %5 genişlikte olmasını sağlar */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Haber Detay</h1>
    </div>
    <div class="content">
        <a href="anasayfa.php"><p>Ana Sayfa</p></a>
        <a href="haberler.php"><p>Haberler</p></a>
        <a href="anketler.php"><p>Anketler</p></a>
        <a href="kampanyalar.php"><p>Kampanyalarr</p></a>
    </div>
    <div class="container">
        <div class="haber-detay">
            <?php
            // Veritabanı bağlantısını yap
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

            // haberid'yi al
            $haberid = $_GET['haberid'];

            // Haber detaylarını al
            $sql = "SELECT * FROM haberler WHERE haberid = $haberid";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   
                    echo "<h2>" . $row["haberbaslik"] . "</h2>";
                    echo "<p>" . $row["haberdetay"] . "</p>";
                    if ($row["haberfoto"] && file_exists("foto/" . $row["haberfoto"])) {
                        echo "<div class=foto-mg>";
                        echo '<img src="foto/' . $row["haberfoto"] . '" alt="" style="width:25%;max-width:300px;">';
                        echo "</div>";
                    }
                }
            } else {
                echo "Haber bulunamadı.";
            }

            // Veritabanı bağlantısını kapat
            $conn->close();
            ?>
        </div>
        <div class="yorum-form">
            <h2>Yorum Yap</h2>
            <form action="haberdetay.php?haberid=<?php echo $haberid; ?>" method="post">
                <textarea name="yorum" placeholder="Yorumunuzu yazın" required></textarea><br><br>
                <input type="submit" name="yorum_gonder" value="Gönder">
            </form>
        </div>
        <div class="yorum-listesi">
            <h2>Yorumlar</h2>
            <?php
            // Veritabanına tekrar bağlan
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Bağlantıyı kontrol et
            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }

            // Yorumları al
            $sql = "SELECT * FROM yorumlar WHERE haberid = $haberid ORDER BY tarih DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="yorum-item">';
                    echo "<p><strong>Kullanıcı</strong> (" . $row["tarih"] . ")</p>";
                    echo "<p>" . $row["yorum"] . "</p>";
                    echo '</div>';
                }
            } else {
                echo "Yorum bulunamadı.";
            }

            // Veritabanı bağlantısını kapat
            $conn->close();
            ?>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["yorum_gonder"])) {
        // Veritabanına tekrar bağlan
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol et
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        // Form verilerini al
        $yorum = $conn->real_escape_string($_POST["yorum"]);

        // Yorum ekle
        $sql = "INSERT INTO yorumlar (haberid, kullanici_adi, yorum) VALUES ('$haberid', 'Kullanıcı', '$yorum')";

        if ($conn->query($sql) === TRUE) {
            echo "Yorum başarıyla eklendi.";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        // Veritabanı bağlantısını kapat
        $conn->close();

        // Yorum gönderildikten sonra sayfayı yeniden yükle
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>
</body>
</html>