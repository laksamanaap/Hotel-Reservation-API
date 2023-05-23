<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/hotels/rooms",
 *     tags={"Hotel Room"},
 *     summary="Create hotel room",
 *     @OA\RequestBody(
 *          description= "- Create new hotel room",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="capacity", type="integer", example="10"),
 *              @OA\Property(property="price", type="double", example="10000"),
 *              @OA\Property(property="facilities", type="longText", example="Hotel-Facilities-Example"),
 *              @OA\Property(property="categories_id", type="integer", example="1"),
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
        'capacity' => 'required',
        'price' => 'required',
        'facilities' => 'required',
        'categories_id' => 'required',
        'hotel_id' => 'required'    

    ]);

    return Room::create($request->all(), 419);
}

/**
     * @OA\Get(
     *     path="/hotels/rooms",
     *     tags={"Hotel Room"},
     *     summary="Show all Rooms",
     *     description="Show All Rooms",
     *     operationId="ShowAllRooms",
     *    
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    
     public function index() {  

        return Room::all();

    }


    
}
