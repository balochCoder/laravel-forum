@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Add Discussion') }}</div>

        <div class="card-body">
            <form action="{{ route('discussions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="channel_id"></label>
                    <select name="channel_id" id="channel_id" class="form-control">
                        <option value="">Select Channel</option>
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success mt-3 form-control" type="submit">Add Discussion</button>
                </div>

            </form>
        </div>
    </div>
@endsection
