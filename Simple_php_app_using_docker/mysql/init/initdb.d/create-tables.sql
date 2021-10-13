USE `demodb`;

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `emailID` VARCHAR(50) NOT NULL,
  `hash` VARCHAR(255) NOT NULL,
  `password` VARCHAR(50), 
  PRIMARY KEY (`uid`)
);

CREATE TABLE IF NOT EXISTS `xylog` (
  `uid` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `t` TIMESTAMP NOT NULL,
  `rx` SMALLINT NOT NULL,
  `ry` SMALLINT NOT NULL,
  `pName` VARCHAR(50) NOT NULL, 
  `camName` VARCHAR(50) NOT NULL, 
  PRIMARY KEY (`uid`)
);


INSERT INTO `xylog` (t,rx,ry,pName,camName) VALUES ('2021-05-10 10:56:00',21,-87,"Amy","Cam5");
INSERT INTO `xylog` (t,rx,ry,pName,camName) VALUES ('2021-05-11 11:44:00',-121,-12,"Bob","Cam5");
INSERT INTO `xylog` (t,rx,ry,pName,camName) VALUES ('2021-05-12 11:21:00',51,236,"Charlie","Cam5");
INSERT INTO `xylog` (t,rx,ry,pName,camName) VALUES ('2021-05-10 09:33:00',-68,610,"David","Cam5");
INSERT INTO `xylog` (t,rx,ry,pName,camName) VALUES ('2021-05-09 16:25:00',2,-200,"Emi","Cam5");
INSERT INTO `xylog` (t,rx,ry,pName,camName) VALUES ('2021-05-09 12:12:00',-400,-123,"Frank","Cam5");


INSERT INTO `users` (name,emailID,hash,password) values ("Amy","amy@gmail.com","$2y$10$EPX6FccSbXCXMjGhON1iFOPnVw8myJPcRyj4RnapNUI2X2RH7FezK","amypass");
INSERT INTO `users` (name,emailID,hash,password) values ("Bob","bob@gmail.com","$2y$10$cO8dvWjCq2Vt1HD7U34pJOyfy0bxIpDu7Ih8CRM0BU7bN5CdiQvda","bobpass");
INSERT INTO `users` (name,emailID,hash,password) values ("Charlie","charlie@gmail.com","$2y$10$PgWvHrT4ZSRfZ4fFA996R.OJelBQCtrJ30hJJtfsRHL4HXeGMvStW","charliepass");
INSERT INTO `users` (name,emailID,hash,password) values ("James","james@gmail.com","$2y$10$U4Di8GslOnORjeGXD.r2aeUF.qJxlY/0Bz9sEAILBs1ceYveraBZC","jamespass");
INSERT INTO `users` (name,emailID,hash,password) values ("Emi","emi@gmail.com","$2y$10$T8xQkk3C5seVjKec3qfJv.iX9y7xuD0HHj1WiQUWuuWuI12LAGSiW","emipass");
INSERT INTO `users` (name,emailID,hash,password) values ("Isabel","isabel@gmail.com","$2y$10$IG7kpcrWQ8cPRtywrpNFZOZnlRUf7l/jEjXTI4WmhEnUApKXgAYiq","isabel");


