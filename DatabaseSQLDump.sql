-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: campaigns
-- ------------------------------------------------------
-- Server version	5.5.59-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `campaigns`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `campaigns` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `campaigns`;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `CampaignName` varchar(100) DEFAULT NULL,
  `Markup` varchar(10000) DEFAULT NULL,
  `Variable1Name` varchar(1000) DEFAULT NULL,
  `Variable2Name` varchar(1000) DEFAULT NULL,
  `Variable3Name` varchar(1000) DEFAULT NULL,
  `Variable4Name` varchar(1000) DEFAULT NULL,
  `Variable5Name` varchar(1000) DEFAULT NULL,
  `Variable6Name` varchar(1000) DEFAULT NULL,
  `Variable7Name` varchar(1000) DEFAULT NULL,
  `Variable8Name` varchar(1000) DEFAULT NULL,
  `Variable9Name` varchar(1000) DEFAULT NULL,
  `Variable10Name` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `emailalerts`
--

DROP TABLE IF EXISTS `emailalerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailalerts` (
  `DateTime` datetime DEFAULT NULL,
  `Target` varchar(1000) DEFAULT NULL,
  `Campaign` varchar(1000) DEFAULT NULL,
  `IP` varchar(100) DEFAULT NULL,
  `UserAgent` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'campaigns'
--

--
-- Dumping routines for database 'campaigns'
--
/*!50003 DROP PROCEDURE IF EXISTS `CreateModifyCampaign` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateModifyCampaign`(IN INCampaignName VARCHAR(1000), IN INMarkup VARCHAR(10000), IN INVariable1Name VARCHAR(1000), IN INVariable2Name VARCHAR(1000), IN INVariable3Name VARCHAR(1000), IN INVariable4Name VARCHAR(1000), IN INVariable5Name VARCHAR(1000), IN INVariable6Name VARCHAR(1000), IN INVariable7Name VARCHAR(1000), IN INVariable8Name VARCHAR(1000), IN INVariable9Name VARCHAR(1000), IN INVariable10Name VARCHAR(1000))
BEGIN

-- CREATE OR UPDATE EXISTING EMAIL CAMPAIGN
IF EXISTS (select 1 from content where CampaignName = INCampaignName) THEN
    UPDATE content
    SET Markup = InMarkup,
    Variable1Name = INVariable1Name,
    Variable2Name = INVariable2Name,
    Variable3Name = INVariable3Name,
    Variable4Name = INVariable4Name,
    Variable5Name = INVariable5Name,
    Variable6Name = INVariable6Name,
    Variable7Name = INVariable7Name,
    Variable8Name = INVariable8Name,
    Variable9Name = INVariable9Name,
    Variable10Name = INVariable10Name 
    WHERE CampaignName = INCampaignName;
  ELSE 
    INSERT INTO content(CampaignName, Markup, Variable1Name, Variable2Name, Variable3Name, Variable4Name, Variable5Name, Variable6Name, Variable7Name, Variable8Name, Variable9Name, Variable10Name) 
	VALUES(INCampaignName, INMarkup, INVariable1Name, INVariable2Name, INVariable3Name, INVariable4Name, INVariable5Name, INVariable6Name, INVariable7Name, INVariable8Name, INVariable9Name, INVariable10Name);

  END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DeleteCampaign` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteCampaign`(IN INCampaignName VARCHAR(1000))
BEGIN

delete from content WHERE CampaignName = INCampaignName;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetRecord` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetRecord`(IN INIP VARCHAR(1000))
BEGIN

SELECT * from emailalerts WHERE IP = INIP;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `InsertRequest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRequest`(IN INTarget VARCHAR(1000), IN INCampaign VARCHAR(1000), IN INIP VARCHAR(100), IN INUserAgent VARCHAR(1000))
BEGIN

INSERT INTO emailalerts(DateTime, Target, Campaign, IP, UserAgent)
VALUES (now(), INTarget, INCampaign, INIP, INUserAgent);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SelectCampaign` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectCampaign`(IN INCampaignName VARCHAR(1000))
BEGIN

SELECT * from content WHERE CampaignName = INCampaignName;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Current Database: `phishingdocs`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `phishingdocs` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `phishingdocs`;

--
-- Table structure for table `Notifications`
--

DROP TABLE IF EXISTS `Notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notifications` (
  `Type` varchar(100) DEFAULT NULL,
  `API_Token` varchar(1000) DEFAULT NULL,
  `Channel` varchar(1000) DEFAULT NULL,
  `UUID` varchar(1000) DEFAULT NULL,
  `Datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `Datetime` datetime DEFAULT NULL,
  `IP` varchar(100) DEFAULT NULL,
  `Target` varchar(100) DEFAULT NULL,
  `Org` varchar(100) DEFAULT NULL,
  `NTLMv2` varchar(1000) DEFAULT NULL,
  `UA` varchar(1000) DEFAULT NULL,
  `UUID` varchar(1000) NOT NULL,
  `User` varchar(100) DEFAULT NULL,
  `Pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'phishingdocs'
--

--
-- Dumping routines for database 'phishingdocs'
--
/*!50003 DROP PROCEDURE IF EXISTS `CheckRecentlySubmitted` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckRecentlySubmitted`(IN InIP VARCHAR(100), IN InTarget VARCHAR(100), IN InOrg VARCHAR(100))
BEGIN

-- LOOK BACK RECENTLY TO AVOID DUPLICATE RECORDS
SELECT 
    *
FROM
    requests
WHERE
    IP = InIP AND Target = InTarget
        AND Org = InOrg
        AND Datetime >= NOW() - INTERVAL 8 SECOND;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CreateNotificationRef` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateNotificationRef`(IN InType VARCHAR(100), IN InAPI_Token VARCHAR(1000), IN InChannel VARCHAR(100))
BEGIN

-- CREATE A UNIQUE IDENTIFIER FOR NOTIFICATION SETTINGS WHEN A DOCUMENT IS CREATED
SET @UUID = UUID();

INSERT INTO Notifications (Type, API_Token, Channel, UUID, Datetime) VALUES (InType, InAPI_Token, InChannel, @UUID, now());
SELECT @UUID AS UUID;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetNotificationRef` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetNotificationRef`(IN InUUID VARCHAR(1000))
BEGIN

-- RETRIEVE NOTIFICATION SETTINGS FROM A UNIQUE ID IN THE URL "ID" PARAMETER
SELECT 
    *
FROM
    Notifications
WHERE
    UUID = InUUID
ORDER BY Datetime DESC;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetUUIDRecord` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUUIDRecord`(IN InUUID VARCHAR(1000))
BEGIN

-- RETRIEVE ALL PHISH RECORDS ASSOCIATED WITH A DOCUMENT
SELECT 
    *
FROM
    requests
WHERE
    UUID = InUUID;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `InsertRequests` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRequests`(IN InIP VARCHAR(100), IN InTarget VARCHAR(100), IN InOrg VARCHAR(100), IN InUA VARCHAR(1000), IN InUUID VARCHAR(1000), IN InUser VARCHAR(100), IN InPass VARCHAR(100))
BEGIN

-- INSERT CAPTURED INFORMATION FROM AN OPENED DOCUMENT INTO THE "requests" TABLE
INSERT INTO requests (Datetime, IP, Target, Org, UA, UUID, User, Pass) VALUES (now(), InIP,InTarget,InOrg,InUA,InUUID,InUser,InPass);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MatchHashes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `MatchHashes`(IN InIP VARCHAR(100), IN InHash VARCHAR(1000))
BEGIN

-- IF A HASH IS CAPTURED, COMPARE THE IP ADDRESS TO AN ACTIVE CAMPAIGN (fakesite or phishingdocs) AND UPDATE THE "requests" TABLE
UPDATE requests 
SET 
    NTLMv2 = CONCAT(NTLMv2, '<br>', InHash)
WHERE
    IP = InIP;
    
UPDATE fakesite.stolencreds sc 
SET 
    sc.Hash = CONCAT(sc.Hash, '<br>', InHash)
WHERE
    sc.ip = InIP;

SELECT DISTINCT
    'PhishingDocs' AS Title,
    rq.Target,
    rq.Org,
    nt.API_Token,
    nt.Channel,
    rq.UUID
FROM
    requests rq
        INNER JOIN
    Notifications nt ON nt.UUID = rq.UUID
WHERE
    rq.IP = InIP 
UNION SELECT 
    'FakeSite' AS Title,
    sc.location AS Target,
    '' AS Org,
    '' AS API_Token,
    '' AS Channel,
    '' AS UUID
FROM
    fakesite.stolencreds sc
WHERE
    sc.ip = InIP
LIMIT 1;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Current Database: `fakesite`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `fakesite` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fakesite`;

--
-- Table structure for table `stolencreds`
--

DROP TABLE IF EXISTS `stolencreds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stolencreds` (
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `Token` varchar(1000) DEFAULT NULL,
  `Hash` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'fakesite'
--

--
-- Dumping routines for database 'fakesite'
--
/*!50003 DROP PROCEDURE IF EXISTS `CheckProjects` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckProjects`()
BEGIN

-- RETURNS PROJECT LIST
SELECT DISTINCT
    location
FROM
    stolencreds
WHERE
    location != '';
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetAwards` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAwards`(IN InProject VARCHAR(1000), IN InUser VARCHAR(1000))
BEGIN

-- MOST DEDICATED
SELECT 
    'MostDedicated' AS Title, username
FROM
    (SELECT 
        username, COUNT(password) AS count
    FROM
        stolencreds sc
    WHERE
        sc.location = InProject
            AND sc.username = InUser
    GROUP BY username) sc
WHERE
    count = 2 
-- MOST DELAYED
UNION SELECT 
    'MostDelayed' AS Title, username
FROM
    (SELECT 
        DATE_FORMAT(MAX(entered), '%Y-%m-%d') AS LastDate, username
    FROM
        stolencreds
    WHERE
        location = InProject) iq
WHERE
    DATEDIFF(DATE_FORMAT(NOW(), '%Y-%m-%d'), LastDate) >= 2
-- MOST DISCLOSED PASSWORDS
UNION SELECT 
    'MostDisclosedPWs' AS Title, username
FROM
    (SELECT 
        username, COUNT(DISTINCT password) AS countpass
    FROM
        stolencreds
    WHERE
        location = InProject
            AND username = InUser
    GROUP BY username , password) iq
WHERE
    countpass = 2 
-- MOST PHISH
UNION SELECT 
    'MostPhish' AS Title, iq.countrows AS username
FROM
    (SELECT 
        COUNT(*) AS countrows
    FROM
        stolencreds
    WHERE
        location = InProject) iq
WHERE
    iq.countrows IN (50 , 60, 70, 80);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetRecords` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetRecords`(IN InProject VARCHAR(1000))
BEGIN

-- SELECT ALL RECORDS FOR THE SELECTED PROJECT
SELECT 
    *
FROM
    stolencreds
WHERE
    location = InProject;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `InsertStolenCreds` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertStolenCreds`(IN InUser VARCHAR(1000), IN InPass VARCHAR(1000), InIP VARCHAR(100), InLocation VARCHAR(1000), InToken VARCHAR(1000))
BEGIN

-- INSERT CAPTURED INFORMATION INTO stolencreds TABLE
INSERT INTO stolencreds(username,password,entered,ip,location,token) VALUES(InUser,InPass,NOW(),InIP,InLocation,InToken);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RemoveProject` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `RemoveProject`(IN InProject VARCHAR(1000))
BEGIN

-- DELETE ALL RECORDS FOR THE SELECTED PROJECT
DELETE FROM stolencreds 
WHERE
    location = InProject;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RemoveRecord` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `RemoveRecord`(IN InProject VARCHAR(1000), IN InEntered TIMESTAMP)
BEGIN

-- DELETE SPECIFIC RECORD FOR SELECTED PROJECT
DELETE FROM stolencreds 
WHERE
    location = InProject
    AND entered = InEntered;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-08 14:49:17
