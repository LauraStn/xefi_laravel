@extends('layouts.app')

@section('title', $dish->exists ? "Editer un plat" : "Créer un plat")

@section('content')
    <h1>@yield('title')</h1>
    <form class="vstack gap-2" action="{{ route($dish->exists ? 'dish.update' : 'dish.store', $dish) }}" method="post">

        @csrf
        @method($dish->exists ? 'put' : 'post')

        <div class="col">
            @include('input.input', ['class' => 'col','label' => 'Titre', 'name' => 'title', 'value' => $dish->title])
            <div class="col row">
                @include('input.input', ['type' => 'textarea','label' => 'Recette','class' => 'col', 'name' => 'recipe', 'value' => $dish->recipe])
            </div>
        </div>
        <div class="d-grid d-md-flex justify-content-md-end">

            <button class="btn btn-info">
                @if($dish->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

        </div>
    </form>
@endsection