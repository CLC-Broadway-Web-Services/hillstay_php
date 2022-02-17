<?php

namespace App\Libraries;


class Client
{
    public function client_block($project)
    {
        return view('Frontend/components/project_block', $project);
    }
}
