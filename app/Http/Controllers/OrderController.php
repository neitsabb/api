<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {

        $order = Order::create([
            ...$request->validated(),
            'customer' => $request->input('customer_name'),
            'status' => OrderStatusEnum::PENDING->value
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Commande créé avec succès',
                'data' => OrderResource::make(
                    $order
                )

            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $order = Order::findOrFail($id);

        return OrderResource::make(
            $order
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
