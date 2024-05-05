-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 mars 2024 à 17:55
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
-- Base de données : `biblio`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prénom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `ID` int(11) NOT NULL,
  `ID_Membre` int(11) DEFAULT NULL,
  `ID_Livre` int(11) DEFAULT NULL,
  `Date_emprunt` date DEFAULT NULL,
  `Date_retour_prévue` date DEFAULT NULL,
  `Date_retour_effective` date DEFAULT NULL,
  `Statut_retour` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `ID` int(11) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL,
  `Auteur` varchar(255) DEFAULT NULL,
  `Catégorie` varchar(255) DEFAULT NULL,
  `Année_de_publication` int(11) DEFAULT NULL,
  `Résumé` text DEFAULT NULL,
  `Disponibilité` tinyint(1) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`ID`, `Titre`, `Auteur`, `Catégorie`, `Année_de_publication`, `Résumé`, `Disponibilité`, `Image`) VALUES
(7, 'Centrer sur jesus', 'christian Ondiyo', 'Roman', 1999, 'un bon sur la fiction', 1, 'Centrer sur jesus.png'),
(8, 'La prière', 'Perside Menayame', 'jule', 1999, 'cool', 1, 'La prière.png'),
(11, 'la force', 'joane', 'Roman', 1999, 'un bon livre', 1, 'la force.png');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prénom` varchar(255) DEFAULT NULL,
  `Adresse_email` varchar(255) DEFAULT NULL,
  `Mot_de_passe` varchar(255) DEFAULT NULL,
  `Date_inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`ID`, `Nom`, `Prénom`, `Adresse_email`, `Mot_de_passe`, `Date_inscription`) VALUES
(3, 'ONDIYO', 'CHRISTIAN', 'ondiyochristian10@gmail.com', '90969477f146f6152151fa2737151b07', '2024-03-05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
