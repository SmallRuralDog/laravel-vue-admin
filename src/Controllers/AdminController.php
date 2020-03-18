<?php

namespace SmallRuralDog\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use SmallRuralDog\Admin\Layout\Content;

class AdminController extends Controller
{

    use HasResourceActions;

    public function index(Content $content)
    {

        $content->body($this->grid())->className("m-10");
        return $this->isGetData() ? $this->grid() : $content;
    }


    public function create(Content $content)
    {


        $content->body($this->form())->className("m-10");
        return $this->isGetData() ? $this->form() : $content;
    }

    public function edit($id, Content $content)
    {


        $content->body($this->form(true)->edit($id))->className("m-10");
        return $this->isGetData() ? $this->form(true)->edit($id) : $content;
    }


    public function isGetData()
    {
        $get_data = request('get_data');
        return $get_data == "true";
    }

    protected function validatorData(Request $request, $rules, $message = [])
    {
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            abort(400, $validator->errors()->first());
        }
        return $validator;
    }

    protected function response($data, $message = '', $code = 200, $headers = [])
    {
        return Response::json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], 200, $headers);
    }

    protected function responseMessage($message = '', $code = 200)
    {
        return $this->response([], $message, $code);
    }

    protected function responseError($message = '', $code = 400)
    {
        return $this->response([], $message, $code);
    }

    protected function responseRedirect($url = '', $message = '', $code = 301)
    {
        return $this->response($url, $message, $code);
    }

    protected function vueData()
    {
        $data['copyright'] = config('admin.copyright');
        return $data;
    }
}
