<?php
session_start();
include("baglanti.php");

// Haber silme işlemi
if (isset($_GET['sil'])) {
    $haberid = $_GET['sil'];
    $query = "DELETE FROM haberler WHERE haberid = $haberid";
    if ($baglanti->query($query) === TRUE) {
        echo "Haber başarıyla silindi!";
    } else {
        echo "Hata: " . $baglanti->error;
    }
}

// Haberleri listeleme
$query = "SELECT * FROM haberler";
$result = $baglanti->query($query);
?>

<!doctype html>
<html>
<head>
    <title>Haber Silme Sayfası</title>
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
        a.delete {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Haber Silme Sayfası</h1>
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
                        <td><a class='delete' href=''haberid']}'>Sil</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Hiç haber bulunamadı</td></tr>";
        }
        ?>
    </table>
</body>
</html>