<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\User;
use Rakit\Validation\Validator;
use Throwable;

class UserController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $title  = 'Danh sách người dùng ';
        $data = $this->user->findAll();
        // debug($data);
        return view(
            'admin.users.index',
            compact('data', 'title')
        );
    }
    public function create()
    {
        $title = 'Thêm người dùng';
        return view('admin.users.create', compact('title'));
    }
    public function store()
    {
        try {
            $data = $_POST + $_FILES;

            // Validate
            $validator = new Validator;

            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name'                  => 'required|max:50',
                    'email'                 => [
                        'required',
                        'email',
                        function ($value) {
                            $flag = (new User)->checkExistsEmailForCreate($value);
                            if ($flag) {
                                return ":attribute has existed";
                            }
                        }
                    ],
                    'password'              => 'required|min:6|max:30',
                    'confirm_password'      => 'required|same:password',
                    'avatar'                => 'nullable|uploaded_file:0,2048K,png,jpeg,jpg',
                    'type'                  => [$validator('in', ['admin', 'client'])]
                ]
            );
            // Thêm thông báo gỡ lỗi

            if (!empty($errors)) {

                $_SESSION['msg'] = 'Thao tác Không thành công ';
                $_SESSION['status'] = false;
                $_SESSION['data'] = $_POST;
                $_SESSION['errors'] = $errors;
                redirect('/admin/users/create');
            } else {
                $_SESSION['data'] = null;
            }
            // debug($data['avatar']);
            // Upload file
            if (is_upload('avatar')) {
                $data['avatar'] = $this->uploadFile($data['avatar'], 'users');
            } else {
                $data['avatar'] = null;
            }
            // debug($data['avatar']);

            // Điều chỉnh dữ liệu 
            unset($data['confirm_password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            // Thêm vào database
            $this->user->insert($data);

            $_SESSION['msg'] = 'Thêm người dùng thành công';
            $_SESSION['status'] = false;
            $_SESSION['data'] = $_POST;

            redirect('/admin/users');
        } catch (Throwable $th) {
            // echo '<pre>';
            // echo 'Lỗi: ' . $th->getMessage() . "\n";
            // echo 'File: ' . $th->getFile() . "\n";
            // echo 'Line: ' . $th->getLine() . "\n";
            // echo 'Trace: ' . $th->getTraceAsString() . "\n";
            // echo '</pre>';
            // die();

            $this->logError($th->__tostring());

            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
            $_SESSION['data'] = $_POST;

            redirect('/admin/users/create');
        }
    }
    public function edit($id)
    {
        $title = 'Chỉnh sửa người dùng';
        $data = $this->user->findId($id);
        // debug($data);
        if (empty($data)) {
            redirect404();
        }
        return view('admin.users.edit', compact('data', 'title'));
    }
    public function update($id)
    {
        $user = $this->user->findId($id);

        if (empty($user)) {
            redirect404();
        }

        try {
            $data = $_POST + $_FILES;
            // debug($data);
            // Vaidate
            $validator = new Validator;
            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name'                  => 'required|max:50',
                    'email'                 => [
                        'required',
                        'email',
                        function ($value) use ($id) {
                            $flag = (new User)->checkExistsEmailForUpdate($value, $id);

                            if ($flag) {
                                return ":Trùng Emai";
                            }
                        }
                    ],
                    'type'                  => [$validator('in', ['admin', 'client'])]
                ]
            );
            // debug($errors);

            if (!empty($errors)) {
                $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
                $_SESSION['status'] = false;
                $_SESSION['errors'] = $errors;
                redirect('/admin//users/edit/' . $id);
            }
            // Upload file
            if (is_upload('avatar')) {
                $data['avatar'] = $this->uploadFile($data['avatar'], 'users');
            } else {
                $data['avatar'] =  $user['avatar'];
            }

            // Điểu chỉnh dữ liệu 
            $data['updated_at'] = date('Y-m-d H:i:s');
            // debug($data);
            // Update vào database
            $this->user->update($id, $data);

            if (
                $data['avatar'] != $user['avatar']
                && file_exists($user['avatar'])
                && $user['avatar']
            ) {
                unlink($user['avatar']);
            }
            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            if ($_SESSION['user']['type'] == 'admin') {
                redirect('/admin/users/edit/' . $id);
            } else {
                redirect('/showInfor/' . $id);
            }
        } catch (Throwable $th) {
            // echo '<pre>';
            // echo 'Lỗi: ' . $th->getMessage() . "\n";
            // echo 'File: ' . $th->getFile() . "\n";
            // echo 'Line: ' . $th->getLine() . "\n";
            // echo 'Trace: ' . $th->getTraceAsString() . "\n";
            // echo '</pre>';
            // die();
            $this->logError($th->__tostring());

            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';

            redirect('/admin//users/edit/' . $id);
        }
    }
    public function show($id)
    {
        $title = 'Chi tiết người dùng';
        $data = $this->user->findId($id);
        if (empty($data)) {
            redirect404();
        }
        // var_dump($data);die;
        return view('admin.users.show', compact('data', 'title'));
    }
    public function delete($id)
    {

        $user = $this->user->findId($id);
        if (empty($user)) {
            redirect404();
        }

        $this->user->delete($id);
        if ($user['avatar'] && file_exists($user['avatar'])) {
            unlink($user['avatar']);
        }
        $_SESSION['msg'] = 'Xóa người dùng thành công';
        $_SESSION['status'] = true;
        redirect('/admin/users');
    }
}
