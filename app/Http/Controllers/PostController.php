<?php

namespace App\Http\Controllers;

use App\Model\Posts\Post;
use App\Model\Posts\PostRepository;
use App\Model\Posts\PostTitle;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getBlogPosts()
    {
        $posts = [];
        foreach ($this->postRepository->all() as $post) {
            $posts[] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'createdAt' => $post->getCreatedAt()->format('Y-m-d'),
            ];
        }

        return view('blog.posts', ['posts' => $posts]);
    }

    public function getBlogPost(string $id)
    {
        $post = $this->postRepository->get(Uuid::fromString($id));
        if (!$post) {
            abort(404, 'The post could not be found.');
        }

        $payload = ['post' => [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'body' => $post->getBody(),
        ]];

        return view('blog.post', $payload);
    }

    public function addBlogPost(Request $request)
    {
        $this->authorize('create', Post::class);
        if ($request->isMethod('get')) {

            return view('blog.postForm');
        }

        $validatedData = $this->validatePost($request);

        $uuid = Uuid::uuid4();
        $title = new PostTitle($validatedData['title']);
        $post = new Post($uuid, $title, $validatedData['body']);

        $this->postRepository->add($post);

        return redirect(route('blog.post', $post->getId()));
    }

    public function updateBlogPost(Request $request, string $id)
    {
        $this->authorize('update', Post::class);
        $post = $this->postRepository->get(Uuid::fromString($id));
        if (!$post) {
            abort(404, 'The post could not be found.');
        }

        if ($request->isMethod('get')) {

            $payload = ['post' => [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'body' => $post->getBody(),
            ]];

            return view('blog.postForm', $payload);
        }

        $validatedData = $this->validatePost($request);

        $title = new PostTitle($validatedData['title']);
        $post->update($title, $validatedData['body']);
        $this->postRepository->save($post);

        return redirect(route('blog.post', $post->getId()));
    }

    public function deleteBlogPost(Request $request)
    {
        $this->authorize('delete', Post::class);
        $id = Uuid::fromString($request->get('id'));
        $post = $this->postRepository->get($id);
        if (!$post) {
            abort(404, 'The post could not be found.');
        }

        $this->postRepository->remove($post);

        return redirect(route('blog'));
    }

    private function validatePost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        return $validatedData;
    }
}
