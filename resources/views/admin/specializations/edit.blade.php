@extends('layouts.admin')

@section('title', 'Изменить специализацию')

@section('content')
    <h1>Изменить специализацию</h1>

    @include('admin.specializations._form', ['action' => route('admin.specializations.update', $specialization)])
@endsection