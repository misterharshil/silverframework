<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Model\Post as PostModel;

class PostDetails extends Controller
{
    private ?PostModel $post = null;

    public function getContext(): Context
    {
        $context = new Context();

        if ($this->post === null) {
            $context->title = 'Not Found';
            $context->content = "A post with id {$this->params[0]} was not found.";
        } else {
            $context->title = $this->post->getTitle();
            $context->setBody($this->post->getBody());
            $context->setAuthor($this->post->getAuthor());
        }

        return $context;
    }

    public function getTemplate(): Template\Template
    {
        if ($this->post === null) {
            return new Template\NotFound();
        }

        return new Template\PostDetails();
    }

    public function getStatus(): string
    {
        if ($this->post === null) {
            return $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found';
        }

        return $_SERVER['SERVER_PROTOCOL'] . ' 200 OK';
    }

    protected function loadData(): void
    {
        // Load the post data from the database
        $postModel = new PostModel($this->db);
        $postData = $postModel->getPost($this->params[0]);

        // Check if post data was found
        if ($postData !== null) {
            // Create a new Post instance and assign it to the $post property
            $this->post = new PostModel($this->db, $postData);
        }
    }
}
