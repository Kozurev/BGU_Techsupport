-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 25 2018 г., 17:40
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dean`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mdl_bsu_techsupport_applications`
--

CREATE TABLE `mdl_bsu_techsupport_applications` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text,
  `fio` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `email_notification` tinyint(4) DEFAULT NULL,
  `system_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `performer_id` int(11) DEFAULT NULL,
  `done` tinyint(4) DEFAULT NULL,
  `is_public` tinyint(4) DEFAULT NULL,
  `create_date` int(11) UNSIGNED DEFAULT NULL,
  `done_start` int(11) UNSIGNED DEFAULT NULL,
  `done_end` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mdl_bsu_techsupport_applications`
--

INSERT INTO `mdl_bsu_techsupport_applications` (`id`, `subject`, `description`, `fio`, `email`, `email_notification`, `system_id`, `priority_id`, `performer_id`, `done`, `is_public`, `create_date`, `done_start`, `done_end`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', 'creative27016@yandex.ru', 0, 2, 0, 2, 1, 1, 1531980988, 1531981181, 1531981215),
(2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 0, 0, 1, 1532438802, NULL, NULL),
(3, 'Тест. Посыпалось расписание', 'Время в некоторых занятиях устанавливается некорректно', 'Штифанов Андрей Иванович', '', 0, 1, 0, 2, 0, 1, 1532438130, NULL, NULL),
(4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 0, 0, 1, 1532438812, NULL, NULL),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 0, 0, 1, 1532438793, NULL, NULL),
(6, 'Тест. Проблема с календарными графиками', 'Тест. Во время использования календарных графиков была выявлена проблема.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 118386, 0, 1, 1532431550, 1532438474, NULL),
(7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 0, 0, 1, 1532438816, NULL, NULL),
(8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 0, 0, 1, 1532438806, NULL, NULL),
(9, 'Тест. Проблемы с системой подбора персонала', 'Не работают отчеты в списке отобранных людей', 'Тест Тестт', '', 0, 1, 0, 4, 0, 1, 1532438340, NULL, NULL),
(10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 0, 0, 1, 1532438984, NULL, NULL),
(11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', '', 0, 1, 0, 0, 0, 1, 1532438798, NULL, NULL),
(14, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Фамилия Имя Отчество', '', 0, 1, 0, 0, 0, 1, 1532439426, NULL, NULL),
(15, 'Проблема с расписанием у мед. колледжа', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Штифанов Андрей Иванович', 'creative27016@gmail.com', 0, 2, 0, 0, 0, 1, 1532519572, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `mdl_bsu_techsupport_application_comments`
--

CREATE TABLE `mdl_bsu_techsupport_application_comments` (
  `id` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mdl_bsu_techsupport_application_comments`
--

INSERT INTO `mdl_bsu_techsupport_application_comments` (`id`, `create_date`, `author_id`, `application_id`, `text`) VALUES
(1, 1532438592, 3, 4, 'Проблема исправлена'),
(2, 1532518569, 3, 6, 'Тестовый коммент');

-- --------------------------------------------------------

--
-- Структура таблицы `mdl_bsu_techsupport_application_prioritys`
--

CREATE TABLE `mdl_bsu_techsupport_application_prioritys` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mdl_bsu_techsupport_application_prioritys`
--

INSERT INTO `mdl_bsu_techsupport_application_prioritys` (`id`, `title`, `hours`) VALUES
(0, 'Не определен', 0),
(1, 'Оперативная поддержка', 10800),
(2, 'Стандартная поддержка', 86400),
(3, 'Консультирование по общим вопросам', 432000),
(4, 'Разработка', 2073600);

-- --------------------------------------------------------

--
-- Структура таблицы `mdl_bsu_techsupport_application_screenshots`
--

CREATE TABLE `mdl_bsu_techsupport_application_screenshots` (
  `id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `file_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mdl_bsu_techsupport_application_screenshots`
--

INSERT INTO `mdl_bsu_techsupport_application_screenshots` (`id`, `application_id`, `file_name`) VALUES
(1, 1, '5b502cbc84f59.jpg'),
(2, 1, '5b502cbc85dc5.jpg'),
(3, 2, '5b570cbe3a078.jpg'),
(4, 2, '5b570cbe406ef.jpg'),
(5, 15, '5b586494cc6db.jpg'),
(6, 15, '5b586494cd149.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `mdl_bsu_techsupport_systems`
--

CREATE TABLE `mdl_bsu_techsupport_systems` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mdl_bsu_techsupport_systems`
--

INSERT INTO `mdl_bsu_techsupport_systems` (`id`, `title`) VALUES
(1, 'СЭО «Пегас»'),
(2, '«ИнфоБелГУ: Учебный процесс»');

-- --------------------------------------------------------

--
-- Структура таблицы `mdl_bsu_techsupport_user_roles`
--

CREATE TABLE `mdl_bsu_techsupport_user_roles` (
  `id` int(11) NOT NULL,
  `title` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mdl_bsu_techsupport_user_roles`
--

INSERT INTO `mdl_bsu_techsupport_user_roles` (`id`, `title`) VALUES
(1, 'Модератор'),
(2, 'Исполнитель');

-- --------------------------------------------------------

--
-- Структура таблицы `mdl_bsu_techsupport_user_role_assignments`
--

CREATE TABLE `mdl_bsu_techsupport_user_role_assignments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mdl_bsu_techsupport_user_role_assignments`
--

INSERT INTO `mdl_bsu_techsupport_user_role_assignments` (`id`, `user_id`, `role_id`) VALUES
(1, 3, 1),
(2, 4, 2),
(3, 2, 2),
(4, 118386, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `mdl_bsu_techsupport_applications`
--
ALTER TABLE `mdl_bsu_techsupport_applications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mdl_bsu_techsupport_application_comments`
--
ALTER TABLE `mdl_bsu_techsupport_application_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mdl_bsu_techsupport_application_prioritys`
--
ALTER TABLE `mdl_bsu_techsupport_application_prioritys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mdl_bsu_techsupport_application_screenshots`
--
ALTER TABLE `mdl_bsu_techsupport_application_screenshots`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mdl_bsu_techsupport_systems`
--
ALTER TABLE `mdl_bsu_techsupport_systems`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mdl_bsu_techsupport_user_roles`
--
ALTER TABLE `mdl_bsu_techsupport_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mdl_bsu_techsupport_user_role_assignments`
--
ALTER TABLE `mdl_bsu_techsupport_user_role_assignments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `mdl_bsu_techsupport_applications`
--
ALTER TABLE `mdl_bsu_techsupport_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `mdl_bsu_techsupport_application_comments`
--
ALTER TABLE `mdl_bsu_techsupport_application_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `mdl_bsu_techsupport_application_prioritys`
--
ALTER TABLE `mdl_bsu_techsupport_application_prioritys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `mdl_bsu_techsupport_application_screenshots`
--
ALTER TABLE `mdl_bsu_techsupport_application_screenshots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `mdl_bsu_techsupport_systems`
--
ALTER TABLE `mdl_bsu_techsupport_systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `mdl_bsu_techsupport_user_roles`
--
ALTER TABLE `mdl_bsu_techsupport_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `mdl_bsu_techsupport_user_role_assignments`
--
ALTER TABLE `mdl_bsu_techsupport_user_role_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
