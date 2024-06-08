-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 11:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_book`
--

CREATE TABLE `add_book` (
  `B_id` int(11) NOT NULL,
  `Book_Name` varchar(255) NOT NULL,
  `Book_Category` int(11) DEFAULT NULL,
  `Book_img` varchar(255) NOT NULL,
  `Book_Author` varchar(255) DEFAULT NULL,
  `Book_PDF` longblob DEFAULT NULL,
  `Book_Price` decimal(10,2) DEFAULT NULL,
  `Book_Description` text DEFAULT NULL,
  `Book_Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_book`
--

INSERT INTO `add_book` (`B_id`, `Book_Name`, `Book_Category`, `Book_img`, `Book_Author`, `Book_PDF`, `Book_Price`, `Book_Description`, `Book_Quantity`) VALUES
(52, 'In The Woods', 1, 'product12.jpg', 'Tana French', 0x496e2074686520576f6f64732e706466, '200.00', 'Designed by Nancy Resnick · Illustration by Jennifer Wang \r\nWithout limiting the rights under copyright reserved above, no part of this publication may be re\r\nproduced, stored in or introduced into a retrieval system, or transmitted, in any form or by any \r\nmeans (electronic, mechanical, photocopying, recording or otherwise), without the prior written \r\npermission of both the copyright owner and the above publisher of this book. \r\nThe scanning, uploading, and distribution of this book via the Internet or via any other means with\r\nout the permission of the publisher is illegal and punishable by law.  Please purchase only authorized \r\nelectronic editions and do not participate in or encourage electronic piracy of copyrightable materials. Your support of the author’s rights is appreciated.', 0),
(53, 'The-Alchemist', 2, 'product5.jpg', 'Paulo-Coelho', 0x5468652d416c6368656d6973742d62792d5061756c6f2d436f656c686f2e706466, '100.00', 'The boy\'s name was Santiago. Dusk was falling as the boy arrived with his\r\n herd at an abandoned church. The roof had fallen in long ago, and an\r\n enormous sycamore had grown on the spot where the sacristy had once\r\n stood. \r\nHe decided to spend the night there. He saw to it that all the sheep entered\r\n through the ruined gate, and then laid some planks across it to prevent the\r\n flock from wandering away during the night. There were no wolves in the\r\n region, but once an animal had strayed during the night, and the boy had\r\n had to spend the entire next day searching for it.\r\n He swept the floor with his jacket and lay down, using the book he had just\r\n finished reading as a pillow. He told himself that he would have to start\r\n reading thicker books: they lasted longer, and made more comfortable\r\n pillows.\r\n It was still dark when he awoke, and, looking up, he could see the stars\r\n through the half-destroyed roof.\r\n I wanted to sleep a little longer, he thought. He had had the same dream that\r\n night as a week ago, and once again he had awakened before it ended.\r\n He arose and, taking up his crook, began to awaken the sheep that still slept.\r\n He had noticed that, as soon as he awoke, most of his animals also began to\r\n stir. It was as if some mysterious energy bound his life to that of the sheep,\r\n with whom he had spent the past two years, leading them through the\r\n countryside in search of food and water. \"They are so used to me that they\r\n know my schedule,\" he muttered. Thinking about that for a moment, he\r\n realized that it could be the other way around: that it was he who had\r\n become accustomed to their schedule', 0),
(54, 'The Girl With The Dragon Tattoo', 2, 'product7.jpg', 'Niels Arden Oplev ', 0x61646f632e7075625f7468652d6769726c2d776974682d7468652d647261676f6e2d746174746f6f2e706466, '50.00', 'A tetovált lány címő film a svéd író Stieg Larsson Millenium trilógiájának \r\nelsı kötetébıl készült, melybıl 8 millió példányt adtak el világszerte. A \r\nfilm költségvetése kb. 3,5 millió Euró volt. Niels Arden Oplev rendezı \r\nadaptációja 100 millió dolláros kasszasiker lett, 2009ben ez a film \r\ntermelte a legtöbb bevétet az európai filmek piacán.  A trilógia további két \r\nrészébıl elkészült filmek  \r\nA lány, aki a tőzzel játszik, és A kártyavár \r\nösszedıl – tovább növelték a franchise sikerét. A tetovált lányt 2008ban \r\nforgatták Svédországban, Stockholmban és környékén.  ', 0),
(55, 'The-Kite-Runner', 2, 'product11.jpg', 'KHALED HOSSEINI ', 0x5468652d4b6974652d52756e6e65722d5044462d626f6f6b73667265652e6f72675f2e706466, '200.00', 'In 1933, the year Baba was born and the year Zahir Shah began his forty-year \r\nreign of Afghanistan, two brothers, young men from a wealthy and reputable \r\nfamily in Kabul, got behind the wheel of their father\'s Ford roadster. High on \r\nhashish and _mast_ on French wine, they struck and killed a Hazara husband and \r\nwife on the road to Paghman. The police brought the somewhat contrite young \r\nmen and the dead couple\'s five-year-old orphan boy before my grandfather, who \r\nwas a highly regarded judge and a man of impeccable reputation. After hearing \r\nthe brothers\' account and their father\'s plea for mercy, my grandfather ordered \r\nthe two young men to go to Kandahar at once and enlist in the army for one year--this despite the fact that their family had somehow managed to obtain them \r\nexemptions from the draft. Their father argued, but not too vehemently, and in \r\nthe end, everyone agreed that the punishment had been perhaps harsh but fair. \r\nAs for the orphan, my grandfather adopted him into his own household, and told \r\nthe other servants to tutor him, but to be kind to him. That boy was Ali. ', 0),
(56, 'Harry Potter', 3, 'product9.jpg', 'Lina Adam ', 0x4b6f746f62617469202d20486172727920506f7474657220616e642074686520536f72636572657227732053746f6e652e706466, '250.00', 'Mr. and Mrs. Dursley, of number four, Privet Drive, were proud to say\r\n that they were perfectly normal, thank you very much. They were the last\r\n people you\'d expect to be involved in anything strange or mysterious,\r\n because they just didn\'t hold with such nonsense.\r\n Mr. Dursley was the director of a firm called Grunnings, which made\r\n drills. He was a big, beefy man with hardly any neck, although he did\r\n have a very large mustache. Mrs. Dursley was thin and blonde and had\r\n nearly twice the usual amount of neck, which came in very useful as she\r\n spent so much of her time craning over garden fences, spying on the\r\n neighbors. The Dursleys had a small son called Dudley and in their\r\n opinion there was no finer boy anywhere.', 0),
(57, 'The Hunger Games', 3, 'products5.jpg', 'Suzanne	Collins', 0x5468652d48756e6765722d47616d65732d426f6f6b202831292e706466, '300.00', 'When	I	wake	up,	the	other	side	of	the	bed	is	cold.	My	fingers\r\n stretch	out,	seeking	Prim’s	warmth	but	finding	only	the	rough\r\n canvas	cover	of	the	mattress.	She	must	have	had	bad	dreams	and\r\n climbed	in	with	our	mother.	Of	course,	she	did.	This	is	the	day	of\r\n the	reaping.', 0),
(59, 'A Song of Ice and Fire', 2, 'product6.jpg', ' Bantam', 0x412d536f6e672d6f662d4963652d616e642d466972652d5044462e706466, '400.00', 'A	Game	of	Thrones\r\n A	Bantam	Spectra	Book\r\n SPECTRA	and	the	portrayal	of	a	boxed	“s”	are	trademarks	of	Bantam	Books,	a	division	of	Random\r\n House,	Inc.\r\n PUBLISHING	HISTORY\r\n Bantam	hardcover	edition	published	September	1996\r\n Bantam	paperback	edition	/	September	1997\r\n Maps	by	James	Sinclair.\r\n Heraldic	crests	by	Virginia	Norey.\r\n All	rights	reserved.\r\n Copyright	©	1996	by	George	R.	R.	Martin\r\n Library	of	Congress	Catalog	Card	Number:	95-43936.\r\n No	part	of	this	book	may	be	reproduced	or	transmitted	in	any	form\r\n or	by	any	means,	electronic	or	mechanical,	including	photocopying,\r\n recording,	or	by	any	information	storage	and	retrieval	system,\r\n without	permission	in	writing	from	the	publisher.\r\n For	information	address:	Bantam	Books.\r\n Visit	our	website	at	www.bantamdell.com\r\n eISBN:	978-0-553-89784-5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `subscription_price` decimal(10,2) DEFAULT NULL,
  `delivery_charge` decimal(10,2) DEFAULT NULL,
  `type` enum('PDF','Hard Copy','CD') DEFAULT NULL,
  `is_free` tinyint(1) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `last_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `description`, `price`, `subscription_price`, `delivery_charge`, `type`, `is_free`, `is_published`, `last_updated`) VALUES
