@extends('admin.app')
@section('content')
  <review-applications idd="{{$id}}" home="{{url('/')}}" univ_id="{{Auth::user()->university->id}}"></review-applications>
@endsection
