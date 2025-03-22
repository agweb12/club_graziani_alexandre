-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 06 mars 2025 à 15:44
-- Version du serveur : 8.0.30
-- Version de PHP : 8.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `club_graziani_alexandre`
--
CREATE DATABASE IF NOT EXISTS `club_graziani_alexandre` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `club_graziani_alexandre`;

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id_joueur` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `nom`, `prenom`, `email`, `mdp`) VALUES
(1, 'graziani', 'Alexandre', 'graziani1112@gmail.com', '$2y$12$ay.5oEjXCXDYxnyHuH40KOUdWUgg5vGwNtvlwyaG9qb6q3kVDNn82'),
(3, 'Cavet', 'Alexandre', 'cavet@gmail.com', '$2y$12$Rx9pHmPmCOTpQO9kQoPx.uQtjmbJzuIdueXrgK4RQgsqIL4zVPF5a'),
(4, 'Fourati', 'Islem', 'islem.fourati@colombbus.org', '$2y$12$/40YcuG97tTeFVhvpBKu4uiimN03e7izufhDj3OscFQjwqIYNOIua'),
(5, 'Chied', 'Ouarda', 'ouarda.chied@colombbus.org', '$2y$12$aTCoir7J769/BuRvxIbJDekJX6EjQvtIwAwEiKXRmaNRsgjVeY2Gq');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id_joueur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
