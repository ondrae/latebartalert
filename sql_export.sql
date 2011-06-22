-- phpMyAdmin SQL Dump
-- version 2.11.11.1
-- http://www.phpmyadmin.net
--
-- Host: mysql50-91.wc1:3306
-- Generation Time: Jun 22, 2011 at 12:53 AM
-- Server version: 5.0.77
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `536610_commuters`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisories`
--

CREATE TABLE IF NOT EXISTS `advisories` (
  `id` int(10) NOT NULL auto_increment,
  `station` varchar(10) NOT NULL,
  `advisory` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `advisories`
--

INSERT INTO `advisories` (`id`, `station`, `advisory`) VALUES
(1, 'BART', 'No delays reported'),
(2, '12TH', '15 minute delay due to police activity'),
(3, 'BART', 'No delays reported.'),
(4, 'BART', 'There is a 10-minute delay at Powell St. in the Pittsburg / Bay Point, Fremont and Richmond directions due to a medical emergency. '),
(8, 'BART', 'There is a 10-15 minute delay at Lafayette in the Pittsburg / Bay Point direction due to track maintenance. '),
(9, 'BART', 'There is a 10-minute delay on the Dublin/Pleasanton Line in the Dublin / Pleasanton, Daly City and San Francisco directions due to an equipment problem on the track. '),
(10, 'BART', 'There is a 10-minute delay at Dublin/Pleasanton and Castro Valley in the Dublin / Pleasanton, Daly City and San Francisco directions due to an equipment problem on the track. '),
(11, 'BART', 'There is a 10-minute delay between San Francisco stations and East Bay Stations in the East Bay direction due to an equipment problem on a train. '),
(12, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay in the Fremont, SFO and Millbrae directions due to an equipment problem on the track. '),
(13, 'BART', 'There is a 20-minute delay in the Fremont direction due to police activity. '),
(14, 'BART', 'There is a 10-minute delay at 19th St. Oakland in the Fremont and SFO directions due to police activity. '),
(15, 'BART', 'There is a 10-minute delay at Daly City in the SFO and Millbrae directions due to an equipment problem on the track. '),
(16, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at Daly City in the SFO and Millbrae directions due to an equipment problem on the track. '),
(17, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at San Francisco stations in the SFO, Millbrae and East Bay directions due to an obstruction on the track. '),
(18, 'BART', 'There is a 8-10 minute delay at South Hayward in the Fremont direction due to track maintenance. '),
(19, 'BART', 'There is a 8-10 minute delay between Rockridge and Pittsburg/Bay Point in the Pittsburg / Bay Point direction due to track maintenance. '),
(20, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay on the Pittsburg/Bay Point Line in the Pittsburg / Bay Point direction due to track maintenance. '),
(21, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at San Leandro in the Dublin / Pleasanton and Fremont directions due to an equipment problem on a train. '),
(22, 'BART', 'There is a 10-15 minute delay at South Hayward between Union City in the Fremont direction due to an equipment problem on the track. '),
(23, 'BART', 'BART is recovering from an earlier problem. There is a 10-15 minute delay at South Hayward between Union City in the Fremont direction due to an equipment problem on the track. '),
(24, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at Embarcadero in the SFO, Millbrae and Daly City directions due to a medical emergency. '),
(25, 'BART', 'There is a 20-minute delay at Orinda in the Pittsburg / Bay Point direction due to an equipment problem on a train. '),
(26, 'BART', 'There is a 15-minute delay at Balboa Park in the Pittsburg / Bay Point and Dublin / Pleasanton directions due to an equipment problem on a train. '),
(27, 'BART', 'There is a 10-minute delay at South Hayward in the Fremont direction due to track maintenance. '),
(28, 'BART', 'BART is recovering from an earlier problem. There is a 15-minute delay on the Fremont Line in the Richmond and Daly City directions due to an equipment problem on the track. '),
(29, 'BART', 'There is a major delay at West Oakland in the Pittsburg / Bay Point, Dublin / Pleasanton, Fremont, Richmond, SFO, Millbrae and Daly City directions due to an equipment problem on the track. '),
(30, 'BART', 'There is a 10-minute delay at Richmond in the Fremont, Millbrae and Daly City directions due to an equipment problem on the track. '),
(31, 'BART', 'There is a 10-minute delay on the Richmond Line in the Richmond direction due to an equipment problem on a train. '),
(32, 'BART', 'There is a 10-minute delay between Rockridge and Pittsburg/Bay Point in the Pittsburg / Bay Point direction due to police activity. '),
(33, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay between West Oakland and East Bay Stations in the East Bay direction. '),
(34, 'BART', 'There is a 10-15 minute delay at 24th St. Mission in the East Bay direction due to an equipment problem on the track. '),
(35, 'BART', 'There is a 15-minute delay at West Oakland in the SFO, Millbrae and Daly City directions due to an equipment problem on a train. '),
(36, 'BART', 'BART is recovering from an earlier problem. There is a 15-minute delay at West Oakland in the SFO, Millbrae and Daly City directions due to an equipment problem on a train. '),
(37, 'BART', 'There is a 15-25 minute delay on the Daly City Line in the SFO, Millbrae and Daly City directions due to an equipment problem on a train. '),
(38, 'BART', 'There is a major delay on the Daly City Line in the SFO, Millbrae and Daly City directions due to an equipment problem on a train. '),
(39, 'BART', 'We have no train service at Concord, North Concord or Bay Point at this time due to a train derailment. Any passengers from those closed stations should go to Pleasant Hill Station for service to San Francsico. '),
(40, 'BART', 'There is a major delay on the Daly City Line in the SFO, Millbrae, Daly City and East Bay directions due to an equipment problem on the track. '),
(41, 'BART', 'There is a 15-minute delay between Downtown Berkeley and Millbrae in the Millbrae direction due to an equipment problem on a train. '),
(42, 'BART', 'There is a 10-minute delay on the Daly City Line in the SFO, Millbrae and Daly City directions due to an equipment problem on the track. '),
(43, 'BART', 'There is a 10-minute delay on the Daly City Line in the SFO, Millbrae and Daly City directions due to an equipment problem on a train. '),
(44, 'BART', 'BART is recovering from an earlier problem. There is a 10-15 minute delay on the Daly City Line in the SFO, Millbrae and Daly City directions due to an equipment problem on a train. '),
(45, 'BART', 'There is a 10-minute delay at Bay Fair in the Dublin / Pleasanton, Fremont, Richmond and Daly City directions due to a medical emergency. '),
(46, 'BART', 'There is a major delay on the Richmond Line in the Fremont direction due to an equipment problem on the track. '),
(47, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at Embarcadero in the SFO, Millbrae, Daly City and East Bay directions due to police activity. '),
(48, 'BART', 'There is a major delay at Daly City in the SFO, Millbrae and East Bay directions due to an equipment problem on the track. '),
(49, 'BART', 'There is a 15-minute delay at Daly City in the SFO, Millbrae and East Bay directions due to track maintenance. '),
(50, 'BART', 'There is a 10-minute delay system wide due to an earthquake. '),
(51, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay system wide due to an earthquake. '),
(52, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at West Oakland in the SFO, Millbrae, Daly City and San Francisco directions due to police activity. '),
(53, 'BART', 'There is a 10-minute delay between Rockridge and Pittsburg/Bay Point in the Pittsburg / Bay Point direction due to track maintenance. '),
(54, 'BART', 'There is a 15-minute delay on the Fremont Line in the Daly City direction due to an equipment problem on a train. '),
(55, 'BART', 'BART is recovering from an earlier problem. There is a 10-15 minute delay at 24th St. Mission in the SFO, Millbrae and East Bay directions due to an equipment problem on the track. '),
(56, 'BART', 'There is a 10-15 minute delay on the Daly City Line in the East Bay direction due to an equipment problem on a train. '),
(57, 'BART', 'There is a 10-minute delay at MacArthur in the Fremont and SFO directions due to an equipment problem on the track. '),
(58, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay system wide due to a technical problem. '),
(59, 'BART', 'There is a 10-minute delay in the SFO and Millbrae directions due to an equipment problem on the track. '),
(60, 'BART', 'There is a 10-minute delay at Daly City in the SFO and Millbrae directions due to an equipment problem on the track. '),
(61, 'BART', 'BART is recovering from an earlier problem. There is a 15-minute delay on the Dublin/Pleasanton Line AND on the Pittsburg/Bay Point Line in the Pittsburg / Bay Point and Dublin / Pleasanton directions due to police activity. '),
(62, 'BART', 'There is a major delay at West Oakland in the San Francisco and East Bay directions due to an equipment problem on a train. '),
(63, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at 24th St. Mission in the SFO, Millbrae and Daly City directions due to an equipment problem on a train. '),
(64, 'BART', 'There is a 10-minute delay on the Daly City Line in the East Bay direction due to an equipment problem on a train. '),
(65, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay on the Daly City Line in the SFO, Millbrae and East Bay directions due to an equipment problem on a train. '),
(66, 'BART', 'There is a major delay between Millbrae and Pittsburg/Bay Point in the Pittsburg / Bay Point direction due to an obstruction on the track. '),
(67, 'BART', 'There is a 15-minute delay at Embarcadero in the SFO and Millbrae directions due to a medical emergency. '),
(68, 'BART', 'There is a 15-minute delay at Rockridge in the SFO and San Francisco directions due to a medical emergency. '),
(69, 'BART', 'BART is recovering from an earlier problem. There is a 10-minute delay at Downtown Berkeley on the Richmond Line in the Fremont, Richmond and Daly City directions due to an equipment problem at the station. '),
(70, 'BART', 'There is a 10-minute delay at South Hayward in the Fremont direction due to track maintenance. ');

-- --------------------------------------------------------

--
-- Table structure for table `formAnswers`
--

CREATE TABLE IF NOT EXISTS `formAnswers` (
  `startStation` varchar(20) NOT NULL,
  `time` varchar(10) NOT NULL,
  `endStation` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formAnswers`
