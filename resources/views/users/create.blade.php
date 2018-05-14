@extends('defaultEnseignant')
@section('content')
<div class="alert alert-success " style="display:none" id="alert-success">
  <strong>Bravo!</strong> L'élève est pré-ajouté à la classe, il le sera définitevement après validation du formulaire une fois tous les élèves inscrits.
</div>
<h1>Ajout d'un élève à la classe {{$classe->nom}}</h1>
<div class="form-group center-block">
        {!!Form::open(['method'=>'POST','route' => 'rechEleve']) !!}
        <input type="text" placeholder="Tapez pour rechercher le nom d'un élève" name="nomEleve[]" id="rechNom" class="form-control">
        {!! Form::close() !!}
    </div>
    {!!Form::open(['method'=>'POST','route' => 'eleves.store']) !!}
    {!! Form::hidden('listEleves', '', array('id' => 'listEleves')) !!}
    <button class="btn btn-primary" id="btnEnvoyer">Ajouter le(s) élève(s)</button>
    {!! Form::close() !!}
@endsection
@section('script')
<script type="text/javascript" src="{{asset('resources/assets/js/jquery/jquery.auto-complete.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    var listEleves = new Array;
    $("input[id=listEleves]").val('');
    $("input[id=rechNom]").val('');
    $('#alert-success').hide();
$('#rechNom').autoComplete({
    minChars:2,
    source : function(requete, reponse){ // les deux arguments représentent les données nécessaires au plugin
        var  valrech = $('#rechNom').val();
        var token = $("[name=_token]").val();
        var donn = {"rech":valrech,"_token":token};
        $.ajax({
            type:"GET",
            url : "{!! Illuminate\Support\Facades\URL::action('Users\ElevesController@rechEleve')!!}", // on appelle le script JSON
            dataType : 'json', // on spécifie bien que le type de données est en JSON
            data :donn,
            success : function(donnee){     
                reponse(donnee);           
            }
        });
    },
    renderItem: function (item, search){
        return '<div class="autocomplete-suggestion"  data-val="'+item['id']+' '+item['nom']+' '+item['prenom']+'"> '+item['nom']+' '+item['prenom']+'</div>';
    },
    onSelect: function(e, term, item){
        var idEleve = item[0].getAttribute('data-val');
        idEleve = idEleve.split(' ');
        idEleve = idEleve[0];
        listEleves.push(idEleve);
        console.log('liste');
        console.log(listEleves);
        $('#alert-success').show();
        window.setTimeout(function(){
        //do what you need here
        $('#alert-success').hide();
        }, 6000);
        
        $("input[id=listEleves]").val(listEleves); 
        $("input[id=rechNom]").val('');
    }
    });
});
</script>
@endsection