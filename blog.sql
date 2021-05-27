-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 mai 2021 à 15:36
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
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` mediumtext NOT NULL,
  `comment_create` datetime NOT NULL DEFAULT current_timestamp(),
  `valid` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `postid`, `author`, `comment`, `comment_create`, `valid`) VALUES
(1, 1, 'geveix', 'J\'aime bien ce post, Bravo !', '2021-05-13 16:02:18', 1),
(2, 1, 'geveix', 'Vraiment bien ce post, continuez comme ça !', '2021-05-13 16:51:22', 1),
(3, 1, 'geveix', 'test', '2021-05-13 17:24:09', 1),
(4, 1, 'geveix', 'test', '2021-05-13 18:04:52', 1),
(5, 2, 'geveix', 'Bonjour, excellent poste', '2021-05-13 18:05:13', 1),
(6, 1, 'admin', 'Je suis un admin ', '2021-05-15 13:33:48', 1),
(10, 2, 'geveix', 'Hello ', '2021-05-15 16:48:43', 1),
(12, 2, 'jmarc', 'Moi jaime bien le latin ', '2021-05-15 17:11:41', 1),
(21, 2, 'geveix', 'Moi je n\'aime pas le latin', '2021-05-17 15:31:37', 1),
(22, 16, 'geveix', 'J\'aime beaucoup le python !!', '2021-05-17 15:43:45', 1),
(23, 16, 'admin', 'bonjour', '2021-05-17 16:01:26', 1),
(26, 1, 'admin', '&lt;script&gt;alert(\'toto\')&lt;/script&gt;', '2021-05-17 16:25:07', 1),
(29, 16, 'admin', 'test\r\n', '2021-05-18 01:26:16', 1),
(30, 16, 'admin', 'test', '2021-05-18 01:29:40', 1),
(42, 23, 'Gévéix', 'Je ne pense pas que cela soit le meilleur ... !!', '2021-05-21 02:18:52', 1),
(44, 25, 'admin', 'Moi j\'aime bien le C# !', '2021-05-23 11:49:34', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL DEFAULT current_timestamp(),
  `num_tel` varchar(30) NOT NULL,
  `picture_profile` varchar(225) DEFAULT 'public/img/photo_default.jpg',
  `phrase_profil` varchar(225) NOT NULL,
  `git_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `lien_cv` varchar(255) DEFAULT NULL,
  `user_type` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `pass`, `email`, `date_inscription`, `num_tel`, `picture_profile`, `phrase_profil`, `git_url`, `linkedin_url`, `twitter_url`, `lien_cv`, `user_type`) VALUES
