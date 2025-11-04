class Escort {
  final String id;
  final String guestId; // Reference to the main guest (id_customer)
  final String firstName;
  final String lastName;
  final String? documentNumber;
  final String? dateOfBirth;
  final String? nationality;
  final String? sex;
  final String? email;
  final String? phone;
  final String? address;
  final String? documentType; // passport, id_card, driver_license
  final String? issuedCountry;
  final String? issuedDate;
  final String? expiryDate;
  final String?
      relationshipToGuest; // companion, family, friend, business_associate
  final DateTime createdAt;

  Escort({
    required this.id,
    required this.guestId,
    required this.firstName,
    required this.lastName,
    this.documentNumber,
    this.dateOfBirth,
    this.nationality,
    this.sex,
    this.email,
    this.phone,
    this.address,
    this.documentType,
    this.issuedCountry,
    this.issuedDate,
    this.expiryDate,
    this.relationshipToGuest,
    DateTime? createdAt,
  }) : createdAt = createdAt ?? DateTime.now();

  // Create a copy with updated fields
  Escort copyWith({
    String? id,
    String? guestId,
    String? firstName,
    String? lastName,
    String? documentNumber,
    String? dateOfBirth,
    String? nationality,
    String? sex,
    String? email,
    String? phone,
    String? address,
    String? documentType,
    String? issuedCountry,
    String? issuedDate,
    String? expiryDate,
    String? relationshipToGuest,
  }) {
    return Escort(
      id: id ?? this.id,
      guestId: guestId ?? this.guestId,
      firstName: firstName ?? this.firstName,
      lastName: lastName ?? this.lastName,
      documentNumber: documentNumber ?? this.documentNumber,
      dateOfBirth: dateOfBirth ?? this.dateOfBirth,
      nationality: nationality ?? this.nationality,
      sex: sex ?? this.sex,
      email: email ?? this.email,
      phone: phone ?? this.phone,
      address: address ?? this.address,
      documentType: documentType ?? this.documentType,
      issuedCountry: issuedCountry ?? this.issuedCountry,
      issuedDate: issuedDate ?? this.issuedDate,
      expiryDate: expiryDate ?? this.expiryDate,
      relationshipToGuest: relationshipToGuest ?? this.relationshipToGuest,
      createdAt: createdAt,
    );
  }

  // Convert to JSON
  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'guestId': guestId,
      'firstName': firstName,
      'lastName': lastName,
      'documentNumber': documentNumber,
      'dateOfBirth': dateOfBirth,
      'nationality': nationality,
      'sex': sex,
      'email': email,
      'phone': phone,
      'address': address,
      'documentType': documentType,
      'issuedCountry': issuedCountry,
      'issuedDate': issuedDate,
      'expiryDate': expiryDate,
      'relationshipToGuest': relationshipToGuest,
      'createdAt': createdAt.toIso8601String(),
    };
  }

  // Create from JSON (local storage format - camelCase)
  factory Escort.fromJson(Map<String, dynamic> json) {
    return Escort(
      id: json['id'] as String,
      guestId: json['guestId'] as String,
      firstName: json['firstName'] as String,
      lastName: json['lastName'] as String,
      documentNumber: json['documentNumber'] as String?,
      dateOfBirth: json['dateOfBirth'] as String?,
      nationality: json['nationality'] as String?,
      sex: json['sex'] as String?,
      email: json['email'] as String?,
      phone: json['phone'] as String?,
      address: json['address'] as String?,
      documentType: json['documentType'] as String?,
      issuedCountry: json['issuedCountry'] as String?,
      issuedDate: json['issuedDate'] as String?,
      expiryDate: json['expiryDate'] as String?,
      relationshipToGuest: json['relationshipToGuest'] as String?,
      createdAt: json['createdAt'] != null
          ? DateTime.parse(json['createdAt'] as String)
          : DateTime.now(),
    );
  }

  // Create from API JSON (API format - snake_case)
  factory Escort.fromApiJson(Map<String, dynamic> json) {
    return Escort(
      id: json['id']?.toString() ?? '',
      guestId:
          json['id_customer']?.toString() ?? json['guest_id']?.toString() ?? '',
      firstName:
          json['first_name']?.toString() ?? json['firstname']?.toString() ?? '',
      lastName:
          json['last_name']?.toString() ?? json['lastname']?.toString() ?? '',
      documentNumber: json['document_number'] as String?,
      dateOfBirth: json['date_of_birth'] as String?,
      nationality: json['nationality'] as String?,
      sex: json['sex'] as String?,
      email: json['email'] as String?,
      phone: json['phone'] as String?,
      address: json['address'] as String?,
      documentType: json['document_type'] as String?,
      issuedCountry: json['issued_country'] as String?,
      issuedDate: json['issued_date'] as String?,
      expiryDate: json['expiry_date'] as String?,
      relationshipToGuest: json['relationship_to_guest'] as String?,
      createdAt: json['created_at'] != null
          ? DateTime.parse(json['created_at'] as String)
          : DateTime.now(),
    );
  }

  // Convert to API JSON (snake_case)
  Map<String, dynamic> toApiJson() {
    return {
      'id_customer': guestId,
      'first_name': firstName,
      'last_name': lastName,
      'document_number': documentNumber,
      'date_of_birth': dateOfBirth,
      'nationality': nationality,
      'sex': sex,
      'email': email,
      'phone': phone,
      'address': address,
      'document_type': documentType,
      'issued_country': issuedCountry,
      'issued_date': issuedDate,
      'expiry_date': expiryDate,
      'relationship_to_guest': relationshipToGuest,
    };
  }

  // Get full name
  String get fullName => '$firstName $lastName';
}
