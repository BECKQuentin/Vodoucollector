-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 20 avr. 2022 à 08:34
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vodoucollector`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` date DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pages` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notice` longtext COLLATE utf8mb4_unicode_ci,
  `rent_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `author`, `title`, `city`, `editor`, `year`, `quantity`, `pages`, `notice`, `rent_number`) VALUES
(14, 'ALBERT DE SURGY', 'La géomancie et le culte d\'Afa chez les Evhé du littoral', 'littoral PARIS', 'IS Publ. Orientalistes de France', '2017-03-02', '1', '444 P.', 'treter', 4),
(15, 'test', 'livre1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, 'livre 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(9, 'Bocio'),
(10, 'Mami Wata');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objects_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_63540594BEE6933` (`objects_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`id`, `objects_id`, `name`, `code`) VALUES
(2, 1, '22658_file_b.pdf', '22658_file_b'),
(4, 1, '22658_file_a.pdf', '22658_file_a'),
(7, 1, '22658_file_c.pdf', '22658_file_c'),
(9, 1, '22658_file_e.xlsx', '22658_file_e'),
(10, 1, '22658_file_f.xlsx', '22658_file_f');

-- --------------------------------------------------------

--
-- Structure de la table `floor`
--

DROP TABLE IF EXISTS `floor`;
CREATE TABLE IF NOT EXISTS `floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `floor`
--

INSERT INTO `floor` (`id`, `name`) VALUES
(1, 'RDC'),
(2, '1er'),
(3, '2eme'),
(5, '3eme');

-- --------------------------------------------------------

--
-- Structure de la table `gods`
--

DROP TABLE IF EXISTS `gods`;
CREATE TABLE IF NOT EXISTS `gods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gods`
--

INSERT INTO `gods` (`id`, `name`) VALUES
(1, 'Kokou'),
(2, 'Keléssi'),
(5, 'Abikou');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objects_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E01FBE6A4BEE6933` (`objects_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `objects_id`, `name`, `code`) VALUES
(98, 1, '22658_b.jpg', '22658_b'),
(100, 1, '22658_c.jpg', '22658_c'),
(101, 1, '22658_a.JPG', '22658_a');

-- --------------------------------------------------------

--
-- Structure de la table `librairies`
--

DROP TABLE IF EXISTS `librairies`;
CREATE TABLE IF NOT EXISTS `librairies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_319433ACB03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `librairies`
--

INSERT INTO `librairies` (`id`, `created_by_id`, `title`, `created_at`) VALUES
(1, NULL, 'FA GEOMANCIE', '2022-03-04 20:10:51'),
(2, NULL, 'VODOU D\'AFRIQUE ET D\'AMERIQUES', '2022-03-04 20:50:38'),
(4, NULL, 'ma nouvelle biblio', '2022-03-25 10:02:53'),
(5, NULL, 'FA GOR', '2022-03-25 10:10:04'),
(6, NULL, 'fff', '2022-03-31 12:27:09');

-- --------------------------------------------------------

--
-- Structure de la table `librairies_book`
--

DROP TABLE IF EXISTS `librairies_book`;
CREATE TABLE IF NOT EXISTS `librairies_book` (
  `librairies_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`librairies_id`,`book_id`),
  KEY `IDX_FDCEE16CB52A5368` (`librairies_id`),
  KEY `IDX_FDCEE16C16A2B381` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `librairies_book`
--

INSERT INTO `librairies_book` (`librairies_id`, `book_id`) VALUES
(1, 19),
(2, 19),
(4, 14);

-- --------------------------------------------------------

