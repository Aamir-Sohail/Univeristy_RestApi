<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Auth implements FilterInterface
{
   
    public function before(RequestInterface $request, $arguments = null)
    {
        // var_dump('aamir');
        // die;
            
$user =Services::session()->get('user');
// var_dump($user);
// die;
        // if(!session()->get('isLoggedIn')){
        //     return redirect()->to('/login');
        // }
    
        $user = Services::session()->get('user');
        if (!$user || !$user['isLoggedIn']) {
            session()->setFlashdata('message', 'You are Not Logged IN.');
            return redirect()->to('/login');
        }
    }

    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
