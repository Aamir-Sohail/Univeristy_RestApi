<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\CourseModel;
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
            $user = $this->teacherModel->authenticate($this->request->getPost());

            if ($user) {
                // $this->session->set('user', $user);
                // $this->session->set('userrole', 'student');
                $response = [
                    'message' => 'Student is SuccessFully Login',
                ];
            }
        }
        // } catch (Exception $e) {
        //     var_dump($e);
        // }
        return $this->respond($response);
    }
    

           public function std_view($id = null)
           {
                 
            $courseModel = new CourseModel();
            $data = $courseModel->find($id);
            if (!empty($data)) {
                $response = [
                    'Message' => 'Single Data',
                    'data' => $data
                ];
            } else {
                $response = [
                    'Message' => 'No Data Found',
                ];
            }
            return $this->respondCreated($response);

           }

           public function un_register($id = null)

           {
            $courseModel = new CourseModel();
            if (!empty($id)) {
                $courseModel->delete($id);
                $reponse = [
                    'message' => 'Course Is SuccessFully Unregister',
                ];
            } else {
                $reponse = [
                    'message' => 'No Course is Found',
                ];
            }
            return $this->respond($reponse);
        }
        public function Student_logout()
        
        {
            $this->session->remove('user');
            // $this->session->destroy();
            
            return redirect()->to('std_login');
        }
               
           }



