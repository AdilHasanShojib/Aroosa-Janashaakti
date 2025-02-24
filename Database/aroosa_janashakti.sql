-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 07:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aroosa_janashakti`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'noone', '$2y$10$3VXVvDT94QQs/sBz43MeOO5UPNk5OCPYcU8btEjsZsub2gfAXLizi');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(1, 'The Future of AI in Software Development', 'AI is reshaping software development by automating coding, debugging, and testing. Tools like GitHub Copilot and ChatGPT assist developers in writing better code faster. AI-driven algorithms enhance cybersecurity, predict software failures, and personalize user experiences. Machine learning (ML) models help in data analysis, automation, and decision-making. Companies like Google, Microsoft, and Tesla are integrating AI into software at an unprecedented scale. However, AI won’t replace developers but will enhance productivity. As AI evolves, ethical concerns and job shifts will arise. The future of software lies in human-AI collaboration, where developers and AI work together to build smarter applications.\r\n\r\n', 'ai_software.jpg', '2025-02-19 04:33:28'),
(2, 'Top 10 Web Development Trends in 2025', 'Web development is constantly evolving, with new trends shaping the industry. In 2025, progressive web apps (PWAs) will enhance user experiences with offline access and fast loading times. Artificial intelligence and chatbots will become more sophisticated, improving customer interactions. Dark mode design is gaining popularity for its aesthetic appeal and battery efficiency. Voice search optimization will be crucial as more users rely on voice assistants. Finally, serverless architecture will enable scalable and cost-efficient web applications. Staying updated with these trends will help developers build modern, future-proof websites.', 'web.jpeg', '2025-02-19 04:36:34'),
(3, 'How to Secure Your Website from Cyber Attacks', 'Cybersecurity is a top priority for online businesses. Hackers constantly look for vulnerabilities, making it crucial to secure websites and customer data. Businesses should implement strong passwords, enable two-factor authentication, and use SSL certificates for encrypted connections. Regular software updates and security patches help prevent cyberattacks. Backing up data and educating employees on phishing attacks are also essential. Investing in cybersecurity measures ensures business continuity and protects users from potential threats. In today’s digital world, cybersecurity is not an option but a necessity for all online businesses.', 'cybersecurity.jpg', '2025-02-19 04:36:34'),
(4, 'Best Programming Languages to Learn in 2025', 'Choosing the right programming language is crucial for career growth. In 2025, Python will dominate AI, data science, and automation. JavaScript remains essential for web development, especially with frameworks like React and Node.js. Go (Golang) is gaining traction in cloud computing. Rust is emerging as a secure alternative for system programming. Swift and Kotlin are ideal for mobile app development. SQL is necessary for database management. While trends change, mastering problem-solving skills is more important than any single language. If you’re new, start with Python. If you\'re into web development, JavaScript is a must. The key is to learn, adapt, and stay updated.', 'skills.webp', '2025-02-19 04:37:36'),
(5, 'Why PHP is Still Relevant for Web Development', 'Despite new technologies, PHP remains a powerful web development language. WordPress, Facebook, and Wikipedia rely on PHP for scalability and speed. PHP is easy to learn, supports dynamic websites, and integrates well with databases like MySQL. Modern frameworks like Laravel and Symfony have made PHP more efficient and secure. While languages like JavaScript and Python are rising, PHP still powers over 75% of websites. Hosting is affordable, and PHP’s open-source nature ensures continuous improvements. Whether you\'re building a simple blog or a complex e-commerce site, PHP remains a reliable choice. It’s old but still gold in web development.\r\n\r\n', 'php.png', '2025-02-19 04:37:36'),
(6, 'Mastering MySQL: A Beginner’s Guide', 'MySQL is one of the most widely used relational database management systems (RDBMS). It powers websites, applications, and enterprise systems worldwide. As an open-source database, MySQL is free, scalable, and efficient. It uses SQL (Structured Query Language) to manage and retrieve data. Beginners should start by learning database creation, tables, queries, and indexing. Popular CMS platforms like WordPress and Joomla use MySQL for data storage. Knowing MySQL is essential for backend development, making it a must-learn for web developers. Whether you\'re building a blog or a corporate system, MySQL remains a foundational skill in database management.', 'mysql.png', '2025-02-19 04:37:36'),
(7, 'The Role of UI/UX in Software Success', 'User Interface (UI) and User Experience (UX) design play a crucial role in software success. A well-designed UI enhances usability, while UX ensures a seamless and engaging experience. Companies like Apple and Google prioritize UI/UX, leading to higher customer satisfaction. Poor UI/UX can result in user frustration and high bounce rates. Effective UI/UX design involves intuitive navigation, accessibility, and responsive design. With increasing competition in the digital world, businesses must invest in UI/UX to retain users. Modern trends like dark mode, voice interfaces, and micro-interactions further enhance user engagement. Whether it\'s a website, mobile app, or software, a user-friendly experience is key to success. Good design is no longer optional—it’s a necessity.', 'ux.png', '2025-02-19 04:38:10'),
(8, 'Exploring the Power of Open-Source Software', 'Open-source software (OSS) is revolutionizing the tech industry. Unlike proprietary software, OSS allows developers worldwide to modify, distribute, and improve code. Popular examples include Linux, WordPress, and Mozilla Firefox. Companies benefit from OSS by reducing costs, increasing security, and leveraging community-driven innovation. Developers contribute to OSS projects to build skills and gain recognition. Businesses like Google and Microsoft support open-source initiatives to drive innovation. Security concerns exist, but transparency in OSS ensures quicker bug fixes. As software development advances, the impact of open-source will continue to grow. Whether you\'re a developer or business, embracing OSS offers limitless possibilities. It’s free, flexible, and the future of technology.\r\n\r\n', 'software.jpeg', '2025-02-19 04:38:10'),
(9, 'How to Optimize Your Website for SEO', 'SEO is essential for driving traffic to websites. In 2025, optimizing for voice search and AI-driven algorithms will be crucial. Long-form, high-quality content that provides real value will rank higher. Mobile-first indexing means websites must be responsive and fast-loading. Backlinks from authoritative sites will boost credibility. Structured data and schema markup will help search engines understand content better. Video content will also play a major role in SEO. Businesses that adapt to these strategies will see increased organic traffic and higher search rankings in the competitive digital landscape.', 'seo.jpg', '2025-02-19 04:38:10'),
(10, 'The Rise of No-Code and Low-Code Platforms', 'No-code and low-code platforms are transforming software development. These tools allow users to create applications with little to no coding knowledge. Platforms like Bubble, Adalo, and OutSystems enable startups and businesses to build apps quickly. No-code empowers non-developers, while low-code offers flexibility for programmers. These solutions reduce development time and costs, making them popular for small businesses and enterprises. However, they have limitations in customization and scalability. Despite this, no-code/low-code is shaping the future of development, enabling more people to innovate. As AI integration improves, these platforms will become even more powerful. The future of software development is accessible to everyone.', 'coding.jpg', '2025-02-19 04:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `name`, `comment`, `created_at`) VALUES
(8, 9, 'Adil', 'Nice blog', '2025-02-23 06:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `software_products`
--

CREATE TABLE `software_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `software_products`
--

