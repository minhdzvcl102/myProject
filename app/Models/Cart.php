<?php

namespace App\Models;

use App\Model;

class Cart extends Model
{
    protected $tableName = 'cart';
    public function findUserID($userID)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->where('user_id=:id')
            ->setParameter('id', $userID);

        return $queryBuilder->fetchAssociative();
    }
   
}
