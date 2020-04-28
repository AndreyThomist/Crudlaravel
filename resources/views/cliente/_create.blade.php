@extends('layouts.index')

@section('conteudo')
<form method="POST" route="{{route('cliente.store')}}">
    @csrf
    @method('post')
    @include('cliente._form')
</form>

@include('cliente._list')
@endsection

