-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 30 2023 г., 15:20
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `syl_db`
--
CREATE DATABASE IF NOT EXISTS `syl_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `syl_db`;

-- --------------------------------------------------------

--
-- Структура таблицы `cart_list`
--

DROP TABLE IF EXISTS `cart_list`;
CREATE TABLE `cart_list` (
  `id` int(30) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category_list`
--

DROP TABLE IF EXISTS `category_list`;
CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Таблетки', 'Лекарства в таблетках обеспечивают удобство приема, долгий срок хранения и точную дозировку активных веществ для эффективного лечения. Таблетки являются универсальной формой лекарственных препаратов, обеспечивая удобство хранения, транспортировки и простоту применения для пациентов.', 1, 0, '2022-05-25 10:14:16', '2023-05-29 19:56:17'),
(2, 'Капсулы', 'Лекарства в капсулах обеспечивают удобство и точность дозирования, оболочка капсулы защищает активные компоненты и облегчает их поглощение организмом.', 1, 0, '2022-05-25 10:16:05', '2023-05-29 19:55:04'),
(3, 'Сироп', 'Лекарства в виде сиропа предоставляют удобный способ приема для детей и пациентов с проблемами глотания, обеспечивая точную дозировку и быстрое воздействие активных компонентов.', 1, 0, '2022-05-26 10:57:14', '2023-05-29 19:57:18'),
(4, 'Test 123 - updated', 'Sample Only', 1, 1, '2022-05-26 10:57:31', '2022-05-26 10:58:45'),
(5, 'test', 'test', 1, 1, '2023-05-28 16:59:50', '2023-05-28 17:00:06');

-- --------------------------------------------------------

--
-- Структура таблицы `customer_list`
--

DROP TABLE IF EXISTS `customer_list`;
CREATE TABLE `customer_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `customer_list`
--

INSERT INTO `customer_list` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `contact`, `email`, `password`, `avatar`, `date_created`, `date_updated`) VALUES
(1, 'Антон', 'Павлович', 'Лангун', 'Мужской', '+375331728545', 'alagpav@gmail.com', '15529b12ef6a709c5d239141d036b079', 'uploads/customers/1.png?v=1653530034', '2022-05-25 13:21:28', '2023-05-29 20:32:16'),
(8, 'Егор', 'Андреевич', 'Микулич', 'Мужчина', '+375298684406', 'egor-mikulich@mail.ru', '15529b12ef6a709c5d239141d036b079', 'uploads/customers/8.png?v=1683963639', '2023-05-13 10:40:38', '2023-05-13 10:40:39');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL DEFAULT 0,
  `price` float(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(8, 7, 11, 7.00);

-- --------------------------------------------------------

--
-- Структура таблицы `order_list`
--

DROP TABLE IF EXISTS `order_list`;
CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `delivery_address` text NOT NULL,
  `total_amount` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending,\r\n1=packed,\r\n2=out for delivery,\r\n3=paid\r\n',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_list`
--

INSERT INTO `order_list` (`id`, `code`, `customer_id`, `delivery_address`, `total_amount`, `status`, `date_created`, `date_updated`) VALUES
(1, '20212165468', 1, 'Sample Address Only.', 203.00, 1, '2022-05-25 16:36:09', '2023-05-29 20:40:17'),
(3, '2022052600001', 1, 'test', 50.00, 0, '2022-05-26 09:22:37', '2022-05-26 09:22:37'),
(5, '2023051300001', 8, 'Тест', 10.00, 3, '2023-05-13 10:43:24', '2023-05-13 10:45:17'),
(6, '2023051300002', 8, 'г. Гродно, ул. Горького, 84', 17.00, 2, '2023-05-13 15:53:18', '2023-05-29 20:36:48'),
(8, '2023052900001', 8, 'Домой', 77.00, 0, '2023-05-29 20:42:48', '2023-05-29 20:42:48');

-- --------------------------------------------------------

--
-- Структура таблицы `product_list`
--

