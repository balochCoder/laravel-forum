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
            @if ($discussion->bestReply)
                <div class="card bg-success text-white mt-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <img width="40px" height="40px" style="border-radius: 50%"
                                    src="{{ Gravatar::get($discussion->bestReply->user->email) }}" alt="">
                                <strong>{{ $discussion->bestReply->user->name }}</strong>
                            </div>
                            <div>
                                BEST REPLY
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! $discussion->bestReply->content !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
    @foreach ($discussion->replies()->latest()->paginate(3)
        as $reply)
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img width="40px" height="40px" style="border-radius: 50%"
                            src="{{ Gravatar::get($reply->user->email) }}" alt="">
                        <span>{{ $reply->user->name }}</span>
                    </div>
                    @auth
                        @if (Auth::user()->id === $discussion->user_id)
                            @if ($discussion->reply_id !== $reply->id)
                                <div>
                                    <form
                                        action="{{ route('discussions.best', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-primary" type="submit">Mark as best reply</button>
                                    </form>
                                </div>
                            @else
                                <div>
                                    <strong><svg style="color: seagreen" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg></strong>
                                </div>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
            <div class="card-body">
                {!! $reply->content !!}
            </div>
            <div class="card-footer">
                @if ($reply->is_liked_by_auth_user())
                    <a href="{{route('reply.unlike',$reply->id)}}" class="btn btn-danger btn-sm">Unlike <span class="badge bg-info">{{$reply->likes->count()}}</span></a>
                @else
                    <a href="{{route('reply.like',$reply->id)}}" class="btn btn-success btn-sm">Like <span class="badge bg-info">{{$reply->likes->count()}}</span></a>
                @endif
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
