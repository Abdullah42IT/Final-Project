-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 06:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(150) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `published_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `genre_id`, `published_date`, `created_by`, `created_at`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 1, '1925-04-10', 2, '2024-12-08 16:25:34'),
(2, '1984', 'George Orwell', 3, '1949-06-08', 3, '2024-12-08 16:25:34'),
(3, 'To Kill a Mockingbird', 'Harper Lee', 1, '1960-07-11', 4, '2024-12-08 16:25:34'),
(4, 'Brave New World', 'Aldous Huxley', 3, '1932-01-01', 5, '2024-12-08 16:25:34'),
(5, 'Pride and Prejudice', 'Jane Austen', 5, '1813-01-28', 2, '2024-12-08 16:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `event_date`, `created_by`, `created_at`) VALUES
(1, 'Music Festival', 'A fun-filled music extravaganza.', '2024-01-15', 2, '2024-12-08 16:25:34'),
(2, 'Art Exhibition', 'Contemporary art showcase.', '2024-02-10', 3, '2024-12-08 16:25:34'),
(3, 'Tech Conference', 'Latest insights in technology.', '2024-03-20', 4, '2024-12-08 16:25:34'),
(4, 'Food Fair', 'Explore cuisines from around the world.', '2024-04-25', 5, '2024-12-08 16:25:34'),
(5, 'Marathon', 'Annual running event.', '2024-05-30', 2, '2024-12-08 16:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(4, 'Fantasy'),
(1, 'Fiction'),
(2, 'Non-Fiction'),
(5, 'Romance'),
(3, 'Science Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `director` varchar(150) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `release_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `director`, `genre_id`, `release_date`, `created_by`, `created_at`) VALUES
(1, 'Inception', 'Christopher Nolan', 3, '2010-07-16', 2, '2024-12-08 16:25:34'),
(2, 'Titanic', 'James Cameron', 5, '1997-12-19', 3, '2024-12-08 16:25:34'),
(3, 'The Matrix', 'Lana Wachowski, Lilly Wachowski', 3, '1999-03-31', 4, '2024-12-08 16:25:34'),
(4, 'The Godfather', 'Francis Ford Coppola', 1, '1972-03-24', 5, '2024-12-08 16:25:34'),
(5, 'Toy Story', 'John Lasseter', 4, '1995-11-22', 2, '2024-12-08 16:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('ongoing','completed') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `status`, `created_by`, `created_at`) VALUES
(1, 'AI Research', 'Advancing AI technologies.', 'ongoing', 2, '2024-12-08 16:25:34'),
(2, 'Web Development', 'Building a CMS platform.', 'completed', 3, '2024-12-08 16:25:34'),
(3, 'Mobile App', 'Fitness tracking mobile app.', 'ongoing', 4, '2024-12-08 16:25:34'),
(4, 'Database Optimization', 'Improving database performance.', 'completed', 5, '2024-12-08 16:25:34'),
(5, 'Game Design', 'Designing a new RPG game.', 'ongoing', 2, '2024-12-08 16:25:34'),
(6, 'abc', 'abc\r\n', 'ongoing', 6, '2024-12-08 22:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `ingredients`, `instructions`, `created_by`, `created_at`) VALUES
(1, 'Pasta Carbonara', 'Classic Italian pasta dish.', 'Pasta, Eggs, Bacon, Cheese', 'Cook pasta, mix with eggs and bacon.', 2, '2024-12-08 16:25:34'),
(2, 'Chocolate Cake', 'Delicious homemade chocolate cake.', 'Flour, Cocoa, Eggs, Sugar', 'Bake at 350°F.', 3, '2024-12-08 16:25:34'),
(3, 'Caesar Salad', 'Fresh Caesar salad with croutons.', 'Lettuce, Croutons, Dressing', 'Toss ingredients together.', 4, '2024-12-08 16:25:34'),
(4, 'Beef Stroganoff', 'Creamy beef stroganoff.', 'Beef, Mushrooms, Cream', 'Cook beef and mix with sauce.', 5, '2024-12-08 16:25:34'),
(5, 'Vegetable Stir Fry', 'Quick and healthy stir fry.', 'Mixed Vegetables, Soy Sauce', 'Stir-fry vegetables.', 2, '2024-12-08 16:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin_user', 'admin@example.com', '$2y$10$4ulZJ3rd5TgjUSZWR2u0qOWjB6xVjGhgaZLiby8vC88nA8KcFAsJW', 'admin', '2024-12-08 16:25:34'),
(2, 'john_doe', 'john.doe@example.com', '*A0F874BC7F54EE086FCE60A37CE7887D8B31086B', 'user', '2024-12-08 16:25:34'),
(3, 'jane_doe', 'jane.doe@example.com', '*A0F874BC7F54EE086FCE60A37CE7887D8B31086B', 'user', '2024-12-08 16:25:34'),
(4, 'sam_smith', 'sam.smith@example.com', '*A0F874BC7F54EE086FCE60A37CE7887D8B31086B', 'user', '2024-12-08 16:25:34'),
(5, 'lisa_jones', 'lisa.jones@example.com', '*A0F874BC7F54EE086FCE60A37CE7887D8B31086B', 'user', '2024-12-08 16:25:34'),
(6, 'abc', 'abc@abc.com', '$2y$10$SgvRodEHGlo4DE7yHVvEi.OX0NujQGCnqbVYKbBPwJIcs.rfODlBu', 'user', '2024-12-08 21:53:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
