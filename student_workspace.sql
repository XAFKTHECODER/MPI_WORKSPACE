-- XAMPP-Lite
-- version 8.4.6
-- https://xampplite.sf.net/
--
-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 14 mars 2026 à 01:21
-- Version du serveur : 11.4.5-MariaDB-log
-- Version de PHP : 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `student_workspace`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- --------------------------------------------------------

--
-- Structure de la table `drive_links`
--

CREATE TABLE `drive_links` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `drive_links`
--

INSERT INTO `drive_links` (`id`, `subject_id`, `title`, `url`, `description`, `year`) VALUES
(9, 1, 'INSAT MPI (General)', 'https://drive.google.com/drive/folders/16JIzOOEr2sgGSjT64pYgzjpDWybYmoJE', 'Main directory for INSAT MPI resources.', '2023-2024'),
(10, 1, 'MPI 23-24 Full Drive', 'https://drive.google.com/drive/folders/1ccxEOAi3OmgnCFVHXk-N0bFS02hNuelT', 'Comprehensive collection for the 23-24 academic year.', '2023-2024'),
(11, 1, 'MPI Personalized Folders', 'https://drive.google.com/drive/folders/1I5VDKq4ptezCZzXOCmMXvbJC-ENC0cdb', 'Curated and organized study paths.', '2023-2024'),
(12, 1, 'DOC INSAT ME (Mega)', 'https://mega.nz/folder/l3l2kBhQ#OT9fJ12lqzkfr9c1tpAgQQ', 'External archive of technical documents.', '2023-2024'),
(13, 1, 'Support Examen / DS', 'https://mega.nz/folder/RqlF3ZrQ#DycZS8dnENUCbPrN7yBIUg', 'Past exams, DS papers, and correction sheets.', '2023-2024'),
(14, 1, 'DRIVE 24', 'https://drive.google.com/drive/folders/10C2OoahNED_ndkWVLN2VKMvjH2aDphh4', 'Additional MPI course materials.', '2023-2024'),
(15, 1, 'MPI PDF Archive', 'https://drive.google.com/drive/folders/1c5qNvMm6FwsBSbOuYfWT5OCZZawAfx77', 'Direct access to course PDFs.', '2023-2024'),
(16, 1, 'Exam Reference File', 'https://drive.google.com/file/d/1N_KIOf0vFnj7Y_NL8OPCxHuL8t3Qeo1t/view?usp=drive_copy', 'Specific file for exam preparation.', '2023-2024'),
(17, 1, 'Drive Makki Aloulou', 'https://drive.google.com/drive/folders/1mq0govs5tWOBaqR1HEIaiIrVTHDu7byV', '⭐⭐⭐⭐⭐  RECOMMENDED BY AMINE JELASSI 1996 MAJEUR)', '2023-2024'),
(18, 1, 'DRIVE GRAJA', 'https://drive.google.com/drive/folders/1BXNFSizRIWPs9iAAm36PECDND6GF3pHF', 'Bonnes Resources !', '2024-2025'),
(19, 1, 'Drive Zizou', 'https://drive.google.com/drive/folders/16Wv5qSuBTX_ZW9IpCWvWk9tTC03zV1h5', 'Ressources MPI pour l\'année universitaire 2024-2025.', '2024-2025'),
(20, 1, 'Drive Med Ammous', 'https://drive.google.com/drive/folders/1Q3r4zCRzD0LkwnumAj_-pVShT2TbN9PW', 'Cour Fil Ksou7 !', '2024-2025'),
(21, 1, 'Drive Alae', 'https://drive.google.com/drive/folders/1OFTLXtey3jQbXbEKPFIdlQBXf-_rVYrP', 'Oumour Resume Ma Yfdlkch ! ', '2024-2025'),
(22, 1, 'Drive TALEL / AKREM / ALA', 'https://drive.google.com/drive/folders/1ICS-FynwzyoXWqtUrQ-ehc9wNpsEnL8j', '⭐⭐⭐ DOSSIER DES MAJEURS DE PROMO - Ressources d\'élite recommandées.', '2024-2025'),
(23, 1, 'Drive Amine (A9wa Jawe7)', 'https://drive.google.com/drive/folders/1ZZ29pp30ebGg3irnm-1E2bDFiLyhvf3G?usp=drive_link', '🚀 ⭐⭐⭐⭐⭐EXCLUSIF: COURS 25-26 - Ressources d\'élite par Amine (Best in INSAT).', '2025-2026'),
(24, 1, 'Drive DALI (En fin 7sol!)', 'https://drive.google.com/drive/folders/1OmWSWTxnbkrxkyCDkULAq-ABtr0jBJCY?usp=drive_link', '🔥 ⭐⭐⭐⭐⭐ NOUVEAUTÉS 25-26: Plusieurs ressources Prépa MSI - Series Unique & Exclusivités.', '2025-2026'),
(25, 1, 'DEVOIRS INSAT (Ultra Essential)', 'https://drive.google.com/drive/folders/1W8sryJbh382XNINEiK1JILZ1x40zgLK3', '💎 SPECIAL DRIVE (MOST IMPORTANT) - La collection ultime des devoirs et examens INSAT (3000-4000 Resources).', '3000-4000');

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT 'fas fa-book'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `icon`) VALUES
(1, 'MPI General', '#6366f1'),
(2, 'CIRCUIT ÉLECTRIQUE', '#6366f1'),
(3, 'OPTIQUE', '#ec4899'),
(4, 'ANALYSE 1', '#8b5cf6'),
(5, 'ALGÈBRE 1', '#06b6d4'),
(6, 'ÉLECTROSTATIQUE', '#f59e0b'),
(7, 'MSI', '#10b981'),
(8, 'ALGO / PROG', '#ef4444');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') DEFAULT 'student',
  `profile_pic` varchar(255) DEFAULT 'default-avatar.png',
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`, `profile_pic`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Aziz Ayari', 'azizaskander30@gmail.com', '$2y$10$LGYToMoWWF9XmsWl8Fu18enjJPDfUs.TOO.weBlLOXISeyiSHs8Ne', 'student', 'default-avatar.png', NULL, '2026-03-13 23:55:55', '2026-03-13 23:55:55');

-- --------------------------------------------------------

--
-- Structure de la table `youtube_videos`
--

CREATE TABLE `youtube_videos` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `video_title` varchar(255) DEFAULT NULL,
  `video_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `youtube_videos`
