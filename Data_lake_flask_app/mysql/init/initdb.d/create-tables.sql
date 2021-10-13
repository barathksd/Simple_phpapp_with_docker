USE `activestreamhcx`;
DROP TABLE `xylog`;

CREATE TABLE IF NOT EXISTS `xylog` (
  `uid` int NOT NUll AUTO_INCREMENT,
  `UTC` varchar(255) NOT NULL,
  `UTCMs` varchar(255) NOT NULL,
  `camName` varchar(255) NOT NULL,
  `camNo` varchar(255) NOT NULL,
  `personID` INT,
  `personName` VARCHAR(255),
  `matchScore` INT NOT NULL,
  `matchThreshold` INT NOT NULL,
  `ismatch` BOOLEAN,
  `btx` int NOT NULL,
  `bty` int NOT NULL,
  `bbx` int NOT NULL,
  `bby` int NOT NULL,
  `rx` int NOT NULL,
  `ry` int NOT NULL,	  
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
);

#INSERT INTO xylog (UTC,UTCMs,camName,camNo,personID,personName,matchScore,matchThreshold,ismatch,btx,bty,bbx,bby,rx,ry) VALUES ("1614889574","468","Cam1","8L97R050089",1,"Barath",51,72,FALSE,585,325,950,539,100,504);

SELECT * FROM `xylog`;

