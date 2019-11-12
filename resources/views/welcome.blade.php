@extends('layouts.app')
@section('content')
  <section class="hero is-light m-t-55">
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-8 is-offset-2 has-text-centered">
            <h2 class="title is-2 is-size-4-mobile has-text-black">Find all university around indonesia</h2>
            <p class="subtitle is-size-6-mobile has-text-grey-dark m-t-5">
              Find your favorite university and the right programe for you all in one place.
            </p>
            <button class="button is-link has-text-weight-semibold m-b-15">Find now!</button>
            <figure class="image">
              <img src="{{asset('storage/image/indonesia.png')}}">
            </figure>
          </div><!--/column-->
        </div><!--/columns-->
      </div><!--/container-->
    </section>
    <div class="wavy"></div>
  </section>

  <section class="section p-t-0">
    <div class="container">

      <div class="columns is-mobile is-multiline">
        
        <div class="column is-one-third-desktop is-full-touch">
          <div class="box is-shadowless has-text-centered m-b-0">
            <figure class="image is-128x128 is-inline-block">
              <img src="{{asset('storage/image/file-cabinet.png')}}">
            </figure>
          </div><!--/box-->
          <h4 class="title is-4 is-size-5-mobile has-text-centered has-text-black">Cover all campus in Indonesian</h4>
          <p class="has-text-centered is-size-6-mobile">Keep your projects organized by creating Bitbucket branches right from Jira issues or Trello cards.</p>
        </div><!--/column-->

        <div class="column is-one-third-desktop is-full-touch">
          <div class="box is-shadowless has-text-centered m-b-0">
            <figure class="image is-128x128 is-inline-block">
              <img src="{{asset('storage/image/integration.png')}}">
            </figure>
          </div><!--/box-->
          <h4 class="title is-4 is-size-5-mobile has-text-centered has-text-black">One Step Registration</h4>
          <p class="has-text-centered is-size-6-mobile">Keep your projects organized by creating Bitbucket branches right from Jira issues or Trello cards.</p>
        </div><!--/column-->
      
        <div class="column is-one-third-desktop is-full-touch">
          <div class="box is-shadowless has-text-centered m-b-0">
            <figure class="image is-128x128 is-inline-block">
              <img src="{{asset('storage/image/continuous-delivery.png')}}">
            </figure>
          </div><!--/box-->
          <h4 class="title is-4 is-size-5-mobile has-text-centered has-text-black">Cover all campus in Indonesian</h4>
          <p class="has-text-centered is-size-6-mobile">Keep your projects organized by creating Bitbucket branches right from Jira issues or Trello cards.</p>
        </div><!--/column-->
      
      </div><!--/columns-->

    </div><!--/container-->
  </section>

  <section class="section">
    <div class="container">
      <div class="columns is-mobile is-multiline">
        
        <div class="column is-two-fifths-desktop is-hidden-touch">
          <div class="box is-shadowless has-text-right p-t-0">
            <figure class="image w-180 is-inline-block">
              <img src="{{asset('storage/image/mading-rocket.png')}}">
            </figure>
          </div><!--/box-->
        </div><!--/column-->
      
        <div class="column is-two-fifths-desktop is-full-touch">
          <h4 class="title is-4 has-text-left has-text-black bor-title">Give the Lastest update campus</h4>
          <p class="has-text-left">
            Mau punya kekuatan super? kuasai skill programming alias koding, dengan ini, ngga akan ada lagi batas antara ide dan eksekusi. Mau bikin startup? mau bikin aplikasi? mau bantu banyak orang? tunggu apa lagi..<br><br>

Tidak seperti kuliah, sekolahkoding membebaskan membernya untuk belajar kapan saja dan dimana saja. Ada juga forum untuk tanya jawab jika bingung di tengah jalan.<br><br>

Anak IT atau bukan, laki-laki atau perempuan, masih muda atau sudah senior, sekolahkoding tidak peduli. Tidak ada sertifikat, tidak ada nilai, tidak ada ujian. Yang kami tawarkan skill asli yang bisa digunakan di dunia nyata
          </p>
        </div><!--/column-->
      
      </div><!--/columns-->
    </div><!--/container-->
  </section>

  <section class="section has-background-white-ter">
    <div class="container">

      <h3 class="title has-text-black bor-title is-size-4-mobile">Favorite Campus</h3>
      <div class="columns is-mobile is-multiline">
        
        <div class="column is-one-quarter-desktop is-half-tablet is-full-mobile">
          <div class="card sh">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="{{asset('storage/image/campus/ui.jpeg')}}">
              </figure>
            </div>
            <div class="card-content">
              <p class="title is-4">University of Indonesia</p>
              <p class="subtitle is-6">Jl. Margonda Raya, Pondok Cina, Kecamatan Beji, Kota Depok, Jawa Barat 16424</p>
            </div><!--/card-content-->
          </div><!--/card-->
        </div><!--/column-->
        
      </div><!--/columns-->

    </div><!--/container-->
  </section>

@endsection
