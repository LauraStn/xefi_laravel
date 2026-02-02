@extends('layouts.app')


@section('content')
    <h1>{{ $dish->title }}</h1>
    <p><strong>Créateur :</strong> {{ $dish->creator->name }}</p>
    <p><strong>Recette :</strong> {{ $dish->recipe }}</p>
    <p><strong>Likes :</strong> {{ $dish->favoredByUsers()->count() }}</p>
@endsection

