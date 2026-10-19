@extends('layouts.admin')

@section('title', 'Изменить тренера')

@section('content')
    <h1>Изменить тренера</h1>

    @include('admin.trainers._form', ['action' => route('admin.trainers.update', $trainer)])
@endsection