@extends('layouts.app')

@section('content')
   

    @foreach ($discussions as $discussion)
        <div class="card mb-2">
            <div class="card-header"><img src="" alt=""></div>
            <div class="card-body">
                {!! $discussion->content !!}
            </div>
        </div>
    @endforeach
    {{ $discussions->links() }}
@endsection
