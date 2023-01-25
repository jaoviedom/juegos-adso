@extends('layouts.main')

@section('titulo', 'Detalle del grupo')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">Detalle del grupo</h2>
      <div class="nk-block-des">
          <p class="lead">Vista previa.</p>
      </div>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
    <div class="preview-block">
      <h3 class="fw-normal">Grupo: {{ $grupo->nombre }}</h3>
      <p class="lead">Aprendices asociados.</p>
      
      <div class="nk-block">
        <table class="nk-tb-list is-separate nk-tb-ulist">
            <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">Nombre</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Correo electrónico</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Progreso</span></th>
                </tr><!-- .nk-tb-item -->
            </thead>
            <tbody>
              @foreach ($aprendices as $item)
              <tr class="nk-tb-item">
                <td class="nk-tb-col">
                  <a href="#" class="project-title">
                      {{-- <div class="user-avatar sq bg-purple"><em class="icon ni ni-user"></em></div> --}}
                      <div class="user-avatar sq bg-purple">
                        @php
                          $initials = '';
                          $explode = explode(' ',$item->nombre);
                          foreach($explode as $x){
                              $initials .=  $x[0];
                          }
                          echo strtoupper($initials);
                      @endphp
                      </div>
                      <div class="project-info">
                          <h5>{{ $item->nombre }}</h5>
                      </div>
                  </a>
                </td>
                <td class="nk-tb-col tb-col-xxl">
                  <a href="mailto: {{ $item->email }}" class="project-title">
                    <h6>{{ $item->email }}</h6>
                  </a>
                </td>
                <td class="nk-tb-col tb-col-md">
                  <div class="project-list-progress">
                      <div class="progress progress-pill progress-md bg-light">
                        @php
                          $avanceGlobal = 0;
                          foreach ($avances as $avance) {
                            if($avance->aprendiz_id == $item->id)
                              $avanceGlobal += $avance->porcentaje;
                          }
                          $avanceGlobal /= count($ejerciciosGrupo);
                        @endphp
                        <div class="progress-bar" data-progress="@php echo $avanceGlobal @endphp"></div>
                      </div>
                      <div class="project-progress-percent">@php echo $avanceGlobal @endphp%</div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div>

      <a href="{{ route('grupos.index') }}" class="mt-3 btn btn-secondary"><em class="icon ni ni-arrow-left"></em> Volver</a>
    </div>
  </div>
</div>
@endsection