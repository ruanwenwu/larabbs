<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Category;

class HeaderComposer
{
    /**
     * 实现 UserRepository
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * 创建一个新的 profile 合成器.
     *
     * @param  UserRepository  $users
     * @return void
     */

    /**
     * 将数据绑定到视图
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = Category::all();
        //$view->with('count', $this->users->count());
        $view->with('categoryNavs',$categories);
    }
}