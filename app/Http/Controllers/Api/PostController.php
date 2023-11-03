<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\PaginationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(Request $request, PaginationService $paginationService): Response
    {
        $limit = $request->input("limit");
        $page = $request->input("page");
        $posts = Post::all();

        $posts = $paginationService->paginate($posts, $limit, $page);

        return response(compact('posts'));
    }

    public function store(Request $request): Response
    {
        $data = $request->all();
        $post = Post::create($data);

        return response(compact('post'));
    }

    public function show(string $id): Response
    {
        $post = Post::find($id);

        return response($post);
    }

    public function search(Request $request, PostRepository $postRepository): Response
    {
        $searchText = $request->input('searchText');
        $searchField = $request->input('searchField');
        $filters = $request->input('filters');

        $posts = $postRepository->search($searchText, $searchField, $filters);
        return response(compact('posts'));
    }

    public function update(Request $request, string $id): Response
    {
        $data = $request->all();

        $post = Post::find($id);
        $post = $post->fill($data)->save();

        return response(compact('post'));
    }

    public function destroy(string $id): Response
    {
        $post = Post::find($id);
        $post->delete();

        return response('success');
    }
}
