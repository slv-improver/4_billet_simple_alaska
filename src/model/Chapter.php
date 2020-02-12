<?php

namespace App\src\model;

class Chapter
{
   private $id;
   private $title;
   private $content;
   private $author;
   private $date;
   private $dateModif;

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getTitle()
   {
      return $this->title;
   }

   public function setTitle($title)
   {
      $this->title = $title;
   }

   public function getContent()
   {
      return $this->content;
   }

   public function setContent($content)
   {
      $this->content = $content;
   }

   public function getAuthor()
   {
      return $this->author;
   }

   public function setAuthor($author)
   {
      $this->author = $author;
   }

   public function getDate()
   {
      return $this->date;
   }

   public function setDate($date)
   {
      $this->date = $date;
   }

   public function getDateModif()
   {
      return $this->dateModif;
   }

   public function setDateModif($dateModif)
   {
      $this->dateModif = $dateModif;
   }
}
