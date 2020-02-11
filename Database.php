<?php

class Database
{
   const HOST = 'localhost';
   const DBNAME = 'billet_alaska';
   const USER = 'algor';
   const PASSWD = '4160';

   private $connection;

   public function getConnection()
   {
      try {
         $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME . ';charset=utf8', self::USER, self::PASSWD);
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
      $result->setFetchMode(PDO::FETCH_CLASS, static::class);
      return $result;
   }
}
























