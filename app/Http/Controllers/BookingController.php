<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Booking;
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

    $Booking = Booking::create($request->all());

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
