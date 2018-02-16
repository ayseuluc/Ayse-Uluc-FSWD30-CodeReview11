-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Feb 2018 um 00:54
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_ayse_uluc_php_car_rental`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `image` varchar(590) DEFAULT NULL,
  `fk_report_id` int(11) DEFAULT NULL,
  `fk_location_id` int(11) DEFAULT NULL,
  `fk_office_id` int(55) NOT NULL,
  `fk_car_type_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `car`
--

INSERT INTO `car` (`car_id`, `image`, `fk_report_id`, `fk_location_id`, `fk_office_id`, `fk_car_type_id`, `fk_status_id`) VALUES
(1, NULL, 0, 1, 4, 1, 1),
(2, NULL, 1, NULL, 1, 2, 2),
(3, NULL, 0, 1, 3, 5, 1),
(4, NULL, 0, NULL, 2, 3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `car_location`
--

CREATE TABLE `car_location` (
  `location_id` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `car_location`
--

INSERT INTO `car_location` (`location_id`, `location`) VALUES
(1, 'Donaustadtstrasse 50, 1220 Wien'),
(2, 'Gudrunstrasse 115, 1010 Wien'),
(3, 'Rochusgasse 2, 1030 Wien'),
(4, 'Liesinger Strasse 1, 1230 Wien'),
(5, 'Doeblinger Hauptstrasse 125, 1190 Wien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `car_status`
--

CREATE TABLE `car_status` (
  `status_id` int(11) NOT NULL,
  `car_status` varchar(55) COLLATE latin1_german1_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `car_status`
--

INSERT INTO `car_status` (`status_id`, `car_status`) VALUES
(1, 'rented'),
(2, 'free');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `car_type`
--

CREATE TABLE `car_type` (
  `car_type_id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `car_type`
--

INSERT INTO `car_type` (`car_type_id`, `type`) VALUES
(1, 'VW Polo GTI'),
(2, 'Skoda Octavia'),
(3, 'Hyundai Elantra'),
(4, 'Maruti Suzuki Ciaz'),
(5, 'Mercedes-Benz GLE Coupe'),
(6, 'Volvo S60 Cross Country');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(55) DEFAULT NULL,
  `customerEmail` varchar(255) DEFAULT NULL,
  `customerPass` varchar(255) DEFAULT NULL,
  `fk_car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `adress` varchar(55) COLLATE latin1_german1_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `office`
--

INSERT INTO `office` (`office_id`, `adress`) VALUES
(1, 'Rennbahnweg 17, 1220 Wien'),
(2, 'Kettenbrueckenstrasse 45, 1050 Wien'),
(3, 'Ottakringer Hauptstrasse 11, 1160 Wien'),
(4, 'Grossfeldsiedlung 2, 1210 Wien'),
(5, 'Hardeggase 2-10. 1220 Wien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `damage` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `reports`
--

INSERT INTO `reports` (`report_id`, `date`, `damage`) VALUES
(0, '2018-02-13', 'not damaged'),
(1, '2018-02-09', 'damaged');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_car_type_id` (`fk_car_type_id`),
  ADD KEY `fk_office_id` (`fk_office_id`),
  ADD KEY `car_location` (`fk_location_id`),
  ADD KEY `fk_status_id` (`fk_status_id`),
  ADD KEY `fk_report_id` (`fk_report_id`);

--
-- Indizes für die Tabelle `car_location`
--
ALTER TABLE `car_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indizes für die Tabelle `car_status`
--
ALTER TABLE `car_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indizes für die Tabelle `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`car_type_id`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `fk_car_id` (`fk_car_id`);

--
-- Indizes für die Tabelle `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indizes für die Tabelle `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`fk_location_id`) REFERENCES `car_location` (`location_id`),
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`fk_report_id`) REFERENCES `reports` (`report_id`),
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `car_status` (`status_id`),
  ADD CONSTRAINT `car_ibfk_5` FOREIGN KEY (`fk_car_type_id`) REFERENCES `car_type` (`car_type_id`),
  ADD CONSTRAINT `car_ibfk_6` FOREIGN KEY (`fk_report_id`) REFERENCES `reports` (`report_id`);

--
-- Constraints der Tabelle `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`fk_car_id`) REFERENCES `car` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
