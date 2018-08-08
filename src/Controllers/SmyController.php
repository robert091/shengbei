<?php
/**
 * Created by PhpStorm.
 * User: haoqi
 * Date: 2018/8/8
 * Time: 16:24
 */

namespace Crius\Smy\Controllers\Smy;


use App\Exceptions\ValidateException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmyController extends Controller
{
    public function validateApi(Request $request, array $rules,
                                array $messages = [], array $customAttributes = [])
    {
        $validate = $this->getValidationFactory()
            ->make($request->all(), $rules, $messages, $customAttributes);

        if ($validate->fails()) {
            $this->throwError($validate->errors()->first());
        }
    }

    protected function throwError($error){
        $exception = new ValidateException();
        $exception->render($error);
        throw $exception;
    }
}