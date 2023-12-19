-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 09:20 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uzytkownicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `id_komentarza` int(11) NOT NULL,
  `id_uzytkownika` text DEFAULT NULL,
  `komentarz` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logowanie`
--

CREATE TABLE `logowanie` (
  `id_uzytkownika` int(11) NOT NULL,
  `Nazwa_uzytkownika` text DEFAULT NULL,
  `haslo` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'img/user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logowanie`
--

INSERT INTO `logowanie` (`id_uzytkownika`, `Nazwa_uzytkownika`, `haslo`, `email`, `profile_picture`) VALUES
(12, 'Kacper210304', '$2y$10$v9jWSrtB3DRh87U1xZfhWe0N6erYTNpSONRhB2D6rBNtkjofyf0je', 'kacperswoboda@gmail.com', 'img/user.png'),
(13, 'Kacper12', '$2y$10$Ysp/bUTqJ7CVjak2wLL/deK0uOVi0VzolHBdk/Voc4mXPvsi7BMm2', 'kacperswoboda12@gmail.com', 'img/profile_pictures/Przechwytywanie_1.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `post_id` int(11) NOT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL,
  `tytul` text DEFAULT NULL,
  `tresc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posty`
--

INSERT INTO `posty` (`post_id`, `id_uzytkownika`, `tytul`, `tresc`) VALUES
(17, 13, 'Siema kupiłem ostatnio frytki', 'Siema kupiłem ostatnio frytki w Biedronce i zamiast frytek w środku były dwa całe ziemniaki, wie ktoś o co chodzi? Mieliście tak może? ');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`id_komentarza`);

--
-- Indeksy dla tabeli `logowanie`
--
ALTER TABLE `logowanie`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- Indeksy dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `id_komentarza` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logowanie`
--
ALTER TABLE `logowanie`
  MODIFY `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posty`
--
ALTER TABLE `posty`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
