<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class StudentController extends ResourceController
{
    public function __construct()
    {
        $this -> studendModel = new StudentModel();
        
    }
    use ResponseTrait;
    public function index()
    {
        //
    }
    public function student_register()
    {
        $rules = [
            'studentname' => "required",
            'fathername' => "required",
            'semester' => "required",
            'email' => "required|valid_email|trim",
            'password' => "required",
            'add_course' => "required",
        ];
        $message =[
            "studentname" =>[
               "required" => "StudentName is Required"
            ],
            "fathername" => [
                "required" => "F/Name is Required"
            ],
            "semester" => [
                "required" => "Semester is Required"
            ],
            "email" => [
                "required" => "Email is Required"
            ],
            "add_course" => [
                "required" => "Add_Course is Required"
            ],
        ];
        if (!$this->validate($rules, $message)) {
            $response = [

                'message' => $this->validator->getError(),
            ];
        }else{
            $studendModel = new StudentModel();
            $data['studentname'] = $this->request->getVar("studentname");
            $data['fathername'] = $this->request->getVar("fathername");
            $data['semester'] = $this->request->getVar("semester");
            $data['email'] = $this->request->getVar("email");
            $data['password'] = $this->request->getVar("password");
            $data['add_course'] = $this->request->getVar("add_course");
            $studendModel->save($data);
            $response =[
                'message' =>  'Student is SuccessFully Register'
            ];
        }
        return $this->respondCreated($response);
    }

    public function student_login() 
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
                $user = $this->teacherModel->authenticate($this->request->getJSON());
                $session = session();
                if ($user) {
                    $this->session->set('user', $user);
                    $response = [
                        'message' => 'SuccessFully Login',
                    ];
                }
            }
        // } catch (Exception $e) {
        //     var_dump($e);
        // }
        // return $this->respondCreated($response);
     
           
       
}

}


