@extends('defaultEnseignant')
@section('content')
<h1>Liste des élèves enregistrés</h1>
@foreach($eleves as $eleve)
<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$loop->index}}"> {{$eleve->prenom}} {{$eleve->nom}}</button></p>
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
        <table class="table">
      <thead> 
        <tr>
          <th scope="col">Matières</th>
          <th scope="col">Score Matière</th>
          <th scope="col">Score Actuel</th>
          <th scope="col">Score Max</th>
        </tr>
      </thead>
      <tbody>
      @forelse($eleve->matieres as $mat)
      <tr>  
        <td><b>{{$mat->name}}</b></td>
        <td>
        @if($mat->scoreMatiere<50)
         <p style="color:red;display:inline-block"> {{$mat->scoreMatiere}}/100 </p>
        @elseif($mat->scoreMatiere==50)
          <p style="color:orange;display:inline-block"> {{$mat->scoreMatiere}}/100 </p>
        @else
          <p style="color:green;display:inline-block"> {{$mat->scoreMatiere}}/100 </p>
        @endif
        </td>
        </tr>
        @forelse($eleve->lesCours as $cours)
        <tr>
        @if($mat->id == $cours->matiere_id)
        <td><p>{{$cours->name}}:</p></td>
        <td></td>
          @if($cours->scoreActuel <50)
            <td><p style="color:red">{{$cours->scoreActuel}}/100</p></td>
          @else
            <td><p style="color:green">{{$cours->scoreActuel}}/100</p></td>
          @endif
          <td><p>{{$cours->scoreMax}}/100</p></td>
        @endif
        @empty
          <p>Aucun cours commencé</p>
          @endforelse
         
        </tr>
      @empty
      <p style="color:red">L'élève n'a fait aucun exercice !</p>
      @endforelse
      </tbody>

      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection