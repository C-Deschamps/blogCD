-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 06 mars 2019 à 12:38
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blogcd`
--

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `idUser`, `text`, `idSujet`, `debut`, `reponse`, `created_at`, `updated_at`) VALUES
(1, 1, 'fqf', 1, NULL, NULL, '2019-02-28 14:34:43', '2019-02-28 14:34:43'),
(2, 1, 'dxdxtdxdxddxgfdxfdx\r\n\r\n\r\n\r\nefdsqfs<f<', 1, 'dxdxtdxdxddxgfdxfdx\r\r', NULL, '2019-02-28 14:47:41', '2019-03-06 12:29:45'),
(3, 1, 'Une sacré présentation', 1, NULL, NULL, '2019-02-28 15:03:20', '2019-02-28 15:03:20'),
(4, 1, 'Rem Pap a dit : \r\ndxdxtdxdxddxgfdxfdx\r\n\r\n\r\n\r\nefdsqfs<f<\r\nLe 2019-02-28 15:47:41\r\n \r\noui', 1, 'Rem Pap a dit : \rdxdxtdxdxddxgfdxfdx\r', NULL, '2019-02-28 15:03:52', '2019-03-06 12:29:45'),
(5, 6, 'tyuytuty', 1, NULL, NULL, '2019-03-04 12:54:22', '2019-03-04 12:54:22'),
(6, 6, ',hjgffgjgjk', 1, NULL, NULL, '2019-03-04 12:54:45', '2019-03-04 12:54:45'),
(7, 7, 'fsf', 1, NULL, NULL, '2019-03-04 13:18:21', '2019-03-04 13:18:21'),
(8, 9, 'gfd', 1, NULL, NULL, '2019-03-04 13:44:15', '2019-03-04 13:44:15'),
(9, 8, 'gbb', 1, NULL, NULL, '2019-03-05 09:25:24', '2019-03-05 09:25:24'),
(10, 8, 'bfb', 1, NULL, NULL, '2019-03-05 09:26:16', '2019-03-05 09:26:16'),
(11, 8, 'dd a dit : \r\nbfb\r\nLe 2019-03-05 10:26:16\r\n \r\n\r\n  fd', 1, 'dd a dit : \rbfb\r', NULL, '2019-03-05 09:26:39', '2019-03-06 12:29:50'),
(12, 8, 'dd a dit : \r\ndd a dit : \r\nbfb\r\nLe 2019-03-05 10:26:16\r\n \r\n\r\n  fd\r\nLe 2019-03-05 10:26:39\r\n \r\ndscsdc df d', 1, 'dd a dit : \rdd a dit : \r', NULL, '2019-03-05 09:29:01', '2019-03-06 12:29:50'),
(13, 8, 'gbg', 1, NULL, NULL, '2019-03-05 09:31:38', '2019-03-05 09:31:38'),
(14, 8, 'rfrf', 1, NULL, NULL, '2019-03-05 09:39:33', '2019-03-05 09:39:33'),
(15, 8, 'azaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\naaaaaaaaaaaaaaaaaaaa', 1, 'azaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\r', 10, '2019-03-05 09:49:06', '2019-03-06 12:29:50'),
(16, 8, 'J\'aime \r\nLe \r\nSe\r\ndddd', 1, 'J\'aime \rLe \r', 15, '2019-03-05 09:50:01', '2019-03-06 12:29:50'),
(17, 8, 'a\r\na', 1, NULL, 16, '2019-03-05 09:50:27', '2019-03-05 09:50:27'),
(18, 8, 'moi aussi', 1, NULL, 10, '2019-03-05 09:58:21', '2019-03-05 09:58:21'),
(19, 8, 'prem\'s', 2, NULL, NULL, '2019-03-05 09:59:00', '2019-03-05 09:59:00'),
(20, 8, 'moi deuze', 2, NULL, 19, '2019-03-05 09:59:17', '2019-03-05 09:59:17'),
(21, 8, 'moi troize', 2, NULL, 20, '2019-03-05 10:00:47', '2019-03-05 10:00:47'),
(22, 8, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, '2019-03-05 10:04:34', '2019-03-05 13:41:47'),
(23, 8, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, '2019-03-05 10:31:37', '2019-03-05 13:41:47'),
(24, 8, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, NULL, NULL, '2019-03-05 11:25:10', '2019-03-05 11:25:10'),
(25, 8, 'sddcsdcsfsedf', 2, NULL, 23, '2019-03-05 12:27:03', '2019-03-05 12:27:03'),
(26, 8, 'dqdqd\r\nqd\r\nqdq\r\nd\r\nq\r\ndqd', 2, 'dqdqd\rqd\r', NULL, '2019-03-05 12:27:54', '2019-03-05 13:41:47'),
(27, 8, 'dededede', 2, NULL, 26, '2019-03-05 12:31:11', '2019-03-05 12:31:11'),
(28, 8, 'J\'aime\r\nLa \r\nBite', 2, 'J\'aime\rLa \r', NULL, '2019-03-05 12:33:12', '2019-03-05 13:41:47'),
(29, 8, 'J\'aime\r\nla \r\ngrosse\r\nbite', 2, 'J\'aime\rla \r', NULL, '2019-03-05 12:33:46', '2019-03-05 13:36:48'),
(30, 8, 'moi aussi', 2, NULL, NULL, '2019-03-05 12:48:22', '2019-03-05 12:48:22'),
(31, 8, 'f\r\nf\r\nf\r\nf', 2, 'f\rf\r', NULL, '2019-03-05 12:48:48', '2019-03-05 13:36:48'),
(32, 8, 'dqdqzd', 2, NULL, 28, '2019-03-05 13:02:22', '2019-03-05 13:02:22'),
(33, 8, 'efsefsefesf', 2, NULL, 30, '2019-03-05 13:03:09', '2019-03-05 13:03:09'),
(34, 8, 'a', 2, NULL, 30, '2019-03-05 13:07:32', '2019-03-05 13:07:32'),
(35, 8, 'a', 2, NULL, 30, '2019-03-05 13:07:37', '2019-03-05 13:07:37'),
(36, 8, 'a', 2, NULL, 30, '2019-03-05 13:07:42', '2019-03-05 13:07:42'),
(37, 8, 'scscs', 3, NULL, NULL, '2019-03-05 13:47:57', '2019-03-05 13:47:57'),
(38, 8, 'scscs', 3, NULL, NULL, '2019-03-05 13:48:47', '2019-03-05 13:48:47'),
(39, 8, 'csdcw', 1, NULL, NULL, '2019-03-06 11:40:20', '2019-03-06 11:40:20'),
(40, 8, 'cwsc', 1, NULL, NULL, '2019-03-06 11:40:31', '2019-03-06 11:40:31'),
(41, 8, 'bbb', 1, NULL, NULL, '2019-03-06 12:02:29', '2019-03-06 12:02:29'),
(42, 8, 'ddc', 1, NULL, NULL, '2019-03-06 12:03:22', '2019-03-06 12:03:22'),
(43, 8, 'fcsdf\r\nds\r\nfs\r\ndf\r\nsf', 1, 'fcsdf\rds\r', NULL, '2019-03-06 12:05:31', '2019-03-06 12:29:58'),
(44, 8, 'sdqcqcqsc\r\nsc\r\ns\r\ns\r\ns\r\ns', 1, 'sdqcqcqsc\rsc\r', NULL, '2019-03-06 12:07:25', '2019-03-06 12:29:58'),
(45, 8, 'fcdc', 1, NULL, NULL, '2019-03-06 12:15:08', '2019-03-06 12:15:08'),
(46, 8, 'scdqs\r\ns\r\ns\r\ns\r\ns\r\ns', 1, 'scdqs\rs\r', NULL, '2019-03-06 12:18:20', '2019-03-06 12:29:58'),
(47, 8, 'yes', 1, NULL, 46, '2019-03-06 12:29:01', '2019-03-06 12:29:01');

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2014_10_12_000000_create_users_table', 1),
(18, '2014_10_12_100000_create_password_resets_table', 1),
(19, '2019_02_12_140121_create_sujets_table', 1),
(20, '2019_02_12_140245_create_comments_table', 1),
(21, '2019_02_12_140309_create_likes_table', 1),
(22, '2019_02_12_140322_create_scores_table', 1),
(23, '2019_02_12_140340_create_quizzes_table', 1),
(24, '2019_02_12_140352_create_questions_table', 1);

--
-- Déchargement des données de la table `sujets`
--

INSERT INTO `sujets` (`id`, `title`, `idUser`, `nbrMessages`, `created_at`, `updated_at`) VALUES
(1, 'aa', 1, 27, '2019-02-28 14:34:34', '2019-03-06 12:29:01'),
(2, 'italique', 8, 18, '2019-03-05 09:58:48', '2019-03-05 13:07:42'),
(3, '3', 8, 2, '2019-03-05 13:42:03', '2019-03-05 13:48:47');

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rem Pap', 'remipapin6@gmail.com', NULL, '$2y$10$UoY.XlXkEStQHNKffsclIe/b2QyjM4LZ59zzJhJmJbeIMe2W2xQhe', 'pictures/avatar.png', NULL, '2019-02-28 14:32:18', '2019-02-28 14:32:18'),
(2, 'dcdcd', 'remipapin6@gmail.co', NULL, '$2y$10$vVIdUz.bO2Bop8HazxGGc.VtV85c8lcAdYLh6eaXd4YsErt/K3bfq', 'pictures/avatar.png', 'g1NKN9Q1vCaXmjwfWdP4GExc8RKA4QL6ga2IyTZeVa6g9pPRB1lyAELaKuBl', '2019-03-04 10:11:31', '2019-03-04 10:11:31'),
(3, 'Rémi PAPIN', 'remipapin6@gmail.c', NULL, '$2y$10$7WN0/4h0bijbODgYoG/kD.vlqttnPE9BF5kwyd9JnqkRLwk8Yzc2e', 'pictures/avatar.png', 'oYjc5TwQUMeQjAL9kt2rGSyO781fMclg0Wl8VbgK91Bs9b8ceqtRmjpQTHvS', '2019-03-04 10:25:21', '2019-03-04 10:25:21'),
(4, 'fg', 'remipapin6@gmail.ju', NULL, '$2y$10$k0eu6OpNDyrQrfODcvFNIuuNpoYgOwPqdf9/V/5Bae6oLU45iFWRm', 'pictures/4FpDW1Z73v.png', 'pEIog90LnztrFZQGEBLYZlYc8OBMiuB8zoBAZYBmqDBhDrg07j12dzMrr3gu', '2019-03-04 10:28:35', '2019-03-04 10:28:35'),
(5, 'dscd', 'remipapin6@gmail.ji', NULL, '$2y$10$VLuQ6P1BUqfCmak2s9o8Mu26iISMO9ieImgUyYHOD8hv/Wx2oE7iq', 'pictures/Ej9MaZWKsm.png', 'KZlHXUbSuGhAPtQVeBx9r81wnxY3k5JnlmyLjqImZqeXAUCNkoNfWg8rVOE5', '2019-03-04 10:38:24', '2019-03-04 10:38:24'),
(6, 'J\'aimeLeCheval', 'cheval@gmail.com', NULL, '$2y$10$Nimklh9QYNI8Kawz/LuIiO7GRlWKFLLYqdQjEAB4rP.G6qrn4oOZq', 'pictures/vZqhDpR2yB.jpg', 'LOGyUh7wujEF8M3wukKogm3Pf0LoqOa705mmCOCQsWsPXy1ofpWFwvylOAfy', '2019-03-04 12:39:28', '2019-03-04 12:39:28'),
(7, 'Image', 'r@g.gt', NULL, '$2y$10$2fri4yKxAiMR4pEASAq92e1/QedAdSjd2zJ7a53WWLSZYlnIi/07W', 'pictures/acCWV6H2S2.jpg', '6arElhkqSAwPQTFCyqofUwyhfSnUaJLyyHT6LepcGsKOWt2XUfADcSeC5nSo', '2019-03-04 13:18:04', '2019-03-04 13:18:04'),
(8, 'dd', 'd@f.fr', NULL, '$2y$10$/14mK7wI/1KWT5Uyru2qG.KKaSf5k.tI07oa1oQBcpHVb.MLWKIpS', 'pictures/tmXuhdGN8n.jpg', 'lC0QiKDv1wCUM8Tek8Wf4ev7Yrl6oqjaRHzx8RJzp4F7jrfVIB59am62hKXI', '2019-03-04 13:22:50', '2019-03-04 13:22:50'),
(9, 'dzd', 'qdq@f.fr', NULL, '$2y$10$GbE2QG0ejKLF5ijoJkwiPupUjMd38kxXyg5dDUVINPltggaq1hViC', 'pictures/vhaFzWiwZq.jpg', 'Df3tGitp7dhk6UUdt1qMKKIvnjPXjgR5XlZIaYBkPHO04TTUgESdWSeLDWfB', '2019-03-04 13:43:55', '2019-03-04 13:43:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
