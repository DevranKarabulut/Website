<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampanya Başlat</title>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Dosis', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .form-container {
            background-color: lightgray;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
            margin-top: 50px;
        }
        .form-container h2 {
            margin-top: 0;
            text-align: center;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'Dosis', sans-serif;
            font-size: 1em;
        }
        .form-container button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: blue;
            color: white;
            cursor: pointer;
            font-family: 'Dosis', sans-serif;
            font-size: 1em;
        }
        .form-container button:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Kampanya Başlat</h2>
        <form action="kampanyaekle.php" method="POST">
            <label for="baslik">Başlık:</label>
            <input type="text" id="baslik" name="baslik" required>
            <label for="icerik">İçerik:</label>
            <textarea id="icerik" name="icerik" rows="5" required></textarea>
            <button type="submit">Gönder</button>
        </form>
    </div>
</body>
</html>