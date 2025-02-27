<?php

namespace App\Controllers\Client;

use App\Controller;
use App\Models\Comment;
use Rakit\Validation\Validator;
use Throwable;

class DetailController extends Controller
{
    protected $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }

    public function store($id)
    {

        try {

            // debug($id );
            if (!empty($_SESSION['user'])) {
                $validator = new Validator;
                $errors = $this->validate(
                    $validator,
                    $_POST,
                    ['content' => 'required']
                );
                if (!empty($errors)) {
                    $_SESSION['errors'] = 'Phải nhập dữ liệu';
                    $_SESSION['status'] = false;

                    redirect('/detailProduct/' . $id . '/' . $_POST['categories_id']);
                }
                $data = $_POST;
                $categories_id = $_POST['categories_id'];
                $data['product_id'] = $id;
                $data['user_id'] = $_SESSION['user']['id'];
                unset($data['categories_id']);
                // debug($data);
                $this->comment->insert($data);
                $_SESSION['msg'] = 'Ok';
                $_SESSION['status'] = true;
                redirect('/detailProduct/' . $id . '/' . $categories_id);
            } else {
                // debug($_SESSION);
                $_SESSION['errors']['Login'] = 'Phải nhập Login de CMT';
                $_SESSION['status'] = false;
                redirect('/auth/showForm');
            }
        } catch (Throwable $th) {
            echo '<pre>';
            print_r($th);
            echo '</pre>';

            // Hoặc sử dụng var_dump() để hiển thị chi tiết hơn
            var_dump($th);

            // Hoặc hiển thị thông báo lỗi chi tiết
            echo 'Lỗi: ' . $th->getMessage() . '<br>';
            echo 'File: ' . $th->getFile() . '<br>';
            echo 'Dòng: ' . $th->getLine() . '<br>';
            echo '<pre>Trace: ' . $th->getTraceAsString() . '</pre>';

            // Dừng thực thi nếu cần
            exit;
        }
    }
}
