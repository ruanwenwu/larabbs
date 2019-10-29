<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id','slug'];
    //关联分类模型
    public function category(){
        return $this->belongsTo(Category::class);
    }


    //关联用户模型
    public function user(){
        return $this->belongsTo(User::class);
    }

    //话题排序本地作用域
    public function scopeWithOrder($query,$order){
        switch($order){
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
    }

    //最近排序
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at','DESC');
    }

    //最新回复排序
    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }
}
