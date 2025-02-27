<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Product;
use Rakit\Validation\Validator;
use Throwable;

class ProductController extends Controller
{
    protected Product $product;
    protected Comment $listComment;
    protected Categories $categories;

    public function __construct()
    {
        $this->product = new Product();
        $this->categories = new Categories();
        $this->listComment = new Comment();
    }

    public function index()
    {
        $title = 'Sản Phẩm ';
        $data = $this->product->findAll();
        $categories = $this->categories->findAll();
        // debug($listComment);
        return view('admin.product.index', compact('title', 'categories', 'data'));
    }
    public function create()
    {
        $title = 'Create Product';
        $categories = $this->categories->findAll();

        return view('admin.product.create', compact('title', 'categories'));
    }
    public function store()
    {
        try {
            $data = $_POST + $_FILES;
            // debug($data);
            $validator = new Validator;
            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name'                  => 'required',
                    'price'                  => 'required',
                    'overview'                 => 'required',
                    'category_id'                 => 'required',
                    'content'              => 'required|min:6',
                    'img_thumbnail'                => 'uploaded_file:0,500K,png,jpeg',
                ]
            );
            if (!empty($errors)) {
                $_SERVER['data'] = $data;
                $_SESSION['errors'] = $errors;
                $_SESSION['status'] = false;
                redirect('create');
            }

            if (is_upload('img_thumbnail')) {
                $data['img_thumbnail'] = $this->uploadFile($data['img_thumbnail'], 'product');
            } else {
                $data['img_thumbnail'] = null;
            }
            $data['slug'] = $data['name'];
            // debug($data);

            $this->product->insert($data);
            $_SESSION['msg'] = 'Thành công ';
            $_SESSION['status'] = true;
            redirect('/admin/product/create');
        } catch (Throwable $th) {
            echo '<pre>';
            echo 'Lỗi: ' . $th->getMessage() . "\n";
            echo 'File: ' . $th->getFile() . "\n";
            echo 'Line: ' . $th->getLine() . "\n";
            echo 'Trace: ' . $th->getTraceAsString() . "\n";
            echo '</pre>';
            die();
        }
    }
    public function edit($id)
    {
        $data = $this->product->findId($id);
        $categories = $this->categories->findAll();
        $title = 'Edit Product';
        return view('admin.product.edit', compact('data', 'title', 'categories'));
    }
    public function update($id)
    {
        try {
            $product = $this->product->findId($id);
            if (!empty($product)) {
                $data = $_POST + $_FILES;
                // debug($data);
                // validate 
                $validator = new Validator;
                $errors = $this->validate(
                    $validator,
                    $data,
                    [
                        'name'                  => 'required',
                        'price'                  => 'required',
                        'overview'                 => 'required',
                        'category_id'                 => 'required',
                        'content'              => 'required|min:6',
                        'img_thumbnail'                => 'uploaded_file:0,2000K,png,jpeg',
                    ]
                );
                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['status'] = false;
                    $_SESSION['msg'] = 'Thao tác không thành công ';
                    redirect('/admin/product/edit/' . $id);
                }
                if (is_upload('img_thumbnail')) {
                    $data['img_thumbnail'] = $this->uploadFile($data['img_thumbnail'], 'product');
                } else {
                    $data['img_thumbnail'] = $product['img_thumbnail'];
                }
                $data['slug'] = $data['name'];
                $this->product->update($id, $data);

                if (
                    is_upload($data['img_thumbnail'])
                    && $data['img_thumbnail'] != $product['img_thumbnail']
                    && file_exists($product['img_thumbnail'])
                ) {
                    unlink($product['img_thumbnail']);
                }
                $_SESSION['msg'] = 'Sửa thành công ';
                $_SESSION['status'] = true;
                redirect('/admin/product');
            }
        } catch (Throwable $th) {
            echo '<pre>';
            echo 'Lỗi: ' . $th->getMessage() . "\n";
            echo 'File: ' . $th->getFile() . "\n";
            echo 'Line: ' . $th->getLine() . "\n";
            echo 'Trace: ' . $th->getTraceAsString() . "\n";
            echo '</pre>';
            die();
        }
    }
    public function delete($id)
    {
        try {
            $product = $this->product->findId($id);
            if (!empty($product)) {
                $this->product->delete($id);
                if (file_exists($product['img_thumbnail'])) {
                    unlink($product['img_thumbnail']);
                }
                $_SESSION['msg'] = 'Xoa thanh cong';
                $_SESSION['status'] = true;
                redirect('/admin/product/');
            } else {
                $_SESSION['msg'] = 'Xoa that bai';
                $_SESSION['status'] = false;
                redirect('/admin/product/');
            }
        } catch (Throwable $th) {
            echo '<pre>';
            echo 'Lỗi: ' . $th->getMessage() . "\n";
            echo 'File: ' . $th->getFile() . "\n";
            echo 'Line: ' . $th->getLine() . "\n";
            echo 'Trace: ' . $th->getTraceAsString() . "\n";
            echo '</pre>';
            die();
        }
    }
    public function show($id)
    {
        $title = 'Detail Sản Phẩm ';
        $data = $this->product->findId($id);
        $categories = $this->categories->findId($data['category_id']);
        $listComment = $this->listComment->findIdCmt($id);
        // debug($listComment);
        return view('admin.product.show', compact('title', 'data', 'categories','listComment'));
    }
}
