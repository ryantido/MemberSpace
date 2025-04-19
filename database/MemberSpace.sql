-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 19 avr. 2025 à 21:39
-- Version du serveur : 8.0.41-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `PHP-INIT`
--

-- --------------------------------------------------------

--
-- Structure de la table `MemberSpace`
--

CREATE TABLE `MemberSpace` (
  `id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `token` varchar(20) NOT NULL,
  `role` enum('admin','employee','secretary','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` text NOT NULL,
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `is_valid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `MemberSpace`
--

INSERT INTO `MemberSpace` (`id`, `firstname`, `lastname`, `email`, `password`, `token`, `role`, `phone`, `agree`, `is_valid`, `created_at`, `update_at`) VALUES
(1, 'Lamine', 'Yamal', 'ViscaBarcelona@español.com', '$2y$10$c9FSkAbFfPhlkg4fPlEMCu81dMRH/elrMT6ws8P4eLDkHBlVUiTWO', 'valid', 'admin', '0123456789', 0, 1, '2024-12-28 15:06:23', '2025-04-17 22:54:40'),
(2, 'Arthur', 'stiller', 'princearthur34@gmail.com', '$2y$10$c9FSkAbFfPhlkg4fPlEMCu81dMRH/elrMT6ws8P4eLDkHBlVUiTWO', 'valid', 'admin', '699506071', 0, 1, '2024-12-29 20:06:48', '2025-04-17 22:57:11'),
(3, 'Pep', 'Garduola', 'GarduolaCitizen@machester.en', '$2y$10$c9FSkAbFfPhlkg4fPlEMCu81dMRH/elrMT6ws8P4eLDkHBlVUiTWO', 'kh3hj$al0zifZ', 'employee', '0123456789', 0, 0, '2024-12-28 15:30:31', '2025-02-24 23:22:57'),
(4, 'Markov', 'Nikov', 'markov@nikov.com', '$2y$10$c9FSkAbFfPhlkg4fPlEMCu81dMRH/elrMT6ws8P4eLDkHBlVUiTWO', 'valid', 'admin', '689898787', 1, 1, '2024-12-29 22:21:18', '2025-04-19 13:22:28'),
(5, 'Marquinhos', 'Paris', 'intermiami#1@gmail.com', '$2y$10$PkgOV8OAssAelPgozN5b.uqfCaWB8sg2MwaJIS2JFJy7wqQS38Xz6', 'valid', 'employee', '689898787', 0, 1, '2025-04-17 22:25:49', '2025-04-17 21:26:06'),
(6, 'Pepsi', 'Stein', 'mrSTein@gmail.fr', '$2y$10$V23/JeVDYcUdJuQFXRKRUudB8bHF0gZEIQ60gAgrya2rfWzMigVAm', 'valid', 'admin', '689898787', 1, 1, '2025-04-19 16:52:40', '2025-04-19 15:57:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `MemberSpace`
--
ALTER TABLE `MemberSpace`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `MemberSpace`
--
ALTER TABLE `MemberSpace`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
