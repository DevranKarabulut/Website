<?php
session_start();
include("baglanti.php");

// Anket silme işlemi
if (isset($_GET['anket_sil'])) {
    $anketid = $_GET['anket_sil'];

    // Öncelikle anket ile ilişkili seçenekleri sil
    $query = "DELETE FROM anket_secenekleri WHERE anketid = $anketid";
    if ($baglanti->query($query) === TRUE) {
        // Sonra anketi sil
        $query = "DELETE FROM anketler WHERE anketid = $anketid";
        if ($baglanti->query($query) === TRUE) {
            echo "Anket ve ilgili seçenekler başarıyla silindi!";
        } else {
            echo "Hata: " . $baglanti->error;
        }
    } else {
        echo "Hata: " . $baglanti->error;
    }
}

// Anket ekleme işlemi
if (isset($_POST['anket_ekle'])) {
    $anketadi = $_POST['anketadi'];

    $query = "INSERT INTO anketler (anketadi) VALUES ('$anketadi')";
    if ($baglanti->query($query) === TRUE) {
        echo "Yeni anket başarıyla eklendi!";
    } else {
        echo "Hata: " . $baglanti->error;
    }
}

// Anket güncelleme işlemi
if (isset($_POST['anket_guncelle'])) {
    $anketid = $_POST['anketid'];
    $anketadi = $_POST['anketadi'];

    $query = "UPDATE anketler SET anketadi='$anketadi' WHERE anketid=$anketid";
    if ($baglanti->query($query) === TRUE) {
        echo "Anket başarıyla güncellendi!";
    } else {
        echo "Hata: " . $baglanti->error;
    }
}

// Seçenek ekleme işlemi
if (isset($_POST['secenek_ekle'])) {
    $anketid = $_POST['anketid'];
    $secenek = $_POST['secenek'];

    $query = "INSERT INTO anket_secenekleri (anketid, secenek) VALUES ($anketid, '$secenek')";
    if ($baglanti->query($query) === TRUE) {
        echo "Yeni seçenek başarıyla eklendi!";
    } else {
        echo "Hata: " . $baglanti->error;
    }
}

// Seçenek güncelleme işlemi
if (isset($_POST['secenek_guncelle'])) {
    $secenekid = $_POST['secenekid'];
    $secenek = $_POST['secenek'];

    $query = "UPDATE anket_secenekleri SET secenek='$secenek' WHERE secenekid=$secenekid";
    if ($baglanti->query($query) === TRUE) {
        echo "Seçenek başarıyla güncellendi!";
    } else {
        echo "Hata: " . $baglanti->error;
    }
}

// Anketleri listeleme
$anketler_query = "SELECT * FROM anketler";
$anketler_result = $baglanti->query($anketler_query);

// Anket seçeneklerini listeleme
$secenekler_query = "SELECT * FROM anket_secenekleri";
$secenekler_result = $baglanti->query($secenekler_query);
?>

<!doctype html>
<html>
<head>
    <title>Anket Yönetim Sayfası</title>
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
        a {
            color: blue;
            text-decoration: none;
        }
        form {
            margin-top: 20px;
        }
        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Anket Yönetim Sayfası</h1>

    <h2>Mevcut Anketler</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Anket Adı</th>
            <th>Katılma Sayısı</th>
            <th>En Çok Tıklanan Anket ID</th>
            <th>İşlemler</th>
        </tr>
        <?php
        if ($anketler_result->num_rows > 0) {
            while($row = $anketler_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['anketid']}</td>
                        <td>{$row['anketadi']}</td>
                        <td>{$row['katilmasayisi']}</td>
                        <td>{$row['en_cok_tiklanan_anket_id']}</td>
                        <td>
                            <a href=''anketid']}'>Güncelle</a> |
                            <a href=''anketid']}'>Sil</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Hiç anket bulunamadı</td></tr>";
        }
        ?>
    </table>

    <h2>Yeni Anket Ekle</h2>
    <form method="POST" action="">
        <input type="text" name="anketadi" placeholder="Anket Adı" required>
        <button type="submit" name="anket_ekle">Ekle</button>
    </form>

    <?php
    // Anket güncelleme formu
    if (isset($_GET['anket_guncelle'])) {
        $anketid = $_GET['anket_guncelle'];
        $query = "SELECT * FROM anketler WHERE anketid = $anketid";
        $result = $baglanti->query($query);
        $anket = $result->fetch_assoc();
    ?>
    <h2>Anket Güncelle</h2>
    <form method="POST" action="">
        <input type="hidden" name="anketid" value="<?php echo $anket['anketid']; ?>">
        <input type="text" name="anketadi" value="<?php echo $anket['anketadi']; ?>" required>
        <button type="submit" name="anket_guncelle">Güncelle</button>
    </form>
    <?php
    }
    ?>

    <h2>Mevcut Anket Seçenekleri</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Anket ID</th>
            <th>Seçenek</th>
            <th>Oy Sayısı</th>
            <th>İşlemler</th>
        </tr>
        <?php
        if ($secenekler_result->num_rows > 0) {
            while($row = $secenekler_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['secenekid']}</td>
                        <td>{$row['anketid']}</td>
                        <td>{$row['secenek']}</td>
                        <td>{$row['oy_sayisi']}</td>
                        <td>
                            <a href=''secenekid']}'>Güncelle</a> |
                            <a href=''secenekid']}'>Sil</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Hiç seçenek bulunamadı</td></tr>";
        }
        ?>
    </table>

    <h2>Yeni Seçenek Ekle</h2>
    <form method="POST" action="">
        <select name="anketid" required>
            <option value="">Anket Seçin</option>
            <?php
            $anketler_result->data_seek(0); // Sonuç kümesini başa sarar
            while ($row = $anketler_result->fetch_assoc()) {
                echo "<option value='{$row['anketid']}'>{$row['anketadi']}</option>";
            }
            ?>
        </select>
        <input type="text" name="secenek" placeholder="Seçenek" required>
        <button type="submit" name="secenek_ekle">Ekle</button>
    </form>

    <?php
    // Seçenek güncelleme formu
    if (isset($_GET['secenek_guncelle'])) {
        $secenekid = $_GET['secenek_guncelle'];
        $query = "SELECT * FROM anket_secenekleri WHERE secenekid = $secenekid";
        $result = $baglanti->query($query);
        $secenek = $result->fetch_assoc();
    ?>
    <h2>Seçenek Güncelle</h2>
    <form method="POST" action="">
        <input type="hidden" name="secenekid" value="<?php echo $secenek['secenekid']; ?>">
        <input type="text" name="secenek" value="<?php echo $secenek['secenek']; ?>" required>
        <button type="submit" name="secenek_guncelle">Güncelle</button>
    </form>
    <?php
    }
    ?>
</body>
</html>