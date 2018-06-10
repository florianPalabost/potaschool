@extends(session('user')['type']=="enseignant" ? 'defaultEnseignant' : 'defaultEleve')

@section('content')
  <h1>{{$title}}</h1>
  @if(strcmp(session('user')['type'],'enseignant')==0)
  <p><a class="btn btn-primary" href="{{route('matieres.create')}}">Ajout Matière</a></p>
  @endif
  <div class="card-columns">
  @forelse($list as $matiere)
  <div class="card ">
    <div class="card-header bg-primary text-white">
      
      <div class="row">
        <a class="text-white" href="{{route('matieres.show',$matiere)}}">
        <h3>{{$matiere->name}}</h3></a>
        @if(strcmp(session('user')['type'],'enseignant')==0)
        <div class="col-md-3">
          {!! Form::open(array('route' => array('matieres.destroy', $matiere->id), 'method' => 'delete')) !!}
          {!!Form::hidden('id',$matiere->id)!!}
          <button type="submit"  class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer cette matière ?');"><i class="far fa-trash-alt"></i></button>
          {!! Form::close() !!}
        </div>
        @endif
      </div>
    </div>
  </div>
  @empty
    <h2>Aucune Matière</h2>
  @endforelse
  </div>
@endsection

@section('title')
  PotaSchool - Matières
@endsection
