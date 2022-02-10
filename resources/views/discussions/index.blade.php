@extends('layouts.app')

@section('content')


    @foreach ($discussions as $discussion)
        <div class="card mb-2">
            @include('partials._discussion-header')
            <div class="card-body">
                <div class="text-center">
                    <strong>{{ $discussion->title }}</strong>
                </div>
            </div>
            <div class="card-footer">
                {{ $discussion->replies->count() }} {{ $discussion->replies->count() > 1 ? 'Replies' : 'Reply' }}
                <a href="{{ route('discussions.index') }}?channel={{ $discussion->channel->slug }}" class="float-end btn btn-secondary btn-sm text-white">{{$discussion->channel->name}}</a>
            </div>
        </div>
    @endforeach
    {{ $discussions->appends(['channel' => request()->query('channel')])->links() }}
@endsection
