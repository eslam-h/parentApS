<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserResource;
use Dev\Domain\Service\Abstracts\DataProvider;
use Dev\Application\Utility\DataProvider AS DataProviderUtility;

/**
 * Class ProductController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    private $dataProvider;

    public function __construct(DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function index(UserFormRequest $request)
    {
        $filters = $request->validated();
        if (isset($filters['provider'])) {
            $provider = DataProviderUtility::getProviderService($filters['provider']);
            if ($provider) {
                $this->dataProvider = $provider;
            }
        }
        $contents = $this->dataProvider->getData($filters);
        return UserResource::collection($contents);
    }
}