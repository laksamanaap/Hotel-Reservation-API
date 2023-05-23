<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\RoomStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/hotels/booking",
 *     tags={"Hotel Booking"},
 *     summary="Booking Hotel",
 *     @OA\RequestBody(
 *          description= "- Booking hotel",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="nama_depan", type="string", example="Laksamana"),
 *              @OA\Property(property="nama_belakang", type="string", example="AryaPutra"),
 *              @OA\Property(property="alamat_email", type="string", example="laksamana.arya1412@gmail.com"),
 *              @OA\Property(property="date_from", type="timestamp", example="2020-09-14 23:18:17"),
 *              @OA\Property(property="date_to", type="timestamp", example="2020-09-14 23:18:17"),
 *              @OA\Property(property="no_telf", type="integer", example="0812345678"),
 *              @OA\Property(property="rooms_id", type="integer", example="1"),
 *              @OA\Property(property="hotel_id", type="integer", example="1")
 *              
 *            
 *              
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="get token",
 *      ),
 *    )
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function store(Request $request)
{
    $request->validate([
        'nama_depan' => 'required',
        'nama_belakang' => 'required',
        'alamat_email' => 'required',
        'date_from' => 'required',
        'date_to' => 'required',
        'no_telf' => 'required',
        'rooms_id' => 'required',
        'hotel_id' => 'required',
    ]);

    // Get rooms id
    $requestData = $request->only([
        'rooms_id',
        'hotel_id',
        'nama_depan',
        'nama_belakang'
    ]);

    $rooms_id = $requestData['rooms_id'];
    $hotel_id = $requestData['hotel_id'];
    $nama_depan = $requestData['nama_depan'];
    $nama_belakang = $requestData['nama_belakang'];

    $checkDataRoom = Room::leftJoin('room_statuses', 'room_statuses.rooms_id','=',
        'rooms.rooms_id')
        ->where('rooms.rooms_id', $rooms_id)
        ->get();

        // return response($checkDataRoom);

        foreach($checkDataRoom as $roomstatus) {
        if ($roomstatus->room_status_id == 1 || $roomstatus->room_status_id == null) { // Room availabe (kosong)
            
        $room_statuses = RoomStatus::create([
                'rooms_id' => $rooms_id,
                'hotel_id' => $hotel_id,
                'room_status_id' => 2,
                'room_status' => 'Not Available (Has been booked)',
                'description' => 'the room has been booked by another guest!'

            ]);
        
        $Booking = Booking::create($request->all());

        return response()->json([
            'data' => $Booking,
            'Booking Information' => $room_statuses,
            'message' => 'Successful booking'
        ],200);

        } elseif ($roomstatus->room_status_id == 2) { // Room
            return response()->json([
                'message' => 'The room has been booked by '.$nama_depan.' '. $nama_belakang.'!' 
            ], 419);
        } elseif ($roomstatus->rooms_id == $rooms_id) {
            return response()->json([
                'message' => 'The room has been booked by '.$nama_depan.' '. $nama_belakang.'!' 
            ], 419);
        }
        }

    

    

}

    /**
     * @OA\Get(
     *     path="/hotels/booking",
     *     tags={"Hotel Booking"},
     *     summary="Get all list of hotel booking",
     *     description="Get list of hotel booking",
     *     operationId="ShowAllHotelBooking",
     *     
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function index()
    {
        return Booking::all();
    }

    /**
     * @OA\Get(
     *     path="/hotels/booking/{hotel_id}",
     *     tags={"Hotel Booking"},
     *     summary="displays a booking in spesific hotel",
     *     description="Show All Categories Room list",
     *     operationId="ShowHotelRoomBooking",
     *    
     * 
     * * @OA\Parameter(
     *          name="hotel_id",
     *          description="Categories id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * 
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function bookings($id) {
        // return response($id, 200);
        $Hotel = Hotel::where('hotels.hotel_id',$id)
            ->with('bookings')
            ->first();

        return response()->json([
            'data' => $Hotel
        ],201);
    }

}
