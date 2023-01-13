
CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `menu_name` text NOT NULL,
  `parent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `menu_name`, `parent`) VALUES
(1, 'Site logo', '0'),
(2, 'Home', '0'),
(3, 'Contact', '0'),
(4, 'About', '0'),
(5, 'Services', '0'),
(8, 'Map integration', '5'),
(9, 'Chart generation', '5'),
(10, 'Report generation', '5'),
(11, 'Projects', '0'),
(12, 'Chat plugin', '11'),
(13, 'Form builder', '11'),
(14, 'What\'s new', '0');

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
   