<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\APIusersModel;
use App\Models\CategoriesModel;
use App\Models\WalletModel;
use App\Models\PaymentTypesModel;
use App\Models\UserloginModel;

class UsersController extends BaseController
{

    public function index()
    {
        if (session()->get('utype') == 1) {
            $modelUsers = new UsersModel();
            $modelCat = new CategoriesModel();
            $modelPayment = new PaymentTypesModel();

            $data = [
                'categories' => $modelCat->getCategories(),
                'paymenttypes' => $modelPayment->getPaymentTypes(),
                'users' => $modelUsers->getUsers(),
                'title' => 'Users List'
            ];

            return view('users/admin/view-users', $data);
        } else {
            return view('errors/html/unauthorized');
        }
    }
    public function view($id = null)
    {
        if (session()->get('utype') == 1) {
            $modelUsers = new UsersModel();
            $modelCat = new CategoriesModel();
            $modelPayment = new PaymentTypesModel();

            $data = [
                'categories' => $modelCat->getCategories(),
                'paymenttypes' => $modelPayment->getPaymentTypes(),
                'user' => $modelUsers->getUsers($id)
            ];

            if (empty($data['user'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('User does not exist: ' . $id);
            }

            $data['title'] = $data['user']['first_name'] . " " . $data['user']['last_name'];

            return view('users/admin/view-user', $data);
        } else {
            return view('errors/html/unauthorized');
        }
    }

    public function register()
    {
        $modelUsers = new UsersModel();
        $modelWallet = new WalletModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($_POST['pass'] === $_POST['confpass']) {
            if ($modelUsers->checkEmail($_POST['emailadd'])) {
                $response['message'] = "Email address already exists";
            } else {
                $insertedUid = $modelUsers->insertUser([
                    'first_name' => $_POST['fname'],
                    'last_name' => $_POST['lname'],
                    'email' => $_POST['emailadd'],
                    'password' => sha1($_POST['pass']),
                    'gender' => $_POST['gender'],
                    'role' => $_POST['role']
                ]);

                $modelWallet->save([
                    'customer_id' => $insertedUid
                ]);

                $response['status'] = 1;
                $response['message'] = "Registration successful";
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "Passwords must match!";
        }
        echo json_encode($response);
    }

    public function registerAPIuser()
    {
        $modelAPIusers = new APIusersModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($modelAPIusers->getApiUsers($_POST['uname'])) {
            $response['status'] = 0;
            $response['message'] = "Username already exists";
        } else {
            $modelAPIusers->save([
                'username' => $_POST['uname'],
                'key' => sha1(md5(time() * time() * 24)),
                'added_by' => $_POST['admin_id']
            ]);
            $response['status'] = 1;
            $response['message'] = "Registration successful";
        }
        echo json_encode($response);
    }

    public function login()
    {
        $modelUsers = new UsersModel();
        $modelWallet = new WalletModel();
        $modelUserLogin = new UserloginModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        $users = $modelUsers->getUsers();

        if (empty($users)) {
            $response['message'] = "Server error!";
        } else {
            $validated = FALSE;

            foreach ($users as $user) {
                if ($this->request->getPost('emailadd') === $user['email'] && sha1($this->request->getPost('pass')) === $user['password']) {
                    $validated = TRUE;

                    if (session()->get('isLogged')) {
                        $response['status'] = 0;
                        $response['message'] = "User is already logged in";
                    } else {
                        session()->set(['uname' => $user['first_name']]);
                        session()->set(['id' => $user['user_id']]);
                        session()->set(['utype' => $user['role']]);
                        session()->set(['walletBal' => $modelWallet->getWalletAtUser($user['user_id'])['amount_available']]);
                        session()->set(['isLogged' => TRUE]);


                        $sessionID = $modelUserLogin->insertUserLogin([
                            'user_id' => $user['user_id'],
                            'user_ip' => $_SERVER['REMOTE_ADDR']
                        ]);
                        session()->set(['session_id' => $sessionID]);

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
        $modelUserLogin = new UserloginModel();

        $modelUserLogin->update(session()->get('session_id'), ['is_deleted' => 1]);

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
