@extends(session('user')['type']=="enseignant" ? 'defaultEnseignant' : 'defaultEleve')

@section('content')
    <h1>{{$title}}</h1>
    <p>
        route useless
    </p>
@endsection

@section('title')
  PotaSchool - {{$title}}
@endsection
