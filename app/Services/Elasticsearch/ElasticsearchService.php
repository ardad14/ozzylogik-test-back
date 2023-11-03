<?php

namespace App\Services\Elasticsearch;


use Elastic\Elasticsearch\Client;

class ElasticsearchService
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $class, string $searchText, string $searchField, ?array $filters): ElasticsearchCollection
    {
        $model = new $class;

        $searchQuery = [
            'should' => [
                'match' => [
                    $searchField => $searchText,
                ],
            ],
        ];

        if (isset($filters)) {
            $searchQuery['filter'] = [];
            foreach ($filters as $field => $value) {
                $searchQuery['filter'] = array_merge($searchQuery['filter'], [
                    'term' => [
                        $field => $value
                    ]
                ]);
            }
        }

        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'bool' => $searchQuery
                ],
            ],
        ]);

        return $model->hydrateElasticsearchResult($items->asArray());
    }
}

