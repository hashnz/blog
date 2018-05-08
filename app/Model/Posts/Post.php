<?php

namespace App\Model\Posts;

use Ramsey\Uuid\UuidInterface;

class Post
{
    private $id;
    private $title;
    private $body;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        UuidInterface $id,
        PostTitle $title,
        string $body,
        \DateTimeImmutable $createdAt = null,
        \DateTimeImmutable $updatedAt = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
        $this->updatedAt = $updatedAt ?? new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id->toString();
    }

    public function getTitle(): string
    {
        return $this->title->toString();
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function update(PostTitle $title, string $body): void
    {
        $this->title = $title;
        $this->body = $body;
        $this->updatedAt = new \DateTimeImmutable();
    }
}
