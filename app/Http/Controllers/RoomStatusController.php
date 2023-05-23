<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomStatusController extends Controller
{
    /**
     * @OA\Get(
     *     path="/hotels/roomstatus/{rooms_id}",
     *     tags={"Hotel Room Status"},
     *     summary="Check room status by id",
     *     description="Check room status by id",
     *     operationId="ShowRoomStatusFromRoomID",
     *    
     * 
     * * @OA\Parameter(
     *          name="rooms_id",
     *          description="rooms_id",
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
    public function showRoomStatus($id) {
        // return response($id, 200);
        $Room = Room::where('rooms.rooms_id',$id)
            ->with('room_statuses')
            ->first();

        return response()->json([
            'data' => $Room
        ],201);
    }
    

// /**
//      * @OA\Put(
//      *     path="/hotels/roomstatus/{rooms_id}",
//      *     tags={"Hotel Room Status"},
//      *     summary="Change hotel room available or not",
//      *     @OA\RequestBody(
//      *          description= "- Update Room Status <br>
//      *                          1. Available (Not Booked)
//      *                          2. Not Available (Booked)",
//      *          required=true,
//      *          @OA\JsonContent(
//      *              type="object",
//      *              @OA\Property(property="rooms_id", type="int", example="1"),
//      *              @OA\Property(property="hotel_id", type="int", example="1"),
//      *              @OA\Property(property="room_status_id", type="int", example="1"),
//      *              @OA\Property(property="room_status", type="string", example="Available (Not Booked)"),
//      *              @OA\Property(property="description", type="string", example="Room is available")
//      *              
//      *              
//      *              
//      *              
//      *          )
//      *     ),
//      *     @OA\Response(
//      *         response=200,
//      *         description="get token",
//      *      ),
//      *    )
//      *
//      *
//      */

//      public function update(Request $request)
//      {
        
//         $requestData = $request->only([
//             'rooms_id',
//             'hotel_id',
//             'room_status_id',
//             'room_status',
//             'description'
//         ]);
    
//         $id = $requestData['rooms_id'];
//         $hotel_id = $requestData['hotel_id'];
//         $room_status_id = $requestData['room_status_id']; 
//         $room_status = $requestData['room_status']; 
//         $description = $requestData['description']; 

//         $RoomStatus = RoomStatus::find($id);
//         $RoomStatus->hotel_id = $hotel_id;
//         $RoomStatus->room_status_id = $room_status_id;
//         $RoomStatus->room_status = $room_status;
//         $RoomStatus->description = $description;
        
//         $RoomStatus->save();
//         return response($RoomStatus, 200);
    
//      }
     
         /**
     * @OA\Delete(
     *     path="/hotels/roomstatus/{rooms_id}",
     *     tags={"Hotel Room Status"},
     *     summary="Check Out and Change room available",
     *     description="Delete Hotel",
     *     operationId="CheckOut",
     *     
     * @OA\Parameter(
     *          name="rooms_id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * 
     * 
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function destroy($id)
    {
        $Destroy = RoomStatus::destroy($id);

        return response()->json([
            'data' => $Destroy,
            'message' => 'Checkout Success!, Room status already changed!'
        ]);
    }
    
}
