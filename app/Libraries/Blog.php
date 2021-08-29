<?php

namespace App\Libraries;


class Blog
{
    public function post_block($post)
    {
        return view('Frontend/components/post_block', $post);
    }
}
