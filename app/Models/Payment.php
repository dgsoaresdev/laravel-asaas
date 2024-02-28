<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function item_details( $item_id = "")
    {
        if ($item_id) {
            $data_details = Payment::where('order_id', '=', $item_id)->get();
            if( count($data_details ) > 0 ) {
                return $data_details;
            } else {
                return null;
            }
        }
    }
}
