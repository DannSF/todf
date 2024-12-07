-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2024 at 12:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todf`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertAdmin` ()   BEGIN
    INSERT INTO EMPLOYEE (LastName, FirstName, EmailAddress, Username, Password, Role)
    VALUES ('Admin', 'User', 'admin@example.com', 'admin', MD5('admin123'), 'admin');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertAll` ()   BEGIN
    CALL InsertCategories();
    CALL InsertSubcategories();
    CALL InsertAdmin();
    CALL InsertMembers();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCategories` ()   BEGIN
    INSERT INTO CATEGORY (CategoryName) VALUES 
        ('Operating System'), 
        ('Web Development'), 
        ('Food'), 
        ('Other');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertMembers` ()   BEGIN
    INSERT INTO MEMBER (LastName, FirstName, EmailAddress, Username, Password, MemberImageFilename)
    VALUES ('Doe', 'John', 'john@example.com', 'johndoe', MD5('password1'), 'john.jpg'),
           ('Smith', 'Jane', 'jane@example.com', 'janesmith', MD5('password2'), 'jane.jpg');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSubcategories` ()   BEGIN
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Windows', CategoryID FROM CATEGORY WHERE CategoryName = 'Operating System';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'MacOS', CategoryID FROM CATEGORY WHERE CategoryName = 'Operating System';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Linux', CategoryID FROM CATEGORY WHERE CategoryName = 'Operating System';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Other', CategoryID FROM CATEGORY WHERE CategoryName = 'Operating System';

    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'HTML', CategoryID FROM CATEGORY WHERE CategoryName = 'Web Development';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'CSS', CategoryID FROM CATEGORY WHERE CategoryName = 'Web Development';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'JavaScript', CategoryID FROM CATEGORY WHERE CategoryName = 'Web Development';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Php', CategoryID FROM CATEGORY WHERE CategoryName = 'Web Development';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'MySQL', CategoryID FROM CATEGORY WHERE CategoryName = 'Web Development';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Other', CategoryID FROM CATEGORY WHERE CategoryName = 'Web Development';

    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Breakfast', CategoryID FROM CATEGORY WHERE CategoryName = 'Food';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Lunch', CategoryID FROM CATEGORY WHERE CategoryName = 'Food';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Dinner', CategoryID FROM CATEGORY WHERE CategoryName = 'Food';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Snacks', CategoryID FROM CATEGORY WHERE CategoryName = 'Food';
    INSERT INTO SUBCATEGORY (SubcategoryName, CategoryID)
    SELECT 'Other', CategoryID FROM CATEGORY WHERE CategoryName = 'Food';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ANSWERDRAFTLINE`
--

CREATE TABLE `ANSWERDRAFTLINE` (
  `AnswerDraftID` int(11) NOT NULL,
  `AnswerDraft` text NOT NULL,
  `AnswerDraftDate` date NOT NULL,
  `AnswerDraftApproval` enum('pending','approved','rejected') NOT NULL,
  `MemberID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `AnswerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ANSWERDRAFTLINE`
--

