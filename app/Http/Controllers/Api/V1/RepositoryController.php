<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\RepositoryFilter;
use App\Http\Controllers\Api\V1\Contract\ApiController;
use App\Http\Resources\Api\V1\RepositoryResource;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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


    /**
     * @param $username
     * @return \Illuminate\Http\JsonResponse|Collection
     * @queryParam username required the github username for get stared projects
     */
    public function get_stared_repositories($username)
    {
        try {
            /*get stared project from github*/
            $repositories = $this->get_stared_project_github($username);

            /*insert repositories to database and return data*/
            return $this->store_repositories_to_database($repositories);

        } catch (\Exception $exception) {
            return $this->respondWithErrorMessage($exception->getMessage());
        }
    }


    /**
     * get stared project from github
     * @param $username
     * @return Collection
     */
    private function get_stared_project_github($username)
    {
        $request = Http::get("https://api.github.com/users/{$username}/starred")->json();
        return Collection::make($request);
    }

    /**
     * insert repositories to database and return data
     * @param Collection $repositories
     * *@return Collection
     */
    private function store_repositories_to_database(Collection $repositories)
    {
        $data = Collection::make([]);
        $repositories->map(function ($item) use ($data) {
            $repository = Repository::firstOrCreate([
                "repository_id" => $item['id'],
                "repository_name" => $item['name'],
                "description" => $item['description'],
                "url" => $item['url'],
                "language" => $item['language'] ?? 'not define',
            ]);
            $data->push($repository);
        });
        return $data;
    }


}
