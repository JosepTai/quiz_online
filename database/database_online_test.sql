CREATE TABLE `user` 
(
	`id` integer,
	`name` varchar(255),
	`email` varchar(255),
	`email_verified_at` varchar(255),
	`password` varchar(255),
	`remember_token` varchar(255),
	`create_at` datetime,
	`update_at` datetime
);

CREATE TABLE `class` 
(
	`id` integer,
	`name` varchar(255),
	`id_user` integer,
	`create_at` datetime,
	`update_at` datetime
);

CREATE TABLE `test` 
(
	`id` integer,
	`name` varchar(255),
	`create_at` datetime,
	`update_at` datetime
);

CREATE TABLE `question` 
(
	`id` integer,
	`level` text,
	`content` varchar(255),
	`answer_1` varchar(255),
	`answer_2` varchar(255),
	`answer_3` varchar(255),
	`answer_4` varchar(255),
	`correct_answer` varchar(255),
	`create_at` datetime,
	`update_at` datetime
);

CREATE TABLE `class_user` 
(
	`id_class` integer,
	`id_user` integer
);

CREATE TABLE `question_test` 
(
	`id_question` integer,
	`id_test` integer
);

CREATE TABLE `class_test` 
(
	`id` integer,
	`title` varchar(255),
	`id_class` integer,
	`id_test` integer,
	`duration` integer,
	`endtime` datetime,
	`create_at` datetime,
	`update_at` datetime
);

CREATE TABLE `test_user` 
(
	`id` integer,
	`id_test` integer,
	`id_user` integer,
	`score` float,
	`create_at` datetime,
	`update_at` datetime
);

CREATE TABLE `selection` 
(
	`id` integer,
	`id_question` integer,
	`user_selected` varchar(255)
);

CREATE TABLE `selection_test_user` 
(
	`id_test_user` integer,
	`id_selection` integer
);

CREATE TABLE `status` 
(
	`id` integer,
	`name` text
);

CREATE TABLE `class_test_status` 
(
	`id_status` integer,
	`id_class_test` integer
);

CREATE TABLE `status_test_user` 
(
	`id_status` integer,
	`id_test_user` integer
);

ALTER TABLE `class_user` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

ALTER TABLE `test_user` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

ALTER TABLE `class` ADD FOREIGN KEY (`id`) REFERENCES `class_user` (`id_class`);

ALTER TABLE `class` ADD FOREIGN KEY (`id`) REFERENCES `class_test` (`id_class`);

ALTER TABLE `question_test` ADD FOREIGN KEY (`id_test`) REFERENCES `test` (`id`);

ALTER TABLE `test` ADD FOREIGN KEY (`id`) REFERENCES `test_user` (`id_test`);

ALTER TABLE `question` ADD FOREIGN KEY (`id`) REFERENCES `question_test` (`id_question`);

ALTER TABLE `question` ADD FOREIGN KEY (`id`) REFERENCES `selection` (`id_question`);

ALTER TABLE `class_test_status` ADD FOREIGN KEY (`id_status`) REFERENCES `status` (`id`);

ALTER TABLE `class_test` ADD FOREIGN KEY (`id`) REFERENCES `class_test_status` (`id_class_test`);

ALTER TABLE `status` ADD FOREIGN KEY (`id`) REFERENCES `status_test_user` (`id_status`);

ALTER TABLE `status_test_user` ADD FOREIGN KEY (`id_test_user`) REFERENCES `test_user` (`id`);

ALTER TABLE `class_test` ADD FOREIGN KEY (`id_test`) REFERENCES `test` (`id`);

ALTER TABLE `selection` ADD FOREIGN KEY (`id`) REFERENCES `selection_test_user` (`id_selection`);

ALTER TABLE `selection_test_user` ADD FOREIGN KEY (`id_test_user`) REFERENCES `test_user` (`id`);
