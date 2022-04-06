<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use config\Services;
class Student implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = Services::session()->get('user');
        if (!$user || !$user['isLoggedIn']) {
            session()->setFlashdata('message', 'You are Not Logged IN.');
            return redirect()->to('/std_login');
        }
    }

  
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
