<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Model;

class PostDetails extends Controller
{
    private ?Model\Post $post = null;

    public function getContext(): Context
    {
        $context = new Context();

        if ($this->post === null) {
            $context->title = 'Not Found';
            $context->content = "A post with id {$this->params[0]} was not found.";
        } else {
            $context->title = $this->post->title;
            $context->pId = $this->post->id;
            $context->pTitle = $this->post->title;
            $context->pBody = $this->post->body;
            $context->pAuthor = $this->post->author;
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
        // TODO: Load post from database here. $this->params[0] is the post id.
        $query = sprintf(
            "SELECT *
            FROM posts
            LEFT JOIN authors
                ON posts.author = authors.id
            WHERE posts.id = '%s'",

            $this->params[0]
        );

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(!empty($result)){
            $fPost = new Model\Post();

            foreach($result as $k=>$v){
                $fPost->$k = $v;    
            }
            $fPost->author = $result['full_name'];
        }else{
            $fPost = null;
        }
        $this->post = $fPost;
    }
}