--
-- Structure de la table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materials`
--

INSERT INTO `materials` (`id`, `name`) VALUES
(1, 'bois'),
(2, 'os'),
(3, 'métal'),
(4, 'fer'),
(5, 'bronze');

-- --------------------------------------------------------

--
-- Structure de la table `objects`
--

DROP TABLE IF EXISTS `objects`;
CREATE TABLE IF NOT EXISTS `objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `quantity` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `era` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `historic_date` date DEFAULT NULL,
  `historic_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentary` longtext COLLATE utf8mb4_unicode_ci,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `weight` double DEFAULT NULL,
  `size_high` double DEFAULT NULL,
  `size_length` double DEFAULT NULL,
  `size_depth` double DEFAULT NULL,
  `state_commentary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_basemented` tinyint(1) DEFAULT NULL,
  `is_rent` tinyint(1) DEFAULT NULL,
  `is_exposed_temp` tinyint(1) DEFAULT NULL,
  `is_exposed_perm` tinyint(1) DEFAULT NULL,
  `showcase_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shelf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_date` date DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `sub_categories_id` int(11) DEFAULT NULL,
  `population_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `gods_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B21ACCF3896DBBDE` (`updated_by_id`),
  KEY `IDX_B21ACCF3A21214B7` (`categories_id`),
  KEY `IDX_B21ACCF36DBFD369` (`sub_categories_id`),
  KEY `IDX_B21ACCF3C955D1E1` (`population_id`),
  KEY `IDX_B21ACCF356A273CC` (`origin_id`),
  KEY `IDX_B21ACCF3A6E7D247` (`gods_id`),
  KEY `IDX_B21ACCF35D83CC1` (`state_id`),
  KEY `IDX_B21ACCF3854679E2` (`floor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objects`
--

INSERT INTO `objects` (`id`, `code`, `title`, `description`, `quantity`, `created_at`, `updated_at`, `era`, `updated_by_id`, `historic_date`, `historic_detail`, `commentary`, `remarks`, `weight`, `size_high`, `size_length`, `size_depth`, `state_commentary`, `is_basemented`, `is_rent`, `is_exposed_temp`, `is_exposed_perm`, `showcase_code`, `shelf`, `verification_date`, `categories_id`, `sub_categories_id`, `population_id`, `origin_id`, `gods_id`, `state_id`, `floor_id`) VALUES
(1, '22658', 'Objet de test 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.\r\n    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.\r\n    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.\r\n    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.\r\n    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.\r\n    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.\r\n    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus error est inventore libero magnam molestiae molestias voluptate voluptates! Consequatur eveniet facere fugiat illo inventore minima minus nobis quis soluta ullam.', 1, '2022-02-12 19:23:48', NULL, NULL, NULL, '2022-03-19', NULL, 'f', NULL, 12, 15, 12, 13, NULL, 0, 0, 0, 1, NULL, NULL, NULL, 9, NULL, NULL, NULL, 1, NULL, NULL),
(2, '55283', 'objets1', 'fsfsdfsdf', 1, '2021-04-02 09:41:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '58', '3', NULL, 9, NULL, NULL, NULL, 5, NULL, NULL),
(3, '55489', 'hurrnd', 'dfgdfgdfgdfgdfg dfg fd', 1, '2022-02-28 14:22:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(4, '55698', 'ghufsdffdssd', 'dsfdsfsd sdfsdfsdf', 1, '2021-04-02 09:41:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '55555', 'second objet', 'gdgdfg', 1, '2022-02-16 15:42:26', '2022-02-16 15:42:26', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '255', 'gfdgdf', 'gfdgdfg', 1, '2022-02-16 16:09:14', '2022-02-16 16:09:14', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '55', 'gdfgdf', 'gdfgdfg', 1, '2022-02-16 16:11:06', '2022-02-16 16:11:06', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2566', 'Barque de Esprits', 'ikndsfvsd sdfsd fsdfds', 1, '2022-02-16 16:12:07', '2022-02-16 16:12:07', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '2542', 'gvsdgsdf', 'fsdfs', 425, '2022-03-03 21:11:14', '2022-03-03 21:11:14', 'fsdf', NULL, '2017-01-01', 'fsdfsd', 'fsdfsdf', 'dsfsdf', 2542, 525, 2542, 2542, 'bvdvs', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '1518', 'testObject', 'fsfsf', 1, '2022-03-06 13:15:13', '2022-03-06 13:15:13', 'sfdsdf', NULL, '2018-01-13', 'fsdf', 'fsdfsd', 'fdggdfg', 14, 14, 14, 14, 'gdfg', 0, 0, NULL, NULL, NULL, NULL, NULL, 9, 8, NULL, NULL, 5, NULL, NULL),
(15, '1518', 'second objet', 'tdhg', 1, '2022-03-06 14:42:23', '2022-03-06 14:42:23', 'dgdfgdfg', NULL, '2019-02-14', 'gdfg', 'gfdgdf', 'dffdgdfgd', 14, 14, 141, 4141, 'gdfhdfg', 1, 0, NULL, NULL, NULL, NULL, NULL, 9, 9, 3, 1, 2, NULL, NULL),
(16, '15184', 'mon second objet', 'ma pseconde description', 1, '2022-03-07 18:38:14', '2022-03-07 18:38:14', '1856', NULL, '2017-01-15', 'don', 'ma fonction d\'usage', 'mes remarques', 14, 14, 14, 14, 'bon', 1, 0, NULL, NULL, NULL, NULL, NULL, 9, 8, 3, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `objects_gods`
--

DROP TABLE IF EXISTS `objects_gods`;
CREATE TABLE IF NOT EXISTS `objects_gods` (
  `objects_id` int(11) NOT NULL,
  `gods_id` int(11) NOT NULL,
  PRIMARY KEY (`objects_id`,`gods_id`),
  KEY `IDX_A5CBF32A4BEE6933` (`objects_id`),
  KEY `IDX_A5CBF32AA6E7D247` (`gods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objects_gods`
--

INSERT INTO `objects_gods` (`objects_id`, `gods_id`) VALUES
(2, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2);

-- --------------------------------------------------------

--
-- Structure de la table `objects_materials`
--

DROP TABLE IF EXISTS `objects_materials`;
CREATE TABLE IF NOT EXISTS `objects_materials` (
  `objects_id` int(11) NOT NULL,
  `materials_id` int(11) NOT NULL,
  PRIMARY KEY (`objects_id`,`materials_id`),
  KEY `IDX_299203044BEE6933` (`objects_id`),
  KEY `IDX_299203043A9FC940` (`materials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objects_materials`
--

INSERT INTO `objects_materials` (`objects_id`, `materials_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(16, 3),
(16, 4);

