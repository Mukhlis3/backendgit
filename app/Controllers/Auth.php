<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        return view('auth/login');
    }
    
    public function authenticate(){
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if($user){
            if(password_verify($password,$user['password'])){
                $sessionData = [
                    'id' => $user ['id'],
                    'name' => $user ['name'],
                    'email' => $user ['email'],
                    'logged_in' => true,
                ];
                $session-> set($session_Data);
                return redirect()->to("/dashboard");
            }else{
                $session->setFlashdata("error","password is incorrect");
                return redirect()->to("/login");
            }
        }else{
            $session->setFlashdata("error","email not found");
                return redirect()->to("/login");
        }
    }
    public function register(){
        helper(['form']);
        return view ('auth/register');
    }

    public function store() {
        helper(['form', 'url']);
        $model = new UserModel();

        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            $model->save($data);
            return redirect()->to("/login");
        } else {
            return view("auth/register", [
                'validation' => $this->validator
            ]);
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to("/login");
    }
}


 