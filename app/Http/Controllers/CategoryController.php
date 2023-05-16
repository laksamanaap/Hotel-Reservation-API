<?php

namespace App\Http\Controllers;

use App\Models\Room;
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
 *              @OA\Property(property="categories_name", type="string"),
 *              @OA\Property(property="price", type="integer"),
 *              @OA\Property(property="capacity", type="integer")
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
     *     path="/hotels/categories/{id}",
     *     tags={"Hotel Category"},
     *     summary="Show Categories room list",
     *     description="Show All Categories Room list",
     *     operationId="ShowAllCategoriesRoomlist",
     *    
     * 
     * * @OA\Parameter(
     *          name="id",
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
    public function room($id) {
        $Room = Room::with('rooms')->where('categories_id',$id)->first();

        return response()->json([
            'data' => $Room
        ],201);
    }

}
