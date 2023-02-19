@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/obsidian.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">  
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label for="input_obsidian_materia">Materia</label>
              <input type="text" class="form-control" id="input_obsidian_materia" placeholder="Álgebra I">
            </div>
            <div class="form-group">
              <label for="input_obsidian_temas">Temas a incluir</label>
              <input type="text" class="form-control" id="input_obsidian_temas" placeholder="teorema de Moivre, análisis combinatorio">
            </div>
    
            <div id="obsidian_buttons_container" class="d-flex justify-content-between align-items-center">
              <button id="btn_obsidian_submit" type="submit" class="btn btn-primary">Generar</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          @include('partials.loading')
          <div id="obsidian_md_container"></div>
        </div>
      </div>    
      
    </div>
  </div>
</div>