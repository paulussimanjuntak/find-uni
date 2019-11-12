@extends('layouts.app')
@section('content')
  <section class="section m-t-55">
    <div class="container">
      <div class="columns is-mobile is-multiline is-variable is-1-mobile">
        <div class="column is-half-mobile">
          <div class="control">
            <div class="select is-fullwidth">
              <select>
                <option disabled="disabled" selected>Choose one</option>
                <option>University</option>
                <option>Institute</option>
                <option>Academy</option>
                <option>Polytechnic</option>
              </select>
            </div>
          </div><!--/control-->
        </div><!--/column-->
        <div class="column is-half-mobile">
          <div class="control">
            <div class="select is-fullwidth">
              <select>
                <option>All in Indonesia</option>
                <option>Eastern Indonesia</option>
                <option>Central Indonesia</option>
                <option>Western Indonesia</option>
              </select>
            </div>
          </div><!--/control-->
        </div><!--/column-->
      </div><!--/columns-->
    </div><!--/container-->
  </section>

  <section class="section p-t-10">
    <div class="container">
      <div class="columns is-variable is-2">
        <div class="column is-full-mobile is-half-tablet is-one-quarter-desktop is-one-fifth-fullhd is-one-quarter-fullhd">
          <div class="card sh">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="{{asset('/storage/image/campus/ui.jpeg')}}">
              </figure>
            </div>
            <div class="card-content p-t-16 p-b-16 p-r-16 p-l-16">
              <p class="title is-6">
                <a href="./detail-campus.html" class="has-text-black">University of Indonesia</a>
              </p>
              <p class="subtitle fs-14 has-text-grey">Jl. Margonda Raya, Pondok Cina, Kecamatan Beji, Kota Depok, Jawa Barat 16424</p>
            </div><!--/card-content-->
          </div><!--/card-->
        </div><!--/column-->
      </div><!--/columns-->
    </div><!--/container-->
  </section>

@endsection
