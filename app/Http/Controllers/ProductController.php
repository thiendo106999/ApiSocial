<?php

namespace App\Http\Controllers;

use App\Models\KindOfAgricultural;
use App\Models\Product;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    

    public function getProducts(Request $request)
    {
        $query = Product::query();
        
        if($request->has('date') && $request['date'] != null) {
            $query->where('date', $request['date']);
        } 
        if($request->has('kind_id') && $request['kind_id'] != null) {
            $kind = KindOfAgricultural::query()->where('name', $request['kind_id'])->pluck('id')->first();
            $query->where('kind_id', $kind);
        } 
        if($request->has('province') && $request['province'] != null ) {
            $query->where('address', 'like' ,   '%' . $request['province'] .'%');
        } 
        $products = $query->get();
        $datas = array();
        foreach ($products as $product) {
            $data = [];
            $data['name'] = $product->name;
            $data['user_name'] = UserInfo::query()->where('id', $product->user_id)->value('name');
            $data['address'] = $product->address;
            $data['phone_number'] = $product->phone_number;
            $data['image'] = $product->image;
            $data['date'] = $product->date;
            $data['hexta'] = $product->hexta;
            array_push($datas, $data);
        }

        return response()->json($datas);
    }

    public function settupSpinner()
    {
        $data = Product::query();
        $date = $data->select('date')->distinct()->get();
        $province = $data->select('address as province')->distinct()->get();
        
        return response()->json(
            [
            'dates' => $date,
            'provinces' => $province->values()
            ]
        );
    }
    
}
