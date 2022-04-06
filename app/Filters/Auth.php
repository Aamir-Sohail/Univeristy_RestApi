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
   
            
       
    
        $user = Services::session()->get('user');
      
        // if (!$user->get('isLoggedIn')) {
        //     var_dump($user);
        //     die;
        //     return redirect()->to(site_url('/login'));
        // }

        if(session()->get('isLoggedIn')){
            // var_dump($user);
            //  die;
            return redirect()->to(site_url('/add'));
        }
    }

    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
