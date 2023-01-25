@extends('layouts.aprendiz')

@section('titulo', 'Ejercicios')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
    <h2 class="nk-block-title fw-normal">Ejercicios</h2>
    <div class="nk-block-des">
      <p class="lead">{{ $categoria }}</p>
    </div>
  </div>
</div>

<div class="nk-tb-list">
  <div class="nk-tb-item nk-tb-head">
    <div class="nk-tb-col tb-col-sm">
      <span>Ejercicio</span>
    </div>
  </div>
  @foreach ($ejercicios as $i => $ejercicio)
  <div class="nk-tb-item">
    <div class="nk-tb-col tb-col">
      <a href="{{ route('ejercicios.resolver', $ejercicio->id) }}">
      <span class="tb-product">
          <span class="title">Ejercicio {{ $ejercicio->id }}</span>
        </span>
      </a>
    </div>
  </div>
  @endforeach
    
</div>

@endsection