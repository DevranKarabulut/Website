window.onload = function() {
    var haberListesiDiv = document.getElementById("haber-listesi");

    // Sunucuya istek yaparak fotoğraf yollarını al
    fetch('fotogorcwez.php')
        .then(response => response.json())
        .then(data => {
            // Her bir fotoğraf için bir kart oluştur
            data.forEach(photoPath => {
                var fotoDiv = document.createElement("div");
                fotoDiv.classList.add("foto-karti");

                var fotoElement = document.createElement("img");
                fotoElement.src = photoPath;

                fotoDiv.appendChild(fotoElement);

                haberListesiDiv.appendChild(fotoDiv);
            });
        })
        .catch(error => console.error('Hata:', error));
};

function anketTikla(anketId) {
    // AJAX isteği oluştur
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "anketTiklamaIslemi.php?anketid=" + anketId, true);
    xhr.send();
}