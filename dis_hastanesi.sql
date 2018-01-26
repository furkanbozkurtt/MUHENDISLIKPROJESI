-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Mar 2016, 13:26:56
-- Sunucu sürümü: 10.1.9-MariaDB
-- PHP Sürümü: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dis_hastanesi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doktorkaydi`
--

CREATE TABLE `doktorkaydi` (
  `doktorid` int(11) NOT NULL,
  `resim` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `doktor_tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `doktor_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `doktor_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `doktor_unvan` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `doktor_adres` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `doktor_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL,
  `sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kisi` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `doktorkaydi`
--

INSERT INTO `doktorkaydi` (`doktorid`, `resim`, `doktor_tc`, `doktor_ad`, `doktor_soyad`, `doktor_unvan`, `doktor_adres`, `doktor_tel`, `email`, `tarih`, `sifre`, `kisi`) VALUES
(1, '../doktor foto/resim1.jpg', '60405030708', 'MEHMET', 'KARA', 'PROF', '......', '13648257950', 'mehmet@gmail.com', '2016-03-29', '123456', 17),
(3, '../doktor foto/resim.jpg', '12345678945', 'ALİ', 'ÖZ', 'PROF', '......', '30201040506', 'ali@gmail.com', '2016-03-29', '123456', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` int(11) NOT NULL,
  `tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `tc`, `kullanici_adi`, `email`, `kullanici_sifre`) VALUES
(1, '12345678', 'admin', '', '12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `k_kaydi`
--

CREATE TABLE `k_kaydi` (
  `id` int(11) NOT NULL,
  `tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `dogum_tarih` date NOT NULL,
  `cinsiyet` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `k_kaydi`
--

