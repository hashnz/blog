<?php

namespace App\Model\Posts;

use Ramsey\Uuid\UuidInterface;

interface PostRepository
{
    public function get(UuidInterface $uuid): ?Post;
    public function add(Post $post): void;
    public function save(Post $post): void;
    public function remove(Post $post): void;

    /**
     * @return Post[]
     */
    public function all(): array;
}
