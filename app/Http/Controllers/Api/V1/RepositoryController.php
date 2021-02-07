<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\RepositoryFilter;
use App\Http\Controllers\Api\V1\Contract\ApiController;
use App\Http\Resources\Api\V1\RepositoryResource;
use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $repositories = Repository::Filters(new RepositoryFilter())->get();
        return $this->respondSuccessWithData(RepositoryResource::collection($repositories));
    }

    
}
