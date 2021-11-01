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

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($this->request->getPost('pass') === $this->request->getPost('confpass')) {
            if ($model->checkEmail($this->request->getPost('emailadd'))) {
                $response['message'] = "Email address already exists";
            } else {
                $model->save([
                    'first_name' => $_POST['fname'],
                    'last_name' => $_POST['lname'],
                    'email' => $_POST['emailadd'],
                    'password' => sha1($_POST['pass']),
                    'gender' => $_POST['gender'],
                    'role' => 2
                ]);

                $response['status'] = 1;
                $response['message'] = "Registration successful";
                //return view('pages/login', ['title' => 'Login']);
            }
        } else {
            $response['message'] = "Passwords must match!";
        }
        echo json_encode($response);
    }

    public function login()
    {
        $model = new UsersModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        $users = $model->getUsers();

        if (empty($users)) {
            $response['message'] = "Server error!";
        } else {
            $validated = FALSE;

            foreach ($users as $user) {
                if ($this->request->getPost('emailadd') === $user['email'] && sha1($this->request->getPost('pass')) === $user['password']) {
                    //$_SESSION['uname'] = $this->request->getPost('uname');
                    $validated = TRUE;

                    if (session()->get('isLogged')) {
                        $response['status'] = 0;
                        $response['message'] = "User is already logged in";
                    } else {
                        session()->set(['uname' => $user['first_name']]);
                        session()->set(['id' => $user['user_id']]);
                        session()->set(['utype' => $user['role']]);
                        session()->set(['isLogged' => TRUE]);

                        $response['status'] = 1;
                        $response['message'] = "Login successful";

                        // $data['title'] = "Home";

                        // return view('pages/index', $data);
                        //return redirect('/', $data);
                    }
                }
            }
            if (!$validated) {
                $response['message'] = "Invalid email/password combination";
            }
        }
        echo json_encode($response);
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
            $model->update($this->request->getPost('id'), [
                'first_name' => $this->request->getPost('fname'),
                'last_name' => $this->request->getPost('lname'),
                'email' => $this->request->getPost('emailadd'),
            ]);

            echo "<script>alert('Update Successful')</script>";
            //return view('pages/index', ['title' => 'Home']);
            return redirect('/', ['title' => 'Home']);
        } else {
            return view('pages/login', ['title' => 'Register']);
        }
    }

    public function editPass()
    {
        $model = new UsersModel();

        if ($this->request->getMethod() === 'post') {
            $user = $model->getUsers($this->request->getPost('id'));

            if (empty($user)) {
                return view('users/failed');
            } else {
                if (sha1($this->request->getPost('old-pass')) === $user['password']) {
                    if ($this->request->getPost('new-pass') === $this->request->getPost('conf-new-pass')) {
                        $model->update($this->request->getPost('id'), [
                            'password' => sha1($this->request->getPost('new-pass'))
                        ]);

                        echo "<script>alert('Password Successfully Changed')</script>";
                        return redirect('/', ['title' => 'Home']);
                    } else {
                        echo "<script>alert('Passwords must match!')</script>";
                        return redirect('/edit-password', ['title' => 'Change Password']);
                    }
                } else {
                    echo "<script>alert('Incorrect Password Entered')</script>";
                    return redirect('/edit-password', ['title' => 'Change Password']);
                }
            }
        } else {
            return view('pages/login', ['title' => 'Register']);
        }
    }
}
