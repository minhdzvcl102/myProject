<?php

namespace App\Models;

use App\Model;

class Oder extends Model
{
    protected $tableName  = 'oder';
    public function findOderID($idUser)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('oder.*', 'sd.name_status as status_name')
            ->from($this->tableName, 'oder') // Đặt alias cho bảng chính là "oder"
            ->join('oder', 'status', 's', 's.oder_id = oder.id') // JOIN bảng status vào oder
            ->join('s', 'status_detail', 'sd', 'sd.id = s.type_status') // JOIN bảng status_detail vào status
            ->where('oder.user_id = :user_id')
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
