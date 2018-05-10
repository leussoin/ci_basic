-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 10 mai 2018 à 14:51
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fu_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(50) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Soda'),
(3, 'Vin'),
(4, 'Fruit'),
(5, 'Légume'),
(6, 'Féculents'),
(12, 'Viandes'),
(11, 'Laitages'),
(10, 'Céréales'),
(13, 'Poissons'),
(14, 'Oeufs'),
(15, 'Matierres grasses'),
(16, 'Sucre'),
(17, 'Condiments'),
(18, 'Produits ménagers'),
(19, 'Charcuterie'),
(20, 'Dessert'),
(21, 'Boissons'),
(22, 'Sauces');

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

DROP TABLE IF EXISTS `magasin`;
CREATE TABLE IF NOT EXISTS `magasin` (
  `id_magasin` int(50) NOT NULL AUTO_INCREMENT,
  `nom_magasin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_magasin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `magasin`
--

INSERT INTO `magasin` (`id_magasin`, `nom_magasin`) VALUES
(1, 'Intermarché'),
(2, 'LIDL');

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

DROP TABLE IF EXISTS `mesure`;
CREATE TABLE IF NOT EXISTS `mesure` (
  `id_mesure` int(50) NOT NULL AUTO_INCREMENT,
  `nom_mesure` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mesure`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mesure`
--

INSERT INTO `mesure` (`id_mesure`, `nom_mesure`) VALUES
(1, 'Litre'),
(2, 'kg'),
(3, 'unités');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_prod` int(50) NOT NULL AUTO_INCREMENT,
  `nom_prod` varchar(255) NOT NULL,
  `fk_id_categorie` int(50) NOT NULL,
  `fk_id_mesure` int(50) NOT NULL,
  `calories` int(50) NOT NULL,
  `stock_prod` double NOT NULL,
  PRIMARY KEY (`id_prod`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_prod`, `nom_prod`, `fk_id_categorie`, `fk_id_mesure`, `calories`, `stock_prod`) VALUES
(2, 'coca', 1, 1, 700, 1),
(14, 'barilla rigate', 6, 2, 3510, 1),
(13, 'barilla farfalle', 6, 2, 3510, 1),
(15, 'barilla spaghetti complétes', 6, 2, 1755, 0.5),
(16, 'barilla capelini', 6, 2, 3510, 1),
(17, 'paturage lait', 11, 1, 460, 1),
(18, 'paturage lait entier', 11, 1, 3516, 6),
(19, 'moutarde maille gourmet', 17, 3, 1224, 1),
(20, 'st eloi petits poids', 5, 2, 382, 0.72),
(21, 'Paté sanglier', 19, 2, 524, 0.18),
(22, 'ranou lardons', 12, 2, 1082, 0.2),
(23, 'gruyere', 11, 2, 987, 0.25),
(24, 'paturage comté', 11, 2, 1460, 0.35),
(28, 'paturage créme liquide', 11, 3, 198, 3),
(26, 'champignons', 5, 2, 75, 0.5),
(27, 'oignons', 5, 2, 56, 0.13),
(29, 'barilla coquillettes complétes', 6, 2, 1755, 0.5),
(30, 'fiorini sauce tomate', 5, 2, 150, 0.5),
(31, 'orangina', 1, 1, 800, 2),
(32, 'joker jus d\'orange', 21, 1, 630, 1.5),
(33, 'joker jus d\'orange', 21, 1, 630, 1.5),
(34, 'fiorini sauce tomate concentré', 22, 2, 100, 0.088),
(35, 'st eloi riz basmati', 10, 2, 3560, 1),
(36, 'joker jus de pomme', 21, 1, 645, 1.5),
(37, 'bouton d\'or huile d\'olive ', 15, 1, 17980, 2),
(38, 'odyssee', 13, 2, 968, 0.8);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id_recette` int(50) NOT NULL AUTO_INCREMENT,
  `nom_recette` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_recette`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id_recette`, `nom_recette`, `created_at`, `updated_at`, `deleted_at`) VALUES
(169, 'test ', NULL, NULL, NULL),
(168, 'test ', NULL, NULL, NULL),
(167, 'bbbbb', NULL, NULL, NULL),
(165, 'ffffffffffffff', NULL, NULL, NULL),
(166, 'bbbbb', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `table_asso_prix`
--

DROP TABLE IF EXISTS `table_asso_prix`;
CREATE TABLE IF NOT EXISTS `table_asso_prix` (
  `fk_id_magasin` int(50) NOT NULL,
  `fk_id_produit` int(50) NOT NULL,
  `prix` double NOT NULL,
  UNIQUE KEY `fk_id_magasin` (`fk_id_magasin`,`fk_id_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_asso_prix`
--

INSERT INTO `table_asso_prix` (`fk_id_magasin`, `fk_id_produit`, `prix`) VALUES
(1, 2, 1.39),
(1, 1, 1.58),
(1, 13, 1.58),
(1, 14, 1.34),
(1, 15, 0.91),
(1, 16, 1.58),
(1, 17, 0.79),
(1, 18, 6.12),
(1, 19, 1.47),
(1, 20, 1.26),
(1, 21, 1.4),
(1, 22, 1.35),
(1, 23, 3.29),
(1, 25, 3.69),
(1, 26, 2.29),
(1, 27, 0.51),
(1, 28, 1.79),
(1, 29, 1.23),
(1, 30, 1.18),
(1, 31, 1.91),
(1, 32, 1.85),
(1, 33, 1.85),
(1, 34, 0.88),
(1, 35, 1.79),
(1, 36, 2.31),
(1, 37, 5.42),
(1, 38, 4.95);

-- --------------------------------------------------------

--
-- Structure de la table `table_asso_recette`
--

DROP TABLE IF EXISTS `table_asso_recette`;
CREATE TABLE IF NOT EXISTS `table_asso_recette` (
  `id_asso_recette` int(11) NOT NULL AUTO_INCREMENT,
  `id_recette` int(50) NOT NULL,
  `id_produit` int(255) NOT NULL,
  `quantite_par_personne` int(30) NOT NULL,
  `qte_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_asso_recette`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_asso_recette`
--

INSERT INTO `table_asso_recette` (`id_asso_recette`, `id_recette`, `id_produit`, `quantite_par_personne`, `qte_produit`) VALUES
(49, 166, 26, 100, 0),
(48, 165, 34, 0, 0),
(47, 165, 15, 0, 0),
(46, 165, 14, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
