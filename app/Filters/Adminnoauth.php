<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Admin\AdminModel;

class Adminnoauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $adminModel = new AdminModel();
        if ($adminModel->checkUser()) {
            return redirect()->to('/administrator');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
