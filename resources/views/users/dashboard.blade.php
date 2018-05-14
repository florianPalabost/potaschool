@extends('defaultEnseignant')
@section('content')
    <h1>Tableau de bord</h1>
    <div class="row">
    <h2>Mes Classes</h2>
    </div>
    <div class="row">
        <p><a class="btn btn-primary" href="{{ route('classes.create') }}">Ajouter une classe <i class="fas fa-plus"></i></a></p>
    </div>
    <div class="row">
    <div id="cp"></div>
    <div id="ce1"></div>
    <div id="ce2"></div>
    </div>

    @foreach(session('classesEnseignant') as $classe)
        <p><a href="{{route('classes.show',$classe->id)}}">{{$classe->nom}}</a></p>
    @endforeach
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
var classes = new Array;
classes = "{{session('classesEnseignant')}}";
console.log('lesclasses');
console.log(classes);

});
</script>
@endsection