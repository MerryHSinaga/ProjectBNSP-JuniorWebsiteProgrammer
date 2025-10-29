-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2025 pada 14.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyrus_blog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created_at`, `author_id`) VALUES
(4, 'Terbuang dalam waktu', 'Teringat seru suaramu menepis keraguan\r\nNamun, dewasa mengubah\r\nCara pandang dan keikhlasan bersahut dan bergulat\r\nTerperai-perai menghilang\r\nPerih yang terasa\r\nSakit yang tak sirna\r\nHarapan akankah ada?\r\nBerputar arah\r\nAngan tenggelam dalam kabut dan amarah\r\nLuka terkuak dan menggebu tanpa arah\r\nTangis yang terbendung\r\nTerbuang dalam waktu yang meluruh\r\nPerih yang terasa\r\nSakit yang tak sirna\r\nHarapan akankah ada?\r\nBerubah\r\nMelihatmu bersemi dan bermekaran\r\nTawa-candamu berikan kekuatan\r\nSisa hariku\r\nPagi berganti waktu memelukmu\r\nKita \'kan tua dan kehilangan pegangan\r\nLihat senyummu memberikan kekuatan\r\nSisa nafasku\r\nCinta tak kenal waktu menjagamu', '2025-10-27 13:37:37', 1),
(5, 'About You', 'I know a place\r\nIt\'s somewhere I go when I need to remember your face\r\nWe get married in our heads\r\nSomething to do whilst we try to recall how we met\r\n\r\nDo you think I have forgotten?\r\nDo you think I have forgotten?\r\nDo you think I have forgotten about you?\r\n\r\nYou and I\r\nWere alive\r\nWith nothing to do I could lay and just look in your eyes\r\nWait and pretend\r\nHold on and hope that we\'ll find our way back in the end\r\n\r\nDo you think I have forgotten?\r\nDo you think I have forgotten?\r\nDo you think I have forgotten about you?\r\nDo you think I have forgotten?\r\nDo you think I have forgotten?\r\nDo you think I have forgotten about you?\r\n\r\nThere was something about you that now I can\'t remember\r\nIt\'s the same damn thing that made my heart surrender\r\nAnd I\'ll miss you on a train\r\nI\'ll miss you in the morning\r\nI never know what to think about, so think about you\r\n(I think about you)\r\nAbout you\r\nDo you think I have forgotten about you?\r\nAbout you\r\nAbout you\r\nDo you think I have forgotten about you?', '2025-10-27 13:45:35', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `user_id`) VALUES
(7, 'Theo', 'theo@gmail.com', 'Hari ini ujian', '2025-10-28 02:24:59', NULL),
(8, 'Buzzer1', 'buzzer1@gmail.com', 'Websitenya sangat membantu.', '2025-10-28 03:07:20', NULL),
(9, 'Buzzer2', 'buzzer1@gmail.com', 'Hari ini presentasi BNSP.', '2025-10-28 04:50:08', NULL),
(10, 'Buzzzer3', 'buzzer3@gmail.com', 'Test', '2025-10-28 05:54:18', NULL),
(14, 'Nina', 'nina@gmail.com', 'Website membantu.', '2025-10-29 03:45:32', NULL),
(15, 'Aileen', 'aileenchz569@gmail.com', 'Sangat suka lagu Hindia.', '2025-10-29 12:14:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `lyrics` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `chords` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `uploader_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `lyrics`, `image`, `chords`, `created_at`, `uploader_id`) VALUES
(5, 'Evaluasi', 'Hindia', 'Yang tak bisa terobati\r\nBiarlah mengering sendiri\r\nMenghias tubuh dan\r\nYang mengevaluasi ragamu\r\nHanya kau sendiri\r\nMereka tak mampu\r\nMelewati yang telah kaulewa-\r\nTiap berganti ha-\r\nRintangan yang kauhadapi\r\nMasalah yang mengeruh\r\nOh, perasaan yang rapuh\r\nIni belum separuhnya\r\nBiasa saja, kamu tak apa\r\nYang selalu ingin ambil peran\r\nHanya berlomba menjadi lebih\r\nSedih dari diri\r\nMuak dikesampingkan, disamakan\r\nHatimu terluka sempurna\r\nMasalah yang mengeruh\r\nOh, perasaan yang rapuh\r\nIni belum separuhnya\r\nBiasa saja, kamu tak apa\r\nPerjalanan yang jauh\r\nKau bangun untuk bertaruh\r\nHari belum selesai\r\nBiasa saja, kamu tak apa\r\nBilas muka, gosok gigi, evaluasi\r\nTidur sejenak, menemui esok pagi\r\nWalau pedih, ku bersamamu kali ini\r\nKu masih ingin melihatmu esok hari\r\nBilas muka, gosok gigi, evaluasi\r\nTidur sejenak, menemui esok pagi\r\nWalau pedih, ku bersamamu kali ini\r\nKu masih ingin melihatmu esok hari\r\nBilas muka, gosok gigi, evaluasi\r\nTidur sejenak, menemui esok pagi\r\nWalau pedih, ku bersamamu kali ini\r\nKu masih ingin melihatmu esok hari', 'evaluasi.jpg', NULL, '2025-10-27 15:37:10', NULL),
(6, 'Terbuang Dalam Waktu', 'Barasuara', 'Teringat seru suaramu menepis keraguan\r\nNamun, dewasa mengubah\r\nCara pandang dan keikhlasan bersahut dan bergulat\r\nTerperai-perai menghilang\r\nPerih yang terasa\r\nSakit yang tak sirna\r\nHarapan akankah ada?\r\nBerputar arah\r\nAngan tenggelam dalam kabut dan amarah\r\nLuka terkuak dan menggebu tanpa arah\r\nTangis yang terbendung\r\nTerbuang dalam waktu yang meluruh\r\nPerih yang terasa\r\nSakit yang tak sirna\r\nHarapan akankah ada?\r\nBerubah\r\nMelihatmu bersemi dan bermekaran\r\nTawa-candamu berikan kekuatan\r\nSisa hariku\r\nPagi berganti waktu memelukmu\r\nKita \'kan tua dan kehilangan pegangan\r\nLihat senyummu memberikan kekuatan\r\nSisa nafasku\r\nCinta tak kenal waktu menjagamu', 'lagu2.jpg', NULL, '2025-10-27 16:23:51', NULL),
(8, 'Tuhan Yesus Baik', 'Welyar', 'Tiada berkesudahan kasih setia-Mu Tuhan\r\nSlalu baru rahmat-Mu bagiku\r\nHari berganti hari tetap ku lihat kasih-Mu\r\nTak pernah berakhir di hidupku\r\nTuhan Yesus baik, sungguh amat baik\r\nUntuk selama-lamanya Tuhan Yesus baik\r\nTuhan Yesus baik, sungguh amat baik\r\nUntuk selama-lamanya Tuhan Yesus baik\r\n(Yesus, Dia baik)\r\n(Yesus, Dia baik bagiku)\r\nTiada berkesudahan kasih setia-Mu, Tuhan (Ooh)\r\nS\'lalu baru rahmat-Mu bagiku (Ooh)\r\nHari berganti hari, tetap kulihat kasih-Mu (Hari berganti hari)\r\nTak pernah berakhir di hidupku (Tak berakhir)\r\nTuhan Yesus baik, sungguh amat baik\r\nUntuk selama-lamanya Tuhan Yesus baik\r\nTuhan Yesus baik, sungguh amat baik\r\nUntuk selama-lamanya Tuhan Yesus baik\r\n(Tuhan Yesus baik)\r\nTuhan Yesus baik, oh yeah, sungguh amat baik\r\nUntuk selama-lamanya Tuhan Yesus baik\r\nOh, Tuhan Yesus baik, sungguh amat baik\r\nUntuk selama-lamanya Tuhan Yesus baik\r\nUntuk selama-lamanya Tuhan Yesus baik (Tuhan Yesus baik)\r\nUntuk selama-lamanya Tuhan Yesus baik (Selama-lamanya Tuhan Yesus baik)', 'baik.jpg', NULL, '2025-10-27 16:41:11', NULL),
(10, 'Ku Bahagia', 'Melly Goeslaw', 'Di atas bumi ini ku berpijak\r\nPada jiwa yang tenang di hariku\r\nTak pernah ada duka yang terlintas\r\nKu bahagia\r\nIngin kulukis semua hidup ini\r\nDengan cinta dan cita yang terindah\r\nMasa muda yang tak pernah \'kan mendung\r\nKu bahagia\r\nDalam hidup ini\r\nArungi semua cerita indahku\r\nSaat-saat remaja yang terindah\r\nTak bisa terulang\r\nKu ingin nikmati\r\nSegala jalan yang ada di hadapku\r\n\'Kan kutanamkan cinta \'tuk kasihku\r\nAgar ku bahagia\r\nDi atas bumi ini ku berpijak\r\nPada jiwa yang tenang di hariku\r\nTak pernah ada duka yang terlintas\r\nKu bahagia\r\nDalam hidup ini\r\nArungi semua cerita indahku\r\nSaat-saat remaja yang terindah\r\nTak bisa terulang\r\nKu ingin nikmati\r\nSegala jalan yang ada di hadapku\r\n\'Kan kutanamkan cinta \'tuk kasihku\r\nAgar ku bahagia\r\nIngin kulukis semua hidup ini\r\nDengan cita dan cinta yang terindah\r\nMasa muda yang tak pernah \'kan mendung\r\nKu bahagia\r\nDalam hidup ini\r\nArungi semua cerita indahku\r\nSaat-saat remaja yang terindah\r\nTak bisa terulang\r\nKu ingin nikmati\r\nSegala jalan yang ada di hadapku\r\n\'Kan kutanamkan cinta \'tuk kasihku\r\nAgar ku bahagia (bahagia)', 'bahagia.jpg', NULL, '2025-10-28 04:00:46', NULL),
(12, 'Cincin', 'Hindia', 'Kau bermasalah jiwa, aku pun rada gila\r\nJodoh akal-akalan neraka kita bersama\r\nKau langganan menangis, lakimu muntah-muntah\r\nBegitu terus sampai iblis tobat dan sedekah\r\nTerkadang rasanya leher terbakar hingga pagi\r\nSeperti aku hidup berpasangan dengan api\r\nBerhenti, ulangi, psikolog, dan terapi\r\nAku isi bensin, kita coba lagi\r\nTapi s\'belumnya\r\nSejuta sayang untukmu, Cinta\r\nKar\'na aku pun bola panas juga\r\nKadang lebih atau sama parahnya\r\nDan jika bicara tentang masa depan\r\nAku pun bingung, tak punya tebakan\r\nLagu cinta untuk akhir dunia\r\nLihat kami nyanyikan ini bersama\r\nS\'moga hidup kita t\'rus begini-gini saja\r\nWalau sungai meluap dan kurs tak masuk logika\r\nS\'moga kita mencintai apa adanya\r\nWalau katanya s\'karang ku bisa masuk penjara\r\nSatu per satu, hari per hari\r\nYang menyakiti, benahi lagi\r\nPerihal esok, \'tuk nanti dulu\r\nPerihal cincin, kucari waktu\r\nPersetan kata siapa\r\nMau bilang apa tak guna\r\nM\'reka hanya tahu namamu\r\nM\'reka takkan jadi diriku\r\nPersetan aturan cinta\r\nTak tertulis di atas batu\r\nApa kau ingin menjadi benar?\r\nAtau ingin menjadi muda?\r\nS\'moga hidup kita t\'rus begini-gini saja\r\nWalau sungai meluap dan kurs tak masuk logika\r\nS\'moga kita mencintai apa adanya\r\nWalau katanya s\'karang ku bisa masuk penjara\r\nPersetan kata siapa\r\nMau bilang apa tak guna\r\nM\'reka hanya tahu namamu\r\nM\'reka takkan jadi diriku\r\nPersetan aturan cinta\r\nTak tertulis di atas batu\r\nApa kau ingin menjadi benar?\r\nAtau kau ingin menjadi muda?\r\nLagu cinta untuk akhir dunia\r\nS\'karang bantu aku nyanyikan ini bersama\r\nS\'moga hidup kita t\'rus begini-gini saja\r\nWalau sungai meluap dan kurs tak masuk logika\r\nS\'moga kita mencintai apa adanya\r\nWalau katanya s\'karang ku bisa masuk penjara\r\nSatu per satu (satu per satu), hari per hari (hari per hari)\r\nYang menyakiti, benahi lagi\r\nPerihal esok (perihal esok), \'tuk nanti dulu (\'tuk nanti dulu)\r\nPerihal cincin, kucari waktu', 'cincin.jpg', NULL, '2025-10-28 06:17:15', NULL),
(14, 'Everything you are', 'Hindia', 'Wajahmu kuingat selalu\r\nLupakan hal-hal yang menggangguku\r\nKar\'na hari ini mata kita beradu\r\nKita saling bantu\r\nMelepas perasaan\r\nTinggi ke angkasa\r\nMenantang dunia\r\nMerayakan muda\r\n\'Tuk satu jam saja\r\nKita hampir mati\r\nDan kauselamatkan aku\r\nDan ku menyelamatkanmu\r\nDan sekarang aku tahu\r\nCerita kita tak jauh berbeda\r\nGot beat down by the world\r\nSometimes I wanna fold\r\nNamun, suratmu \'kan kuceritakan\r\nKe anak-anakku nanti\r\nBahwa aku pernah dicintai\r\nWith everything you are\r\nFully as I am\r\nWith everything you are\r\nWajahmu yang beragam rupa\r\nPastikan ku tak sendirian\r\nJalani derita\r\nKaubawakan kisahmu, aku mendengarkan\r\nOh, kita bergantian\r\nBertukar nestapa\r\nMenawar trauma\r\nDatang seadanya\r\nTerasku terbuka\r\nKita hampir mati\r\nDan kauselamatkan aku\r\nDan ku menyelamatkanmu\r\nDan sekarang aku tahu\r\nCerita kita tak jauh berbeda\r\nGot beat down by the world\r\nSometimes I wanna fold\r\nNamun, suratmu \'kan kuceritakan\r\nKe anak-anakku nanti\r\nBahwa aku pernah dicintai\r\nSeada-adanya\r\nSekurang-kurangnya\r\nWalau sulit utarakan hatiku dengan indah', 'everything.jpg', NULL, '2025-10-28 06:20:07', NULL),
(15, 'Komang', 'Raim Laode', 'Dari kejauhan, tergambar cerita tentang kita\r\nTerpisah jarak dan waktu\r\nIngin kuungkapkan rindu lewat kata indah\r\nTak cukup untuk dirimu\r\nSebab kau terlalu indah dari sekedar kata\r\nDunia berhenti sejenak menikmati indahmu\r\nDan apabila tak bersamamu\r\nKupastikan kujalani dunia tak seindah kemarin\r\nSederhana, tertawamu sudah cukup\r\nLengkapi sempurnanya hidup bersamamu\r\nJika hari kulalui tanpa hawamu\r\nPercuma senyumku dengan dia, oh\r\nDan apabila tak bersamamu\r\nKupastikan kujalani dunia tak seindah kemarin\r\nSederhana, tertawamu sudah cukup\r\nLengkapi sempurnanya hidup bersamamu\r\nApabila tak bersamamu\r\nKupastikan kujalani dunia tak seindah kemarin\r\nSederhana, tertawamu sudah cukup\r\nLengkapi sempurnanya hidup bersamamu', 'komang.jpg', NULL, '2025-10-28 06:21:22', NULL),
(16, 'Rumah ke Rumah', 'Hindia', 'Menyesal tak kusampaikan\r\nCinta monyetku ke Kanya dan Rebecca\r\nApa kabar kalian di sana?\r\nSemoga hidup baik-baik saja\r\nTak belajar, terkena getahnya\r\nSaat bersama Thanya dan Saphira\r\nKu percaya, mungkin bukan jalannya\r\nNamun, kalian banyak salah juga\r\nJika dahulu ku tak cepat berubah\r\nIni maafku untukmu, Sharfina\r\nSegala doa yang baik adanya\r\nUntukmu dan mimpimu yang mulia\r\nPindah berkala rumah ke rumah\r\nBerharap bisa berujung indah\r\nWalau akhirnya harus berpisah\r\nT\'rima kasih kar\'na ku tak mudah\r\nPindah berkala rumah ke rumah\r\nBerharap bisa berujung indah\r\nWalau akhirnya harus berpisah\r\nT\'rima kasih kar\'na ku tak mudah\r\nMm, mm-mm-mm-mm-mm-mm\r\nMaaf jika ku sering buat susah\r\nIndisya, Panda, Anggra, Caca, Sismita\r\nP\'rempuan terkuat dalam hidupku\r\nTerjanglah apa pun yang kalian tuju\r\nKau datang saat gelapku merekah\r\nSeluruh hatiku untukmu, Meidiana\r\nKau pantas dapatkan yang baik di dunia\r\nS\'moga kita bertahan lama\r\nPindah berkala rumah ke rumah\r\nMengambil pelajaran jika berpisah\r\nJikalau suatu saat berujung indah\r\nCatat nama kita dalam sejarah', 'rumah.jpg', NULL, '2025-10-28 07:04:03', NULL),
(17, 'Secukupnya', 'Hindia', 'Kapan terakhir kali kamu dapat tertidur tenang?\r\n(Renggang)\r\n\'Tak perlu memikirkan tentang apa yang akan datang\r\nDi esok hari\r\nTubuh yang berpatah hati\r\nBergantung pada gaji\r\nBerlomba jadi asri\r\nMengais validasi\r\nDan akupun terhadir\r\nSeakan paling mahir\r\nMenenangkan dirimu yang merasa terpinggirkan dunia\r\n\'Tak pernah adil\r\nKita semua gagal\r\nAngkat minumanmu\r\nBersedih bersama-sama\r\n(Aa-aa-aa-aa- aa)\r\nSia- sia\r\n(Pada akhirnya)\r\nPutus asa\r\n(Terekam pedih semua)\r\nMasalahnya\r\n(Lebih dari yang)\r\nSecukupnya\r\nRekam gambar dirimu yang terabadikan bertahun silam\r\nPutra putri sakit hati\r\nAyah ibu sendiri\r\nKomitmen lama mati\r\nHubungan yang menyepi\r\nWisata masa lalu\r\nKau hanya merindu\r\nMencari pelarian\r\nDari pengabdian\r\nYang terbakar sirna\r\nMengapur berdebu\r\nKita semua gagal\r\nAmbil sedikit tisu', 'secukupnya.jpg', NULL, '2025-10-28 07:05:01', NULL),
(18, 'Stand By Me', 'Oasis', 'Made a meal and threw it up on Sunday\r\nI\'ve got a lot of things to learn\r\nSaid I would and I\'ll be leaving one day\r\nBefore my heart starts to burn\r\nSo, what\'s the matter with you?\r\nSing me something new\r\nDon\'t you know, the cold and wind and rain don\'t know?\r\nThey only seem to come and go away\r\nTimes are hard when things have got no meaning\r\nI\'ve found a key upon the floor\r\nMaybe you and I will not believe in\r\nThe things we find behind the door\r\nSo, what\'s the matter with you?\r\nSing me something new\r\nDon\'t you know, the cold and wind and rain don\'t know?\r\nThey only seem to come and go away\r\nStand by me, nobody knows the way it\'s gonna be\r\nStand by me, nobody knows the way it\'s gonna be\r\nStand by me, nobody knows the way it\'s gonna be\r\nStand by me, nobody knows\r\nYeah, nobody knows the way it\'s gonna be\r\nIf you\'re leaving, will you take me with you?\r\nI\'m tired of talking on my phone\r\nThere is one thing I can never give you\r\nMy heart will never be your home', 'oasis.jpg', NULL, '2025-10-28 07:06:12', NULL),
(25, 'Nina', '.Feast', 'Saat engkau tertidur\r\nAku pergi menghibur\r\nBeda kota, pisah raga, bukan masalahku\r\nLihat wajahmu di layar, ku tetap bersyukur\r\nSaat engkau terjaga\r\nAku \'kan ada di sana\r\nSempatkan bermain dan bawakan cendera mata\r\nSatu sampai lima tahun, cepat tak terasa\r\nSegala hal kuupayakan untuk melindungi\r\nTunggu aku kembali lagi esok pagi\r\nTumbuh lebih baik, cari panggilanmu\r\nJadi lebih baik dibanding diriku\r\n\'Tuk sementara ini aku mengembara jauh\r\nSaat dewasa kau \'kan mengerti\r\n(Uh-uh)\r\n(Uh-uh)\r\nSaat engkau dewasa\r\nDan aku kian menua\r\nJika ku berpulang lebih awal, tidak apa\r\nBerjumpa lagi di sana, aku tetap sama\r\nSaat engkau teringat\r\nTengkar kita, manakala\r\nMaaf atas perjalanan yang tidak sempurna\r\nNamun percayalah, untukmu kujual dunia\r\nSegala hal kuupayakan untuk melindungi (untuk melindungi)\r\nTunggu aku kembali lagi esok pagi (selalu janjiku pada dirimu)\r\nTumbuh lebih baik, cari panggilanmu\r\nJadi lebih baik dibanding diriku\r\nDan tertawalah saat ini selepas-lepasnya\r\nKar\'na kelak kau \'kan tersakiti\r\nAku tahu kamu hebat\r\nNamun, s\'lamanya diriku pasti berkutat\r\n\'Tuk s\'lalu jauhkanmu dari dunia yang jahat\r\nIni sumpahku padamu \'tuk biarkanmu', 'nina.jpg', NULL, '2025-10-29 01:35:38', NULL),
(27, 'Kuning', 'Rumah Sakit', 'Halusnya awan\r\nMenyatu dan menghalang\r\nNamun kau pun hanya bisu\r\nTetap sinariku dengan cahaya kuningmu\r\nBagai berputar\r\nJauh sudah terasa\r\nNamun jarak yang kutempuh\r\nTak membuatku lebih dekat lagi denganmu\r\nCeritakan padaku indahnya keluh kesahmu\r\nSebelum angin senja membasuh jauh\r\nMasih kucari\r\nTetap tak kutemui\r\nPalingkanlah wajah manis\r\nTunjukkan eloknya kehangatan pesona\r\nCeritakan padaku indahnya keluh kesahmu\r\nSebelum angin senja membasuh jauh\r\nTetaplah di istanamu, langit yang biru kelabu\r\nBiarlah rinduku, kusimpan bersama mimpiku\r\nBilakah kau ajakku, bertemu kembali selalu\r\nKutunggu kuningmu, di setiap waktuku\r\nTetaplah di istanamu, langit yang biru kelabu\r\nBiarlah rinduku, kusimpan bersama mimpiku\r\nBilakah kau ajakku, bertemu kembali selalu\r\nKutunggu kuningmu, di setiap waktuku', 'kuning.jpg', NULL, '2025-10-29 13:01:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Merry', 'merry@gmail.com', 'Theo', 'admin'),
(6, NULL, 'kaize@gmail.com', 'Theo', 'user'),
(7, NULL, 'halo@gmail.com', 'Theo', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articles_users` (`author_id`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contacts_users` (`user_id`);

--
-- Indeks untuk tabel `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_songs_users` (`uploader_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_articles_users` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `fk_songs_users` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
