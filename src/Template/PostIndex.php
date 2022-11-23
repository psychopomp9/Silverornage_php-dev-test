<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostIndex extends Layout
{
    protected function renderPage(Context $context): string
    {
        // add post title and author in table row
        $tabData = '';
        foreach($context->posts as $post){
            $tabData .= 
                "<tr>
                    <td>{$post['title']}</td>
                    <td>{$post['author']}</td>
                </tr>";
        }
        // @codingStandardsIgnoreStart
        return <<<HTML
                <p>SHOW ALL THE POSTS HERE</p>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                    {$tabData}
                </table>
        HTML;
        // @codingStandardsIgnoreEnd
    }
}
