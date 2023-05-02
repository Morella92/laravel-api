@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Modifica: {{ $project->title }}</h1>
    </div>
    <div class="container">
        <form action="{{ route('projects.update',$project) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="title" class="form-label">Titolo</label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$project->title) }}" id="title" aria-describedby="titleHelp">
              {{-- errore title --}}
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                 @enderror
            </div>
            <div class="mb-3">
              <label for="typology-id" class="form-label">Tipologia</label>
              <select class="form-select @error('typology_id') is-invalid @enderror" id="typology-id" name="typology_id" aria-label="Default select example">
                <option value="" selected>Seleziona tipologia</option>
                @foreach ($typologies as $typology)
                  <option @selected( old('typology_id', $project->typology_id ) == $typology->id ) value="{{ $typology->id }}">{{ $typology->name }}</option>
                @endforeach
              </select>
              @error('typology_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="technologies" class="form-label">Technologie</label>
              <div class="d-flex @error('technologies') is-invalid @enderror flex-wrap gap-3">

                @foreach($technologies as $key => $technology)
                  <div class="form-check">
                    <input name="technologies[]" @checked( in_array($technology->id, old('technologies',$project->getTechnologyIds()) ) ) class="form-check-input" type="checkbox" value="{{ $technology->id }}" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      {{ $technology->name }}
                    </label>
                  </div>
                @endforeach
              </div>

              @error('technologies')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Contenuto</label>
              <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content">{{ old('content',$project->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
@endsection