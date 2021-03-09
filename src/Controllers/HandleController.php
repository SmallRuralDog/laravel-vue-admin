<?php


namespace SmallRuralDog\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleController extends Controller
{

    public function uploadFile(Request $request)
    {
        try {
            \Admin::validatorData($request->all(), [
                'file' => 'mimes:' . config('admin.upload.mimes', 'jpeg,bmp,png,gif,jpg')
            ]);
            return $this->upload($request);
        } catch (\Exception $exception) {
            return \Admin::responseError($exception->getMessage());
        }

    }

    public function uploadImage(Request $request)
    {
        try {
            \Admin::validatorData($request->all(), [
                'file' => 'mimes:' . config('admin.upload.mimes', 'jpeg,bmp,png,gif,jpg')
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
            $uniqueName = $request->input('uniqueName', config('admin.upload.uniqueName', false));
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
