<?php

namespace App\Http\Requests;

/**
 * Class UpdateUserNotificationRequest
 */
class UpdateUserNotificationRequest extends \App\Http\Requests\APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'is_subscribed' => 'required',
        ];

        return $rules;
    }
}
