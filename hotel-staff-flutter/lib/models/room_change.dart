class RoomChange {
  final int id;
  final int bookingId;
  final String guestName;
  final int oldRoomId;
  final String oldRoomNum;
  final int newRoomId;
  final String newRoomNum;
  final String changeReason;
  final String changedBy;
  final String changeDate;
  final String checkInDate;
  final String checkOutDate;
  final String status;
  final String? notes;
  final String? oldRoomNumber;
  final String? oldRoomFloor;
  final String? oldHotelName;
  final String? oldRoomType;
  final String? newRoomNumber;
  final String? newRoomFloor;
  final String? newHotelName;
  final String? newRoomType;
  final String createdAt;
  final String updatedAt;

  RoomChange({
    required this.id,
    required this.bookingId,
    required this.guestName,
    required this.oldRoomId,
    required this.oldRoomNum,
    required this.newRoomId,
    required this.newRoomNum,
    required this.changeReason,
    required this.changedBy,
    required this.changeDate,
    required this.checkInDate,
    required this.checkOutDate,
    required this.status,
    this.notes,
    this.oldRoomNumber,
    this.oldRoomFloor,
    this.oldHotelName,
    this.oldRoomType,
    this.newRoomNumber,
    this.newRoomFloor,
    this.newHotelName,
    this.newRoomType,
    required this.createdAt,
    required this.updatedAt,
  });

  factory RoomChange.fromJson(Map<String, dynamic> json) {
    return RoomChange(
      id: int.parse(json['id'].toString()),
      bookingId: int.parse(json['booking_id'].toString()),
      guestName: json['guest_name'].toString(),
      oldRoomId: int.parse(json['old_room_id'].toString()),
      oldRoomNum: json['old_room_num'].toString(),
      newRoomId: int.parse(json['new_room_id'].toString()),
      newRoomNum: json['new_room_num'].toString(),
      changeReason: json['change_reason'].toString(),
      changedBy: json['changed_by'].toString(),
      changeDate: json['change_date'].toString(),
      checkInDate: json['check_in_date'].toString(),
      checkOutDate: json['check_out_date'].toString(),
      status: json['status'].toString(),
      notes: json['notes']?.toString(),
      oldRoomNumber: json['old_room_number']?.toString(),
      oldRoomFloor: json['old_room_floor']?.toString(),
      oldHotelName: json['old_hotel_name']?.toString(),
      oldRoomType: json['old_room_type']?.toString(),
      newRoomNumber: json['new_room_number']?.toString(),
      newRoomFloor: json['new_room_floor']?.toString(),
      newHotelName: json['new_hotel_name']?.toString(),
      newRoomType: json['new_room_type']?.toString(),
      createdAt: json['created_at'].toString(),
      updatedAt: json['updated_at'].toString(),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'booking_id': bookingId,
      'guest_name': guestName,
      'old_room_id': oldRoomId,
      'old_room_num': oldRoomNum,
      'new_room_id': newRoomId,
      'new_room_num': newRoomNum,
      'change_reason': changeReason,
      'changed_by': changedBy,
      'change_date': changeDate,
      'check_in_date': checkInDate,
      'check_out_date': checkOutDate,
      'status': status,
      'notes': notes,
      'old_room_number': oldRoomNumber,
      'old_room_floor': oldRoomFloor,
      'old_hotel_name': oldHotelName,
      'old_room_type': oldRoomType,
      'new_room_number': newRoomNumber,
      'new_room_floor': newRoomFloor,
      'new_hotel_name': newHotelName,
      'new_room_type': newRoomType,
      'created_at': createdAt,
      'updated_at': updatedAt,
    };
  }

  // Helper getters
  bool get isPending => status == 'pending';
  bool get isCompleted => status == 'completed';
  bool get isCancelled => status == 'cancelled';

  String get statusDisplayName {
    switch (status) {
      case 'pending':
        return 'Pending';
      case 'completed':
        return 'Completed';
      case 'cancelled':
        return 'Cancelled';
      default:
        return 'Unknown';
    }
  }

  String get statusColor {
    switch (status) {
      case 'pending':
        return '#ffc107'; // Yellow
      case 'completed':
        return '#28a745'; // Green
      case 'cancelled':
        return '#dc3545'; // Red
      default:
        return '#6c757d'; // Gray
    }
  }

  /// Create a copy with updated fields
  RoomChange copyWith({
    int? id,
    int? bookingId,
    String? guestName,
    int? oldRoomId,
    String? oldRoomNum,
    int? newRoomId,
    String? newRoomNum,
    String? changeReason,
    String? changedBy,
    String? changeDate,
    String? checkInDate,
    String? checkOutDate,
    String? status,
    String? notes,
    String? oldRoomNumber,
    String? oldRoomFloor,
    String? oldHotelName,
    String? oldRoomType,
    String? newRoomNumber,
    String? newRoomFloor,
    String? newHotelName,
    String? newRoomType,
    String? createdAt,
    String? updatedAt,
  }) {
    return RoomChange(
      id: id ?? this.id,
      bookingId: bookingId ?? this.bookingId,
      guestName: guestName ?? this.guestName,
      oldRoomId: oldRoomId ?? this.oldRoomId,
      oldRoomNum: oldRoomNum ?? this.oldRoomNum,
      newRoomId: newRoomId ?? this.newRoomId,
      newRoomNum: newRoomNum ?? this.newRoomNum,
      changeReason: changeReason ?? this.changeReason,
      changedBy: changedBy ?? this.changedBy,
      changeDate: changeDate ?? this.changeDate,
      checkInDate: checkInDate ?? this.checkInDate,
      checkOutDate: checkOutDate ?? this.checkOutDate,
      status: status ?? this.status,
      notes: notes ?? this.notes,
      oldRoomNumber: oldRoomNumber ?? this.oldRoomNumber,
      oldRoomFloor: oldRoomFloor ?? this.oldRoomFloor,
      oldHotelName: oldHotelName ?? this.oldHotelName,
      oldRoomType: oldRoomType ?? this.oldRoomType,
      newRoomNumber: newRoomNumber ?? this.newRoomNumber,
      newRoomFloor: newRoomFloor ?? this.newRoomFloor,
      newHotelName: newHotelName ?? this.newHotelName,
      newRoomType: newRoomType ?? this.newRoomType,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
    );
  }
}

