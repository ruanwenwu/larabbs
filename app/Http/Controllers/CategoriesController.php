<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Topic;

class CategoriesController extends Controller
{
    public function show(Category $category,Topic $topic,Request $request){
        $topics = $topic->withOrder($request->order)->where('category_id',$category->id)->with(['user','category'])->paginate(20);
        return view('topics.index',compact(['category','topics']));
    }
}
