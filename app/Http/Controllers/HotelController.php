<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{

/**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/hotels",
 *     tags={"Hotel"},
 *     summary="Create new hotel",
 *     @OA\RequestBody(
 *          description= "- Create new hotel",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="hotel_name", type="string", example="Savana"),
 *              @OA\Property(property="location", type="string", example="Malang"),
 *              @OA\Property(property="description", type="string", example="Hotel-Description-Example")
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
        'hotel_name' => 'required',
        'location' => 'required',
    ]);

    return Hotel::create($request->all(), 419);
}

  /**
     * @OA\Put(
     *     path="/hotels/{id}",
     *     tags={"Hotel"},
     *     summary="Update hotel",
     *     @OA\RequestBody(
     *          description= "- Update hotel",
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="id", type="int"),
     *              @OA\Property(property="hotel_name", type="string"),
     *              @OA\Property(property="location", type="string"),
     *              @OA\Property(property="description", type="string")
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="get token",
     *      ),
     *    )
     *
     *
     */

     public function update(Request $request)
     {
        
        $requestData = $request->only([
            'id',
            'hotel_name',
            'location',
            'description'
        ]);
    
        $id = $requestData['id'];
        $hotel_name = $requestData['hotel_name'];
        $location = $requestData['location'];
        $description = $requestData['description']; 
    
        $Product = Hotel::find($id);
        $Product->hotel_name = $hotel_name;
        $Product->location = $location;
        $Product->description = $description;
    
        $Product->save();
        return response($Product, 200);
    
     } 

     
    /**
     * @OA\Delete(
     *     path="/hotels/{id}",
     *     tags={"Hotel"},
     *     summary="Delete Hotel",
     *     description="Delete Hotel",
     *     operationId="deleteHotel",
     *     
     * @OA\Parameter(
     *          name="id",
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
    public function destroy(string $id)
    {
        return Hotel::destroy($id);
    }

    /**
     * @OA\Get(
     *     path="/hotels/{id}",
     *     tags={"Hotel"},
     *     summary="Show specific hotel",
     *     description="Show specific hotel",
     *     operationId="ShowSpecificHotel",
     *     
     * @OA\Parameter(
     *          name="id",
     *          description="Hotel id",
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
    
public function show(string $id) {  
    return Hotel::find($id);
}

    /**
     * @OA\Get(
     *     path="/hotels",
     *     tags={"Hotel"},
     *     summary="Get list of hotel",
     *     description="Get list of hotel",
     *     operationId="ShowAllHotel",
     *     
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function index()
    {
        return Hotel::all();
    }

    

}
