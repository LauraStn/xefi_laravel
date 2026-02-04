@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <img src="{{ asset($dish->image_path) }}" class="card-img-top img-fluid" alt="{{ $dish->title }}"
                        style="height: 400px; object-fit: cover;">

                    <div class="card-body">
                        <h2 class="card-title mb-3">{{ $dish->title }}</h2>

                        <p class="mb-2">
                            <strong>Créateur :</strong> {{ $dish->creator->name }}
                        </p>

                        <p class="mb-3">
                            <strong>Recette :</strong> <br>{{ $dish->recipe }}
                        </p>

                        <p>
                            <strong>Likes :</strong>
                            <span class="badge bg-danger">
                                <i class="bi bi-heart-fill"></i> {{ $dish->favoredByUsers()->count() }}
                            </span>
                        </p>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mb-4">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            Retour aux plats
                        </a>

                        @role('admin')
                            <a href="{{ route('dishes.admin') }}" class="btn btn-info">
                                Gestion des plats
                            </a>
                            <a href="{{ route('dish.edit', $dish) }}" class="btn btn-primary">
                                Éditer
                            </a>
                            <form action="{{ route('dish.destroy', $dish) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    Supprimer
                                </button>
                            </form>
                        @endrole
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
