@extends(session('user')['type']=="enseignant" ? 'defaultEnseignant' : 'defaultEleve')

@section('content')
  <h1>{{$title}}</h1>
  @if(strcmp(session('user')['type'],'enseignant')==0)
  <p><a class="btn btn-primary" href="{{route('cours.create')}}">Ajout Cours</a></p>
  @endif
  <div class="card-columns">
  @forelse($cours as $item)
  <div class="card ">
    <div class="card-header bg-primary text-white"><a class="text-white" href="{{route('cours.show',$item)}}"><h2>{{$item->name}}</a></h2></div>
    @if($item->module)
    <div class="card-body">
      <h3>{{$item->module->name}}</h3>
      <p>@if(strlen($item->content) > 135)
      {{substr($item->content,0,135)}}...
      @else
      {{substr($item->content,0,135)}}
      @endif
      </p>
    </div>
    @endif
    <div class="card-footer">
    <div class="row">
    <p><a class="btn btn-warning" href="{{route('cours.edit', $item)}}"><i class="far fa-edit"></i></a></p>
    <div class="col-md-3">
            {!! Form::open(array('route' => array('cours.destroy', $item->id), 'method' => 'delete')) !!}
            {!!Form::hidden('id',$item->id)!!}
            <button type="submit"  class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer ce cours?');"><i class="far fa-trash-alt"></i></button>
            {!! Form::close() !!}
          </div>
    </div>

    </div>
  </div>
  @empty
    <h2>Aucun Cours</h2>
  @endforelse
  </div>
@endsection

@section('title')
  PotaSchool - Modules
@endsection
