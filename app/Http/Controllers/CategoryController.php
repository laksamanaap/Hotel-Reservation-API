<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

 /**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/hotels/categories",
 *     tags={"Hotel Category"},
 *     summary="Create new hotel categories",
 *     @OA\RequestBody(
 *          description= "- Create new hotel categories",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="categories_name", type="string", example="Luxury"),
 *              @OA\Property(property="price", type="integer", example="14000"),
 *              @OA\Property(property="capacity", type="integer", example="10"),
 *              @OA\Property(property="description", type="longText", example="Luxury-Description"),
 *              @OA\Property(property="hotel_id", type="integer", example="1")
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
        'categories_name' => 'required',
        'price' => 'required',
        'capacity' => 'required',
        'description' => 'required',
        'hotel_id' => 'required'

    ]);

    return Category::create($request->all(), 419);
}

/**
     * @OA\Get(
     *     path="/hotels/categories",
     *     tags={"Hotel Category"},
     *     summary="Show all Categories",
     *     description="Show All Categories",
     *     operationId="ShowAllCategories",
     *    
     * 
     * 
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    
     public function index() {  

        return Category::all();

    }

    /**
     * @OA\Get(
     *     path="/hotels/categories/{categories_id}",
     *     tags={"Hotel Category"},
     *     summary="Show Categories room list",
     *     description="Show All Categories Room list",
     *     operationId="ShowAllCategoriesRoomlist",
     *    
     * 
     * * @OA\Parameter(
     *          name="categories_id",
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
    public function rooms($id) {
        // return response($id, 200);
        $Room = Category::where('categories.categories_id',$id)
            ->with('rooms')
            ->first();

        return response()->json([
            'data' => $Room
        ],201);
    }

    // Get all categories from hotel id
    /**
     * @OA\Get(
     *     path="/hotels/{hotel_id}",
     *     tags={"Hotel Category"},
     *     summary="Show hotel Categories",
     *     description="Show hotel categories",
     *     operationId="ShowHotelCategories",
     *    
     * 
     * * @OA\Parameter(
     *          name="hotel_id",
     *          description="Hotel id",
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
    public function categories($id) {
        // return response($id, 200);
        $Category = Hotel::where('hotels.hotel_id',$id) // from model table
            ->with('categories') // from model
            ->first();

        return response()->json([
            'data' => $Category
        ],201);
    }
}
