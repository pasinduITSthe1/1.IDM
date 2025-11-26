-- Room Change Table
-- Tracks guest room changes when they need to be moved from one room to another

CREATE TABLE IF NOT EXISTS roomchange (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL COMMENT 'Reference to htl_booking_detail.id',
    guest_name VARCHAR(255) NOT NULL COMMENT 'Guest full name',
    old_room_id INT NOT NULL COMMENT 'Previous room ID from htl_room_information',
    old_room_num VARCHAR(50) NOT NULL COMMENT 'Previous room number',
    new_room_id INT NOT NULL COMMENT 'New room ID from htl_room_information',
    new_room_num VARCHAR(50) NOT NULL COMMENT 'New room number',
    change_reason TEXT NOT NULL COMMENT 'Reason for room change',
    changed_by VARCHAR(100) NOT NULL COMMENT 'Staff member who made the change',
    change_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'When the change was made',
    check_in_date DATE NOT NULL COMMENT 'Guest check-in date',
    check_out_date DATE NOT NULL COMMENT 'Guest check-out date',
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending' COMMENT 'Status of room change',
    notes TEXT COMMENT 'Additional notes about the change',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_booking_id (booking_id),
    INDEX idx_old_room (old_room_id),
    INDEX idx_new_room (new_room_id),
    INDEX idx_change_date (change_date),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Guest room change tracking';

-- Add foreign key constraints (optional, depending on your database structure)
-- ALTER TABLE roomchange ADD CONSTRAINT fk_old_room FOREIGN KEY (old_room_id) REFERENCES htl_room_information(id) ON DELETE RESTRICT;
-- ALTER TABLE roomchange ADD CONSTRAINT fk_new_room FOREIGN KEY (new_room_id) REFERENCES htl_room_information(id) ON DELETE RESTRICT;