-- --------------------------------------------------------

--
-- Structure de la table `objects_tags`
--

DROP TABLE IF EXISTS `objects_tags`;
CREATE TABLE IF NOT EXISTS `objects_tags` (
  `objects_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL,
  PRIMARY KEY (`objects_id`,`tags_id`),
  KEY `IDX_C6D475924BEE6933` (`objects_id`),
  KEY `IDX_C6D475928D7B4FB4` (`tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objects_tags`
--

INSERT INTO `objects_tags` (`objects_id`, `tags_id`) VALUES
(1, 1),
(1, 2),
(10, 3),
(10, 4),
(10, 5),
(11, 3),
(11, 4),
(11, 6);

-- --------------------------------------------------------

--
-- Structure de la table `ojects`
--

DROP TABLE IF EXISTS `ojects`;
CREATE TABLE IF NOT EXISTS `ojects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5FD49DFC854679E2` (`floor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `origin`
--

DROP TABLE IF EXISTS `origin`;
CREATE TABLE IF NOT EXISTS `origin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `origin`
--

INSERT INTO `origin` (`id`, `name`) VALUES
(1, 'Togo'),
(2, 'Bénin');

-- --------------------------------------------------------

--
-- Structure de la table `population`
--

DROP TABLE IF EXISTS `population`;
CREATE TABLE IF NOT EXISTS `population` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `population`
--

INSERT INTO `population` (`id`, `name`) VALUES
(1, 'Yoruba'),
(3, 'Nago');

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id`, `name`) VALUES
(1, 'Trés Grand'),
(2, 'Grand'),
(3, 'Moyen'),
(4, 'Petit'),
(5, 'Très petit');

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, 'Très bon état'),
(2, 'Bon état'),
(3, 'Etat dégradé'),
(4, 'Etat très dégradé'),
(5, 'Urgence réparation');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Absent'),
(2, 'Maladie'),
(3, 'Guichet'),
(4, 'Guidage\r\n'),
(5, 'Travail'),
(6, 'Congés'),
(7, 'Rtt');

-- --------------------------------------------------------

