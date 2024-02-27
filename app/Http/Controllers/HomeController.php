<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $cart_items = [
            0=>[
                'product_id'  => 1,
                'name'        => 'Produto Teste',
                'amout'       => 1,
                'price'       => 500,
                'discount'    => null
            ]
        ];
        //======
        // Calc Price total in cart
        //======
        $cart_total_price = 0;
        //$cart_items_id = [];
        if ( !empty($cart_items)) :
            foreach($cart_items as $item_key => $item_value ):
                $cart_total_price += $item_value['price'];
                $cart_items_id[] = $item_value['product_id'];
            endforeach;
        endif;

        //session(['cart_items_id' => $cart_items_id]);
        session(['shoppingCart' => $cart_items]);
        session(['cart_total_price' => $cart_total_price]);

        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
