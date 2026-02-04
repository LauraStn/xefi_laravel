@extends('layouts.app')

@section('content')
    @role('admin')
        <div class="d-flex justify-content-end gap-2 mb-4">
            <a href="{{ route('dishes.admin') }}" class="btn btn-info">
                Gestion des plats
            </a>
        </div>
    @endrole

    <div class="container">
        <div class="row g-4">

            @foreach ($dishes as $dish)
                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm">

                        <img src="{{ asset($dish->image_path) }}" class="card-img-top" style="height:200px; object-fit:cover">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">{{ $dish->title }}</h5>

                            <p class="text-muted mb-1">
                                par {{ $dish->creator->name }}
                            </p>

                            <div class="d-flex gap-1">
                                <form action="{{ route('dishes.toggle', $dish) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="favorite-btn"
                                        style="background: none; border: none; padding: 0; cursor: pointer;">
                                        @if (in_array($dish->id, $favoriteIds))
                                            <i class="bi bi-heart-fill text-danger"></i>
                                        @else
                                            <i class="bi bi-heart"></i>
                                        @endif
                                    </button>
                                </form>
                                <p class="mb-3"> {{ $dish->favoredByUsers()->count() }}</p>

                            </div>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('dish.show', $dish) }}" class="btn btn-success btn-sm">
                                    Voir
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>

        <div class="mt-4">
            {{ $dishes->links() }}
        </div>
    </div>
@endsection
