<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        return $order->where(
            'users_id', auth()->user()->id
            )->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order, OrderProduct $orderProduct, Product $product)
    {

        $request->validate([
            'total' => 'required',
            'orderProducts' => 'required'
        ]);

        $orderData = $request->only('name', 'total', 'comments');

        $orderData['users_id'] = auth()->user()->id;
        $orderData['status'] = true;

        if(!$order = $order->create($orderData))
        {
            abort(500, 'Error to create a new order!');
        }

        $orderProducts = $request->post('orderProducts');

        $productsData = [];

        foreach ($orderProducts as $product_client) {

            $productModel = $product->find($product_client['product_id']);

            $productOrderData = [
                'products_id' => $productModel->id,
                'product_price' => $productModel->price,
                'orders_id' => $order->id,
                'amount' => $product_client['amount'],
                'value' => $productModel->price * $product_client['amount'],
            ];

            $productsData[] = $productOrderData;

            $orderProduct->create($productOrderData);

        }

        return response()->json([
            'data' => [
                'order' => $order,
                'products' => $productsData,
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
