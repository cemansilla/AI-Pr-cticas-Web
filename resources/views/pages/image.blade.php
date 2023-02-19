@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/image.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label for="input_image_prompt">Disparador o Concepto</label>
              <textarea class="form-control" id="input_image_prompt" placeholder="¿Cuál es el concepto de la imagen a generar?" rows="3"></textarea>
              <small class="form-text text-muted">Ejemplo: <i>highly detailed still of [cedamansilla] as a Pixar movie 3d character, renderman engine</i></small>
            </div>
            <div class="form-group">
              <label for="input_image_exclude">¿Hay algo que quisieras excluir?</label>
              <input type="text" class="form-control" id="input_image_exclude" placeholder="Listar palabras separadas por comas">
            </div>
    
            <button id="btn_image_submit" type="submit" class="btn btn-primary">Generar</button>
          </form>
        </div>
        <div class="col-md-6">
          @include('partials.loading')
          <div id="proposal_image_container">
            <img class="hidden" id="image_sd_result" src="" alt="AI Generated Image">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>