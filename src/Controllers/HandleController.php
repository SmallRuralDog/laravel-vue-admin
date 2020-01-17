<?php


namespace SmallRuralDog\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleController extends Controller
{

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = $request->input('path', 'image');
        $uniqueName = $request->input('uniqueName', false);

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
    }

}
