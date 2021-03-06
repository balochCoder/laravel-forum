<?php

namespace App\Models;

use App\Notifications\ReplyMarkedAsBestReply;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'content', 'user_id', 'channel_id', 'reply_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id
        ]);


        if ($reply->user->id === $this->user->id) {
            return;
        }
        $reply->user->notify(new ReplyMarkedAsBestReply($reply->discussion));
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannels($query)
    {
        if (request()->query('channel')) {
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if ($channel) {
                return $query->where('channel_id', $channel->id);
            }

            return $query;
        }

        return $query;
    }
}
