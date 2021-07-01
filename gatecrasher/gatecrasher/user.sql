CREATE DATABASE if not exists dmbs335 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use dmbs335;
CREATE TABLE if not exists user (
	no INT AUTO_INCREMENT,
	id VARCHAR(20),
	pw VARCHAR(20),
	ip VARCHAR(20),
	restrict_ip BOOL,
	PRIMARY KEY (no)
);
INSERT INTO `dmbs335`.`user` values (0,'admin','y0uc4n7f1nd0uTP477WD','127.0.0.1',FALSE);