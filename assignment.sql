-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2019 at 10:51 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminNo` int(11) NOT NULL,
  `adminUsername` varchar(20) NOT NULL,
  `adminPass` varchar(20) NOT NULL,
  `adminName` varchar(25) NOT NULL,
  `adminIC` char(14) NOT NULL,
  `adminEmail` varchar(35) NOT NULL,
  `adminPhone` char(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminNo`, `adminUsername`, `adminPass`, `adminName`, `adminIC`, `adminEmail`, `adminPhone`) VALUES
(1, 'admin1', 'lyglCompany12345', 'Eldon Yeap', '000508-02-0839', 'juntao5210@hotmail.com', '018-9696932'),
(2, 'admin2', 'lygl123123Company', 'Lim Wei Kien', '000204-08-1253', 'w-kien1@hotmail.com', '014-2518678');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `e_ID` char(6) NOT NULL,
  `e_Name` varchar(100) NOT NULL,
  `e_Org` varchar(100) NOT NULL,
  `e_Desc` varchar(5000) NOT NULL,
  `e_Loc` varchar(200) NOT NULL,
  `e_State` char(2) NOT NULL,
  `startDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endDate` date NOT NULL,
  `endTime` time NOT NULL,
  `status` char(1) NOT NULL,
  `fee` char(1) NOT NULL,
  `price` double NOT NULL,
  `ticket` int(3) NOT NULL,
  `sst` double NOT NULL,
  `img` varchar(50) NOT NULL,
  `adminNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`e_ID`, `e_Name`, `e_Org`, `e_Desc`, `e_Loc`, `e_State`, `startDate`, `startTime`, `endDate`, `endTime`, `status`, `fee`, `price`, `ticket`, `sst`, `img`, `adminNo`) VALUES
('E00001', 'eCommerce Cross Border Conference 2019', 'buddicart.asia', 'eCommerce Cross Border Conference (ECBC) is the Malaysia Greatest eCommerce Cross Border Meet-Up & Networking event with more than 10 foreign countries participation & speakers to showcase their knowledge, vision, eco-system that delegates are looking forward to engage with.', 'Vertical Conference Bangsar South\r\n\r\nJalan Kerinchi\r\n\r\nBangsar South\r\n\r\nKuala Lumpur, Federal Territory 59200', 'KL', '2019-10-30', '08:30:00', '2019-10-31', '18:00:00', 'A', 'P', 310, 42, 0.05, '5d58f1614b9ba.jpg', 1),
('E00002', 'deTECH Conference 2019', 'aCAT PENANG', 'deTECH is a two-day annual conference that covers everything technology. (https://detechconf.com)\r\n\r\n6 KEYNOTES\r\nData Science\r\nCyber Security\r\nSmart City\r\nImmersive Technologies\r\nSmart Retail\r\nArtificial Intelligence\r\nView full agenda: detechconf.com/agenda\r\n\r\n10 HANDS-ON MASTERCLASSES\r\nDAY 1 (Choose 1 to attend)\r\n\r\nMobile App Development\r\nDesign Thinking\r\nMixed Reality\r\nDigital Copywriting\r\nArtificial Intelligence\r\nDAY 2 (Choose 1 to attend)\r\n\r\nCyber Security\r\nDigital Marketing\r\nUI/UX\r\nRuby on Rails\r\nMachine Learning\r\nView full agenda: detechconf.com/agenda\r\n\r\nSPEAKERS & TRAINERS\r\nDigi - Tan Wern Yi, Data Scientist\r\nKaspersky Lab - Yeo Siang Tiong, General Manager\r\nInfineon - Dr. Raj Kumar, Sr. Director\r\nHelloHolo - Kee Cheng Heng, Managing Director\r\nIntel IoT Group - Ngoo Seong Boon, General Manager\r\nStampede - Shaza Hakim, UX Principal\r\nFunctionize - Gooi Liang Zheng, Software Engineer\r\nLEAD - Reuben Châ€™ng, Head of Marketing\r\nVigilant Asia - Clement Arul, CTO\r\nHelloholo - Tng Kah Wei, Technical Lead\r\nMindvalley - Ben Sim, Senior Sales Copywriter\r\nada - Dr. Poo Kuan Hoong, Principal Machine Learning Engineer\r\nDesign Tinker - Chong Yong Yee, Founder\r\nWhite Room Analytics - Chia Jian Tong, Project Manager\r\nView full speaker list: detechconf.com/speaker\r\n\r\nPAYMENT OPTIONS\r\n1) To Claim HRDF\r\n\r\nYou may bank-in/ online transfer to the following bank account :\r\n\r\nName: Forwardemy Sdn Bhd\r\nBank: CIMB Bank\r\nBank Acc. Number: 8009584872\r\nImportant Note: for Paypal, please pay to howie@forwardschool.co\r\n\r\n2) No HRDF\r\n\r\nYou may bank-in/ online transfer to the following bank account :\r\n\r\nName: Ayuh Bina Sdn Bhd\r\nBank: CIMB Bank\r\nBank Acc. Number: 8008424467\r\n\r\n3) Note\r\n\r\nOnce you have completed payment, kindly email to hello@detechconf.com with your 1) Name, 2) Email, 3) Phone Number, 4) Proof Of Transaction. Please allow 24-hours response to process your order.\r\n\r\nImportant note: Once you have chosen either option A or option B to proceed, the payment is non-refundable and irreversible.\r\n\r\nABOUT deTECH CONFERENCE\r\n\r\nWe aim to gather all technology enthusiastsâ€”from students, entrepreneurs, prominent founders, industry experts, and educatorsâ€”to provide you with the latest technological trends and business opportunities available in the industry. The conference comprises of keynote talks, master classes and a showcase of cutting-edge technologies in the regionâ€”and saw over 300 attendees in its first year alone.', 'Penang Skills Development Centre\r\n\r\n1 Jalan Sultan Azlan Shah\r\n\r\nBayan Lepas, Pulau Pinang 11900', 'PN', '2019-10-01', '08:30:00', '2019-10-02', '17:30:00', 'A', 'P', 150, 40, 0.05, '5d56f173efa7b.jpg', 1),
('E00003', '2019 International Financial Expo IFINEXPO Kuala Lumpur Investment Summit', 'FigureFinance', '2019 International Financial Expo IFINEXPO\r\n\r\nKuala Lumpur Investment Summit\r\n\r\nâ€”â€”Power to Connect the World\r\n\r\nKuala Lumpur Investment Summit\r\n\r\n\r\nAfter the Figure Finance 2018 International Financial Expo Overseas Summit has been well received by Bangkok Station andKuala Lumpur Station, it will come to the beautiful and welcoming tropical country again in October this year. This time we chose Malaysia, one of the "Four Tigers in Asia", not only because Malaysia has good relations with China since ancient times, but also we hope to comply with the development of the times, promote economic and cultural exchanges between the two countries, and strengthen exchanges of peoples between the two countries. We have united with many strategic partners in Malaysia and many authoritative exhibitors to jointly build a financial ecology and create future of industry to promote the financial industry exchanges, cooperation and development as well as mutual benefit between China and Malaysia. As the capital of Malaysia, Kuala Lumpur is not one of but the most international city of Malaysia, which is also economic and cultural center of Malaysia. The Kuala Lumpur station summit this time is scheduled on October 26, 2019, located at Mandarin Oriental, Kuala Lumpur, hoping to bring a different experience to you who are coming or already in the financial industry!\r\n\r\nKuala Lumpur Investment Summit\r\n\r\n\r\nThis summit will continue the theme of â€œConnection â€“ Making Business Finance More Efficientâ€ in the past few fairs, establishing a professional and high-end brand image for enterprises, focusing on sharing and resources docking of professional knowledge in the financial field to realize Zero-distance contact of financial rookie and industry mogul and to collide the spark of wisdom. In addition to foreign exchange brokers, financial technology companies, technology solutions companies and other financial companies, exhibitors attending the summit will also cover PE, VC, mergers and acquisitions, real estate and other industries, not only covering resources of all aspects in the financial industry, but also moving forward outside the industry. At the same time, there will also be a lot of financial industry''s moguls to arrive at the scene, with the participation and support of many companies and industry insiders, this summit will become an opportunity to share, exchange and dock which cannot be missed.\r\n\r\nKuala Lumpur Investment Summit\r\n\r\n\r\nã€Conference Topicsã€‘\r\n\r\nKuala Lumpur Investment Summit\r\n\r\nWhat are you waiting for? Quickly click on the following link to sign up!\r\n\r\n\r\n\r\nã€Organizer Contact Informationã€‘\r\n\r\nChai Yu: Manager of Market Development of Figure Finance\r\n\r\nMobile: +86 15000833793\r\n\r\nLine: 13764672397\r\n\r\nEmailï¼šchaiyu@cfxexpo.com', 'Mandarin Oriental, Kuala Lumpur\r\n\r\nKuala Lumpur City Centre Wilayah Persekutuan', 'KL', '2019-10-26', '09:00:00', '2019-10-26', '17:00:00', 'A', 'F', 0, 48, 0.05, '5d56f1e9bf043.jpg', 1),
('E00004', 'DENNIS CLASSIC BORNEO QUALIFIER 2019', 'Nabba Singapore', 'All Competitors Please Read the Below Information :\r\n\r\nThe organizer will be sponsoring all the overall winners to compete in the upcoming DENNIS WORLDWIDE CLASSIC PRO/AM in Singapore in 17th to 19th April 2020.\r\n\r\nTop 3 will be award with Trophies, medals, and certificate.\r\n\r\nDear All, do click on the category, that you wish to join and make the payment for the registration fee. the multi joining of the category is allowed.\r\n\r\nSPRAY TANNING SERVICE: All athletes do take note, all athletes are/must take up the official tanning on the weigh-in day. The online link will be up soon for pre-registration as this will allow faster and smoother for spray tan service. As we will want to have a high standard and unify of the tan color. Non-official tanning service will cause the individual to re-tan again at the official tanning service provider again.\r\n\r\nAll athletes must use professional spray-tanning.\r\nNo self-applied oils allowed, including baby oil, Dream Tan, Pro-Tan, etc.\r\nNutrition Pro / Pro Tan is the official spray tanning vendor.\r\nEarly Bird Registration discount code for Category will be: DC50. do put in this at the selection page , and click on promotion code and type in DC50\r\n\r\n***the registration will be $75 after 10th Sept 2019, Late Registration will be $100. Online Registration will end on 29th OCT 2019.\r\n\r\nDo Visit the link to see the POSTER CHART for the WFF CATEGORY. https://www.nabbawffsingapore.com/rules\r\n\r\nTERMS:\r\n\r\nFor more inquiries and questions, do visit our website, www.nabbawffsingapore.com\r\n\r\nNABBA.WFF.SG@GMAIL.COM\r\n\r\nCategories for WFF MORTAL BATTLE MULTINATIONAL PRO/AM 2019\r\n(OPEN TO ALL, welcoming all federations, organizations, and associations to join us, THIS also include Local, Malaysian, PR )\r\n\r\nWeigh in is on 28th Nov 2019. Athlete meeting is on 28th Nov 2019 before the weigh-in, it is a must to attend.\r\n\r\non 29th Nov 2019 is the competition.\r\n\r\nMen Bodybuilding Jr <24yr\r\n\r\nMen Bodybuilding under 70kg\r\n\r\nMen Bodybuilding above 70kg\r\n\r\nFitness model jeans\r\n\r\nUnder 24\r\n\r\nUnder 172cm\r\n\r\nAbove 172cm\r\n\r\n\r\n\r\nMen Beach model :\r\n\r\nUnder 24\r\n\r\nBelow 172cm\r\n\r\nAbove 172cm\r\n\r\nAbove 30yr\r\n\r\n\r\n\r\nMen Sport model swimming trunk\r\n\r\nUnder 24\r\n\r\nUnder 172cm\r\n\r\nAbove 172cm\r\n\r\nAbove 30yr old\r\n\r\n\r\n\r\nMs bikini model\r\n\r\nUnder 24\r\n\r\nUnder 163cm\r\n\r\nAbove 163cm\r\n\r\nAbove 30yr old\r\n\r\n\r\n\r\nMs Sport model (hard)\r\n\r\nUnder 24\r\n\r\nUnder 163cm\r\n\r\nAbove 163cm\r\n\r\nAbove 30yr old\r\n\r\n*WAIVER: Under the Personal Data Protection Act, By your accepting my application to the DENNIS CLASSIC BORNEO QUALIFIER 2019, along with my non-refundable entry fee, I hereby intend to be legally bound for myself, my heirs, executors, and administrators. I waive and release any and all rights and claims for damages I may have against Organizer for DENNIS CLASSIC BORNEO QUALIFIER 2019, NABBA WFF SINGAPORE , agents and representatives for any and all injuries and or losses suffered by me as a result of my participation and or attendance and traveling to the DENNIS CLASSIC BORNEO QUALIFIER 2019. These damages include, but are not limited to, published photographs that I may find to be unattractive or editorial which I may construe as being misrepresentative. I also grant Organizer of DENNIS CLASSIC BORNEO QUALIFIER 2019 permission to use photos, video or any likeness of myself to promote any future contests, videos, magazines or any other media involved with future and present contest for the purpose of promotion and /or sales of these media, without any compensation to myself, a condition of my entering the event. I will abide by all DENNIS CLASSIC BORNEO QUALIFIER 2019 rules and show good sportsmanship.\r\n\r\nSee you all soon !!!', 'HO TIN LAU RESTAURANT\r\n\r\nL2-A1, LOT 19923, BLK 11, JALAN STUTONG BARU, 93350 KUCHING, SARAWAK\r\n\r\nKUCHING, MALAYSIA 93350', 'SW', '2019-11-29', '10:00:00', '2019-11-29', '22:00:00', 'A', 'P', 150, 50, 0.05, '5d56f24e3c1ca.jpg', 1),
('E00005', 'Human Age Forum 2019 - Kuala Lumpur', 'ManpowerGroup Malaysia', 'What''s new?\r\n\r\nIn 2019 we are adding workshop sessions to the forum. Not only 1 workshop but 4! You will be able to pick 2 out of these workshops to join and have a close conversation with industry experts on the following topics:\r\n\r\n1. Skills Revolution 4.0\r\n\r\nHow to ensure humans can team up with machines?\r\n\r\nThe focus on robots eliminating jobs is distracting us from the real issue. More and more robots are being added to the workforce, but humans are too. For three consecutive years our research shows most employers plan to increase or maintain headcount as a result of automation. Tech is here to stay, and itâ€™s our responsibility as leaders to work out how we integrate humans with machines.\r\n\r\n\r\n2. Cultivating Culture of Compliance\r\n\r\nHow to build a culture of compliance & earn trust?\r\n\r\nItâ€™s vital for organizations today to understand the importance of compliance in business, as failure to comply with regulations could result in significant business risk. So how is it possible to drive the culture of compliance in an organization optimizing customer experiences and building consumer trust?\r\n\r\n\r\n3. High Tech / High Touch Approach to Candidates Attraction\r\n\r\nWhy you should adopt high tech / high touch approach to attract candidates?\r\n\r\nFrom clicking ads for jobs on social media to asking SiriÂ®, CortanaÂ® and AlexaÂ® for help, candidates were clear: technology has the potential to provide a better experience, but it is no substitute for human interaction. Companies seeking to engage the right candidates need to combine high-tech with a high-touch approach.\r\n\r\n\r\n4. Work models preferences\r\n\r\nWhat work models candidates in Malaysia are looking for?\r\n\r\nHow organizations get work done and how people choose to work is changing. The choices for hiring employees have evolved well beyond traditional full-time workers. HR managers can choose from independent contractors, freelancers, part-time workers, seasonal employees, temporary workers and platform-based on-demand workers (e.g., Grab). Effective workforce planning needs to account for how people want to work.\r\n\r\n\r\n\r\nAgenda:\r\n\r\n08:30 â€“ 09:00 Registration\r\n\r\n09:00 â€“ 09:15 Opening\r\n\r\n09:15 â€“ 10:00 Sponsor Presentation (TBA)\r\n\r\n10:00 â€“ 10:30 Breakfast and Networking\r\n\r\n10:30 â€“ 11:30 Panel Session (The future of talent in Malaysia 2035)\r\n\r\nSam Haggag | ManpowerGroup\r\nJeremy Lee | ATCEN Education Group\r\nSharala Axryd | The Center of Applied Data Science\r\nTBA\r\n11:30 â€“ 13:00 Workshops (Delegates can pick 2 out of 4 streams)\r\n\r\nSkills Revolution 4.0 - Lily Cook | ManpowerGroup\r\nCultivating Culture of Compliance - Vishnu Prakash | ManpowerGroup\r\nHigh Tech / High Touch Approach to Candidates Attraction - Mohammad Kashif | ManpowerGroup\r\nWorkforce work models preferences - Madeep Kaur | ManpowerGroup\r\n13:00 â€“ 14:00 Lunch and Networking\r\n\r\n14:00 â€“ 14:45 How to nurture and retain GenY and GenZ in your organization - Dr. AJ Miani | Subture\r\n\r\n14:45 â€“ 15:15 Total Talent Management - Sam Haggag | ManpowerGroup\r\n\r\n15:15 â€“ 16:00 Tea and Networking\r\n\r\n\r\n\r\n\r\n\r\nWe are looking forward to have you with us this year! Get your tickets now before it''s too late ;)', 'Ruang\r\n\r\nMenara PKNS 17 Jalan Yong Shook Lin\r\n\r\nPetaling Jaya, Selangor 46050', 'SG', '2019-09-26', '08:30:00', '2019-09-26', '16:00:00', 'A', 'P', 300, 40, 0.05, '5d56f2d65a6c0.jpg', 1),
('E00006', 'Eat Well & Live Well! Health & Wellness Carnival', 'El Holistic Products Sdn Bhd', 'Roar 2 Health is back! - bigger and better . Our theme is "eat well, live well", and as you can guess a key focus of the carnival will be on food - natural, organic, healthy, wholesome, and yummy food.', 'The Gasket Alley\r\n\r\n13 Jalan 13/6\r\n\r\n#Lot 15\r\n\r\nPetaling Jaya, Selangor 46200', 'SG', '2019-10-20', '11:00:00', '2019-10-20', '19:00:00', 'A', 'F', 0, 49, 0.05, '5d56f36f2f364.jpg', 2),
('E00007', 'SME CEO Forum Penang: Industrial Revolution 4.0', 'Business Media International', 'Due to popular demand, we bring SME CEO Forum to the Silicon Valley of Malaysia, Penang. SME CEO Forum is a gathering of thought leaders and business owners. First organised in 2010 in Kuala Lumpur, the SME CEO Forum brings together CEOs and owners from some of the region''s best performing SMEs to hear and share thoughts with top practitioners on best industry practices and burning issues of the day!\r\n\r\nProgression Towards Industry 4.0\r\nTransformation and Change require overcoming adverse hurdles that often are rooted in resistance due to fear. The advent of Industry 4.0 has certainly generated unnecessary cause for concern in many still clinging to traditionalistic methods of business and operations. Driven by data that enables faster, flexible, less wasteful and more efficient processes. IR4.0 eases many lives through strategic harnessing of Big Data, Augmented Reality, Simulation, Internet of Things, Cloud Computing, Cyber Security, Systems Integration, Additive Manufacturing and Autonomous Systems, These elements come together to elevate the significance of Artificial Intelligence in day-to-day operations that encompass Home, Work and Play.', 'Setia SPICE Convention Centre\r\n\r\n108C Jalan Tun Dr Awang\r\n\r\nBayan Lepas, Pulau Pinang 11900', 'PN', '2019-10-31', '08:00:00', '2019-10-31', '18:00:00', 'A', 'P', 320, 50, 0.05, '5d56f3d36190e.jpg', 1),
('E00008', '2019 Instructor Development Update - Kuala Lumpur, Malaysia', 'PADI Asia Pacific Instructor Development', 'Join us for the 2019 Instructor Development Update \r\nTopics covered:\r\n\r\nOverview of the Revised IDC and New Materials\r\nStandards and Curriculum Overview\r\nUsing Your Digital Material\r\nEvaluation Training â€“ Knowledge Development\r\nEvaluation Training â€“ Confined and Open Water\r\nWhat''s included:\r\n\r\nRefreshments and lunch\r\n\r\nMaterials Package containing -\r\n\r\nCourse Director Manual\r\nIDC Lesson Guides (incl. IDCSI course)\r\nIDC Evaluation Training video and Evaluation Training score sheet\r\nConfined and Open Water Evaluation Slate\r\nSkill Development Preparation Slate\r\nSkill Evaluation Slate\r\nForms required for administration, answer keys etc.\r\nIDC Crewpak components -\r\nIDC eLearning access\r\nPADI Guide to Teaching\r\nPeak Performance Buoyancy and Project AWARE Specialty Instructor Guides\r\nOpen Water Quizzes and Exams (imp/met)\r\nRescue Diver Exams (imp./met.)\r\nDivemaster Exams (imp./met.)\r\nConfined and Open Water Evaluation Slate (PDF)\r\nDiving Knowledge Workbook\r\nOW Prescriptive Lesson Guides (digital)\r\nLesson Planning Form\r\nAssorted administration and course completion forms\r\nFor more information view here or contact PADI Asia Pacific Instructor Development at instdev@padi.com.au or any member of the PADI Asia Pacific Instructor Development department team.\r\n\r\nWe look forward to seeing you there!', 'Holiday Inn Glenmarie\r\n\r\n1, Jalan Usahawan U1/8, Seksyen U1\r\n\r\nSelangor Darul Ehsan\r\n\r\nShah Alam, Selangor 40250', 'SG', '2019-10-05', '09:00:00', '2019-10-05', '16:00:00', 'A', 'P', 800, 47, 0.05, '5d56f43600fe7.jpg', 1),
('E00009', 'GP Symposium: Clinical Nutrition Updates', 'Co-Organisers: IMU Healthcare & PMCare', 'This event, co-organised by IMU Healthcare and PMCare, aims to lead to an understanding of the rationale behind current clinical nutrition approaches to care of patients commonly seen in GP Clinics.\r\n\r\nEach clinical nutrition update section integrates the latest developments with tips for managing patients at the primary care level to enable GP''s to act as advocates of wellness within the community.', 'IMU Healthcare\r\n\r\n126 Jalan Jalil Perkasa 19\r\n\r\nKuala Lumpur, Federal Territory 57000', 'KL', '2019-09-29', '08:00:00', '2019-09-29', '16:30:00', 'A', 'F', 0, 50, 0.05, '5d58f1a6d5dcb.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `username` varchar(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `icNum` char(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone_no` char(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `q1` int(1) NOT NULL,
  `a1` varchar(20) NOT NULL,
  `q2` int(1) NOT NULL,
  `a2` varchar(20) NOT NULL,
  `u_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `name`, `icNum`, `email`, `phone_no`, `password`, `q1`, `a1`, `q2`, `a2`, `u_status`) VALUES
('beng0055okok', 'Tan Ah Beng', '000101-01-0123', 'juntao5210@gmail.com', '012-5266753', 'TxPwFKByfj', 3, 'Little Beng', 6, 'Ed Sheeran', 'A'),
('memorylove', 'Ng Ko Liam', '890615-05-5934', 'klng@gmail.com', '017-8596443', 'M1234567', 1, 'asdf', 6, 'sdf', 'A'),
('aliabu1001', 'Ali bin Mohammad', '901231-07-2543', 'ali1231@hotmail.com', '011-26357493', 'abu1001ali', 5, 'eat and sleep', 8, 'Lorong Gajah', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `t_ID` int(11) NOT NULL,
  `num_of_ticket` int(11) NOT NULL,
  `e_ID` char(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `icNum` char(14) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`t_ID`, `num_of_ticket`, `e_ID`, `name`, `email`, `icNum`) VALUES
(1, 1, 'E00001', 'Tan Ah Beng', 'juntao5210@gmail.com', '000101-01-0123'),
(2, 1, 'E00001', 'Tan Ah Beng', 'juntao5210@gmail.com', '000101-01-0123'),
(3, 1, 'E00003', 'Tan Ah Beng', 'juntao5210@gmail.com', '000101-01-0123'),
(4, 3, 'E00005', 'Tan Ah Beng', 'juntao5210@gmail.com', '000101-01-0123'),
(5, 2, 'E00008', 'Tan Ah Beng', 'juntao5210@gmail.com', '000101-01-0123'),
(6, 2, 'E00002', 'Tan Ah Beng', 'juntao5210@gmail.com', '000101-01-0123'),
(7, 7, 'E00005', 'Tan Ah Beng', 'juntao5210@gmail.com', '000101-01-0123'),
(8, 2, 'E00002', 'Ali bin Mohammad', 'ali1231@hotmail.com', '901231-07-2543'),
(9, 1, 'E00008', 'Ali bin Mohammad', 'ali1231@hotmail.com', '901231-07-2543'),
(10, 1, 'E00003', 'Ng Ko Liam', 'klng@gmail.com', '890615-05-5934'),
(11, 1, 'E00006', 'Ng Ko Liam', 'klng@gmail.com', '890615-05-5934'),
(12, 3, 'E00001', 'Ng Ko Liam', 'klng@gmail.com', '890615-05-5934'),
(13, 5, 'E00002', 'Ng Ko Liam', 'klng@gmail.com', '890615-05-5934');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminNo`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`e_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`icNum`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`t_ID`), ADD KEY `icNum` (`icNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `t_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
