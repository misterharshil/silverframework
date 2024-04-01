<?php

namespace silverorange\DevTest;

class Context
{
    // TODO: You can add more properties to this class to pass values to templates

    public string $title = '';

    public string $content = '';
    
    /**
     * @var string
     */
    private $body = '';

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @var string
     */
    private $author = '';

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

       /**
     * @var array
     */
    private $posts = [];

    public function setPosts(array $posts)
    {
        $this->posts = $posts;
    }

    public function getPosts(): array
    {
        return $this->posts;
    }
}