INSERT INTO `software_products` (`id`, `name`, `description`, `price`, `file`, `created_at`, `image`) VALUES
(1, 'Antivirus Pro', 'Advanced security software to protect your PC from viruses and malware.', '29.99', 'antivirus_pro.zip', '2025-02-18 18:35:54', 'antrivirus.png'),
(2, 'Video Editor X', 'A powerful video editing tool with AI enhancements and 4K support.', '49.99', 'video_editor_x.exe', '2025-02-18 18:35:54', 'video editor.png'),
(3, 'Code Compiler', 'A multi-language compiler for developers with debugging features.', '19.99', 'code_compiler.zip', '2025-02-18 18:35:54', 'code.png'),
(4, 'Photo Studio', 'Professional photo editing software with filters, layers, and AI tools.', '39.99', 'photo_studio.rar', '2025-02-18 18:35:54', 'design.png'),
(5, 'Music Mixer Pro', 'A digital audio workstation (DAW) for music production and editing.', '59.99', 'music_mixer_pro.zip', '2025-02-18 18:35:54', 'music2.png'),
(7, '3D Design Studio', 'A 3D modeling and animation tool for designers and engineers.', '79.99', '3d_design_studio.rar', '2025-02-18 18:35:54', 'photo.jpg'),
(8, 'Accounting Plus', 'A business accounting software for tracking expenses and generating reports.', '34.99', 'accounting_plus.exe', '2025-02-18 18:35:54', 'accounting.png'),
(10, 'E-Learning Suite', 'A complete solution for creating and managing online courses.', '99.99', 'elearning_suite.zip', '2025-02-18 18:35:54', 'e leraning.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `software_products`
--
ALTER TABLE `software_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `software_products`
--
ALTER TABLE `software_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
