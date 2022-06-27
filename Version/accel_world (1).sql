-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 14 2019 г., 22:20
-- Версия сервера: 10.3.13-MariaDB
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
-- База данных: `accel_world`
--

-- --------------------------------------------------------

--
-- Структура таблицы `account`
--

CREATE TABLE `account` (
  `id` int(10) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rights` enum('s','p','a','o','gl_a') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `account`
--

INSERT INTO `account` (`id`, `login`, `password`, `rights`) VALUES
(1, 'admin', 'admin', 'a'),
(2, 'student', 'student', 's'),
(3, 'prepod', 'prepod', 'p'),
(5, 'organization', 'organization', 'o'),
(6, 'Администратор', '123', 'gl_a'),
(65, 'VidOk228', '12345678910', 'o');

-- --------------------------------------------------------

--
-- Структура таблицы `organization`
--

CREATE TABLE `organization` (
  `id_org` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `number` varchar(20) NOT NULL,
  `id_a` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `organization`
--

INSERT INTO `organization` (`id_org`, `name`, `adress`, `number`, `id_a`) VALUES
(3, 'ООО ВидОк', 'Чебоксары', '+79874568745', 65);

-- --------------------------------------------------------

--
-- Структура таблицы `prepod`
--

CREATE TABLE `prepod` (
  `id_r` int(10) NOT NULL,
  `fio` varchar(70) NOT NULL,
  `number` varchar(20) NOT NULL,
  `id_a` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `договор`
--

CREATE TABLE `договор` (
  `id_d` int(3) NOT NULL,
  `id_st` int(3) NOT NULL,
  `id_org` int(3) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `практики`
--

CREATE TABLE `практики` (
  `id_pr` int(10) NOT NULL,
  `name` varchar(70) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `kolvo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `практики`
--

INSERT INTO `практики` (`id_pr`, `name`, `spec`, `kolvo`) VALUES
(1, 'Программирование', 'Программирование в компьютерных системах', 25);

-- --------------------------------------------------------

--
-- Структура таблицы `группы`
--

CREATE TABLE `группы` (
  `id_gr` int(3) NOT NULL,
  `gr` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `группы`
--

INSERT INTO `группы` (`id_gr`, `gr`) VALUES
(1, 'Пр1-16');

-- --------------------------------------------------------

--
-- Структура таблицы `назначение`
--

CREATE TABLE `назначение` (
  `id` int(10) NOT NULL,
  `id_pr` int(10) NOT NULL,
  `id_gr` int(10) NOT NULL,
  `id_r` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `отчет`
--

CREATE TABLE `отчет` (
  `id_o` int(10) NOT NULL,
  `id_st` int(10) NOT NULL,
  `id_pr` int(10) NOT NULL,
  `otziv` varchar(200) DEFAULT NULL,
  `ocenka` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `студенты`
--

CREATE TABLE `студенты` (
  `id_st` int(10) NOT NULL,
  `fio` varchar(50) NOT NULL,
  `id_gr` int(10) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `srball` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `студенты`
--

INSERT INTO `студенты` (`id_st`, `fio`, `id_gr`, `adress`, `srball`) VALUES
(1, 'Никифоров Дмитрий Сергеевич', 1, 'Чебоксары', '4,6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id_org`),
  ADD KEY `id_a` (`id_a`);

--
-- Индексы таблицы `prepod`
--
ALTER TABLE `prepod`
  ADD PRIMARY KEY (`id_r`),
  ADD KEY `id` (`id_a`);

--
-- Индексы таблицы `договор`
--
ALTER TABLE `договор`
  ADD PRIMARY KEY (`id_d`),
  ADD KEY `id_st` (`id_st`,`id_org`),
  ADD KEY `id_org` (`id_org`);

--
-- Индексы таблицы `практики`
--
ALTER TABLE `практики`
  ADD PRIMARY KEY (`id_pr`);

--
-- Индексы таблицы `группы`
--
ALTER TABLE `группы`
  ADD PRIMARY KEY (`id_gr`);

--
-- Индексы таблицы `назначение`
--
ALTER TABLE `назначение`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pr` (`id_pr`),
  ADD KEY `id_gr` (`id_gr`),
  ADD KEY `id_r` (`id_r`);

--
-- Индексы таблицы `отчет`
--
ALTER TABLE `отчет`
  ADD PRIMARY KEY (`id_o`),
  ADD KEY `id_st` (`id_st`),
  ADD KEY `id_pr` (`id_pr`);

--
-- Индексы таблицы `студенты`
--
ALTER TABLE `студенты`
  ADD PRIMARY KEY (`id_st`),
  ADD KEY `id_gr` (`id_gr`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `organization`
--
ALTER TABLE `organization`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `prepod`
--
ALTER TABLE `prepod`
  MODIFY `id_r` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `договор`
--
ALTER TABLE `договор`
  MODIFY `id_d` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `практики`
--
ALTER TABLE `практики`
  MODIFY `id_pr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `группы`
--
ALTER TABLE `группы`
  MODIFY `id_gr` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `назначение`
--
ALTER TABLE `назначение`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `отчет`
--
ALTER TABLE `отчет`
  MODIFY `id_o` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `студенты`
--
ALTER TABLE `студенты`
  MODIFY `id_st` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `account` (`id`);

--
-- Ограничения внешнего ключа таблицы `prepod`
--
ALTER TABLE `prepod`
  ADD CONSTRAINT `prepod_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `account` (`id`);

--
-- Ограничения внешнего ключа таблицы `договор`
--
ALTER TABLE `договор`
  ADD CONSTRAINT `договор_ibfk_1` FOREIGN KEY (`id_st`) REFERENCES `студенты` (`id_st`),
  ADD CONSTRAINT `договор_ibfk_2` FOREIGN KEY (`id_org`) REFERENCES `organization` (`id_org`);

--
-- Ограничения внешнего ключа таблицы `назначение`
--
ALTER TABLE `назначение`
  ADD CONSTRAINT `назначение_ibfk_1` FOREIGN KEY (`id_gr`) REFERENCES `группы` (`id_gr`),
  ADD CONSTRAINT `назначение_ibfk_2` FOREIGN KEY (`id_pr`) REFERENCES `практики` (`id_pr`),
  ADD CONSTRAINT `назначение_ibfk_3` FOREIGN KEY (`id_r`) REFERENCES `prepod` (`id_r`);

--
-- Ограничения внешнего ключа таблицы `отчет`
--
ALTER TABLE `отчет`
  ADD CONSTRAINT `отчет_ibfk_1` FOREIGN KEY (`id_pr`) REFERENCES `практики` (`id_pr`),
  ADD CONSTRAINT `отчет_ibfk_2` FOREIGN KEY (`id_st`) REFERENCES `студенты` (`id_st`);

--
-- Ограничения внешнего ключа таблицы `студенты`
--
ALTER TABLE `студенты`
  ADD CONSTRAINT `студенты_ibfk_1` FOREIGN KEY (`id_gr`) REFERENCES `группы` (`id_gr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
