-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2017 at 04:55 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro_realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'jeybin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `displayimage` text NOT NULL,
  `contactnumber` text NOT NULL,
  `address` text NOT NULL,
  `location` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `pin` text NOT NULL,
  `license_no` text NOT NULL,
  `latitude` text NOT NULL,
  `longitde` text NOT NULL,
  `email_verification` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `email`, `password`, `displayimage`, `contactnumber`, `address`, `location`, `city`, `state`, `country`, `pin`, `license_no`, `latitude`, `longitde`, `email_verification`, `status`) VALUES
(1, 'Laith Pena', 'dequlesuzi@gmail.com', '123', './images/agent/profileimage/58cd56c3d71379.95878186.jpg', '9961599207', 'Iste ducimus, aut amet, aliquip veniam, ea tempora reprehenderit, quo voluptas unde consectetur rem proident, qui rerum non.', 'Ahmedabad, Gujarat, India', 'Ahmedabad', ' Gujarat', ' India', 'Commodo minus accusantium vero atque consectetur fuga Ullam sint modi Nam rerum', '1', '23.022505', '72.57136209999999', 'verified', 'approved'),
(2, 'Dai Larson', 'wapihedu@gmail.com', '0000', './images/agent/profileimage/58cd5742cbca47.89541093.png', '9961599207', 'Aut dolorem rerum id, lorem aspernatur voluptas sint quas incidunt, aut velit commodo magna laboris.', 'Ashok Nagar, Chennai, Tamil Nadu, India', ' Chennai', ' Tamil Nadu', ' India', 'Aut sit cumque odit sed minus dolore', '48512', '13.0373769', '80.21228210000004', 'verified', 'approved'),
(3, 'Uriel Alexander', 'gapete@hotmail.com', '0000', './images/agent/profileimage/58d04020f2dfe0.34362937.jpg', '9961599207', 'Dolorem magni dolores laboris minim quas aut maiores vitae quas odit veritatis ducimus.', 'Agra, Uttar Pradesh, India', 'Agra', ' Uttar Pradesh', ' India', '680375', '123', '27.1766701', '78.00807450000002', 'verified', 'pending'),
(4, 'Abel Gilmore', 'zetazome@gmail.com', '0000', './images/agent/profileimage/58d040ca1b1923.17840163.jpg', '9961599207', 'Maiores ad aute alias ad fugiat et eius temporibus dolor aut sit est libero officia qui nobis ut possimus.', 'Andheri East, Mumbai, Maharashtra, India', ' Mumbai', ' Maharashtra', ' India', '78546321', '89654321', '19.1154908', '72.87269519999995', 'verified', 'pending'),
(6, 'Rooney Farley', 'asd@asf.com', '000', './images/agent/profileimage/58d3fd7b810862.90534256.png', 'Sit officia praesentium eligendi quis amet voluptate impedit consequuntur non eiusmod illum qui non consectetur nihil accusamus magni', 'Voluptatem. Eiusmod consequatur, quisquam eiusmod et earum tempor sunt officia Nam.', 'Andheri East, Mumbai, Maharashtra, India', ' Mumbai', ' Maharashtra', ' India', 'Minim unde ut placeat rerum ullam quam ea repellendus', '132', '19.1154908', '72.87269519999995', 'verified', 'pending'),
(5, 'Shay Hawkins', 'cobymo@yahoo.com', '0000', './images/agent/profileimage/58d0419ef1f182.51108053.png', '845210', 'Adipisci officiis aliquip magni qui beatae voluptatem deserunt numquam iste error aliquip quasi aut voluptatum assumenda officiis aliquip non impedit.', 'Andheri East, Mumbai, Maharashtra, India', ' Mumbai', ' Maharashtra', ' India', '4521', '000', '19.1154908', '72.87269519999995', 'verified', 'pending'),
(7, 'Rooney Farley', 'asd@asf.com', '0c2a54', './images/agent/profileimage/58d3fd7c3c3050.78996773.png', '45120', 'Voluptatem. Eiusmod consequatur, quisquam eiusmod et earum tempor sunt officia Nam.', 'Andheri East, Mumbai, Maharashtra, India', ' Mumbai', ' Maharashtra', ' India', 'Minim unde ut placeat rerum ullam quam ea repellendus', '132', '19.1154908', '72.87269519999995', 'not verified', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

DROP TABLE IF EXISTS `auctions`;
CREATE TABLE IF NOT EXISTS `auctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` text NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id`, `property_id`, `start_date`, `end_date`) VALUES
(7, '9', '05-Mar-2017', '05-Apr-2017'),
(9, '11', '23-Mar-2017', '22-Apr-2017'),
(10, '13', '23-Mar-2017', '22-Apr-2017'),
(11, '17', '30-Mar-2017', '29-Apr-2017'),
(12, '12', '28-Mar-2017', '27-Apr-2017'),
(13, '19', '28-Mar-2017', '27-Apr-2017'),
(14, '20', '27-Mar-2017', '26-Apr-2017'),
(15, '22', '25-Mar-2017', '24-Apr-2017');

-- --------------------------------------------------------

--
-- Table structure for table `auctions_qouted`
--

DROP TABLE IF EXISTS `auctions_qouted`;
CREATE TABLE IF NOT EXISTS `auctions_qouted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auctionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `usertype` text NOT NULL,
  `quoteddate` text NOT NULL,
  `quoted_price` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctions_qouted`
--

INSERT INTO `auctions_qouted` (`id`, `auctionid`, `userid`, `usertype`, `quoteddate`, `quoted_price`) VALUES
(1, 7, 1, 'agents', '21-03-2017', '500'),
(2, 8, 1, 'agents', '23-03-2017', '341'),
(3, 8, 2, 'agents', '23-03-2017', '500'),
(4, 9, 2, 'agents', '23-03-2017', '1000'),
(5, 10, 2, 'agents', '23-03-2017', '100'),
(6, 8, 3, 'agents', '23-03-2017', '350'),
(7, 9, 3, 'agents', '23-03-2017', '650'),
(8, 10, 3, 'agents', '23-03-2017', '250'),
(9, 8, 4, 'agents', '23-03-2017', '400'),
(10, 9, 4, 'agents', '23-03-2017', '650'),
(11, 10, 4, 'agents', '23-03-2017', '341'),
(12, 8, 5, 'agents', '23-03-2017', '332'),
(13, 9, 5, 'agents', '23-03-2017', '778'),
(14, 10, 5, 'agents', '23-03-2017', '341');

-- --------------------------------------------------------

--
-- Table structure for table `credai`
--

DROP TABLE IF EXISTS `credai`;
CREATE TABLE IF NOT EXISTS `credai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agentid` int(11) NOT NULL,
  `credaiproof` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credai`
--

INSERT INTO `credai` (`id`, `agentid`, `credaiproof`) VALUES
(1, 3, './images/agent/credaiproof/58d04020f35a57.38954816.jpg'),
(2, 4, './images/agent/credaiproof/58d040ca1b7a79.43659091.png'),
(3, 5, './images/agent/credaiproof/58d0419ef24f08.46369266.jpg'),
(4, 6, './images/agent/credaiproof/58d3fd7b819d39.43555283.png'),
(5, 7, './images/agent/credaiproof/58d3fd7c3c8c57.95336992.png');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE IF NOT EXISTS `favourites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` text NOT NULL,
  `logintype` text NOT NULL,
  `propertyid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `userid`, `logintype`, `propertyid`) VALUES
(19, '1', 'agents', '10'),
(20, '1', 'agents', '9');

-- --------------------------------------------------------

--
-- Table structure for table `interested`
--

DROP TABLE IF EXISTS `interested`;
CREATE TABLE IF NOT EXISTS `interested` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` text NOT NULL,
  `logintype` text NOT NULL,
  `propertyid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interested`
--

INSERT INTO `interested` (`id`, `userid`, `logintype`, `propertyid`) VALUES
(1, '1', 'agents', 10),
(2, '1', 'agents', 11),
(3, '1', 'agents', 13),
(4, '2', 'agents', 21),
(5, '1', 'agents', 18),
(6, '1', 'agents', 21),
(7, '1', 'users', 18);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` text NOT NULL,
  `title` text NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `property_type` int(11) NOT NULL,
  `price` text NOT NULL,
  `latitude` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `posteddate` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `userid`, `title`, `address`, `description`, `property_type`, `price`, `latitude`, `location`, `longitude`, `posteddate`, `status`) VALUES
(9, 'admin', 'Test', 'Debitis aut quaerat in tempore, eligendi quo laudantium, dolorum adipisci ipsum, at quo numquam facere incidunt, quod cum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', 5, '316', '19.1154908', 'Andheri East, Mumbai, Maharashtra, India', '72.87269519999995', '2017-03-20', 'approved'),
(10, '1', 'asdas', 'Vero omnis aperiam sed aut dolor aut velit, iste sint lorem earum elit, omnis doloremque ad ab.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', 8, '331', '21.3537332', 'Adsena, Chhattisgarh 493225, India', '81.82790109999996', '2017-03-20', 'approved'),
(11, 'admin', 'asfadfas', 'Est, quis omnis eaque aut nostrud consequatur quo sequi velit consequatur? Eaque sit.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', 6, '777', '19.1154908', 'Andheri East, Mumbai, Maharashtra, India', '72.87269519999995', '2017-03-20', 'approved'),
(13, '1', 'Do et enim esse do culpa neque natus magnam tempor sed', 'Distinctio. Voluptas fuga. Eu et reiciendis laborum. Non voluptas doloremque sint anim consequatur? Ea.', 'Aliqua. Deleniti est quo nostrud quas fugit, accusantium qui ut sed consequat. Assumenda illum, omnis anim anim laborum.', 8, '340', '19.1154908', 'Andheri East, Mumbai, Maharashtra, India', '72.87269519999995', '2017-03-21', 'approved'),
(16, '1', 'Ullamco pariatur Autem fugit est nostrud molestiae sunt pariatur Vitae excepturi omnis asperiores sint laboriosam deserunt nisi deleniti voluptatum sunt', 'Aliqua. Accusamus est sed fuga. Voluptates nisi cumque ea quaerat adipisicing et qui harum ullamco quaerat molestiae voluptas.', 'Laboriosam, eiusmod provident, nulla excepteur veniam, eos corporis exercitationem necessitatibus excepturi inventore deleniti beatae nulla officia consequatur, voluptatem, id.', 6, '982', '19.1154908', 'Andheri East, Mumbai, Maharashtra, India', '72.87269519999995', '2017-03-23', 'approved'),
(17, 'admin', 'Thrissur1', 'Lorem ipsum dolor sit amet, co', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a purus eu sapien venenatis scelerisque non id est. Aliquam id egestas augue. Nullam id ante pretium, tincidunt erat a, molestie quam. Suspendisse iaculis, ligula in lacinia consequat, justo velit vestibulum velit, faucibus suscipit erat eros id ex. Ut elementum et est sed pulvinar. Nulla gravida sapien ut elit vehicula fringilla. Etiam metus enim, volutpat sit amet ante quis, vulputate dignissim est. Aenean velit velit, auctor sit amet est non, efficitur faucibus eros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 7, '3500000', '10.5276416', 'Thrissur, Kerala, India', '76.21443490000001', '2017-03-23', 'approved'),
(18, 'admin', 'Thrissur2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a pur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a purus eu sapien venenatis scelerisque non id est. Aliquam id egestas augue. Nullam id ante pretium, tincidunt erat a, molestie quam. Suspendisse iaculis, ligula in lacinia consequat, justo velit vestibulum velit, faucibus suscipit erat eros id ex. Ut elementum et est sed pulvinar. Nulla gravida sapien ut elit vehicula fringilla. Etiam metus enim, volutpat sit amet ante quis, vulputate dignissim est. Aenean velit velit, auctor sit amet est non, efficitur faucibus eros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 7, '50000', '10.3710814', 'Kodakara, Kerala, India', '76.30872820000002', '2017-03-23', 'approved'),
(19, 'admin', 'kerala1', 'lis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a purus eu sapien venenatis scelerisque non id est. Aliquam id egestas augue. Nullam id ante pretium, tincidunt erat a, molestie quam. Suspendisse iaculis, ligula in lacinia consequat, justo velit vestibulum velit, faucibus suscipit erat eros id ex. Ut elementum et est sed pulvinar. Nulla gravida sapien ut elit vehicula fringilla. Etiam metus enim, volutpat sit amet ante quis, vulputate dignissim est. Aenean velit velit, auctor sit amet est non, efficitur faucibus eros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 8, '4500000', '10.3080272', 'Chalakudy, Kerala, India', '76.3336779', '2017-03-23', 'approved'),
(20, 'admin', 'kerala2', '. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. P', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a purus eu sapien venenatis scelerisque non id est. Aliquam id egestas augue. Nullam id ante pretium, tincidunt erat a, molestie quam. Suspendisse iaculis, ligula in lacinia consequat, justo velit vestibulum velit, faucibus suscipit erat eros id ex. Ut elementum et est sed pulvinar. Nulla gravida sapien ut elit vehicula fringilla. Etiam metus enim, volutpat sit amet ante quis, vulputate dignissim est. Aenean velit velit, auctor sit amet est non, efficitur faucibus eros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 8, '6000000', '10.3446664', 'Irinjalakuda, Kerala, India', '76.20937149999997', '2017-03-23', 'approved'),
(21, 'admin', 'mala1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a purus eu sapien venenatis scelerisque non id est. Aliquam id egestas augue. Nullam id ante pretium, tincidunt erat a, molestie quam. Suspendisse iaculis, ligula in lacinia consequat, justo velit vestibulum velit, faucibus suscipit erat eros id ex. Ut elementum et est sed pulvinar. Nulla gravida sapien ut elit vehicula fringilla. Etiam metus enim, volutpat sit amet ante quis, vulputate dignissim est. Aenean velit velit, auctor sit amet est non, efficitur faucibus eros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a purus eu sapien venenatis scelerisque non id est. Aliquam id egestas augue. Nullam id ante pretium, tincidunt erat a, molestie quam. Suspendisse iaculis, ligula in lacinia consequat, justo velit vestibulum velit, faucibus suscipit erat eros id ex. Ut elementum et est sed pulvinar. Nulla gravida sapien ut elit vehicula fringilla. Etiam metus enim, volutpat sit amet ante quis, vulputate dignissim est. Aenean velit velit, auctor sit amet est non, efficitur faucibus eros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 6, '380000', '10.2244299', 'Kodungallur, Kerala, India', '76.19777369999997', '2017-03-23', 'approved'),
(22, 'admin', 'mala2', 'Lorem ipsum dolor sit ameros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a purus eu sapien venenatis scelerisque non id est. Aliquam id egestas augue. Nullam id ante pretium, tincidunt erat a, molestie quam. Suspendisse iaculis, ligula in lacinia consequat, justo velit vestibulum velit, faucibus suscipit erat eros id ex. Ut elementum et est sed pulvinar. Nulla gravida sapien ut elit vehicula fringilla. Etiam metus enim, volutpat sit amet ante quis, vulputate dignissim est. Aenean velit velit, auctor sit amet est non, efficitur faucibus eros. Nullam at placerat ex. Etiam quis diam ut tellus venenatis porta. Sed euismod, diam volutpat rhoncus rutrum, justo est dapibus neque, ac convallis lacus enim non mi. Praesent eros nunc, ultrices eget metus vitae, faucibus imperdiet sapien. Nam ullamcorper porttitor hendrerit.', 8, '4400000', '10.5952496', 'Guruvayur, Kerala, India', '76.03625790000001', '2017-03-23', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `propertyimages`
--

DROP TABLE IF EXISTS `propertyimages`;
CREATE TABLE IF NOT EXISTS `propertyimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `propertyimages`
--

INSERT INTO `propertyimages` (`id`, `property_id`, `image`) VALUES
(1, 8, './images/properties/58cfec901192e3.14823284.jpg'),
(2, 8, './images/properties/58cfec9011bba6.25259581.jpg'),
(3, 8, './images/properties/58cfec9011ef23.54096326.jpg'),
(4, 9, './images/properties/58cfed9a94bce8.25415873.png'),
(5, 9, './images/properties/58cfed9a94e546.89782945.jpg'),
(6, 9, './images/properties/58cfed9a950459.87798443.jpg'),
(7, 10, './images/properties/58d06159d826b4.82724075.png'),
(8, 10, './images/properties/58d06159d88057.76589044.png'),
(9, 10, './images/properties/58d06159d89f86.68974517.jpg'),
(10, 11, './images/properties/58d0628502e051.47559823.png'),
(11, 11, './images/properties/58d06285030a78.62765271.jpg'),
(12, 11, './images/properties/58d06285083d31.12017069.png'),
(13, 12, './images/properties/58d0629bb11fa0.36307962.png'),
(14, 12, './images/properties/58d0629bb18471.98270987.jpg'),
(15, 12, './images/properties/58d0629bb1a212.07712933.png'),
(16, 13, './images/properties/58d194924904a2.81704178.png'),
(17, 13, './images/properties/58d19492493152.75305993.jpg'),
(18, 13, './images/properties/58d19492494cc5.14532763.jpg'),
(27, 16, './images/properties/58d3631a765957.51509090.png'),
(26, 16, './images/properties/58d3631a763898.12003212.png'),
(25, 16, './images/properties/58d3631a761013.09644815.png'),
(28, 17, './images/properties/58d377d92438f7.93107605.jpg'),
(29, 17, './images/properties/58d377d9246441.93370019.jpg'),
(30, 17, './images/properties/58d377d9248119.73424999.jpg'),
(31, 18, './images/properties/58d37830c52c23.32880237.jpg'),
(32, 18, './images/properties/58d37830c554e9.98888341.jpg'),
(33, 18, './images/properties/58d37830c56f59.89520042.jpg'),
(34, 19, './images/properties/58d378804f0933.11718127.jpg'),
(35, 19, './images/properties/58d37880528ea2.69724372.jpg'),
(36, 19, './images/properties/58d3788052b128.87796695.jpg'),
(37, 20, './images/properties/58d378d2ccc270.47742498.jpg'),
(38, 20, './images/properties/58d378d2ccee89.47270643.jpg'),
(39, 20, './images/properties/58d378d2cd0cd2.94940856.jpg'),
(40, 21, './images/properties/58d37927c17fe2.23287694.jpg'),
(41, 21, './images/properties/58d37927c1aac3.81675705.jpg'),
(42, 21, './images/properties/58d37927c1c7a1.77031386.jpg'),
(43, 22, './images/properties/58d379a2a16f51.40538545.jpg'),
(44, 22, './images/properties/58d379a2a19ae6.07117767.jpg'),
(45, 22, './images/properties/58d379a2a1ba61.35168257.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

DROP TABLE IF EXISTS `property_types`;
CREATE TABLE IF NOT EXISTS `property_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `property_type`) VALUES
(7, 'Flats'),
(6, 'Buildings'),
(5, 'Plots'),
(8, 'Appartments');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

DROP TABLE IF EXISTS `rent`;
CREATE TABLE IF NOT EXISTS `rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `propertyid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soldproperties`
--

DROP TABLE IF EXISTS `soldproperties`;
CREATE TABLE IF NOT EXISTS `soldproperties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `propertyid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soldproperties`
--

INSERT INTO `soldproperties` (`id`, `propertyid`) VALUES
(17, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `displayimage` text NOT NULL,
  `contactnumber` text NOT NULL,
  `email_verification` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `displayimage`, `contactnumber`, `email_verification`, `status`) VALUES
(1, 'Mollie Osborn', 'disybuzup@yahoo.com', '6d2134', './images/agent/profileimage/58ce2078c35dd5.09095619.png', '895421', 'not verified', 'approved'),
(2, 'Sylvia Fernandez', 'zefifezum@gmail.com', '9a1e6b', './images/agent/profileimage/58d044203b6993.20452454.jpg', '895421', 'not verified', 'approved'),
(3, 'Caldwell Hines', 'nutycyca@gmail.com', '7d02ee', './images/agent/profileimage/58d044faef0827.34947205.jpg', '895421', 'not verified', 'approved'),
(4, 'Kermit Galloway', 'vomurukun@yahoo.com', '209289', './images/agent/profileimage/58d0454bd6b045.42654509.png', '895421', 'not verified', 'pending');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
