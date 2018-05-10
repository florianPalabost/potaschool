@extends('default')
@section('content')
<h1>Tableau de bord</h1>
@endsection
@section('sidebar')
<li>
<a href="{{url('/dashboard') }}">Dashboard</a>
</li>
<li>
<a href="#">Mes Classes</a>
</li>
@endsection