SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL primary key AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `answer` (
  `qid` int(11) NOT NULL,
  `ansid` int(11) NOT NULL  primary key AUTO_INCREMENT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `options` (
  `qid`int(11) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` int(11) NOT NULL primary key AUTO_INCREMENT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `questions` (
  `eid` int(11) NOT NULL,
  `qid` int(11) NOT NULL  primary key AUTO_INCREMENT,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `quiz` (
  `eid` int(11) NOT NULL primary key AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `right` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `rank` (
  `email` int NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `college` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL primary key ,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `questions`
  ADD FOREIGN KEY (`eid`) references quiz(`eid`) on delete cascade;

  ALTER TABLE `rank`
  ADD FOREIGN KEY (`email`) references user(`email`) on delete cascade;

ALTER TABLE `options`
  ADD FOREIGN KEY (`qid`) references questions(`qid`) on delete cascade;

ALTER TABLE `history`
  ADD FOREIGN KEY (`eid`) references quiz(`eid`)on delete cascade;

ALTER TABLE `answer`
  ADD FOREIGN KEY (`qid`) references questions(`qid`)on delete cascade;
