<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        // return $reply->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Reply $reply)
    {
        // 评论的作者和评论文章的作者才有资格
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
