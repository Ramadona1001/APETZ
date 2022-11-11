<?php

namespace Messages\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Messages extends Model
{
    protected $table = 'messages';

    protected $appends = ['unread'];

    public function getSendAttribute($value)
    {
        return User::findOrfail($value);
    }

    public function getReceiveAttribute($value)
    {
        return User::findOrfail($value);
    }

    public function getUnreadAttribute()
    {
        return Messages::where('send',$this->send->id)->whereNull('read_at')->count();
    }

    public function getImageAttribute($value)
    {
        if ($value != null) {
            return \URL::asset('/').setPublic().'uploads/backend/chats/'.$value;
        }else{
            return null;
        }
    }

    public function lastMessageSend($user_id)
    {
        return Messages::where('send',$user_id)->orderBy('id','desc')->first();
    }
}
