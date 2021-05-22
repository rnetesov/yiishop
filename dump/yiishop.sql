-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 22 2021 г., 18:47
-- Версия сервера: 8.0.23
-- Версия PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yiishop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `customerNumber` int NOT NULL,
  `login` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `auth_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contactLastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `contactFirstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `addressLine1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postalCode` varchar(15) DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customerNumber`, `login`, `email`, `hash`, `auth_key`, `contactLastName`, `contactFirstName`, `phone`, `addressLine1`, `city`, `state`, `postalCode`, `country`) VALUES
(3, 'martin', 'martin_90@mail.com', '$2y$13$KTHALEDDH6xSg.qVlMEUaOaO4EXh9Mw5zW6c7PMxaovVJ.SA6dhxq', 'y6XlNPhbLIw5zbm9ukXgA7KCymsPRRZA', 'Максимович', 'Макс', '+78899094590', 'ул Street 3/345', 'Нью-Йорк', 'нет', '7702224', 'США'),
(4, 'felix', 'felix_28@gmail.com', '$2y$13$ArOPEKJsI3UyXa0fYk81q.L1BOZAkuO0ZZFjWnPC.x34ZM5WW7lWK', 'eTHnfuuuKlN53hHPPccaOM1FKeuhOmVq', 'Безруков', 'Сергей', '+733300034456', 'ул. Полевая 30 д.90', 'Урюпинск', '', '123567', 'Россия'),
(5, 'martin99', 'martin@mail.com', '$2y$13$VVHvU6OrjsnvZymZ0H.ok.x7cDWogn/makb/yFhogYeO6iv1qX6py', 'OLDfJELMRP1cgP-8P2U79O44wBNAhuVz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderNumber` int NOT NULL,
  `productCode` int NOT NULL,
  `quantityOrdered` int NOT NULL,
  `priceEach` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderdetails`
--

INSERT INTO `orderdetails` (`orderNumber`, `productCode`, `quantityOrdered`, `priceEach`) VALUES
(31, 2, 1, '214.30'),
(31, 5, 5, '680.00'),
(31, 7, 3, '583.71'),
(31, 12, 1, '117.44'),
(31, 13, 4, '692.08'),
(32, 2, 1, '214.30'),
(32, 4, 2, '387.32'),
(32, 37, 4, '344.08'),
(32, 89, 5, '310.70'),
(33, 42, 1, '100.84'),
(33, 89, 1, '62.14'),
(33, 95, 1, '58.58'),
(34, 9, 1, '136.67'),
(34, 15, 1, '118.50'),
(35, 9, 1, '136.67'),
(35, 15, 1, '118.50'),
(35, 17, 1, '116.67'),
(35, 28, 2, '245.46'),
(36, 15, 1, '118.50'),
(36, 17, 13, '1516.71'),
(36, 28, 2, '245.46'),
(37, 19, 1, '102.74'),
(37, 20, 1, '53.91'),
(37, 23, 1, '170.00'),
(37, 27, 2, '121.08');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `orderNumber` int NOT NULL,
  `orderDate` datetime NOT NULL,
  `shippedDate` date DEFAULT NULL,
  `status` enum('new','on hold','in process','cancelled','shipped') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'new',
  `comments` mediumtext,
  `totalPrice` decimal(10,2) NOT NULL,
  `customerNumber` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`orderNumber`, `orderDate`, `shippedDate`, `status`, `comments`, `totalPrice`, `customerNumber`) VALUES
(31, '2021-04-20 23:11:58', NULL, 'new', NULL, '2287.53', 4),
(32, '2021-04-20 23:13:00', NULL, 'in process', NULL, '1256.40', 3),
(33, '2021-04-20 23:18:55', NULL, 'on hold', NULL, '221.56', 4),
(34, '2021-04-21 22:04:09', NULL, 'cancelled', NULL, '255.17', 4),
(35, '2021-04-21 22:22:32', NULL, 'in process', NULL, '617.30', 4),
(36, '2021-04-21 22:25:01', NULL, 'new', NULL, '1880.67', 4),
(37, '2021-04-21 22:26:35', NULL, 'new', NULL, '447.73', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `productlines`
--

CREATE TABLE `productlines` (
  `productLine` varchar(50) NOT NULL,
  `textDescription` varchar(4000) DEFAULT NULL,
  `status` enum('enable','disable') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'enable',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productlines`
--

