<?php
//测试
function test(){
    echo 3;die;
}

//route类名转化为routeclass
function route_class(){
    return str_replace('.','-',Route::currentRouteName());
}

function activeCategory($categoryid){
    return active_class(if_route('categories.show') && if_route_param('category',$categoryid));
}

function make_excerpt($value,$length = 200){
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/','', strip_tags($value)));
    return Str::limit($excerpt,$length);
}