DROP TABLE IF EXISTS `product_list`;
CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `brand` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `dose` varchar(250) NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product_list`
--

INSERT INTO `product_list` (`id`, `category_id`, `brand`, `name`, `description`, `dose`, `price`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(7, 3, 'Белмедфарм', 'Откашлин', 'Данный сироп содержит успокаивающие масла, помогает снизить спазмы в области горла, что уменьшает случаи кашля. Также, помогает выводить мокроту из лёгких.', '25 мг.', 7.00, 'uploads/medicines//1_syrup.jpg?v=1685380933', 1, 0, '2023-05-29 20:22:13', '2023-05-29 20:41:19'),
(8, 1, 'Минские препараты', 'Ношпа', 'Данные таблетки содержат активный компонент, который благоприятно воздействует на микрофлору кишечника.', '10 г.', 10.00, 'uploads/medicines//2_tablet.jpeg?v=1685381033', 1, 0, '2023-05-29 20:23:53', '2023-05-29 20:23:53'),
(9, 2, 'Роскапсмед', 'Головалин', 'Капсулы, понижающие спазмы в области спинного и головного мозга. Также, по воздействию похожи на обезболивающие препараты.', '15 мг.', 8.00, 'uploads/medicines//1_capsule.jpg?v=1685381180', 1, 0, '2023-05-29 20:26:20', '2023-05-29 20:26:56'),
(10, 1, 'Детмеддом', 'Витамирин', 'Данные таблетки являются витаминным средством, содержащим в себе комплекс пищевых добавок для повышения общего состояние организма.', '20 г.', 3.00, 'uploads/medicines//1_pill.jfif?v=1685381338', 1, 0, '2023-05-29 20:28:58', '2023-05-29 20:28:58');

-- --------------------------------------------------------

--
-- Структура таблицы `stock_list`
--

DROP TABLE IF EXISTS `stock_list`;
CREATE TABLE `stock_list` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `quantity` float(12,2) NOT NULL DEFAULT 0.00,
  `expiration` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `stock_list`
--

INSERT INTO `stock_list` (`id`, `product_id`, `code`, `quantity`, `expiration`, `date_created`, `date_updated`) VALUES
(11, 7, '125', 500.00, '2023-07-13', '2023-05-29 20:29:21', '2023-05-29 20:29:21'),
(12, 10, '354', 2345.00, '2026-11-20', '2023-05-29 20:29:42', '2023-05-29 20:29:42'),
(13, 8, '2453', 745.00, '2023-12-20', '2023-05-29 20:30:03', '2023-05-29 20:30:03'),
(14, 9, '2653', 24653.00, '2030-07-15', '2023-05-29 20:30:26', '2023-05-29 20:30:26');

-- --------------------------------------------------------

--
-- Структура таблицы `stock_out`
--

DROP TABLE IF EXISTS `stock_out`;
CREATE TABLE `stock_out` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `stock_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `system_info`
--

DROP TABLE IF EXISTS `system_info`;
CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Медицинский сервис SYL'),
(6, 'short_name', 'SYL'),
(11, 'logo', 'uploads/logo.png?v=1653443580'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1653443581'),
(17, 'page', 'https://t.me/inzer_ym'),
(18, 'mobile', '+375298684406'),
(19, 'email', 'egor-mikulich@mail.ru'),
(20, 'address', 'г.Гродно, ул. Горького, 84');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='2';

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Администратор', '', 'сайта', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatars/1.png?v=1683967121', NULL, 1, '2021-01-20 14:02:37', '2023-05-28 18:59:52'),
(7, 'Джон', 'Младший', 'Смит', 'johnsmith', '15529b12ef6a709c5d239141d036b079', 'uploads/avatars/7.png?v=1685381584', NULL, 2, '2022-05-26 11:04:16', '2023-05-29 20:34:11');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart_list`
--
ALTER TABLE `cart_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Индексы таблицы `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart_list`
--
ALTER TABLE `cart_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart_list`
--
ALTER TABLE `cart_list`
  ADD CONSTRAINT `customer_id_fk_cl` FOREIGN KEY (`customer_id`) REFERENCES `customer_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_id_fk_cl` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_id_fk_oi` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_id_fk_oi` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `customer_id_fk_ol` FOREIGN KEY (`customer_id`) REFERENCES `customer_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `category_id_fk_pl` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `stock_list`
--
ALTER TABLE `stock_list`
  ADD CONSTRAINT `product_id_fk_sl` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `stock_out`
--
ALTER TABLE `stock_out`
  ADD CONSTRAINT `order_id_fk_so` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `stock_id_fk_so` FOREIGN KEY (`stock_id`) REFERENCES `stock_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


--
-- Метаданные
--
USE `phpmyadmin`;

--
-- Метаданные для таблицы cart_list
--

--
-- Метаданные для таблицы category_list
--

--
-- Метаданные для таблицы customer_list
--

--
-- Метаданные для таблицы order_items
--

--
-- Метаданные для таблицы order_list
--

--
-- Метаданные для таблицы product_list
--

--
-- Метаданные для таблицы stock_list
--

--
-- Метаданные для таблицы stock_out
--

--
-- Метаданные для таблицы system_info
--

--
-- Метаданные для таблицы users
--

--
-- Метаданные для базы данных syl_db
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
