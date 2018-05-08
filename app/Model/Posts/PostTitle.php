<?php

namespace App\Model\Posts;

class PostTitle
{
    private $title;

    public function __construct(string $title)
    {
        if (!$title || mb_strlen($title) > 255) {
            throw new \InvalidArgumentException('Title is missing or longer than 255 characters');
        }

        $this->title = $title;
    }

    public function toString(): string
    {
        return $this->title;
    }
}
