-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 04 avr. 2022 à 09:26
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `repairbike`
--
CREATE DATABASE IF NOT EXISTS `repairbike` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `repairbike`;

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDemande` ()  BEGIN
DECLARE id_d INT;
DECLARE date_d TIMESTAMP;
DECLARE etat_d varchar(10);
DECLARE curs1 CURSOR FOR SELECT id,date_intervention,etat_intervention  FROM demande;
  OPEN curs1;
  read_loop: LOOP
    FETCH curs1 INTO id_d,date_d,etat_d;
    if etat_d='ENVOYEE' and date_d<CURRENT_TIMESTAMP THEN
    update demande set etat_intervention='REFUSEE' where id= id_d;
    end if;
     if etat_d='VALIDEE' and date_d<CURRENT_TIMESTAMP THEN
    update demande set etat_intervention='TERMINEE' where id= id_d;
    end if;
  END LOOP;
  CLOSE curs1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `archivedemande`
--

CREATE TABLE `archivedemande` (
  `id` int(11) NOT NULL,
  `date_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_intervention` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse_intervention` varchar(200) NOT NULL,
  `etat_intervention` varchar(50) DEFAULT 'ENVOYEE',
  `id_service` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `message` varchar(100) DEFAULT NULL,
  `tarif_demande` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `archivedemande`
--

