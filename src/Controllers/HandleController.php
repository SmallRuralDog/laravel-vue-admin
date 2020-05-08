<?php


namespace SmallRuralDog\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleController extends Controller
{

    public function uploadFile(Request $request)
    {
            return $this->upload($request);
    }

    public function uploadImage(Request $request)
    {
        try {
            \Admin::validatorData($request->all(), [
                'file' => 'image'
            ]);

            return $this->upload($request);

        } catch (\Exception $exception) {
            return \Admin::responseError($exception->getMessage());
        }
    }


    protected function upload(Request $request)
    {
        try {
            $file = $request->file('file');
            $type = $request->file('type');
            $path = $request->input('path', 'images');
            $uniqueName = $request->input('uniqueName', false);

            //如果配置了 mimes 则只可以上传 mimes 配置内的文件类型，否则默认只能传 image 类型的文件
            $mimes = config('admin.upload.mimes');
            \Admin::validatorData($request->all(), [
                'file' => $mimes ? 'mimes:' . $mimes : 'image',
            ]);

            $disk = config('admin.upload.disk');
            $name = $file->getClientOriginalName();
            if ($uniqueName == "true" || $uniqueName == true) {
                $path = $file->store($path, $disk);
            } else {
                $path = $file->storeAs($path, $name, $disk);
            }
            $data = [
                'path' => $path,
                'name' => $name,
                'url' => \Storage::disk($disk)->url($path)
            ];
            return \Admin::response($data);
        } catch (\Exception $exception) {
            return \Admin::responseError($exception->getMessage());
        }

    }

}