(4, 'Letellier', '$2y$10$A/3PHhwhuDTJUbQBssqjb.IQzRFpvGFackVcIUdjhbbjRZpAUmRUq', 'jacquet.david@yahoo.com', '2021-05-10', '0781374070', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(6, 'Verdier', '$2y$10$NYK/pqdL/ekEmJd7TVlZpe26pPRGEZw.Z.3e1dkBYNOjCvlPD4V/C', 'imorin@gmail.com', '2021-05-10', '06 83 90 0', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(7, 'Valentin', '$2y$10$0qiCNSP5OwStTTVViMMk3OrI9dOlebLxIy6PgVSZ0.K0GfGkVHxmO', 'menard.juliette@gmail.com', '2021-05-10', '0649956951', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(8, 'Faure', '$2y$10$F.JFsIYuKxnosjAhLh.Yd.fFBwiCAlaj2vaG6CRU9RaSqiqBIz5Le', 'rey.rene@yahoo.com', '2021-05-10', '+33 (0)6 4', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(9, 'Goncalves', '$2y$10$RPt5cuXxD.2YlaNU6Vp8/.1qCCB5YejcCGS1oP7f6wySLk0sG97B.', 'boulanger.gerard@hotmail.com', '2021-05-10', '+33 (0)6 7', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(10, 'Masson', '$2y$10$DRFmVrnPcLs4BU2mxN8lousHzdCFLrZV8nCtFIosujlYfTaGwbqKO', 'emmanuelle07@hotmail.com', '2021-05-10', '0620162625', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(12, 'Boutin', '$2y$10$hlBLPvHWWYva9AKjjWQddOpVLy2alpcOpcVvZUBfDwO5BLEtj/jgC', 'ccolin@hotmail.com', '2021-05-10', '0625857294', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(13, 'Hamon', '$2y$10$gZqkcp1V0VrIpYNRy8gYcO.S9zr2D1wZnGuRvjU3cH/dOdOzG3Any', 'tristan60@hotmail.com', '2021-05-10', '07 73 55 9', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(15, 'Evrard', '$2y$10$9hgYkHQtHmJPvicRv1JO3e/sxYKco93StT4d6ODv/pLTYqa6s5n0W', 'maillot.william@gmail.com', '2021-05-10', '+33 6 99 4', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(16, 'Alexandre', '$2y$10$7qrOW38/ctQfpMNOz9wmw.6FRRz2rf/XK.pqMJMdsVOxdYnihZg.6', 'dgilles@gmail.com', '2021-05-10', '0762137700', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(17, 'Allain', '$2y$10$zwG1hXXoTbXG4wYjHNyhc.EAWNLs9VFj4q.iVGbGm1E4oPuHsdF7C', 'padam@hotmail.com', '2021-05-10', '0773227260', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(18, 'Huet', '$2y$10$nppbBLd9zea.OXRHVU4GnueE.Jx8YZDNSnyCG6T6VIugChoRi5ZqW', 'hbarre@hotmail.com', '2021-05-10', '06 02 86 9', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(19, 'Lefebvre', '$2y$10$m6VlPEh8uMFIg6Pvhs9gGePNCFuEWhUIiJEkcM./i2hn8NeO/tXrS', 'uhubert@yahoo.com', '2021-05-10', '+33 (0)6 8', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(20, 'Herve', '$2y$10$JkZb80Bift9HopUXOgi3fOxiVvSh4KE8D.4kxW0Zc2LHBxaXwhkia', 'charlotte49@gmail.com', '2021-05-10', '+33 6 85 1', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(21, 'Noel', '$2y$10$9j5Xq3ntIKullEyBBd1H2eLoXEB12g/v5QfQV1d4m7EqskNQz8M4i', 'hmoreau@hotmail.com', '2021-05-10', '+33 6 88 1', 'public/img/photo_default.jpg', 'test', '', '', '', 'test', 0),
(25, 'geveix', '$2y$10$n82DVbKjMlFgdT6EA6r2rexvJJDNL7qDfHIEH8KWN/jXk/1v0NvOC', 'julienelmon@gmail.com', '2021-05-11', '0665930548', 'public/img/photo_default.jpg', 'Je maitrise le PHP', '', '', '', '', 0),
(26, 'admin', '$2y$10$7ZaIlHmA.K5iK9ZWGBZ9oeb6940jty3pVw.dbKsUt6ks.z.Z1VLwS', 'admin@admin.fr', '2021-05-15', '0609040404', 'public/img/photo_default.jpg', 'Je suis un admin ', '', '', '', '', 1),
(27, 'jmarc', '$2y$10$FvaFSzAiqRqnkeU2hWhymOvrvS83juUui795RIjmdr9T45Tp9O036', 'jmarc@htomail.fr', '2021-05-15', '0654715863', 'public/img/photo_default.jpg', 'Je mappelle jean marc', '', '', '', NULL, 0),
(29, 'michele D', '$2y$10$NgmP.VZGyDu89mFM6oaDFuAteVwd/jvyvvLZtklVV8Qi6Dz36IgUe', 'michele.d@hotmail.fr', '2021-05-18', '0658741254', NULL, 'Je fais du Twig/php', '', '', '', NULL, 0),
(30, 'JulienElmon', '$2y$10$VccxRBe8Cbcjs9/NI8TFreWTWJo7NhoXsGA4dWtM3cVTgNI/wvg/S', 'julienelmon@hotmail.fr', '2021-05-18', '0645896547', 'public/img/Array.jpg', 'Je maitrise le PHP', '', '', '', NULL, 0),
(31, 'JeanPierre', '$2y$10$eVNLLZPkklHWZWKpfDiJ8u9QitT69OUa9q2TVHttYtGmamZ.xpyVW', 'j.pierre@gmail.com', '2021-05-18', '0630548974', 'public/img/Array.jpg', 'Je m\'appelle jean pierre', '', '', '', NULL, 0),
(32, 'LMalsot', '$2y$10$C7kf6gShnzp/VFflAOCMnuHoE5Y9XqWvc129FISo8U0YDCV76zn4K', 'l.malsot@yahoo.fr', '2021-05-18', '05896585', 'public/img/Hovercat.jpg.jpg', 'Je m\'appelle Malsot', '', '', '', NULL, 0),
(33, 'Gévéix', '$2y$10$1maULFDc0NJ3m9FwOj0qBOwMy4xmfixc54kfb0ip4azkpGdpc6iu6', 'yoyo@hotmail.fr', '2021-05-18', '0582369741', 'public/img/Capture.PNG.png', 'PHP / HTML / Pyhton / MySQL', '', '', '', NULL, 0),
(37, 'Grand', '$2y$10$ZOwXo9CkEE/kA/Eicf/yce1CgAtlct6NBC4BCJlleOKq16o0xkNv6', 'g.grand@gmail.com', '2021-05-26', '0589635412', 'public/img/61320775-homme-photo.jpg', 'Développeur PHP', 'https://github.com/julienelmon', 'https://www.linkedin.com/in/julien-elmon-58b6211aa/', 'https://twitter.com/julienelmon', 'public/cv/CV Julien ELMON.pdf', 0),
(38, 'olivertrue', '$2y$10$Vl1aVdKRFURiiaXOilknIuzz4J39mwxMdriiK8s.S83UKiJpmeGry', 'o.true@hotmail.fr', '2021-05-26', '0256987425', 'public/img/61320775-homme-photo.jpg', 'test Lien', '', '', '', 'public/cv/CV Julien ELMON.pdf', 0),
(39, 'test', '$2y$10$Q1k4fSoYsSjorEqW5llfEu0hkbyuKPzQmPPUKnfA0rnlT91l4KTua', 'test@test.com', '2021-05-26', '0100000000', 'public/img/61320775-homme-photo.jpg', 'test Main', '', '', '', 'public/cv/CV Julien ELMON.pdf', 0);

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
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`postid`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `post_id` FOREIGN KEY (`postid`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
