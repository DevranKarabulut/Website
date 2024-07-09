<!doctype html>
<html>
    <head>
        <title>Sitemiz</title>
        <meta charset="utf-8" />
        <style type="text/css">
            body{
                background:#76b852;
                font-size:15px;
                font-family: 'Dosis', sans-serif;
            }
            #kayitFormu{
               
                border-radius:10px;
                background:#ffffff;
                width:360px;
                margin:auto;
                margin-top:20px;
                padding:15px;
                text-align:center;
            }
            input, button
            {
                border-radius:5px;
                border:none;
                width:300px;
                height:50px;
                margin:20px 0px 20px 0px;
                background:rgba(240,240,240,.5);
                padding-left:15px;
                font-style:italic;
               
            }
           
            .btn{
                background:#76b852;
                color:white;
            }
            h3{
                color:#333;
                text-transform:uppercase;
                font-size:20px;
            }
           
        </style>
    </head>
    <body>
        <?php
        if(empty($_GET["id"]))
            $gid="unuttum";
        else
          $gid=$_GET["unuttum"];

        if($gid=="giris")
        {
         
        }
        else if($gid=="unuttum")
        {
            echo '<div id="kayitFormu">
         <form action="unuttum.php" method="POST">
             <h3>Admin Giriş Paneli</h3>
             <input type="email" name="eposta" placeholder="Eposta giriniz" required />                
             <input class="btn" type="submit" value="Unuttum" />
         </form>            
         </div>';
        }
        ?>      
               
    </body>
</html>