--

INSERT INTO `formAnswers` (`startStation`, `time`, `endStation`, `phone`) VALUES
('Powell St.', '8:45AM', '24th St. Mission', '4153074175'),
('Montgomery St.', '7:30AM', 'North Berkeley', '510-529-1647'),
('19th St. Oakland', '3:30PM', 'Civic Center/UN Plaz', '5102194571'),
('Montgomery St.', '8:15AM', '16th St. Mission', '617-435-3775'),
('Montgomery St.', '8:00AM', '12th St. Oakland Cit', '415 565-9853'),
('12th St. Oakland Cit', '4:00PM', 'Montgomery St.', '415 565-9853'),
('Civic Center/UN Plaz', '5:00PM', 'Lake Merritt', '5102070096'),
('Montgomery St.', '6:30AM', 'Walnut Creek', '9253254253');

-- --------------------------------------------------------

--
-- Table structure for table `routeInfo`
--

CREATE TABLE IF NOT EXISTS `routeInfo` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `number` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `stations` varchar(10000) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `routeInfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `routeStations`
--

CREATE TABLE IF NOT EXISTS `routeStations` (
  `id` tinyint(100) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `abbr` varchar(20) NOT NULL,
  `number` varchar(100) NOT NULL,
  `color` varchar(10) NOT NULL,
  `stations` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `routeStations`
--

INSERT INTO `routeStations` (`id`, `name`, `abbr`, `number`, `color`, `stations`) VALUES
(0, 'Pittsburg/Bay Point - SFIA/Millbrae', 'PITT-SFIA', '1', '#ffff33', 'PITTNCONCONCPHILWCRKLAFYORINROCKMCAR19TH12THWOAKEMBRMONTPOWLCIVC16TH24THGLENBALBDALYCOLMSSANSBRNSFIAMLB'),
(1, 'Millbrae/SFIA - Pittsburg/Bay Point', 'SFIA-PITT', '2', '#ffff33', 'MLBRSFIASBRNSSANCOLMDALYBALBGLEN24TH16THCIVCPOWLMONTEMBRWOAK12TH19THMCARROCKORINLAFYWCRKPHILCONCNCONP'),
(2, 'Fremont - Richmond', 'FRMT-RICH', '3', '#ff9933', 'FRMTUCTYSHAYHAYWBAYFSANLCOLSFTVLLAKE12TH19THMCARASHBDBRKNBRKPLZADELNRICH'),
(3, 'Richmond - Fremont', 'RICH-FRMT', '4', '#ff9933', 'RICHDELNPLZANBRKDBRKASHBMCAR19TH12THLAKEFTVLCOLSSANLBAYFHAYWSHAYUCTYFRMT'),
(4, 'Fremont - Daly City', 'FRMT-DALY', '5', '#339933', 'FRMTUCTYSHAYHAYWBAYFSANLCOLSFTVLLAKEWOAKEMBRMONTPOWLCIVC16TH24THGLENBALBDALY'),
(5, 'Daly City - Fremont', 'DALY-FRMT', '6', '#339933', 'DALYBALBGLEN24TH16THCIVCPOWLMONTEMBRWOAKLAKEFTVLCOLSSANLBAYFHAYWSHAYUCTYFRMT'),
(6, 'Richmond - Daly City/Millbrae', 'RICH-MLBR', '7', '#ff0000', 'RICHDELNPLZANBRKDBRKASHBMCAR19TH12THWOAKEMBRMONTPOWLCIVC16TH24THGLENBALBDALYCOLMSSANSBRNMLBR'),
(7, 'Millbrae/Daly City - Richmond', 'MLBR-RICH', '8', '#ff0000', 'MLBRSBRNSSANCOLMDALYBALBGLEN24TH16THCIVCPOWLMONTEMBRWOAK12TH19THMCARASHBDBRKNBRKPLZADELNRICH'),
(8, 'Dublin/Pleasanton - Daly City', 'DUBL-DALY', '11', '#0099cc', 'DUBLWDUBCASTBAYFSANLCOLSFTVLLAKEWOAKEMBRMONTPOWLCIVC16TH24THGLENBALBDALY'),
(9, 'Daly City - Dublin/Pleasanton', 'DALY-DUBL', '12', '#0099cc', 'DALYBALBGLEN24TH16THCIVCPOWLMONTEMBRWOAKLAKEFTVLCOLSSANLBAYFCASTWDUBDUBL');
