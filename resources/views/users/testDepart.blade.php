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
<div class="alert alert-info " id="alert-info">
  Les appréciations sont /20
</div>
{!!Form::open(['route' => 'storeTestDepart','method'=>'POST']) !!}
<div class="row">
@foreach($matieres as $matiere)
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$matiere['name']}}</h5>
        <input id="{{$matiere['name']}}" data-slider-id="{{$matiere['name']}}slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="10" name="{{$matiere['name']}}"/>
        <p class="card-text">Appréciation : 
          <label>
          <i class="far fa-thumbs-up"></i>
          </label>
          <label>
          <i class="far fa-thumbs-down"></i>
          </label>
          </p>
      </div>
    </div>
  </div>
    @endforeach
  </div>

<div class="row" style="margin-top:1%;text-align:center">
<div class="col-sm-12">
<button class="btn-lg btn-primary" id="btnEnvoyer">Valider</button>
</div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"></script>
<script type="text/javascript">
var matieres = "{{$matieres}}";
matieres = JSON.parse(matieres.replace(/&quot;/g,'"'));
console.log($('#'+matieres[0]['name']));
for(var i = 0; i < matieres.length; i++){
  $('#'+matieres[i]['name']).slider({
	formatter: function(value) {
		return value;
	}
});
}
</script>
@endsection