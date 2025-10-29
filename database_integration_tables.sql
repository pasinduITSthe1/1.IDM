-- Guest Documents
CREATE TABLE IF NOT EXISTS guest_documents (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  document_type VARCHAR(50),
  document_number VARCHAR(100),
  expiry_date DATE,
  country_issued VARCHAR(100),
  attachment_path VARCHAR(255),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

-- Guest Attachments (Photos)
CREATE TABLE IF NOT EXISTS guest_attachments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  attachment_type VARCHAR(50),
  file_path VARCHAR(255),
  upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

-- Check-in Records
CREATE TABLE IF NOT EXISTS guest_checkins (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_booking INT,
  id_room INT,
  room_number VARCHAR(10),
  check_in_time DATETIME,
  check_in_method VARCHAR(50),
  checked_in_by VARCHAR(100),
  notes TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

-- Check-out Records
CREATE TABLE IF NOT EXISTS guest_checkouts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_checkin INT,
  id_room INT,
  check_out_time DATETIME,
  check_out_method VARCHAR(50),
  checked_out_by VARCHAR(100),
  final_bill DECIMAL(20,6),
  payment_status VARCHAR(50),
  notes TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer),
  FOREIGN KEY (id_checkin) REFERENCES guest_checkins(id)
);

-- Room Assignments
CREATE TABLE IF NOT EXISTS room_assignments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_room INT,
  id_booking INT,
  assignment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  release_date DATETIME,
  status VARCHAR(50),
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

-- Guest Payments
CREATE TABLE IF NOT EXISTS guest_payments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_order INT,
  id_checkin INT,
  payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  amount DECIMAL(20,6),
  payment_method VARCHAR(50),
  payment_status VARCHAR(50),
  reference_number VARCHAR(100),
  notes TEXT,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

-- Guest Services (Additional charges)
CREATE TABLE IF NOT EXISTS guest_services (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_checkin INT,
  service_type VARCHAR(50),
  service_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  charge DECIMAL(20,6),
  status VARCHAR(50),
  notes TEXT,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

-- Audit Log
CREATE TABLE IF NOT EXISTS guest_logs (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  action_type VARCHAR(50),
  action_description TEXT,
  performed_by VARCHAR(100),
  performed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);
