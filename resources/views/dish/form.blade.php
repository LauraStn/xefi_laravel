@extends('layouts.app')

@section('title', $property->exists ? "Editer" : "Créer")

@section('content')
    <h1>@yield('title')</h1>
    <form class="vstack gap-2" action="{{ route($dish->exists ? 'dish.update' : 'dish.store', $dish) }}" method="post">

        @csrf
        @method($dish->exists ? 'put' : 'post')

        <div class="row">
            @include('shared.input', ['class' => 'col','label' => 'Titre', 'name' => 'title', 'value' => $dish->title])
            <div class="col row">
                @include('input.input', ['class' => 'col', 'name' => 'surface', 'value' => $dish->surface])
                @include('input.input', ['class' => 'col', 'label' => 'Prix', 'name' => 'price', 'value' => $dish->surface])
            </div>
        </div>
            <button class="btn btn-primary">
                @if($dish->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection