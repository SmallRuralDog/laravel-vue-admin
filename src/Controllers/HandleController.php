<?php


namespace SmallRuralDog\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleController extends Controller
{

    public function upload(Request $request)
    {
        $file = $request->file('file');

        $disk = config('admin.upload.disk');

        $path = $file->store('images', $disk);

        $data = [
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'url' => \Storage::disk($disk)->url($path)
        ];


        return \Admin::response($data);
    }

}
