@extends('dashboard')

@section('form')

<div>
<form action="{{ route('upload.handle') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file">
    <input type="submit"  value="Submit">
</form>

</div>

@endsection