<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorumları Yönet</title>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Dosis', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .layout-wrapper1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        .layout-header, .layout-footer {
            width: 100%;
            background-color: green;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .layout-header .logo {
            margin-bottom: 10px;
        }
        .layout-header .menu ul {
            list-style-type: none;
            padding: 0;
        }
        .layout-header .menu ul li {
            display: inline;
            margin-right: 10px;
        }
        .layout-header .menu ul li a {
            color: white;
            text-decoration: none;
        }
        .sidebar {
            background-color: #f4f4f4;
            padding: 20px;
            width: 200px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .yorum-item:last-child {
            border-bottom: none;
        }
        .delete-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="layout-wrapper1">
        <header class="layout-header" data-title="#header">
            <div class="logo">
                <h1>D D A S</h1>
                <h2>Yorum Paneli</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="admin_ana2.php">Ana Sayfa</a></li>
                    <li><a href="admin_ana2.php?id=haberler">Haberler</a></li>
                    <li><a href="admin_ana2.php?id=anketler">Anketler</a></li>
                    <li><a href="yorumlar.php">Yorumlar</a></li>
                    <li><a href="admin_ana2.php?id=kampanyalar">Kampanyalar</a></li>
                </ul>
            </div>    
        </header>
     
        <div class="main-content" data-title="#main-content">
            <?php
            function yorumal() {
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

                // Yorumları al
                $sql = "SELECT * FROM yorumlar ORDER BY tarih DESC";
                $result = $conn->query($sql);

                echo '<div class="yorum-listesi">';
                echo '<h2>Yorumlar</h2>';

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="yorum-item">';
                        echo "<div>";
                        echo "<p><strong>" . htmlspecialchars($row["kullanici_adi"]) . "</strong> (" . $row["tarih"] . ")</p>";
                        echo "<p>" . htmlspecialchars($row["yorum"]) . "</p>";
                        echo "</div>";
                        echo '<form method="post" action="yorumlar.php">';
                        echo '<input type="hidden" name="yorumid" value="' . $row["yorumid"] . '">';
                        echo '<button type="submit" name="delete" class="delete-button">Sil</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "Yorum bulunamadı.";
                }

                echo '</div>';

                // Veritabanı bağlantısını kapat
                $conn->close();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
                // Veritabanına tekrar bağlan
                $conn = new mysqli("localhost", "root", "", "haanketsitesi");

                // Bağlantıyı kontrol et
                if ($conn->connect_error) {
                    die("Bağlantı hatası: " . $conn->connect_error);
                }

                // Yorum id'sini al
                $yorumid = intval($_POST["yorumid"]);

                // Yorum sil
                $sql = "DELETE FROM yorumlar WHERE yorumid = $yorumid";

                if ($conn->query($sql) === TRUE) {
                    echo "Yorum başarıyla silindi.";
                } else {
                    echo "Hata: " . $conn->error;
                }

                // Veritabanı bağlantısını kapat
                $conn->close();

                // Yorum silindikten sonra sayfayı yeniden yükle
                echo "<meta http-equiv='refresh' content='0'>";
            }

            yorumal();
            ?>
        </div>
    </div>
</body>
</html>