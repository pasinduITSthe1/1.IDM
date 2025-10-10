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
      'createdAt': createdAt.toIso8601String(),
    };
  }

  // Create from JSON
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
      createdAt: json['createdAt'] != null
          ? DateTime.parse(json['createdAt'] as String)
          : DateTime.now(),
    );
  }

  // Get full name
  String get fullName => '$firstName $lastName';
}
