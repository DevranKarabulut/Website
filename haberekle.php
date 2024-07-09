<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");


// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];

    // Veritabanına kaydetme işlemi
    $query = "INSERT INTO haberler (haberbaslik, haberdetay) VALUES ('$baslik', '$icerik')";
    $result = mysqli_query($baglanti, $query);
   
    if ($result) {
        echo "Haber başarıyla eklendi!";
    } else {
        echo "Hata: " . mysqli_error($baglanti);
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Haber Ekle</title>
    <meta charset="utf-8" />
    <style>
        body {
            background: #76b852;
            font-family: Trebuchet MS;
        }
        #haberEkleForm {
            border-radius: 10px;
            background: #ffffff;
            width: 360px;
            margin: auto;
            margin-top: 20px;
            padding: 15px;
            text-align: center;
        }
        input, textarea, button {
            border-radius: 5px;
            border: none;
            width: 300px;
            height: 50px;
            margin: 5px 0px 5px 0px;
            background: rgba(240,240,240,.5);
            padding-left: 15px;
            font-style: italic;
        }            
        .btn {
            background: #76b852;
            color: white;
        }
        h3 {
            color: #333;
            text-transform: uppercase;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div id="haberEkleForm">
        <h3>Haber Ekle</h3>
        <form action="haberekle.php" method="post">
            <input type="text" name="baslik" placeholder="Haber Başlığı" required>
            <textarea name="icerik" placeholder="Haber İçeriği" required></textarea>
            <button type="submit" class="btn">Haber Ekle</button>
        </form>
    </div>
</body>
</html>