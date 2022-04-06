<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Config\Services;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;


class TeacherController extends ResourceController
{

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
        $this->session = Services ::session();
        $this->db = db_connect();
    }
    use ResponseTrait;
    public function index()
    {
    }
    public function Teacher_Register()
    {
        $rules = [

            'name' => "required",
            'email' => "required|valid_email|trim",
            'password' => "required",
            'address' => "required",
        ];
        $message = [

            "name" => [
                "required" => "Name is Required"
            ],
            "email" => [
                "required" => "Email is Required"
            ],
            "password" => [
                "required" => "Password is Required"
            ],
            "address" => [
                "required" => "Address is Required"
            ],
        ];
        if (!$this->validate($rules, $message)) {
            $response = [

                'message' => $this->validator->getError(),
            ];
        } else {
            $teacherModel = new TeacherModel();

            $data['name'] = $this->request->getVar("name");
            $data['email'] = $this->request->getVar("email");
            $data['password'] = $this->request->getVar("password");
            $data['address'] = $this->request->getVar("address");
            $teacherModel->save($data);
            $response = [
                'message' => 'SuccessFully Register',
            ];
        }
        return $this->respondCreated($response);
    }

    public function loginForm(){

        return view('login');
    }
    public function Teacher_Login()
    {
        $rules = [


            'email' => "required|valid_email|trim",
            'password' => "required",

        ];
        $message = [

            "email" => [
                "required" => "Email is Required"
            ],
            "password" => [
                "required" => "Password is Required"
            ],
        ];
        // try {
        // var_dump($this->request->getJSON());
        // die;

        if (!$this->validate($rules, $message)) {
            $response = [
                'message' => $this->validator->getError(),
            ];
        } else {
            $user = $this->teacherModel->authenticate($this->request->getPost());
           
            if ($user) {
                $this->session->set('user', $user);
                $this->session->set('userrole', 'teacher');
                $response = [
                    'message' => 'Teacher SuccessFully Login',
                ];
            }
        }
        // } catch (Exception $e) {
        //     var_dump($e);
        // }
        return $this->respond($response);
        // var_dump($this->request->getPost());
        // die;
        // $user = $this->teacherModel->authenticate($this->request->getPost());

        // if ($user) {
        //     $this->session->set('user', $user);
        //     $this->session->set('userrole', 'teacher');
        //     return redirect()->to('/');
        // }

       
    
    }
}
