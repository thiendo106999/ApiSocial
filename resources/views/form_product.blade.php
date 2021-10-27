@extends('dashboard')

@section('products')


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> Tên sản phẩm</th>
            <th> Tên người dùng </th>
            <th> Số điện thoại</th>
            <th> Địa chỉ </th>
            <th> Ngày Thu hoạch  </th>
            <th> Hexta</th>
        </tr>
    </thead>
    <tbody>
         @foreach($products as $product)
          <tr>
              <td> {{$product['name']}} </td>
              <td> {{$product['user_name']}} </td>
              <td> {{$product['phone_number']}} </td>
              <td> {{$product['address']}} </td>
              <td> {{$product['date']}} </td>
              <td> {{$product['hexta']}} </td>
          </tr>
         @endforeach
   </tbody>
</table>

@endsection

