<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function item_details( $item_id = "")
    {
        if ($item_id) {
            $data_details = Customer::where('id', '=', $item_id)->orderBy('id', 'DESC')->get();
            if( count($data_details ) > 0 ) {
                return $data_details;
            } else {
                return null;
            }
        }
    }
}
