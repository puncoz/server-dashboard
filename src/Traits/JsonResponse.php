<?php

namespace Puncoz\ServerDashboard\Traits;

/**
 * Trait JsonResponse
 * @package Puncoz\ServerDashboard\Traits
 */
trait JsonResponse
{
    /**
     * @param string     $message
     * @param array|null $data
     *
     * @return array
     */
    private function makeResponse(string $message, $data): array
    {
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    private function makeError(string $message, array $data = []): array
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if ( !empty($data) ) {
            $res['data'] = $data;
        }

        return $res;
    }
}
