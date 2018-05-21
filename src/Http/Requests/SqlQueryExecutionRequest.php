<?php

namespace Puncoz\ServerDashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SqlQueryExecutionRequest
 * @package Puncoz\ServerDashboard\Http\Requests
 */
class SqlQueryExecutionRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'query' => 'required',
        ];
    }
}
