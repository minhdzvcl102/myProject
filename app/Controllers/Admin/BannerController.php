<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Banner;
use Rakit\Validation\Validator;
use Throwable;

class BannerController extends Controller
{
    protected $banner;
    public function __construct()
    {
        $this->banner = new Banner();
        // debug($this->banner);
    }
    public function index()
    {
        $data = $this->banner->findAll();
        $title = 'Banners';
        // debug($data);
        return view('admin.banners.index', compact('title', 'data'));
    }


    public function create()
    {

        $title = 'Create';
        // debug($data);
        return view('admin.banners.create', compact('title'));
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
                    'name' => 'required',
                    'image' => 'uploaded_file:0,500K,png,jpeg'
                ]
            );
            // debug($errors);
            if (!empty($errors)) {
                if (!empty($errors['img'])) {
                    $_SESSION['errors']['img'] = 'Anhr không hợp lệ';
                }
                if (!empty($errors['name'])) {
                    $_SESSION['errors']['name'] = 'Tên không hợp lệ';
                }
                $_SESSION['data'] = $data;
                $_SESSION['status'] = false;
                redirect('/admin/banners/create');
            }
            // upload file
            if (is_upload('img')) {
                $data['img'] = $this->uploadFile($data['img'], 'banners');
            } else {
                $data['img'] = '';
            }
           
            // debug($data);   
            $this->banner->insert($data);
            $_SESSION['msg'] = 'Thêm mới thành công';
            $_SESSION['status'] = true;
            redirect('/admin/banners');
        } catch (\Throwable $th) {
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

        $title = 'Edit';
        $data = $this->banner->findId($id);
        // debug($data);
        return view('admin.banners.edit', compact('title', 'data'));
    }
    public function update($id)
    {

        try {
            $banner  = $this->banner->findId($id);
            if(!empty($banner)){
                $data = $_POST + $_FILES;
                // debug($data);
                // validate
                $validator = new Validator;
                $errors = $this->validate(
                    $validator,
                    $data,
                    [
                        'name' => 'required',
                        'image' => 'uploaded_file:0,500K,png,jpeg'
                    ]
                );
                // debug($errors);
                if (!empty($errors)) {
                    if (!empty($errors['img'])) {
                        $_SESSION['errors']['img'] = 'Anhr không hợp lệ';
                    }
                    if (!empty($errors['name'])) {
                        $_SESSION['errors']['name'] = 'Tên không hợp lệ';
                    }
                    $_SESSION['data'] = $data;
                    $_SESSION['status'] = false;
                    redirect('/admin/banners/edit/' . $id);
                }
                // upload file
                if (is_upload('img')) {
                    $data['img'] = $this->uploadFile($data['img'], 'banners');
                    unlink($banner['img']);
                } else {
                    $data['img'] = $banner['img'];
                }
                // debug($data);   
                $this->banner->update($id, $data);
                if(is_upload('img'))
                $_SESSION['msg'] = 'Cập nhật thành công';
                $_SESSION['status'] = true;
                redirect('/admin/banners');
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
       $banner = $this->banner->findId($id);
       try{
        if  ($banner) {
            $this->banner->delete($id);
            $_SESSION['msg'] = 'Xóa thành công';
            $_SESSION['status'] = true;
            redirect('/admin/banners');
        } else {
            $_SESSION['msg'] = 'Xóa thất bại';
            $_SESSION['status'] = false;
            redirect('/admin/banners');
        }
       }catch(Throwable $th){
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
        $data = $this->banner->findId($id);
        $title = 'Banners';
        // debug($data);
        return view('admin.banners.detail', compact('title', 'data'));
    }
}
