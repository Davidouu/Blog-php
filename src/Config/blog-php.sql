-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2024 at 08:25 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `publishDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thumbnailUrl` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `isValidated` tinyint(1) NOT NULL DEFAULT '0',
  `promote` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `content`, `excerpt`, `title`, `slug`, `publishDate`, `updateDate`, `thumbnailUrl`, `categoryId`, `authorId`, `isValidated`, `promote`) VALUES
(1, 'Aujourd\'hui, nous allons explorer des territoires inexplorés, en quête de découvertes passionnantes et de surprises inattendues. La curiosité est notre boussole, et chaque pas nous rapproche de l\'inconnu, alimentant notre désir de comprendre le monde qui nous entoure. De l\'émerveillement des découvertes scientifiques à la beauté simple d\'un paysage non exploré, cette aventure promet d\'ouvrir de nouvelles perspectives.', 'Plongeons dans les mystères de l\'inconnu, là où l\'aventure commence sans limites.', 'Exploration de l\'inconnu', 'exploration-de-linconnu', '2024-01-16 07:57:43', '2024-01-16 09:02:40', '65a628e772adc.jpg', 1, 9, 1, 1),
(2, 'Dans cet article, nous plongeons dans l\'art de rêver sans frontières, explorant l\'inspiration infinie que cela peut apporter à nos vies. Les rêves sont les graines de l\'innovation, et en les cultivant sans entraves, nous découvrons des horizons inexplorés de créativité. Chacun de nous a le pouvoir de redéfinir sa réalité en laissant ses rêves guider son chemin. Ce voyage au-delà des frontières conventionnelles nous rappelle la beauté unique de la non-classe.', 'Laissons nos rêves s\'épanouir sans limites ni contraintes. La non-classe a une beauté singulière.', 'Rêver sans frontières', 'rver-sans-frontires', '2024-01-16 07:59:25', '2024-01-16 07:59:25', '65a6294d12710.jpg', 1, 8, 1, 0),
(4, 'Revivez les moments forts du dernier championnat, des victoires épiques aux performances exceptionnelles des athlètes. Chaque coup, chaque sprint, chaque instant de ce championnat a été imprégné d\'une adrénaline palpitante qui a captivé le monde du sport. Les héros émergent, les underdogs surprennent, et chaque équipe laisse son empreinte dans l\'histoire sportive. Plongez dans cette rétrospective passionnante qui célèbre la grandeur du sport et l\'unité qu\'il apporte.', 'Les moments palpitants du dernier championnat qui ont fait battre le cœur de millions de fans.', 'Championnat de l\'Adrénaline', 'championnat-de-ladrnaline', '2024-01-16 08:32:11', '2024-01-16 08:32:11', '65a630fba5c12.jpg', 2, 9, 1, 0),
(7, 'Plongeons dans les routines d\'entraînement des athlètes d\'élite, où la discipline et la détermination sont les clés du succès. Chaque goutte de sueur, chaque répétition minutieuse, représente un pas de plus vers l\'excellence. Dans cet article, nous dévoilons les coulisses de l\'entraînement rigoureux qui façonne les champions, explorant comment ces athlètes repoussent constamment leurs limites physiques et mentales pour atteindre de nouveaux sommets.', 'Découvrez les secrets des entraînements des athlètes d\'élite qui repoussent sans cesse leurs limites.', 'Entraînement de l\'Élite', 'entranement-de-llite', '2024-01-16 08:44:10', '2024-01-16 09:03:36', '65a633ca16d09.jpg', 2, 8, 1, 1),
(8, 'Plongeons dans les avancées récentes de l\'intelligence artificielle et découvrons comment elle impacte nos vies de manière significative. Des assistants virtuels intelligents aux algorithmes d\'apprentissage automatique, l\'IA a révolutionné la manière dont nous interagissons avec la technologie. Cet article explore les applications pratiques de l\'IA, ses implications, et les défis futurs qui accompagnent cette avancée technologique majeure.', 'Explorez comment l\'intelligence artificielle transforme notre quotidien et façonne l\'avenir de la technologie.', 'L\'Ère de l\'Intelligence Artificielle', 'lre-de-lintelligence-artificielle', '2024-01-16 08:46:24', '2024-01-16 09:06:49', '65a6345087ff5.jpg', 3, 9, 1, 1),
(9, 'Découvrez comment la réalité virtuelle repousse les limites de l\'expérience humaine, offrant des perspectives uniques et immersives. De la simulation de mondes fantastiques à la formation professionnelle, la réalité virtuelle redéfinit la manière dont nous interagissons avec notre environnement. Cet article explore les dernières avancées technologiques, les applications passionnantes, et les défis qui accompagnent cette révolution virtuelle.', 'Plongez dans un univers où la réalité virtuelle transcende les frontières entre le réel et l\'imaginaire.', 'La Réalité Virtuelle Redéfinie', 'la-ralit-virtuelle-redfinie', '2024-01-16 08:47:43', '2024-01-16 08:47:43', '65a6349f45365.jpg', 3, 8, 1, 0),
(10, 'Dans cet article, plongeons dans le monde dynamique de l\'entrepreneuriat, explorant les défis uniques et les récompenses incommensurables que les entrepreneurs rencontrent. Du processus de conception d\'une idée à la gestion d\'une entreprise prospère, chaque étape du voyage entrepreneurial est une aventure en soi. Découvrez des histoires inspirantes, des conseils pratiques et les leçons apprises par ceux qui ont osé se lancer dans cette quête audacieuse.', 'Explorez les hauts et les bas du voyage entrepreneurial, des idées initiales à la construction d\'entreprises prospères.', 'Le Voyage de l\'Entrepreneur', 'le-voyage-de-lentrepreneur', '2024-01-16 08:52:34', '2024-01-16 08:52:34', '65a635c2d9093.jpg', 4, 8, 1, 0),
(11, 'Plongeons dans les stratégies éprouvées qui propulsent les start-ups vers le succès. De la gestion des ressources limitées à la création d\'une marque solide, cet article explore les meilleures pratiques pour assurer une croissance durable dans le monde des start-ups. Que vous soyez fondateur, investisseur ou simplement passionné par l\'entrepreneuriat, ces conseils pratiques vous guideront dans la création d\'une start-up florissante.', 'Découvrez les tactiques stratégiques pour stimuler la croissance et le succès d\'une start-up dans un environnement compétitif.', 'Stratégies de Croissance d\'une Start-up', 'stratgies-de-croissance-dune-start-up', '2024-01-16 08:53:34', '2024-01-16 09:03:46', '65a635fed775e.jpg', 4, 9, 1, 1),
(12, 'Cet article met en lumière les entrepreneurs visionnaires qui changent la donne à travers des innovations audacieuses. Des nouvelles technologies révolutionnaires aux approches novatrices dans les secteurs traditionnels, découvrez comment ces esprits créatifs redéfinissent les normes de l\'industrie. Plongez dans un monde où l\'audace et l\'innovation sont les clés du succès entrepreneurial.', 'Explorez les innovations qui redéfinissent les industries et découvrez comment les entrepreneurs repoussent les limites de la créativité.', 'Innovations Entrepreneuriales', 'innovations-entrepreneuriales', '2024-01-16 08:55:01', '2024-01-16 09:03:56', '65a6365591053.jpg', 4, 8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categorySlug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `categorySlug`) VALUES
(1, 'Non classé', 'non-class'),
(2, 'Sport', 'sport'),
(3, 'Nouvelles technologies', 'nouvelles-technologies'),
(4, 'Entrepreneuriat', 'entrepreneuriat');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `commentContent` text NOT NULL,
  `publishedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isCommentValidated` tinyint(1) NOT NULL DEFAULT '0',
  `authorId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `commentContent`, `publishedAt`, `isCommentValidated`, `authorId`, `articleId`) VALUES
(1, 'C\'est tellement excitant d\'explorer l\'inconnu! J\'ai hâte de lire la suite.', '2024-01-16 09:08:03', 1, 10, 1),
(2, 'L\'aventure sans limites, c\'est ce dont on a tous besoin. Continuez à nous surprendre!', '2024-01-16 09:08:11', 1, 9, 1),
(3, 'Les rêves sans frontières sont les plus captivants. Merci de partager cette perspective inspirante.', '2024-01-16 09:08:29', 1, 11, 2),
(4, 'La beauté de la non-classe réside dans la liberté de rêver sans limites. Bravo!', '2024-01-16 09:08:36', 1, 10, 2),
(5, 'Ce championnat était incroyable! Mon équipe préférée a vraiment brillé.', '2024-01-16 09:09:10', 1, 9, 4),
(6, 'L\'adrénaline du sport est inégalable. Merci de nous ramener ces moments excitants!', '2024-01-16 09:09:16', 1, 11, 4),
(7, 'Ces athlètes d\'élite sont une véritable inspiration. La détermination est la clé du succès!', '2024-01-16 09:09:33', 1, 9, 7),
(8, 'Merci de nous donner un aperçu des coulisses de l\'entraînement des champions. Impressionnant!', '2024-01-16 09:09:39', 1, 10, 7),
(9, 'L\'IA révolutionne vraiment le monde! Des applications infinies. Passionnant!', '2024-01-16 09:09:52', 1, 9, 8),
(10, 'C\'est fascinant de voir comment l\'intelligence artificielle évolue. J\'attends avec impatience ce que l\'avenir nous réserve.', '2024-01-16 09:10:00', 1, 11, 8),
(11, 'La réalité virtuelle est une révolution en marche. Cet article capture parfaitement son impact.', '2024-01-16 09:10:15', 1, 9, 9),
(12, 'C\'est incroyable de voir comment la technologie transforme notre perception', '2024-01-16 09:10:31', 1, 10, 9),
(13, 'Vos récits d\'exploration sont une véritable évasion mentale. Merci de nous emmener dans ces voyages imaginaires.', '2024-01-16 09:10:50', 1, 8, 1),
(14, 'Les moments forts du championnat ont vraiment défini cette saison. Quel article captivant!', '2024-01-16 09:11:05', 1, 11, 4),
(15, 'Le suspense à chaque match était insoutenable. Ces athlètes sont de véritables héros du sport.', '2024-01-16 09:12:22', 1, 9, 4),
(16, 'L\'intelligence artificielle révolutionne notre quotidien, et votre article le rend accessible et intéressant. Merci!', '2024-01-16 09:12:47', 1, 10, 8),
(17, 'Le voyage entrepreneurial est une montagne russe émotionnelle, mais c\'est une expérience incomparable. Merci pour cet article enrichissant.', '2024-01-16 09:13:05', 1, 11, 10),
(18, 'Les stratégies de croissance sont cruciales pour toute start-up. Merci pour ces conseils pratiques!', '2024-01-16 09:13:18', 1, 8, 11),
(19, 'En tant qu\'entrepreneur en herbe, ces informations sont une mine d\'or. J\'apprécie la clarté des conseils donnés.', '2024-01-16 09:13:25', 1, 10, 11),
(20, 'Les histoires d\'innovations entrepreneuriales sont toujours inspirantes. Merci pour cette exploration fascinante!', '2024-01-16 09:13:39', 1, 11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `confirmationToken` varchar(255) DEFAULT NULL,
  `validateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `email`, `password`, `role`, `confirmationToken`, `validateAt`) VALUES
