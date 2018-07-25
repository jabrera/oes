-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2015 at 01:20 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dlsudhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE IF NOT EXISTS `Account` (
  `ID` int(12) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(32) DEFAULT NULL,
  `Type` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201600211 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`ID`, `Username`, `Password`, `Type`, `Status`) VALUES
(1, 'admin', 'admin', 'Administrator', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `Administration`
--

CREATE TABLE IF NOT EXISTS `Administration` (
  `ID` int(12) NOT NULL,
  `SchoolYear` int(4) NOT NULL,
  `Status` int(1) NOT NULL,
  `MaxExaminees` int(12) NOT NULL,
  `MaxInterviewees` int(12) NOT NULL,
  `FirstQuarter` int(1) NOT NULL,
  `SecondQuarter` int(1) NOT NULL,
  `ThirdQuarter` int(1) NOT NULL,
  `FourthQuarter` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Administration`
--

INSERT INTO `Administration` (`ID`, `SchoolYear`, `Status`, `MaxExaminees`, `MaxInterviewees`, `FirstQuarter`, `SecondQuarter`, `ThirdQuarter`, `FourthQuarter`) VALUES
(1, 2015, 0, 50, 50, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Administrator`
--

CREATE TABLE IF NOT EXISTS `Administrator` (
  `Username` varchar(50) NOT NULL,
  `Module` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Admission`
--

CREATE TABLE IF NOT EXISTS `Admission` (
  `ID` int(12) NOT NULL,
  `Entrance` varchar(100) NOT NULL,
  `ScheduleDate` date DEFAULT NULL,
  `ScheduleTime` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Admission`
--

INSERT INTO `Admission` (`ID`, `Entrance`, `ScheduleDate`, `ScheduleTime`) VALUES
(5, 'Exam', '2015-09-20', '10:00:00'),
(9, 'Exam', '2015-10-12', '10:00:00'),
(10, 'Interview', '2015-10-10', '11:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `Assessment`
--

CREATE TABLE IF NOT EXISTS `Assessment` (
  `ID` int(12) NOT NULL,
  `TuitionFee` decimal(12,3) NOT NULL,
  `LaboratoryFee` decimal(12,3) NOT NULL,
  `MiscellaneousFee` decimal(12,3) NOT NULL,
  `OtherFee` decimal(12,3) NOT NULL,
  `InstallmentFee` decimal(12,3) NOT NULL,
  `PaymentTerm` varchar(100) DEFAULT NULL,
  `Installment` decimal(12,3) DEFAULT NULL,
  `PreviousBalance` decimal(12,3) NOT NULL,
  `Balance` decimal(12,3) NOT NULL,
  `Credit` decimal(12,3) NOT NULL,
  `Surcharge` decimal(12,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Breakdown`
--

CREATE TABLE IF NOT EXISTS `Breakdown` (
  `ID` int(12) NOT NULL,
  `GradeLevel` int(2) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Price` decimal(12,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Breakdown`
--

INSERT INTO `Breakdown` (`ID`, `GradeLevel`, `Title`, `Price`) VALUES
(1, 7, 'Tuition Fee', '37100.00'),
(2, 7, 'Laboratory Fee', '3100.00'),
(3, 7, 'Miscellaneous Fee', '6450.00'),
(4, 7, 'Other Fee', '6500.00'),
(5, 8, 'Tuition Fee', '36400.00'),
(6, 8, 'Laboratory Fee', '3100.00'),
(7, 8, 'Miscellaneous Fee', '5950.00'),
(8, 8, 'Other Fee', '6350.00'),
(9, 9, 'Tuition Fee', '36400.00'),
(10, 9, 'Laboratory Fee', '3200.00'),
(11, 9, 'Miscellaneous Fee', '5950.00'),
(12, 9, 'Other Fee', '6350.00'),
(13, 10, 'Tuition Fee', '36400.00'),
(14, 10, 'Laboratory Fee', '3200.00'),
(15, 10, 'Miscellaneous Fee', '5950.00'),
(16, 10, 'Other Fee', '7750.00');

-- --------------------------------------------------------

--
-- Table structure for table `Building`
--

CREATE TABLE IF NOT EXISTS `Building` (
  `ID` int(12) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Code` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Building`
--

INSERT INTO `Building` (`ID`, `Name`, `Code`) VALUES
(2, 'Building 2', 'B2');

-- --------------------------------------------------------

--
-- Table structure for table `CreditCard`
--

CREATE TABLE IF NOT EXISTS `CreditCard` (
  `ID` int(12) NOT NULL,
  `HolderName` varchar(200) NOT NULL,
  `CardNumber` varchar(100) NOT NULL,
  `VerificationNumber` varchar(4) NOT NULL,
  `ExpirationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Curriculum`
--

CREATE TABLE IF NOT EXISTS `Curriculum` (
  `ID` int(12) NOT NULL,
  `SubjectID` int(12) NOT NULL,
  `YearLevel` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Enrollee`
--

CREATE TABLE IF NOT EXISTS `Enrollee` (
  `ID` int(12) NOT NULL,
  `AdmissionID` int(12) DEFAULT NULL,
  `EnrollmentStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Expertise`
--

CREATE TABLE IF NOT EXISTS `Expertise` (
  `ID` int(12) NOT NULL,
  `FacultyID` int(12) NOT NULL,
  `SubjectID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Faculty`
--

CREATE TABLE IF NOT EXISTS `Faculty` (
  `ID` int(12) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `BirthDate` date NOT NULL,
  `Gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Feed`
--

CREATE TABLE IF NOT EXISTS `Feed` (
  `ID` int(12) NOT NULL,
  `AccountID` int(12) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Message` varchar(500) NOT NULL,
  `DatePosted` date NOT NULL,
  `TimePosted` time NOT NULL,
  `Dismiss` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=428 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `GLS`
--

CREATE TABLE IF NOT EXISTS `GLS` (
  `ID` int(12) NOT NULL,
  `GradeLevel` int(2) NOT NULL,
  `Section` varchar(20) NOT NULL,
  `FacultyID` int(12) NOT NULL,
  `RoomID` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Grade`
--

CREATE TABLE IF NOT EXISTS `Grade` (
  `SchoolYear` int(4) NOT NULL,
  `Quarter` int(2) NOT NULL,
  `StudentID` int(12) NOT NULL,
  `SubjectID` int(12) NOT NULL,
  `Grade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LoginCount`
--

CREATE TABLE IF NOT EXISTS `LoginCount` (
  `ID` int(12) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `DateLogin` date NOT NULL,
  `TimeLogin` time NOT NULL,
  `LoggedIn` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PageVisit`
--

CREATE TABLE IF NOT EXISTS `PageVisit` (
  `ID` int(12) NOT NULL,
  `UserID` int(12) NOT NULL,
  `Module` varchar(25) NOT NULL,
  `DateVisited` date NOT NULL,
  `TimeVisited` time NOT NULL,
  `IP_Address` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PaymentTerm`
--

CREATE TABLE IF NOT EXISTS `PaymentTerm` (
  `ID` int(12) NOT NULL,
  `GradeLevel` int(2) NOT NULL,
  `PaymentTerm` varchar(100) NOT NULL,
  `Fee` decimal(12,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PaymentTerm`
--

INSERT INTO `PaymentTerm` (`ID`, `GradeLevel`, `PaymentTerm`, `Fee`) VALUES
(1, 7, 'Full Payment', '-1484.00'),
(2, 7, 'Monthly Installment', '2441.26'),
(3, 7, 'Quarterly Installment', '1985.52'),
(4, 7, 'Semi-annually Installment', '1296.34'),
(6, 8, 'Full Payment', '-1456.00'),
(7, 8, 'Monthly Installment', '2350.02'),
(8, 8, 'Quarterly Installment', '1934.11'),
(9, 8, 'Semi-annually Installment', '1263.42'),
(10, 9, 'Full Payment', '-1456.00'),
(11, 9, 'Quarterly Installment', '1937.85'),
(12, 9, 'Monthly Installment', '2354.55'),
(13, 9, 'Semi-annually Installment', '1265.85'),
(14, 10, 'Quarterly Installment', '1990.12'),
(15, 10, 'Full Payment', '-1456.00'),
(16, 10, 'Monthly Installment', '2481.06'),
(17, 10, 'Semi-annually Installment', '1300.00');

-- --------------------------------------------------------

--
-- Table structure for table `ResetPassword`
--

CREATE TABLE IF NOT EXISTS `ResetPassword` (
  `Hash` varchar(20) NOT NULL,
  `AccountID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Room`
--

CREATE TABLE IF NOT EXISTS `Room` (
  `ID` int(12) NOT NULL,
  `BuildingID` int(12) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Room`
--

INSERT INTO `Room` (`ID`, `BuildingID`, `Name`) VALUES
(77, 2, '101'),
(78, 2, '102'),
(79, 2, '103'),
(80, 2, '104'),
(81, 2, '105'),
(82, 2, '106'),
(83, 2, '107'),
(84, 2, '108'),
(85, 2, '109'),
(86, 2, '110'),
(87, 2, '111'),
(88, 2, '112'),
(89, 2, '113'),
(90, 2, '114'),
(91, 2, '115'),
(92, 2, '116'),
(93, 2, '117'),
(94, 2, '118'),
(95, 2, '119');

-- --------------------------------------------------------

--
-- Table structure for table `Schedule`
--

CREATE TABLE IF NOT EXISTS `Schedule` (
  `ID` int(12) NOT NULL,
  `SectionID` int(12) NOT NULL,
  `SubjectID` int(12) DEFAULT NULL,
  `Break` varchar(50) DEFAULT NULL,
  `FacultyID` int(12) DEFAULT NULL,
  `Day` varchar(10) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `ID` int(12) NOT NULL,
  `Hash` varchar(15) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `AuxiliaryName` varchar(100) DEFAULT NULL,
  `GradeLevel` int(2) NOT NULL,
  `GLS` int(12) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `BirthDate` date NOT NULL,
  `BirthPlace` varchar(100) DEFAULT NULL,
  `Religion` varchar(100) DEFAULT NULL,
  `CivilStatus` varchar(100) DEFAULT NULL,
  `Citizenship` varchar(100) DEFAULT NULL,
  `NoStreetBrgy` varchar(500) DEFAULT NULL,
  `CityMunicipality` varchar(100) DEFAULT NULL,
  `ProvinceState` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `ZipCode` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `MobileNo` varchar(100) DEFAULT NULL,
  `F_FullName` varchar(100) DEFAULT NULL,
  `F_Occupation` varchar(100) DEFAULT NULL,
  `M_FullName` varchar(100) DEFAULT NULL,
  `M_Occupation` varchar(100) DEFAULT NULL,
  `G_FullName` varchar(100) DEFAULT NULL,
  `G_Relationship` varchar(100) DEFAULT NULL,
  `G_Address` varchar(100) DEFAULT NULL,
  `G_MobileNo` varchar(100) DEFAULT NULL,
  `GradeSchool` varchar(500) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `YearGraduate` varchar(100) DEFAULT NULL,
  `BirthCertificate` int(1) NOT NULL,
  `Form138` int(1) NOT NULL,
  `GoodMoral` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Subject`
--

CREATE TABLE IF NOT EXISTS `Subject` (
  `ID` int(12) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Units` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Subject`
--

INSERT INTO `Subject` (`ID`, `Name`, `Code`, `Units`) VALUES
(1, 'Araling Panlipunan', 'AP', 3),
(2, 'English', 'English', 4),
(3, 'English Elective', 'English Elective', 1),
(4, 'Filipino', 'Filipino', 4),
(5, 'Edukasyon sa Pagpapakatao', 'ESP', 2),
(6, 'Christian Living Education', 'CLE', 2),
(7, 'Music', 'Music', 1),
(8, 'Arts', 'Arts', 1),
(9, 'Physical Education', 'PE', 1),
(10, 'Health', 'Health', 1),
(11, 'Math', 'Math', 4),
(12, 'Math Elective', 'Math Elective', 1),
(13, 'Science', 'Science', 4),
(14, 'Science Elective', 'Science Elective', 1),
(15, 'Technology and Livelihood Education', 'TLE', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Surcharge`
--

CREATE TABLE IF NOT EXISTS `Surcharge` (
  `ID` int(12) NOT NULL,
  `StudentID` int(12) NOT NULL,
  `Amount` decimal(12,3) NOT NULL,
  `DateCharge` date NOT NULL,
  `ApplicableMonth` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE IF NOT EXISTS `Transaction` (
  `ID` int(12) NOT NULL,
  `StudentID` int(12) NOT NULL,
  `PaymentType` varchar(100) NOT NULL,
  `ApplicableMonth` varchar(100) NOT NULL,
  `DatePaid` date NOT NULL,
  `TotalAmount` decimal(12,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Administration`
--
ALTER TABLE `Administration`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `Admission`
--
ALTER TABLE `Admission`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Assessment`
--
ALTER TABLE `Assessment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Breakdown`
--
ALTER TABLE `Breakdown`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Building`
--
ALTER TABLE `Building`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `CreditCard`
--
ALTER TABLE `CreditCard`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Curriculum`
--
ALTER TABLE `Curriculum`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Enrollee`
--
ALTER TABLE `Enrollee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Expertise`
--
ALTER TABLE `Expertise`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Faculty`
--
ALTER TABLE `Faculty`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Feed`
--
ALTER TABLE `Feed`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `GLS`
--
ALTER TABLE `GLS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `LoginCount`
--
ALTER TABLE `LoginCount`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `PageVisit`
--
ALTER TABLE `PageVisit`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `PaymentTerm`
--
ALTER TABLE `PaymentTerm`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ResetPassword`
--
ALTER TABLE `ResetPassword`
  ADD PRIMARY KEY (`Hash`);

--
-- Indexes for table `Room`
--
ALTER TABLE `Room`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Schedule`
--
ALTER TABLE `Schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Subject`
--
ALTER TABLE `Subject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Surcharge`
--
ALTER TABLE `Surcharge`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201600211;
--
-- AUTO_INCREMENT for table `Administration`
--
ALTER TABLE `Administration`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Admission`
--
ALTER TABLE `Admission`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Breakdown`
--
ALTER TABLE `Breakdown`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `Building`
--
ALTER TABLE `Building`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Curriculum`
--
ALTER TABLE `Curriculum`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Expertise`
--
ALTER TABLE `Expertise`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Feed`
--
ALTER TABLE `Feed`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=428;
--
-- AUTO_INCREMENT for table `GLS`
--
ALTER TABLE `GLS`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `LoginCount`
--
ALTER TABLE `LoginCount`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PageVisit`
--
ALTER TABLE `PageVisit`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PaymentTerm`
--
ALTER TABLE `PaymentTerm`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `Room`
--
ALTER TABLE `Room`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `Schedule`
--
ALTER TABLE `Schedule`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Subject`
--
ALTER TABLE `Subject`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Surcharge`
--
ALTER TABLE `Surcharge`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Transaction`
--
ALTER TABLE `Transaction`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
