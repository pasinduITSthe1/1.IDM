-- Migration: Add separate check-in and check-out tables
-- Date: 2025-10-15

-- Table for check-ins
CREATE TABLE IF NOT EXISTS check_ins (
  id VARCHAR(36) PRIMARY KEY,
  guest_id VARCHAR(36) NOT NULL,
  room_number VARCHAR(20) NOT NULL,
  check_in_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  expected_checkout_date DATE,
  checked_out BOOLEAN DEFAULT FALSE,
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (guest_id) REFERENCES guests(id) ON DELETE CASCADE,
  INDEX idx_guest_id (guest_id),
  INDEX idx_room_number (room_number),
  INDEX idx_check_in_date (check_in_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for check-outs
CREATE TABLE IF NOT EXISTS check_outs (
  id VARCHAR(36) PRIMARY KEY,
  check_in_id VARCHAR(36) NOT NULL,
  guest_id VARCHAR(36) NOT NULL,
  room_number VARCHAR(20) NOT NULL,
  check_out_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  total_amount DECIMAL(10, 2),
  payment_status ENUM('pending', 'paid', 'refunded') DEFAULT 'pending',
  payment_method VARCHAR(50),
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (check_in_id) REFERENCES check_ins(id) ON DELETE CASCADE,
  FOREIGN KEY (guest_id) REFERENCES guests(id) ON DELETE CASCADE,
  INDEX idx_guest_id (guest_id),
  INDEX idx_check_in_id (check_in_id),
  INDEX idx_check_out_date (check_out_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Update guests table to remove redundant columns (optional - keep for backward compatibility)
-- ALTER TABLE guests DROP COLUMN check_in_date;
-- ALTER TABLE guests DROP COLUMN check_out_date;
-- ALTER TABLE guests MODIFY COLUMN status ENUM('pending', 'active', 'completed', 'cancelled') DEFAULT 'pending';

-- Add comments for documentation
ALTER TABLE check_ins COMMENT = 'Records all guest check-ins with room assignments';

ALTER TABLE check_outs COMMENT = 'Records all guest check-outs with billing information';

-- Drop views if they exist (before creating them)
DROP VIEW IF EXISTS active_check_ins;

DROP VIEW IF EXISTS completed_stays;

-- Sample view for active check-ins (currently checked in guests)
CREATE VIEW active_check_ins AS
SELECT 
  ci.id,
  ci.guest_id,
  g.first_name,
  g.last_name,
  ci.room_number,
  ci.check_in_date,
  ci.expected_checkout_date,
  DATEDIFF(NOW(), ci.check_in_date) AS days_stayed
FROM check_ins ci
JOIN guests g ON ci.guest_id = g.id
WHERE ci.checked_out = FALSE
ORDER BY ci.check_in_date DESC;

-- Sample view for completed stays
CREATE VIEW completed_stays AS
SELECT 
  co.id,
  co.guest_id,
  g.first_name,
  g.last_name,
  co.room_number,
  ci.check_in_date,
  co.check_out_date,
  DATEDIFF(co.check_out_date, ci.check_in_date) AS total_days,
  co.total_amount,
  co.payment_status
FROM check_outs co
JOIN check_ins ci ON co.check_in_id = ci.id
JOIN guests g ON co.guest_id = g.id
ORDER BY co.check_out_date DESC;
