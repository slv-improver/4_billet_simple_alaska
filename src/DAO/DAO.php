<?php

namespace App\src\DAO;

use PDO;
use Exception;

class DAO
{

   private $connection;

   public function getConnection()
   {
      try {
         $this->connection = new PDO(DB_HOST , DB_USER, DB_PASSWD);
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         return $this->connection;
      } catch (Exception $e) {
         die('Erreur de connection :' . $e->getMessage());
      }
   }

   private function checkConnection()
   {
      if ($this->connection === null) {
         return $this->getConnection();
      }
      return $this->connection;
   }

   protected function createQuery($sql, $parameters = null)
   {
      if ($parameters) {
         $result =  $this->checkConnection()->prepare($sql);
         $result->setFetchMode(PDO::FETCH_CLASS, static::class);
         $result->execute($parameters);
         return $result;
      }
      $result =  $this->checkConnection()->query($sql);
      return $result;
   }
}
