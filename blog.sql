-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 08 2019 г., 17:23
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `parent_id`) VALUES
(1, 'flowers', 3),
(2, 'roza', 2),
(3, 'astra', 0),
(4, 'fialka', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `pubdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `pubdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` enum('admin','moderator','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `role`) VALUES
(11, 'Ella', '404622e926817995332f8e0ef452f6fc', 'Ella@ukr.net', 'admin'),
(12, 'Web', '0cfd701ed94f9b6b82405fcfd2f3ec16', 'Web@ukr.net', 'user'),
(13, 'rerere', '0cfd701ed94f9b6b82405fcfd2f3ec16', 'rerere@ukr.net', 'user'),
(14, 'fdfdfd', '0cfd701ed94f9b6b82405fcfd2f3ec16', 'fdfdfd@ukr.net', 'user'),
(15, 'reerereee', '0cfd701ed94f9b6b82405fcfd2f3ec16', 'reerereee@ukr.net', 'user'),
(16, 'Alevtina', '0cfd701ed94f9b6b82405fcfd2f3ec16', 'Alevtina@ukr.net', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `autor_id` (`autor_id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
