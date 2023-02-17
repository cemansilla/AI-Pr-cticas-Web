@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">  
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label for="input_prompt">Disparador o Concepto</label>
              <textarea class="form-control" id="input_prompt" placeholder="¿Cuál es el concepto de la idea a generar?" rows="3"></textarea>
              <small class="form-text text-muted">Ejemplo: <i>Generar una propuesta para una campaña enfocada a personas con mascotas. Sacaremos un nuevo producto y queremos promocionarlo.</i></small>
            </div>
            <div class="form-group">
              <label for="input_destination">Elegir donde será utilizada la idea</label>
              <select class="form-control" id="input_destination">
                <option value="">-- Seleccione --</option>
                <option value="instagram">Instagram</option>
                <option value="facebook">Facebook</option>
                <option value="ppt">Presentación Power Point</option>
                <option value="html">Web / HTML</option>
                <option value="obsidian">Obsidian</option>
              </select>
            </div>
            <div class="form-group">
              <label for="input_exclude">¿Hay algo que quisieras excluir?</label>
              <input type="text" class="form-control" id="input_exclude" placeholder="Listar palabras separadas por comas">
            </div>
    
            <button id="form_brainstorming_submit" type="submit" class="btn btn-primary">Generar</button>
          </form>
        </div>
        <div class="col-md-6">
          @include('partials.loading')
          <div id="proposal_container"></div>
        </div>
      </div>    
      
    </div>
  </div>
</div>