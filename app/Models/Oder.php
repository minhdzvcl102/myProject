<?php

namespace App\Models;

use App\Model;

class Oder extends Model
{
    protected $tableName  = 'oder';
    public function findOderID($idUser)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->where('user_id = :user_id')
            ->setParameter('user_id', $idUser);
        return $queryBuilder->fetchAllAssociative();
    }
    public function findOrderDetail($oderId)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
    
        $queryBuilder
            ->select('od.*, pr.name as product_name, pr.price ,pr.img_thumbnail')
            ->from('oder_detail', 'od')
            ->innerJoin('od', 'products', 'pr', 'od.product_id = pr.id')
            ->where('od.oder_id = :oderId')
            ->setParameter('oderId', $oderId);
    
        return $queryBuilder->fetchAllAssociative();
    }
        }
