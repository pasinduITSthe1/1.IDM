class Guest {
  final String id;
  final String firstName;
  final String lastName;
  final String? documentNumber;
  final String? dateOfBirth;
  final String? nationality;
  final String? sex;
  final String? email;
  final String? phone;
  final String? address;
  final String status; // pending, checked_in, checked_out
  final DateTime? checkInDate;
  final DateTime? checkOutDate;
  final String? roomNumber;
  final String? documentType; // passport, id_card, driver_license
  final String? issuedCountry;
  final String? issuedDate;
  final String? expiryDate;
  final String? visitPurpose;
  final DateTime createdAt;

  Guest({
    required this.id,
    required this.firstName,
    required this.lastName,
    this.documentNumber,
    this.dateOfBirth,
    this.nationality,
    this.sex,
    this.email,
    this.phone,
    this.address,
    this.status = 'pending',
    this.checkInDate,
    this.checkOutDate,
    this.roomNumber,
    this.documentType,
    this.issuedCountry,
    this.issuedDate,
    this.expiryDate,
    this.visitPurpose,
    DateTime? createdAt,
  }) : createdAt = createdAt ?? DateTime.now();

  // Create a copy with updated fields
  Guest copyWith({
    String? id,
    String? firstName,
    String? lastName,
    String? documentNumber,
    String? dateOfBirth,
    String? nationality,
    String? sex,
    String? email,
    String? phone,
    String? address,
    String? status,
    DateTime? checkInDate,
    DateTime? checkOutDate,
    String? roomNumber,
    String? documentType,
    String? issuedCountry,
    String? issuedDate,
    String? expiryDate,
    String? visitPurpose,
  }) {
    return Guest(
      id: id ?? this.id,
      firstName: firstName ?? this.firstName,
      lastName: lastName ?? this.lastName,
      documentNumber: documentNumber ?? this.documentNumber,
      dateOfBirth: dateOfBirth ?? this.dateOfBirth,
      nationality: nationality ?? this.nationality,
      sex: sex ?? this.sex,
      email: email ?? this.email,
      phone: phone ?? this.phone,
      address: address ?? this.address,
      status: status ?? this.status,
      checkInDate: checkInDate ?? this.checkInDate,
      checkOutDate: checkOutDate ?? this.checkOutDate,
      roomNumber: roomNumber ?? this.roomNumber,
      documentType: documentType ?? this.documentType,
      issuedCountry: issuedCountry ?? this.issuedCountry,
      issuedDate: issuedDate ?? this.issuedDate,
      expiryDate: expiryDate ?? this.expiryDate,
      visitPurpose: visitPurpose ?? this.visitPurpose,
      createdAt: createdAt,
    );
  }

  // Convert to JSON
  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'firstName': firstName,
      'lastName': lastName,
      'documentNumber': documentNumber,
      'dateOfBirth': dateOfBirth,
      'nationality': nationality,
      'sex': sex,
      'email': email,
      'phone': phone,
      'address': address,
      'status': status,
      'checkInDate': checkInDate?.toIso8601String(),
      'checkOutDate': checkOutDate?.toIso8601String(),
      'roomNumber': roomNumber,
      'documentType': documentType,
      'issuedCountry': issuedCountry,
      'issuedDate': issuedDate,
      'expiryDate': expiryDate,
      'visitPurpose': visitPurpose,
      'createdAt': createdAt.toIso8601String(),
    };
  }

  // Create from JSON (local storage format - camelCase)
  factory Guest.fromJson(Map<String, dynamic> json) {
    return Guest(
      id: json['id'] as String,
      firstName: json['firstName'] as String,
      lastName: json['lastName'] as String,
      documentNumber: json['documentNumber'] as String?,
      dateOfBirth: json['dateOfBirth'] as String?,
      nationality: json['nationality'] as String?,
      sex: json['sex'] as String?,
      email: json['email'] as String?,
      phone: json['phone'] as String?,
      address: json['address'] as String?,
      status: json['status'] as String? ?? 'pending',
      checkInDate: json['checkInDate'] != null
          ? DateTime.parse(json['checkInDate'] as String)
          : null,
      checkOutDate: json['checkOutDate'] != null
          ? DateTime.parse(json['checkOutDate'] as String)
          : null,
      roomNumber: json['roomNumber'] as String?,
      documentType: json['documentType'] as String?,
      issuedCountry: json['issuedCountry'] as String?,
      issuedDate: json['issuedDate'] as String?,
      expiryDate: json['expiryDate'] as String?,
      visitPurpose: json['visitPurpose'] as String?,
      createdAt: json['createdAt'] != null
          ? DateTime.parse(json['createdAt'] as String)
          : DateTime.now(),
    );
  }

  // Create from API JSON (API format - snake_case)
  factory Guest.fromApiJson(Map<String, dynamic> json) {
    return Guest(
      id: (json['id_customer'] ?? json['id'])
          .toString(), // Use id_customer from qlo_customer table
      firstName: json['first_name'] ?? json['firstname'] ?? '',
      lastName: json['last_name'] ?? json['lastname'] ?? '',
      documentNumber: json['document_number'] as String?,
      dateOfBirth: json['date_of_birth'] as String?,
      nationality: json['nationality'] as String?,
      sex: json['sex'] as String?,
      email: json['email'] as String?,
      phone: json['phone'] as String?,
      address: json['address'] as String?,
      status: json['status'] as String? ?? 'pending',
      checkInDate: json['check_in_date'] != null
          ? DateTime.parse(json['check_in_date'] as String)
          : null,
      checkOutDate: json['check_out_date'] != null
          ? DateTime.parse(json['check_out_date'] as String)
          : null,
      roomNumber: json['room_number'] as String?,
      documentType: json['document_type'] as String?,
      issuedCountry: json['issued_country'] as String?,
      issuedDate: json['issued_date'] as String?,
      expiryDate: json['expiry_date'] as String?,
      visitPurpose: json['visit_purpose'] as String?,
      createdAt: json['created_at'] != null
          ? DateTime.parse(json['created_at'] as String)
          : DateTime.now(),
    );
  }

  // Get full name
  String get fullName => '$firstName $lastName';
}
