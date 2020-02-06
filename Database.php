<?php

class Database
{
   const HOST = 'localhost';
   const DBNAME = 'alaska';
   const USER = 'algor';
   const PASSWD = '4160';
   public function getConnection()
   {
      try {
         $connection = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME.';charset=utf8', self::USER, self::PASSWD);
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         return $connection;
      } catch (Exception $e) {
         die('Erreur de connection :' . $e->getMessage());
      }
   }
}
