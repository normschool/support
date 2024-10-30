<?php

namespace App\Utils;

class ResponseUtil
{
    /**
     * @param  string  $message
     * @param  mixed  $data
     * @return array
     */
    public static function makeResponse(string $message, $data): array
    {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];
    }

    /**
     * @param  string  $message
     * @return array
     */
    public static function makeError(string $message, array $data = []): array
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (! empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}
