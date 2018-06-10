@extends('defaultEnseignant')
@section('content')
<h1>{{$classe->niveau}} - {{$classe->nom}}</h1>
<p>Statut : {{$classe->statut}}</p>
<p>Nombre d'élève : {{count($eleves)}}</p>
@if(strcmp($classe->statut,"prive")==0)
<p>Mot de passe : {{$classe->mdp}}</p>
@endif
<h2>Liste des élèves</h2>
<div class="row">
    <p><a class="btn btn-primary" href="{{ route('eleves.create') }}">Ajouter un élève <i class="fas fa-plus"></i></a></p>
</div>
@foreach($eleves as $eleve)
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$loop->index}}"> {{$eleve->prenom}} {{$eleve->nom}}</button>
<div id="myModal{{$loop->index}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">{{$eleve->prenom}} {{$eleve->nom}}</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <h4>Informations personnelles</h4>
        <p>nom : {{$eleve->nom}}</p>
        <p>prénom : {{$eleve->prenom}}</p>
        <p>email : {{$eleve->email}}</p>
    <h4>Statistiques</h4>
      @forelse($eleve->matieres as $mat)
        <h5>{{$mat->name}}</h5>
        @if($mat->scoreMatiere<50)
          Score : <p style="color:red;display:inline-block"> {{$mat->scoreMatiere}}/100 </p>
        @elseif($mat->scoreMatiere==50)
          Score : <p style="color:orange;display:inline-block"> {{$mat->scoreMatiere}}/100 </p>
        @else
          Score : <p style="color:green;display:inline-block"> {{$mat->scoreMatiere}}/100 </p>
        @endif
      @empty
      <p style="color:red">L'élève n'a fait aucun exercice !</p>
      @endforelse
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
