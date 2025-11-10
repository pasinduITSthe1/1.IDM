-- =========================================
-- Guest Attachments Table for Passport Scans
-- =========================================
-- This table stores the file paths and metadata for scanned passport/ID images
-- that are saved to Android local storage in the 1.IDM folder

CREATE TABLE IF NOT EXISTS guest_attachments (
    id INT(11) NOT NULL AUTO_INCREMENT,
    id_customer INT(11) NOT NULL COMMENT 'Reference to customer ID from qlo_customer table',
    attachment_type VARCHAR(50) NOT NULL COMMENT 'Type: id_front, id_back, passport',
    file_path VARCHAR(255) NOT NULL COMMENT 'Full path to image file on device',
    upload_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'When the image was uploaded',
    file_size INT(11) NULL COMMENT 'File size in bytes (optional)',
    file_name VARCHAR(255) NULL COMMENT 'Original filename (optional)',
    PRIMARY KEY (id),
    KEY idx_customer (id_customer),
    KEY idx_type (attachment_type),
    KEY idx_upload_date (upload_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores passport/ID image file paths and metadata';

-- =========================================
-- Sample Usage Queries
-- =========================================

-- Get all attachments for a specific customer
-- SELECT * FROM guest_attachments WHERE id_customer = 123;

-- Get only passport photos
-- SELECT * FROM guest_attachments WHERE attachment_type = 'passport';

-- Get recent uploads
-- SELECT * FROM guest_attachments ORDER BY upload_date DESC LIMIT 10;

-- Get customer info with their attachments
-- SELECT c.firstname, c.lastname, ga.attachment_type, ga.file_path, ga.upload_date
-- FROM qlo_customer c
-- JOIN guest_attachments ga ON c.id_customer = ga.id_customer
-- ORDER BY ga.upload_date DESC;

-- Count attachments by type
-- SELECT attachment_type, COUNT(*) as count 
-- FROM guest_attachments 
-- GROUP BY attachment_type;