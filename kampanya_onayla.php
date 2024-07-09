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

// Kampanya ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["baslik"]) && isset($_POST["icerik"])) {
    $baslik = $_POST["baslik"];
    $icerik = $_POST["icerik"];

    $sql = "INSERT INTO kampanyalar (baslik, icerik, onay_durumu) VALUES (?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $baslik, $icerik);

    if ($stmt->execute()) {
        $mesaj = "Kampanya başarıyla eklendi!";
    } else {
        $mesaj = "Hata: " . $stmt->error;
    }

    $stmt->close();
}

// Kampanya onaylama veya reddetme işlemi
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'onayla') {
        $sql = "UPDATE kampanyalar SET onay_durumu = 1 WHERE id = ?";
    } else if ($action == 'reddet') {
        $sql = "DELETE FROM kampanyalar WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($action == 'onayla') {
            $mesaj = "Kampanya başarıyla onaylandı!";
        } else if ($action == 'reddet') {
            $mesaj = "Kampanya başarıyla reddedildi!";
        }
    } else {
        $mesaj = "Hata: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampanya Yönetimi</title>
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
        .form-container, .campaigns-container {
            background-color: lightgray;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-container h2, .campaigns-container h2 {
            margin-top: 0;
            text-align: center;
        }
        .form-container form, .campaigns-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'Dosis', sans-serif;
            font-size: 1em;
        }
        .form-container button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: blue;
            color: white;
            cursor: pointer;
            font-family: 'Dosis', sans-serif;
            font-size: 1em;
        }
        .form-container button:hover {
            background-color: darkblue;
        }
        .campaign-card {
            background-color: white;
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
        <div class="form-container">
            <h2>Kampanya Başlat</h2>
            <?php if (isset($mesaj)) echo "<p>$mesaj</p>"; ?>
            <form method="POST">
                <label for="baslik">Başlık:</label>
                <input type="text" id="baslik" name="baslik" required>
                <label for="icerik">İçerik:</label>
                <textarea id="icerik" name="icerik" rows="5" required></textarea>
                <button type="submit">Gönder</button>
            </form>
        </div>
        <div class="campaigns-container">
            <h2>Onay Bekleyen Kampanyalar</h2>
            <?php
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
                    echo '<button onclick="islemYap(' . $id . ', \'onayla\')">Onayla</button>';
                    echo '<button class="reject" onclick="islemYap(' . $id . ', \'reddet\')">Reddet</button>';
                    echo '</div>';
                }
            } else {
                echo "<p>Onay bekleyen kampanya yok.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <script>
        function islemYap(id, action) {
            if (confirm("Bu kampanyayı " + (action == 'onayla' ? "onaylamak" : "reddetmek") + " istediğinize emin misiniz?")) {
                window.location.href = "?id=" + id + "&action=" + action;
            }
        }
    </script>
</body>
</html>