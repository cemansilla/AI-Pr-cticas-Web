@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/post-rrss.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label for="input_postrrss_prompt">Disparador o Concepto</label>
              <textarea class="form-control" id="input_postrrss_prompt" placeholder="¿Cuál es el concepto de la idea a generar?" rows="3"></textarea>
              <small class="form-text text-muted">Ejemplo: <i>Generar una propuesta para una campaña enfocada a personas con mascotas. Sacaremos un nuevo producto y queremos promocionarlo.</i></small>
            </div>
            <div class="form-group">
              <label for="input_postrrss_destination">Elegir donde será utilizada la idea</label>
              <select class="form-control" id="input_postrrss_destination">
                <option value="">-- Seleccione --</option>
                <option value="instagram">Instagram</option>
                <option value="facebook">Facebook</option>
                <option value="twitter">Twitter</option>
                <option value="linkedin">LinkedIn</option>
              </select>
            </div>
            <div class="form-group">
              <label for="input_postrrss_exclude">¿Hay algo que quisieras excluir?</label>
              <input type="text" class="form-control" id="input_postrrss_exclude" placeholder="Listar palabras separadas por comas">
            </div>
    
            <button id="btn_postrrss_submit" type="submit" class="btn btn-primary">Generar</button>
          </form>
        </div>
        <div class="col-md-6">
          @include('partials.loading')
          <div class="mb-2" id="proposal_text_container"></div>
          <div id="proposal_image_container">
            <img class="hidden" id="image_post_result" src="" alt="AI Generated Image">
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>