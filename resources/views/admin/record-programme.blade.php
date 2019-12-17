@extends('admin.app')
@section('content')
  <record-programme univ_id="{{Auth::user()->university_id}}"></record-programme>
@endsection
