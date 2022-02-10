<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Discussion;
use App\Notifications\NewReplyAdded;
use Auth;
use Illuminate\Http\Request;

class ReplyController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReplyRequest $request, Discussion $discussion)
    {
        Auth::user()->replies()->create([
            'discussion_id' => $discussion->id,
            'content' => $request->content
        ]);

        if ($discussion->user->id !== Auth::user()->id) {
            # code...
            $discussion->user->notify(new NewReplyAdded($discussion));
        }



        return redirect()->back()->with('message', 'Discussion created successfully');
    }
}
