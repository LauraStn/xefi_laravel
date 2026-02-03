@php
    $type ??= 'text';
    $class ??= null;
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}"> {{ $label }} </label>
   
    <input class="form-control @error($name) is-invalid @enderror" type="file" id="{{ $name }}"
        name="{{ $name }}">
   
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
