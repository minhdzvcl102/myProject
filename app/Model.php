<?php

namespace App;

use Doctrine\DBAL\DriverManager;

class Model
{

    protected $connection;
    protected $tableName;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER'],
        ];
        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public function findAll()
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')->from($this->tableName);
        return $queryBuilder->fetchAllAssociative();
    }

    //Phân trang dữ liệu
    
    public function paginate($page = 1 , $limit = 10){

        $offset = ($page - 1) * $limit;

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
        ->from($this->tableName)
        ->setFirstResult($offset)
        ->setMaxResults($limit);

        $data = $queryBuilder->fetchAllAssociative();
        $totalPage = ceil($this->count()/ $limit);  // Làm tròn lên 

        return [
            'data' => $data,
            'page' => $page,
            'limit' => $limit,
            'totalPage' => $totalPage,
        ];
    }
    
    //Đếm số lượng bản ghi 

    public function count(){
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('COUNT(*) as total')
        ->from($this->tableName);

        return $queryBuilder->fetchOne();
    }


    // Phương thức tìm theo ID 

    public function     findId ($id){
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
        ->from($this->tableName)
        ->where('id=:id')
        ->setParameter('id',$id);

        return $queryBuilder->fetchAssociative();
    }


    // Insert 

    public function insert(array $data){
        $this->connection->insert($this->tableName, $data);
        return $this->connection->lastInsertId();
    }

    // Update 
    public function update($id, array $data)
    {
        return $this->connection->update($this->tableName, $data, ['id' => $id]);
    }

    // DELETE 
    public function delete($id)
    {
        return $this->connection->delete($this->tableName,  ['id' => $id]);
    }

    public function beginTransaction() {
        $this->connection->beginTransaction();
    }

    public function commit() {
        $this->connection->commit();
    }
    public function rollBack() {
        $this->connection->rollBack();
    }
}
