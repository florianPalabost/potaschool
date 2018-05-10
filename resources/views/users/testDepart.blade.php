@extends('default')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
<style>
#ex1Slider .slider-selection {
	background: #BABABA;
}
</style>
@endsection
@section('content')
<h1>Test de Départ</h1>
{!!Form::open(['route' => 'storeTestDepart','method'=>'POST']) !!}
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Mathématiques</h5>
        <input id="math" data-slider-id='mathslider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14" name="math"/>
        <p class="card-text">Appréciation</p>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Français</h5>
        <input id="francais" data-slider-id='drancaisslider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14" name="francais"/>
        <p class="card-text">Appréciation</p>
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-sm-6" style="margin-top:1%">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Anglais</h5>
        <input id="anglais" data-slider-id='anglaisslider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14" name="anglais"/>
        <p class="card-text">Appréciation</p>
      </div>
    </div>
  </div>
  <div class="col-sm-6" style="margin-top:1%">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">QLM (Histoire, géo, biologie)</h5>
        <input id="qlm" data-slider-id='qlmslider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14" name="qlm"/>
        <p class="card-text">Appréciation</p>
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-sm-12">
<button class="btn btn-primary" id="btnEnvoyer">Valider</button>
</div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"></script>
<script type="text/javascript">
$('#francais').slider({
	formatter: function(value) {
		return value;
	}
});
$('#math').slider({
	formatter: function(value) {
		return value;
	}
});
$('#anglais').slider({
	formatter: function(value) {
		return value;
	}
});
$('#qlm').slider({
	formatter: function(value) {
		return value;
	}
});
</script>
@endsection