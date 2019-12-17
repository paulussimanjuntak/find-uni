@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h2>Showing all university...</h2>
    <div class="row">
      @foreach($univs as $univ)
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats mb-4 mb-lg-4">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h2 class="h4 font-weight-bold mb-0">
                  <a href="{{url("/programme/{$univ->id}")}}">{{$univ->name}}</a>
                </h2>
                <p class="card-title text-muted mb-0">
                  <span class="text-success">{{$univ->programme->count()}}</span>
                  <span class="text-nowrap">Programmes</span>
                </p>
              </div>
            </div><!--/row-->
          </div><!--/card-body-->
        </div><!--/card-->
      </div><!--/col-->
      @endforeach
    </div><!--/row-->
  </div><!--/container-fluid-->
@endsection
