<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function item_details( $item_id = "")
    {
        if ($item_id) {
            $order_details = Order::where('gateway_code', '=', $item_id)->get();
            if( count($order_details ) > 0 ) {
                return $order_details;
            } else {
                return null;
            }
        }
    }
}
