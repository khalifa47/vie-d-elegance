<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{

    public function index()
    {
        $model = new UsersModel();
        $data = [
            'users' => $model->getUsers(),
            'title' => 'Users List'
        ];

        return view('users/view-users', $data);
    }
    public function view($id = null)
    {
        $model = new UsersModel();

        $data['user'] = $model->getUsers($id);

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User does not exist: ' . $id);
        }

        $data['title'] = $data['user']['first_name'] . " " . $data['user']['last_name'];

        return view('users/view-user', $data);
    }

    public function register()
    {
        $model = new UsersModel();

        if ($this->request->getMethod() === 'post') {
            if ($this->request->getPost('pass') === $this->request->getPost('conf-pass')) {
                $model->save([
                    'first_name' => $this->request->getPost('fname'),
                    'last_name' => $this->request->getPost('lname'),
                    'email' => $this->request->getPost('emailadd'),
                    'password' => sha1($this->request->getPost('pass')),
                    'gender' => $this->request->getPost('gender'),
                    'role' => 2
                ]);

                return view('pages/login', ['title' => 'Login']);
            } else {
                return view('users/failed');
                //die("<script>alert('Passwords must match!'); document.location = '/pages/view/login';</script>");
            }
        } else {
            return view('pages/login', ['title' => 'Register']);
        }
    }

    public function login()
    {
        $model = new UsersModel();

        if ($this->request->getMethod() === 'post') {

            $users = $model->getUsers();

            if (empty($users)) {
                return view('users/failed');
            } else {
                $validated = FALSE;

                foreach ($users as $user) {
                    if ($this->request->getPost('emailadd') === $user['email'] && sha1($this->request->getPost('pass')) === $user['password']) {
                        //$_SESSION['uname'] = $this->request->getPost('uname');
                        $validated = TRUE;

                        session()->set(['uname' => $user['first_name']]);
                        session()->set(['id' => $user['user_id']]);
                        session()->set(['isLogged' => TRUE]);

                        $data['title'] = "Home";

                        //return view('pages/index', $data);
                        return redirect('/', $data);
                    }
                }
                if (!$validated) {
                    echo "<script>alert('Invalid credentials!')</script>";

                    return view('pages/login', ['title' => 'Login']);
                }
            }
        } else {
            return view('pages/login', ['title' => 'Login']);
        }
    }

    public function logout()
    {
        session()->set(['isLogged' => FALSE]);
        session()->destroy();

        //return view('pages/index', ['title' => 'Home']);
        return redirect('/', ['title' => 'Home']);
    }

    public function edit()
    {
        $model = new UsersModel();

        if ($this->request->getMethod() === 'post') {
            if ($this->request->getPost('pass') === $this->request->getPost('conf-pass')) {
                $model->update($this->request->getPost('id'), [
                    'first_name' => $this->request->getPost('fname'),
                    'last_name' => $this->request->getPost('lname'),
                    'email' => $this->request->getPost('emailadd'),
                ]);

                echo "<script>alert('Update Successful')</script>";
                //return view('pages/index', ['title' => 'Home']);
                return redirect('/', ['title' => 'Home']);
            } else {
                return view('users/failed');
                //die("<script>alert('Passwords must match!'); document.location = '/pages/view/login';</script>");
            }
        } else {
            return view('pages/login', ['title' => 'Register']);
        }
    }
}
