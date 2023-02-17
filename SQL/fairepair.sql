-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 22 Septembre 2021 à 12:29
-- Version du serveur :  5.6.37
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fairepair`
--

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

CREATE TABLE IF NOT EXISTS `commenter` (
  `id` int(11) NOT NULL,
  `date_commentaire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `score` int(11) DEFAULT '0',
  `id_client` int(11) NOT NULL,
  `id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `id` int(11) NOT NULL,
  `date_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_intervention` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `adresse_intervention` varchar(200) NOT NULL,
  `etat_intervention` varchar(50) DEFAULT 'ENVOYEE',
  `id_service` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `tarif` double NOT NULL,
  `rayon_intervention` float NOT NULL,
  `id_reparateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `codepostal` varchar(5) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `reparateur` tinyint(1) DEFAULT '0',
  `statut` varchar(20) DEFAULT 'CLIENT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_service` (`id_service`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_service` (`id_service`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reparateur` (`id_reparateur`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commenter`
--
ALTER TABLE `commenter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `commenter_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `commenter_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`id_reparateur`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
