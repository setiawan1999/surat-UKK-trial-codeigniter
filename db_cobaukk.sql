-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2018 at 03:09 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cobaukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposition`
--

CREATE TABLE `disposition` (
  `id_disposition` int(11) NOT NULL,
  `disposition_at` date NOT NULL,
  `reply_at` datetime DEFAULT NULL,
  `description` text NOT NULL,
  `notification` int(11) NOT NULL,
  `id_mail` int(11) NOT NULL,
  `id_user_send` int(11) NOT NULL,
  `id_user_acc` int(11) NOT NULL,
  `status_disposition` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposition`
--

INSERT INTO `disposition` (`id_disposition`, `disposition_at`, `reply_at`, `description`, `notification`, `id_mail`, `id_user_send`, `id_user_acc`, `status_disposition`) VALUES
(1, '2018-02-13', NULL, 'Tolong Pak', 1, 2, 2, 1, 'done'),
(3, '2018-02-13', NULL, 'Tolong Nikahkan', 1, 8, 2, 5, 'done'),
(4, '2018-02-13', NULL, 'tolong infokan pak saya sibuk', 1, 10, 2, 1, 'not done');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Kepala Sekolah'),
(2, 'Sekretaris'),
(3, 'Waka'),
(4, 'Guru');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id_mail` int(11) NOT NULL,
  `incoming_at` date NOT NULL,
  `mail_code` text NOT NULL,
  `mail_date` date NOT NULL,
  `mail_from` varchar(200) NOT NULL,
  `mail_to` varchar(200) NOT NULL,
  `mail_subject` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `file_upload` text NOT NULL,
  `id_mail_type` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id_mail`, `incoming_at`, `mail_code`, `mail_date`, `mail_from`, `mail_to`, `mail_subject`, `status`, `file_upload`, `id_mail_type`, `id_user`) VALUES
(2, '2018-02-15', '192.168.1.1', '0000-00-00', 'SMKN 1 Buduran', 'SMK TELKOM MALANG', 'Study Tour', 'accepted', 'Screenshot_(17).png', 1, 2),
(8, '2018-01-01', '192.168.1.2', '2018-01-02', 'setiawan', 'SMK TELKOM MALANG', 'pernikahan', 'rejected', 'Capture5.PNG', 1, 1),
(9, '2018-02-01', '192.168.1.3', '2018-02-02', 'Iqbal', 'SMK TELKOM MALANG', 'Nikah', 'pending', 'Screenshot_(7).png', 1, 1),
(10, '2018-01-01', '29111999', '2018-01-01', 'smk telkom bandung', 'SMK TELKOM MALANG', 'pertukaran pelajar', 'pending', 'GIT_GIT.rar', 1, 2),
(11, '2018-02-01', '0987654321', '2018-02-01', 'wawan', 'SMK TELKOM MALANG', 'pinjam ruang', 'pending', 'Screenshot_(5).png', 1, 2),
(12, '2018-03-01', '3456787654', '2018-03-01', 'xdxd land', 'SMK TELKOM MALANG', 'wisata', 'pending', 'Screenshot_(15).png', 1, 2),
(14, '2018-06-05', 'askjdhkjasdn', '2018-06-02', 'skandkjasndkj', 'SMK TELKOM MALANG', 'kjansdkjnaskdjn', 'pending', 'Screenshot_(6).png', 1, 2),
(15, '2018-02-02', 'SMK-1-srt-453', '2018-02-01', 'SMK TELKOM MALANG', 'Yayasan', 'Permintaan Tambahan AC', 'send', 'Screenshot_(14).png', 2, 2),
(16, '2018-01-01', 'asdaskdnaksj', '2018-01-01', 'SMK TELKOM MALANG', 'asjdnj', 'kjasndjk', 'send', 'Screenshot_(1).png', 2, 2),
(19, '2018-04-02', 'ajhsdbjasdh', '2018-04-02', 'SMK TELKOM MALANG', 'asdkjasndkj', 'kjansjdknaksd', 'send', 'Screenshot_(15)1.png', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mail_type`
--

CREATE TABLE `mail_type` (
  `id_mail_type` int(11) NOT NULL,
  `mail_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_type`
--

INSERT INTO `mail_type` (`id_mail_type`, `mail_type`) VALUES
(1, 'masuk'),
(2, 'keluar');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `fullname`, `id_jabatan`) VALUES
(1, 'kepsek', 'admin', 'Kepala Sekolah (user)', 1),
(2, 'sekretaris', 'admin', 'Sekretaris (user)', 2),
(3, 'waka', 'admin', 'kurikulum (user)', 3),
(5, 'guru', 'admin', 'guru (user)', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposition`
--
ALTER TABLE `disposition`
  ADD PRIMARY KEY (`id_disposition`),
  ADD KEY `id_mail_2` (`id_mail`),
  ADD KEY `id_user_send` (`id_user_send`),
  ADD KEY `id_user_acc` (`id_user_acc`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id_mail`),
  ADD KEY `id_mail_type` (`id_mail_type`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indexes for table `mail_type`
--
ALTER TABLE `mail_type`
  ADD PRIMARY KEY (`id_mail_type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jabatan_2` (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposition`
--
ALTER TABLE `disposition`
  MODIFY `id_disposition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id_mail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mail_type`
--
ALTER TABLE `mail_type`
  MODIFY `id_mail_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposition`
--
ALTER TABLE `disposition`
  ADD CONSTRAINT `dis_id_mail` FOREIGN KEY (`id_mail`) REFERENCES `mail` (`id_mail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dis_id_user_acc` FOREIGN KEY (`id_user_acc`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dis_id_user_send` FOREIGN KEY (`id_user_send`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `ml_id_type` FOREIGN KEY (`id_mail_type`) REFERENCES `mail_type` (`id_mail_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ml_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `us_id_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
