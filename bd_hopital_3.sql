-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2022 at 10:16 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_hopital_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_app`
--

DROP TABLE IF EXISTS `admin_app`;
CREATE TABLE IF NOT EXISTS `admin_app` (
  `cin_admin` char(8) NOT NULL,
  `nom_admin` varchar(20) DEFAULT NULL,
  `pnom_admin` varchar(20) DEFAULT NULL,
  `genre_admin` char(1) DEFAULT NULL,
  `email_admin` varchar(20) NOT NULL,
  PRIMARY KEY (`cin_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_app`
--

INSERT INTO `admin_app` (`cin_admin`, `nom_admin`, `pnom_admin`, `genre_admin`, `email_admin`) VALUES
('AX000001', 'TOUNSSI', 'Oussama', 'M', 'oussama@tounssi.com'),
('AX000002', 'El Kouhen', 'Nadia', 'F', 'nadia@el_kouhen.com'),
('AX000003', 'Bourras', 'Mohamed', 'M', 'Mohamed@bourras.com');

-- --------------------------------------------------------

--
-- Table structure for table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `num_ch` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_ch` varchar(30) DEFAULT NULL,
  `prix_ch` decimal(10,2) NOT NULL,
  `si_pris` char(1) DEFAULT 'N',
  PRIMARY KEY (`num_ch`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chambre`
--

INSERT INTO `chambre` (`num_ch`, `type_ch`, `prix_ch`, `si_pris`) VALUES
(1, 'Twin Sharing', '200.00', 'Y'),
(2, 'Premium Twin Sharing', '450.00', 'Y'),
(3, 'Deluxe Room', '570.50', 'Y'),
(4, 'Premium Deluxe', '750.50', 'Y'),
(5, 'Suite', '1110.50', 'Y'),
(6, 'Suite', '1110.50', 'Y'),
(7, 'Suite', '1110.50', 'Y'),
(8, 'Twin Sharing', '200.00', 'Y'),
(9, 'Deluxe Room', '570.50', 'Y'),
(10, 'Premium Twin Sharing', '450.00', 'N'),
(11, 'Premium Twin Sharing', '450.00', 'N'),
(12, 'Twin Sharing', '200.00', 'N'),
(13, 'Deluxe Room', '570.50', 'N'),
(14, 'Twin Sharing', '200.00', 'N'),
(15, 'Deluxe Room', '570.50', 'N'),
(16, 'Group Room', '150.50', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `dossier_medical`
--

DROP TABLE IF EXISTS `dossier_medical`;
CREATE TABLE IF NOT EXISTS `dossier_medical` (
  `num_dossier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cin_pt` char(8) DEFAULT NULL,
  PRIMARY KEY (`num_dossier`),
  UNIQUE KEY `cin_pt` (`cin_pt`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dossier_medical`
--

INSERT INTO `dossier_medical` (`num_dossier`, `cin_pt`) VALUES
(1, 'abc'),
(15, 'oook'),
(16, 'ooop'),
(13, 'test0'),
(14, 'test33'),
(17, 'test44');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalisation`
--

DROP TABLE IF EXISTS `hospitalisation`;
CREATE TABLE IF NOT EXISTS `hospitalisation` (
  `id_hosp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_lit` int(10) UNSIGNED DEFAULT NULL,
  `num_dossier` int(10) UNSIGNED DEFAULT NULL,
  `date_e_hosp` date DEFAULT NULL,
  `date_s_hosp` date DEFAULT NULL,
  PRIMARY KEY (`id_hosp`),
  KEY `fk_hosp_lit_id_lit` (`id_lit`),
  KEY `fk_hosp_dossier_num_dos` (`num_dossier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `infirmiere`
--

DROP TABLE IF EXISTS `infirmiere`;
CREATE TABLE IF NOT EXISTS `infirmiere` (
  `cin_inf` char(8) NOT NULL,
  `nom_inf` varchar(20) NOT NULL,
  `pnom_inf` varchar(20) NOT NULL,
  `genre_inf` char(1) DEFAULT NULL,
  `tel_inf` char(10) DEFAULT NULL,
  `email_inf` varchar(30) NOT NULL,
  `psw_inf` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cin_inf`),
  UNIQUE KEY `email_inf` (`email_inf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infirmiere`
--

INSERT INTO `infirmiere` (`cin_inf`, `nom_inf`, `pnom_inf`, `genre_inf`, `tel_inf`, `email_inf`, `psw_inf`) VALUES
('AE212770', 'Sanji', 'Vinsmoke', 'M', '0661293040', 'sanji@vinsmoke.com', '242'),
('AE212771', 'Nami', 'Nami', 'F', '0661293042', 'nami@nami.com', '442'),
('AE212772', 'le Roux', 'Shanks', 'M', '0661293043', 'le_roux@shanks.com', '224'),
('AE212773', 'Nico', 'Robin', 'F', '0661293044', 'nico@robin.com', '222'),
('AE212774', 'Roronoa', 'Zoro', 'M', '0661303041', 'roronoa@zoro.com', '444'),
('AE212775', 'D. Teach', 'Marshall', 'M', '0661293045', 'd_teach@marshall.com', '422'),
('AE212776', 'Gol D.', 'Roger', 'M', '0661293046', 'gol_d@roger.com', '424'),
('AE212777', 'Linlin', 'Charlotte', 'M', '0661293047', 'liinlin@charlotte.com', '124'),
('AU212778', 'Portgas D.', 'Ace', 'M', '0661293048', 'portgase_d@ace.com', '412'),
('AU212779', 'Quijote', 'Doflamingo', 'M', '0661293049', 'quijote@doflamingo.com', '411');

-- --------------------------------------------------------

--
-- Table structure for table `lit`
--

DROP TABLE IF EXISTS `lit`;
CREATE TABLE IF NOT EXISTS `lit` (
  `id_lit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `num_ch` int(10) UNSIGNED NOT NULL,
  `si_pris` char(1) DEFAULT 'N',
  PRIMARY KEY (`id_lit`),
  KEY `fk_num_ch` (`num_ch`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lit`
--

INSERT INTO `lit` (`id_lit`, `num_ch`, `si_pris`) VALUES
(1, 1, 'Y'),
(2, 1, 'Y'),
(3, 2, 'Y'),
(4, 2, 'Y'),
(5, 3, 'Y'),
(6, 4, 'Y'),
(7, 5, 'Y'),
(8, 6, 'Y'),
(9, 7, 'Y'),
(10, 8, 'Y'),
(11, 8, 'Y'),
(12, 9, 'Y'),
(13, 10, 'Y'),
(14, 10, 'Y'),
(15, 11, 'Y'),
(16, 11, 'Y'),
(17, 12, 'Y'),
(18, 12, 'Y'),
(19, 13, 'Y'),
(20, 14, 'N'),
(21, 14, 'N'),
(36, 15, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `maladie`
--

DROP TABLE IF EXISTS `maladie`;
CREATE TABLE IF NOT EXISTS `maladie` (
  `id_mal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_type_mal` int(10) UNSIGNED NOT NULL,
  `lbl_mal` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_mal`),
  KEY `fk_id_type_mal0` (`id_type_mal`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maladie`
--

INSERT INTO `maladie` (`id_mal`, `id_type_mal`, `lbl_mal`) VALUES
(1, 1, 'Asthme'),
(2, 1, 'Bronchite'),
(3, 1, 'Grippe A'),
(4, 1, 'Grippe Saisonniere'),
(5, 1, 'Étouffement'),
(6, 1, 'Bronchiolite'),
(7, 1, 'Grippe porcine'),
(8, 1, 'Légionellose'),
(9, 1, 'COVID-19'),
(10, 1, 'Cancer du poumon'),
(11, 1, 'Cancer de la gorge'),
(12, 2, 'Tuberculose ganglionnaire'),
(13, 2, 'Tuberculose urogénitale'),
(14, 2, 'Tuberculose ostéoarticulaire'),
(15, 2, 'Méningite tuberculeuse'),
(16, 2, 'Tuberculose cutanée'),
(17, 3, 'Distomatose'),
(18, 3, 'Isosporose'),
(19, 3, 'Myiase'),
(20, 3, 'Oxyurose'),
(21, 3, 'Scabiose'),
(22, 3, 'Toxocarose');

-- --------------------------------------------------------

--
-- Table structure for table `maladie_dossier`
--

DROP TABLE IF EXISTS `maladie_dossier`;
CREATE TABLE IF NOT EXISTS `maladie_dossier` (
  `num_dossier` int(10) UNSIGNED NOT NULL,
  `id_mal` int(10) UNSIGNED NOT NULL,
  `date_mal` date DEFAULT NULL,
  PRIMARY KEY (`num_dossier`,`id_mal`),
  KEY `fk_maladie` (`id_mal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `cin_med` char(8) NOT NULL,
  `id_spe` int(10) UNSIGNED NOT NULL,
  `nom_med` varchar(20) NOT NULL,
  `pnom_med` varchar(20) NOT NULL,
  `genre_med` char(1) DEFAULT NULL,
  `tel_med` char(10) DEFAULT NULL,
  `email_med` varchar(30) NOT NULL,
  PRIMARY KEY (`cin_med`),
  UNIQUE KEY `email_med` (`email_med`),
  KEY `fk_id_spe` (`id_spe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medecin`
--

INSERT INTO `medecin` (`cin_med`, `id_spe`, `nom_med`, `pnom_med`, `genre_med`, `tel_med`, `email_med`) VALUES
('AE112445', 1, '3o3o', 'Mehdi', 'F', '0661293031', '3o3o@mehdi.com'),
('AE112555', 1, 'AL GHAZALI', 'Mohammad', 'M', '0661293032', 'la_ghazali@mohammad.coom'),
('AE112770', 5, 'AMRANI', 'Mohammad', 'M', '0661293037', 'amrani@mohammad.com'),
('AE112771', 3, 'AL JILANI', 'Abdel Kader', 'M', '0661293034', 'al_jilani@abdelkader.com'),
('AE112773', 4, 'ALAMI', 'Ahmed', 'M', '0661293035', 'alami@ahmed.com'),
('AE112775', 5, 'EL HADI', 'NADA', 'F', '0661293036', 'elhadi@nada.com'),
('AE112777', 2, 'El Hadi', 'Nouha', 'F', '0661293033', 'elhadi@nouha.com'),
('AE123456', 1, 'ARIFAI', 'Ahmad', 'M', '0661293030', 'arifai@ahmed.com'),
('AU112771', 5, 'STRU HUT', 'Luffy', 'M', '0661293038', 'stru_hut@luffy.com'),
('AU112772', 7, 'GENJI', 'Agami', 'M', '0661293039', 'genji@agami.com'),
('AU112773', 7, 'SILVER', 'Fang', 'M', '0661293040', 'silver@fang.com'),
('AU112774', 7, 'ONSOKU', 'Sonic', 'M', '0661293041', 'onsoku@sonic.com');

-- --------------------------------------------------------

--
-- Table structure for table `medecin_service`
--

DROP TABLE IF EXISTS `medecin_service`;
CREATE TABLE IF NOT EXISTS `medecin_service` (
  `cin_med` char(8) NOT NULL,
  `date_serv` date NOT NULL,
  PRIMARY KEY (`cin_med`,`date_serv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medecin_service`
--

INSERT INTO `medecin_service` (`cin_med`, `date_serv`) VALUES
('AE112445', '2021-01-01'),
('AE112445', '2021-04-03'),
('AE112445', '2021-05-08'),
('AE112445', '2021-05-29'),
('AE112445', '2021-06-02'),
('AE112445', '2021-06-03'),
('AE112445', '2021-06-05'),
('AE112555', '2021-01-02'),
('AE112555', '2021-04-03'),
('AE112555', '2021-05-08'),
('AE112555', '2021-05-31'),
('AE112555', '2021-06-03'),
('AE112555', '2021-06-05'),
('AE112555', '2021-06-19'),
('AE112555', '2022-03-04'),
('AE112555', '2022-03-10'),
('AE112770', '2021-05-08'),
('AE112770', '2021-05-29'),
('AE112770', '2021-06-05'),
('AE112771', '2021-04-03'),
('AE112771', '2021-05-08'),
('AE112771', '2021-05-29'),
('AE112771', '2021-05-30'),
('AE112771', '2021-05-31'),
('AE112771', '2021-06-05'),
('AE112771', '2021-06-19'),
('AE112773', '2021-01-05'),
('AE112773', '2021-01-08'),
('AE112773', '2021-04-03'),
('AE112773', '2021-05-08'),
('AE112773', '2021-05-30'),
('AE112773', '2021-06-03'),
('AE112773', '2021-06-05'),
('AE112773', '2021-06-19'),
('AE112775', '2021-04-03'),
('AE112775', '2021-05-08'),
('AE112775', '2021-06-05'),
('AE112777', '2021-01-03'),
('AE112777', '2021-01-06'),
('AE112777', '2021-04-03'),
('AE112777', '2021-05-08'),
('AE112777', '2021-05-29'),
('AE112777', '2021-06-05'),
('AE123456', '2021-01-04'),
('AE123456', '2021-01-07'),
('AE123456', '2021-05-29'),
('AE123456', '2021-06-05'),
('AE123456', '2021-06-19'),
('AU112772', '2021-01-09'),
('AU112773', '2021-01-10'),
('AU112774', '2021-01-11'),
('AU112774', '2021-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `id_medi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prix_medi` decimal(10,2) NOT NULL,
  `lbl_medi` varchar(50) DEFAULT NULL,
  `genre_medi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_medi`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicament`
--

INSERT INTO `medicament` (`id_medi`, `prix_medi`, `lbl_medi`, `genre_medi`) VALUES
(1, '150.50', 'ABILIFY 10 MG', 'Comprimé'),
(2, '250.00', 'ABIRATERONE GT 250 MG', 'Comprimé'),
(3, '350.00', 'ACERUMEN', 'Flacon unidose'),
(4, '500.50', 'ACETATE', 'Concentré liquide hémodialyse'),
(5, '100.50', 'ACLASTA 5 MG / 100 ML', 'Solution pour perfusion'),
(6, '120.00', 'ACLAV 1 G / 125 MG', 'Sachet'),
(7, '200.00', 'ACLAV 1 G / 200 MG ADULTE', 'Suspension injectable'),
(8, '1200.00', 'ACNO 10 MG', 'Capsule molle'),
(9, '900.00', 'ZADITEN 1 MG / 5 ml', 'Sirop'),
(10, '700.00', 'ZAMOX 1 G / 125 MG', 'Sachet'),
(11, '200.00', 'ZANOCIN OD 400 MG', 'Comprimé pellicullé'),
(12, '150.00', 'FACTIVE 320 Mg', 'Comprimé pelliculé'),
(13, '8.00', 'DOLIPRANE 100 MG', 'Suppositoire'),
(14, '1200.00', 'D-STRESS', 'Comprimé'),
(15, '1500.00', 'DAIVONEX 50 µg/g', 'Crème');

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `id_op` int(10) UNSIGNED NOT NULL,
  `lbl_op` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_op`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` (`id_op`, `lbl_op`) VALUES
(1, 'laryngectomie'),
(2, 'lobotomie'),
(3, 'néphrectomie'),
(4, 'splénectomie'),
(5, 'trachéotomie');

-- --------------------------------------------------------

--
-- Table structure for table `operation_dossier`
--

DROP TABLE IF EXISTS `operation_dossier`;
CREATE TABLE IF NOT EXISTS `operation_dossier` (
  `id_op` int(10) UNSIGNED NOT NULL,
  `num_dossier` int(10) UNSIGNED NOT NULL,
  `date_op` date DEFAULT NULL,
  PRIMARY KEY (`id_op`,`num_dossier`),
  KEY `fk_op_dos_num_dos` (`num_dossier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `cin_pt` char(8) NOT NULL,
  `id_lit` int(10) UNSIGNED DEFAULT NULL,
  `nom_pt` varchar(20) DEFAULT NULL,
  `pnom_pt` varchar(20) DEFAULT NULL,
  `genre_pt` char(1) DEFAULT NULL,
  `date_n_pt` date DEFAULT NULL,
  `adresse_pt` varchar(50) DEFAULT NULL,
  `etat_pt` varchar(30) DEFAULT NULL,
  `date_entree` date DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `email_pt` varchar(30) DEFAULT NULL,
  `tel_pt` char(10) DEFAULT NULL,
  PRIMARY KEY (`cin_pt`),
  UNIQUE KEY `id_lit` (`id_lit`),
  UNIQUE KEY `email_pt` (`email_pt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`cin_pt`, `id_lit`, `nom_pt`, `pnom_pt`, `genre_pt`, `date_n_pt`, `adresse_pt`, `etat_pt`, `date_entree`, `date_sortie`, `email_pt`, `tel_pt`) VALUES
('abc', 15, 'abc', 'abc', 'F', '1998-06-06', NULL, 'Stable', '2022-02-02', NULL, 'eee@www.ma', '06025959'),
('oook', 17, 'abc', 'abc', 'M', '1998-06-06', NULL, 'Stable', NULL, NULL, 'eee@www.ok', '06025959'),
('ooop', 18, 'abc', 'abc', 'M', '1998-06-06', NULL, 'Stable', NULL, NULL, 'eee@www.ty', '06025959'),
('pt3', NULL, 'pt3 nom', 'pt3 pnom', 'M', '2003-03-03', NULL, NULL, NULL, NULL, 'pt3@pt3.com', '06100'),
('test', NULL, 'xyz', 'tuv', 'M', '1998-06-06', NULL, NULL, NULL, NULL, 'eee@www.com', '06025959'),
('test0', 14, 'abc', 'abc', 'M', '1998-06-06', NULL, 'Stable', NULL, NULL, 'eee@www.km', '06025959'),
('test33', 16, 'abc', 'abc', 'M', '1998-06-06', NULL, 'Stable', NULL, NULL, 'eee@www.hh', '06025959'),
('test44', 19, 'abc', 'abc', 'M', '1998-06-06', NULL, 'Stable', NULL, NULL, 'eee@www.ee', '06025959');

-- --------------------------------------------------------

--
-- Table structure for table `patient_infirmier`
--

DROP TABLE IF EXISTS `patient_infirmier`;
CREATE TABLE IF NOT EXISTS `patient_infirmier` (
  `cin_pt` char(8) NOT NULL,
  `cin_inf` char(8) NOT NULL,
  PRIMARY KEY (`cin_pt`,`cin_inf`),
  KEY `fk_cin_inf_x` (`cin_inf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_medecin`
--

DROP TABLE IF EXISTS `patient_medecin`;
CREATE TABLE IF NOT EXISTS `patient_medecin` (
  `cin_pt` char(8) NOT NULL,
  `cin_med` char(8) NOT NULL,
  PRIMARY KEY (`cin_med`,`cin_pt`),
  KEY `fk_cin_pt_01` (`cin_pt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_medecin`
--

INSERT INTO `patient_medecin` (`cin_pt`, `cin_med`) VALUES
('abc', 'AE112775'),
('oook', 'AE112775'),
('ooop', 'AE112775'),
('test', 'AE112775'),
('test0', 'AE112775'),
('test33', 'AE112775'),
('test44', 'AE112775');

-- --------------------------------------------------------

--
-- Table structure for table `patient_medicament`
--

DROP TABLE IF EXISTS `patient_medicament`;
CREATE TABLE IF NOT EXISTS `patient_medicament` (
  `cin_pt` char(8) NOT NULL,
  `id_medi` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`cin_pt`,`id_medi`),
  KEY `fk_id_medi2` (`id_medi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_traitement`
--

DROP TABLE IF EXISTS `patient_traitement`;
CREATE TABLE IF NOT EXISTS `patient_traitement` (
  `cin_pt` char(8) NOT NULL,
  `lbl_type_trai` varchar(30) NOT NULL,
  PRIMARY KEY (`cin_pt`,`lbl_type_trai`),
  KEY `fk_lbl_trai2` (`lbl_type_trai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recuperer_mdp`
--

DROP TABLE IF EXISTS `recuperer_mdp`;
CREATE TABLE IF NOT EXISTS `recuperer_mdp` (
  `id_q` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `txt_q` varchar(170) DEFAULT NULL,
  PRIMARY KEY (`id_q`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recuperer_mdp`
--

INSERT INTO `recuperer_mdp` (`id_q`, `txt_q`) VALUES
(1, 'Quel est le nom de famille de votre professeur d’enfance préféré ?'),
(2, 'Quel est le prénom de votre arrière-grand-mère maternelle ?'),
(3, 'Dans quelle ville se sont rencontrés vos parents ?'),
(4, 'Qu’est-ce vous vouliez devenir plus grand, lorsque vous étiez enfant ?'),
(5, 'Quel est le nom et prénom de votre premier amour ?');

-- --------------------------------------------------------

--
-- Table structure for table `rendez_vous`
--

DROP TABLE IF EXISTS `rendez_vous`;
CREATE TABLE IF NOT EXISTS `rendez_vous` (
  `id_rdv` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cin_pt` char(8) NOT NULL,
  `cin_med` char(8) NOT NULL,
  `date_rdv` date DEFAULT NULL,
  `heure_rdv` time DEFAULT NULL,
  `lbl_type_trai` varchar(30) NOT NULL,
  `confirme` char(1) DEFAULT 'Y',
  PRIMARY KEY (`id_rdv`),
  KEY `fk_cin_med_RDV` (`cin_med`),
  KEY `fk_cin_pt_RDV` (`cin_pt`),
  KEY `FK_lib_type_trai_rdv` (`lbl_type_trai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `id_spe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_spe` varchar(20) NOT NULL,
  PRIMARY KEY (`id_spe`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialite`
--

INSERT INTO `specialite` (`id_spe`, `lib_spe`) VALUES
(1, 'Cardiologie'),
(2, 'Dermatologie'),
(3, 'Gastro-entérologie'),
(4, 'Neurologie'),
(5, 'Oncologie'),
(6, 'Orthopédie'),
(7, 'ORL'),
(8, 'Pédiatrie'),
(9, 'Radiologie'),
(10, 'Pneumologie');

-- --------------------------------------------------------

--
-- Table structure for table `tomodensitometrie`
--

DROP TABLE IF EXISTS `tomodensitometrie`;
CREATE TABLE IF NOT EXISTS `tomodensitometrie` (
  `id_tomo` int(10) UNSIGNED NOT NULL,
  `lbl_tomo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tomo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tomodensitometrie`
--

INSERT INTO `tomodensitometrie` (`id_tomo`, `lbl_tomo`) VALUES
(1, 'cérébrale'),
(2, 'abdominale'),
(3, 'sinus'),
(4, 'conduit auditif interne'),
(5, 'massif facial');

-- --------------------------------------------------------

--
-- Table structure for table `tomodensitometrie_dossier`
--

DROP TABLE IF EXISTS `tomodensitometrie_dossier`;
CREATE TABLE IF NOT EXISTS `tomodensitometrie_dossier` (
  `id_tomo` int(10) UNSIGNED NOT NULL,
  `num_dossier` int(10) UNSIGNED NOT NULL,
  `date_tomo` date DEFAULT NULL,
  PRIMARY KEY (`id_tomo`,`num_dossier`),
  KEY `fk_tomo_dos_num_dos` (`num_dossier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_maladie`
--

DROP TABLE IF EXISTS `type_maladie`;
CREATE TABLE IF NOT EXISTS `type_maladie` (
  `id_type_mal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lbl_type_mal` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_type_mal`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_maladie`
--

INSERT INTO `type_maladie` (`id_type_mal`, `lbl_type_mal`) VALUES
(1, 'Respiratoire'),
(2, 'Infectieuse'),
(3, 'Parasitose'),
(4, 'Cardiaque'),
(5, 'Vasculaire'),
(6, 'systémiques'),
(7, 'Rhumatologique'),
(8, 'Neurologique'),
(9, 'Musculaire'),
(10, 'Psychiatrique'),
(11, 'hématologiques'),
(12, 'oculaire'),
(13, 'rénales'),
(14, 'urinaires'),
(15, 'génitales');

-- --------------------------------------------------------

--
-- Table structure for table `type_traitement`
--

DROP TABLE IF EXISTS `type_traitement`;
CREATE TABLE IF NOT EXISTS `type_traitement` (
  `lbl_type_trai` varchar(30) NOT NULL,
  `frai_trai` decimal(10,2) NOT NULL,
  PRIMARY KEY (`lbl_type_trai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_traitement`
--

INSERT INTO `type_traitement` (`lbl_type_trai`, `frai_trai`) VALUES
('chirurgie', '1500.00'),
('consultation', '300.00'),
('cryothérapie', '1550.50'),
('électrothérapie', '2300.50'),
('endoscopie', '570.50'),
('hydrothérapie', '2500.50'),
('luminothérapie', '2000.00'),
('médicamenteux', '350.50'),
('mesures hygiénodiététiques', '350.00'),
('oncologie physique', '300.50'),
('pharmacothérapie', '350.00'),
('photothérapie', '2500.00'),
('psychothérapie', '350.00'),
('radiologie interventionnelle', '505.00'),
('radiothérapie', '1500.50'),
('thermothérapie', '2100.50'),
('ultrasonothérapie', '2500.50');

-- --------------------------------------------------------

--
-- Table structure for table `type_vaccin`
--

DROP TABLE IF EXISTS `type_vaccin`;
CREATE TABLE IF NOT EXISTS `type_vaccin` (
  `id_type_vcc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lbl_type_vcc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_type_vcc`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_vaccin`
--

INSERT INTO `type_vaccin` (`id_type_vcc`, `lbl_type_vcc`) VALUES
(1, 'Inactivated'),
(2, 'Live-attenuated'),
(3, 'mRNA'),
(4, 'Toxoid'),
(5, 'Viral vector'),
(6, 'Subunit'),
(7, 'recombinant'),
(8, 'polysaccharide'),
(9, 'conjugate');

-- --------------------------------------------------------

--
-- Table structure for table `user_app`
--

DROP TABLE IF EXISTS `user_app`;
CREATE TABLE IF NOT EXISTS `user_app` (
  `email_user` varchar(20) NOT NULL,
  `psw_user` varchar(20) DEFAULT NULL,
  `type_user` varchar(20) DEFAULT NULL,
  `id_q` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `rep_q` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`email_user`),
  KEY `fk_id_q` (`id_q`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_app`
--

INSERT INTO `user_app` (`email_user`, `psw_user`, `type_user`, `id_q`, `rep_q`) VALUES
('3o3o@mehdi.com', '012', 'Medecin', 1, ''),
('burr@bill.com', '123', 'Patient', 1, 'Mme Sbiti'),
('eee@www.ee', '123', 'Patient', 1, ''),
('eee@www.ok', '123', 'Patient', 1, ''),
('eee@www.ty', '123', 'Patient', 1, ''),
('elhadi@nada.com', '123', 'Medecin', 1, ''),
('gol_d@roger.com', '424', 'Infirmier', 1, ''),
('joe@biden.com', '123', 'Admin', 1, ''),
('mai@sakurajima.com', '123', 'Patient', 1, ''),
('nadia@el_kouhen.com', '123', 'Admin', 1, ''),
('oussama@tounssi.com', '111', 'Admin', 1, ''),
('rio@futaba.com', '123', 'Patient', 1, ''),
('shoko@makinohara.com', '123', 'Patient', 1, ''),
('silver@fang.com', '123', 'Medecin', 3, 'Tokyo'),
('son@gohan.com', '222', 'Patient', 1, ''),
('son@goku.com', '123', 'Patient', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `vaccin`
--

DROP TABLE IF EXISTS `vaccin`;
CREATE TABLE IF NOT EXISTS `vaccin` (
  `id_vcc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_type_vcc` int(10) UNSIGNED NOT NULL,
  `lbl_vcc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_vcc`),
  KEY `fk_id_type_vcc0` (`id_type_vcc`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccin`
--

INSERT INTO `vaccin` (`id_vcc`, `id_type_vcc`, `lbl_vcc`) VALUES
(1, 1, 'diphtérie'),
(2, 1, 'tétanos'),
(3, 1, 'Poliomyélite'),
(4, 1, 'coqueluche'),
(5, 1, 'rougeole'),
(6, 2, 'oreillons'),
(7, 2, 'rubéole'),
(8, 2, 'Haemophilus influenzae B'),
(9, 3, 'hépatite B'),
(10, 3, 'pneumocoque'),
(11, 3, 'méningocoque C');

-- --------------------------------------------------------

--
-- Table structure for table `vaccin_dossier`
--

DROP TABLE IF EXISTS `vaccin_dossier`;
CREATE TABLE IF NOT EXISTS `vaccin_dossier` (
  `num_dossier` int(10) UNSIGNED NOT NULL,
  `id_vcc` int(10) UNSIGNED NOT NULL,
  `date_vcc` date DEFAULT NULL,
  PRIMARY KEY (`num_dossier`,`id_vcc`),
  KEY `fk_vaccin` (`id_vcc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dossier_medical`
--
ALTER TABLE `dossier_medical`
  ADD CONSTRAINT `fk_dossier_patient` FOREIGN KEY (`cin_pt`) REFERENCES `patient` (`cin_pt`);

--
-- Constraints for table `hospitalisation`
--
ALTER TABLE `hospitalisation`
  ADD CONSTRAINT `fk_hosp_dossier_num_dos` FOREIGN KEY (`num_dossier`) REFERENCES `dossier_medical` (`num_dossier`),
  ADD CONSTRAINT `fk_hosp_lit_id_lit` FOREIGN KEY (`id_lit`) REFERENCES `lit` (`id_lit`);

--
-- Constraints for table `lit`
--
ALTER TABLE `lit`
  ADD CONSTRAINT `fk_num_ch` FOREIGN KEY (`num_ch`) REFERENCES `chambre` (`num_ch`);

--
-- Constraints for table `maladie`
--
ALTER TABLE `maladie`
  ADD CONSTRAINT `fk_id_type_mal0` FOREIGN KEY (`id_type_mal`) REFERENCES `type_maladie` (`id_type_mal`);

--
-- Constraints for table `maladie_dossier`
--
ALTER TABLE `maladie_dossier`
  ADD CONSTRAINT `fk_maladie` FOREIGN KEY (`id_mal`) REFERENCES `maladie` (`id_mal`),
  ADD CONSTRAINT `fk_num_dossier2` FOREIGN KEY (`num_dossier`) REFERENCES `dossier_medical` (`num_dossier`);

--
-- Constraints for table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `fk_id_spe` FOREIGN KEY (`id_spe`) REFERENCES `specialite` (`id_spe`);

--
-- Constraints for table `medecin_service`
--
ALTER TABLE `medecin_service`
  ADD CONSTRAINT `fk_cin_med1` FOREIGN KEY (`cin_med`) REFERENCES `medecin` (`cin_med`);

--
-- Constraints for table `operation_dossier`
--
ALTER TABLE `operation_dossier`
  ADD CONSTRAINT `fk_op_dos_id_op` FOREIGN KEY (`id_op`) REFERENCES `operation` (`id_op`),
  ADD CONSTRAINT `fk_op_dos_num_dos` FOREIGN KEY (`num_dossier`) REFERENCES `dossier_medical` (`num_dossier`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `fk_id_lit` FOREIGN KEY (`id_lit`) REFERENCES `lit` (`id_lit`);

--
-- Constraints for table `patient_infirmier`
--
ALTER TABLE `patient_infirmier`
  ADD CONSTRAINT `fk_cin_inf_x` FOREIGN KEY (`cin_inf`) REFERENCES `infirmiere` (`cin_inf`),
  ADD CONSTRAINT `fk_cin_pt_02` FOREIGN KEY (`cin_pt`) REFERENCES `patient` (`cin_pt`);

--
-- Constraints for table `patient_medecin`
--
ALTER TABLE `patient_medecin`
  ADD CONSTRAINT `fk_cin_med2` FOREIGN KEY (`cin_med`) REFERENCES `medecin` (`cin_med`),
  ADD CONSTRAINT `fk_cin_pt_01` FOREIGN KEY (`cin_pt`) REFERENCES `patient` (`cin_pt`);

--
-- Constraints for table `patient_medicament`
--
ALTER TABLE `patient_medicament`
  ADD CONSTRAINT `fk_cin_pt_03` FOREIGN KEY (`cin_pt`) REFERENCES `patient` (`cin_pt`),
  ADD CONSTRAINT `fk_id_medi2` FOREIGN KEY (`id_medi`) REFERENCES `medicament` (`id_medi`);

--
-- Constraints for table `patient_traitement`
--
ALTER TABLE `patient_traitement`
  ADD CONSTRAINT `fk_cin_pt_04` FOREIGN KEY (`cin_pt`) REFERENCES `patient` (`cin_pt`),
  ADD CONSTRAINT `fk_lbl_trai2` FOREIGN KEY (`lbl_type_trai`) REFERENCES `type_traitement` (`lbl_type_trai`);

--
-- Constraints for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `FK_lib_type_trai_rdv` FOREIGN KEY (`lbl_type_trai`) REFERENCES `type_traitement` (`lbl_type_trai`),
  ADD CONSTRAINT `fk_cin_med_RDV` FOREIGN KEY (`cin_med`) REFERENCES `medecin` (`cin_med`),
  ADD CONSTRAINT `fk_cin_pt_RDV` FOREIGN KEY (`cin_pt`) REFERENCES `patient` (`cin_pt`);

--
-- Constraints for table `tomodensitometrie_dossier`
--
ALTER TABLE `tomodensitometrie_dossier`
  ADD CONSTRAINT `fk_tomo_dos_id_tomo` FOREIGN KEY (`id_tomo`) REFERENCES `tomodensitometrie` (`id_tomo`),
  ADD CONSTRAINT `fk_tomo_dos_num_dos` FOREIGN KEY (`num_dossier`) REFERENCES `dossier_medical` (`num_dossier`);

--
-- Constraints for table `user_app`
--
ALTER TABLE `user_app`
  ADD CONSTRAINT `fk_id_q` FOREIGN KEY (`id_q`) REFERENCES `recuperer_mdp` (`id_q`);

--
-- Constraints for table `vaccin`
--
ALTER TABLE `vaccin`
  ADD CONSTRAINT `fk_id_type_vcc0` FOREIGN KEY (`id_type_vcc`) REFERENCES `type_vaccin` (`id_type_vcc`);

--
-- Constraints for table `vaccin_dossier`
--
ALTER TABLE `vaccin_dossier`
  ADD CONSTRAINT `fk_num_dossier1` FOREIGN KEY (`num_dossier`) REFERENCES `dossier_medical` (`num_dossier`),
  ADD CONSTRAINT `fk_vaccin` FOREIGN KEY (`id_vcc`) REFERENCES `vaccin` (`id_vcc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