(8, 'Editeur', 'TEST', 'editeur@test.com', '$2y$10$0or6lYW079NmUED/gP3NuejPK1Cg8cF2/hi8Y6T8nQISNqgwma.Vy', 'editeur', NULL, '2024-01-15 19:11:36'),
(9, 'Admin', 'TEST', 'admin@test.com', '$2y$10$8QNQmIBgLQM0s/EgDYesWe.CnUYZudEVTuYMQ7mzsoL57xXLexZ3O', 'admin', '', '2024-01-15 19:13:09'),
(10, 'User1', 'TEST', 'user1@test.com', '$2y$10$OOWSRgDEIAFvP6z3hYXCE.hIq5MIvQKSyMiEoa.wtsfllYGMMgYOe', 'user', NULL, '2024-01-15 19:15:43'),
(11, 'User2', 'TEST', 'user2@test.com', '$2y$10$99.k61YH9Qr3t2BD1BOuiOm9KYZ571PvP6cnn/kc1XCfh4jjRwOGW', 'user', NULL, '2024-01-15 19:16:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `authordId` (`authorId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD UNIQUE KEY `id` (`categoryId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD UNIQUE KEY `id` (`commentId`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `articleId` (`articleId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `id` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`),
  ADD CONSTRAINT `article_ibfk_3` FOREIGN KEY (`authorId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`articleId`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
