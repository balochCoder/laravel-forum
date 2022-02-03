@extends('layouts.app')

@section('content')
    <div class="card mb-5">
        @include('partials._discussion-header')
        <div class="card-body">
            <div class="text-center">
                <strong>{{ $discussion->title }}</strong>
            </div>
            <hr>
            {!! $discussion->content !!}
        </div>
    </div>
    @foreach ($discussion->replies()->paginate(3) as $reply)
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img width="40px" height="40px" style="border-radius: 50%"
                            src="{{ Gravatar::get($reply->user->email) }}" alt="">
                        <span>{{ $reply->user->name }}</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!!$reply->content!!}
            </div>
        </div>
    @endforeach
    {{ $discussion->replies()->paginate(3)->links() }}
    <div class="card mt-5">
        <div class="card-header">Add a reply</div>
        <div class="card-body">
            @auth
                <form action="{{ route('replies.store', $discussion->slug) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input id="content" type="hidden" name="content">
                        <trix-editor input="content"></trix-editor>
                    </div>
                    <button class="btn btn-success btn-sm mt-2" type="submit">Add Reply</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-info text-white" style="width: 100%">Signin to add a reply</a>
            @endauth
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
        integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"
        integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
