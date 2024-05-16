
@extends('master')

@section('konten')
<h1>Selamat datang</h1>
<p>Hallo, {{ Auth::user()->name }}!</p>
@endsection