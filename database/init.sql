-- 10.3.13 MariaDB

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Table `email_providers`
--

CREATE TABLE `email_providers` (
  `id` int(4) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `provider_id` int(4) UNSIGNED NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `subscribers`
  ADD KEY `provider_id` (`provider_id`);


ALTER TABLE `subscribers`
  ADD CONSTRAINT `subscribers_ibfk_1`
    FOREIGN KEY (`provider_id`)
    REFERENCES `email_providers` (`id`)
    ON UPDATE CASCADE;


COMMIT;
