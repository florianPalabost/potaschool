@extends(session('user')['type']=="enseignant" ? 'defaultEnseignant' : 'defaultEleve')

@section('content')
  <h1>{{$title}}</h1>
  @if($module->matiere)
  <div>{{$module->matiere->name}}</div>
  @endif
  @if(strcmp(session('user')['type'],'enseignant')==0)
  <p><a class="btn btn-primary" href="{{route('module.edit', $module)}}">Modifier</a></p>  
  @endif
  </div>
@endsection

@section('title')
  PotaSchool - Modules
@endsection
