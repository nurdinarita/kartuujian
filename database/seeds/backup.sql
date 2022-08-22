-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 04:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.10

--
-- Database: `digyta_cepenes`
--

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `correct`, `created_at`, `updated_at`) VALUES
(1, 1, '3', 1, '2021-04-16 06:22:57', '2021-04-16 06:22:57'),
(2, 1, '5', 0, '2021-04-16 06:22:57', '2021-04-16 06:22:57'),
(3, 1, '7', 0, '2021-04-16 06:22:57', '2021-04-16 06:22:57'),
(4, 2, '4', 1, '2021-04-16 06:23:30', '2021-04-16 06:23:30'),
(5, 2, '6', 0, '2021-04-16 06:23:30', '2021-04-16 06:23:30'),
(6, 2, '8', 0, '2021-04-16 06:23:30', '2021-04-16 06:23:30'),
(7, 3, '7', 0, '2021-04-16 06:24:24', '2021-04-16 06:24:24'),
(8, 3, '9', 1, '2021-04-16 06:24:24', '2021-04-16 06:24:24'),
(9, 3, '11', 0, '2021-04-16 06:24:24', '2021-04-16 06:24:24'),
(10, 3, '20', 0, '2021-04-16 06:24:24', '2021-04-16 06:24:24');

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category`, `question`, `point`, `solution`, `created_at`, `updated_at`) VALUES
(1, 'twk', 'Soal twk (3)', 5, 'twk kan 3 huruf\r\njawaban = 3\r\ngitu', '2021-04-16 06:22:57', '2021-04-16 06:22:57'),
(2, 'tiu', 'soal tiu (4)', 5, 'sama sih,\r\ntiu kan 3 huruf\r\ntapi 3+1 kan 4\r\npaham ?', '2021-04-16 06:23:30', '2021-04-16 06:23:30'),
(3, 'tkp', 'Soal tkp nih (9)', 7, 'agak susah sih,\r\nkan tkp 3 huruf\r\n3 pangkat 2 = 9', '2021-04-16 06:24:24', '2021-04-16 06:24:24');

--
-- Dumping data for table `tryouts`
--

INSERT INTO `tryouts` (`id`, `title`, `slug`, `description`, `privacy_policy`, `duration`, `question`, `date`, `deleted`, `tags`, `price`, `published`, `created_at`, `updated_at`) VALUES
(1, 'Judul', 'judul', 'deskripsi', 'syarat & ketentuan', 100, 3, '2021-01-01 00:00:00', 0, 'terbaru,best seller', 45000, 1, '2021-04-16 04:07:30', '2021-04-16 07:00:39');

--
-- Dumping data for table `tryout_questions`
--

INSERT INTO `tryout_questions` (`id`, `tryout_id`, `question_id`, `created_at`, `updated_at`) VALUES
(3, 1, 3, '2021-04-16 06:58:04', '2021-04-16 06:58:04'),
(4, 1, 2, '2021-04-16 06:58:11', '2021-04-16 06:58:11'),
(6, 1, 1, '2021-04-16 07:00:28', '2021-04-16 07:00:28');
