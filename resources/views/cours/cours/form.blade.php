<?php
if($cours->id){
  $options=['method'=>'put','url'=>action('Cours\CoursController@update',$cours)];
} else {
  $options=['method'=>'post','url'=>action('Cours\CoursController@store',$cours)];
}
?>

{!!Form::model($cours,$options)!!}
<div class="form-group">
    {{ Form::label('name','Nom')}}
    {{ Form::text('name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{ Form::label('module_id','Module')}}
    {{ Form::select('module_id',$modules,null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{ Form::label('content','Contenu')}}
    {{ Form::textarea('content',null,['class'=>'form-control'])}}
</div>
<button class="btn btn-primary">Valider</button>
{!!Form::close()!!}
