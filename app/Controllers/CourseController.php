<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class CourseController extends ResourceController
{
    public function __construct()
    {
        $courseModel = new CourseModel();
        // if(!session()->get('isLoggedIn')){
        //      redirect()->to('/register');
        // }
    }
    use ResponseTrait;
    public function index()
    {
        //
    }
    public function course_add()
    {
        $rules = [
            'teacher_id' => "required",
            'coursename' => "required",
            'leactures_course' => "required",
        ];
        $message = [
            "teacher_id" => [
                "required" => "Teacher ID is Required"
            ],
            "coursename" => [
                "required" => "CourseName is Required"
            ],

            "leactures_course" => [
                "required" => "leactures_course is Required"
            ],
        ];
        if (!$this->validate($rules, $message)) {
            $response = [

                'message' => $this->validator->getError(),


            ];
        } else {
            $courseModel = new CourseModel();
            $data['teacher_id'] = $this->request->getVar("teacher_id");
            $data['coursename'] = $this->request->getVar("coursename");
            $data['leactures_course'] = $this->request->getVar("leactures_course");
            $courseModel->save($data);
            $response = [

                'message' => 'Course is Successfully Added',

            ];
        }

        return $this->respondCreated($response);
    }
    public function course_view_single($id = null)
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
    public function view_all_data()
    {
        $courseModel = new CourseModel();
        $response = [
            'Message' => 'All Data',
            'data' => $courseModel->findAll()
        ];
        return $this->respondCreated($response);
    }

    public function course_update($id = null)
    {
        $rules = [
            "teacher_id" => "required",
            "coursename" => "required",
            "leactures_course" => "required",
        ];
        $message = [
            "teacher_id" => [
                "required" => "Teacher_id"
            ],
            "coursename" => [
                "required" => "Title Is Required"
            ],
            "leactures_course " => [
                "required" => "leactures_course is Requied"
            ],
        ];
        // var_dump($this->request->getJSON());
        // die;
        if (!$this->validate($rules, $message)) {
            $response = [
                'message' => $this->validator->getError(),
            ];
        } else {
            $courseModel = new CourseModel();
            if ($courseModel->find($id)) {
                $data['teacher_id'] = $this->request->getVar("teacher_id");
                $data['coursename'] = $this->request->getVar("coursename");
                $data['leactures_course'] = $this->request->getVar("leactures_course");

                $courseModel->update($id, $data);
                $response = [
                    'Message' => 'Course Successfully Update',
                ];
            } else {
                $response = [
                    'message' => 'No Course Found',
                ];
            }
        }
        return $this->respondCreated($response);
    }
    public function Delete($id = null)
    {
        $courseModel = new CourseModel();
        if (!empty($id)) {
            $courseModel->delete($id);
            $reponse = [
                'message' => 'Course Is SuccessFully Delete',
            ];
        } else {
            $reponse = [
                'message' => 'No Data is Found',
            ];
        }
        return $this->respondCreated($reponse);
    }
}
