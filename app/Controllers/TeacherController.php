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

    public function teacher_add()
  {
        $rules =[
                'coursename' => "required",
                'leactures_course' => "required",
        ];
        $message =[
             "coursename" =>[
               "required" =>"CourseName is Required"
             ],
             "leactures_course" =>[
                "required" =>"leactures_course is Required"
              ],
        ];
        if(!$this -> validate($rules,$message)){
            $response =[
           
            'message' => $this->validator->getError(),
         

            ];
        }else{
            $teacherModel = new TeacherModel();
            $data['coursename'] =$this->request->getVar("coursename");
            $data['leactures_course'] =$this->request->getVar("leactures_course");
            $teacherModel->save($data);
            $response =[
            
                'message' => 'Data is Successfully Added',
             
            ];
        }

        return $this->respondCreated($response);
    }
    public function teacher_view_single($id =null)
    {
     $teacherModel = new TeacherModel();
     $data =$teacherModel->find($id);
     if(!empty($data)){
         $response =[
              'Message' => 'Single Data',
              'data' => $data
         ];
     }else{
         $response =[
             'Message' => 'No Data Found',
         ];
     }
     return $this->respondCreated($response);

    }
    public function view_all_data()
    {
              $teacherModel = new TeacherModel();
              $response =[
                  'Message' =>'All Data',
                  $data = $teacherModel->findAll()
              ];
              return $this->respondCreated($response);
    }
    

    public function Update($id =null){
        $rules =[
            "coursename" => "required",
            "leactures_course" => "required",
      ];
      $message =[
          "coursename" => [
             "required" =>"Title Is Required"
          ],
          "leactures_course " =>[
               "required" =>"leactures_course is Requied"
          ],
      ];
      // var_dump($this->request->getJSON());
      // die;
      if(!$this->validate($rules,$message)){
          $response =[
         'message' =>$this->validator->getError(),
          ];
      }else{
          $teacherModel = new TeacherModel();
           if($teacherModel->find($id)){
               $data['coursename'] =$this->request->getVar("coursename");
               $data['leactures_course'] =$this->request->getVar("leactures_course");

               $teacherModel->update($id,$data);
               $response =[
                   'Message' => 'Course Successfully Update',
               ];
           }else{
               $response =[
                   'message' => 'No Data Found',
               ];
           }
      }
     return $this->respondCreated($response);
    }
    public function Delete($id =null)
    {
        $teacherModel = new TeacherModel();
        if(!empty($data)){
            $teacherModel->delete($id);
            $reponse =[
                'message' =>'Course Is SuccessFully Delete',
            ];
            
        }else{
            $reponse =[
                'message' =>'No Data is Found',
            ];
        }
          return $this->respondCreated($reponse);
    }
}
