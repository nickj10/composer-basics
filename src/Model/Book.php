<?php

declare(strict_types=1);

namespace SallePW\Model;

final class Book {
  public function __construct(
    private string $name, 
    private string $genre,
    private string $author,
    private int $year)
    {
    }

    public function getName() {
      return $this->name;
    }

    public function getGenre() {
      return $this->genre;
    }

    public function getAuthor() {
      return $this->author;
    }

    public function getYear() {
      return $this->year;
    }
}