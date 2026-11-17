-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 07:21 PM
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
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE `allocations` (
  `ID` int(11) NOT NULL,
  `RequisitionID` int(11) NOT NULL,
  `InventoryID` int(11) NOT NULL,
  `AllocatedBy` int(11) NOT NULL,
  `QuantityAllocated` int(11) NOT NULL,
  `AllocatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id` int(11) NOT NULL,
  `Requestid` varchar(100) NOT NULL,
  `ApprovalCode` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Route` varchar(100) NOT NULL,
  `Initiator` varchar(100) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `rework` varchar(50) NOT NULL,
  `InitDate` datetime NOT NULL,
  `LastDate` datetime NOT NULL,
  `Status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`id`, `Requestid`, `ApprovalCode`, `Role`, `Route`, `Initiator`, `supervisor`, `rework`, `InitDate`, `LastDate`, `Status`) VALUES
(1, 'REQ20250503020642', 'REQ', 'kazeem', 'reqappval', 'ridwan', 'kazeem', '', '2025-05-03 14:07:53', '2025-05-03 14:07:53', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `approvaldev`
--

CREATE TABLE `approvaldev` (
  `id` int(11) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approvaldev`
--

INSERT INTO `approvaldev` (`id`, `Code`, `Name`, `Description`) VALUES
(1, 'REQ', 'Requisition', 'This is the approval code for requisition');

-- --------------------------------------------------------

--
-- Table structure for table `approvalhistory`
--

CREATE TABLE `approvalhistory` (
  `id` int(11) NOT NULL,
  `Requestid` varchar(100) NOT NULL,
  `ApprovalCode` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Route` varchar(100) NOT NULL,
  `Initiator` varchar(100) NOT NULL,
  `InitDate` datetime NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Comment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approvalhistory`
--

INSERT INTO `approvalhistory` (`id`, `Requestid`, `ApprovalCode`, `Role`, `Route`, `Initiator`, `InitDate`, `Status`, `Comment`) VALUES
(1, 'REQ1123', 'REQ', 'kazeem', '', 'ridwan', '2025-04-16 08:12:32', '0', 'Please approve sir'),
(2, 'REQ20250416082646', 'REQ', 'kazeem', '', 'ridwan', '2025-04-16 08:27:42', 'open', 'Please approve sir'),
(3, 'REQ20250416094409', 'REQ', 'kazeem', '', 'ridwan', '2025-04-16 09:45:27', 'open', 'Please approve sir'),
(4, 'REQ20250425094125', 'REQ', 'kazeem', '', 'ridwan', '2025-04-25 09:42:34', 'open', 'Please approve sir'),
(5, 'REQ20250429110828', 'REQ', 'kazeem', '', 'ridwan', '2025-04-29 11:09:52', 'open', 'Please approve sir'),
(6, 'REQ20250501093230', 'REQ', 'kazeem', '', 'ridwan', '2025-05-01 21:35:28', 'open', 'Please approve sir'),
(7, 'REQ20250503020642', 'REQ', 'kazeem', '', 'ridwan', '2025-05-03 14:07:53', 'open', 'Please approve sir');

-- --------------------------------------------------------

--
-- Table structure for table `aprovalsetup`
--

CREATE TABLE `aprovalsetup` (
  `id` int(11) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `OrderNum` int(10) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `CatCode` varchar(50) NOT NULL,
  `CatName` varchar(100) NOT NULL,
  `CreatedBy` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `CatCode`, `CatName`, `CreatedBy`) VALUES
(1, 'CE', 'Computer Equipment', '2025-04-02 09:43:18'),
(2, 'FF', 'Furnitures and Fittings', '2025-04-02 09:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 0,
  `UnitPrice` decimal(10,2) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Category` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ID`, `Name`, `Description`, `Quantity`, `UnitPrice`, `Code`, `Category`) VALUES
(1, 'Hard Disc Drive', 'Hard Disc Drive for laptops and desktops', 20, 15000.00, 'HDD', 'CE'),
(2, 'Laptop Computer', 'Laptop Computer for executives', 10, 200000.00, 'LP', 'CE'),
(3, 'Office Chair', 'Standard Office Chair', 20, 50000.00, 'OC', 'FF'),
(4, 'Office Table', 'Office Table for staffs', 20, 30000.00, 'OT', 'FF'),
(5, 'MOUSE', 'USB Mouse', 20, 1500.00, 'MO', 'CE');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `Route` varchar(100) NOT NULL,
  `path` varchar(500) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Id`, `Name`, `module`, `Route`, `path`, `Description`, `status`, `Date`) VALUES
(1, 'requisition', 'REQ', 'newreq', '', 'new requisition page', 'Active', '2025-05-03 17:35:09'),
(3, 'My Requisitionss', 'REQ', 'myreqsss', '', 'My Requisition pagess', 'Active', '2025-05-05 00:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `Id` int(11) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`Id`, `Code`, `Name`, `Description`, `status`, `Date`, `Icon`) VALUES
(10, 'REQ', 'Requisition', 'Requisition module', 'Active', '2025-05-03 18:34:12', 'fa fa-plus'),
(12, 'HRM', 'Human Resource Management', 'Human Resource Management module', 'Active', '2025-05-05 00:04:19', 'fa fa-plus');

-- --------------------------------------------------------

--
-- Table structure for table `requisitionitems`
--

CREATE TABLE `requisitionitems` (
  `ID` int(11) NOT NULL,
  `ReqId` varchar(100) NOT NULL,
  `InventoryID` varchar(50) NOT NULL,
  `UnitPrice` decimal(18,2) NOT NULL,
  `QuantityRequested` int(11) NOT NULL,
  `QuantityAllocated` int(11) DEFAULT 0,
  `Status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requisitionitems`
--

INSERT INTO `requisitionitems` (`ID`, `ReqId`, `InventoryID`, `UnitPrice`, `QuantityRequested`, `QuantityAllocated`, `Status`) VALUES
(1, 'REQ20250503020642', 'OT', 30000.00, 2, 0, 'pending'),
(2, 'REQ20250503020642', 'LP', 200000.00, 3, 0, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(100) NOT NULL,
  `departmentid` varchar(100) NOT NULL,
  `ReqId` varchar(100) NOT NULL,
  `Status` enum('pending','approved','rejected','allocated') DEFAULT 'pending',
  `Comment` varchar(1000) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`ID`, `UserID`, `departmentid`, `ReqId`, `Status`, `Comment`, `CreatedAt`) VALUES
(1, 'ridwan', '1', 'REQ20250503020642', 'pending', 'description of the requisition as expected', '2025-05-03 12:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `resolutions`
--

CREATE TABLE `resolutions` (
  `id` int(11) NOT NULL,
  `ticketid` varchar(50) NOT NULL,
  `resolvedby` varchar(50) NOT NULL,
  `resolution` varchar(2000) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `Name`, `code`, `Description`, `Status`, `Date`) VALUES
(2, 'AUTIDORS', 'AUDIT', 'these are the memeber of the audit team', 'Active', '2025-05-03 14:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `website` varchar(50) NOT NULL,
  `footnote` varchar(100) NOT NULL,
  `slogo` varchar(100) NOT NULL,
  `blogo` varchar(100) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `sname`, `address`, `email`, `phone`, `phone1`, `website`, `footnote`, `slogo`, `blogo`, `status`) VALUES
(2, 'ISALU HOSPITALS LIMITED', 'IHL', '349B Odusami Street, Ogba, Ikeja Lagos', 'info@isaluhospitals.com', '08022334455', '08066778899', 'isaluhospitals.com', 'Thanks For Entrusting Your Health With Us.', '4317-Mediflow1.png', '9687-Medi2.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ticketcomment`
--

CREATE TABLE `ticketcomment` (
  `id` int(11) NOT NULL,
  `ticketid` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `commentat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `RequestId` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `Description` varchar(2000) NOT NULL,
  `status` varchar(50) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `assignedto` varchar(50) NOT NULL,
  `updatedat` datetime NOT NULL,
  `resolvedat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `RequestId`, `user`, `title`, `Description`, `status`, `priority`, `createdat`, `assignedto`, `updatedat`, `resolvedat`) VALUES
(1, 'TIK20250524054935', 'ridwan', 'Issues Login into to the system', 'I have been trying to login to the system and i am getting error message that my account has been block. my name is Ajibola Isiaka', 'Open', 'Normal', '2025-05-24 16:52:09', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `reqid` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='uploads (reqid, title, name, description)';

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `reqid`, `title`, `name`, `description`) VALUES
(1, 'REQ20250503020642', 'simple title', '1746274047_file-sample_150kB.pdf', 'file description'),
(4, 'TIK20250521074942', 'simple title', '1747806614_file-sample_150kB.pdf', 'simple description'),
(5, 'REQ20250524020339', 'ok', '1748088254_Mandate.pdf', 'ok'),
(6, 'REQ20250524030011', 'ok', '1748091623_Investment certificate.pdf', 'ok'),
(7, 'TIK20250524030648', 'ok', '1748092038_Investment certificate.pdf', 'ok'),
(8, 'TIK20250524054145', 'ok', '1748101444_sending.PNG', 'picture'),
(9, 'TIK20250524054935', 'screen preview', '1748101920_Capture.PNG', 'This is simple the screen preview of the error message');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `StaffID` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `OtherName` varchar(100) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Supervisor` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `StaffID`, `Surname`, `FirstName`, `OtherName`, `Department`, `Supervisor`, `Email`, `Role`, `Password`, `Date`, `Status`) VALUES
(1, 'ridwan', 'Alamal-yekeen', 'Ridwan', 'Olatilewa', 'ICT', 'kazeem', 'ridwan00965@gmail.com', 'Super', '202cb962ac59075b964b07152d234b70', '2025-03-23 16:06:53', 1),
(2, 'kazeem', 'Ayinde', 'Kazeem', 'Olanrewaju', 'ICT', 'sanusi', 'kazeem@isalu.com', '', '202cb962ac59075b964b07152d234b70', '2025-04-16 06:02:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `workflow`
--

CREATE TABLE `workflow` (
  `id` int(11) NOT NULL,
  `Requestid` varchar(100) NOT NULL,
  `ApprovalCode` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Route` varchar(100) NOT NULL,
  `Initiator` varchar(100) NOT NULL,
  `InitDate` datetime NOT NULL,
  `LastDate` datetime NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocations`
--
ALTER TABLE `allocations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RequisitionID` (`RequisitionID`),
  ADD KEY `InventoryID` (`InventoryID`),
  ADD KEY `AllocatedBy` (`AllocatedBy`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approvaldev`
--
ALTER TABLE `approvaldev`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Approvalcode` (`Code`);

--
-- Indexes for table `approvalhistory`
--
ALTER TABLE `approvalhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aprovalsetup`
--
ALTER TABLE `aprovalsetup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `modulecode` (`Code`);

--
-- Indexes for table `requisitionitems`
--
ALTER TABLE `requisitionitems`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `InventoryID` (`InventoryID`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `resolutions`
--
ALTER TABLE `resolutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `requestid` (`RequestId`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `StaffId` (`StaffID`);

--
-- Indexes for table `workflow`
--
ALTER TABLE `workflow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocations`
--
ALTER TABLE `allocations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approvaldev`
--
ALTER TABLE `approvaldev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approvalhistory`
--
ALTER TABLE `approvalhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `aprovalsetup`
--
ALTER TABLE `aprovalsetup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requisitionitems`
--
ALTER TABLE `requisitionitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resolutions`
--
ALTER TABLE `resolutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workflow`
--
ALTER TABLE `workflow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
