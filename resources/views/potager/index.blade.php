@extends('defaultEleve')
@section('content')
<h1>POTAGER TODO</h1>
<table class="table table-bordered" style=" background-color: rgba(135, 54, 0,0.7)">
  <tbody>
  @foreach($matieres as $mat)
  <tr>
    <th scoped="row"><h4><a href="{{route('seeMatiere',$mat['id'])}}">{{$mat['name']}}</a></h4></th>
    @foreach($modules as $module)
      @if(strcmp($module['matiere_id'],$mat['id'])==0)
        <td>
          <h5><a href="{{route('module.show',$module['id'])}}">{{$module['nomModule']}}</a></h5>
          <table><tr>
          @foreach($cours as $cour)
          @if(strcmp($cour['module_id'],$module['id'])==0)
         <td><a href="{{route('cours.show',$cour['id'])}}">{{$cour['name']}}</a></td>
          @endif
          @endforeach
          </tr>
          </table>
        </td>
      @endif
    @endforeach
  </tr>
  @endforeach
  </tbody>
</table>
@endsection
@section('css')
<style>
a{
  color:black;
}
</style>
@endsection
