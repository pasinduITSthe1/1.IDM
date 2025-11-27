/// Room Change Model
/// Represents a guest room change request/record

class RoomChange {
  final int id;
  final int bookingId;
  final int oldRoomId;
  final int newRoomId;
  final String oldRoomNum;
  final String newRoomNum;
  final String guestName;
  final String changeReason;
  final String changedBy;
  final DateTime changeDate;
  final DateTime checkInDate;
  final DateTime checkOutDate;
  final String status; // pending, completed, cancelled
  final String? notes;
  final DateTime createdAt;
  final DateTime? updatedAt;

  // Additional fields from JOIN
  final String? oldRoomNumber;
  final String? newRoomNumber;
  final int? idOrder;
  final int? idHotel;
  final DateTime? bookingCheckIn;
  final DateTime? bookingCheckOut;
  final int? totalNights;

  RoomChange({
    required this.id,
    required this.bookingId,
    required this.oldRoomId,
    required this.newRoomId,
    required this.oldRoomNum,
    required this.newRoomNum,
    required this.guestName,
    required this.changeReason,
    required this.changedBy,
    required this.changeDate,
    required this.checkInDate,
    required this.checkOutDate,
    required this.status,
    this.notes,
    required this.createdAt,
    this.updatedAt,
    this.oldRoomNumber,
    this.newRoomNumber,
    this.idOrder,
    this.idHotel,
    this.bookingCheckIn,
    this.bookingCheckOut,
    this.totalNights,
  });

  factory RoomChange.fromJson(Map<String, dynamic> json) {
    return RoomChange(
      id: int.parse(json['id'].toString()),
      bookingId: int.parse(json['booking_id'].toString()),
      oldRoomId: int.parse(json['old_room_id'].toString()),
      newRoomId: int.parse(json['new_room_id'].toString()),
      oldRoomNum: json['old_room_num'].toString(),
      newRoomNum: json['new_room_num'].toString(),
      guestName: json['guest_name'].toString(),
      changeReason: json['change_reason'].toString(),
      changedBy: json['changed_by'].toString(),
      changeDate: DateTime.parse(json['change_date'].toString()),
      checkInDate: DateTime.parse(json['check_in_date'].toString()),
      checkOutDate: DateTime.parse(json['check_out_date'].toString()),
      status: json['status'].toString(),
      notes: json['notes']?.toString(),
      createdAt: DateTime.parse(json['created_at'].toString()),
      updatedAt: json['updated_at'] != null
          ? DateTime.parse(json['updated_at'].toString())
          : null,
      oldRoomNumber: json['old_room_number']?.toString(),
      newRoomNumber: json['new_room_number']?.toString(),
      idOrder: json['id_order'] != null
          ? int.parse(json['id_order'].toString())
          : null,
      idHotel: json['id_hotel'] != null
          ? int.parse(json['id_hotel'].toString())
          : null,
      bookingCheckIn: json['booking_check_in'] != null
          ? DateTime.parse(json['booking_check_in'].toString())
          : null,
      bookingCheckOut: json['booking_check_out'] != null
          ? DateTime.parse(json['booking_check_out'].toString())
          : null,
      totalNights: json['total_nights'] != null
          ? int.parse(json['total_nights'].toString())
          : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'booking_id': bookingId,
      'old_room_id': oldRoomId,
      'new_room_id': newRoomId,
      'old_room_num': oldRoomNum,
      'new_room_num': newRoomNum,
      'guest_name': guestName,
      'change_reason': changeReason,
      'changed_by': changedBy,
      'change_date': changeDate.toIso8601String(),
      'check_in_date': checkInDate.toIso8601String(),
      'check_out_date': checkOutDate.toIso8601String(),
      'status': status,
      'notes': notes,
      'created_at': createdAt.toIso8601String(),
      'updated_at': updatedAt?.toIso8601String(),
    };
  }

  // Status helpers
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
        return status;
    }
  }

  String get statusColor {
    switch (status) {
      case 'pending':
        return '#FFA500'; // Orange
      case 'completed':
        return '#4CAF50'; // Green
      case 'cancelled':
        return '#F44336'; // Red
      default:
        return '#9E9E9E'; // Grey
    }
  }
}

/// Room Change Request Model (for creating new room changes)
class RoomChangeRequest {
  final int bookingId;
  final int oldRoomId;
  final int newRoomId;
  final String guestName;
  final String changeReason;
  final String changedBy;
  final String status;
  final String? notes;

