<?php

namespace silverorange\DevTest;

class Context
{
    // TODO: You can add more properties to this class to pass values to templates

    public string $title = '';

    public string $content = '';

    public string $pId = '';
    public string $pTitle = '';
    public string $pBody = '';
    public string $pAuthor = '';

    public array $posts = [];

    public function getPostId(){
        return $this->pId;
    }
}
