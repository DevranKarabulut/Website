<?php
session_start();
include("baglanti.php");

// Haber güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['haberid'])) {
    $haberid = $_POST['haberid'];
    $haberbaslik = $_POST['haberbaslik'];
    $haberdetay = $_POST['haberdetay'];

    $query = "UPDATE haberler SET haberbaslik = '$haberbaslik', haberdetay = '$haberdetay' WHERE haberid = $haberid";
    if ($baglanti->query($query) === TRUE) {
        echo "Haber başarıyla güncellendi!";
    } else {
        echo "Hata: " . $baglanti->error;
    }
}

// Güncelleme formunu gösterme
if (isset($_GET['guncelle'])) {
    $haberid = $_GET['guncelle'];
    $query = "SELECT * FROM haberler WHERE haberid = $haberid";
    $result = $baglanti->query($query);
    $haber = $result->fetch_assoc();
?>
<!doctype html>
<html>
<head>
    <title>Haber Güncelle</title>
    <meta charset="utf-8" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Haber Güncelle</h1>
    <form method="POST" action="">
        <input type="hidden" name="haberid" value="<?php echo $haber['haberid']; ?>">
        <label for="haberbaslik">Başlık</label>
        <input type="text" id="haberbaslik" name="haberbaslik" value="<?php echo $haber['haberbaslik']; ?>" required>
        <label for="haberdetay">Detay</label>
        <textarea id="haberdetay" name="haberdetay" required><?php echo $haber['haberdetay']; ?></textarea>
        <button type="submit">Güncelle</button>
    </form>
</body>
</html>
<?php
    exit();
}

// Haberleri listeleme
$query = "SELECT * FROM haberler";
$result = $baglanti->query($query);
?>

<!doctype html>
<html>
<head>
    <title>Haber Güncelleme Sayfası</title>
    <meta charset="utf-8" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a.update {
            color: blue;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Haber Güncelleme Sayfası</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Başlık</th>
            <th>Detay</th>
            <th>Fotoğraf</th>
            <th>Okunma Sayısı</th>
            <th>İşlemler</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['haberid']}</td>
                        <td>{$row['haberbaslik']}</td>
                        <td>{$row['haberdetay']}</td>
                        <td>{$row['haberfoto']}</td>
                        <td>{$row['okunma_sayisi']}</td>
                        <td><a class='update' href=''haberid']}'>Güncelle</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Hiç haber bulunamadı</td></tr>";
        }
        ?>
    </table>
</body>
</html>