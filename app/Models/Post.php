<?php

namespace App\Models;

use App\Services\Elasticsearch\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $collection = 'posts';
    protected $primaryKey = '_id';
    protected $fillable = [
        'title',
        'description',
        'text',
        'date',
    ];
}
