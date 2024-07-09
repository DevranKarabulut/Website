<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anket Ekle</title>
</head>
<body>
    <form action="veriekle.php" method="post">
        <label for="anketadi">Anket Adı:</label>
        <input type="text" id="anketadi" name="anketadi" required><br>
       
        <label for="secenek1">Seçenek 1:</label>
        <input type="text" id="secenek1" name="secenekler[]" required><br>

        <label for="secenek2">Seçenek 2:</label>
        <input type="text" id="secenek2" name="secenekler[]" required><br>

        <label for="secenek3">Seçenek 3:</label>
        <input type="text" id="secenek3" name="secenekler[]" required><br>
       
        <input type="submit" value="Anket Ekle">
    </form>
</body>
</html>