@extends('layouts.admin')

@section('title', 'Новый тренер')

@section('content')
    <h1>Добавить тренера</h1>

    @include('admin.trainers._form', ['action' => route('admin.trainers.store')])
@endsection