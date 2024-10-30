<?php

namespace App\Http\Requests;

use App\Utils\ResponseUtil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Response;

class APIRequest extends FormRequest
{
    /**
     * Get the proper failed validation response for the request.
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        $messages = implode(' ', Arr::flatten($errors));

        return Response::json(ResponseUtil::makeError($messages), 400);
    }
}