INSERT INTO `archivedemande` (`id`, `date_demande`, `date_intervention`, `adresse_intervention`, `etat_intervention`, `id_service`, `id_client`, `message`, `tarif_demande`) VALUES
(56, '2021-10-28 09:32:58', '2021-10-29 12:32:00', '510 route de voisenon 77000 Maincy', 'TERMINEE', 30, 8, 'Renouvellement', 70),
(59, '2021-10-28 09:35:08', '2021-10-29 15:35:00', '73 rue de Romainville 75019 Paris', 'ENVOYEE', 29, 9, '3', 50),
(61, '2021-10-28 09:51:13', '2021-10-28 13:51:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 30, 8, '5', 70),
(62, '2021-10-28 10:13:43', '2021-10-29 16:13:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 45, 8, 'test', 15),
(63, '2021-10-28 12:56:35', '2021-10-31 18:56:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 30, 8, 'C bon ????', 50),
(64, '2021-12-07 08:35:39', '2021-12-08 11:39:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 30, 8, 'TEST', 50),
(65, '2021-12-07 08:36:59', '2021-12-08 11:39:00', '510 route de voisenon 77000 Maincy', 'TERMINEE', 30, 8, 'TEST1', 50),
(66, '2021-12-07 08:37:25', '2021-12-08 11:39:00', '73 rue de Romainville 75019 PARIS', 'ENVOYEE', 30, 8, 'TEST2', 50),
(67, '2021-12-07 08:43:08', '2021-12-08 11:39:00', '510 route de voisenon 77000 Maincy', 'TERMINEE', 30, 8, 'TEST2', 50),
(68, '2021-12-07 08:44:09', '2021-12-02 12:47:00', '73 rue de Romainville 75015 Paris', 'ENVOYEE', 46, 8, 'TEST3', 10),
(69, '2021-12-07 08:51:18', '2021-12-16 15:50:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 46, 8, 'TEST3', 10),
(70, '2021-12-07 08:57:32', '2021-12-09 10:00:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 30, 8, 'test', 50),
(71, '2021-12-07 09:02:35', '2021-12-03 10:01:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 30, 8, 'test3', 50),
(72, '2021-12-07 09:51:29', '2021-12-03 09:49:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 30, 8, 'TEST3', 50),
(73, '2021-12-07 09:53:30', '2021-12-03 09:49:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 30, 8, 'TEST3', 50),
(74, '2021-12-07 10:04:30', '2021-12-17 09:49:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 30, 8, 'coucou ', 50),
(75, '2021-12-08 08:01:46', '2021-12-09 08:01:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 30, 8, 'C bon ????', 50),
(76, '2021-12-08 08:41:07', '2021-12-13 08:02:00', '73 rue de Romainville 75019 PARIS', 'ENVOYEE', 30, 8, 'C bon ????', 50),
(77, '2021-12-08 08:43:16', '2021-12-09 11:45:00', '73 rue de Romainville 75019 PARIS', 'ENVOYEE', 30, 8, 'TEST3', 50),
(78, '2021-12-08 08:45:14', '2021-12-09 08:46:00', '510 route de voisenon 77000 Maincy', 'ENVOYEE', 30, 8, 'TEST3', 50),
(79, '2021-12-08 08:46:03', '2021-12-09 10:45:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 30, 8, 'TEST3', 50),
(80, '2021-12-08 14:26:12', '2021-12-09 21:34:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 30, 8, 'coucou', 50),
(81, '2021-12-08 14:27:53', '2021-12-18 21:34:00', '510 route de jhh 77000 Maincy', 'REFUSEE', 30, 8, 'coucou', 50),
(82, '2021-12-14 09:52:05', '2021-12-15 12:51:00', '5 rue gasperi', 'REFUSEE', 30, 8, 'sqfqf', 50),
(83, '2022-01-14 13:48:27', '2022-01-23 17:53:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 30, 8, 'coucou', 50),
(84, '2022-02-23 13:19:38', '2022-02-27 21:32:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 48, 8, 'test', 25),
(86, '2022-03-30 09:34:34', '2022-03-30 09:34:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 48, 8, 'cc', 25),
(87, '2022-03-30 09:39:16', '2022-03-30 09:39:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 48, 8, 'cc', 25);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id` int(11) NOT NULL,
  `date_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_intervention` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse_intervention` varchar(200) NOT NULL,
  `etat_intervention` varchar(50) DEFAULT 'ENVOYEE',
  `id_service` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `message` varchar(100) DEFAULT NULL,
  `tarif_demande` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id`, `date_demande`, `date_intervention`, `adresse_intervention`, `etat_intervention`, `id_service`, `id_client`, `message`, `tarif_demande`) VALUES
(57, '2021-10-28 09:34:37', '2021-10-28 13:38:00', '73 rue de Romainville 75019 Paris', 'TERMINEE', 29, 9, '1', 50),
(58, '2021-10-28 09:34:51', '2021-10-29 14:34:00', '73 rue de Romainville 75019 Paris', 'TERMINEE', 42, 9, '2', 40),
(60, '2021-10-28 09:50:00', '2021-10-29 14:55:00', '73 rue de Romainville 75019 Paris', 'TERMINEE', 29, 9, '4', 70),
(85, '2022-03-23 10:57:48', '2022-03-24 14:02:00', '73 rue de Romainville 75019 Paris', 'TERMINEE', 29, 38, 'cc', 70),
(88, '2022-03-30 09:40:25', '2022-03-30 09:40:00', '510 route de voisenon 77000 Maincy', 'REFUSEE', 48, 8, 'cc', 25),
(89, '2022-04-04 09:00:27', '2022-04-14 12:04:00', '73 rue de Romainville 75019 Paris', 'VALIDEE', 29, 9, 'cc', 70);

--
-- Déclencheurs `demande`
--
DELIMITER $$
CREATE TRIGGER `archiveDem` BEFORE DELETE ON `demande` FOR EACH ROW BEGIN
  INSERT INTO archiveDemande SELECT * FROM demande WHERE id=OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteDemande` BEFORE DELETE ON `demande` FOR EACH ROW BEGIN
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `reparateur_gain`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `reparateur_gain` (
`nom` varchar(50)
,`sum(demande.tarif_demande)` double
,`U_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `S_id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `tarif` double NOT NULL,
  `rayon_intervention` float NOT NULL,
  `id_reparateur` int(11) NOT NULL,
  `img` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`S_id`, `titre`, `description`, `tarif`, `rayon_intervention`, `id_reparateur`, `img`) VALUES
(29, 'RÉPARATION DU FREINAGE', 'Je sais aussi réparer les sièges ainsi que les pneus', 70, 5, 8, 'img/freinage.jpg'),
(42, 'RÉPARATION DES PHARES', 'Je sais réparer des sièges et aussi des pneus', 50, 10, 8, 'img/png3.png'),
(46, 'RÉPARATION DES PNEUS', '', 10, 3, 45, 'img/png2-600x600.png'),
(48, 'RÉPARATION DES PHARES', 'Je sais réparer tous les vélos également des vélos anciens', 25, 3, 9, 'img/png4-600x600.png'),
(49, 'REPARATION DU VÉLO ELECTRIQUE', 'je sais reparer', 60, 10, 8, 'img/png1.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `U_id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tel` varchar(10) NOT NULL,
  `codepostal` varchar(5) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `reparateur` tinyint(1) DEFAULT '0',
  `statut` varchar(20) DEFAULT 'CLIENT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`U_id`, `nom`, `prenom`, `email`, `mdp`, `tel`, `codepostal`, `ville`, `adresse`, `latitude`, `longitude`, `reparateur`, `statut`) VALUES
(8, 'Gervais', 'Inès', 'gervaisines@gmail.com', '$5$rounds=5000$usesomesillystri$NiHLsMQsOUSx.Yuhrc2x/yweqSXOCBEOqmTYEjEiAU8', '0686326400', '75019', 'Paris', '73 rue de Romainville', '48.890614', '2.386708', 1, 'CLIENT'),
(9, 'Franco ', 'Raphael', 'raphael@gmail.com', '$5$rounds=5000$usesomesillystri$1asiMidaTwfEYnrFFSFjhLTqNUgEZgi.tT7IQCmxdP9', '0686326401', '77000', 'Maincy', '510 route de voisenon', '48.549769', '2.701063', 1, 'CLIENT'),
(14, 'Charbonnier', 'Manon', 'manon@gmail.com', '$5$rounds=5000$usesomesillystri$1asiMidaTwfEYnrFFSFjhLTqNUgEZgi.tT7IQCmxdP9', '0686326400', '12349', 'Inconnu', '43 rue de Merlin', '0.000000', '0.000000', 1, 'CLIENT'),
(17, 'Leblond', 'Camille', 'camille@gmail.com', '$5$rounds=5000$usesomesillystri$1asiMidaTwfEYnrFFSFjhLTqNUgEZgi.tT7IQCmxdP9', '0634251323', '12345', 'Inconnu', '12 rue de Inconnu', '0.000000', '0.000000', 1, 'CLIENT'),
(19, 'Gervais', 'Inès', 'gervaisines1@gmail.com', '$5$rounds=5000$usesomesillystri$1asiMidaTwfEYnrFFSFjhLTqNUgEZgi.tT7IQCmxdP9', '0686326400', '75019', 'Paris', '73 rue de Romainville', '0.000000', '0.000000', 1, 'CLIENT'),
(32, 'Gervais', 'Elisabeth', 'maman@gmail.com', '$5$rounds=5000$usesomesillystri$1asiMidaTwfEYnrFFSFjhLTqNUgEZgi.tT7IQCmxdP9', '0686326400', '75019', 'Paris', '73 rue de Romainville', '0.000000', '0.000000', 0, 'CLIENT'),
(33, 'Hapouki', 'Mélanie', 'melanie@gmail.com', '$5$rounds=5000$usesomesillystri$1asiMidaTwfEYnrFFSFjhLTqNUgEZgi.tT7IQCmxdP9', '0634251323', '75005', 'Paris', '12 rue de Lourmel', '0.000000', '0.000000', 0, 'CLIENT'),
(38, 'Hapouki', 'Mélanie', 'test@gmail.com', '$5$rounds=5000$usesomesillystri$NiHLsMQsOUSx.Yuhrc2x/yweqSXOCBEOqmTYEjEiAU8', '0686326400', '75005', 'Paris', '12 rue de Lourmel', '48.843491', '2.351834', 1, 'CLIENT'),
(45, 'Gervais', 'Philippe', 'philippe@gmail.com', '$5$rounds=5000$usesomesillystri$k//QeXNRTt//T/Tsr7FtHKqL/aZ8uOEaDRvTeWyF2kD', '0634251323', '75015', 'Paris', '73 rue de Romainville', '48.842162', '2.292767', 1, 'CLIENT');

-- --------------------------------------------------------

--
-- Structure de la vue `reparateur_gain`
--
DROP TABLE IF EXISTS `reparateur_gain`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reparateur_gain`  AS  select `user`.`U_id` AS `U_id`,`user`.`nom` AS `nom`,sum(`demande`.`tarif_demande`) AS `sum(demande.tarif_demande)` from ((`user` join `demande`) join `service`) where ((`demande`.`etat_intervention` = 'TERMINEE') and (`demande`.`id_service` = `service`.`S_id`) and (`service`.`id_reparateur` = `user`.`U_id`)) group by `user`.`U_id` order by `user`.`U_id` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `archivedemande`
--
ALTER TABLE `archivedemande`
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
  ADD PRIMARY KEY (`S_id`),
  ADD KEY `id_reparateur` (`id_reparateur`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`U_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_3` (`email`),
  ADD KEY `email_2` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `archivedemande`
--
ALTER TABLE `archivedemande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `S_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `U_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `user` (`U_id`),
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`S_id`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`id_reparateur`) REFERENCES `user` (`U_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
