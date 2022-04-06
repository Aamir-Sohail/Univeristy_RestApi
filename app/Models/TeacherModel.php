<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'teachers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
         'name', 'email','password','address'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function transBegin()
    {

        return $this->db->transBegin();
    }


    public function transRollBack()
    {
        return $this->db->transRollback();
    }

    public function transCommit()
    {
        return $this->db->transCommit();
    }
   
    public function authenticate($user)
    {
        // var_dump($user);
        // die;
        $password = $user['password'];
       
        $user = $this->getWhere(['email' => $user['email']]);

        if ($user->resultID->num_rows > 0) {
            $user = $user->getRow();
            // $verify = password_verify($password, $user->password);

            // if ($verify) {
                return ['user_id' => $user->id, 'email' => $user->email, 'isLoggedIn' => true];
            // } else {
            //     return false;
            // }
        }

        return false;
    }
}
