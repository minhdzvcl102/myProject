<?php

namespace App\Controllers\Client;

use App\Controller;
use App\Models\Cart;
use App\Models\CartUser;
use App\Models\Oder;
use App\Models\OderDetail;
use App\Models\Status;
use App\Models\User;
use Rakit\Validation\Validator;
use Throwable;

class UserController extends Controller
{
    protected $cart;
    protected $status;
    protected $oder;
    protected $cartUser;
    protected $user;
    protected $oderDetail;
    public function __construct()
    {
        $this->cart = new Cart();
        $this->cartUser = new CartUser();
        $this->user = new User();
        $this->oder = new Oder();
        $this->oderDetail = new OderDetail();
        $this->status = new Status();
    }
    public function showInforUser()
    {
        $idUser = $_SESSION['user']['id'];
        $userDetail = $this->user->findId($idUser);
        $listOders = $this->oder->findOderID($idUser);
        // debug($listOders);
        // debug($idUser);
        return view('client.infor', compact('userDetail', 'listOders'));
    }
    public function orderDetail($oderDetail)
    {
        $listOders = $this->oder->findOrderDetail($oderDetail);
        $subTotal = 0;
        foreach ($listOders as $item) {
            $subTotal += $item['total_amount'];
        }
        // debug($subTotal);
        return view('client.oderDetail', compact('listOders', 'subTotal'));
    }

    public function addProductCard($product_id)
    {
        try {
            if (!empty($_SESSION['user'])) {
                $cartId = $this->cart->findUserId($_SESSION['user']['id']);
                if (empty($cartId)) {
                    $data = ['user_id' => $_SESSION['user']['id']];
                    $idCart = $this->cart->insert($data);
                }
                $data = [
                    'user_id' => $_SESSION['user']['id'],
                    'product_id' => $product_id,
                    'quantity'   => 1,
                    'cart_id' => $cartId['id'] ?? $idCart
                ];
                $check = $this->cartUser->checkProduct($product_id, $_SESSION['user']['id']);
                // debug($check);
                if (empty($check)) {
                    $this->cartUser->insert($data);
                    $_SESSION['msg'] = 'Thao Tác thành công ';
                    $_SESSION['status'] = true;
                    redirect('/listProduct');
                } else {
                    $data['quantity'] += 1;
                    $this->cartUser->update($check['id'], $data);
                    $_SESSION['msg'] = 'Thao Tác thành công ';
                    $_SESSION['status'] = true;
                    redirect('/listProduct');
                }
            } else {
                redirect('/auth/showForm');
            }
        } catch (Throwable $th) {
            debug($th);
        }
    }
    public function deleteItemCart($id)
    {
        $this->cartUser->delete($id);
        redirect('/');
    }
    public function updatePass($id)
    {
        try {
            $userUpdate = $this->user->findId($id);
            if (!empty($userUpdate)) {
                $data = $userUpdate + $_POST;
                // debug($data);

                $validator = new Validator;
                $errors = $this->validate(
                    $validator,
                    $data,
                    [
                        'oldPassword'      => 'required',
                        'newPassword'         => 'required',
                        'confirmPassword' => 'required|same:newPassword',

                    ]
                );
                $checkPass = password_verify($data['oldPassword'], $data['password']);
                // debug($checkPass);
                $data['password'] = password_hash($data['newPassword'], PASSWORD_BCRYPT);
                unset($data['oldPassword'], $data['confirmPassword'], $data['newPassword']);
                if ($checkPass && empty($errors)) {
                    $this->user->update($id, $data);
                    $_SESSION['status'] = true;
                    $_SESSION['msg'] = 'Thao tác thành công!';
                    redirect('/showInfor/' . $id);
                } else {
                    $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
                    $_SESSION['status'] = false;
                    $_SESSION['errors'] = $errors;
                    redirect('/showInfor/' . $id);
                }
            }
        } catch (Throwable $th) {
            debug($th);
        }
    }

    public function formCheckOut()
    {
        return view('client.checkout');
    }
    public function checkout()
    {
        try {
            $data = $_POST;
            // Validate
            $validator = new Validator;

            $errors = $this->validate(
                $validator,
                $data,
                [
                    'customers'                  => 'required',
                    'address'                  => 'required',
                    'phone'                  => 'required',
                    'method_pay'              => 'required',
                ]
            );
            // Thêm thông báo gỡ lỗi

            if (!empty($errors)) {

                $_SESSION['msg'] = 'Thao tác Không thành công ';
                $_SESSION['status'] = false;
                $_SESSION['data'] = $_POST;
                $_SESSION['errors'] = $errors;
                redirect('/formCheckOut');
            } else {
                $_SESSION['data'] = null;
            }

            // Điều chỉnh dữ liệu 
            $data['user_id'] = $_SESSION['user']['id'];
            $data['total_amount'] =  $_SESSION['total'] + $_SESSION['vat'];
            // Thêm vào database

            $type_status = 1;
            $idOder = $this->oder->insert($data);
            $this->status->insert(['oder_id' => $idOder, 'type_status' => $type_status]);
            $dataProduct = $_SESSION['listCart'];

            // debug($_SESSION['listCart']);
            foreach ($dataProduct as $item) {
                unset($item['id'], $item['user_id'], $item['cart_id'], $item['name'], $item['img_thumbnail']);
                $item['oder_id'] = $idOder;
                if ($item['is_sale'] == 1) {
                    $item['total_amount	'] = $item['price_sale'] * $item['quantity'];
                    unset($item['price_sale'], $item['is_sale']);
                } else {
                    $item['total_amount	'] = $item['price'] * $item['quantity'];
                    unset($item['price_sale'], $item['is_sale']);
                }
                $this->oderDetail->insert($item);
            }

            $this->cartUser->deleteCheckOut($_SESSION['user']['id']);
            // debug($_SESSION['user']['id']);
            $_SESSION['msg'] = 'Thao Tác Thành công ';
            $_SESSION['status'] = true;

            redirect('/');
        } catch (Throwable $th) {
            echo '<pre>';
            echo 'Lỗi: ' . $th->getMessage() . "\n";
            echo 'File: ' . $th->getFile() . "\n";
            echo 'Line: ' . $th->getLine() . "\n";
            echo 'Trace: ' . $th->getTraceAsString() . "\n";
            echo '</pre>';
            die();

            // $this->logError($th->__tostring());

            // $_SESSION['status'] = false;
            // $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
            // $_SESSION['data'] = $_POST;

            // redirect('/formCheckOut');
        }
    }
}