/// Model for creating a new room change request
class RoomChangeRequest {
  final int bookingId;
  final String guestName;
  final int oldRoomId;
  final String oldRoomNum;
  final int newRoomId;
  final String newRoomNum;
  final String changeReason;
  final String changedBy;
  final String checkInDate;
  final String checkOutDate;
  final String? notes;
  final String status;

  RoomChangeRequest({
    required this.bookingId,
    required this.guestName,
    required this.oldRoomId,
    required this.oldRoomNum,
    required this.newRoomId,
    required this.newRoomNum,
    required this.changeReason,
    required this.changedBy,
    required this.checkInDate,
    required this.checkOutDate,
    this.notes,
    this.status = 'pending',
  });

  Map<String, dynamic> toJson() {
    return {
      'action': 'create',
      'booking_id': bookingId,
      'guest_name': guestName,
      'old_room_id': oldRoomId,
      'old_room_num': oldRoomNum,
      'new_room_id': newRoomId,
      'new_room_num': newRoomNum,
      'change_reason': changeReason,
      'changed_by': changedBy,
      'check_in_date': checkInDate,
      'check_out_date': checkOutDate,
      'notes': notes,
      'status': status,
    };
  }
}

/// Room change statistics model
class RoomChangeStatistics {
  final int totalChanges;
  final int pendingChanges;
  final int completedChanges;
  final int cancelledChanges;

  RoomChangeStatistics({
    required this.totalChanges,
    required this.pendingChanges,
    required this.completedChanges,
    required this.cancelledChanges,
  });

  factory RoomChangeStatistics.fromJson(Map<String, dynamic> json) {
    return RoomChangeStatistics(
      totalChanges: int.parse(json['total_changes'].toString()),
      pendingChanges: int.parse(json['pending_changes'].toString()),
      completedChanges: int.parse(json['completed_changes'].toString()),
      cancelledChanges: int.parse(json['cancelled_changes'].toString()),
    );
  }

  double get completionRate {
    return totalChanges > 0 ? (completedChanges / totalChanges) * 100 : 0;
  }
}