(1, 'Sample Book Title', 'Sample Author', 'This is a sample book description.', '19.99', '9.99', '3.99', 'Hard Copy', 0, 1, '2023-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`, `created_at`) VALUES
(10, 23, 'In The Woods', '200.00', 2, '', '2023-10-03 10:37:22'),
(11, 24, 'The-Kite-Runner', '200.00', 2, '', '2023-10-03 13:47:30'),
(22, 20, 'The Girl With The Dragon Tattoo', '50.00', 1, '', '2023-10-04 20:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `C_id` int(11) NOT NULL,
  `Category_Name` varchar(255) NOT NULL,
  `Category_Des` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`C_id`, `Category_Name`, `Category_Des`) VALUES
(1, 'Horror', 'hellow'),
(2, 'History ', 'This is a demy data for checking purpose '),
(3, 'Mystery', 'dfgda');

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `competition_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`competition_id`, `title`, `description`, `start_date`, `end_date`, `is_active`) VALUES
(1, 'The Power of Youth: Fostering Change through Education', 'Education has always been a powerful instrument for shaping societies and creating positive change. In today\'s world, where the youth play an increasingly vital role in shaping the future, it is crucial to harness their potential as change-makers through education.\r\n\r\nThis essay competition calls upon young minds to explore and articulate their perspectives on the role of education in driving positive societal change.', '2023-09-05', '2023-09-07', 0),
(4, 'Exploring the Future of Artificial Intelligence: A Path to Innovation', 'In our ever-evolving technological landscape, the role of artificial intelligence (AI) has become increasingly significant. AI has touched nearly every aspect of our lives, from the way we work and communicate to how we shop and make decisions. As we stand on the brink of the AI revolution, it\'s crucial to explore its potential and implications.\r\n\r\nThis essay competition invites participants to delve into the multifaceted world of artificial intelligence.', '2023-10-04', '2023-10-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `competition_registrations`
--

CREATE TABLE `competition_registrations` (
  `competition_registration_id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `essay_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `competition_registrations`
--

INSERT INTO `competition_registrations` (`competition_registration_id`, `competition_id`, `result_id`, `user_name`, `user_email`, `essay_content`) VALUES
(28, 1, 62732, 'talha', 'talha@gmail.com', NULL),
(29, 1, 10428, 'ahmed', 'ahmed@gmail.com', NULL),
(30, 1, 25495, 'ahmed', 'nadeem@gmail.com', NULL),
(31, 1, 51428, 'Nadeem', 'talhaaptech02@gmail.com', 'mddfydgygfedfef'),
(32, 1, 27185, 'kabeer', 'areeb@gmail.com', 'wetr'),
(33, 1, 37749, 'Hamza', 'hamza@gmail.com', 'rfgefgrvejhvfgevrytea');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_messages`
--

CREATE TABLE `contact_us_messages` (
  `message_id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us_messages`
--

INSERT INTO `contact_us_messages` (`message_id`, `sender_name`, `sender_email`, `subject`, `message`, `submission_date`) VALUES
(2, 'Syed Muhammad Talha', 'ahmed@gmail.com', 'Discout ', 'hythyr', '2023-09-25 06:20:10'),
(3, 'kabeer', 'kabeer@gmail.com', 'uh34783', 'jrugeryegrygt3e', '2023-09-26 11:46:59'),
(4, 'Khaliq', 'nadeem@gmail.com', 'Discout ', 'book are soo good ', '2023-10-03 13:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `is_registered` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `username`, `password`, `email`, `full_name`, `address`, `phone_number`, `is_registered`) VALUES
(1, 'john_doe', 'hashed_password_here', 'john.doe@example.com', 'John Doe', '123 Main Street, City, Country', '123-456-7890', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(50) NOT NULL DEFAULT 'User',
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role`, `profile_pic`, `created_at`, `user_address`) VALUES
(5, 'Areeb', 'Areeb12@gmail.com', '434546', 'User', 'profile_pics/IMG_20181115_083214 - Copy.jpg', '2023-09-20 06:50:20', 'Malir'),
(15, 'ahmed', 'ahmed@gmail.com', '1234', 'User', '../admin/profile_pics/6-01.jpg', '2023-09-29 15:19:30', ''),
(18, 'Nadeem', 'nadeem@gmail.com', '1234567', 'User', '../admin/profile_pics/IMG_2458.JPG', '2023-09-30 05:56:28', ''),
(19, 'Mazz', 'mazz@gmail.com', '12345678', 'Admin', 'profile_pics/cropped-dsb-png.png', '2023-09-30 06:02:33', 'qwrergrg'),
(20, 'Azeem', 'hammad@gmail.com', '12345', 'User', '../admin/profile_pics/25413e78-08d7-480c-80ce-8f96d5db5699.jpg', '2023-09-30 15:28:06', ''),
(21, 'Muzammil', 'muzammiluddin@gmail.com', 'muzammiluddin@gmail.com', 'User', '../admin/profile_pics/coffee logo.jpg', '2023-09-30 16:02:48', ''),
(23, 'Hamza', 'hamza@gmail.com', '1234', 'User', '../admin/profile_pics/10-01.jpg', '2023-10-03 10:32:40', ''),
(24, 'Khaliq', 'khaliq@gmail.com', '12345', 'User', '../admin/profile_pics/13-01.jpg', '2023-10-03 13:46:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `winner_id` int(11) NOT NULL,
  `competition_id` int(11) DEFAULT NULL,
  `competition_registrations_id` int(11) DEFAULT NULL,
  `Winner_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`winner_id`, `competition_id`, `competition_registrations_id`, `Winner_Name`) VALUES
(1, 1, 28, 'talha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_book`
--
ALTER TABLE `add_book`
  ADD PRIMARY KEY (`B_id`),
  ADD KEY `Book_Category` (`Book_Category`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`C_id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`competition_id`);

--
-- Indexes for table `competition_registrations`
--
ALTER TABLE `competition_registrations`
  ADD PRIMARY KEY (`competition_registration_id`),
  ADD KEY `forieng_key_1` (`competition_id`);

--
-- Indexes for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`winner_id`),
  ADD KEY `competition_id` (`competition_id`),
  ADD KEY `competition_registrations_id` (`competition_registrations_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_book`
--
ALTER TABLE `add_book`
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `C_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `competition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `competition_registrations`
--
ALTER TABLE `competition_registrations`
  MODIFY `competition_registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `winner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_book`
--
ALTER TABLE `add_book`
  ADD CONSTRAINT `add_book_ibfk_1` FOREIGN KEY (`Book_Category`) REFERENCES `category` (`C_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `competition_registrations`
--
ALTER TABLE `competition_registrations`
  ADD CONSTRAINT `forieng_key_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`competition_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `winners`
--
ALTER TABLE `winners`
  ADD CONSTRAINT `winners_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`competition_id`),
  ADD CONSTRAINT `winners_ibfk_2` FOREIGN KEY (`competition_registrations_id`) REFERENCES `competition_registrations` (`competition_registration_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
