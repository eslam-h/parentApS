<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\AbstractFormRequest;
use Illuminate\Http\Request;

/**
 * Class UserFormRequest
 * @package App\Http\Requests
 */
class UserFormRequest extends AbstractFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $method = $request->getMethod();
        $action = $request->route()->getActionMethod();
        if ($method === 'GET') {
            if ($action == 'index') {
                return [
                    'provider' => 'sometimes|string',
                    'statusCode' => 'sometimes|string',
                    'balanceMin' => 'sometimes|integer',
                    'balanceMax' => 'sometimes|integer',
                    'currency' => 'sometimes|string'
                ];
            }
        }
        return [];
    }
}