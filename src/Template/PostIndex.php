<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostIndex extends Layout
{
    protected function renderPage(Context $context): string
    {
        // @codingStandardsIgnoreStart
        $posts = $context->getPosts();
        $data = "";
        foreach($posts as $post){
            $data .= "<div class='card'>
                <a href='/posts/".$post["id"]."'>".$post["title"]."</a>
            </div>";
        }
        return <<<HTML
<h1>News Articles</h1>
            {$data}
HTML;
        // @codingStandardsIgnoreEnd
    }
}
