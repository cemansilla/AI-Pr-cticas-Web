@push('head')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/text-to-speech.js') }}"></script>
@endpush

<div class="bg-white rounded-top shadow-sm mb-3">
  <div class="row g-0">
    <div class="col mt-6 p-4">
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label for="input_tts_text">Texto</label>
              <textarea class="form-control" id="input_tts_text" placeholder="Me gusta mucho su producto" rows="3"></textarea>
            </div>
    
            <button id="btn_tts_submit" type="submit" class="btn btn-primary">Generar</button>
          </form>
        </div>
        <div class="col-md-6">
          @include('partials.loading')
          <div id="tts_container"></div>
        </div>
      </div>      
    </div>
  </div>
</div>