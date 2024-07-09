<!doctype html>
<html>
    <head>
        <title>Sitemiz</title>
        <meta charset="utf-8" />
        <style type="text/css">
            body {
                background: #76b852;
                font-size: 15px;
                font-family: 'Dosis', sans-serif;
            }
            #kayitFormu {
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
                margin: 20px 0;
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
        <?php
        if (empty($_GET["id"]))
            $gid = "giris";
        else
            $gid = $_GET["id"];

        if ($gid == "giris") {
            echo '<div id="kayitFormu">
            <form action="admingiris.php" method="POST">
                <h3>Giriş Formu</h3>
                <input type="email" name="eposta" placeholder="Eposta giriniz" required />
                <input type="password" name="parola" placeholder="Şifrenizi giriniz" required pattern="[0-9a-zA-Z]{5}" />
                <input class="btn" type="submit" value="GİRİŞ" />
            </form>
            <p class="mesaj">Şifreni mi unuttun ? <a href=''>tıkla</a></p>
            </div>';
        }
        ?>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $eposta = $_POST['eposta'];
            $parola = $_POST['parola'];

            // Example validation (replace with your own validation logic)
            if ($eposta == 'admin@example.com' && $parola == 'admin') {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['eposta'] = $eposta;
                header("Location: adminana2.php");
                exit();
            } else {
                echo '<p>Geçersiz eposta veya şifre!</p>';
            }
        }
        ?>
    </body>
</html>