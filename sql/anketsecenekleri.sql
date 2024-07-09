anket_secenekleri.sql


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2024, 15:34:59
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Veritabanı: `haanketsitesi`
--
 
-- --------------------------------------------------------
 
--
-- Tablo için tablo yapısı `anket_secenekleri`
--
 
CREATE TABLE `anket_secenekleri` (
  `secenekid` int(11) NOT NULL,
  `anketid` int(11) DEFAULT NULL,
  `secenek` text DEFAULT NULL,
  `oy_sayisi` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 
--
-- Tablo döküm verisi `anket_secenekleri`
--
 
INSERT INTO `anket_secenekleri` (`secenekid`, `anketid`, `secenek`, `oy_sayisi`) VALUES
(1, 1, 'Mansur Yavaş', 0),
(2, 1, 'Ümit Özdağ', 0),
(3, 1, 'PiRo', 0),
(4, 2, 'Renault Kadjar (2.el 90000)', 1),
(5, 2, 'Renault Clio (0)', 6),
(6, 2, 'Hyundai i20 (0)', 0),
(7, 3, 'Adana', 0),
(8, 3, 'Çanakkale', 0),
(9, 3, 'Samsun', 0),
(10, 4, 'Demir Mavisi', 0),
(11, 4, 'Turuncu', 0),
(12, 4, 'Metalik Gri', 0),
(13, 5, 'Demir Mavisi', 0),
(14, 5, 'Turuncu', 0),
(15, 5, 'Metalik Gri', 0),
(16, 6, 'Demir Mavisi', 0),
(17, 6, 'Turuncu', 0),
(18, 6, 'Metalik Gri', 0);
 
--
-- Dökümü yapılmış tablolar için indeksler
--
 
--
-- Tablo için indeksler `anket_secenekleri`
--
ALTER TABLE `anket_secenekleri`
  ADD PRIMARY KEY (`secenekid`),
  ADD KEY `anketid` (`anketid`);
 
--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--
 
--
-- Tablo için AUTO_INCREMENT değeri `anket_secenekleri`
--
ALTER TABLE `anket_secenekleri`
  MODIFY `secenekid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
 
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--
 
--
-- Tablo kısıtlamaları `anket_secenekleri`
--
ALTER TABLE `anket_secenekleri`
  ADD CONSTRAINT `anket_secenekleri_ibfk_1` FOREIGN KEY (`anketid`) REFERENCES `anketler` (`anketid`);
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;






---


---





anketler.sql

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2024, 15:35:07
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Veritabanı: `haanketsitesi`
--
 
-- --------------------------------------------------------
 
--
-- Tablo için tablo yapısı `anketler`
--
 
CREATE TABLE `anketler` (
  `anketid` int(11) NOT NULL,
  `anketadi` varchar(255) NOT NULL,
  `katilmasayisi` int(11) DEFAULT 0,
  `en_cok_tiklanan_anket_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 
--
-- Tablo döküm verisi `anketler`
--
 
INSERT INTO `anketler` (`anketid`, `anketadi`, `katilmasayisi`, `en_cok_tiklanan_anket_id`) VALUES
(1, 'CB Kim olmalı?', 4, NULL),
(2, 'Alınacak araba hangisi olmalı?', 17, NULL),
(3, 'Şuan olmak isteyeceğiniz şehir', 4, NULL),
(4, 'Araba Rengi Seçin', 2, NULL),
(5, 'dENEME', 1, NULL),
(6, 'dENEME2', 1, NULL);
 
--
-- Dökümü yapılmış tablolar için indeksler
--
 
--
-- Tablo için indeksler `anketler`
--
ALTER TABLE `anketler`
  ADD PRIMARY KEY (`anketid`);
 
--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--
 
--
-- Tablo için AUTO_INCREMENT değeri `anketler`
--
ALTER TABLE `anketler`
  MODIFY `anketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





---------------

------------------
haberler.sql


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2024, 15:21:12
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Veritabanı: `haanketsitesi`
--
 
-- --------------------------------------------------------
 
--
-- Tablo için tablo yapısı `haberler`
--
 
CREATE TABLE `haberler` (
  `haberid` int(11) NOT NULL,
  `haberbaslik` varchar(255) NOT NULL,
  `haberdetay` text NOT NULL,
  `haberfoto` varchar(255) DEFAULT NULL,
  `okunma_sayisi` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 
--
-- Tablo döküm verisi `haberler`
--
 
INSERT INTO `haberler` (`haberid`, `haberbaslik`, `haberdetay`, `haberfoto`, `okunma_sayisi`) VALUES
(1, 'Son Dakika emeklilerin dikkatine! işte beklenen müjde hakkında açıklama!', 'Kabine toplantısı sonucunda emeklilere asgari ücret oranında zam yapılacağı açıklandı. İki milyon yeni emekli bundan faydalanabilecek.', 'ornek_foto1.jpg', 47),
(2, 'Savcı ve Hakim için beklenen atama!', '1050 adet atama yapılacağı açıklandı. Atama günü ise henüz belli değil. Gözler kabinede...', 'ornek_foto2.jpg', 22),
(3, 'Altın son durum!', 'Altın düşüş yaşamakta.', 'ornek_foto3.jpg', 14);
 
--
-- Dökümü yapılmış tablolar için indeksler
--
 
--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
  ADD PRIMARY KEY (`haberid`);
 
--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--
 
--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
  MODIFY `haberid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





---------------------
---------------------
kategoriler.sql


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2024, 12:01:57
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Veritabanı: `site`
--
 
-- --------------------------------------------------------
 
--
-- Tablo için tablo yapısı `kategoriler`
--
 
CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `kategori` varchar(225) NOT NULL,
  `resim` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 
--
-- Tablo döküm verisi `kategoriler`
--
 
INSERT INTO `kategoriler` (`id`, `kategori`, `resim`) VALUES
(1, 'Haber Ekle', 'eÄŸitim.jpg'),
(2, 'Haber Sil', 'siyadse.jpg'),
(3, 'Haber Düzenle', 'images.jpg');
 
--
-- Dökümü yapılmış tablolar için indeksler
--
 
--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);
 
--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--
 
--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




-----------------------------

-----------------------------
yorumlar.sql


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2024, 22:02:20
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Veritabanı: `haanketsitesi`
--
 
-- --------------------------------------------------------
 
--
-- Tablo için tablo yapısı `yorumlar`
--
 
CREATE TABLE `yorumlar` (
  `yorumid` int(11) NOT NULL,
  `haberid` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `yorum` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 
--
-- Tablo döküm verisi `yorumlar`
--
 
INSERT INTO `yorumlar` (`yorumid`, `haberid`, `kullanici_adi`, `yorum`, `tarih`) VALUES
(2, 1, 'Kullanıcı', 'zam gelir aynen', '2024-05-26 19:18:53'),
(3, 1, 'Kullanıcı', 'Onu bunu boşverin gesem koydu', '2024-05-26 19:19:18'),
(4, 1, 'Kullanıcı', 'zx<zxzx', '2024-05-26 19:34:00');
 
--
-- Dökümü yapılmış tablolar için indeksler
--
 
--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorumid`),
  ADD KEY `haberid` (`haberid`);
 
--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--
 
--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
 
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--
 
--
-- Tablo kısıtlamaları `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`haberid`) REFERENCES `haberler` (`haberid`);
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;