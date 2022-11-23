<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostDetails extends Layout
{
    protected function renderPage(Context $context): string
    {
        // @codingStandardsIgnoreStart
        return <<<HTML
            <p>SHOW CONTENT FOR {$context->getPostId()} HERE</p>
            <br>
            <p><b>Title : </b>{$context->pTitle}</p>
            <p><b>Body : </b><md-block>{$context->pBody}</md-block></p>
            <p><b>Author : </b>{$context->pAuthor}</p>
        HTML;
        // @codingStandardsIgnoreEnd
    }
}
