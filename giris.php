<!doctype html>
<html>
<head>
    <title>Giriş Sayfası</title>
    <meta charset="utf-8" />
    <style type="text/css">
        body {
            background: #76b852;
            font-size: 15px;
            font-family: 'Dosis', sans-serif;
            margin: 0;
            padding: 0;
        }

        #kayitFormu {
            border-radius: 10px;
            background: #ffffff;
            width: 360px;
            margin: 100px auto;
            padding: 15px;
            text-align: center;
        }

        input,
        button {
            border-radius: 5px;
            border: none;
            width: 300px;
            height: 50px;
            margin: 20px 0px;
            background: rgba(240, 240, 240, .5);
            padding-left: 15px;
            font-style: italic;
        }

        .btn {
            background: #76b852;
            color: white;
            cursor: pointer;
        }

        h3 {
            color: #333;
            text-transform: uppercase;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .mesaj {
            font-size: 14px;
            color: #555;
        }

        .mesaj a {
            color: #76b852;
            text-decoration: none;
        }

        .mesaj a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    if (empty($_GET["id"]))
        $gid = "giris";
    else
        $gid = $_GET["id"];

    if ($gid == "giris") {
        // giriş formu  
        echo '<div id="kayitFormu">
        <form action="anasayfa.php" method="POST">
            <h3>Giriş Formu</h3>
            <input type="email" name="eposta" placeholder="Eposta giriniz" required />
            <br>
            <input class="btn" type="submit" value="GİRİŞ YAP" />
        </form>            
        <p class="mesaj">Şifreni mi unuttun ? <a href=''>Tıkla</a></p>
        </div>';
    } else if ($gid == "kayit") {
        //kayit  
        echo '<div id="kayitFormu">
        <form action="kayit.php" method="POST">
            <h3>Kullanıcı Kayıt Formu</h3>
            <input type="email" name="eposta" placeholder="Eposta giriniz" required />
            <br>
            <input class="btn" type="submit" value="KAYIT OL" />
        </form>            
        <p class="mesaj">Zaten üye misin ? <a href=''>Giriş Yap</a></p>
        </div>';
    } else if ($gid == "unuttum") {
        //şifremi unuttum
        echo '<div id="kayitFormu">
        <form action="unuttum.php" method="POST">
            <h3>Şifremi Unuttum</h3>
            <input type="email" name="eposta" placeholder="Eposta giriniz" required />
            <br>
            <input class="btn" type="submit" value="GÖNDER" />
        </form>            
        <p class="mesaj">Üye olmak için ? <a href=''>Kayıt Ol</a></p>
        </div>';
    }
    ?>
</body>
</html>