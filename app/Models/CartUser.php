<?php

namespace App\Models;

use App\Model;

class CartUser extends Model
{
    protected $tableName = 'cart_user';
    public function findAllCartUser($idUser)
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('cart_user.*', 'p.name', 'p.price', 'p.is_sale', 'p.price_sale', 'p.img_thumbnail')
            ->from('cart_user')
            ->join('cart_user', 'products', 'p', 'p.id = cart_user.product_id') // Sử dụng alias cho bảng
            ->where('cart_user.user_id = :idUser') // Sử dụng đúng cú pháp placeholder
            ->setParameter('idUser', $idUser); // Đặt giá trị cho placeholder

        return $queryBuilder->executeQuery()->fetchAllAssociative();
    }

    public function checkProduct($product_id, $user_id)
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('*')
            ->from('cart_user') // Thêm bảng 'cart_user' vào truy vấn
            ->where('cart_user.product_id = :id')
            ->andWhere('cart_user.user_id = :user_id')
            ->setParameter('id', $product_id) // Đúng thứ tự: (tên placeholder, giá trị)
            ->setParameter('user_id', $user_id);

        return $queryBuilder->executeQuery()->fetchAssociative();
    }
    public function deleteCheckOut($id)
    {
        return $this->connection->delete($this->tableName, ['user_id' => $id]);
    }
}
