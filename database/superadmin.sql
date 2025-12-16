DROP TABLE IF EXISTS superadmin;

CREATE TABLE IF NOT EXISTS `superadmin` (
  `id_superadmin` CHAR(36) PRIMARY KEY DEFAULT (UUID()),
  `nama_superadmin` varchar(100) NOT NULL,
  `email_superadmin` varchar(100) NOT NULL UNIQUE,
  `telepon` varchar(20) DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `superadmin` (`nama_superadmin`, `email_superadmin`) 
VALUES ('Super Admin 1', 'c14240053@john.petra.ac.id'),
('Super Admin 2', 'c14240069@john.petra.ac.id'),
('Super Admin 3', 'c14240075@john.petra.ac.id'),
('Super Admin 4', 'c14240085@john.petra.ac.id'),
('Super Admin 5', 'c14240128@john.petra.ac.id');