--
-- Structure de la table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`) VALUES
(8, 'Kudo Bocio'),
(9, 'Bla Bocio'),
(10, 'Kpé Bocio');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Sang'),
(2, 'Os'),
(3, 'Bois'),
(4, 'Corde'),
(5, 'Cadenas'),
(6, 'Poil');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_8D93D6496BF700BD` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`, `roles`, `is_verified`, `avatar`, `status_id`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'timmy@mail.com', '$2y$13$E0VzFwE55nsDJ7mIQx/MtO5TJR6abXP9daHGzF57wwbDjHaFmHSJq', 'timmy', 'timmy', NULL, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'sculptureQuentinBECK@gmail.com', '$2y$13$iQZYyACABTI5r7MxqO/2mOMRpavBgJoMOHlssXwenn6nu1kS5nSba', 'test', 'test', NULL, 0, NULL, NULL, NULL, NULL, NULL),
(3, 'test5@mail.com', '666666', 'test5', 'test5', NULL, 0, NULL, NULL, NULL, NULL, NULL),
(4, 'test@mail.com', '$2y$13$FFaOurlPU78CnrtCO./IiuonZ1.0QEIZ4IVrqdMkv87fyNcTOlQE6', 'test', 'test', '[]', 0, NULL, NULL, NULL, NULL, NULL),
(5, 'vodou@mail.com', '$2y$13$VohIjFRd1T/h84R3AFCndunKS8dC0er5N8kyf9RSBL/ud.i7kP/P2', 'vodou', 'vodou', '[\"ROLE_ADMIN\"]', 0, NULL, 4, NULL, NULL, NULL),
(6, 'test2@mail.com', '$2y$13$fdhlsit0pjnLcrXqjZbSD.B6hYud2WDMrx0AtRSu2crdVlGs0rFHu', 'test', 'test', '[\"ROLE_MEMBER\"]', 0, NULL, NULL, NULL, NULL, NULL),
(7, 'test9@mail.com', '$2y$13$Jf3PCifG1CuKQrfVvvJSCe64mfCfgKouJR9zE0WeE4ziWGh42ZK9C', 'test', 'test', '[\"ROLE_MEMBER\"]', 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objects_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29AA64324BEE6933` (`objects_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `youtube`
--

DROP TABLE IF EXISTS `youtube`;
CREATE TABLE IF NOT EXISTS `youtube` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objects_id` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F07899344BEE6933` (`objects_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `youtube`
--

INSERT INTO `youtube` (`id`, `objects_id`, `link`) VALUES
(8, 1, 'ArnFVQ1yGtw'),
(9, 1, '8Q7c3RGmD54');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `FK_63540594BEE6933` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6A4BEE6933` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`);

--
-- Contraintes pour la table `librairies`
--
ALTER TABLE `librairies`
  ADD CONSTRAINT `FK_319433ACB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `librairies_book`
--
ALTER TABLE `librairies_book`
  ADD CONSTRAINT `FK_FDCEE16C16A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FDCEE16CB52A5368` FOREIGN KEY (`librairies_id`) REFERENCES `librairies` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objects`
--
ALTER TABLE `objects`
  ADD CONSTRAINT `FK_B21ACCF356A273CC` FOREIGN KEY (`origin_id`) REFERENCES `origin` (`id`),
  ADD CONSTRAINT `FK_B21ACCF35D83CC1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`),
  ADD CONSTRAINT `FK_B21ACCF36DBFD369` FOREIGN KEY (`sub_categories_id`) REFERENCES `sub_categories` (`id`),
  ADD CONSTRAINT `FK_B21ACCF3854679E2` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`id`),
  ADD CONSTRAINT `FK_B21ACCF3896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B21ACCF3A21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_B21ACCF3A6E7D247` FOREIGN KEY (`gods_id`) REFERENCES `gods` (`id`),
  ADD CONSTRAINT `FK_B21ACCF3C955D1E1` FOREIGN KEY (`population_id`) REFERENCES `population` (`id`);

--
-- Contraintes pour la table `objects_gods`
--
ALTER TABLE `objects_gods`
  ADD CONSTRAINT `FK_A5CBF32A4BEE6933` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A5CBF32AA6E7D247` FOREIGN KEY (`gods_id`) REFERENCES `gods` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objects_materials`
--
ALTER TABLE `objects_materials`
  ADD CONSTRAINT `FK_299203043A9FC940` FOREIGN KEY (`materials_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_299203044BEE6933` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objects_tags`
--
ALTER TABLE `objects_tags`
  ADD CONSTRAINT `FK_C6D475924BEE6933` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C6D475928D7B4FB4` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ojects`
--
ALTER TABLE `ojects`
  ADD CONSTRAINT `FK_5FD49DFC854679E2` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6496BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Contraintes pour la table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `FK_29AA64324BEE6933` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`);

--
-- Contraintes pour la table `youtube`
--
ALTER TABLE `youtube`
  ADD CONSTRAINT `FK_F07899344BEE6933` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
