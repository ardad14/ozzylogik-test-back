<?php

namespace App\Repositories;

use App\Models\Post;
use App\Services\Elasticsearch\ElasticsearchService;

class PostRepository
{
    public function search(string $searchText, string $searchField, ?array $filters): array
    {
        $elasticsearchService = app(ElasticsearchService::class);

        $searchResult = $elasticsearchService->search(Post::class, $searchText, $searchField, $filters);

        return $searchResult->toArray();
    }
}
