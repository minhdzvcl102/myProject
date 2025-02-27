<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controller;
use Rakit\Validation\Validator;
use Throwable;

class AuthController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {
        return view('auth.form');
    }

    public function login()
    {
        try {
            $data = $_POST;
            // validate 
            $validator = new Validator;
            $errors = $this->validate(
                $validator,
                $data,
                [
                    'email' => 'required|email',
                    'password' => 'required|min:6'
                ]
            );
            $checkUser = $this->user->getUserByEmail($data['email']);
            // debug($checkUser);
            $checkPassword = password_verify($data['password'], $checkUser['password']);

            if (!empty($errors) || !$checkPassword || empty($checkUser)) {
                $_SESSION['data'] = $_POST;
                $_SESSION['status'] = false;
                $_SESSION['msg'] = 'Email hoặc mật khẩu không chính xác';
                $_SESSION['errors'] = $errors;

                if (empty($checkUser) && !isset($errors['email'])) {
                    $_SESSION['errors']['email'] = 'Email không tồn tại';
                }
                if (!$checkPassword && !isset($errors['password'])) {
                    $_SESSION['errors']['password'] = 'password không Đúngg ';
                }
                return redirect('/auth/showForm');
            } else {
                $data = null;
            }
            $_SESSION['user'] = $checkUser; // Lưu thông tin user vào session
            $redirectTo = ($_SESSION['user']['type'] == 'admin') ? '/admin' : '/';
            // debug($_SESSION['user']);
            redirect($redirectTo);
        } catch (Throwable $th) {
            $this->logError($th->__toString());
            $_SESSION['data'] = $_POST;
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác không thành công';
            return redirect('/auth/showForm');
        }
    }

    public function register()
    {
        try {
            $data = $_POST;
            // validate 
            $validator = new Validator;
            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                    'confirm_password' => 'required|same:password'
                ]
            );
            $checkEmail = $this->user->checkExistsEmailForCreate($data['email']);
            if ($checkEmail) {
                $errors['email'] = 'Email đã tồn tại';
            }
            if (!empty($errors)) {
                $_SESSION['data'] = $_POST;
                $_SESSION['status'] = false;
                $_SESSION['msg'] = 'Dữ liệu không hợp lệ';
                $_SESSION['errors'] = $errors;
                return redirect('/auth/showForm');
            }
            unset($data['confirm_password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['type'] = 'client';
            // debug($data);

            $this->user->insert($data);
            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Đăng ký thành công';
            $data = null;
            return redirect('/auth/showForm');
        } catch (Throwable $th) {
            $this->logError($th->__toString());
            $_SESSION['data'] = $_POST;
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác không thành công';
            return redirect('/auth/showForm');
        }
    }
    public function logout()
    {
        unset($_SESSION['user']);
        redirect('/');
    }
}
