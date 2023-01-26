<div class="form-group">
  <label class="form-label" for="default-06">Grupo</label>
  <div class="form-control-wrap ">
      <div class="form-control-select">
          <select class="form-control" id="default-06" name="grupo_id" required>
              <option selected disabled value="">Seleccione...</option>
              @foreach ($grupos as $item)
              <option value="{{ $item->id }}">{{ $item->nombre }}</option>
              @endforeach
          </select>
      </div>
  </div>
</div>
<div class="form-group">
  <label class="form-label" for="default-06">Categoría</label>
  <div class="form-control-wrap ">
      <div class="form-control-select">
          <select class="form-control" id="default-06" name="categoria" required>
              <option selected disabled value="">Seleccione...</option>
              <option value="Condicionales" @if(isset($ejercicio->categoria) && "Condicionales" == $ejercicio->categoria) selected @endif>Condicionales</option>
              <option value="Ciclo for" @if(isset($ejercicio->categoria) && "Ciclo for" == $ejercicio->categoria) selected @endif>Ciclo for</option>
              <option value="Ciclo while" @if(isset($ejercicio->categoria) && "Ciclo while" == $ejercicio->categoria) selected @endif>Ciclo while</option>
          </select>
      </div>
  </div>
</div>
<div class="form-group">
  <label class="form-label" for="default-textarea">Enunciado</label>
  <div class="form-control-wrap">
      <textarea class="form-control no-resize" id="default-textarea" name="enunciado" required>{{ isset( $ejercicio->enunciado ) ? $ejercicio->enunciado : '' }}</textarea>
  </div>
</div>
<button type="submit" class="btn btn-primary">Guardar</button>