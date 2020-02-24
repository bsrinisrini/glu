
DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `jobId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `submitterId` int(11) DEFAULT NULL,
  `processorId` int(11) DEFAULT NULL,
  `command` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`jobId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;

INSERT INTO `jobs` (`jobId`, `submitterId`, `processorId`, `command`, `status`)
VALUES
	(1,1000,2000,'process()',2),
	(2,1001,101,'exec',2),
	(3,100,NULL,'exec',1),
	(4,100,NULL,'exec',1);

/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jobs_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs_status`;

CREATE TABLE `jobs_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `jobs_status` WRITE;
/*!40000 ALTER TABLE `jobs_status` DISABLE KEYS */;

INSERT INTO `jobs_status` (`id`, `name`)
VALUES
	(1,'Added'),
	(2,'Processing'),
	(3,'Finished'),
	(4,'Failed');

/*!40000 ALTER TABLE `jobs_status` ENABLE KEYS */;
UNLOCK TABLES;
