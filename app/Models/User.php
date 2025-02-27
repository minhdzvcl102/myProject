<?php
namespace App\Models;

use App\Model;

class User extends Model {
    protected $tableName = 'users';

    public function checkExistsEmailForCreate($email)
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('COUNT(*)')
        ->from($this->tableName)
        ->where('email = :email')
        ->setParameter('email', $email);

        $result = $queryBuilder->fetchOne();
        // Kiểm tra xem email đã tồn tại chưa (nếu > 0 => đã tồn tại    )
        return $result > 0;
    }

    public function checkExistsEmailForUpdate($email,$id){
        $queryBuilder = $this->connection->createQueryBuilder();
        // Tạo câu lệnh kiểm tra sự tồn tại của email 
        $queryBuilder->select('COUNT(*)')
        ->from($this->tableName)
        ->where('email = :email')
        ->andWhere('id != :id') // Điều kiện so sánh với các emaill của các id khác 
        ->setParameter('email', $email)
        ->setParameter('id', $id);

        // Thực thi câu lệnh và trả về kết quả
        $result = $queryBuilder->fetchOne();
        // Kiểm tra xem email đã tồn tại chưa (nếu > 0 => đã tồn tại    )
        return $result > 0;
    }
    public function getUserByEmail($email)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
        ->from($this->tableName)
        ->where('email = :email')
        ->setParameter('email', $email);

        return $queryBuilder->fetchAssociative();
    }
}