INSERT INTO `ANSWERDRAFTLINE` (`AnswerDraftID`, `AnswerDraft`, `AnswerDraftDate`, `AnswerDraftApproval`, `MemberID`, `QuestionID`, `AnswerID`) VALUES
(2, 'Ubuntu is a great Linux distro for beginners because of its ease of use.', '2024-12-03', 'pending', 2, 6, NULL),
(3, 'Ubuntu is a great Linux distro for beginners because of its ease of use.', '2024-12-03', 'pending', 2, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ANSWERLINE`
--

CREATE TABLE `ANSWERLINE` (
  `AnswerID` int(11) NOT NULL,
  `Answer` text NOT NULL,
  `AnswerDate` date NOT NULL,
  `MemberID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ANSWERLINE`
--

INSERT INTO `ANSWERLINE` (`AnswerID`, `Answer`, `AnswerDate`, `MemberID`, `QuestionID`) VALUES
(1, 'Ubuntu is a great Linux distro for beginners because of its ease of use.', '2024-12-03', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CATEGORY`
--

INSERT INTO `CATEGORY` (`CategoryID`, `CategoryName`) VALUES
(3, 'Food'),
(1, 'Operating System'),
(2, 'Web Development');

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Role` enum('admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`EmployeeID`, `LastName`, `FirstName`, `EmailAddress`, `Username`, `Password`, `Role`) VALUES
(1, 'Admin', 'User', 'admin@example.com', 'admin', '0192023a7bbd73250516f069df18b500', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `MEMBER`
--

CREATE TABLE `MEMBER` (
  `MemberID` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `MemberImageFilename` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MEMBER`
--

INSERT INTO `MEMBER` (`MemberID`, `LastName`, `FirstName`, `EmailAddress`, `Username`, `Password`, `MemberImageFilename`) VALUES
(1, 'Doe', 'John', 'john@example.com', 'johndoe', '7c6a180b36896a0a8c02787eeafb0e4c', 'john.jpg'),
(2, 'Smith', 'Jane', 'jane@example.com', 'janesmith', '6cb75f652a9b52798eb6cf2201057c73', 'jane.jpg'),
(27, 'Flores', 'Danny', 'dnnfr6@gmail.com', 'dsflores', '76d80224611fc919a5d54f0ff9fba446', 'defaul.jpg'),
(28, 'Restrepo', 'James', 'asdasdsd@asd.com', 'jrestrepo', '7815696ecbf1c96e6894b779456d330e', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `QUESTION`
--

CREATE TABLE `QUESTION` (
  `QuestionID` int(11) NOT NULL,
  `Question` text NOT NULL,
  `QuestionDetails` text DEFAULT NULL,
  `QuestionCreationDate` date NOT NULL,
  `QuestionStatus` enum('open','close') NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `SubcategoryID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `QUESTION`
--

INSERT INTO `QUESTION` (`QuestionID`, `Question`, `QuestionDetails`, `QuestionCreationDate`, `QuestionStatus`, `CategoryID`, `SubcategoryID`, `MemberID`) VALUES
(1, 'How do I install Windows 11 on my computer?', 'I need guidance on the steps required to install Windows 11.', '2024-12-02', 'open', 1, 1, 1),
(2, 'What is the difference between CSS Grid and Flexbox?', 'I want to understand when to use CSS Grid or Flexbox for layout on web pages.', '2024-12-02', 'open', 2, 6, 2),
(3, 'What foods are recommended for breakfast...?', 'I’m looking for breakfast ideas that are nutritious and easy to prepare.', '2024-12-02', 'open', 3, 11, 1),
(4, 'Which operating system is best for web development?', 'I’m considering using Linux or Windows for web development. Which one is better?', '2024-12-02', 'open', 1, 3, 2),
(5, 'How do I set up a local server with PHP and MySQL?', 'I’m looking for a guide to set up a local server on my computer for development.', '2024-12-02', 'open', 2, 8, 1),
(6, 'What is the best Linux distro for beginners?', 'I am new to Linux and want suggestions.', '2024-12-03', 'open', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `QUESTIONDRAFT`
--

CREATE TABLE `QUESTIONDRAFT` (
  `QuestionDraftID` int(11) NOT NULL,
  `QuestionDraft` text NOT NULL,
  `QuestionDraftDetails` text DEFAULT NULL,
  `QuestionDraftCreationDate` date NOT NULL,
  `QuestionDraftApproval` enum('pending','approved','rejected') NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `SubcategoryID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `MemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `QUESTIONDRAFT`
--

INSERT INTO `QUESTIONDRAFT` (`QuestionDraftID`, `QuestionDraft`, `QuestionDraftDetails`, `QuestionDraftCreationDate`, `QuestionDraftApproval`, `CategoryID`, `SubcategoryID`, `QuestionID`, `MemberID`) VALUES
(2, 'What is the best Linux distro for beginners?', 'I am new to Linux and want suggestions.', '2024-12-03', 'pending', 1, 3, NULL, 1),
(3, 'What is the best Linux distro for beginners?', 'I am new to Linux and want suggestions.', '2024-12-03', 'pending', 1, 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `SUBCATEGORY`
--

CREATE TABLE `SUBCATEGORY` (
  `SubcategoryID` int(11) NOT NULL,
  `SubcategoryName` varchar(50) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SUBCATEGORY`
--

INSERT INTO `SUBCATEGORY` (`SubcategoryID`, `SubcategoryName`, `CategoryID`) VALUES
(1, 'Windows', 1),
(2, 'MacOS', 1),
(3, 'Linux', 1),
(5, 'HTML', 2),
(6, 'CSS', 2),
(7, 'JavaScript', 2),
(8, 'Php', 2),
(9, 'MySQL', 2),
(11, 'Breakfast', 3),
(12, 'Lunch', 3),
(13, 'Dinner', 3),
(14, 'Snacks', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ANSWERDRAFTLINE`
--
ALTER TABLE `ANSWERDRAFTLINE`
  ADD PRIMARY KEY (`AnswerDraftID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `QuestionID` (`QuestionID`),
  ADD KEY `AnswerID` (`AnswerID`);

--
-- Indexes for table `ANSWERLINE`
--
ALTER TABLE `ANSWERLINE`
  ADD PRIMARY KEY (`AnswerID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `MEMBER`
--
ALTER TABLE `MEMBER`
  ADD PRIMARY KEY (`MemberID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `QUESTION`
--
ALTER TABLE `QUESTION`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `SubcategoryID` (`SubcategoryID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `QUESTIONDRAFT`
--
ALTER TABLE `QUESTIONDRAFT`
  ADD PRIMARY KEY (`QuestionDraftID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `SubcategoryID` (`SubcategoryID`),
  ADD KEY `QuestionID` (`QuestionID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `SUBCATEGORY`
--
ALTER TABLE `SUBCATEGORY`
  ADD PRIMARY KEY (`SubcategoryID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ANSWERDRAFTLINE`
--
ALTER TABLE `ANSWERDRAFTLINE`
  MODIFY `AnswerDraftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ANSWERLINE`
--
ALTER TABLE `ANSWERLINE`
  MODIFY `AnswerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `MEMBER`
--
ALTER TABLE `MEMBER`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `QUESTION`
--
ALTER TABLE `QUESTION`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `QUESTIONDRAFT`
--
ALTER TABLE `QUESTIONDRAFT`
  MODIFY `QuestionDraftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `SUBCATEGORY`
--
ALTER TABLE `SUBCATEGORY`
  MODIFY `SubcategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ANSWERDRAFTLINE`
--
ALTER TABLE `ANSWERDRAFTLINE`
  ADD CONSTRAINT `answerdraftline_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `MEMBER` (`MemberID`),
  ADD CONSTRAINT `answerdraftline_ibfk_2` FOREIGN KEY (`QuestionID`) REFERENCES `QUESTION` (`QuestionID`),
  ADD CONSTRAINT `answerdraftline_ibfk_3` FOREIGN KEY (`AnswerID`) REFERENCES `ANSWERLINE` (`AnswerID`);

--
-- Constraints for table `ANSWERLINE`
--
ALTER TABLE `ANSWERLINE`
  ADD CONSTRAINT `answerline_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `MEMBER` (`MemberID`),
  ADD CONSTRAINT `answerline_ibfk_2` FOREIGN KEY (`QuestionID`) REFERENCES `QUESTION` (`QuestionID`);

--
-- Constraints for table `QUESTION`
--
ALTER TABLE `QUESTION`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `CATEGORY` (`CategoryID`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`SubcategoryID`) REFERENCES `SUBCATEGORY` (`SubcategoryID`),
  ADD CONSTRAINT `question_ibfk_3` FOREIGN KEY (`MemberID`) REFERENCES `MEMBER` (`MemberID`);

--
-- Constraints for table `QUESTIONDRAFT`
--
ALTER TABLE `QUESTIONDRAFT`
  ADD CONSTRAINT `questiondraft_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `CATEGORY` (`CategoryID`),
  ADD CONSTRAINT `questiondraft_ibfk_2` FOREIGN KEY (`SubcategoryID`) REFERENCES `SUBCATEGORY` (`SubcategoryID`),
  ADD CONSTRAINT `questiondraft_ibfk_3` FOREIGN KEY (`QuestionID`) REFERENCES `QUESTION` (`QuestionID`),
  ADD CONSTRAINT `questiondraft_ibfk_4` FOREIGN KEY (`MemberID`) REFERENCES `MEMBER` (`MemberID`);

--
-- Constraints for table `SUBCATEGORY`
--
ALTER TABLE `SUBCATEGORY`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `CATEGORY` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
