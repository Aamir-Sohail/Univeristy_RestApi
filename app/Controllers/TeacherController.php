<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Config\Services;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use \Firebase\JWT\JWT;

class TeacherController extends ResourceController
{

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
        $this->session = Services::session();
        $this->db = db_connect();
    }
    use ResponseTrait;
    public function index()
    {
    }
    public function Teacher_Register()
    {
    //   try{
		helper(['form']);
		$rules = [
            'name' => 'required',
			'email' => 'required|valid_email',
			'password' => 'required|min_length[6]',
            'address' => 'required',
		];
		if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
		$data = [
            'name' => $this->request->getVar('name'),
			'email' 	=> $this->request->getVar('email'),
			'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'address' => $this->request->getVar('address')
		];
		$teacherModel = new TeacherModel();
		$register = $teacherModel->save($data);
		$this->respondCreated($register);
    // }catch(Exception $aamir){
    //     var_dump($aamir);
    //     die;
    // }
    }
    
    
    
    public function Teacher_Login()
    {
        $teacherModel = new TeacherModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
          
        $user = $teacherModel->where('email', $email)->first();
        // $user = $this->teacherModel->authenticate($this->request->getPost());
  
        if(is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
        // var_dump($user);
        // die;
  
        $pwd_verify = password_verify($password, $user['password']);
  
        if(!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
 
        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
 
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
        );
         
        $token = JWT::encode($payload, $key,'HS256');
 
        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
         
        return $this->respond($response, 200);
    
    }
    public function Teacher_logout()
        
    {
        $this->session->remove('user');
        
        return redirect()->to('/login');
    }
}
