<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Handlers\ImageUploader;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['show']]); //只有个人页面不需要授权
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }


    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user, ImageUploader $uploader){
        $data= $request->all();
        //处理图片
        if ($request->avatar){
            $imageInfo = $uploader->save($request->avatar,'avatar',Auth::id(),200);
            $data['avatar'] = $imageInfo['path'];
        }
        $user->update($data);
        return redirect()->route('users.show',[$user])->with('success','资料更新成功');
    }
}
