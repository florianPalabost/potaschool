@extends('defaultEleve')
@section('content')
<h1>POTAGER TODO</h1>
        <!-- trigger btn plante graine  -->
        <p><button id="btnGraine" class="graine btn btn-sm" href="{{ route('classes.create') }}"><img src="{{asset('resources/assets/images/graine.png')}}" style="width: 70px;"><i class="fa fa-plus" style="position:relative;z-index:99"></i></button></p>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Planter une graine </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <!-- MODAL plante graine  -->
                <div class="modal-body">
  
                    <form id="formRegister" class="form-horizontal" role="form" method="POST" action="{{ route('storeGraine') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
                        <div class="form-group{{ $errors->has('idMatiere') ? ' has-error' : '' }}">
                          {!!Form::label('label', 'Matières') !!}

                          <select data-placeholder="Choisir la matière..."  class="chosen form-control" style="" tabindex="4" id="idMatiere" name="idMatiere">
                              <option value="0" selected="true">Aucune</option>
                              @foreach($lesMatieres as $key => $value)
                                  <option value="{{$key}}">{{$value}}</option>
                              @endforeach
                          </select>
                          @if ($errors->has('idMatiere'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('idMatiere') }}</strong>
                              </span>
                           @endif
                        </div>
                        <div class="form-group{{ $errors->has('idModule') ? ' has-error' : '' }}">
                          {!!Form::label('label', 'Modules') !!}
                          <select data-placeholder="Choisir le module..."  class="chosen form-control" style="" tabindex="4" id="idModule" name="idModule">
                          </select>
                          @if ($errors->has('idModule'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('idModule') }}</strong>
                              </span>
                           @endif
                        </div>
  
                        <div class="form-group{{ $errors->has('idCours') ? ' has-error' : '' }}">
                          {!!Form::label('label', 'Cours') !!}

                          <select data-placeholder="Choisir le cours..."  class="chosen form-control" style="" tabindex="4" id="idCours" name="idCours">
                          </select>
                          @if ($errors->has('idCours'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('idCours') }}</strong>
                              </span>
                           @endif
                        </div>

                        {{ Form::hidden('idEleve', $user['id']) }}
                        {{ Form::hidden('idClasse', $classes[0]['idClasse']) }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Plante ta fucking graine
                                </button>
                            </div>
                        </div>
                    </form>                       
                    </div>
        </div>
        </div>
        </div>
                <!-- FIN MODAL plante ta graine -->
                <!-- MODAL choix exos  -->
                <div class="modal fade" id="listExos" tabindex="-1" role="dialog" aria-labelledby="listExoLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="listExoLabel">Choix d'un exercice sur le cours ...</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                               <div class="row" id="exos"></div>
                            </div>
    
                        </div>
                    </div>
                </div>
                 <!-- FIN MODAL choix exos -->
                <!-- MODAL je fais exos  -->
                <div class="modal fade" id="theExo" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="theExoLabel">A toi de jouer ! </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                               <div class="" id="exo"></div>
                            </div>
    
                        </div>
                    </div>
                </div>
                 <!-- FIN MODAL je ffais exos -->
   
<table class="table table-bordered" style="background-image: url('{{asset('resources/assets/images/fonddirt.jpg')}}')">
  <tbody>
  @foreach($matieres as $mat)
  <tr>
    <th scoped="row"><h4><a href="{{route('matieres.show',$mat['id'])}}">{{$mat['name']}}</a></h4></th>
    @foreach($modules as $module)
      @if(strcmp($module['matiere_id'],$mat['id'])==0)
        <td style="background-image: url('{{asset('resources/assets/images/gooddirt.jpg')}}')">
        <!-- trigger choix exos  -->
          <h5><a class="module" href="#">{{$module['nomModule']}}</a></h5>
        </td>
      @endif
    @endforeach
  </tr>
  @endforeach
  </tbody>
</table>

@endsection
@section('css')
<style>
a{
  color:white;
}
td a {
        display:block;
    }
</style>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
  
  $('#btnGraine').on('click',function(){
    $('#myModal').modal();
  });

  $('.module').on('click',function(){
    $('#exos').html('');
   
    var nomModule = $(this).text();
    var token = $("[name=_token]").val();
    var donn = {"nomModule":nomModule,"_token":token};
    $.ajax({
        type:"GET",
        url : "{!! Illuminate\Support\Facades\URL::action('PotagersController@findExercices')!!}", // on appelle le script JSON
        dataType : 'json', // on spécifie bien que le type de données est en JSON
        data :donn,
        success : function(donnee){    
            console.log(donnee);
            if(donnee.length > 0){
                $.each(donnee, function(index, item) {
                  console.log(item);
               // $("#idModule").get(0).options[$("#idModule").get(0).options.length] = new Option(item.nomModule, item.id);
                //$('#exos').text(item);    
                   var myCol = $('<div class=""></div>');
                
                    var myPanel = $('<div class="btn" id="'+index+'Panel"><div class="card-block"><div class="card-title"></div><button class="btn btn-primary btn-lg choixExo" data-dismiss="modal" data-toggle="modal" data-target="#theExo">'+item.titre+'</button></div></div>');
                    myPanel.appendTo(myCol);
                    myCol.appendTo('#exos');
                });  
            }
            else {
                var p = $("<p>Aucun exercice prévu pour ce module</p>");
                p.appendTo('#exos');
            }  
        }      
    });
    $('#listExos').modal();
  });

$('#theExo').on('show.bs.modal',function(data){
    var nbErreur = 0;
    $('#exo').html('');
    console.log('nom exo ...');
    console.log(data.relatedTarget.textContent);
    var titre =data.relatedTarget.textContent;
    var token = $("[name=_token]").val();
    var donn = {"titre":titre,"_token":token};
    $.ajax({
        type:"GET",
        url : "{!! Illuminate\Support\Facades\URL::action('PotagersController@findExo')!!}", // on appelle le script JSON
        dataType : 'json', // on spécifie bien que le type de données est en JSON
        data :donn,
        success : function(donnee){    
            console.log(donnee);
    
               // $("#idModule").get(0).options[$("#idModule").get(0).options.length] = new Option(item.nomModule, item.id);
                //$('#exos').text(item);    
                   var myCol = $('<div class="col-sm-3 col-md-3 pb-2"></div>');
             
                    var titre = $('<h2>'+donnee.titre+'</h2>');
                   titre.appendTo('#exo');
                    var enonce = $('<p>'+donnee.enonce+'</p>');
                    enonce.appendTo('#exo');
                    var form = $('<form id="formrep" class="form-horizontal" role="form" method="POST" action="{{route("storeRep")}}">');
                    form.appendTo('#exo');
                    var token = $('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
                    token.appendTo('#formrep');
                    var idEleve = $('{{ Form::hidden("idEleve", $user["id"]) }}');
                    idEleve.appendTo('#formrep');
                    var idExo = $('<input type="hidden" name="idExo" value="'+donnee.idExo+'">');
                    idExo.appendTo('#formrep');
                    var rep = $('<input type="hidden" id="therep" name="reponse" value="'+donnee.reponse+'">');
                    rep.appendTo('#formrep');
                    if(donnee.typeRep=="unique"){
                        var reponse = $('<input type="text name="choix1" id="reponse" placeholder="Votre reponse..."/>');
                        reponse.appendTo('#formrep');
                    }
                    else{
                        var reponse1 = $('<input type="radio" id="choix1" name="choix1" value="'+donnee.reponse+'"><label for="choix1">'+donnee.reponse+'</label>');
                        if(donnee.choix2 !==null){
                            var reponse2 = $('<input type="radio" id="choix1" name="choix1" value="'+donnee.choix2+'"><label for="choix1">'+donnee.choix2+'</label>');
                        }
                        else{
                            var reponse2=null;
                        }
                        if(donnee.choix3 !==null){
                            var reponse3 = $('<input type="radio" id="choix1" name="choix1" value="'+donnee.choix3+'"><label for="choix1">'+donnee.choix3+'</label>');
                        }
                        else{
                           var reponse3=null;
                        }
                        if(donnee.choix4 !==null){
                            var reponse4 = $('<input type="radio" id="choix1" name="choix1" value="'+donnee.choix4+'"><label for="choix1">'+donnee.choix4+'</label>');
                        }
                        else{
                           var reponse4=null;
                        }
                        
                        var rep1 = Math.floor(Math.random() * (100 - 0 + 1)) + 0;
                        var rep2 = Math.floor(Math.random() * (100 - 0 + 1)) + 0;
                        var rep3 = Math.floor(Math.random() * (100 - 0 + 1)) + 0;
                        var rep4 = Math.floor(Math.random() * (100 - 0 + 1)) + 0;

       
                        if(rep1 <= rep2 && rep1<=rep3 && rep1<=rep4){
                            if(rep2>=rep3){
                                reponse1.appendTo('#formrep');
                                if(reponse3 !==null){reponse3.appendTo('#formrep')};
                                if(reponse2 !==null){reponse2.appendTo('#formrep')};
                                if(reponse4 !==null){reponse4.appendTo('#formrep')};
                            }
                            reponse1.appendTo('#formrep');
                            if(reponse2 !==null){reponse2.appendTo('#formrep')};
                            if(reponse3 !==null){reponse3.appendTo('#formrep')};
                            if(reponse4 !==null){reponse4.appendTo('#formrep')};
                        }
                        else if(rep2<= rep4){
                            if(reponse2 !==null){reponse2.appendTo('#formrep')};
                            if(reponse4 !==null){reponse4.appendTo('#formrep')};
                            reponse1.appendTo('#formrep');
                            if(reponse3 !==null){reponse3.appendTo('#formrep')};
                        }
                        else if(rep3<= rep4){
                            if(reponse3 !==null){reponse3.appendTo('#formrep')};
                            reponse1.appendTo('#formrep');
                            if(reponse4 !==null){reponse4.appendTo('#formrep')};
                            if(reponse2 !==null){reponse2.appendTo('#formrep')};
                            
                        }
                        else if(rep1<= rep4){
                            reponse1.appendTo('#formrep');
                            if(reponse4 !==null){reponse4.appendTo('#formrep')};
                            if(reponse2 !==null){reponse2.appendTo('#formrep')};
                            if(reponse3 !==null){reponse3.appendTo('#formrep')};
                        }
                        else if(rep3<= rep1){
                            if(reponse3 !==null){reponse3.appendTo('#formrep')};
                            reponse1.appendTo('#formrep');
                            if(reponse4 !==null){reponse4.appendTo('#formrep')};
                            if(reponse2 !==null){reponse2.appendTo('#formrep')};
                            
                        }
                        else{
                            if(reponse3 !==null){reponse3.appendTo('#formrep')};
                            if(reponse2 !==null){reponse2.appendTo('#formrep')};
                            if(reponse4 !==null){reponse4.appendTo('#formrep')};
                            reponse1.appendTo('#formrep');
                        }
                        
                    }
                   
                    var row = $(' <div class="row"></div>');
                    row.appendTo('#formrep');
                    var btnVal = $('<button class="btn btn-primary" id="validRep">Valider</button>');
                    btnVal.appendTo('#formrep');   

                         /* var myPanel = $('<div class="" id="'+index+'Panel"><div class="card-block"><div class="card-title"></div><button class="btn btn-primary btn-lg choixExo" data-dismiss="modal" data-toggle="modal" data-target="#theExo">'+item.titre+'</button></div></div>');
                    myPanel.appendTo(myCol);
                    myCol.appendTo('#exos');*/
                    $('#formrep').on('submit',function(event,data){
                         //fix submit errors firefox
                        event.preventDefault(); 
                        console.log('click btn val');
                        console.log($('#therep').val());
                        console.log('event');
                        
                        console.log($('input[name=choix1]:checked').val());
                        

                        return false;
                    });
        }      
    })
   
});

  $('#idMatiere').on('change',function(){
    $("#idModule").html('');
    var idMatiere = $(this).val();
    var token = $("[name=_token]").val();
    var donn = {"idMatiere":idMatiere,"_token":token};
    $.ajax({
            type:"GET",
            url : "{!! Illuminate\Support\Facades\URL::action('PotagersController@findModule')!!}", // on appelle le script JSON
            dataType : 'json', // on spécifie bien que le type de données est en JSON
            data :donn,
            success : function(donnee){    
                console.log(donnee); 
                //reponse(donnee);   
                $("#idModule").get(0).options[$("#idModule").get(0).options.length] = new Option('Aucun', 0);   
                $.each(donnee, function(index, item) {
                  console.log(item);
                $("#idModule").get(0).options[$("#idModule").get(0).options.length] = new Option(item.nomModule, item.id);
            });     
            }
        });
  });
  $('#idModule').change(function(){
    $("#idCours").html('');
    var idModule = $(this).val();
    var token = $("[name=_token]").val();
    var donn = {"idModule":idModule,"_token":token};
    $.ajax({
            type:"GET",
            url : "{!! Illuminate\Support\Facades\URL::action('PotagersController@findCours')!!}", // on appelle le script JSON
            dataType : 'json', // on spécifie bien que le type de données est en JSON
            data :donn,
            success : function(donnee){    
                console.log(donnee); 
                //reponse(donnee);  
                $("#idCours").get(0).options[$("#idCours").get(0).options.length] = new Option('Aucun', 0);      
                $.each(donnee, function(index, item) {
                  console.log(item);
                $("#idCours").get(0).options[$("#idCours").get(0).options.length] = new Option(item.name, item.id);
            });     
            }
        });
  });


});
</script>
@endsection

