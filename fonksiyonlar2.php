<?php
include("baglanti.php");

function guncelleformu(){
    echo
    '<div id="kayitFormu" align="center">
        <form action="admin_ana2.php?id=guncellenecek&gid='.$_SESSION["id"].'" method="POST">
            <h3>Güncelleme Formu</h3>
            <input type="text" name="ad" placeholder="'.$_SESSION["ad"].'"  maxlength="6"  />
            <br><input type="text" name="soyad" placeholder="'.$_SESSION["soyad"].'"  maxlength="25"  />                
            <br><input type="email" name="eposta" placeholder="'.$_SESSION["mail"].'" />                
            <br><input class="btn" type="submit" value="GÜNCELLE" />
        </form>            
     </div>';
}

function guncelle(){
    global $baglanti;

    $ad = !empty($_POST["ad"]) ? $_POST["ad"] : $_SESSION['ad'];
    $soyad = !empty($_POST["soyad"]) ? $_POST["soyad"] : $_SESSION['soyad'];
    $mail = !empty($_POST["eposta"]) ? $_POST["eposta"] : $_SESSION['mail'];
    $id = $_GET["gid"];

    $query = "UPDATE kullanici SET ad = '$ad', soyad = '$soyad', email = '$mail' WHERE id = '$id'";
    $insert_row = $baglanti->query($query);

    if ($insert_row) {
        $_SESSION['id'] = $id;
        $_SESSION['ad'] = $ad;
        $_SESSION['mail'] = $mail;
        $_SESSION['soyad'] = $soyad;
        // header("Refresh:2;url=index1.php");
    } else {
        echo 'güncelleme başarısız';
        header("Refresh:3;admin_ana2.php?id=guncelle");
    }
}

function kategoricek(){
    global $baglanti;
    $query = "SELECT * FROM kategoriler";
    $result = mysqli_query($baglanti, $query) or die(mysqli_error($baglanti));

    echo '<div class="bolum2">';
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $kategori = $row['kategori'];
        $resim = $row['resim'];
        $link = "haberekle.php?gid=$id"; // Varsayılan bağlantı
        $counter = 0;

        // Eğer haber varsa, id'ye göre bağlantıyı güncelle
        if ($id == 1) {
            $link = "haberekle.php?gid=$id";
        } elseif ($id  == 2) {
            $link = "habersil.php?gid=$id";
        } else {
            $link = "haberguncelle.php?gid=$id";
        }

        echo '<div class="kutu">
        <a href="'.$link.'">
            <img src="foto/'.$resim.'" width="150" height="150">
            <h3>'.$kategori.'</h3></a>
        </div>';              
    }
    echo '</div>';
}

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
                echo '<form method="post" action="admin_ana2.php?id=yorumlar">';
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
?>