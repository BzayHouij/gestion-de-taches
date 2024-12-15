-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 déc. 2024 à 22:31
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_taches`
--

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_limite` date DEFAULT NULL,
  `statut` enum('en_cours','fait') DEFAULT 'en_cours',
  `utilisateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`id`, `titre`, `description`, `date_limite`, `statut`, `utilisateur_id`) VALUES
(2, 'Groupe 2', 'gros menage', '2024-12-12', 'en_cours', 3),
(3, 'GROUPE A', 'ranger les tableau', '2024-12-21', '', 7),
(4, 'tache 2', 'azertty', '2024-12-17', '', 7),
(5, 'tache 3', 'jeter la poubelle', '2024-12-27', '', 1),
(6, 'tache deux', 'fefef', '2024-12-18', '', 1),
(7, 'tache5', 'saluation', '2024-12-14', 'en_cours', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','utilisateur') DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `mot_de_passe`, `role`) VALUES
(1, 'ali lahouij', 'bzayhouij@gmail.com', '$2y$10$b7PCo8JSglDP301BTKHRIuTtteimUEavAbrOqZbvA35IQt78hCG3e', 'utilisateur'),
(2, 'Admin', 'admin@example.com', 'motdepasse', 'admin'),
(3, 'zigo mrar', 'iyooo@fs.com', '$2y$10$kT25tjuJa7CcGQHWZBQSmONW5qhRVtQeHCGaIxgeMCWuRkb.tMwt.', 'utilisateur'),
(4, 'kiko', 'kiko@gmail.com', 'aliali', 'admin'),
(7, 'Admin', 'newadmin@example.com', '$2y$10$TuqITH7.5grCM3kF//tHoOmvlXZKZnCJYfZ6bCWN4XSRXgSmoGEiK', 'admin'),
(8, 'bipbop', 'bipbop@gmail.com', '$2y$10$M4F3982DTzwrUYgbQYh57ucXgJ2gETMDqPykbdlZFb0INCbESWTna', 'utilisateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `taches_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
