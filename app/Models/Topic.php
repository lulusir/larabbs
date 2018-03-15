<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {

        // 不同排序方式的處理
        switch ($order) {
            case 'recent':
                $query = $this->recent();
                break;
            default:
                $query = $this->recentReplied();
                break;
        }
        // 預加載避免N+1
        return $query->with('user', 'category');
    }

    public function scopeRecent($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新

        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecentReplied($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}
