<div class="card-header">
    <div class="d-flex justify-content-between">
        <div>
            <img width="40px" height="40px" style="border-radius: 50%"
                src="{{ Gravatar::get($discussion->user->email) }}" alt="">
            <span class="ms-2" style="font-weight: bold">{{ $discussion->user->name }} <b>{{$discussion->created_at->diffForHumans()}}</b></span>
        </div>
        <div>
            <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
        </div>
    </div>
</div>