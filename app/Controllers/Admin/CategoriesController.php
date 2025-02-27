<?php

namespace App\Controllers\Admin;

use App\Models\Categories;
use App\Controller;
use Rakit\Validation\Validator;

class CategoriesController extends Controller
{
    protected $categories;
    public function __construct()
    {
        $this->categories = new Categories();
    }
    public function index()
    {
        $title = 'Trang Danh Mục Sản Phẩm ';
        $data = $this->categories->findAll();
        // debug($data);
        return view('admin.categories.index', compact('title', 'data'));
    }
    public function create()
    {
        $title = 'Trang Thêm  Danh Mục Sản Phẩm ';

        return view('admin.categories.create', compact('title'));
    }

    public function store()
    {
        try {
            $data = $_POST + $_FILES;
            // debug($data);

            // validate 
            $validator = new Validator;
            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name' => 'required|min:3|max:255',
                ]
            );
            $checkName = $this->categories->checkNameCategories($data['name']);
            // debug($data);

            if (!empty($errors) ||  $checkName) {
                $_SESSION['errors'] = $errors;
                $_SESSION['data'] = $data;
                $_SESSION['errors']['name'] = 'Tên danh mục đã tồn tại';
                $_SESSION['status'] = false;
                redirect('/admin/categories/create');
            }

            // Xử lý upload file
            if (is_upload('img')) {
                $file = $_FILES['img'];
                $data['img'] = $this->uploadFile($file, 'categories');
            }

            $this->categories->insert($data);
            redirect('/admin/categories');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
    public function edit($id)
    {
        $title = 'Trang Sửa Danh Mục Sản Phẩm ';
        $data = $this->categories->findId($id);
        if (!empty($data)) {
            return view('admin.categories.edit', compact('data', 'title'));
        } else {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Không tìm thấy danh mục sản phẩm';
            redirect('/admin/categories');
        }
    }

    public function update($id)
    {
        try {
            $categories = $this->categories->findId($id);
            if (empty($categories)) {
                $_SESSION['status'] = false;
                $_SESSION['msg'] = 'Không tìm thấy danh mục sản phẩm';
                redirect('/admin/categories');
            }
            $data = $_POST + $_FILES;
            // validate
            $validator = new Validator;
            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name' => 'required|min:3|max:255',
                ]
            );
            $checkName = $this->categories->checkNameCategoriesForUpdate($id, $categories['name']);
            // debug($checkName);
            if (!empty($errors) ||  $checkName) {
                $_SESSION['errors'] = $errors;
                $_SESSION['data'] = $data;
                $_SESSION['errors']['name'] = 'Tên danh mục đã tồn tại';
                $_SESSION['status'] = false;
                redirect('/admin/categories/edit/' . $id);
            }
            // Xử lý upload file
            if (is_upload('img')) {
                $file = $_FILES['img'];
                $data['img'] = $this->uploadFile($file, 'categories');
                if (!empty($categories['img'] && file_exists($categories['img']))) {
                    unlink($categories['img']);
                }
            } else {
                $data['img'] = $categories['img'];
            }

            $this->categories->update($id, $data);
            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Cập nhật thành công';
            redirect('/admin/categories');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
    public function show($id)
    {
        $data = $this->categories->findId($id);
        if (!empty($data)) {
            $title = 'Chi tiết danh mục sản phẩm';
            return view('admin.categories.show', compact('data', 'title'));
        } else {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Không tìm thấy danh mục sản phẩm';
            redirect('/admin/categories');
        }
    }
    public function delete($id)
    {
        $categories = $this->categories->findId($id);
        if (!empty($categories)) {
            $this->categories->delete($id);
            if (!empty($categories['img'] && file_exists($categories['img']))) {
                unlink($categories['img']);
            }
            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Xóa thành công';
            redirect('/admin/categories');
        } else {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Xóa Khong  thành công';
            redirect('/admin/categories');
        }
    }
}
