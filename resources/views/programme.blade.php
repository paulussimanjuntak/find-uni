@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h2>Showing all programme of {{$univs->name}} ...</h2>
    <div class="row">
      @foreach($univs->programme as $programme)
      <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h2 class="h4 card-title">
                  <span class="text-primary">{{$programme->name}}</span>
                </h2>
              </div><!--/col-->
            </div><!--/row-->
            <h4 class="card-subtitle mb-2 text-muted fs-12">Closing Date: <b class="text-black">{{$programme->closingDate}}</b></h4>
            <p class="card-text fs-12">{{$programme->description}}</p>
          </div>
        </div>
      </div><!--/col-->
      @endforeach
    </div><!--/row-->
  </div><!--/container-fluid-->
@endsection
