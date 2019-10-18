<?php
namespace App\Handlers;
use Illuminate\Support\Str;
use Image;

class ImageUploader{
    protected $allowedExt = ['jpg','png','jpeg','gif'];

    /**
     * @param $file 文件资源
     * @param $folder 文件夹
     * @param $filePrefix 文件前缀名
     */
    public function save($file, $folder, $filePrefix,$maxWidth = false){
        //如果不在前缀名中return false;

        $fileExt = strtolower($file->getClientOriginalExtension()) ?: 'png';

        if (!in_array($fileExt, $this->allowedExt)){
            return false;
        }

        $folderName = 'uploads/images/'.$folder."/".date("Ym/d",time())."/";
        $uploadPath = public_path()."/".$folderName;
        $fileName   = $filePrefix."_".time()."_".Str::random().".".$fileExt;
        $file->move($uploadPath,$fileName);
        if ($maxWidth && $fileExt != 'gif'){
            $this->reduceSize($uploadPath.$fileName,$maxWidth);
        }
        return [
            'path'  => config("app.url")."/".$folderName.$fileName
        ];

    }

    public function reduceSize($file,$maxWidth){
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file);

        // 进行大小调整的操作
        $image->resize($maxWidth, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }
}