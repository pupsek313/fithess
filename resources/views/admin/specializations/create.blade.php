@extends('layouts.admin')

@section('title', 'Новая специализация')

@section('content')
    <h1>Добавить специализацию</h1>

    @include('admin.specializations._form', ['action' => route('admin.specializations.store')])
@endsection