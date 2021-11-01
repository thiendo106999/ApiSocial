<?php

namespace App\Http\Controllers;

use App\Models\Agriculcultural;
use App\Models\KindOfAgricultural;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PriceAgriculturalController extends Controller
{
    public function getPriceList(Request $request)
    {
        $query  = Agriculcultural::query();

        if(!empty($request['kind'])) {
            $kind = KindOfAgricultural::where('name', $request['kind'])->select('id')->get()->first();
            $query->where('kind', $kind['id']);
        }
        if(!empty($request['date'])) {
            $kind = KindOfAgricultural::where('name', $request['kind'])->select('id')->get()->first();
            $query->where('date', $request['date']);
        }
        $data = $query->select('name', 'price')->get();

        Log::debug($data);
        return response()->json(
            $data
        );
    }
    public function getDate()
    {
        $data = Agriculcultural::query();
        $date = $data->select('date')->distinct()->get();
        $province = $data->select('province')->distinct()->get();
        
        return response()->json(
            [
            'dates' => $date,
            'provinces' => $province->values()
            ]
        );
    }
  
}
