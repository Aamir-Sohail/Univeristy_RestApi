<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;


class TeacherController extends ResourceController
{

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
    }
    use ResponseTrait;
    public function index()
    {
        //
    }
    public function Teacher_Register()
    {
        $rules = [
            'course_id' => "required",
            'name' => "required",
            'email' => "required|valid_email|trim",
            'password' => "required",
            'address' => "required",
        ];
        $message = [
            "course_id" => [
                "required" => "ID is Required"
            ],
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
        }else{
                $teacherModel = new TeacherModel();
                $data['course_id'] = $this->request->getVar("course_id");
                $data['name'] = $this->request->getVar("name");
                $data['email'] = $this->request->getVar("email");
                $data['password'] = $this->request->getVar("password");
                $data['address'] = $this->request->getVar("address");
                $teacherModel->save($data);
                $response =[
                    'message' => 'SuccessFully Register',
                ];
        }
    }




}
