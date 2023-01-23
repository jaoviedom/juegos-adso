@extends('layouts.aprendiz')

@section('titulo', 'Lecciones')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">Lecciones</h2>
      <div class="nk-block-des">
          <p class="lead">Lecciones</p>
      </div>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
    <!--Normal FLipbook-->
    <div class="_df_book" height="500" webgl="true" backgroundcolor="teal"
            source="{{ asset('pdf/caracteristicas_lenguajes.pdf') }}"
            id="df_manual_book">
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- jQuery  -->
<script src="{{ asset('js/libs/jquery.min.js') }}"></script>
<!-- Flipbook main Js file -->
<script src="{{ asset('js/dflip.min.js') }}"></script>
@endsection