-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 29 2019 г., 23:25
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
-- База данных: `kittest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article_tests`
--

CREATE TABLE `article_tests` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `short_text` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `ques1-1` text NOT NULL,
  `ques1-2` text NOT NULL,
  `ques1-3` text NOT NULL,
  `ans1` int(11) NOT NULL,
  `ques2-1` text NOT NULL,
  `ques2-2` int(255) NOT NULL,
  `ques2-3` text NOT NULL,
  `ans2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `article_tests`
--

INSERT INTO `article_tests` (`id`, `title`, `text`, `short_text`, `img`, `ques1-1`, `ques1-2`, `ques1-3`, `ans1`, `ques2-1`, `ques2-2`, `ques2-3`, `ans2`) VALUES
(1, 'HTML', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eveniet excepturi magnam maiores natus placeat praesentium quidem quos suscipit unde. Animi at atque blanditiis dicta excepturi expedita id minus neque, officia voluptates. Animi cupiditate distinctio ea eaque earum eos, error eveniet ex, excepturi explicabo fugiat illum impedit, ipsam iure laborum libero maiores necessitatibus nemo nisi odio optio perferendis totam veniam. Ab, accusantium aliquam beatae dolorum impedit omnis possimus recusandae tenetur totam. Amet asperiores commodi cumque debitis dolor doloribus, ea eveniet ex facilis fuga illum impedit ipsam laudantium nemo nostrum nulla optio possimus qui quia repellat repudiandae sit tempora temporibus velit.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eveniet excepturi magnam maiores natus placeat praesentium quidem quos suscipit unde.', 'html.png', 'Hyper Text Markup Lang', 'Hyper Text Marcur Lang', 'Hyper Talend Markup Lang', 1, '', 0, '', 0),
(2, 'JS', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eveniet excepturi magnam maiores natus placeat praesentium quidem quos suscipit unde. Animi at atque blanditiis dicta excepturi expedita id minus neque, officia voluptates. Animi cupiditate distinctio ea eaque earum eos, error eveniet ex, excepturi explicabo fugiat illum impedit, ipsam iure laborum libero maiores necessitatibus nemo nisi odio optio perferendis totam veniam. Ab, accusantium aliquam beatae dolorum impedit omnis possimus recusandae tenetur totam. Amet asperiores commodi cumque debitis dolor doloribus, ea eveniet ex facilis fuga illum impedit ipsam laudantium nemo nostrum nulla optio possimus qui quia repellat repudiandae sit tempora temporibus velit.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eveniet excepturi magnam maiores natus placeat praesentium quidem quos suscipit unde.', 'js.png', '', '0', '', 0, '', 0, '', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article_tests`
--
ALTER TABLE `article_tests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article_tests`
--
ALTER TABLE `article_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
