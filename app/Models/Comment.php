<?php

namespace App\Models;

use App\Model;

class Comment extends Model
{
    protected $tableName = 'comment';

    public function findIdCmt($id)
    {
        $queryBuilder  = $this->connection->createQueryBuilder();
        $queryBuilder->select('cmt.*', 'users.name','product.name as nameProduct','product.id as idProduct','users.avatar')
            ->from($this->tableName, 'cmt')
            ->join('cmt', 'users', 'users', 'cmt.user_id = users.id')
            ->join('cmt', 'products', 'product', 'cmt.product_id = product.id')
            ->where('product.id = :id')
            ->setParameter('id',$id);
        return $queryBuilder->fetchAllAssociative();
    }
}
