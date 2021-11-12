-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 nov. 2021 à 03:01
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dev-masters`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moyen_de_transport`
--

CREATE TABLE `moyen_de_transport` (
  `id` int(11) NOT NULL,
  `ref` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_mt` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accessible_handicap` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `moyen_de_transport`
--

INSERT INTO `moyen_de_transport` (`id`, `ref`, `type_mt`, `accessible_handicap`) VALUES
(1, '654', 'Bus', 1);

-- --------------------------------------------------------

--
-- Structure de la table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `ref_station` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_station` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_station` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `station`
--

INSERT INTO `station` (`id`, `ref_station`, `nom_station`, `position_station`) VALUES
(1, '12ab', 'Sousse', '144557,12345'),
(2, '123abc', 'Monastir', 'aze'),
(3, 'azeaze', 'Sfax', 'aze'),
(4, 'aze', 'Beja', 'aze'),
(5, 'abbc', 'Tunis', '144557,12345');

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

CREATE TABLE `voyage` (
  `id` int(11) NOT NULL,
  `station_depart_id` int(11) NOT NULL,
  `station_arrive_id` int(11) NOT NULL,
  `moyen_de_transport_id` int(11) NOT NULL,
  `ref_voyage` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ligne` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `date_depart` datetime NOT NULL,
  `date_arrive` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`id`, `station_depart_id`, `station_arrive_id`, `moyen_de_transport_id`, `ref_voyage`, `ligne`, `date_depart`, `date_arrive`) VALUES
(8, 1, 2, 1, 'amine', 'a:0:{}', '2016-01-01 00:00:00', '2016-01-01 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `moyen_de_transport`
--
ALTER TABLE `moyen_de_transport`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1E6E5727146F3EA3` (`ref`);

--
-- Index pour la table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9F39F8B15B2DAB61` (`ref_station`);

--
-- Index pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3F9D89554A84E1AC` (`ref_voyage`),
  ADD UNIQUE KEY `UNIQ_3F9D89552C869050` (`station_depart_id`),
  ADD UNIQUE KEY `UNIQ_3F9D89557686E853` (`station_arrive_id`),
  ADD KEY `UNIQ_3F9D89554B31287` (`moyen_de_transport_id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `moyen_de_transport`
--
ALTER TABLE `moyen_de_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `FK_3F9D89552C869050` FOREIGN KEY (`station_depart_id`) REFERENCES `station` (`id`),
  ADD CONSTRAINT `FK_3F9D89554B31287` FOREIGN KEY (`moyen_de_transport_id`) REFERENCES `moyen_de_transport` (`id`),
  ADD CONSTRAINT `FK_3F9D89557686E853` FOREIGN KEY (`station_arrive_id`) REFERENCES `station` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
