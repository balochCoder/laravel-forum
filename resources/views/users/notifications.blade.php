@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Notifications') }}</div>

        <div class="card-body">
            <ul class="list-group">
                @foreach ($notifications as $notification)

                    <li class="list-group-item">
                        @if ($notification->type === 'App\Notifications\NewReplyAdded')



                            A new reply was added to your discussion


                            <a style="text-decoration: none"
                                href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}"><strong>{{ $notification->data['discussion']['title'] }}</strong></a>



                        @endif


                        @if ($notification->type === 'App\Notifications\ReplyMarkedAsBestReply')


                            Your reply to the discussion <a style="text-decoration: none"
                                href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}"><strong>{{ $notification->data['discussion']['title'] }}</strong></a>
                            was marked as best reply

                        @endif
                    </li>

                @endforeach
            </ul>
        </div>
    </div>
@endsection
