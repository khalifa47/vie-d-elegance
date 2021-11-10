<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CategoriesModel;

class UsersController extends BaseController
{

    public function index()
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();

        $data = [
            'categories' => $modelCat->getCategories(),
            'users' => $modelUsers->getUsers(),
            'title' => 'Users List'
        ];

        return view('users/admin/view-users', $data);
    }
    public function view($id = null)
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();

        $data = [
            'categories' => $modelCat->getCategories(),
            'user' => $modelUsers->getUsers($id)
        ];

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User does not exist: ' . $id);
        }

        $data['title'] = $data['user']['first_name'] . " " . $data['user']['last_name'];

        return view('users/admin/view-user', $data);
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

        return redirect('/', ['title' => 'Home']);
    }

    public function edit()
    {
        $model = new UsersModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($model->checkEmail($this->request->getPost('emailadd'))) {
            $response['message'] = "Email address already exists";
        } else {
            $model->update($this->request->getPost('id'), [
                'first_name' => $this->request->getPost('fname'),
                'last_name' => $this->request->getPost('lname'),
                'email' => $this->request->getPost('emailadd'),
            ]);
            session()->set(['uname' => $this->request->getPost('fname')]);
            $response['status'] = 1;
            $response['message'] = "Update successful";
        }
        echo json_encode($response);
    }

    public function editPass()
    {
        $model = new UsersModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        $user = $model->getUsers($this->request->getPost('id'));

        if (empty($user)) {
            $response['message'] = "Server error!";
        } else {
            if (sha1($this->request->getPost('oldPass')) === $user['password']) {
                if ($this->request->getPost('newPass') === $this->request->getPost('confNewPass')) {
                    $model->update($this->request->getPost('id'), [
                        'password' => sha1($this->request->getPost('newPass'))
                    ]);

                    $response['status'] = 1;
                    $response['message'] = "Password Successfully Changed";
                } else {
                    $response['status'] = 0;
                    $response['message'] = "Passwords must match";
                }
            } else {
                $response['message'] = "Incorrect Password Entered";
            }
        }
        echo json_encode($response);
    }

    public function forgetPassword()
    {
        $model = new UsersModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        $recovered = $model->checkEmail($_POST['recoveryEmail']);

        if ($recovered) {
            $newpass = md5(rand() * time());

            $model->update($recovered['user_id'], [
                'password' => sha1($newpass)
            ]);
            $to = $_POST['recoveryEmail'];
            $subject = "Password Reset";
            $content = wordwrap("Your new password is $newpass\n\nPlease reset it at the earliest convenience.");
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html/charset=UTF-8" . "\r\n";
            $headers .= "From: no.reply.vde123@gmail.com\r\nX-Mailer: PHP/" . phpversion();

            mail($to, $subject, $content, $headers);

            $response['status'] = 1;
            $response['message'] = "Please check your email address for the recovery password. Make sure to check your spam folder as well.";
        } else {
            $response['status'] = 0;
            $response['message'] = "Email address does not exist. Please register first";
        }
        echo json_encode($response);
    }
}
