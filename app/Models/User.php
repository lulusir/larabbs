<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        // 我们对 notify() 方法做了一个巧妙的重写，现在每当你调用 $user->notify() 时，
        // users 表里的 notification_count 将自动 +1。
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 关联user和topics
     *
     * @return user->topics
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * 判断是否通过授权
     *
     * @param [type] $model
     * @return boolean
     */
    public function isAuthorOf($model)
    {
        return $this->id === $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
