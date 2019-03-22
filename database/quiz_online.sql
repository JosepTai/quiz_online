-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2019 at 11:15 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_user`
--

CREATE TABLE `class_user` (
  `class_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `duration` int(11) NOT NULL,
  `ststus` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `endtime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

CREATE TABLE `exam_question` (
  `exam_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_user`
--

CREATE TABLE `exam_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `score` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_user_status`
--

CREATE TABLE `exam_user_status` (
  `status_id` int(10) UNSIGNED NOT NULL,
  `exam_user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_09_144651_create_modules_table', 1),
(4, '2019_03_09_144653_create_classes_table', 1),
(5, '2019_03_09_144906_create_status_table', 1),
(6, '2019_03_09_155448_create_questions_table', 1),
(7, '2019_03_09_155643_create_tests_table', 1),
(8, '2019_03_09_155644_create_exams_table', 1),
(9, '2019_03_09_155645_create_exam_user_table', 1),
(10, '2019_03_09_155823_create_results_table', 1),
(11, '2019_03_09_160046_create_class_user_table', 1),
(12, '2019_03_09_160510_create_exam_question_table', 1),
(13, '2019_03_09_161439_create_exam_user_status_table', 1),
(14, '2019_03_16_140829_create_chapters_table', 1),
(15, '2019_03_16_140840_create_parts_table', 1),
(16, '2019_03_16_140853_create_part_question_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(10) UNSIGNED NOT NULL,
  `chapter_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `part_question`
--

CREATE TABLE `part_question` (
  `part_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `level`, `user_id`, `content`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `correct_answer`, `created_at`, `updated_at`) VALUES
(1, 'easy', 9, 'A eum ullam minima vitae consectetur aut. Sit molestiae consectetur sit. Et unde dolorem dolores.', 'Incidunt.', 'Fugit.', 'Voluptate.', 'Illo.', 'Illo.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(2, 'hard', 2, 'Omnis non nobis ut beatae nam eius. Excepturi at enim qui omnis ipsa ipsa odio.', 'Qui illo.', 'Vel quas.', 'Deleniti.', 'Ea aut.', 'Deleniti.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(3, 'easy', 9, 'Temporibus repellendus cum unde impedit illo vitae voluptatibus. Provident tenetur facilis modi.', 'Fugit in.', 'Fugiat.', 'Nobis.', 'Voluptas.', 'Fugit in.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(4, 'easy', 1, 'Sapiente vel eaque quo. Quam ut aut facere eum. Ducimus repudiandae quia aut dolores.', 'Iste quod.', 'Quibusdam.', 'Sed.', 'Repellat.', 'Repellat.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(5, 'hard', 3, 'Alias est qui pariatur fuga. In rerum provident odit.', 'Saepe.', 'Ut.', 'Enim et.', 'Omnis.', 'Saepe.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(6, 'easy', 2, 'Tenetur et iure ducimus minus amet. Aut error eum assumenda quos. Atque et culpa dolor.', 'Maxime.', 'Veniam.', 'Autem.', 'Quam ut.', 'Veniam.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(7, 'hard', 3, 'Quia in eveniet non nesciunt. Debitis distinctio ut magnam eos rem mollitia.', 'Dolor.', 'Officiis.', 'Unde.', 'Voluptas.', 'Voluptas.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(8, 'hard', 8, 'Sint animi sint alias aut consequatur. Adipisci et ad beatae sequi et dolores sunt voluptatem.', 'Animi.', 'Suscipit.', 'Ad ea.', 'Provident.', 'Suscipit.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(9, 'hard', 8, 'Et iure culpa et vel magnam quis sequi. Qui at ipsa expedita ut. Provident et et est.', 'Id quo.', 'Veritatis.', 'Error.', 'Non vel.', 'Id quo.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(10, 'easy', 6, 'Sunt rerum quo soluta est voluptatem maxime eos accusantium. Et repudiandae omnis tenetur dicta.', 'Amet ad.', 'Alias.', 'Possimus.', 'Nostrum.', 'Possimus.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(11, 'hard', 8, 'Eius omnis eos totam. Minima a numquam qui. Sit earum veniam et consequatur qui.', 'Est ea.', 'Labore.', 'Est porro.', 'Quia.', 'Labore.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(12, 'hard', 10, 'Sed esse molestiae unde ipsam. Consequatur iste neque sunt nam praesentium voluptatem.', 'Tempora.', 'Optio sit.', 'Autem.', 'Et.', 'Et.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(13, 'easy', 2, 'Possimus libero vero beatae et omnis sed. Commodi quo a voluptatem a qui tenetur.', 'Ut.', 'Similique.', 'Quis et.', 'Ut modi.', 'Ut modi.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(14, 'hard', 5, 'Ab sit ea quibusdam est facilis placeat libero illo. Nostrum deleniti et ipsa nihil hic.', 'Amet aut.', 'Ipsam.', 'Hic est.', 'Quos ex.', 'Ipsam.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(15, 'easy', 4, 'Eos enim velit nesciunt et dolor quo. Quo deserunt et illo. Tempora laboriosam est alias inventore.', 'Qui quasi.', 'Et.', 'Quo.', 'Quia.', 'Quia.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(16, 'easy', 2, 'Quisquam officiis fugiat omnis nobis aspernatur animi quae. Quis vel et libero ut neque at fugiat.', 'Unde.', 'Sunt at.', 'Fugit qui.', 'Accusamus.', 'Unde.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(17, 'hard', 7, 'Quasi consectetur et et nobis sit facere. Suscipit ea quo aut odit. Ipsum at sed illum quia.', 'Odit.', 'Libero.', 'Mollitia.', 'Quae.', 'Mollitia.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(18, 'easy', 3, 'Quas velit sunt maxime. Accusamus illum rerum temporibus fuga necessitatibus qui.', 'Excepturi.', 'Voluptate.', 'Vel.', 'Eos quia.', 'Excepturi.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(19, 'easy', 1, 'Ea et harum vel molestiae et quia aut. Ad qui illo doloribus eos.', 'Rerum.', 'Totam.', 'Veniam.', 'Unde et.', 'Rerum.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(20, 'easy', 3, 'Non qui nesciunt sit. Et exercitationem nesciunt commodi sed. Labore accusamus ratione non est.', 'Animi vel.', 'Ullam.', 'Tempore.', 'Ut.', 'Tempore.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(21, 'easy', 8, 'Ut facere nulla tempore enim minus. Modi nobis magnam corporis.', 'Dolorum.', 'At ullam.', 'Sed.', 'Eius.', 'Dolorum.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(22, 'hard', 2, 'Mollitia ex velit laborum qui aut. Minus libero quia libero nesciunt omnis.', 'Harum.', 'Qui autem.', 'Et.', 'Et non.', 'Et.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(23, 'easy', 2, 'Soluta delectus qui et sapiente. Quia ut sint suscipit voluptas sed occaecati reprehenderit et.', 'Error.', 'Iure.', 'Quasi.', 'Sunt.', 'Sunt.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(24, 'hard', 7, 'Dolore facere et sed est autem est aut. Ut reprehenderit iure porro corporis.', 'Eos nam.', 'Iusto.', 'Voluptas.', 'Animi est.', 'Eos nam.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(25, 'easy', 7, 'Sit sint inventore in voluptas dolor consequatur. Quia dolores non non perspiciatis inventore.', 'Eum.', 'Assumenda.', 'Sed ut.', 'Beatae.', 'Assumenda.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(26, 'easy', 6, 'Veritatis architecto expedita quia dolores. Aspernatur est iure id ut beatae dolor minus.', 'Tempore.', 'Porro et.', 'Ea odit.', 'Suscipit.', 'Tempore.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(27, 'easy', 3, 'Inventore cupiditate rem quo qui dolorem. Molestiae omnis nam dolorum laudantium distinctio.', 'Dolor.', 'Veritatis.', 'Dolores.', 'Quia.', 'Quia.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(28, 'hard', 6, 'Est rem nesciunt porro. Et odit possimus voluptatibus nesciunt aut non.', 'Esse.', 'Aut eius.', 'Et.', 'Veritatis.', 'Esse.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(29, 'easy', 5, 'Velit voluptatem aspernatur nulla accusantium. Facilis totam tempora aut qui aut a qui quam.', 'Magnam ea.', 'Sint.', 'Magni.', 'Non modi.', 'Sint.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(30, 'hard', 7, 'Nihil tempore distinctio facilis eligendi non autem qui. Facere adipisci ea dolorum.', 'Sit.', 'Molestias.', 'Sit.', 'Nesciunt.', 'Sit.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(31, 'hard', 2, 'Ratione quod rerum architecto est rerum in commodi. Unde molestias a veniam.', 'Beatae.', 'Iusto.', 'Excepturi.', 'Officia.', 'Beatae.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(32, 'hard', 8, 'Et eum eligendi odit repellat minus id. Dolore qui suscipit dolorem unde quasi et veritatis.', 'Illum.', 'Nisi.', 'Expedita.', 'Eos.', 'Eos.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(33, 'hard', 5, 'Velit et velit id. Qui numquam omnis veritatis. Ipsam deleniti quo officia et eum ut qui.', 'Veritatis.', 'Doloribus.', 'Doloribus.', 'Aliquid.', 'Doloribus.', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(34, 'easy', 8, 'Ea enim id saepe placeat et dignissimos. Et maiores commodi aut. Sed et blanditiis quo ratione.', 'Nostrum.', 'Cum et.', 'Qui.', 'Corrupti.', 'Corrupti.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(35, 'easy', 10, 'Eligendi sint labore cum omnis voluptatem ea. Ut est dolore autem qui.', 'Dicta.', 'Qui rerum.', 'Eos ut.', 'Ea.', 'Dicta.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(36, 'easy', 4, 'Aut sed corrupti non non. Voluptates natus placeat voluptates harum.', 'Sint.', 'Est illum.', 'Excepturi.', 'Qui autem.', 'Excepturi.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(37, 'hard', 1, 'Sit sed vero est similique voluptas. Cupiditate qui quod et rerum.', 'Animi.', 'A qui.', 'Dolores.', 'Provident.', 'Animi.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(38, 'hard', 7, 'Vero quia in dolores explicabo assumenda. Aut accusantium necessitatibus voluptas nesciunt est.', 'Vel.', 'Et odio.', 'Sunt a.', 'Et qui.', 'Et odio.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(39, 'easy', 6, 'Qui non est accusantium iste qui ex. Omnis aliquid dolore voluptatem porro.', 'Est.', 'Autem qui.', 'Tempore.', 'Ad.', 'Ad.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(40, 'hard', 9, 'Velit ipsum iste earum debitis. Vitae et a non repudiandae quas occaecati cumque.', 'Provident.', 'Harum.', 'Non dolor.', 'Accusamus.', 'Provident.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(41, 'easy', 9, 'Qui iste quae excepturi illo. Enim est est eos explicabo.', 'Voluptas.', 'Minima.', 'Veniam.', 'Ut.', 'Minima.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(42, 'easy', 3, 'Maiores et omnis et. Facilis expedita ut ut velit. Distinctio deserunt reiciendis quia provident.', 'Corrupti.', 'Ea soluta.', 'Iste.', 'Ullam.', 'Ea soluta.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(43, 'easy', 3, 'Ut et voluptatem nihil ut eius optio qui. Et fuga dicta eius nisi vel temporibus.', 'Nemo.', 'Commodi.', 'Ipsam.', 'Deserunt.', 'Nemo.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(44, 'hard', 2, 'Odio hic ipsam vitae sunt commodi. Dolor voluptatibus et at velit. Quae corporis optio magni ipsam.', 'Ut libero.', 'Modi modi.', 'Quo ut a.', 'Est qui.', 'Ut libero.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(45, 'easy', 1, 'Ullam nihil exercitationem sint suscipit et. Vitae sit ut nam sit. Dolor et ea maiores amet autem.', 'Iste qui.', 'Veritatis.', 'Qui ullam.', 'Tempora.', 'Veritatis.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(46, 'hard', 1, 'Maxime enim quis dolor et dolorem. Praesentium nisi facere et voluptatem facere omnis fugit.', 'Et eaque.', 'Est est.', 'Culpa est.', 'Quae et.', 'Est est.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(47, 'hard', 10, 'Enim ut sequi aperiam. Ex vel molestiae ratione aut. Voluptas quae qui omnis.', 'Velit.', 'Et.', 'Debitis.', 'Quos sed.', 'Quos sed.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(48, 'hard', 10, 'Sapiente cum dolor nobis totam explicabo. Incidunt sint ipsum est quaerat voluptas est esse.', 'Error cum.', 'Error.', 'Et.', 'Illum.', 'Illum.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(49, 'hard', 2, 'Optio velit hic suscipit. Aut porro ad sed rerum quisquam in et.', 'Iste.', 'Ea.', 'Rem.', 'Aliquam.', 'Rem.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(50, 'hard', 7, 'Temporibus autem tenetur enim nostrum. Libero sit magnam natus neque sed iusto quae.', 'Totam est.', 'Id et et.', 'Officiis.', 'Et.', 'Totam est.', '2019-03-16 07:45:47', '2019-03-16 07:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_user_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `user_selected` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 6, 'Culpa dolor qui.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(2, 10, 'Voluptas quos eos.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(3, 4, 'Porro ducimus.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(4, 3, 'Voluptatum labore.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(5, 7, 'Corporis rerum ut.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(6, 6, 'Ab corrupti sed ut.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(7, 1, 'Qui voluptas nemo.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(8, 1, 'Sit exercitationem.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(9, 9, 'Voluptatem aut nemo.', '2019-03-16 07:45:47', '2019-03-16 07:45:47'),
(10, 7, 'Enim laboriosam.', '2019-03-16 07:45:47', '2019-03-16 07:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kailee Greenholt', 'nprice@harris.com', '2019-03-16 07:45:42', '$2y$10$5aG3Tx68w1j8uFoFQmRnT.SvvZIirW8A49A1WxlM2yXogqY5LZlta', 'W7r9FAODqW', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(2, 'Christine Wisoky', 'theresa81@kiehn.com', '2019-03-16 07:45:42', '$2y$10$yC9nXOUH1C2ElEIevAYZwOV084YY4Uw/lLoBZ3EiCwGOgm0KgGSiO', 'ewtyGxeWRi', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(3, 'Jayne Gislason', 'vicenta.hayes@armstrong.com', '2019-03-16 07:45:42', '$2y$10$zWOfen2tv.6xu3DKcmirc.wRlsydeAY5qBp/6PmJVuvUN6ylb0ztq', 'XyQNIFSyLd', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(4, 'Dr. Virgie Reichert', 'luettgen.lori@konopelski.com', '2019-03-16 07:45:42', '$2y$10$gXcN3fFVQX9DXjUuBZrv/.FnY5nfG2M3VR2v/teKFU2i4izuwNr0m', 'LE1T8QjR0U', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(5, 'Floy Mraz', 'kertzmann.mckayla@ferry.biz', '2019-03-16 07:45:42', '$2y$10$cCz9my77MnaQA4/0ocwKBuQBezeF5yYIFlYGe3MM..61ZpZoh.qYO', 'dUdw3lVtJ7', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(6, 'Juanita Adams I', 'oconnell.pierce@howell.info', '2019-03-16 07:45:42', '$2y$10$MRk.ipnJzFsn0ym0PoNd6OwjQ1n4DD6X0M1YF2itsr9YH7lVyL1ZC', 'KwQhIhc2UI', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(7, 'Prof. Brant Rempel II', 'zwisozk@kemmer.biz', '2019-03-16 07:45:42', '$2y$10$pCzBpq7nKCqjaDh69Qp9V..dhpO7R5VQzhhDjc28o0NemdCG0sZYG', 'LDFs6IOjBU', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(8, 'Beau Bailey', 'keira69@gutkowski.com', '2019-03-16 07:45:43', '$2y$10$qnJbhq6g00C83Nx8HxcJyukA8Dr5TGvQROFysetpk6oAZPk3B0Apq', 'UaslP0s4RO', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(9, 'Letitia Pouros', 'kwalker@veum.com', '2019-03-16 07:45:43', '$2y$10$mSkYmou7NNSUSGxYQcDivuszGRVhyKrd2x4KjsPWcmkX781Lc9xQq', '4TjEH0P5ff', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(10, 'Jordy Schaefer', 'marshall69@mohr.info', '2019-03-16 07:45:43', '$2y$10$y0P8grRrtTHO61Zy4SR/i.hphx1a0uDmF60/aycO.elhSKsE925OG', 'NjR8V6vBQZ', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(11, 'Adolph Beier', 'haley.leda@kuphal.com', '2019-03-16 07:45:43', '$2y$10$TVDxWVBUNK.wCKADA7vCrulz6RydBc.wQofaXRSTeSYdLjQLbmPse', '4135bxTGzO', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(12, 'Mrs. Stacey Grady', 'bernier.zachariah@pagac.biz', '2019-03-16 07:45:43', '$2y$10$HuT1k2ubE9i9IGfs/cMdp.LR5Mz4eSSBOH/dSYJrDQzcYQ37Px2rC', 'Sk7iAOuwpq', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(13, 'Eliza Schaden', 'tatyana.wiegand@balistreri.com', '2019-03-16 07:45:43', '$2y$10$cPHxyHYtSRWcsiZHFpSumeh2mMO0wnT1ZP7Uy.VHjjWv8f4mJUS1m', 'V5rUSNgYHV', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(14, 'Mandy Waters', 'wayne04@witting.com', '2019-03-16 07:45:43', '$2y$10$tHcY1J1EAEeP.8uhoJHPcOLCcqgXt3TZwCTPejuZM66MuodyAwNU2', 'u2HbzXJ8Ne', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(15, 'Hulda Friesen DDS', 'kstrosin@murray.info', '2019-03-16 07:45:43', '$2y$10$GbnnNlKyLh7P.DIQkgxFteZmPYSZdOG7r8VZ2Gx7OsQhpXqj80TZu', 'r5IICqrALD', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(16, 'Dr. Candace Pagac Jr.', 'francesca.crona@ward.com', '2019-03-16 07:45:43', '$2y$10$/q3.xasalBMxk0bOM8lh7unlUXqBzKO.FOVA8phd6o3jb0HIUf61O', 'DMM3NZuq6S', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(17, 'Sydnee Dare', 'estella.treutel@hessel.com', '2019-03-16 07:45:43', '$2y$10$XTP7yqPsv0dTZhl6GP0Zx.QmRqGve1mFhEL0tzHRPvBCZCUUBa0CG', '2dVWsDUHTl', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(18, 'Magnolia Schulist III', 'kcarter@bogisich.org', '2019-03-16 07:45:43', '$2y$10$K5CHR6qQPw3CZoek.GOqpOL7/1Rg1YayoB4OkaaVInTivC61WP24O', 'Ynwxwvicps', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(19, 'Dr. Milan Dickinson DDS', 'tabitha58@hermann.info', '2019-03-16 07:45:43', '$2y$10$A0HuLBqDqVgAh.o2JumBl.UunA0ytH3zuXcZ4pfnqt3Zmdc1X246m', 'Ug11twjaEE', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(20, 'Prof. Kameron Lueilwitz', 'jaime61@fay.org', '2019-03-16 07:45:44', '$2y$10$lyg8GIcuxfCmm7fQqcqMAufTTGQcnuQWv0enbnd/ATVHG4EEe5olG', 'zk4fAznURR', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(21, 'Odie Harvey', 'jennyfer13@tromp.com', '2019-03-16 07:45:44', '$2y$10$qnm1oDx1KWHUPC7PZNiucezZYNG7yYGLBSBlDltMozDH1y5nGxGiG', 'MLHZEtO5zq', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(22, 'Forrest Daugherty', 'shaina.von@bergnaum.com', '2019-03-16 07:45:44', '$2y$10$dpF3jzV.5PowAc3AGJFQVuMT1TBofiI/BNuZ1OW4fJ7Ek70Rad5u6', 'i0UIlPDHar', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(23, 'Lilian O\'Kon', 'devante.murray@predovic.info', '2019-03-16 07:45:44', '$2y$10$80yzTNEgOW8GPoc0LO/6HeRnvyi/mfrVpJPKhd6YEHbZw3as3Mdu6', 'INdRaSTcVw', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(24, 'Danielle Veum', 'marjolaine90@mitchell.com', '2019-03-16 07:45:44', '$2y$10$cSabMU.zp2zJNRNkxmQnJ.uPI6hcT5pKoc8nnPXSNXZmL9EqnC.9O', '21HLDWULkS', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(25, 'Gabriella Purdy', 'rhiannon.jerde@rolfson.net', '2019-03-16 07:45:44', '$2y$10$hcDVyV.6TMvVBfS6c3CnVex8zROSP7Cb2qdzvuM.zo/B9UDA5pXHi', '0uK46AyPwA', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(26, 'Noah Howe', 'witting.luna@schultz.org', '2019-03-16 07:45:44', '$2y$10$BiOkpiVr3OEVxPwoeB/nKe/.qIS4c571Yfcx3x4rC9nn38MkkxD1a', 'BchEWcRYqx', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(27, 'Laurence Pagac IV', 'johnson.bethany@volkman.com', '2019-03-16 07:45:44', '$2y$10$qEeWbxlq0ImDbNiMxfZ5rOj.f2Ln45Jmwp7.AdMQn1JNyT5MgPz8K', 'yK9QYk22A2', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(28, 'Dr. Austyn Mraz', 'maeve.kreiger@lebsack.info', '2019-03-16 07:45:44', '$2y$10$TbPErf5UIi0K5QJebIgk6OyNrJP1S8VAVWfgj5eQj.rzChkWckLme', 'bIBao2tYEU', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(29, 'Deondre Mayert', 'nasir43@dubuque.com', '2019-03-16 07:45:44', '$2y$10$DcWeZOjQqe6TDraVKXAc8OM0wBL1uQ7K/ZE.uvQnxMmSvbYTPxYN.', 'B5tYAsTdtm', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(30, 'Montana Torphy PhD', 'lwehner@graham.biz', '2019-03-16 07:45:44', '$2y$10$hw0sgANrGt9K8t8q/iiwU.26TM2MAPd0gmBG2vMCTEPTtnpnY9Amq', 'dzJvnnjKdC', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(31, 'Jean Welch', 'abel71@dibbert.com', '2019-03-16 07:45:44', '$2y$10$OW4Xi5x0MmeEbRHgw5muguTV/5./sDLNii15EdmtAcNvtBmJ1uIUS', 'GWKpjb8oEu', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(32, 'Dr. Kiera Yost III', 'hector60@hodkiewicz.info', '2019-03-16 07:45:45', '$2y$10$upqe4noXFItgv4DVOJI4t.hesXig3jThyWXD4Z78MbKlAAjI73eby', 'o01EHRRjoJ', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(33, 'Nella Goodwin', 'bmarks@simonis.com', '2019-03-16 07:45:45', '$2y$10$cUJh9oBJU./DeZpPaAwUlOcvRSJVXsZNkL9bXSRMNMnQCMX/Izxh.', 'xQCzEtckHH', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(34, 'Harley Marks DVM', 'uriah.green@oberbrunner.biz', '2019-03-16 07:45:45', '$2y$10$qFBkDuv81js0TbD0NypMPOcjtIwZ1RqElFEANWQJqC0rJhzdVASz6', '7vtHPTCh0p', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(35, 'Miss Elinore White IV', 'steuber.stefan@russel.org', '2019-03-16 07:45:45', '$2y$10$IxS3GQjtCQq96XacCqwaeudLHR39oJM.aqmD1tEi9CwcmVDVbUo8a', 'aSZ9xSYZmn', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(36, 'Easton Murazik', 'toy.roselyn@sanford.com', '2019-03-16 07:45:45', '$2y$10$gGCOxvnS0eRS6mCzMlmCHeCtrE4is0VEZX2wj3qE1WRmhYrGv7ZA6', 'Pzpzeauc4C', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(37, 'Wilhelmine Zboncak', 'smitham.rachael@eichmann.com', '2019-03-16 07:45:45', '$2y$10$ayKty.ZN8NDoHDQeOMWW1.9.B./Uyvs0htOjJOxTlKDUcrhwwj..e', 'aiycnkQKeN', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(38, 'Grant Cummerata', 'price.ola@kshlerin.info', '2019-03-16 07:45:45', '$2y$10$Icz52HU2FL5UZ0IbNk/zQeVC2IWcU9Gu6WlnZcc4AJYbKmRrqiSm2', 'RlgQxwGfai', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(39, 'Ellis Gerhold PhD', 'daniela.pacocha@quigley.com', '2019-03-16 07:45:45', '$2y$10$2PMLStxMk7wjH3I0XW0V5u/f1bEZq6Rra1sHmrsPpZE3BoBJG6sr2', 'ofwAhT0JEo', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(40, 'Prof. Isaac Rowe DDS', 'cgottlieb@conroy.info', '2019-03-16 07:45:45', '$2y$10$qsyZhPu1UOe7vKmmGceDo.CYRgdQfvhU2rHIDDhRXgcsnjsOjOjJ.', 'SAgzWA2Fry', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(41, 'Alaina Bailey', 'bette.marvin@haag.org', '2019-03-16 07:45:45', '$2y$10$guMzCQVcF8ZHMQleqxF/Oe/JG8IlVh/ikXcnvzLrz4cvVKePUvPgW', 'cS9cbeyWZj', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(42, 'Roslyn Gottlieb DVM', 'rau.kiera@greenfelder.com', '2019-03-16 07:45:45', '$2y$10$oG/LTq0EpAKhkZhHCofcI.L2M5OLJtIkatuqNanMCg1oMN4uQgUnS', '9OTvstwtn2', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(43, 'Dedric Russel', 'pacocha.brycen@metz.com', '2019-03-16 07:45:45', '$2y$10$W610dLdnOYY2ygJUKTlkI.SqBRvQFmQkx4tOvYwrKA0lJ42SOgSpW', 'iGoMBQmGxO', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(44, 'Norberto Schiller', 'parker.diego@kohler.net', '2019-03-16 07:45:46', '$2y$10$VYLi/LKrmuarE3S./Pf3nuoK.muidN8s8N85jtDsqJxRS60Gsoht2', 'TmWYWi1PS1', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(45, 'Fausto Lindgren', 'hessel.althea@walter.org', '2019-03-16 07:45:46', '$2y$10$yZbCzrnPAR175Ybc4FFj/.M75uAynA7mMoUPAM/GKlsBVU3dNgQXu', 'lWJM5iJbRp', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(46, 'Jovany Kutch', 'xwatsica@parker.net', '2019-03-16 07:45:46', '$2y$10$L5Ijl.NhgFGFuMdHy.BZ7eNHYgcqily6XVBpzxvCNekjpVbuJHQw6', 'Op3Klc1L5Q', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(47, 'Marjorie Stanton', 'jbreitenberg@schultz.org', '2019-03-16 07:45:46', '$2y$10$aggj.vLYCiDugh2mVxtywOtqNjHe8CV2elx6CD.qVSg6q.nJfGuXC', '00QUers4EE', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(48, 'George Schmeler', 'wehner.anissa@vonrueden.com', '2019-03-16 07:45:46', '$2y$10$Ba3t.ITtND.WiyhSj.xK/uBdJqWBjoPbLAlITB8hybcE86vo2oSSi', 'TCxuQ6ZJyX', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(49, 'Dallas Adams', 'prosacco.ethel@pacocha.com', '2019-03-16 07:45:46', '$2y$10$9dJ5Wl/UxVAkC5mlYyfqpeH3MOcK.U3Y1JuZ0T0Oyg1OjIsAgDe3O', 'PXX3t35D0d', '2019-03-16 07:45:46', '2019-03-16 07:45:46'),
(50, 'Thelma Cormier Jr.', 'rskiles@thompson.org', '2019-03-16 07:45:46', '$2y$10$aeehNATRxGbw5xhq/kQRWOu3jt7oMo9rltPHGPoGaiqhUI2XGQ31G', 'tMYJrIKGLP', '2019-03-16 07:45:46', '2019-03-16 07:45:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_module_id_foreign` (`module_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_user_id_foreign` (`user_id`),
  ADD KEY `classes_module_id_foreign` (`module_id`);

--
-- Indexes for table `class_user`
--
ALTER TABLE `class_user`
  ADD KEY `class_user_class_id_foreign` (`class_id`),
  ADD KEY `class_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_class_id_foreign` (`class_id`),
  ADD KEY `exams_test_id_foreign` (`test_id`);

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD KEY `exam_question_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_question_id_foreign` (`question_id`);

--
-- Indexes for table `exam_user`
--
ALTER TABLE `exam_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_user_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `exam_user_status`
--
ALTER TABLE `exam_user_status`
  ADD KEY `exam_user_status_status_id_foreign` (`status_id`),
  ADD KEY `exam_user_status_exam_user_id_foreign` (`exam_user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_user_id_foreign` (`user_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parts_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `part_question`
--
ALTER TABLE `part_question`
  ADD KEY `part_question_part_id_foreign` (`part_id`),
  ADD KEY `part_question_question_id_foreign` (`question_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_exam_user_id_foreign` (`exam_user_id`),
  ADD KEY `results_question_id_foreign` (`question_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_user`
--
ALTER TABLE `exam_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `classes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `class_user`
--
ALTER TABLE `class_user`
  ADD CONSTRAINT `class_user_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `class_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `exams_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`);

--
-- Constraints for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD CONSTRAINT `exam_question_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`),
  ADD CONSTRAINT `exam_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `exam_user`
--
ALTER TABLE `exam_user`
  ADD CONSTRAINT `exam_user_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`),
  ADD CONSTRAINT `exam_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `exam_user_status`
--
ALTER TABLE `exam_user_status`
  ADD CONSTRAINT `exam_user_status_exam_user_id_foreign` FOREIGN KEY (`exam_user_id`) REFERENCES `exam_user` (`id`),
  ADD CONSTRAINT `exam_user_status_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`);

--
-- Constraints for table `part_question`
--
ALTER TABLE `part_question`
  ADD CONSTRAINT `part_question_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`),
  ADD CONSTRAINT `part_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_exam_user_id_foreign` FOREIGN KEY (`exam_user_id`) REFERENCES `exam_user` (`id`),
  ADD CONSTRAINT `results_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
