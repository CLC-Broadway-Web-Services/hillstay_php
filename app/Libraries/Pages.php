<?php

namespace App\Libraries;


class Pages
{
    public function breadcrumb($pagedata)
    {
        return view('Frontend/components/breadcrumb', $pagedata);
    }
}
