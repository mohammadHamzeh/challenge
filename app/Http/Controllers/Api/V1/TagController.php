<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Contract\ApiController;
use App\Http\Requests\Api\V1\TagRequest;
use App\Models\Repository;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TagController extends ApiController
{
    /**
     * @param TagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_tag_repository(TagRequest $request)
    {
        try {
            DB::beginTransaction();

            /*store tags in database*/
            $tags = $this->store_tags($request->tags);

            /*store tags in pivot table repository_tag*/
            $this->store_tags_for_repository($tags, $request->repository_id);
            DB::commit();
            return $this->respondSuccessWithMessage('با موفقیت ذخیره شد ');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondWithErrorMessage($e->getMessage());
        }
    }

    /**
     * store tags in database and return collection  array id tags
     * @param $tags
     * @return Collection
     */
    private function store_tags($tags): Collection
    {
        $data = Collection::make([]);
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate([
                'slug' => $tag
            ]);
            $data->push($tag->id);
        }
        return $data;
    }

    private function store_tags_for_repository(Collection $tags, $repository_id)
    {
        $repository = Repository::find($repository_id);

        /*check duplicate tags for repositories */
        $this->check_duplicate_tag_repositories($tags, $repository);

        $repository->tags()->attach($tags);
    }

    private function check_duplicate_tag_repositories(Collection $tags, $repository)
    {
        /*get collection repository tags*/
        $repository_tags = $repository->tags;

        /*check duplicate in repository tag*/
        $collection = $repository_tags->whereIn('id', $tags);

        /*check is empty collection */
        if ($collection->isNotEmpty()) {
            $tags = $collection->pluck('slug')->implode(',');
            throw new \Exception("the tags $tags for repository exists");
        }
    }

}
