@extends('layouts.index')

@section('conteudo')

<form method="POST" route="{{route('cliente.update',$edit->id)}}">
    @csrf
    @method('PUT')
    @include('cliente._form')
</form>
@include('cliente._list')
@endsection