@extends('layouts.app')

@section('content')

    <div class="d-flex align-self-end">
        <a href="" class="btn btn-primary">Créer</a>
    </div>

    <table class="table table-stripped">
        <thead>
            <tr>
              <th></th>
              <th>Prix</th>
              <th>Créateur</th>
              <th>Likes</th>
              <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($properties as $property)
                <tr>
                    <td>{{ $property->title }} </td>
                    <td>{{ $property->surface }}m² </td>
                    <td>{{ number_format($property->price, thousands_separator:' ') }} </td>
                    <td>{{ $property->city }} </td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href=" {{ route('admin.property.edit', $property) }}" class="btn btn-primary">Editer</a>
                            <form action=" {{route('admin.property.destroy', $property) }} "method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach --}}
        </tbody>
    </table>

    {{-- {{ $properties->links() }} --}}
@endsection

