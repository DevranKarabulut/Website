<?php
session_start();
include("fonksiyonlar2.php");

// Veritabanı bağlantısını içe aktar
include("baglanti.php");
if (isset($_GET["id"]) && $_GET["id"] == "anketler") {
    header("refresh:1;url=admin_anket.php");
}
// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    
    // "haber_id" formdan gelip gelmediğini kontrol et
    $haber_id = isset($_POST['haber_id']) ? $_POST['haber_id'] : 0;

    // Fotoğraf yükleme işlemi
    $target_dir = "foto/";
    $target_file = $target_dir . basename($_FILES["resim"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Dosya tipi kontrolü
    $check = getimagesize($_FILES["resim"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Dosya bir resim değil.";
        $uploadOk = 0;
    }

    // Dosya zaten varsa
    if (file_exists($target_file)) {
        echo "Üzgünüz, dosya zaten mevcut.";
        $uploadOk = 0;
    }

    // Dosya boyutu kontrolü
    if ($_FILES["resim"]["size"] > 500000) {
        echo "Üzgünüz, dosya boyutu çok büyük.";
        $uploadOk = 0;
    }

    // Belirli dosya formatlarına izin ver
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Üzgünüz, sadece JPG, JPEG, PNG ve GIF dosyalarına izin verilmektedir.";
        $uploadOk = 0;
    }

    // $uploadOk değişkeni 0'a ayarlandıysa, dosya yüklenmedi
    if ($uploadOk == 0) {
        echo "Üzgünüz, dosyanız yüklenmedi.";
    // Her şey yolundaysa, dosyayı yükle
    } else {
        if (move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file)) {
            echo "Dosya ". htmlspecialchars(basename($_FILES["resim"]["name"])) . " başarıyla yüklendi.";
            
            // Veritabanına kaydetme işlemi
            $resim = basename($_FILES["resim"]["name"]);
            $query = "INSERT INTO haberler (haberbaslik, haberdetay, haberfoto, haber_id) VALUES ('$baslik', '$icerik', '$resim', '$haber_id')";
            $result = mysqli_query($baglanti, $query);
        
            if ($result) {
                echo "Haber başarıyla eklendi!";
            } else {
                echo "Hata: " . mysqli_error($baglanti);
            }
        }

         else {
            echo "Üzgünüz, dosya yüklenirken bir hata oluştu.";
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Site Ana sayfa</title>
    <meta charset="utf-8" />
    <style type="text/css">
        body {
            background: #76b852;
            font-size: 10px;
            font-family: Trebuchet MS;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 200px;
        }
        header .logo {
            text-align: center;
            color: #76b852;
            margin: 0px 0px 10px 10px;
        }
        header .logo h1 {
            font-size: 2rem;
            letter-spacing: .7rem;
        }
        header .logo h2 {
            font-size: 1rem;
            letter-spacing: .5rem;
        }
        header .logo h1::first-letter {
            color: #FCB941;
        } 
        header .logo h1:hover::first-letter {
            background-color: #FCB941;
            color: #25373D;
        } 
        .logo h2 {
            font-size: 2.4rem;
        }
        .menu ul {
            display: flex;
        }
        .menu ul li {
            margin: 0 1rem;
        }
        .menu ul a {
            color: #FCB941;
            text-decoration: none;
            font-size: 1.2rem;
            padding: 0 2rem;
        }
        .menu ul a:hover {
            color: #76b852;
        }                
        .layout-wrapper1 {
            width: 1170px;
            max-width: 100%;
            margin: 0 auto;
            padding: 15px;
        }     
        .layout-wrapper1 header, .layout-wrapper1 footer, .layout-wrapper1 .main-content, .layout-wrapper1 .sidebar {
            position: relative;
            background-color: #ffffff;
            margin-bottom: 10px;
            border-radius: 10px;
        } 
        .layout-wrapper1 header, .layout-wrapper1 footer {
            min-height: 100px;
            clear: both;
            width: 100%;
            flex-wrap: wrap;
        } 
        .layout-wrapper1 .sidebar {
            width: 250px;
            float: left;
            min-height: 450px;
            padding: 10px;
            font-size: 14px;
            color: #222;
            font-weight: 600;
            text-decoration: none;   
        } 
        .layout-wrapper1 .main-content {
            width: calc(100% - 300px);
            margin-left: 10px;
            float: left;
            min-height: 450px;
            padding: 10px;
            font-size: 14px;
            color: #222;
            font-weight: 600;
            text-decoration: none; 
        } 
        @media only screen and (max-width: 768px) {
            .layout-wrapper1 .main-content, .layout-wrapper1 .sidebar {
                width: 100%;
                float: none;
                min-height: 300px;
                padding: 0;
                margin-left: 0;
            }
        }
        #guncelFormu {
            border-radius: 10px;
            background: #ffffff;
            width: 360px;
            margin: auto;
            margin-top: 20px;
            padding: 15px;
            text-align: center;
        }
        input, button {
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
        .sidebar {
            align-content: stretch;
        }
        .bolum2 {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            text-align: center;
        }
        .bolum2 .kutu {
            flex-basis: 290px;
        }
        .bolum2 .kutu h2 {
            font-size: 2rem;
        }
        a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="layout-wrapper1">
        <header class="layout-header" data-title="#header">
            <div class="logo">
                <h1>D D A S</h1>
                <h2>Admin Paneli</h2>
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

        <div class="sidebar" data-title="#sidebar">
            <?php
            echo "Hoşgeldiniz Admin!<br><br>";
            echo 'Profil Bilgilerim <a href="admin_ana2.php?id=guncelle">Güncelle</a><br>';
            echo "<br>Çıkış için <a href='cikis.php'>tıklayınız</a>";
            ?>
        </div>       
        <div class="main-content" data-title="#main-content">
            <?php
            if (isset($_GET["id"])) {
                $gid = $_GET["id"];
                if ($gid == "guncelle") {
                    guncelleformu();
                } else if ($gid == "guncellenecek") {
                    guncelle();
                } else if ($gid == "haberler") {
                    kategoricek();
                } else if ($gid == "anketler") {
                    anketgetir();
                } else if ($gid == "yorumlar") {
                    yorumal();
                }
            }
            ?>
        </div>
        <footer class="layout-footer" data-title="#footer"></footer>
    </div>         
</body>
</html>