<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Discussion;
use App\Models\Like;
use App\Models\Reply;
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

    public function like(Reply $reply)
    {
        Like::create([
            'reply_id' => $reply->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success','You liked the reply');
    }

    public function unlike(Reply $reply)
    {
        $like = Like::where('reply_id',$reply->id)->where('user_id',Auth::id())->first();

        $like->delete();

        return redirect()->back()->with('success','You unliked the reply');
    }
}
