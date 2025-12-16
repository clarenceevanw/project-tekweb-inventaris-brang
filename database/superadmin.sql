
CREATE TABLE IF NOT EXISTS `superadmin` (
  `id_superadmin` CHAR(36) PRIMARY KEY DEFAULT (UUID()),
  `nama_superadmin` varchar(100) NOT NULL,
  `email_superadmin` varchar(100) NOT NULL UNIQUE,
  `telepon` varchar(20) DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_superadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `superadmin` (`nama_superadmin`, `email_superadmin`) 
VALUES ('Super Admin', 'c14240069@john.petra.ac.id');

