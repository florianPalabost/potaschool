@extends('defaultEleve')
@section('content')
<h1>POTAGER TODO</h1>
        <p><button id="btnGraine" class="btn btn-primary" href="{{ route('classes.create') }}">Planter une graine<i class="fas fa-plus"></i></button></p>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Planter une graine </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
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
<table class="table table-bordered" style=" background-image: url('{{asset('resources/assets/images/dirt.jpg')}}')">
  <tbody>
  @foreach($matieres as $mat)
  <tr>
    <th scoped="row"><h4><a href="{{route('seeMatiere',$mat['id'])}}">{{$mat['name']}}</a></h4></th>
    @foreach($modules as $module)
      @if(strcmp($module['matiere_id'],$mat['id'])==0)
        <td>
          <h5><a href="{{route('module.show',$module['id'])}}">{{$module['nomModule']}}</a></h5>
          <table><tr>
          @foreach($cours as $cour)
          @if(strcmp($cour['module_id'],$module['id'])==0)
         <td><a href="{{route('cours.show',$cour['id'])}}">{{$cour['name']}}</a></td>
          @endif
          @endforeach
          </tr>
          </table>
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
</style>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
  
  $('#btnGraine').on('click',function(){
    $('#myModal').modal();
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
