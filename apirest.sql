-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 28 nov. 2022 à 00:58
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `apirest`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`) VALUES
(1, 'Supermarché', 'Destiné à la vente de produits alimentaires, produits de premières nécessités.'),
(2, 'Mode', 'Magasins dont l\'activité principale se résume à la mode.'),
(3, 'Sport', 'Vente de produits liés à la pratique du sport.'),
(5, 'Bricolage', 'Vente d\'outils, meubles, quincaillerie, produits de nettoyage, d\'entretiens ou du BTC.'),
(6, 'Librairie', 'Papeterie, livres, romans, mangas, E-books, livres audio...');

-- --------------------------------------------------------

--
-- Structure de la table `magasins`
--

CREATE TABLE `magasins` (
  `id` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `categories_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `magasins`
--

INSERT INTO `magasins` (`id`, `nom`, `description`, `categories_id`, `updated_at`, `logo`) VALUES
(1, 'Carrefour', 'Carrefour est un groupe français du secteur de la grande distribution, pionnier du concept d\'hypermarché en 1963.\r\nDevenu en 1999 le numéro un européen de la grande distribution en fusionnant avec Promodès, il se hisse en 2013 au 3e rang mondial de ce secteur par son chiffre d\'affaires, derrière le groupe américain Walmart. En 2016, il recule à la 6e place mondiale, selon Deloitte, du fait de la maturité de nouveaux modèles : commerce en ligne, clubs-entrepôts, notamment. ', 2, '2019-09-07 19:19:09', 'carrefour.png'),
(2, 'Leclerc', 'E.Leclerc est une coopérative de commerçants et une enseigne de grande distribution à prédominance alimentaire d\'origine française, à partir du premier magasin ouvert par Édouard Leclerc en 1949, elle regroupe aujourd\'hui des magasins indépendants.', 6, '2019-09-07 19:21:11', 'leclerc.png'),
(3, 'auchan', 'Auchan est une enseigne de grande distribution faisant partie de l\'Association familiale Mulliez. Elle est fondée par Gérard Mulliez en 1961 et dirigée par lui jusqu\'en 2006. En 2019, il s\'agit de la quatrième enseigne de grande distribution mondiale et de la deuxième en France.', 1, '2022-11-16 17:26:05', 'auchan.png'),
(4, 'franprix', 'Franprix est une enseigne française de supermarchés créée en 1958 par Jean Baud. C\'est une filiale du groupe Casino depuis septembre 1997. L\'enseigne, dirigée par Cécile Guillou a réalisé en 2021 un chiffre d’affaires de 1,44 milliard d\'euros.', 1, '2022-11-16 17:26:05', 'franprix.png'),
(5, 'lidl', 'Lidl est une entreprise de distribution allemande fondée en 1930 et présente à travers vingt-six pays en Europe avec 11 463 magasins dont 3 277 en Allemagne, pays d\'origine. Lidl fait partie du groupe Schwarz, qui a son siège à Neckarsulm.', 1, '2022-11-16 17:26:05', 'lidl.png'),
(6, 'intermarché', 'Intermarché est une enseigne française de grande distribution du groupe Les Mousquetaires fondée en 1969 sous l\'enseigne EX Offices de distribution par Jean-Pierre Le Roch. Par la suite, les EX deviendront, en 1973, Intermarché.', 1, '2022-11-16 17:26:05', 'intermarche.png'),
(7, 'picard', 'Picard Surgelés est une entreprise française spécialisée dans le commerce de détail de produits alimentaires surgelés sous marque de distributeur. Elle est le chef de file français dans ce secteur, contrôlant près de 20 % du marché en 2014.', 1, '2022-11-16 17:26:05', 'picard.png'),
(8, 'decathlon', 'Decathlon est une entreprise française de grande distribution de sport et de loisirs, créée en 1976 par Michel Leclercq. Le groupe Decathlon n\'est pas coté en bourse, mais détenu par un actionnariat familial composé de trois collèges : la famille de l\'ex-président fondateur, des salariés et la famille Mulliez.', 3, '2022-11-16 17:26:05', 'decathlon.png'),
(9, 'GO sport', 'Go Sport est un groupe spécialisé dans la distribution d\'articles de sport. La société est créée en 2000 par la maison-mère, le Groupe Rallye, à la suite du rapprochement des enseignes Go Sport et Courir. Dirigée aujourd\'hui par Philippe Favre, elle possède les enseignes Go Sport, Go Sport Montagne et Bike+.\r\nElle occupe la troisième place du marché en France derrière Decathlon et Intersport. ', 3, '2022-11-16 17:26:05', 'gosport.png'),
(10, 'adidas', 'Adidas est une firme allemande fondée en 1949 par Adolf Dassler, spécialisée dans la fabrication d\'articles de sport, basée à Herzogenaurach en Allemagne. Elle est mondialement connue sous l\'appellation « la marque aux trois bandes », des trois bandes parallèles qui constituent son logo.', 3, '2022-11-16 17:26:05', 'adidas.png'),
(11, 'puma', 'Puma SE est une entreprise allemande spécialisée dans la fabrication d\'articles de sport fondée en 1948 par Rudolf Dassler, frère aîné d\'Adolf Dassler fondateur d\'Adidas, et basée à Herzogenaurach en Bavière.', 3, '2022-11-16 17:26:05', 'puma.png'),
(12, 'manomano', 'ManoMano est une entreprise française du secteur du commerce en ligne spécialisée dans le domaine du bricolage et du jardinage. Elle est détenue par la société Colibri.', 5, '2022-11-16 17:26:05', 'manomano.png'),
(13, 'leroy merlin', 'Leroy Merlin est une enseigne française de grande distribution spécialisée dans l\'amélioration de l\'habitat.', 5, '2022-11-16 17:26:05', 'leroymerlin.png'),
(14, 'brico depot', 'Brico Dépôt est une enseigne de magasins de bricolage et d\'amélioration de la maison présente majoritairement en France, mais également en Espagne, au Portugal et en Roumanie. En 2022, l\'enseigne compte 123 points de vente et emploie 8 124 salariés.\r\n', 5, '2022-11-16 17:26:05', 'bricodepot.png'),
(15, 'mr.bricolage', 'Mr.Bricolage, est une chaîne française de grande distribution spécialisée dans le bricolage, le jardinage, la décoration et l\'aménagement de la maison et du jardin.', 5, '2022-11-16 17:26:05', 'mrbricolage.png'),
(16, 'castorama', 'Castorama est une entreprise de grande distribution de bricolage, de décoration et d\'aménagement de la maison, jadis française, devenue filiale de la société britannique Kingfisher depuis 2002.', 5, '2022-11-16 17:26:05', 'castorama.png'),
(17, 'bricolex', 'Bricolex est une enseigne indépendante de bricolage dont les magasins sont implantés en centre ville dans plusieurs localités de l’Ile de France, dont Paris. Ces magasins de proximité proposent plus de 10 000 références en bricolage, décoration, produits de ménage, accessoires et produits de jardinage, quincaillerie.', 5, '2022-11-16 17:26:05', 'bricolex.png'),
(18, 'nike', 'Nike est une société américaine créée en 1968 par Philip Knight et Bill Bowerman. Basée à Beaverton dans l\'Oregon, elle est spécialisée dans la fabrication d\'articles de sport.', 3, '2022-11-16 17:26:05', 'nike.png'),
(19, 'h&m', 'Hennes et Mauritz, plus connu sous le nom de H&M, est une entreprise et chaîne de magasins suédoise de prêt-à-porter pour femme, enfant et homme, fondée en 1947 par Erling Persson. Au 30 novembre 2020, H&M est présent dans 74 pays et emploie environ 171 000 personnes et possède plus de 5 000 magasins. ', 2, '2022-11-16 17:26:05', 'hm.png'),
(20, 'zara', 'Zara est la principale marque de vêtements de mode pour enfant et pour adultes de la société espagnole Inditex, qui possède aussi les marques Zara Home, Massimo Dutti, Bershka, Pull and Bear, Stradivarius, Kiddy\'s class, Lefties, Uterqüe, ainsi que Oysho.', 2, '2022-11-16 17:26:05', 'zara.png'),
(21, 'cos', 'COS est une marque pour hommes et femmes recherchant des designs modernes, fonctionnels et ingénieux.Les méthodes traditionnelles s’unissent aux nouvelles techniques pour créer des collections sobres et intemporelles.\r\n\r\n', 2, '2022-11-16 17:26:05', 'cos.png'),
(22, 'lacoste', 'Lacoste est une entreprise française, spécialisée dans la confection de prêt-à-porter masculin et féminin. L\'entreprise est fondée en 1933 par André Gillier et René Lacoste, à la suite de la retraite du célèbre joueur de tennis. André Gillier est l\'inventeur de la maille qui fit la renommée de la marque.', 2, '2022-11-16 17:26:05', 'lacoste.png'),
(23, 'mango', 'Mango est une société espagnole spécialisée dans la conception, la fabrication et à la commercialisation via des franchises de vêtements et accessoires pour femme, pour homme et plus récemment pour enfant.', 2, '2022-11-16 17:26:05', 'mango.png'),
(24, 'carhartt', 'Hamilton Carhartt & Co est une entreprise américaine fondée en 1889, initialement spécialisée dans la fabrication de vêtements de travail. Les modèles historiques et emblématiques de la marque sont les blousons, pantalons et salopette en « cotton duck », une toile de coton épaisse souvent ocre-brun.', 2, '2022-11-16 17:26:05', 'carhartt.png'),
(25, 'fnac', '', 6, '2022-11-16 17:26:05', 'fnac.png'),
(26, 'gibert joseph', 'Créé par Joseph Gibert en 1886, Gibert Joseph, précédemment nommé Librairie Gibert, est un réseau de libraires et disquaires en France. Gibert Joseph est une enseigne de Gibert, plus grande librairie indépendante et généraliste de France.', 6, '2022-11-16 17:26:05', 'gibertjoseph.png'),
(27, 'calypso', 'Librairie parisienne spécialisée dans les ouvrages caribéens.', 6, '2022-11-16 17:26:05', 'calypso.png'),
(28, 'librairie sans titre', 'La librairie propose à un public averti ou non, une sélection d’ouvrages de jeunes artistes soutenus, pour l’essentiel, par des éditeurs indépendants français et étrangers.', 6, '2022-11-16 17:26:05', 'librairiesanstitre.png'),
(29, 'cultura', 'Cultura est une enseigne de distribution française appartenant à la société Socultur, filiale de la holding Sodival. Elle est la troisième enseigne spécialisée dans la commercialisation de biens et loisirs culturels et créatifs en France derrière Leclerc et la Fnac avec 125 025 m² de surface.', 6, '2022-11-16 17:26:05', 'cultura.png'),
(30, 'coxxi market', 'magasin', 1, '2022-11-23 22:43:29', 'coxxi.png'),
(31, 'À 2 Pas', 'magasin', 3, '2022-11-24 00:08:26', 'hi.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `magasins`
--
ALTER TABLE `magasins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `magasins`
--
ALTER TABLE `magasins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `magasins`
--
ALTER TABLE `magasins`
  ADD CONSTRAINT `FK_MAGASINS_CATEGORIES` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `magasins_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
