<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampanya Onayı</title>
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
        .container {
            width: 80%;
            max-width: 800px;
            margin-top: 50px;
        }
        .campaign-card {
            background-color: lightgray;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .campaign-card h3 {
            margin-top: 0;
        }
        .campaign-card button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: green;
            color: white;
            cursor: pointer;
            font-family: 'Dosis', sans-serif;
            font-size: 1em;
        }
        .campaign-card button.reject {
            background-color: red;
        }
        .campaign-card button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Onay Bekleyen Kampanyalar</h2>
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

        // Onay bekleyen kampanyaları getir
        $sql = "SELECT id, baslik, icerik FROM kampanyalar WHERE onay_durumu = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $baslik = $row["baslik"];
                $icerik = $row["icerik"];

                echo '<div class="campaign-card">';
                echo '<h3>' . $baslik . '</h3>';
                echo '<p>' . $icerik . '</p>';
                echo '<button onclick="onaylaKampanya(' . $id . ')">Onayla</button>';
                echo '<button class="reject" onclick="reddetKampanya(' . $id . ')">Reddet</button>';
                echo '</div>';
            }
        } else {
            echo "<p>Onay bekleyen kampanya yok.</p>";
        }

        $conn->close();
        ?>
    </div>
    <script>
        function onaylaKampanya(id) {
            if (confirm("Bu kampanyayı onaylamak istediğinize emin misiniz?")) {
                window.location.href = "kampanya_onayla.php?id=" + id + "&action=onayla";
            }
        }

        function reddetKampanya(id) {
            if (confirm("Bu kampanyayı reddetmek istediğinize emin misiniz?")) {
                window.location.href = "kampanya_onayla.php?id=" + id + "&action=reddet";
            }
        }
    </script>
</body>
</html>