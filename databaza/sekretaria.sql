-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 12:36 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekretaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `departamenti`
--

CREATE TABLE `departamenti` (
  `Id_Dep` int(10) UNSIGNED NOT NULL,
  `Emertimi` varchar(50) NOT NULL,
  `Shefi` varchar(30) NOT NULL,
  `Id_Fakulteti` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detyrim`
--

CREATE TABLE `detyrim` (
  `Id_Detyrim` int(10) UNSIGNED NOT NULL,
  `Detyrim_A` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fakulteti`
--

CREATE TABLE `fakulteti` (
  `Id_Fakulteti` int(10) UNSIGNED NOT NULL,
  `Emertimi_F` varchar(50) NOT NULL,
  `Dekani` varchar(30) NOT NULL,
  `Id_IAL` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flete_provimi`
--

CREATE TABLE `flete_provimi` (
  `Nr_rendor` int(10) UNSIGNED NOT NULL,
  `Nota` int(10) UNSIGNED NOT NULL,
  `Id_KokeProvimi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grup_m`
--

CREATE TABLE `grup_m` (
  `IdGM` int(10) UNSIGNED NOT NULL,
  `Emertimi` varchar(50) NOT NULL,
  `Id_VA` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ial`
--

CREATE TABLE `ial` (
  `Id_IAL` int(10) UNSIGNED NOT NULL,
  `Emertimi` varchar(50) NOT NULL,
  `Rektori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `koke_provimi`
--

CREATE TABLE `koke_provimi` (
  `Id_KokeProvimi` int(10) UNSIGNED NOT NULL,
  `Id_VA` int(10) UNSIGNED NOT NULL,
  `Sesioni` varchar(20) NOT NULL,
  `Data` date NOT NULL,
  `Id_Lende` int(10) UNSIGNED NOT NULL,
  `Id_IAL` int(10) UNSIGNED NOT NULL,
  `Id_Fakulteti` int(10) UNSIGNED NOT NULL,
  `Id_Dep` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `komisioni`
--

CREATE TABLE `komisioni` (
  `IdKomisioni` int(10) UNSIGNED NOT NULL,
  `Emertimi` varchar(30) NOT NULL,
  `Kryetari` int(10) UNSIGNED NOT NULL,
  `Anetari_1` int(10) UNSIGNED NOT NULL,
  `Anetari_2` int(10) UNSIGNED NOT NULL,
  `Id_VA` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lende`
--

CREATE TABLE `lende` (
  `Id_Lende` int(10) UNSIGNED NOT NULL,
  `Emertim_L` varchar(50) NOT NULL,
  `Id_Detyrim` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pedagogu`
--

CREATE TABLE `pedagogu` (
  `IdPedagog` int(10) UNSIGNED NOT NULL,
  `Emer` varchar(20) NOT NULL,
  `Mbiemer` varchar(20) NOT NULL,
  `Titulli` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `IdStudent` int(10) UNSIGNED NOT NULL,
  `Emer` varchar(20) NOT NULL,
  `Mbiemer` varchar(20) NOT NULL,
  `IdGM` int(10) UNSIGNED NOT NULL,
  `Id_Detyrim` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_provim`
--
CREATE TABLE `student_provim` (
`IdStudent` int(10) unsigned
,`Emer` varchar(20)
,`Mbiemer` varchar(20)
,`Id_Detyrim` int(10) unsigned
,`Detyrim_A` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `veprimtari`
--

CREATE TABLE `veprimtari` (
  `Id_Vep` int(10) UNSIGNED NOT NULL,
  `Emertimi` varchar(20) NOT NULL,
  `Nr_KFU` int(10) UNSIGNED NOT NULL,
  `Nr_Ore` int(10) UNSIGNED NOT NULL,
  `IdPedagog` int(10) UNSIGNED NOT NULL,
  `Id_Lende` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `viti_akademik`
--

CREATE TABLE `viti_akademik` (
  `Id_VA` int(10) UNSIGNED NOT NULL,
  `Viti_Akademik` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `student_provim`
--
DROP TABLE IF EXISTS `student_provim`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_provim`  AS  select `student`.`IdStudent` AS `IdStudent`,`student`.`Emer` AS `Emer`,`student`.`Mbiemer` AS `Mbiemer`,`student`.`Id_Detyrim` AS `Id_Detyrim`,`detyrim`.`Detyrim_A` AS `Detyrim_A` from (`student` join `detyrim`) where ((`student`.`Id_Detyrim` = `detyrim`.`Id_Detyrim`) and (`detyrim`.`Detyrim_A` = 1)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departamenti`
--
ALTER TABLE `departamenti`
  ADD PRIMARY KEY (`Id_Dep`),
  ADD KEY `Id_Fakulteti` (`Id_Fakulteti`);

--
-- Indexes for table `detyrim`
--
ALTER TABLE `detyrim`
  ADD PRIMARY KEY (`Id_Detyrim`);

--
-- Indexes for table `fakulteti`
--
ALTER TABLE `fakulteti`
  ADD PRIMARY KEY (`Id_Fakulteti`),
  ADD KEY `Id_IAL` (`Id_IAL`);

--
-- Indexes for table `flete_provimi`
--
ALTER TABLE `flete_provimi`
  ADD PRIMARY KEY (`Nr_rendor`),
  ADD KEY `Id_KokeProvimi` (`Id_KokeProvimi`);

--
-- Indexes for table `grup_m`
--
ALTER TABLE `grup_m`
  ADD PRIMARY KEY (`IdGM`),
  ADD KEY `Id_VA` (`Id_VA`);

--
-- Indexes for table `ial`
--
ALTER TABLE `ial`
  ADD PRIMARY KEY (`Id_IAL`);

--
-- Indexes for table `koke_provimi`
--
ALTER TABLE `koke_provimi`
  ADD PRIMARY KEY (`Id_KokeProvimi`),
  ADD KEY `Id_VA` (`Id_VA`),
  ADD KEY `Id_Lende` (`Id_Lende`),
  ADD KEY `Id_IAL` (`Id_IAL`),
  ADD KEY `Id_Fakulteti` (`Id_Fakulteti`),
  ADD KEY `Id_Dep` (`Id_Dep`);

--
-- Indexes for table `komisioni`
--
ALTER TABLE `komisioni`
  ADD PRIMARY KEY (`IdKomisioni`),
  ADD KEY `Id_VA` (`Id_VA`),
  ADD KEY `Kryetari` (`Kryetari`),
  ADD KEY `Anetari_1` (`Anetari_1`),
  ADD KEY `Anetari_2` (`Anetari_2`);

--
-- Indexes for table `lende`
--
ALTER TABLE `lende`
  ADD PRIMARY KEY (`Id_Lende`),
  ADD KEY `Id_Detyrim` (`Id_Detyrim`);

--
-- Indexes for table `pedagogu`
--
ALTER TABLE `pedagogu`
  ADD PRIMARY KEY (`IdPedagog`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`IdStudent`),
  ADD KEY `IdGM` (`IdGM`),
  ADD KEY `Id_Detyrim` (`Id_Detyrim`);

--
-- Indexes for table `veprimtari`
--
ALTER TABLE `veprimtari`
  ADD PRIMARY KEY (`Id_Vep`),
  ADD KEY `IdPedagog` (`IdPedagog`),
  ADD KEY `Id_Lende` (`Id_Lende`);

--
-- Indexes for table `viti_akademik`
--
ALTER TABLE `viti_akademik`
  ADD PRIMARY KEY (`Id_VA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departamenti`
--
ALTER TABLE `departamenti`
  MODIFY `Id_Dep` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detyrim`
--
ALTER TABLE `detyrim`
  MODIFY `Id_Detyrim` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fakulteti`
--
ALTER TABLE `fakulteti`
  MODIFY `Id_Fakulteti` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `flete_provimi`
--
ALTER TABLE `flete_provimi`
  MODIFY `Nr_rendor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grup_m`
--
ALTER TABLE `grup_m`
  MODIFY `IdGM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ial`
--
ALTER TABLE `ial`
  MODIFY `Id_IAL` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `koke_provimi`
--
ALTER TABLE `koke_provimi`
  MODIFY `Id_KokeProvimi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `komisioni`
--
ALTER TABLE `komisioni`
  MODIFY `IdKomisioni` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lende`
--
ALTER TABLE `lende`
  MODIFY `Id_Lende` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pedagogu`
--
ALTER TABLE `pedagogu`
  MODIFY `IdPedagog` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `IdStudent` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veprimtari`
--
ALTER TABLE `veprimtari`
  MODIFY `Id_Vep` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `viti_akademik`
--
ALTER TABLE `viti_akademik`
  MODIFY `Id_VA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `departamenti`
--
ALTER TABLE `departamenti`
  ADD CONSTRAINT `departamenti_ibfk_1` FOREIGN KEY (`Id_Fakulteti`) REFERENCES `fakulteti` (`Id_Fakulteti`);

--
-- Constraints for table `fakulteti`
--
ALTER TABLE `fakulteti`
  ADD CONSTRAINT `fakulteti_ibfk_1` FOREIGN KEY (`Id_IAL`) REFERENCES `ial` (`Id_IAL`);

--
-- Constraints for table `flete_provimi`
--
ALTER TABLE `flete_provimi`
  ADD CONSTRAINT `flete_provimi_ibfk_1` FOREIGN KEY (`Id_KokeProvimi`) REFERENCES `koke_provimi` (`Id_KokeProvimi`);

--
-- Constraints for table `grup_m`
--
ALTER TABLE `grup_m`
  ADD CONSTRAINT `grup_m_ibfk_1` FOREIGN KEY (`Id_VA`) REFERENCES `viti_akademik` (`Id_VA`);

--
-- Constraints for table `koke_provimi`
--
ALTER TABLE `koke_provimi`
  ADD CONSTRAINT `koke_provimi_ibfk_1` FOREIGN KEY (`Id_Lende`) REFERENCES `lende` (`Id_Lende`),
  ADD CONSTRAINT `koke_provimi_ibfk_2` FOREIGN KEY (`Id_IAL`) REFERENCES `ial` (`Id_IAL`),
  ADD CONSTRAINT `koke_provimi_ibfk_3` FOREIGN KEY (`Id_Fakulteti`) REFERENCES `fakulteti` (`Id_Fakulteti`),
  ADD CONSTRAINT `koke_provimi_ibfk_4` FOREIGN KEY (`Id_Dep`) REFERENCES `departamenti` (`Id_Dep`);

--
-- Constraints for table `komisioni`
--
ALTER TABLE `komisioni`
  ADD CONSTRAINT `komisioni_ibfk_1` FOREIGN KEY (`Kryetari`) REFERENCES `pedagogu` (`IdPedagog`),
  ADD CONSTRAINT `komisioni_ibfk_2` FOREIGN KEY (`Anetari_1`) REFERENCES `pedagogu` (`IdPedagog`),
  ADD CONSTRAINT `komisioni_ibfk_3` FOREIGN KEY (`Anetari_2`) REFERENCES `pedagogu` (`IdPedagog`),
  ADD CONSTRAINT `komisioni_ibfk_4` FOREIGN KEY (`Id_VA`) REFERENCES `viti_akademik` (`Id_VA`);

--
-- Constraints for table `lende`
--
ALTER TABLE `lende`
  ADD CONSTRAINT `lende_ibfk_1` FOREIGN KEY (`Id_Detyrim`) REFERENCES `detyrim` (`Id_Detyrim`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`IdGM`) REFERENCES `grup_m` (`IdGM`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`Id_Detyrim`) REFERENCES `detyrim` (`Id_Detyrim`);

--
-- Constraints for table `veprimtari`
--
ALTER TABLE `veprimtari`
  ADD CONSTRAINT `veprimtari_ibfk_1` FOREIGN KEY (`Id_Lende`) REFERENCES `lende` (`Id_Lende`),
  ADD CONSTRAINT `veprimtari_ibfk_2` FOREIGN KEY (`IdPedagog`) REFERENCES `pedagogu` (`IdPedagog`);

--
-- Constraints for table `viti_akademik`
--
ALTER TABLE `viti_akademik`
  ADD CONSTRAINT `viti_akademik_ibfk_1` FOREIGN KEY (`Id_VA`) REFERENCES `koke_provimi` (`Id_VA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