  RoomChangeRequest({
    required this.bookingId,
    required this.oldRoomId,
    required this.newRoomId,
    required this.guestName,
    required this.changeReason,
    required this.changedBy,
    this.status = 'pending',
    this.notes,
  });

  Map<String, dynamic> toJson() {
    return {
      'action': 'create',
      'booking_id': bookingId,
      'old_room_id': oldRoomId,
      'new_room_id': newRoomId,
      'guest_name': guestName,
      'change_reason': changeReason,
      'changed_by': changedBy,
      'status': status,
      'notes': notes,
    };
  }
}

/// Occupied Room Model (for room selection)
class OccupiedRoom {
  final int bookingId;
  final int idRoom;
  final int idHotel;
  final DateTime dateFrom;
  final DateTime dateTo;
  final int adults;
  final int children;
  final String roomNum;
  final String? floor;
  final String? roomType;
  final String? hotelName;
  final int? idCustomer;
  final String guestName;
  final String? guestEmail;

  OccupiedRoom({
    required this.bookingId,
    required this.idRoom,
    required this.idHotel,
    required this.dateFrom,
    required this.dateTo,
    required this.adults,
    required this.children,
    required this.roomNum,
    this.floor,
    this.roomType,
    this.hotelName,
    this.idCustomer,
    required this.guestName,
    this.guestEmail,
  });

  factory OccupiedRoom.fromJson(Map<String, dynamic> json) {
    return OccupiedRoom(
      bookingId: int.parse(json['booking_id'].toString()),
      idRoom: int.parse(json['id_room'].toString()),
      idHotel: int.parse(json['id_hotel'].toString()),
      dateFrom: DateTime.parse(json['date_from'].toString()),
      dateTo: DateTime.parse(json['date_to'].toString()),
      adults: int.parse(json['adults'].toString()),
      children: int.parse(json['children'].toString()),
      roomNum: json['room_num'].toString(),
      floor: json['floor']?.toString(),
      roomType: json['room_type']?.toString(),
      hotelName: json['hotel_name']?.toString(),
      idCustomer: json['id_customer'] != null
          ? int.parse(json['id_customer'].toString())
          : null,
      guestName: json['guest_name'].toString(),
      guestEmail: json['guest_email']?.toString(),
    );
  }
}

/// Available Room Model (for target room selection)
class AvailableRoom {
  final int id;
  final int idProduct;
  final int idHotel;
  final String roomNum;
  final String? floor;
  final String? roomType;
  final String? hotelName;
  final int roomStatus;

  AvailableRoom({
    required this.id,
    required this.idProduct,
    required this.idHotel,
    required this.roomNum,
    this.floor,
    this.roomType,
    this.hotelName,
    required this.roomStatus,
  });

  factory AvailableRoom.fromJson(Map<String, dynamic> json) {
    return AvailableRoom(
      id: int.parse(json['id'].toString()),
      idProduct: int.parse(json['id_product'].toString()),
      idHotel: int.parse(json['id_hotel'].toString()),
      roomNum: json['room_num'].toString(),
      floor: json['floor']?.toString(),
      roomType: json['room_type']?.toString(),
      hotelName: json['hotel_name']?.toString(),
      roomStatus: int.parse(json['room_status'].toString()),
    );
  }
}

/// Room Change Statistics Model
class RoomChangeStatistics {
  final int totalChanges;
  final int pendingChanges;
  final int completedChanges;
  final int cancelledChanges;
  final int todayChanges;
  final int weekChanges;
  final int monthChanges;

  RoomChangeStatistics({
    required this.totalChanges,
    required this.pendingChanges,
    required this.completedChanges,
    required this.cancelledChanges,
    required this.todayChanges,
    required this.weekChanges,
    required this.monthChanges,
  });

  factory RoomChangeStatistics.fromJson(Map<String, dynamic> json) {
    return RoomChangeStatistics(
      totalChanges: int.parse(json['total_changes'].toString()),
      pendingChanges: int.parse(json['pending_changes'].toString()),
      completedChanges: int.parse(json['completed_changes'].toString()),
      cancelledChanges: int.parse(json['cancelled_changes'].toString()),
      todayChanges: int.parse(json['today_changes'].toString()),
      weekChanges: int.parse(json['week_changes'].toString()),
      monthChanges: int.parse(json['month_changes'].toString()),
    );
  }
}
