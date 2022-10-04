<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SerialController extends Controller
{
    public function generate_serial()
    {
        $gen_id = DB::table('productions')->where('job_status', 0)->value('id');
        $start = DB::table('productions')->where('job_status', 0)->value('serial_starts');
        $quantity = DB::table('productions')->where('job_status', 0)->value('quantity');

        $end = $start + $quantity;

        $numbers = range($start, $end, 1);

        foreach ($numbers as $number) {
            DB::table('users')->insert(
                array(
                    'production_id'   =>   $gen_id,
                    'serial'   =>   $number,
                )
            );
        }
    }
}
