-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 19 2019 г., 10:46
-- Версия сервера: 5.7.25
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_kit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `test_result_id` int(11) NOT NULL,
  `answer_option_id` int(11) NOT NULL,
  `checked` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `answer_options`
--

CREATE TABLE `answer_options` (
  `id` int(11) NOT NULL,
  `text` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `out_test`
--

CREATE TABLE `out_test` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `difficult` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `out_test`
--

INSERT INTO `out_test` (`id`, `title`, `text`, `difficult`, `image`, `file_name`) VALUES
(19, 'HTACCESS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'senior', 'htaccess.jpg', '5da21c67804fd_10.12.19_HTACCESS.json'),
(20, 'JS', 'На сколько хорошо ты знаешь JS? пройди тесты, и узнай результаты.', 'easy', 'js.png', '5da2217f90d08_10.12.19_JS.json'),
(21, 'HTML', 'На сколько хорошо ты знаешь HTML? пройди тесты, и узнай результаты.', 'easy', 'htaccess.jpg', '5da5a68708024_10.15.19_HTML.json'),
(22, 'HTML', 'На сколько хорошо ты знаешь HTML? пройди тесты, и узнай результаты.', 'easy', 'htaccess.jpg', '5da5a6ac9294d_10.15.19_HTML.json'),
(23, 'HTACCESS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'senior', 'htaccess.jpg', '5daab1584632c_10.19.19_HTACCESS.json'),
(24, 'HTACCESS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'senior', 'htaccess.jpg', '5daab17aad382_10.19.19_HTACCESS.json'),
(25, 'HTACCESS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'senior', 'htaccess.jpg', '5daab1f73c0c7_10.19.19_HTACCESS.json'),
(26, 'HTACCESS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'senior', 'htaccess.jpg', '5daab3ca3d5e9_10.19.19_HTACCESS.json'),
(27, 'HTACCESS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'senior', 'htaccess.jpg', '5daab3e0d9dee_10.19.19_HTACCESS.json'),
(28, 'HTACCESS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'senior', 'htaccess.jpg', '5daab40fbbc54_10.19.19_HTACCESS.json'),
(29, 'JS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'easy', '', '5daab73979511_10.19.19_JS.json'),
(34, 'JS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'easy', '', 'daabd6e60494_10.19.19_JS.tst'),
(35, 'JS', 'На сколько хорошо ты знаешь HTACCESS? пройди тесты, и узнай результаты.', 'easy', 'htaccess.jpg', 'daabd93a8f9c_10.19.19_JS.tst');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `text` text CHARACTER SET latin1 NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Пользователь'),
(2, 'Автор'),
(3, 'Админ');

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `question_id` int(11) NOT NULL,
  `is_correct` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `test_results`
--

CREATE TABLE `test_results` (
  `id` int(11) NOT NULL,
  `test_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `correct_count` int(11) DEFAULT NULL,
  `total_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `verefy` int(11) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `group_id` varchar(255) NOT NULL DEFAULT 'Отсутствует',
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `birth_date`, `email`, `token`, `verefy`, `tel`, `registration_date`, `group_id`, `role_id`) VALUES
(170, 'shille', '$2y$10$mw4U.qeVNGDUB/63egHEretQ8JPY.ZMWgOgsPy3uG/epyWZvakIU.', 'Serafim', 'Semikhat', '06.07.2004', 'shillenetwork@gmail.com', 'true', 1, '0980193160', '2019-10-16', 'Отсутствует', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_test_permissions`
--

CREATE TABLE `user_test_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_answers_answer_options` (`answer_option_id`),
  ADD KEY `FK_answers_test_results` (`test_result_id`);

--
-- Индексы таблицы `answer_options`
--
ALTER TABLE `answer_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `out_test`
--
ALTER TABLE `out_test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_question_test` (`test_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_test_question` (`question_id`);

--
-- Индексы таблицы `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `FK_user_roles` (`role_id`);

--
-- Индексы таблицы `user_test_permissions`
--
ALTER TABLE `user_test_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_test_permissions_tests_id_fk` (`test_id`),
  ADD KEY `user_test_permissions_users_id_fk` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `answer_options`
--
ALTER TABLE `answer_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `out_test`
--
ALTER TABLE `out_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT для таблицы `user_test_permissions`
--
ALTER TABLE `user_test_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `FK_answers_answer_options` FOREIGN KEY (`answer_option_id`) REFERENCES `answer_options` (`id`),
  ADD CONSTRAINT `FK_answers_test_results` FOREIGN KEY (`test_result_id`) REFERENCES `test_results` (`id`);

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_question_test` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `FK_test_question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_test_permissions`
--
ALTER TABLE `user_test_permissions`
  ADD CONSTRAINT `user_test_permissions_tests_id_fk` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `user_test_permissions_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
