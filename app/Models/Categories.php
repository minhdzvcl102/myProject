<?php

namespace App\Models;

use App\Model;

class Categories extends Model {
    protected $tableName = 'categories';

    public function checkNameCategories ($name){
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('COUNT(*)')
        ->from($this->tableName)
        ->where('name = :name')
        ->setParameter('name', $name);

        $result = $queryBuilder->fetchOne();
        // Kiểm tra xem name đã tồn tại chưa (nếu > 0 => đã tồn tại    )
        return $result > 0;
    }
    public function checkNameCategoriesForUpdate ($id, $name){
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('COUNT(*)')
        ->from($this->tableName)
        ->where('id != :id')
        ->andWhere('name = :name')
        ->setParameter('id', $id)
        ->setParameter('name', $name);

        $result = $queryBuilder->fetchOne();
        // Kiểm tra xem name đã tồn tại chưa (nếu > 0 => đã tồn tại    )
        return $result > 0;
    }
}
   
