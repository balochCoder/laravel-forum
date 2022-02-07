<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscussionRequest;
use App\Models\Discussion;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::latest()->paginate(5);
        return view('discussions.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionRequest $request)
    {
        // dd($request->all());
        Auth::user()->discussions()->create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title, '-'),
            'channel_id' => $request->channel_id,
        ]);


        return redirect()->route('discussions.index')->with('message', 'Discussion created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show', compact('discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function bestReply(Discussion $discussion, Reply $reply)
    {

        $discussion->markAsBestReply($reply);


       
        return redirect()->back()->with('success', 'Mark as best reply');
    }
}
