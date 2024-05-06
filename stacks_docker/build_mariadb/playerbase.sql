-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 06, 2024 at 01:59 PM
-- Server version: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playerbase`
--
CREATE DATABASE IF NOT EXISTS `playerbase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `playerbase`;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_login` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_login`, `email`, `username`, `password`) VALUES
(8, 'root@root.fr', 'root', '$2y$10$nJ17aEe1sxtYe6Y22UCYEeaDLzpWH6MLLJV.eVAGUHgj7VgKXdT16');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `game` varchar(50) DEFAULT NULL,
  `team` varchar(50) DEFAULT NULL,
  `text` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `firstname`, `pseudo`, `lastname`, `dob`, `country`, `game`, `team`, `text`) VALUES
(1, 'Tyson', 'TenZ', 'Ngo', '2001-05-05', 'Canada', 'Valorant', 'Sentinels', 'Tyson “TenZ” Ngo is a Canadian professional VALORANT player who is currently playing for Sentinels. TenZ is a former professional Counter-Strike: Global Offensive player, where he played for teams such as Cloud9 and Bad News Bears. He switched to VALORANT when the game came out and initially joined Cloud9’s VALORANT roster, though he was benched and moved to a streamer position after a series of disappointing results for the team. He then moved to Sentinels on loan before making his move permanent in June of 2021.\r\n\r\nHe is known for changing his settings and gear frequently, sometimes even switching mice multiple times during one match.'),
(2, 'Max', 'Demon1', 'Mazanov', '2002-09-07', 'USA', 'Valorant', 'NRG', 'Max “Demon1” Mazanov is a professional VALORANT player from the United States who is currently playing for NRG.'),
(3, 'Adil', 'Scream', 'Benrlitom', '1994-07-02', 'Belgium', 'Valorant', 'Free', 'Adil “ScreaM” Benrlitom is a professional VALORANT player from Belgium. ScreaM started his professional gaming career as a pro Counter-Strike: Global Offensive player, where he achieved great successes with teams such as G2, VeryGames, and EnVyUs.\r\n\r\nHe was one of the top 10 CS:GO players in the world in 2013 and 2016, and became known for his tap-focused playstyle that relied heavily on getting headshots, earning him the nickname ‘headshot machine’. He was and still is a very popular player, in part thanks to his mechanical ability and entertaining playstyle.\r\n\r\nAt the end of 2020, he switched to VALORANT and joined Team Liquid.'),
(4, 'Wang', 'Jinggg', 'Jing Jie', '2003-07-29', 'Singapore', 'Valorant', 'Paper Rex', 'Wang “Jinggg” Jing Jie is currently playing for Paper Rex.'),
(5, 'Karel', 'Twisten', 'Ašenbrener', '2003-12-04', 'Czechia', 'Valorant', '(RIP)', 'Karel “Twisten” Ašenbrener was a professional VALORANT player from Czechia. He passed away on June 7th 2023.'),
(6, 'Oleksandr', 's1mple', 'Kostyliev', '1997-10-02', 'Ukraine', 'CS2', 'NAVI', 'Oleksandr “s1mple” Kostyliev was born on October 2, 1997 and is currently on the Natus Vincere bench. s1mple is considered by many to be the best Counter-Strike player of all time, a claim that is supported by his many achievements and trophies. His teams have won a Major, an Intel Grand Slam, and many top tier tournaments, while his personal accolades include over 20 HLTV MVP medals, and the number one position in HLTV’s ‘best player of the year’ lists. He was the runner-up in 2019 and 2020.\r\n\r\ns1mple has played for many teams, including Liquid, FlipSid3, and HellRaisers, but has won most tournaments with Natus Vincere, where he joined in August of 2016.'),
(7, ' Mathieu', 'ZywOo', 'Herbaut', '2000-11-09', 'France', 'CS2', 'Vitality', 'Mathieu “ZywOo” Herbaut was born on November 9, 2000 and is currently playing for Team Vitality as an AWPer'),
(8, 'Lee', 'Faker', ' Sang-hyeok', '1996-05-07', 'South Korea', 'LoL', 'T1', 'Lee \"Faker\" Sang-hyeok (Hangul: 이상혁) is a League of Legends esports player, currently mid laner and part owner at T1.'),
(9, 'Martin', 'Rekkles', 'Larsson', '1996-09-20', 'Sweden', 'LoL', 'T1 Acad.', 'Martin \"Rekkles\" Larsson (born September 20, 1996) is a Swedish player who is currently playing as a Support for T1 Esports Academy.'),
(10, 'Sébastien', 'CeB', 'Debs', '1992-05-11', 'France', 'Dota 2', 'OG', 'Sébastien \"Ceb\" Debs (formerly known as 7ckngMad) (born May 11, 1992) is a French/Lebanese player who is currently playing for OG.\r\n\r\nHe is the co-founder of OG.'),
(11, 'Amine', 'itachi', 'Benayachi', '2003-08-13', 'Marocco', 'Rocket League', 'Gentle Mates', 'Amine \"itachi\" Benayachi (born August 13, 2003) is a Moroccan Rocket League player currently residing in France.'),
(12, 'Enzo', 'Seikoo', 'Grondein', '2004-06-07', 'France', 'Rocket League', 'Gentle Mates', 'Enzo \"Seikoo\" Grondein (born June 7, 2004) is a French Rocket League player.'),
(13, 'Charles', 'juicy', 'Sabiani', '2005-03-05', 'France', 'Rocket League', 'Gentle Mates', 'Charles \"juicy\" Sabiani (born March 5, 2005) is a French Rocket League player.'),
(14, 'Zachary', 'Zekken', 'Patrone', '2005-03-19', 'USA', 'Valorant', 'Sentinels', 'Zachary “zekken” Patrone is a professional VALORANT player from the United States of America who is currently playing for Sentinels.'),
(15, 'Erick', 'aspas', 'Santos', '2003-06-15', 'Brazil', 'Valorant', 'Leviatan', 'Erick “aspas” Santos is a professional VALORANT player from Brazil who is currently playing for Leviatan. Upon joining LOUD’s roster in February of 2022, he has quickly become one of the game’s most popular players.\r\n\r\nPlaying for LOUD, he won VALORANT Champions 2022, after defeating Optic 3-1 in the grand finals at Istanbul.'),
(16, 'Logan', 'LogaN', 'Corti', '1998-06-18', 'France', 'Valorant', 'Gentle Mates', 'Logan “logaN” Corti is a professional VALORANT player from France who is currently playing for Gentle Mates. He is a former professional Counter-Strike: Global Offensive player, where he played for teams such as Team Heretics and Team LDLC.'),
(17, 'Nathan', 'nataNk', 'Bocqueho', '1999-02-25', 'France', 'Valorant', 'Gentle Mates', 'Nathan “nathaNk” Bocqueho is a professional VALORANT player from France.'),
(18, 'Jonathan', 'TakaS', 'Paupard', '2001-02-15', 'France', 'Valorant', 'Gentle Mates', 'Jonathan “TakaS” Paupard is a professional VALORANT player from France.'),
(19, 'Wailers', 'Wailers', 'Locart', '1997-11-24', 'France', 'Valorant', 'Gentle Mates', 'Wailers “Wailers” Locart is a professional VALORANT player from France.'),
(20, 'Beyazıt', 'beyAz', 'Körpe', '1996-11-04', 'France - Turkey', 'Valorant', 'Gentle Mates', 'Beyazıt \"beyAz\" Körpe (born November 4, 1996) is a French/Turkish player who is currently playing as an in-game leader for Gentle Mates. He is a former Counter-Strike: Global Offensive player.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
