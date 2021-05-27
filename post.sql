-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 mai 2021 à 15:32
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `contenue` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_der_modif` datetime NOT NULL,
  `chapo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `contenue`, `author`, `date_creation`, `date_der_modif`, `chapo`) VALUES
(1, 'Des truc surement intéressant en latin mais je comprend pas cette langue morte ', 'Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam. ut enim Simonides lyricus docet, beate perfecta ratione vieturo ante alia patriam esse convenit gloriosam.', 'Pichon', '2021-03-31 00:00:00', '2021-05-11 03:01:38', ''),
(2, 'Encore des truc en latin mais je ne comprend toujours pas cette langue ', 'Altera sententia est, quae definit amicitiam paribus officiis ac voluntatibus. Hoc quidem est nimis exigue et exiliter ad calculos vocare amicitiam, ut par sit ratio acceptorum et datorum. Divitior mihi et affluentior videtur esse vera amicitia nec observare restricte, ne plus reddat quam acceperit; neque enim verendum est, ne quid excidat, aut ne quid in terram defluat, aut ne plus aequo quid in amicitiam congeratur.', 'Gautier', '2021-03-31 00:00:00', '2021-05-17 03:01:58', ''),
(16, 'Le python, un language génial', 'Jaime bien le python car jutilise un Raspberry !', 'jmarc', '2021-05-19 00:10:09', '2021-05-27 03:02:16', 'Et vous ? Utilisez-vous Python '),
(19, 'Twig : un langage plus optimiser', 'Twig offre énormément de possibilité, on peut jouer avec les donner à l\'infini !!!', 'LMalsot', '2021-05-19 02:13:28', '2021-05-24 03:02:28', 'Et vous ? '),
(20, 'Je compte me mettre au React !', 'Donnez moi des arguments pour me mettre au React !', 'jmarc', '2021-05-22 03:03:26', '2021-05-24 03:04:11', 'Et vous ? utilisez vous le React ?'),
(21, 'Laravel, vos avis ?!', 'Quelle sont vos avis sur Laravel ?', 'geveix', '2021-05-24 03:04:24', '2021-05-27 00:00:00', 'Et vous ?'),
(23, 'Bootswatch', 'c\'est le meilleur site bootswatch que je connaisse !!!', 'geveix', '2021-05-25 03:04:46', '2021-05-25 03:04:50', 'Et vous ?'),
(25, 'Bruh le C#', 'Le C# me fait peur avez vous des tuto ?!&lt;/p&gt;', 'Gévéix', '2021-05-21 03:16:00', '0000-00-00 00:00:00', 'Au secours !');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