INSERT INTO `productlines` (`productLine`, `textDescription`, `status`, `image`) VALUES
('Classic Cars', 'Attention car enthusiasts: Make your wildest car ownership dreams come true. Whether you are looking for classic muscle cars, dream sports cars or movie-inspired miniatures, you will find great choices in this category. These replicas feature superb attention to detail and craftsmanship and offer features such as working steering system, opening forward compartment, opening rear trunk with removable spare wheel, 4-wheel independent spring suspension, and so on. The models range in size from 1:10 to 1:24 scale and include numerous limited edition and several out-of-production vehicles. All models include a certificate of authenticity from their manufacturers and come fully assembled and ready for display in the home or office.', 'enable', NULL),
('Motorcycles', 'Our motorcycles are state of the art replicas of classic as well as contemporary motorcycle legends such as Harley Davidson, Ducati and Vespa. Models contain stunning details such as official logos, rotating wheels, working kickstand, front suspension, gear-shift lever, footbrake lever, and drive chain. Materials used include diecast and plastic. The models range in size from 1:10 to 1:50 scale and include numerous limited edition and several out-of-production vehicles. All models come fully assembled and ready for display in the home or office. Most include a certificate of authenticity.', 'disable', NULL),
('Planes', 'Unique, diecast airplane and helicopter replicas suitable for collections, as well as home, office or classroom decorations. Models contain stunning details such as official logos and insignias, rotating jet engines and propellers, retractable wheels, and so on. Most come fully assembled and with a certificate of authenticity from their manufacturers.', 'disable', NULL),
('Ships', 'The perfect holiday or anniversary gift for executives, clients, friends, and family. These handcrafted model ships are unique, stunning works of art that will be treasured for generations! They come fully assembled and ready for display in the home or office. We guarantee the highest quality, and best value.', 'enable', NULL),
('Trains', 'Model trains are a rewarding hobby for enthusiasts of all ages. Whether you\'re looking for collectible wooden trains, electric streetcars or locomotives, you\'ll find a number of great choices for any budget within this category.', 'disable', NULL),
('Trucks and Buses', 'The Truck and Bus models are realistic replicas of buses and specialized trucks produced from the early 1920s to present. The models range in size from 1:12 to 1:50 scale and include numerous limited edition and several out-of-production vehicles. Materials used include tin, diecast and plastic', 'enable', NULL),
('Vintage Cars', 'Our Vintage Car models realistically portray automobiles produced from the early 1900s through the 1940s. Materials used include Bakelite, diecast, plastic and wood. Most of the replicas are in the 1:18 and 1:24 scale sizes, which provide the optimum in detail and accuracy. Prices range from $30.00 up to $180.00 for some special limited edition replicas. All models include a certificate of authenticity from their manufacturers and come fully assembled and ready for display in the home or office.', 'enable', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `productCode` int NOT NULL,
  `productName` varchar(70) NOT NULL,
  `productLine` varchar(50) NOT NULL,
  `productVendor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `productDescription` mediumtext NOT NULL,
  `quantityInStock` smallint NOT NULL,
  `buyPrice` decimal(10,2) NOT NULL,
  `MSRP` decimal(10,2) NOT NULL,
  `status` enum('active','blocked','on main','') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`productCode`, `productName`, `productLine`, `productVendor`, `createdAt`, `productDescription`, `quantityInStock`, `buyPrice`, `MSRP`, `status`) VALUES
(2, '1952 Alpine Renault 1300', 'Classic Cars', 'Second Gear Diecast', '0000-00-00 00:00:00', 'Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 7305, '98.58', '214.30', 'on main'),
(3, '1996 Moto Guzzi 1100i', 'Motorcycles', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'Official Moto Guzzi logos and insignias, saddle bags located on side of motorcycle, detailed engine, working steering, working suspension, two leather seats, luggage rack, dual exhaust pipes, small saddle bag located on handle bars, two-tone paint with chrome accents, superior die-cast detail , rotating wheels , working kick stand, diecast metal with plastic parts and baked enamel finish.', 6625, '120.23', '340.35', 'active'),
(4, '2003 Harley-Davidson Eagle Drag Bike', 'Vintage Cars', 'Red Start Diecast', '0000-00-00 00:00:00', 'Model features, official Harley Davidson logos and insignias, detachable rear wheelie bar, heavy diecast metal with resin parts, authentic multi-color tampo-printed graphics, separate engine drive belts, free-turning front fork, rotating tires and rear racing slick, certificate of authenticity, detailed engine, display stand, precision diecast replica, baked enamel finish, 1:10 scale model, removable fender, seat and tank cover piece for displaying the superior detail of the v-twin engine', 5582, '91.02', '193.66', 'blocked'),
(5, '1972 Alfa Romeo GTA', 'Classic Cars', 'Motor City Art Classics', '0000-00-00 00:00:00', 'Features include: Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 3252, '85.68', '136.00', 'on main'),
(6, '1962 LanciaA Delta 16V', 'Classic Cars', 'Second Gear Diecast', '0000-00-00 00:00:00', 'Features include: Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 6791, '103.42', '147.74', 'blocked'),
(7, '1968 Ford Mustang', 'Classic Cars', 'Autoart Studio Design', '0000-00-00 00:00:00', 'Hood, doors and trunk all open to reveal highly detailed interior features. Steering wheel actually turns the front wheels. Color dark green.', 68, '95.34', '194.57', 'on main'),
(8, '2001 Ferrari Enzo', 'Classic Cars', 'Second Gear Diecast', '0000-00-00 00:00:00', 'Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 3619, '95.59', '207.80', 'active'),
(9, '1958 Setra Bus', 'Trucks and Buses', 'Welly Diecast Productions', '0000-00-00 00:00:00', 'Model features 30 windows, skylights & glare resistant glass, working steering system, original logos', 1579, '77.90', '136.67', 'on main'),
(10, '2002 Suzuki XREO', 'Motorcycles', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'Official logos and insignias, saddle bags located on side of motorcycle, detailed engine, working steering, working suspension, two leather seats, luggage rack, dual exhaust pipes, small saddle bag located on handle bars, two-tone paint with chrome accents, superior die-cast detail , rotating wheels , working kick stand, diecast metal with plastic parts and baked enamel finish.', 9997, '66.27', '150.62', 'blocked'),
(11, '1969 Corvair Monza', 'Classic Cars', 'Welly Diecast Productions', '0000-00-00 00:00:00', '1:18 scale die-cast about 10\" long doors open, hood opens, trunk opens and wheels roll', 6906, '89.14', '151.08', 'active'),
(12, '1968 Dodge Charger', 'Classic Cars', 'Welly Diecast Productions', '0000-00-00 00:00:00', '1:12 scale model of a 1968 Dodge Charger. Hood, doors and trunk all open to reveal highly detailed interior features. Steering wheel actually turns the front wheels. Color black', 9123, '75.16', '117.44', 'active'),
(13, '1969 Ford Falcon', 'Classic Cars', 'Second Gear Diecast', '0000-00-00 00:00:00', 'Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 1049, '83.05', '173.02', 'blocked'),
(14, '1970 Plymouth Hemi Cuda', 'Classic Cars', 'Studio M Art Models', '0000-00-00 00:00:00', 'Very detailed 1970 Plymouth Cuda model in 1:12 scale. The Cuda is generally accepted as one of the fastest original muscle cars from the 1970s. This model is a reproduction of one of the orginal 652 cars built in 1970. Red color.', 5663, '31.92', '79.80', 'active'),
(15, '1957 Chevy Pickup', 'Trucks and Buses', 'Exoto Designs', '0000-00-00 00:00:00', '1:12 scale die-cast about 20\" long Hood opens, Rubber wheels', 6125, '55.70', '118.50', 'active'),
(16, '1969 Dodge Charger', 'Classic Cars', 'Welly Diecast Productions', '0000-00-00 00:00:00', 'Detailed model of the 1969 Dodge Charger. This model includes finely detailed interior and exterior features. Painted in red and white.', 7323, '58.73', '115.16', 'active'),
(17, '1940 Ford Pickup Truck', 'Trucks and Buses', 'Studio M Art Models', '0000-00-00 00:00:00', 'This model features soft rubber tires, working steering, rubber mud guards, authentic Ford logos, detailed undercarriage, opening doors and hood,  removable split rear gate, full size spare mounted in bed, detailed interior with opening glove box', 2613, '58.33', '116.67', 'active'),
(18, '1993 Mazda RX-7', 'Classic Cars', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', 'This model features, opening hood, opening doors, detailed engine, rear spoiler, opening trunk, working steering, tinted windows, baked enamel finish. Color red.', 3975, '83.51', '141.54', 'active'),
(19, '1937 Lincoln Berline', 'Vintage Cars', 'Motor City Art Classics', '0000-00-00 00:00:00', 'Features opening engine cover, doors, trunk, and fuel filler cap. Color black', 8693, '60.62', '102.74', 'active'),
(20, '1936 Mercedes-Benz 500K Special Roadster', 'Vintage Cars', 'Studio M Art Models', '0000-00-00 00:00:00', 'This 1:18 scale replica is constructed of heavy die-cast metal and has all the features of the original: working doors and rumble seat, independent spring suspension, detailed interior, working steering system, and a bifold hood that reveals an engine so accurate that it even includes the wiring. All this is topped off with a baked enamel finish. Color white.', 8635, '24.26', '53.91', 'active'),
(21, '1965 Aston Martin DB5', 'Classic Cars', 'Classic Metal Creations', '0000-00-00 00:00:00', 'Die-cast model of the silver 1965 Aston Martin DB5 in silver. This model includes full wire wheels and doors that open with fully detailed passenger compartment. In 1:18 scale, this model measures approximately 10 inches/20 cm long.', 9042, '65.96', '124.44', 'active'),
(22, '1980s Black Hawk Helicopter', 'Planes', 'Red Start Diecast', '0000-00-00 00:00:00', '1:18 scale replica of actual Army\'s UH-60L BLACK HAWK Helicopter. 100% hand-assembled. Features rotating rotor blades, propeller blades and rubber wheels.', 5330, '77.27', '157.69', 'active'),
(23, '1917 Grand Touring Sedan', 'Vintage Cars', 'Welly Diecast Productions', '0000-00-00 00:00:00', 'This 1:18 scale replica of the 1917 Grand Touring car has all the features you would expect from museum quality reproductions: all four doors and bi-fold hood opening, detailed engine and instrument panel, chrome-look trim, and tufted upholstery, all topped off with a factory baked-enamel finish.', 2724, '86.70', '170.00', 'active'),
(24, '1948 Porsche 356-A Roadster', 'Classic Cars', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'This precision die-cast replica features opening doors, superb detail and craftsmanship, working steering system, opening forward compartment, opening rear trunk with removable spare, 4 wheel independent spring suspension as well as factory baked enamel finish.', 8826, '53.90', '77.00', 'active'),
(25, '1995 Honda Civic', 'Classic Cars', 'Min Lin Diecast', '0000-00-00 00:00:00', 'This model features, opening hood, opening doors, detailed engine, rear spoiler, opening trunk, working steering, tinted windows, baked enamel finish. Color yellow.', 9772, '93.89', '142.25', 'active'),
(26, '1998 Chrysler Plymouth Prowler', 'Classic Cars', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 4724, '101.51', '163.73', 'active'),
(27, '1911 Ford Town Car', 'Vintage Cars', 'Motor City Art Classics', '0000-00-00 00:00:00', 'Features opening hood, opening doors, opening trunk, wide white wall tires, front door arm rests, working steering system.', 540, '33.30', '60.54', 'active'),
(28, '1964 Mercedes Tour Bus', 'Trucks and Buses', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'Exact replica. 100+ parts. working steering system, original logos', 8258, '74.86', '122.73', 'active'),
(29, '1932 Model A Ford J-Coupe', 'Vintage Cars', 'Autoart Studio Design', '0000-00-00 00:00:00', 'This model features grille-mounted chrome horn, lift-up louvered hood, fold-down rumble seat, working steering system, chrome-covered spare, opening doors, detailed and wired engine', 9354, '58.48', '127.13', 'active'),
(30, '1926 Ford Fire Engine', 'Trucks and Buses', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'Gleaming red handsome appearance. Everything is here the fire hoses, ladder, axes, bells, lanterns, ready to fight any inferno.', 2018, '24.92', '60.77', 'active'),
(31, 'P-51-D Mustang', 'Planes', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'Has retractable wheels and comes with a stand', 992, '49.00', '84.48', 'active'),
(32, '1936 Harley Davidson El Knucklehead', 'Motorcycles', 'Welly Diecast Productions', '0000-00-00 00:00:00', 'Intricately detailed with chrome accents and trim, official die-struck logos and baked enamel finish.', 4357, '24.23', '60.57', 'active'),
(33, '1928 Mercedes-Benz SSK', 'Vintage Cars', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'This 1:18 replica features grille-mounted chrome horn, lift-up louvered hood, fold-down rumble seat, working steering system, chrome-covered spare, opening doors, detailed and wired engine. Color black.', 548, '72.56', '168.75', 'active'),
(34, '1999 Indy 500 Monte Carlo SS', 'Classic Cars', 'Red Start Diecast', '0000-00-00 00:00:00', 'Features include opening and closing doors. Color: Red', 8164, '56.76', '132.00', 'active'),
(35, '1913 Ford Model T Speedster', 'Vintage Cars', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'This 250 part reproduction includes moving handbrakes, clutch, throttle and foot pedals, squeezable horn, detailed wired engine, removable water, gas, and oil cans, pivoting monocle windshield, all topped with a baked enamel red finish. Each replica comes with an Owners Title and Certificate of Authenticity. Color red.', 4189, '60.78', '101.31', 'active'),
(36, '1934 Ford V8 Coupe', 'Vintage Cars', 'Min Lin Diecast', '0000-00-00 00:00:00', 'Chrome Trim, Chrome Grille, Opening Hood, Opening Doors, Opening Trunk, Detailed Engine, Working Steering System', 5649, '34.35', '62.46', 'active'),
(37, '1999 Yamaha Speed Boat', 'Ships', 'Min Lin Diecast', '0000-00-00 00:00:00', 'Exact replica. Wood and Metal. Many extras including rigging, long boats, pilot house, anchors, etc. Comes with three masts, all square-rigged.', 4259, '51.61', '86.02', 'on main'),
(38, '18th Century Vintage Horse Carriage', 'Vintage Cars', 'Red Start Diecast', '0000-00-00 00:00:00', 'Hand crafted diecast-like metal horse carriage is re-created in about 1:18 scale of antique horse carriage. This antique style metal Stagecoach is all hand-assembled with many different parts.\r\n\r\nThis collectible metal horse carriage is painted in classic Red, and features turning steering wheel and is entirely hand-finished.', 5992, '60.74', '104.72', 'active'),
(39, '1903 Ford Model A', 'Vintage Cars', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'Features opening trunk,  working steering system', 3913, '68.30', '136.59', 'active'),
(40, '1992 Ferrari 360 Spider red', 'Classic Cars', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'his replica features opening doors, superb detail and craftsmanship, working steering system, opening forward compartment, opening rear trunk with removable spare, 4 wheel independent spring suspension as well as factory baked enamel finish.', 8347, '77.90', '169.34', 'active'),
(41, '1985 Toyota Supra', 'Classic Cars', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', 'This model features soft rubber tires, working steering, rubber mud guards, authentic Ford logos, detailed undercarriage, opening doors and hood, removable split rear gate, full size spare mounted in bed, detailed interior with opening glove box', 7733, '57.01', '107.57', 'active'),
(42, 'Collectable Wooden Train', 'Trains', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'Hand crafted wooden toy train set is in about 1:18 scale, 25 inches in total length including 2 additional carts, of actual vintage train. This antique style wooden toy train model set is all hand-assembled with 100% wood.', 6450, '67.56', '100.84', 'on main'),
(43, '1969 Dodge Super Bee', 'Classic Cars', 'Min Lin Diecast', '0000-00-00 00:00:00', 'This replica features opening doors, superb detail and craftsmanship, working steering system, opening forward compartment, opening rear trunk with removable spare, 4 wheel independent spring suspension as well as factory baked enamel finish.', 1917, '49.05', '80.41', 'active'),
(45, '1976 Ford Gran Torino', 'Classic Cars', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'Highly detailed 1976 Ford Gran Torino \"Starsky and Hutch\" diecast model. Very well constructed and painted in red and white patterns.', 9127, '73.49', '146.99', 'active'),
(46, '1948 Porsche Type 356 Roadster', 'Classic Cars', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'This model features working front and rear suspension on accurately replicated and actuating shock absorbers as well as opening engine cover, rear stabilizer flap,  and 4 opening doors.', 8990, '62.16', '141.28', 'blocked'),
(47, '1957 Vespa GS150', 'Motorcycles', 'Studio M Art Models', '0000-00-00 00:00:00', 'Features rotating wheels , working kick stand. Comes with stand.', 7689, '32.95', '62.17', 'active'),
(48, '1941 Chevrolet Special Deluxe Cabriolet', 'Vintage Cars', 'Exoto Designs', '0000-00-00 00:00:00', 'Features opening hood, opening doors, opening trunk, wide white wall tires, front door arm rests, working steering system, leather upholstery. Color black.', 2378, '64.58', '105.87', 'on main'),
(49, '1970 Triumph Spitfire', 'Classic Cars', 'Min Lin Diecast', '0000-00-00 00:00:00', 'Features include opening and closing doors. Color: White.', 5545, '91.92', '143.62', 'active'),
(50, '1932 Alfa Romeo 8C2300 Spider Sport', 'Vintage Cars', 'Exoto Designs', '0000-00-00 00:00:00', 'This 1:18 scale precision die cast replica features the 6 front headlights of the original, plus a detailed version of the 142 horsepower straight 8 engine, dual spares and their famous comprehensive dashboard. Color black.', 6553, '43.26', '92.03', 'active'),
(51, '1904 Buick Runabout', 'Vintage Cars', 'Exoto Designs', '0000-00-00 00:00:00', 'Features opening trunk,  working steering system', 8290, '52.66', '87.77', 'active'),
(52, '1940s Ford truck', 'Trucks and Buses', 'Motor City Art Classics', '0000-00-00 00:00:00', 'This 1940s Ford Pick-Up truck is re-created in 1:18 scale of original 1940s Ford truck. This antique style metal 1940s Ford Flatbed truck is all hand-assembled. This collectible 1940\'s Pick-Up truck is painted in classic dark green color, and features rotating wheels.', 3128, '84.76', '121.08', 'active'),
(53, '1939 Cadillac Limousine', 'Vintage Cars', 'Studio M Art Models', '0000-00-00 00:00:00', 'Features completely detailed interior including Velvet flocked drapes,deluxe wood grain floor, and a wood grain casket with seperate chrome handles', 6645, '23.14', '124.23', 'active'),
(54, '1957 Corvette Convertible', 'Classic Cars', 'Classic Metal Creations', '0000-00-00 00:00:00', '1957 die cast Corvette Convertible in Roman Red with white sides and whitewall tires. 1:18 scale quality die-cast with detailed engine and underbvody. Now you can own The Classic Corvette.', 1249, '69.93', '148.80', 'active'),
(55, '1957 Ford Thunderbird', 'Classic Cars', 'Studio M Art Models', '0000-00-00 00:00:00', 'This 1:18 scale precision die-cast replica, with its optional porthole hardtop and factory baked-enamel Thunderbird Bronze finish, is a 100% accurate rendition of this American classic.', 3209, '34.21', '71.27', 'active'),
(56, '1970 Chevy Chevelle SS 454', 'Classic Cars', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'This model features rotating wheels, working streering system and opening doors. All parts are particularly delicate due to their precise scale and require special care and attention. It should not be picked up by the doors, roof, hood or trunk.', 1005, '49.24', '73.49', 'active'),
(57, '1970 Dodge Coronet', 'Classic Cars', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', '1:24 scale die-cast about 18\" long doors open, hood opens and rubber wheels', 4074, '32.37', '57.80', 'active'),
(58, '1997 BMW R 1100 S', 'Motorcycles', 'Autoart Studio Design', '0000-00-00 00:00:00', 'Detailed scale replica with working suspension and constructed from over 70 parts', 7003, '60.86', '112.70', 'active'),
(59, '1966 Shelby Cobra 427 S/C', 'Classic Cars', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'This diecast model of the 1966 Shelby Cobra 427 S/C includes many authentic details and operating parts. The 1:24 scale model of this iconic lighweight sports car from the 1960s comes in silver and it\'s own display case.', 8197, '29.18', '50.31', 'active'),
(60, '1928 British Royal Navy Airplane', 'Planes', 'Classic Metal Creations', '0000-00-00 00:00:00', 'Official logos and insignias', 3627, '66.74', '109.42', 'active'),
(61, '1939 Chevrolet Deluxe Coupe', 'Vintage Cars', 'Motor City Art Classics', '0000-00-00 00:00:00', 'This 1:24 scale die-cast replica of the 1939 Chevrolet Deluxe Coupe has the same classy look as the original. Features opening trunk, hood and doors and a showroom quality baked enamel finish.', 7332, '22.57', '33.19', 'active'),
(62, '1960 BSA Gold Star DBD34', 'Motorcycles', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', 'Detailed scale replica with working suspension and constructed from over 70 parts', 15, '37.32', '76.17', 'active'),
(63, '18th century schooner', 'Ships', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'All wood with canvas sails. Many extras including rigging, long boats, pilot house, anchors, etc. Comes with 4 masts, all square-rigged.', 1898, '82.34', '122.89', 'active'),
(64, '1938 Cadillac V-16 Presidential Limousine', 'Vintage Cars', 'Classic Metal Creations', '0000-00-00 00:00:00', 'This 1:24 scale precision die cast replica of the 1938 Cadillac V-16 Presidential Limousine has all the details of the original, from the flags on the front to an opening back seat compartment complete with telephone and rifle. Features factory baked-enamel black finish, hood goddess ornament, working jump seats.', 2847, '20.61', '44.80', 'active'),
(65, '1962 Volkswagen Microbus', 'Trucks and Buses', 'Autoart Studio Design', '0000-00-00 00:00:00', 'This 1:18 scale die cast replica of the 1962 Microbus is loaded with features: A working steering system, opening front doors and tailgate, and famous two-tone factory baked enamel finish, are all topped of by the sliding, real fabric, sunroof.', 2327, '61.34', '127.79', 'active'),
(66, '1982 Ducati 900 Monster', 'Motorcycles', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', 'Features two-tone paint with chrome accents, superior die-cast detail , rotating wheels , working kick stand', 6840, '47.10', '69.26', 'active'),
(67, '1949 Jaguar XK 120', 'Classic Cars', 'Classic Metal Creations', '0000-00-00 00:00:00', 'Precision-engineered from original Jaguar specification in perfect scale ratio. Features opening doors, superb detail and craftsmanship, working steering system, opening forward compartment, opening rear trunk with removable spare, 4 wheel independent spring suspension as well as factory baked enamel finish.', 2350, '47.25', '90.87', 'active'),
(68, '1958 Chevy Corvette Limited Edition', 'Classic Cars', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'The operating parts of this 1958 Chevy Corvette Limited Edition are particularly delicate due to their precise scale and require special care and attention. Features rotating wheels, working streering, opening doors and trunk. Color dark green.', 2542, '15.91', '35.36', 'active'),
(69, '1900s Vintage Bi-Plane', 'Planes', 'Autoart Studio Design', '0000-00-00 00:00:00', 'Hand crafted diecast-like metal bi-plane is re-created in about 1:24 scale of antique pioneer airplane. All hand-assembled with many different parts. Hand-painted in classic yellow and features correct markings of original airplane.', 5942, '34.25', '68.51', 'active'),
(70, '1952 Citroen-15CV', 'Classic Cars', 'Exoto Designs', '0000-00-00 00:00:00', 'Precision crafted hand-assembled 1:18 scale reproduction of the 1952 15CV, with its independent spring suspension, working steering system, opening doors and hood, detailed engine and instrument panel, all topped of with a factory fresh baked enamel finish.', 1452, '72.82', '117.44', 'active'),
(71, '1982 Lamborghini Diablo', 'Classic Cars', 'Second Gear Diecast', '0000-00-00 00:00:00', 'This replica features opening doors, superb detail and craftsmanship, working steering system, opening forward compartment, opening rear trunk with removable spare, 4 wheel independent spring suspension as well as factory baked enamel finish.', 7723, '16.24', '37.76', 'active'),
(72, '1912 Ford Model T Delivery Wagon', 'Vintage Cars', 'Min Lin Diecast', '0000-00-00 00:00:00', 'This model features chrome trim and grille, opening hood, opening doors, opening trunk, detailed engine, working steering system. Color white.', 9173, '46.91', '88.51', 'active'),
(73, '1969 Chevrolet Camaro Z28', 'Classic Cars', 'Exoto Designs', '0000-00-00 00:00:00', '1969 Z/28 Chevy Camaro 1:24 scale replica. The operating parts of this limited edition 1:24 scale diecast model car 1969 Chevy Camaro Z28- hood, trunk, wheels, streering, suspension and doors- are particularly delicate due to their precise scale and require special care and attention.', 4695, '50.51', '85.61', 'active'),
(74, '1971 Alpine Renault 1600s', 'Classic Cars', 'Welly Diecast Productions', '0000-00-00 00:00:00', 'This 1971 Alpine Renault 1600s replica Features opening doors, superb detail and craftsmanship, working steering system, opening forward compartment, opening rear trunk with removable spare, 4 wheel independent spring suspension as well as factory baked enamel finish.', 7995, '38.58', '61.23', 'active'),
(75, '1937 Horch 930V Limousine', 'Vintage Cars', 'Autoart Studio Design', '0000-00-00 00:00:00', 'Features opening hood, opening doors, opening trunk, wide white wall tires, front door arm rests, working steering system', 2902, '26.30', '65.75', 'active'),
(76, '2002 Chevy Corvette', 'Classic Cars', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'The operating parts of this limited edition Diecast 2002 Chevy Corvette 50th Anniversary Pace car Limited Edition are particularly delicate due to their precise scale and require special care and attention. Features rotating wheels, poseable streering, opening doors and trunk.', 9446, '62.11', '107.08', 'active'),
(77, '1940 Ford Delivery Sedan', 'Vintage Cars', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'Chrome Trim, Chrome Grille, Opening Hood, Opening Doors, Opening Trunk, Detailed Engine, Working Steering System. Color black.', 6621, '48.64', '83.86', 'active'),
(78, '1956 Porsche 356A Coupe', 'Classic Cars', 'Classic Metal Creations', '0000-00-00 00:00:00', 'Features include: Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 6600, '98.30', '140.43', 'active'),
(79, 'Corsair F4U ( Bird Cage)', 'Planes', 'Second Gear Diecast', '0000-00-00 00:00:00', 'Has retractable wheels and comes with a stand. Official logos and insignias.', 6812, '29.34', '68.24', 'active'),
(80, '1936 Mercedes Benz 500k Roadster', 'Vintage Cars', 'Red Start Diecast', '0000-00-00 00:00:00', 'This model features grille-mounted chrome horn, lift-up louvered hood, fold-down rumble seat, working steering system and rubber wheels. Color black.', 2081, '21.75', '41.03', 'active'),
(81, '1992 Porsche Cayenne Turbo Silver', 'Classic Cars', 'Exoto Designs', '0000-00-00 00:00:00', 'This replica features opening doors, superb detail and craftsmanship, working steering system, opening forward compartment, opening rear trunk with removable spare, 4 wheel independent spring suspension as well as factory baked enamel finish.', 6582, '69.78', '118.28', 'active'),
(82, '1936 Chrysler Airflow', 'Vintage Cars', 'Second Gear Diecast', '0000-00-00 00:00:00', 'Features opening trunk,  working steering system. Color dark green.', 4710, '57.46', '97.39', 'active'),
(83, '1900s Vintage Tri-Plane', 'Planes', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'Hand crafted diecast-like metal Triplane is Re-created in about 1:24 scale of antique pioneer airplane. This antique style metal triplane is all hand-assembled with many different parts.', 2756, '36.23', '72.45', 'active'),
(84, '1961 Chevrolet Impala', 'Classic Cars', 'Studio M Art Models', '0000-00-00 00:00:00', 'This 1:18 scale precision die-cast reproduction of the 1961 Chevrolet Impala has all the features-doors, hood and trunk that open; detailed 409 cubic-inch engine; chrome dashboard and stick shift, two-tone interior; working steering system; all topped of with a factory baked-enamel finish.', 7869, '32.33', '80.84', 'active'),
(85, '1980’s GM Manhattan Express', 'Trucks and Buses', 'Motor City Art Classics', '0000-00-00 00:00:00', 'This 1980’s era new look Manhattan express is still active, running from the Bronx to mid-town Manhattan. Has 35 opeining windows and working lights. Needs a battery.', 5099, '53.93', '96.31', 'active'),
(86, '1997 BMW F650 ST', 'Motorcycles', 'Exoto Designs', '0000-00-00 00:00:00', 'Features official die-struck logos and baked enamel finish. Comes with stand.', 178, '66.92', '99.89', 'active'),
(87, '1982 Ducati 996 R', 'Motorcycles', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'Features rotating wheels , working kick stand. Comes with stand.', 9241, '24.14', '40.23', 'active'),
(88, '1954 Greyhound Scenicruiser', 'Trucks and Buses', 'Classic Metal Creations', '0000-00-00 00:00:00', 'Model features bi-level seating, 50 windows, skylights & glare resistant glass, working steering system, original logos', 2874, '25.98', '54.11', 'active'),
(89, '1950\'s Chicago Surface Lines Streetcar', 'Trains', 'Gearbox Collectibles', '0000-00-00 00:00:00', 'This streetcar is a joy to see. It has 80 separate windows, electric wire guides, detailed interiors with seats, poles and drivers controls, rolling and turning wheel assemblies, plus authentic factory baked-enamel finishes (Green Hornet for Chicago and Cream and Crimson for Boston).', 8601, '26.72', '62.14', 'on main'),
(90, '1996 Peterbilt 379 Stake Bed with Outrigger', 'Trucks and Buses', 'Red Start Diecast', '0000-00-00 00:00:00', 'This model features, opening doors, detailed engine, working steering, tinted windows, detailed interior, die-struck logos, removable stakes operating outriggers, detachable second trailer, functioning 360-degree self loader, precision molded resin trailer and trim, baked enamel finish on cab', 814, '33.61', '64.64', 'active'),
(91, '1928 Ford Phaeton Deluxe', 'Vintage Cars', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', 'This model features grille-mounted chrome horn, lift-up louvered hood, fold-down rumble seat, working steering system', 136, '33.02', '68.79', 'active'),
(92, '1974 Ducati 350 Mk3 Desmo', 'Motorcycles', 'Second Gear Diecast', '0000-00-00 00:00:00', 'This model features two-tone paint with chrome accents, superior die-cast detail , rotating wheels , working kick stand', 3341, '56.13', '102.05', 'active'),
(93, '1930 Buick Marquette Phaeton', 'Vintage Cars', 'Studio M Art Models', '0000-00-00 00:00:00', 'Features opening trunk,  working steering system', 7062, '27.06', '43.64', 'active'),
(94, 'Diamond T620 Semi-Skirted Tanker', 'Trucks and Buses', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', 'This limited edition model is licensed and perfectly scaled for Lionel Trains. The Diamond T620 has been produced in solid precision diecast and painted with a fire baked enamel finish. It comes with a removable tanker and is a perfect model to add authenticity to your static train or car layout or to just have on display.', 1016, '68.29', '115.75', 'active'),
(95, '1962 City of Detroit Streetcar', 'Trains', 'Classic Metal Creations', '0000-00-00 00:00:00', 'This streetcar is a joy to see. It has 99 separate windows, electric wire guides, detailed interiors with seats, poles and drivers controls, rolling and turning wheel assemblies, plus authentic factory baked-enamel finishes (Green Hornet for Chicago and Cream and Crimson for Boston).', 1645, '37.49', '58.58', 'active'),
(96, '2002 Yamaha YZR M1', 'Motorcycles', 'Autoart Studio Design', '0000-00-00 00:00:00', 'Features rotating wheels , working kick stand. Comes with stand.', 600, '34.17', '81.36', 'active'),
(97, 'The Schooner Bluenose', 'Ships', 'Autoart Studio Design', '0000-00-00 00:00:00', 'All wood with canvas sails. Measures 31 1/2 inches in Length, 22 inches High and 4 3/4 inches Wide. Many extras.\r\nThe schooner Bluenose was built in Nova Scotia in 1921 to fish the rough waters off the coast of Newfoundland. Because of the Bluenose racing prowess she became the pride of all Canadians. Still featured on stamps and the Canadian dime, the Bluenose was lost off Haiti in 1946.', 1897, '34.00', '66.67', 'active'),
(98, 'American Airlines: B767-300', 'Planes', 'Min Lin Diecast', '0000-00-00 00:00:00', 'Exact replia with official logos and insignias and retractable wheels', 5841, '51.15', '91.34', 'active'),
(99, 'The Mayflower', 'Ships', 'Studio M Art Models', '0000-00-00 00:00:00', 'Measures 31 1/2 inches Long x 25 1/2 inches High x 10 5/8 inches Wide\r\nAll wood with canvas sail. Extras include long boats, rigging, ladders, railing, anchors, side cannons, hand painted, etc.', 737, '43.30', '86.61', 'active'),
(100, 'HMS Bounty', 'Ships', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'Measures 30 inches Long x 27 1/2 inches High x 4 3/4 inches Wide. \r\nMany extras including rigging, long boats, pilot house, anchors, etc. Comes with three masts, all square-rigged.', 3501, '39.83', '90.52', 'active'),
(101, 'America West Airlines B757-200', 'Planes', 'Motor City Art Classics', '0000-00-00 00:00:00', 'Official logos and insignias. Working steering system. Rotating jet engines', 9653, '68.80', '99.72', 'active'),
(102, 'The USS Constitution Ship', 'Ships', 'Red Start Diecast', '0000-00-00 00:00:00', 'All wood with canvas sails. Measures 31 1/2\" Length x 22 3/8\" High x 8 1/4\" Width. Extras include 4 boats on deck, sea sprite on bow, anchors, copper railing, pilot houses, etc.', 7083, '33.97', '72.28', 'active'),
(103, '1982 Camaro Z28', 'Classic Cars', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'Features include opening and closing doors. Color: White. \r\nMeasures approximately 9 1/2\" Long.', 6934, '46.53', '101.15', 'active'),
(104, 'ATA: B757-300', 'Planes', 'Highway 66 Mini Classics', '0000-00-00 00:00:00', 'Exact replia with official logos and insignias and retractable wheels', 7106, '59.33', '118.65', 'on main'),
(105, 'F/A 18 Hornet 1/72', 'Planes', 'Motor City Art Classics', '0000-00-00 00:00:00', '10\" Wingspan with retractable landing gears.Comes with pilot', 551, '54.40', '80.00', 'active'),
(106, 'The Titanic', 'Ships', 'Carousel DieCast Legends', '0000-00-00 00:00:00', 'Completed model measures 19 1/2 inches long, 9 inches high, 3inches wide and is in barn red/black. All wood and metal.', 1956, '51.09', '100.17', 'active'),
(107, 'The Queen Mary', 'Ships', 'Welly Diecast Productions', '0000-00-00 00:00:00', 'Exact replica. Wood and Metal. Many extras including rigging, long boats, pilot house, anchors, etc. Comes with three masts, all square-rigged.', 5088, '53.63', '99.31', 'active'),
(108, 'American Airlines: MD-11S', 'Planes', 'Second Gear Diecast', '0000-00-00 00:00:00', 'Polished finish. Exact replia with official logos and insignias and retractable wheels', 8820, '36.27', '74.03', 'active'),
(109, 'Boeing X-32A JSF', 'Planes', 'Motor City Art Classics', '0000-00-00 00:00:00', '10\" Wingspan with retractable landing gears.Comes with pilot', 4857, '32.77', '49.66', 'active'),
(110, 'Pont Yacht', 'Ships', 'Unimax Art Galleries', '0000-00-00 00:00:00', 'Measures 38 inches Long x 33 3/4 inches High. Includes a stand.\r\nMany extras including rigging, long boats, pilot house, anchors, etc. Comes with 2 masts, all square-rigged', 414, '33.30', '54.60', 'active'),
(111, 'Ferarri GT10', 'Classic Cars', 'Red Start Diecast', '2021-04-20 20:35:49', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20, '1203.00', '940.00', 'active'),
(112, 'Porsche Cayenne', 'Classic Cars', 'Carousel DieCast Legends', '2021-04-20 20:43:31', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 4, '12000.00', '9076.00', 'active');

-- --------------------------------------------------------

--
-- Структура таблицы `vendors`
--

CREATE TABLE `vendors` (
  `productVendor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vendors`
--

INSERT INTO `vendors` (`productVendor`) VALUES
('Autoart Studio Design'),
('Carousel DieCast Legends'),
('Classic Metal Creations'),
('Exoto Designs'),
('Gearbox Collectibles'),
('Highway 66 Mini Classics'),
('Min Lin Diecast'),
('Motor City Art Classics'),
('Red Start Diecast'),
('Second Gear Diecast'),
('Studio M Art Models'),
('Unimax Art Galleries'),
('Vendor1'),
('Welly Diecast Productions');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerNumber`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `auth_key` (`auth_key`);

--
-- Индексы таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderNumber`,`productCode`),
  ADD KEY `productCode` (`productCode`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderNumber`),
  ADD KEY `customerNumber` (`customerNumber`);

--
-- Индексы таблицы `productlines`
--
ALTER TABLE `productlines`
  ADD PRIMARY KEY (`productLine`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productCode`),
  ADD KEY `productLine` (`productLine`),
  ADD KEY `productVendor` (`productVendor`);

--
-- Индексы таблицы `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`productVendor`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `customerNumber` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `orderNumber` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `productCode` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_3` FOREIGN KEY (`orderNumber`) REFERENCES `orders` (`orderNumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_4` FOREIGN KEY (`productCode`) REFERENCES `products` (`productCode`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerNumber`) REFERENCES `customers` (`customerNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`productLine`) REFERENCES `productlines` (`productLine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`productVendor`) REFERENCES `vendors` (`productVendor`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
