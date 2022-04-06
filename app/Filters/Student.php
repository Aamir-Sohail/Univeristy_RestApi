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
        if(!session()->get('isLoggedIn')){
            // var_dump($user);
            //  die;
            return redirect()->to(site_url('/login'));
    }
}

  
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
