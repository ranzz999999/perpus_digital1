-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2026 pada 04.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `penerbit` varchar(225) DEFAULT NULL,
  `tahun_terbit` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `link_buku` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `deskripsi`, `foto`, `link_buku`) VALUES
(8, 6, 'Naruto', ' Masashi Kishimoto', ' Shueisha', '1999', ' ninja remaja dari Desa Konohagakure', '1778129532_naruto.jpg', 'uploads/ebook/Naruto Chapter 01 - Uzumaki Naruto.pdf'),
(10, 6, 'Bleach', ' Tite Kubo', 'm&c!', '2001', 'Dewa Kematian', '1778645741_images.jpg', NULL),
(11, 6, 'Naruto shippuden ', ' Masashi Kishimoto', ' Shueisha', '1999', 'ninja', '1779258805_download.jpg', NULL),
(12, 7, 'Battle Through The Heavens', 'Tiancan Tudo', 'Zhiyin Manke ', '2012', 'usim pertama (Season 1) resmi ditayangkan pada 7 Januari 2017.', '1778647440_1212de.jpg', NULL),
(13, 7, 'Soul Land', 'Tang Jia San Shao', ' AC.QQ (Tencent Comic) dan Manhuatai', '2011', 'Manhua pertama Soul Land (Douluo Dalu) mulai diterbitkan pada tahun 2011. Serial komik ini diadaptasi dari novel karya Tang Jia San Shao dan berlanjut ke beberapa sekuel, termasuk Soul Land 2: The Peerless Tang Clan (2012) dan Soul Land 3: Legend of the Dragon King (2016).', '1778647788_Shrek Seven Devils.jpg', NULL),
(14, 8, 'Lookism', 'Park Tae-joon', 'Naver Webtoon', '2014', 'Manhwa Lookism karya Park Tae-joon pertama kali diterbitkan di Naver Webtoon pada November 2014. Komik ini dirilis secara mingguan dan mendapatkan popularitas tinggi karena mengangkat isu sosial mengenai perundungan dan standar kecantikan di Korea Selatan.', '1778648195_25 Top Manhwa (Korean Webtoons) That You Should Check Out (2019).jpg', NULL),
(15, 7, 'Soul Land 2', 'Park Tae-joon', ' AC.QQ (Tencent Comic) dan Manhuatai', '2023', 'Soul Land 2: The Peerless Tang Clan (Douluo Dalu 2) dirilis perdana pada 24 Juni 2023. Donghua (serial animasi Tiongkok) ini merupakan kelanjutan dari Soul Land pertama, yang berkisah tentang generasi baru di Akademi Shrek, 10.000 tahun setelah cerita Tang San', '1778648529_Soul Land 2 Huo Yuhao x Tang Wutong.jpg', NULL),
(16, 6, 'Jujutsu Kaisen Modulo', 'Gege Akutami', 'Shueisha ', '2025', '8 September 2025 hingga 9 Maret 2026.8 September 2025 hingga 9 Maret 2026.', '1778651541_448282.jpg', NULL),
(17, 6, 'Black Clover', 'Yūki Tabata', ' Shueisha', '2015', 'Black Clover adalah serial manga fantasi aksi yang menceritakan perjuangan seorang anak tanpa sihir bernama Asta di dunia yang mengandalkan kekuatan sihir.', '1779244931_311764.jpg', NULL),
(18, 6, 'One Piece', 'Eiichiro Oda', 'Elex Media Komputindo.', '1997', ' Cerita ini mengikuti petualangan Monkey D. Luffy yang memiliki tubuh elastis seperti karet setelah secara tidak sengaja memakan Buah Iblis. Bersama krunya yang disebut Bajak Laut Topi Jerami, Luffy mengarungi lautan berbahaya bernama Grand Line. Tujuan utamanya adalah menemukan harta karun terbesar di dunia yang dikenal sebagai \"One Piece\" agar ia dapat dinobatkan sebagai Raja Bajak Laut berikutnya.', '1779249825_125.jpg', 'https://fliphtml5.com/gutjj/muka/One_Piece_Volume_1/1/'),
(19, 6, 'Wistoria', 'Fujino Omori', 'Kodansha', '2020', 'Kisah ini berpusat pada seorang pemuda bernama Will Serfort. Demi memenuhi janji masa kecilnya dengan teman masa kecilnya yang sangat kuat (Elfaria), Will memasuki Akademi Sihir Regarden yang bergengsi dengan tujuan mencapai puncak dunia sihir.', '1779251153_306.jpg', NULL),
(20, 6, 'Classroom The Elite', 'Shōgo Kinugasa', 'MF Bunko J)', '2015', 'Cerita berlatar di Tokyo Metropolitan Advanced Nurturing School, sebuah sekolah elit bergengsi yang didirikan oleh pemerintah Jepang untuk mendidik para pemimpin masa depan negara. Para siswanya diberikan kebebasan luar biasa, namun sekolah ini menggunakan sistem peringkat yang sangat kompetitif dari Kelas A hingga D.', '1779251318_277.jpg', 'https://online.fliphtml5.com/xgemm/njcf/#p=1'),
(21, 6, 'Wind Breaker', 'Satoru Nii', ' Kodansha ', '2021', ':Manga ini menceritakan tentang Haruka Sakura, seorang remaja berandalan yang sangat membenci orang lemah dan hanya peduli pada mereka yang kuat. Ia pindah ke SMA Furin, sekolah yang terkenal dengan sebutan \"Bofurin\", yang diisi oleh para berandalan yang menggunakan kekuatan mereka untuk melindungi kota dari penjahat dan kekacauan. Alih-alih menjadi yang terkuat untuk mendominasi, Haruka justru bergabung dengan kelompok tersebut dan belajar arti persahabatan serta pahlawan pelindung.', '1779252238_427.jpg', NULL),
(22, 6, 'Jujutsu Kaisen', 'Gege Akutami', ' Shueisha', '2018', ' Seri manga dan anime fantasi gelap ini menceritakan tentang Yuji Itadori, seorang siswa SMA yang menjadi wadah bagi iblis kuno yang sangat kuat bernama Ryomen Sukuna. Untuk melindungi umat manusia dan mencegah kebangkitan Sukuna secara penuh, Yuji bergabung dengan organisasi Penyihir Jujutsu. Bersama rekan-rekannya, ia bertarung melawan makhluk kutukan yang lahir dari emosi negatif manusia', '1779252407_Jujutsu Kaisen - Vol 1.jpg', NULL),
(23, 9, 'Si Juki', 'Faza Ibnu Ubaidillah', 'PT Bukune Kreatif Cipta (Bukuné).', '2011', '. Sejak saat itu, Si Juki telah merilis berbagai edisi populer, termasuk Si Juki Panitia Hari Akhir (2017), Komik Pintar Si Juki (2018), Si Juki Anak Kosan (2020-2021), hingga edisi terbaru Si Juki Anak Kos London pada 2022.', '1779259314_665.jpg', NULL),
(24, 10, 'Amazing Fantasy Spiderman', 'Stan Lee', 'Marvel Comics.', '1962', 'Kisah ikonik yang ditulis oleh Stan Lee dan diilustrasikan oleh Steve Ditko ini secara resmi dirilis ke pasaran pada tanggal 10 Agustus 1962. Karena kesuksesannya yang luar biasa, Marvel kemudian memberikan komik solonya sendiri bertajuk The Amazing Spider-Man yang terbit pada Maret 1963.', '1779260951_400.jpg', NULL),
(25, 10, 'Avengers End Game', 'Stan Lee', 'Marvel Comics.', '2018', 'Referensi Judul Klasik: Komik The Avengers #71 – Endgame yang ditulis oleh Stan Lee sebenarnya telah terbit jauh sebelumnya pada bulan Desember 1969.Ultimate Endgame: Terdapat juga seri komik terbatas Ultimate Endgame yang mulai diterbitkan oleh Marvel Comics pada 31 Desember 2025.Format Utama: Avengers: Endgame yang umumnya dikenal masyarakat luas merupakan sebuah film (Marvel Cinematic Universe) yang tayang di bioskop pada tahun 2019, bukan adaptasi langsung dari satu komik tertentu.', '1779261138_244.jpg', NULL),
(26, 10, 'Captain America Civil War', 'Stan Lee', 'Marvel Comics.', '2006', 'Alur cerita utamanya berfokus pada konflik pahlawan super yang terbagi menjadi dua kubu setelah pemerintah mengeluarkan Undang-Undang Registrasi Manusia Super (Superhero Registration Act). Captain America menolak peraturan tersebut karena dianggap melanggar privasi dan kebebasan, sementara Iron Man mendukung kebijakan tersebut untuk membuat para pahlawan bertanggung jawab kepada pemerintah.', '1779261337_Captain America_ Civil War__The Avengers Are No More!_ (1).jpg', NULL),
(27, 11, 'Batman And Son', 'Grant Morrison', 'DC Comics', '2007', 'Kisah ini kemudian dikumpulkan dan dirilis dalam bentuk buku (trade paperback) pada tahun 2007, yang memperkenalkan Damian Wayne (putra Bruce Wayne dan Talia al Ghul) untuk pertama kalinya ke dalam kontinuitas utama DC.', '1779263019_398.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(6, 'Manga'),
(7, 'manhua'),
(8, 'Manhwa'),
(9, 'Komik Local'),
(10, 'Avengers'),
(11, 'Justice League');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(1, 45458, 8, '2026-05-07', '2026-05-08', 'dipinjam'),
(2, 45460, 8, '2026-05-13', '2026-05-20', 'dikembalikan'),
(3, 45463, 11, '2026-05-13', '2026-05-20', 'dikembalikan'),
(4, 45463, 11, '2026-05-13', '2026-05-20', 'dikembalikan'),
(5, 45463, 13, '2026-05-13', '2026-05-20', 'dikembalikan'),
(6, 45463, 15, '2026-05-13', '2026-05-20', 'dikembalikan'),
(7, 45463, 8, '2026-05-20', '2026-05-27', 'dikembalikan'),
(8, 45463, 16, '2026-05-20', '2026-05-27', 'dikembalikan'),
(9, 45464, 22, '2026-05-20', '2026-05-27', 'dikembalikan'),
(10, 45465, 20, '2026-05-20', '2026-05-27', 'dipinjam'),
(11, 45466, 17, '2026-05-20', '2026-05-27', 'dikembalikan'),
(12, 45464, 24, '2026-05-21', '2026-05-28', 'dikembalikan'),
(13, 45464, 8, '2026-05-21', '2026-05-28', 'dikembalikan'),
(14, 45464, 20, '2026-05-21', '2026-05-28', 'dipinjam'),
(15, 45464, 18, '2026-05-21', '2026-05-28', 'dikembalikan'),
(16, 45463, 20, '2026-05-21', '2026-05-28', 'dipinjam'),
(17, 45464, 8, '2026-05-26', '2026-06-02', 'dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `reting` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_user`, `id_buku`, `ulasan`, `reting`) VALUES
(1, 45463, 13, 'baguss', 5),
(2, 45463, 13, 'baguss', 5),
(3, 45460, 11, 'gg', 4),
(4, 45466, 17, 'gg banget akhirnya asta jadi kaisar sihir', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `foto`) VALUES
(45458, 'admin', 'admin', '1', 'petugas', NULL),
(45460, '', 'maul', '$2y$10$bOFNVVD/.iNp/a89CzEcQ.vE5JVAt5EdzhARs.k2TLRrGOZzwGNrC', '', NULL),
(45462, '', 'administator', '$2y$10$Wl1RB5bmLKwc3Q4/6EUjguYUxNyzYCwlasxRIylhtLetlDdEaDtGC', 'admin', NULL),
(45463, '', 'ardi', '$2y$10$kdZCKDVUBpDL2uVi1vm78eXjEhMkpDjXwr5dHIDh0nWx6Lo.L0Mx2', '', 'user_45463_1779342910.jpg'),
(45464, '', 'Ranzz', '$2y$10$PFeFHbsrX3Y71QRl/IPfguy8wL15f8CIDacXwG3PkEV.XwV.5A2hS', '', 'user_45464_1779255801.jpg'),
(45465, '', 'jokoanwar', '$2y$10$5DRQjcyW1iK47VCVD9MT/OBAs8Rcql/r/sXT1blBctWkUaQRxm0Py', '', 'user_45465_1779257518.jpg'),
(45466, '', 'sill', '$2y$10$NRmCOkqSqFUyFz6hGL.8Me0WnMqWMtH.6BRwKZrJzx/OkI6so5UUK', '', 'user_45466_1779257781.jpg'),
(45467, 'admin11', 'admin11', '12', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45468;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
