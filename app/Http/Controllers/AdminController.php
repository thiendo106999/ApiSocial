<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function uploadFile()
    {
        if (Auth::check()) {
            return view('form');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function getProducts()
    {
        if (Auth::check()) {
            $datas = Product::query()->where('status', 'approved')->get();
            $products = array();
            foreach ($datas as $product) {
                $temp['name'] = $product->name;
                $temp['user_name'] = UserInfo::find($product->user_id)->name;
                $temp['phone_number'] = $product->phone_number;
                $temp['address'] = $product->address;
                $temp['date'] = $product->date;
                $temp['hexta'] = $product->hexta;
                array_push($products, $temp);
            }
            return view('form_product')->with(['products' => $products]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function getRegisteredProducts()
    {
        if (Auth::check()) {
            $products = Product::query()->where('status', 'registered')->get();
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
            return view('form_registered_products')->with(['products' => $datas]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function delete(Request $request, $id)
    {
        Product::where('id', $id)->delete();
    }
    
    public function update(Request $request, $id)
    {
        Product::where('id', $id)->update(['status' => 'approved']);
    }
}
