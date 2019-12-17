@extends('layouts.app')
@section('content')
  <search-programme auth="{{Auth::check()}}" home="{{url('/')}}" check="{{Auth::check() ? $check : ''}}">
  </search-programme>
@endsection
