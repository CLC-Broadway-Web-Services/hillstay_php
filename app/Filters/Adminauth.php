<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Admin\AdminModel;

class Adminauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $adminModel = new AdminModel();
        if ($adminModel->checkUser() == 'false') {
			return redirect()->to('/administrator/login');
		}
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // $adminModel = new AdminModel();
        // if ($adminModel->checkUser() === 'false') {
		// 	return redirect()->to('/admin/login');
		// }
    }
}