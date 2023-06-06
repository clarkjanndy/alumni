CREATE TABLE `batch_officers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch` int DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `alumnus_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
