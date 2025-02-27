<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Comment;
use Throwable;

class CommentController extends Controller
{
    protected $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }

    public function edit($id, $idProduct)
    {
        try {
            $cmt = $this->comment->findId($id);
            if (!empty($cmt) && $cmt['is_show'] == 1) {
                $cmt['is_show'] = 0;
                $this->comment->update($id, $cmt);
                redirect('/admin/product/show/' . $idProduct);
            } else if (!empty($cmt) && $cmt['is_show'] == 0) {
                $cmt['is_show'] = 1;
                $this->comment->update($id, $cmt);
                redirect('/admin/product/show/' . $idProduct);
            }
        } catch (Throwable $th) {
            debug($th);
        }
    }
}
