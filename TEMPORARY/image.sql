-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 29 2016 г., 20:33
-- Версия сервера: 5.5.50
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2_loc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(20) NOT NULL,
  `isMain` int(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `name`) VALUES
(21, 'Products/Product1/97033a.jpg', 1, 0, 'Product', '2e4a6a523e-3', ''),
(22, 'Products/Product1/ffa6e1.jpg', 1, 0, 'Product', '74afb79623-4', ''),
(23, 'Products/Product1/33b056.jpg', 1, 0, 'Product', 'ee52adf9a3-5', ''),
(24, 'Products/Product1/b4af10.jpg', 1, 0, 'Product', '42cb654b5d-6', ''),
(25, 'Products/Product1/9fe98e.jpg', 1, 0, 'Product', 'd4dc3faed6-2', ''),
(26, 'Products/Product1/34275a.jpg', 1, 1, 'Product', 'd30e0c0a1f-1', ''),
(27, 'Products/Product2/93fe50.jpg', 2, 0, 'Product', '8096fa16f6-3', ''),
(28, 'Products/Product2/31bf95.jpg', 2, 0, 'Product', 'e14ce09891-4', ''),
(29, 'Products/Product2/7ab4a5.jpg', 2, 0, 'Product', '438b7c8b30-2', ''),
(30, 'Products/Product2/299974.jpg', 2, 0, 'Product', 'f2ca90debc-5', ''),
(31, 'Products/Product2/a01f6f.jpg', 2, 0, 'Product', '294b68504d-6', ''),
(32, 'Products/Product2/5ec971.jpg', 2, 0, 'Product', 'b9ed4c5039-7', ''),
(33, 'Products/Product2/773a7c.jpg', 2, 1, 'Product', '1e0735ff83-1', ''),
(34, 'Products/Product3/f65fa5.jpg', 3, 1, 'Product', 'b58a941c6f-1', ''),
(35, 'Products/Product5/7d8a7a.jpg', 5, 1, 'Product', '7dd11274b4-1', ''),
(36, 'Products/Product6/2ad29e.jpg', 6, 1, 'Product', '0f41a2142e-1', ''),
(37, 'Products/Product4/a08dd0.jpg', 4, 1, 'Product', '05d9085e97-1', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
