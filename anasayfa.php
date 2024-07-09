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
            display: flex;
            flex-direction: column;
            align-items: center;
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
            gap: 40px; /* Kelimeler arasındaki boşluk */
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
            text-shadow: 0 0 5px black; /* Siyah gölge ekleme */
        }
        .content a {
            text-decoration: none; /* Altı çiziyi kaldır */
            color: inherit; /* Bağlantı rengini miras al */
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
            max-width: 1000px;
            margin: 20px auto;
        }
        .section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            overflow: hidden;
            position: relative;
            width: 100%;
            margin-bottom: 40px;
        }
        .wrapper {
            display: flex;
            transition: transform 0.3s ease;
        }
        .card {
            background-color: white;
            color: black;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 10px;
            width: 200px; /* Her kartın genişliği */
            flex: 0 0 200px; /* Kartların esnemesini engeller */
        }
        .card img {
            width: 100%; /* Resmin genişliğini %100 yapar */
            height: auto; /* Orantılı olarak yüksekliği ayarlar */
            max-width: 100%; /* Resmin maksimum genişliğini ayarlar */
            border-radius: 10px;
        }
        .nav-button {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        .nav-button.left {
            left: 7%; /* Sol ok düğmesinin sol kenara olan uzaklığı 20px */
        }
        .nav-button.right {
            right: 7%; /* Sağ ok düğmesinin sağ kenara olan uzaklığı 20px */
        }
        .sidebar {
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 50%;
            right: 1%;
            transform: translateY(-50%);
            gap: 20px;
        }
        .sidebar-item {
            background-color: white;
            color: black;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
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
        <a href="kampanyalar.php"><p>Kampanya Başlat</p></a>
        <a href="admingiris.php"><p>Giriş Yap</p></a>
    </div>
    <div class="container">
        <!-- Haberler Bölümü -->
        <div class="section">
            <button class="nav-button left" onclick="rotateLeft('haberler')">&lt;</button>
            <div class="wrapper" id="haberler">
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
                $sql = "SELECT haberid, haberbaslik, haberfoto FROM haberler ORDER BY haberid";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $haberId = $row["haberid"];
                        $haberBaslik = $row["haberbaslik"];
                        $haberFoto = $row["haberfoto"];
                
                        echo '<div class="card">';
                        echo '<a href="' . $haberId . '">';
                        if ($haberFoto && file_exists("foto/" . $haberFoto)) {
                            echo '<img src="foto/' . $haberFoto . '" alt="">';
                        }
                        echo '<h3>' . $haberBaslik . '</h3>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "Hiç haber bulunamadı.";
                }
                

                // Veritabanı bağlantısını kapat
                $conn->close();
                ?>
            </div>
            <button class="nav-button right" onclick="rotateRight('haberler')">&gt;</button>
        </div>
        <!-- Anketler Bölümü -->
        <div class="section">
            <button class="nav-button left" onclick="rotateLeft('anketler')">&lt;</button>
            <div class="wrapper" id="anketler">
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
                $sql = "SELECT anketid, anketadi, katilmasayisi FROM anketler ORDER BY anketid";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $anketId = $row["anketid"];
                        $anketAdi = $row["anketadi"];
                        $katilmaSayisi = $row["katilmasayisi"];
                        
                        echo '<div class="card anket-karti">';
                        echo '<a href="' . $anketId . '">';
                        echo '<h2>' . $anketAdi . '</h2>';
                        echo '</a>';
                        echo '<p>Katılma Sayısı: ' . $katilmaSayisi . '</p>';
                        
                        // Anketin seçeneklerini al
                        $sqlSecenekler = "SELECT secenek FROM anket_secenekleri WHERE anketid = '$anketId'";
                        $resultSecenekler = $conn->query($sqlSecenekler);

                        if ($resultSecenekler->num_rows > 0) {
                            echo '<ul>';
                            while($rowSecenek = $resultSecenekler->fetch_assoc()) {
                                $secenek = $rowSecenek["secenek"];
                                echo '<li>' . $secenek . '</li>';
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
            <button class="nav-button right" onclick="rotateRight('anketler')">&gt;</button>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- En Çok Okunan Haber -->
        <div class="sidebar-item">
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
            $sql = "SELECT haberid, haberbaslik, okunma_sayisi FROM haberler ORDER BY okunma_sayisi DESC LIMIT 1";
            $result = $conn->query($sql);
           
            if ($result->num_rows > 0) {
                echo '<h2>En Çok Okunan Haber</h2>'; // Başlığı döngü dışında yazdık
                while($row = $result->fetch_assoc()) {
                    $haberId = $row["haberid"];
                    $haberBaslik = $row["haberbaslik"];
                    $okunmaSayisi = $row["okunma_sayisi"];
                    
                    echo '<a href="haber.php?id=' . $haberId . '">'; 
                    echo '<p>Haber Başlığı: ' . $haberBaslik . '</p>';
                    echo '</a>';
                    echo '<p>Okunma Sayısı: ' . $okunmaSayisi . '</p>';
                }
            } else {
                echo '<p>Hiç haber bulunamadı.</p>';
            }
            

            // Veritabanı bağlantısını kapat
            $conn->close();
            ?>
        </div>
        <!-- En Çok Tıklanan Anket -->
        <div class="sidebar-item">
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
            $sql = "SELECT anketid, anketadi, katilmasayisi FROM anketler ORDER BY katilmasayisi DESC LIMIT 1";
            $result = $conn->query($sql);
           
            if ($result->num_rows > 0) {
                echo '<h2>En Çok Tıklanan Anket</h2>'; // Başlığı döngü dışında yazdık
                while($row = $result->fetch_assoc()) {
                    $anketId = $row["anketid"];
                    $anketAdi = $row["anketadi"];
                    $katilmaSayisi = $row["katilmasayisi"];
                    
                    echo '<a href="anket.php?id=' . $anketId . '">'; // Tek tırnakları çift tırnak ile değiştirdik
                    echo '<p>Anket Adı: ' . $anketAdi . '</p>';
                    echo '</a>';
                    echo '<p>Katılma Sayısı: ' . $katilmaSayisi . '</p>';
                }
            } else {
                echo '<p>Hiç anket bulunamadı.</p>';
            }
            

            // Veritabanı bağlantısını kapat
            $conn->close();
            ?>
        </div>
        <!-- Onaylanmış Kampanyalar -->
        <div class="sidebar-item">
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

            // Onaylanmış kampanyaları getir
            $sql = "SELECT id, baslik, icerik FROM kampanyalar WHERE onay_durumu = 1";
            $result = $conn->query($sql);

            echo '<h2>Onaylanmış Kampanyalar</h2>';

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $kampanyaBaslik = $row["baslik"];
                    $kampanyaIcerik = $row["icerik"];

                    echo '<div>';
                    echo '<h3>' . $kampanyaBaslik . '</h3>';
                    echo '<p>' . $kampanyaIcerik . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>Onaylanmış kampanya yok.</p>";
            }

            // Veritabanı bağlantısını kapat
            $conn->close();
            ?>
        </div>
    </div>
    <script>
        function rotateLeft(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollBy({ left: -200, behavior: 'smooth' });
        }

        function rotateRight(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollBy({ left: 200, behavior: 'smooth' });
        }
    </script>
</body>
</html>