<?php
if($module->id){
  $options=['method'=>'put','url'=>action('Cours\ModuleController@update',$module)];
} else {
  $options=['method'=>'post','url'=>action('Cours\ModuleController@store',$module)];
}
?>

{!!Form::model($module,$options)!!}
<div class="form-group">
    {{ Form::label('name','Nom')}}
    {{ Form::text('name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{ Form::label('matiere_id','Matière')}}
    {{ Form::select('matiere_id',$matieres,null,['class'=>'form-control'])}}
</div>
<button class="btn btn-primary">Valider</button>
{!!Form::close()!!}
