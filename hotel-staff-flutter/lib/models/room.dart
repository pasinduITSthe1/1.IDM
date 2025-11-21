class Room {
  final int id;
  final int idProduct;
  final int idHotel;
  final String roomNum;
  final int roomStatus;
  final String? comment;
  final String? floor;
  final String hotelName;
  final String? hotelPhone;
  final int roomTypeId;
  final String roomTypeName;
  final String? description;
  final int isOccupied;
  final String? guestName;
  final String? checkInDate;
  final String? checkOutDate;
  final int? bookingId;
  final String currentStatus;
  final String statusColor;
  final List<String> features;

  Room({
    required this.id,
    required this.idProduct,
    required this.idHotel,
    required this.roomNum,
    required this.roomStatus,
    this.comment,
    this.floor,
    required this.hotelName,
    this.hotelPhone,
    required this.roomTypeId,
    required this.roomTypeName,
    this.description,
    required this.isOccupied,
    this.guestName,
    this.checkInDate,
    this.checkOutDate,
    this.bookingId,
    required this.currentStatus,
    required this.statusColor,
    this.features = const [],
  });

  factory Room.fromJson(Map<String, dynamic> json) {
    return Room(
      id: int.parse(json['id'].toString()),
      idProduct: int.parse(json['id_product'].toString()),
      idHotel: int.parse(json['id_hotel'].toString()),
      roomNum: json['room_num'].toString(),
      roomStatus: int.parse(json['room_status'].toString()),
      comment: json['comment']?.toString(),
      floor: json['floor']?.toString(),
      hotelName: json['hotel_name'].toString(),
      hotelPhone: json['hotel_phone']?.toString(),
      roomTypeId: int.parse(json['room_type_id'].toString()),
      roomTypeName: json['room_type_name'].toString(),
      description: json['description']?.toString(),
      isOccupied: int.parse(json['is_occupied'].toString()),
      guestName: json['guest_name']?.toString(),
      checkInDate: json['check_in_date']?.toString(),
      checkOutDate: json['check_out_date']?.toString(),
      bookingId: json['booking_id'] != null
          ? int.parse(json['booking_id'].toString())
          : null,
      currentStatus: json['current_status'].toString(),
      statusColor: json['status_color'].toString(),
      features: json['features'] != null
          ? List<String>.from(json['features'].map((f) => f.toString()))
          : [],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'id_product': idProduct,
      'id_hotel': idHotel,
      'room_num': roomNum,
      'room_status': roomStatus,
      'comment': comment,
      'floor': floor,
      'hotel_name': hotelName,
      'hotel_phone': hotelPhone,
      'room_type_id': roomTypeId,
      'room_type_name': roomTypeName,
      'description': description,
      'is_occupied': isOccupied,
      'guest_name': guestName,
      'check_in_date': checkInDate,
      'check_out_date': checkOutDate,
      'booking_id': bookingId,
      'current_status': currentStatus,
      'status_color': statusColor,
      'features': features,
    };
  }

  // Helper methods
  bool get isAvailable => currentStatus == 'available';
  bool get isOccupiedStatus => currentStatus == 'occupied';
  bool get isCleaning => currentStatus == 'cleaning';
  bool get isInMaintenance => currentStatus == 'maintenance';

  String get statusDisplayName {
    switch (currentStatus) {
      case 'available':
        return 'Available';
      case 'occupied':
        return 'Occupied';
      case 'cleaning':
        return 'Cleaning';
      case 'maintenance':
        return 'Maintenance';
      default:
        return 'Unknown';
    }
  }

  /// Create a copy of Room with updated fields
  Room copyWith({
    int? id,
    int? idProduct,
    int? idHotel,
    String? roomNum,
    int? roomStatus,
    String? comment,
    String? floor,
    String? hotelName,
    String? hotelPhone,
    int? roomTypeId,
    String? roomTypeName,
    String? description,
    int? isOccupied,
    String? guestName,
    String? checkInDate,
    String? checkOutDate,
    int? bookingId,
    String? currentStatus,
    String? statusColor,
    List<String>? features,
  }) {
    return Room(
      id: id ?? this.id,
      idProduct: idProduct ?? this.idProduct,
      idHotel: idHotel ?? this.idHotel,
      roomNum: roomNum ?? this.roomNum,
      roomStatus: roomStatus ?? this.roomStatus,
      comment: comment ?? this.comment,
      floor: floor ?? this.floor,
      hotelName: hotelName ?? this.hotelName,
      hotelPhone: hotelPhone ?? this.hotelPhone,
      roomTypeId: roomTypeId ?? this.roomTypeId,
      roomTypeName: roomTypeName ?? this.roomTypeName,
      description: description ?? this.description,
      isOccupied: isOccupied ?? this.isOccupied,
      guestName: guestName ?? this.guestName,
      checkInDate: checkInDate ?? this.checkInDate,
      checkOutDate: checkOutDate ?? this.checkOutDate,
      bookingId: bookingId ?? this.bookingId,
      currentStatus: currentStatus ?? this.currentStatus,
      statusColor: statusColor ?? this.statusColor,
      features: features ?? this.features,
    );
  }
}

class RoomStatistics {
  final int totalRooms;
  final int occupiedRooms;
  final int availableRooms;
  final int cleaningRooms;
  final int maintenanceRooms;
  final double occupancyRate;

  RoomStatistics({
    required this.totalRooms,
    required this.occupiedRooms,
    required this.availableRooms,
    required this.cleaningRooms,
    required this.maintenanceRooms,
    required this.occupancyRate,
  });

  factory RoomStatistics.fromJson(Map<String, dynamic> json) {
    return RoomStatistics(
      totalRooms: int.parse(json['total_rooms'].toString()),
      occupiedRooms: int.parse(json['occupied_rooms'].toString()),
      availableRooms: int.parse(json['available_rooms'].toString()),
      cleaningRooms: int.parse(json['cleaning_rooms'].toString()),
      maintenanceRooms: int.parse(json['maintenance_rooms'].toString()),
      occupancyRate: double.parse(json['occupancy_rate'].toString()),
    );
  }
}

class TodayCheckInOut {
  final int id;
  final int idRoom;
  final String roomNum;
  final String hotelName;
  final String guestName;
  final String email;
  final String checkInDate;
  final String checkOutDate;
  final int adults;
  final int children;

  TodayCheckInOut({
    required this.id,
    required this.idRoom,
    required this.roomNum,
    required this.hotelName,
    required this.guestName,
    required this.email,
    required this.checkInDate,
    required this.checkOutDate,
    required this.adults,
    required this.children,
  });

  factory TodayCheckInOut.fromJson(Map<String, dynamic> json) {
    return TodayCheckInOut(
      id: int.parse(json['id'].toString()),
      idRoom: int.parse(json['id_room'].toString()),
      roomNum: json['room_num'].toString(),
      hotelName: json['hotel_name'].toString(),
      guestName: json['guest_name'].toString(),
      email: json['email'].toString(),
      checkInDate: json['check_in_date'].toString(),
      checkOutDate: json['check_out_date'].toString(),
      adults: int.parse(json['adults'].toString()),
      children: int.parse(json['children'].toString()),
    );
  }
}
