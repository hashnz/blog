<?php

namespace App\Model\Posts;

use MongoDB\Client;
use MongoDB\Model\BSONDocument;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class MongoPostRepository implements PostRepository
{
    private $collection;

    public function __construct(Client $client)
    {
        $this->collection = $client->blog->posts;
    }

    public function get(UuidInterface $uuid): ?Post
    {
        $document = $this->collection->findOne(['id' => $uuid->toString()]);

        return $document ? $this->fromDocument($document) : null;
    }

    /**
     * @return Post[]
     */
    public function all(): array
    {
        $cursor = $this->collection->find();
        $posts = [];
        foreach ($cursor as $document) {
            $posts[] = $this->fromDocument($document);
        }

        return $posts;
    }

    public function add(Post $post): void
    {
        $this->collection->insertOne($this->toDocument($post));
    }

    public function save(Post $post): void
    {
        $this->collection->replaceOne(['id' => $post->getId()], $this->toDocument($post));
    }

    public function remove(Post $post): void
    {
        $this->collection->deleteOne(['id' => $post->getId()]);
    }

    private function fromDocument(BSONDocument $document): Post
    {
        return new Post(
            Uuid::fromString($document['id']),
            new PostTitle($document['title']),
            $document['body'],
            new \DateTimeImmutable($document['createdAt']),
            new \DateTimeImmutable($document['updatedAt'])
        );
    }

    private function toDocument(Post $post): array
    {
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'body' => $post->getBody(),
            'createdAt' => $post->getCreatedAt()->format(DATE_ATOM),
            'updatedAt' => $post->getUpdatedAt()->format(DATE_ATOM),
        ];
    }
}
