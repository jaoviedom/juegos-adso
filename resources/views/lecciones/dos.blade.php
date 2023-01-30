@extends('layouts.aprendiz')

@section('titulo', 'Lección 2')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">Lección 2</h2>
      <div class="nk-block-des">
          <p class="lead">Lecciones</p>
      </div>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
    <!--Normal FLipbook-->
    <div class="_df_book" height="500" webgl="true" backgroundcolor="teal"
            source="{{ asset('pdf/leccion02.pdf') }}"
            id="df_manual_book">
    </div>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
    <iframe
      src="https://edube.org/sandbox?language=python"
      style="width:100%; height:500px; border:0; border-radius: 4px; overflow:hidden;"
      allow="accelerometer; ambient-light-sensor; camera; encrypted-media; geolocation; gyroscope; hid; microphone; midi; payment; usb; vr; xr-spatial-tracking"
      sandbox="allow-forms allow-modals allow-popups allow-presentation allow-same-origin allow-scripts"
    ></iframe>
  </div>
</div>
@endsection

@section('scripts')
<!-- jQuery  -->
<script src="{{ asset('js/libs/jquery.min.js') }}"></script>
<!-- Flipbook main Js file -->
<script src="{{ asset('js/dflip.min.js') }}"></script>
@endsection