INSERT INTO `k_kaydi` (`id`, `tc`, `ad`, `soyad`, `dogum_tarih`, `cinsiyet`, `tel`, `email`, `sifre`) VALUES
(1, '12365474102', 'asd', '1', '2016-02-10', 'bay', '30201050405', 'ad@', '123'),
(2, '30624215758', 'asdf', 'asdfd', '2016-02-17', 'bay', '71528486952', 'gffgfgf@', '123'),
(3, '75314592101', 'hg', 'hg', '2016-02-09', 'bay', '13648512798', 'ggg@', '123'),
(4, '95847562514', 'ALİ', 'KARA', '2016-02-04', 'bay', '13647985253', 'ali@gmail.com', '12'),
(5, '31465285947', 'MERVE', 'DEMİR', '2016-02-09', 'bayan', '12345678912', 'merve@gmail.com', '12'),
(6, '12345685214', 'asdf', 'asdf', '2016-02-10', 'bay', '30201040506', 'aaa@', '12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `m_olan_tablo`
--

CREATE TABLE `m_olan_tablo` (
  `İD` int(11) NOT NULL,
  `h_tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `h_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `h_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `h_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `d_tarih` date NOT NULL,
  `cinsiyet` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `rapor` varchar(350) COLLATE utf8_turkish_ci NOT NULL,
  `d_tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `d_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `d_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `d_unvan` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `m_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `m_olan_tablo`
--

INSERT INTO `m_olan_tablo` (`İD`, `h_tc`, `h_ad`, `h_soyad`, `h_tel`, `d_tarih`, `cinsiyet`, `rapor`, `d_tc`, `d_ad`, `d_soyad`, `d_unvan`, `m_tarih`) VALUES
(29, '75314592101', 'hg', 'hg', '13648512798', '0000-00-00', 'bay', '', '60405030708', 'k', 'k', 'k', '2016-03-28'),
(30, '12365474102', 'asd', '1', '30201050405', '0000-00-00', 'bay', 'cxcxc', '60405030708', 'k', 'k', 'k', '2016-02-29'),
(31, '12345806712', 'K', 'K', '0', '0000-00-00', 'WQ', 'saasdsas', '60405030708', 'ZEKERİYA', 'k', 'k', '2016-03-03'),
(32, '12345806712', '', '', '', '0000-00-00', '', 'saasdsas', '', '', '', '', '2016-03-03'),
(33, '12345806712', '', '', '', '0000-00-00', '', 'saasdsas', '', '', '', '', '2016-03-03'),
(34, '12345806712', '', '', '', '0000-00-00', '', 'saasdsas', '', '', '', '', '2016-03-03'),
(35, '12345806712', '', '', '', '0000-00-00', '', 'saasdsas', '', '', '', '', '2016-03-03'),
(36, '12365474102', 'asd', '1', '30201050405', '0000-00-00', 'bay', 'saadads', '60405030708', 'k', 'k', 'k', '2016-03-03'),
(45, '30624215758', 'AHMET', 'KILIÇ', '71528486952', '0000-00-00', 'bay', '', '60405030708', 'k', 'k', 'k', '2016-03-04'),
(46, '30624215758', 'OSMAN', 'SARI', '71528486952', '0000-00-00', 'bay', '', '60405030708', 'k', 'k', 'k', '2016-03-04'),
(49, '30624215758', 'asdf', 'asdfd', '71528486952', '0000-00-00', 'bay', '', '60405030708', 'k', 'k', 'k', '2016-03-05'),
(50, '75314592101', 'hg', 'hg', '13648512798', '0000-00-00', 'bay', '', '60405030708', 'k', 'k', 'k', '2016-03-05'),
(51, '31465285947', 'MERVE', 'DEMİR', '12345678912', '0000-00-00', 'bayan', 'asdsadasasas', '60405030708', 'MEHMET', 'KARA', 'PROF', '2016-03-06'),
(52, '', '', '', '', '0000-00-00', '', 'asdas', '', '', '', '', '2016-03-06'),
(53, '75314592101', '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-03-06'),
(54, '31465285947', 'MERVE', 'DEMİR', '12345678912', '0000-00-00', 'bayan', 'asdsadasasas', '60405030708', 'MEHMET', 'KARA', 'PROF', '2016-03-07'),
(56, '12345678945', 'ALİ', 'KARA', '13647985253', '0000-00-00', 'bay', 'dasasdasd', '60405030708', 'MEHMET', 'KARA', 'PROF', '2016-03-07'),
(57, '95847562514', 'ALİ', 'KARA', '13647985253', '0000-00-00', 'bay', '', '60405030708', 'MEHMET', 'KARA', 'PROF', '2016-03-20'),
(58, '30624215758', 'asdf', 'asdfd', '71528486952', '0000-00-00', 'bay', '', '60405030708', 'MEHMET', 'KARA', 'PROF', '2016-03-20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personelkaydi`
--

CREATE TABLE `personelkaydi` (
  `id` int(11) NOT NULL,
  `resim` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `personel_tc` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `personel_ad` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `personel_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `personel_unvan` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `personel_adres` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `personel_tel` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `personelkaydi`
--

INSERT INTO `personelkaydi` (`id`, `resim`, `personel_tc`, `personel_ad`, `personel_soyad`, `personel_unvan`, `personel_adres`, `personel_tel`, `email`, `tarih`) VALUES
(41, '../doktor foto/resim1.jpg', '30102052607', 'ş', 'ş', 'ş', 'ş', '40506020708', 'sadasdasd', '2016-02-21'),
(40, '../doktor foto/resim1.jpg', '90705040601', ' mhmht', ' asdasd', ' l', ' hghjghghj', '50604080901', 'assssssss', '2016-02-21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rhasta_tablo`
--

CREATE TABLE `rhasta_tablo` (
  `h_tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `h_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `h_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `dogum_tarih` date NOT NULL,
  `cinsiyet` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `doktor_tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `d_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `d_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `d_unvan` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `doktorid` int(11) NOT NULL,
  `kisi` int(11) NOT NULL,
  `bakilan` int(30) NOT NULL,
  `r_tarih` date NOT NULL,
  `r_saat` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `rhasta_tablo`
--

INSERT INTO `rhasta_tablo` (`h_tc`, `h_ad`, `h_soyad`, `tel`, `dogum_tarih`, `cinsiyet`, `doktor_tc`, `d_ad`, `d_soyad`, `d_unvan`, `doktorid`, `kisi`, `bakilan`, `r_tarih`, `r_saat`) VALUES
('75314592101', 'hg', 'hg', '13648512798', '2016-02-09', 'bay', '60405030708', 'MEHMET', 'KARA', 'PROF', 1, 14, 0, '2016-03-24', '15:30'),
('12365474102', 'asd', '1', '30201050405', '2016-02-10', 'bay', '60405030708', 'MEHMET', 'KARA', 'PROF', 1, 17, 0, '2016-03-23', '13:00');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `doktorkaydi`
--
ALTER TABLE `doktorkaydi`
  ADD PRIMARY KEY (`doktorid`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `k_kaydi`
--
ALTER TABLE `k_kaydi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `m_olan_tablo`
--
ALTER TABLE `m_olan_tablo`
  ADD PRIMARY KEY (`İD`);

--
-- Tablo için indeksler `personelkaydi`
--
ALTER TABLE `personelkaydi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rhasta_tablo`
--
ALTER TABLE `rhasta_tablo`
  ADD PRIMARY KEY (`h_tc`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `doktorkaydi`
--
ALTER TABLE `doktorkaydi`
  MODIFY `doktorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `k_kaydi`
--
ALTER TABLE `k_kaydi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `m_olan_tablo`
--
ALTER TABLE `m_olan_tablo`
  MODIFY `İD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- Tablo için AUTO_INCREMENT değeri `personelkaydi`
--
ALTER TABLE `personelkaydi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
