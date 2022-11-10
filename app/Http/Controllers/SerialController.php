<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SerialController extends Controller
{
    public function generate_serial(){
        $gen_id = DB::table('productions')->where('job_status', 0)->value('id');
        $last_serial = DB::table('productions')->where('job_status', 0)->value('serial_starts');
        $quantity = DB::table('productions')->where('job_status', 0)->value('quantity');

        $start = $last_serial+1;
        $end = $start + $quantity;

        $numbers = range($start, $end, 1);

        foreach ($numbers as $number) {
            DB::table('serial_numbers')->insert(
                array(
                    'production_id'   =>   $gen_id,
                    'serial'   =>   $number,
                )
            );
        }
    }
}
