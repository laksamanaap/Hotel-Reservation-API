<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    
    /**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/hotels/payment",
 *     tags={"Hotel Payment"},
 *     summary="Hotel Payment",
 *     @OA\RequestBody(
 *          description= "- Hotel Payment",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="date", type="dateTime", example="2020-09-14 23:18:17"),
 *              @OA\Property(property="rooms_id", type="integer", example="1"),
 *              @OA\Property(property="hotel_id", type="integer", example="1"),
 *              @OA\Property(property="payment_type_id", type="integer", example="1")
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
        'date' => 'required',
        'rooms_id' => 'required',
        'rooms_id' => 'required',
        'payment_type_id' => 'required',
    ]);

    return Payment::create($request->all(), 419);
}

/**
     * @OA\Get(
     *     path="/hotels/payment",
     *     tags={"Hotel Payment"},
     *     summary="Get all list of Hotel Payment",
     *     description="Get list of Hotel Payment",
     *     operationId="ShowAllHotelPayment",
     *     
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function index()
    {
        return Payment::all();
    }

    // Get payment type from payment type id
    /**
     * @OA\Get(
     *     path="/hotels/payment/{payment_type_id}",
     *     tags={"Hotel Payment"},
     *     summary="Displays payments by payment type",
     *     description="Show payments by payment type",
     *     operationId="ShowPaymentTypeByID",
     *    
     * 
     * * @OA\Parameter(
     *          name="payment_type_id",
     *          description="payment type id",
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
    public function show($id) {
        // return response($id, 200);
        $PaymentType = PaymentType::where('payment_types.payment_type_id',$id) // from model table
            ->with('payments') // from model
            ->first();

        return response()->json([
            'data' => $PaymentType
        ],201);
    }

}
