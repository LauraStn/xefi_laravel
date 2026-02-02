@extends('layouts.app')

@section('content')

    <div class="d-grid d-md-flex justify-content-md-end">
        <a href="{{ route('dish.create') }}" class="btn btn-info">Créer</a>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
              <th></th>
              <th>Titre</th>
              <th>Créateur</th>
              <th>Likes</th>
              <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dishes as $dish)
                <tr>
                     <td>
                       {{--  <form action="{{ route('dish.favorite', $dish) }}" method="post"> --}}
                            @csrf
                            {{-- <button class="btn btn-light border-0"> --}}
                                ❤️
                            {{-- </button> --}}
                        {{-- </form>--}}
                    </td> 
                    <td>{{ $dish->title }} </td>
                    <td>{{ $dish->creator->name }}</td>
                    <td>{{ $dish->favoredByUsers()->count() }}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href=" {{ route('dish.show', $dish) }}" class="btn btn-success">Voir</a>
                            <a href=" {{ route('dish.edit', $dish) }}" class="btn btn-primary">Editer</a>
                            <form action=" {{route('dish.destroy', $dish) }} "method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $dishes->links() }}
@endsection

