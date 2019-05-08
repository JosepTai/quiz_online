CREATE TABLE `chapters`
(
  `id` int,
  `name` varchar(255),
  `module_id` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `classes`
(
  `id` int,
  `name` varchar(255),
  `user_id` int,
  `module_id` int,
  `code` varchar(255),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `class_user`
(
  `class_id` int,
  `user_id` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `exams`
(
  `id` int,
  `title` varchar(255),
  `class_id` int,
  `duration` int,
  `status` text,
  `start_time` datetime,
  `end_time` datetime,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `exam_user`
(
  `id` int,
  `exam_id` int,
  `user_id` int,
  `score` double,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `modules`
(
  `id` int,
  `name` varchar(255),
  `user_id` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `parts`
(
  `id` int,
  `name` varchar(255),
  `chapter_id` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `questions`
(
  `id` int,
  `level` text,
  `part_id` int,
  `user_id` int,
  `content` varchar(255),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `users`
(
  `id` int,
  `name` varchar(255),
  `email` varchar(255),
  `email_verified_at` timestamp,
  `password` varchar(255),
  `remember_token` varchar(255),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `configs`
(
  `id` int,
  `exam_id` int,
  `part_id` int,
  `level` text,
  `amount` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `config_question`
(
  `config_id` int,
  `question_id` int,
  `user_id` int,
  `user_selected` char,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `answer`
(
  `id` int,
  `question_id` int,
  `content` varchar(255),
  `is_correct` bool,
  `created_at` timestamp,
  `updated_at` timestamp
);

ALTER TABLE `questions` ADD FOREIGN KEY (`id`) REFERENCES `config_question` (`question_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `classes` (`user_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `class_user` (`user_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `exam_user` (`user_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `modules` (`user_id`);

ALTER TABLE `exams` ADD FOREIGN KEY (`id`) REFERENCES `exam_user` (`exam_id`);

ALTER TABLE `exams` ADD FOREIGN KEY (`id`) REFERENCES `configs` (`exam_id`);

ALTER TABLE `classes` ADD FOREIGN KEY (`id`) REFERENCES `exams` (`class_id`);

ALTER TABLE `classes` ADD FOREIGN KEY (`id`) REFERENCES `class_user` (`class_id`);

ALTER TABLE `modules` ADD FOREIGN KEY (`id`) REFERENCES `classes` (`module_id`);

ALTER TABLE `modules` ADD FOREIGN KEY (`id`) REFERENCES `chapters` (`module_id`);

ALTER TABLE `chapters` ADD FOREIGN KEY (`id`) REFERENCES `parts` (`chapter_id`);

ALTER TABLE `parts` ADD FOREIGN KEY (`id`) REFERENCES `questions` (`part_id`);

ALTER TABLE `configs` ADD FOREIGN KEY (`id`) REFERENCES `config_question` (`config_id`);

ALTER TABLE `parts` ADD FOREIGN KEY (`id`) REFERENCES `configs` (`part_id`);

ALTER TABLE `questions` ADD FOREIGN KEY (`id`) REFERENCES `answer` (`question_id`);
