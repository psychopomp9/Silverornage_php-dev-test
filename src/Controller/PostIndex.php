<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;

class PostIndex extends Controller
{
    private array $posts = [];

    public function getContext(): Context
    {
        $context = new Context();
        $context->title = 'Posts';
        $context->posts = $this->posts;
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        return new Template\PostIndex();
    }

    protected function loadData(): void
    {
        // TODO: Load posts from database here.
        $query = "SELECT p.title AS title, a.full_name AS author
                FROM posts p
                LEFT JOIN authors a
                    ON p.author = a.id
                ORDER BY p.modified_at DESC";
                
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $this->posts = $stmt->fetchAll();
    }
}
