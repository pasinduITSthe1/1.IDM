-- Guest Escorts/Companions Table
-- Stores information about people accompanying guests
CREATE TABLE IF NOT EXISTS guest_escorts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT UNSIGNED NOT NULL COMMENT 'Reference to main guest in qlo_customer table',
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  document_type VARCHAR(50) COMMENT 'passport, id_card, visa, driver_license',
  document_number VARCHAR(100),
  date_of_birth DATE,
  nationality VARCHAR(100),
  sex CHAR(1) COMMENT 'M or F',
  email VARCHAR(255),
  phone VARCHAR(50),
  address TEXT,
  issued_country VARCHAR(100),
  issued_date DATE,
  expiry_date DATE,
  relationship_to_guest VARCHAR(50) COMMENT 'companion, family, friend, business_associate, other',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer) ON DELETE CASCADE,
  INDEX idx_customer (id_customer),
  INDEX idx_document (document_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Stores escort/companion information for guests';

-- Escort Attachments (Photos)
CREATE TABLE IF NOT EXISTS escort_attachments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_escort INT NOT NULL,
  attachment_type VARCHAR(50) COMMENT 'document_front, document_back, profile_photo',
  file_path VARCHAR(255),
  upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_escort) REFERENCES guest_escorts(id) ON DELETE CASCADE,
  INDEX idx_escort (id_escort)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Stores photo/document attachments for escorts';
