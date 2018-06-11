@extends('defaultEnseignant')

@section('content')
    <h1>{{$title}}</h1>
    <form action="{{route('matieres.store')}}" method="post">
      <div class="form-group">
        <input type="hidden" name="_token" value="{{csrf_token()}}"
          <label for="name">Nom de la nouvelle Matière</label>
          <input type="text" name="name" id="name" class="form-control">
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Ajouter</button>
      </div>
    </form>
@endsection

@section('title')
  PotaSchool - {{$title}}
@endsection
