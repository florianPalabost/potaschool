@extends('defaultEnseignant')

@section('content')
  <h1>Edition</h1>
  @include('cours.module.form')
@endsection

@section('title')
  PotaSchool - {{$module->nomModule}}
@endsection
