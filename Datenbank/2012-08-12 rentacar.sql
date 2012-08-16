-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. August 2012 um 15:37
-- Server Version: 5.5.9
-- PHP-Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `RentACar`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `forname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `customers`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `locations`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rentings`
--

CREATE TABLE `rentings` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `returnplace` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `rentings`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `engine_type` varchar(255) DEFAULT NULL,
  `engine_size` int(11) DEFAULT NULL,
  `engine_ps` int(11) DEFAULT NULL,
  `engine_consum` decimal(10,0) DEFAULT NULL,
  `price_per_day` decimal(10,0) NOT NULL,
  `type` varchar(255) NOT NULL,
  `number_of_doors` int(11) DEFAULT NULL,
  `is_smoking` tinyint(1) DEFAULT NULL,
  `gear` tinyint(1) NOT NULL,
  `climatic` tinyint(1) NOT NULL,
  `seats` varchar(255) NOT NULL,
  `navigation_system` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `vehicles`
--

