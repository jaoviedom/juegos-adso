@extends('layouts.aprendiz')

@section('titulo', 'Mi avance')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
    <h2 class="nk-block-title fw-normal">Mi avance</h2>
    <div class="nk-block-des">
      <p class="lead"></p>
    </div>
  </div>
</div>

<div class="nk-block">
  <table class="nk-tb-list is-separate nk-tb-ulist">
    <thead>
      <tr class="nk-tb-item nk-tb-head">
        <th class="nk-tb-col"><span class="sub-text">Ejercicio</span></th>
        <th class="nk-tb-col"><span class="sub-text">Progreso</span></th>
      </tr><!-- .nk-tb-item -->
    </thead>
    <tbody>
      @foreach ($ejerciciosGrupo as $item)
        <tr class="nk-tb-item">
          <td class="nk-tb-col">
            <div class="project-info">
              <h5>Ejercicio {{ $item->id }}</h5>
            </div>
          </td>
          <td class="nk-tb-col tb-col-md">
            <div class="project-list-progress">
              <div class="progress progress-pill progress-md bg-light">
                {{-- <div class="progress-bar" data-progress="{{ $avance->porcentaje }}"></div> --}}
                <div class="progress-bar" data-progress=@if($item->porcentaje != null) {{ $item->porcentaje }} @else 0 @endif></div>
              </div>
              <div class="project-progress-percent">@if($item->porcentaje != null) {{ $item->porcentaje }} @else 0 @endif%</div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <hr>
  <table class="nk-tb-list is-separate nk-tb-ulist">
    <tbody>
      <tr class="nk-tb-item">
        <td class="nk-tb-col">
          <div class="project-info">
            <h5>Avance total</h5>
          </div>
        </td>
        <td class="nk-tb-col tb-col-md">
          <div class="project-list-progress">
            <div class="progress progress-pill progress-lg bg-light">
              <div class="progress-bar" data-progress="{{ $avanceGlobal }}"></div>
            </div>
            <div class="project-progress-percent">{{ $avanceGlobal }}%</div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>


@endsection