--

INSERT INTO `youtube_videos` (`id`, `subject_id`, `video_title`, `video_id`) VALUES
(10, 2, 'Lois de Kirchhoff (Nœuds et Mailles)', 'https://youtu.be/0Ct-za8M7vI?si=akJqHgrUgpWg9pXH'),
(11, 2, 'Théorème de Thévenin', 'https://youtu.be/ouvM1t5CFas?si=erOv8X-xpDZNdJZS'),
(12, 2, 'Théorème de Norton', 'https://youtu.be/BDIuzE4o6DY?si=cWAwYK6QQP-5gnvS'),
(13, 2, 'Théorème de Superposition', 'https://youtu.be/qxkGMryMHwQ?si=xUQM2Iloe7cXQFRD'),
(14, 2, 'Pont Diviseur de Tension et Courant', 'https://youtu.be/OfcyC9gBkH8?si=vh7KUWY2Z007Nfbv'),
(15, 2, 'Théorème de Millman', 'https://youtu.be/3txcbm-lx6c?si=d4feEfCyAJBzek_n'),
(16, 2, 'Puissance en Régime Sinusoïdal', 'https://youtu.be/TL_98zHyXOM?si=drOs9OTYigNMkeQQ'),
(17, 2, 'Circuit RLC et Résonance', 'https://youtu.be/lagfhNjMuQM?si=UAiOkF3bLsNrwaJG'),
(42, 3, 'Playlist Complète : Optique Géométrique', 'https://youtube.com/playlist?list=PL9niwmraVUM7IfjFp8LMs7zbe-nESb6ku&si=7GiCSs44ETTkmDp8'),
(43, 4, 'Playlist : Les Nombres Réels (Analyse)', 'https://youtube.com/playlist?list=PL7FE0CECE4B4C0FB8&si=oVYMTfhEusCW-vo1'),
(44, 4, 'Playlist: Limite et Continuité', 'https://youtube.com/playlist?list=PL02B78D753AFA8098&si=VFlAjYzRvb0uhG1i'),
(45, 4, 'Playlist : Fonctions Usuelles', 'https://youtube.com/playlist?list=PL024XGD7WCIHb3odpeugIJ9SiKXOyH2TB&si=J2QDez8pQ_9RvJHh'),
(46, 4, 'Playlist : Développements Limités', 'https://youtube.com/playlist?list=PL024XGD7WCIHHlscC-_sfMgKyoeiGSixj&si=jEQ5UwSvCiab3smy'),
(47, 5, 'Playlist : Polynômes (Cours et Exercices)', 'https://youtube.com/playlist?list=PLE8WtfrsTAiknXlSqHSB4rocWnll9CNPe&si=xAx9hv7if0b2qxBD'),
(48, 5, 'Playlist : Algèbre - Notions de Base', 'https://youtube.com/playlist?list=PL6690366268FBF2C0&si=FH4rdXFsydYgwiQp'),
(49, 5, 'Playlist : Théorie des Groupes', 'https://youtube.com/playlist?list=PLE8WtfrsTAim72NPlHds3N_4dqNwBMv1j&si=YDXTSqwNMkLIWxa8'),
(50, 5, 'Cours : Structures Algébriques (Groupes, Anneaux, Corps)', 'https://www.youtube.com/watch?v=09BuX_XmNtM&list=PLE8WtfrsTAikFDNHujYvKStrEB5wEglmb'),
(51, 6, 'Playlist : Électrostatique (Cours et Exercices)', 'https://www.youtube.com/watch?v=QerVS5dAXIM&list=PL9niwmraVUM542ucj12FiGZLZaXlOFuuo'),
(52, 6, 'Playlist : Électrocinétique et Circuits', 'https://www.youtube.com/watch?v=yIsl1qSI4nE&list=PLIlsLCejddaNVA1gzunLShpqAHDIVGluT'),
(53, 7, 'Cours : Maintenance et Sécurité Informatique (MSI)', 'https://youtu.be/ZANoDxeZdlI?si=MpAxE40NF-QMHnfe'),
(54, 7, 'drive taki', 'https://youtu.be/sP5f9kSc2QM'),
(55, 8, 'Playlist : Algorithmique et Structures de Données (Langage C)', 'https://www.youtube.com/watch?v=I4U0sQDw5Nw&list=PLZpzLuUp9qXxKSkKT43ppqzb8c2ahO4VS'),
(56, 8, 'Playlist : Algorithmique et Structures de Données', 'https://youtube.com/playlist?list=PLZPZq0r_RZOOzY_vR4zJM32SqsSInGMwe&si=S1wuYDCOkqdR7S6S');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `drive_links`
--
ALTER TABLE `drive_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Index pour la table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- Index pour la table `youtube_videos`
--
ALTER TABLE `youtube_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `drive_links`
--
ALTER TABLE `drive_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `youtube_videos`
--
ALTER TABLE `youtube_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `drive_links`
--
ALTER TABLE `drive_links`
  ADD CONSTRAINT `drive_links_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `youtube_videos`
--
ALTER TABLE `youtube_videos`
  ADD CONSTRAINT `youtube_videos_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
