@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h1>
                    {{ $project->title }}
                    @if($project->typology)
                        <span class="badge rounded-pill bg-warning">{{ $project->typology->name }}</span>
                    @else
                        <span class="badge rounded-pill bg-secondary">Nessuna tipologia</span>
                    @endif
                </h1>
                <p>/{{ $project->slug }}</p>
                <ul class="ps-0 d-flex gap-1">
                    @forelse($project->technologies as $technology )
                        <span class="badge rounded-pill text-bg-light">{{ $technology->name }}</span>
                    @empty
                        -
                    @endforelse
                </ul>
            </div>

            <div>
                <a class="btn btn-sm btn-secondary" href="{{ route('projects.edit',$project) }}">Modifica</a>
                @if($project->trashed())
                    <form action="{{ route('projects.restore',$project) }}" method="POST">
                      @csrf
                      <input class="btn btn-sm btn-success" type="submit" value="Ripristina">
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <p>
            {{ $project->content }}
        </p>
    </div>
@endsection