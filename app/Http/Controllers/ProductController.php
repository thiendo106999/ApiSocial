<?php

namespace App\Http\Controllers;

use App\Models\KindOfAgricultural;
use App\Models\Product;
use App\Models\RegisteredProduct;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{


    public function getProducts(Request $request)
    {
        $query = Product::query()->where('status', 'approved');

        if ($request->has('date') && $request['date'] != null) {
            $query->where('date', $request['date']);
        }
        if ($request->has('kind_id') && $request['kind_id'] != null) {
            $kind = KindOfAgricultural::query()->where('name', $request['kind_id'])->pluck('id')->first();
            $query->where('kind_id', $kind);
        }
        if ($request->has('province') && $request['province'] != null) {
            $query->where('address', 'like',   '%' . $request['province'] . '%');
        }
        $products = $query->get();
        $datas = array();
        foreach ($products as $product) {
            $data = [];
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['user_name'] = UserInfo::query()->where('id', $product->user_id)->value('name');
            $data['address'] = $product->address;
            $data['phone_number'] = $product->phone_number;
            $data['image'] = $product->image;
            $data['date'] = $product->date;
            $data['hexta'] = $product->hexta;
            $data['status'] = $product->status;
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

    public function registeredProduct(Request $request)
    {
        try {
            $user_id = UserInfo::where('access_token', $request['access_token'])
                ->pluck('id')->first();
            $kind = KindOfAgricultural::where('name', $request['kind'])->pluck('id')->first();
            $request->file->storeAs('/public', $request['file_name']);
            $product = new Product([
                'name' => $request['name'],
                'user_id' => $user_id,
                'phone_number' => $request['phone_number'],
                'status' => 'registered',
                'address' => $request['address'],
                'image' => $request['file_name'],
                'date' => $request['date'],
                'kind_id' => $kind,
                'hexta' => $request['hexta']
            ]);
            Log::debug($product);
            $product->save();
        } catch (Exception $e) {
            Log::debug('Regiteres product' . $e);
        }
        return response()->json([
            "message" => "File successfully uploaded",
        ]);
    }

    public function getRegisteredProduct(Request $request)
    {
        $user_id = UserInfo::where('access_token', $request['access_token'])->pluck('id')->first();
        $products = Product::where('user_id', $user_id)->get();
        
        $datas = array();
        foreach ($products as $product) {
            $data = [];
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['user_name'] = UserInfo::query()->where('id', $product->user_id)->value('name');
            $data['address'] = $product->address;
            $data['phone_number'] = $product->phone_number;
            $data['image'] = $product->image;
            $data['date'] = $product->date;
            $data['hexta'] = $product->hexta;
            $data['status'] = $product->status;
            array_push($datas, $data);
        }

        return response()->json($datas);
    }

    public function delete($id)
    {
        Product::destroy($id);

        return response()->json([
            'message' => 'Delete successful'
        ]);
    }
}
