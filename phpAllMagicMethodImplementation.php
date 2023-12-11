<?php
class Book {
    private $title;
    private $author;
    private $pages;

    public function __construct($title, $author, $pages) {
        $this->title = $title;
        $this->author = $author;
        $this->pages = $pages;
    }

    public function __get($property) {
        return $this->$property ?? null;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function __isset($property) {
        return isset($this->$property);
    }

    public function __unset($property) {
        unset($this->$property);
    }

    public function __call($name, $arguments) {
        if ($name === 'describe') {
            if (count($arguments) === 0) {
                return "This book is '{$this->title}' by '{$this->author}'.";
            } elseif (count($arguments) === 1 && $arguments[0] === 'short') {
                return "Short description: '{$this->title}' by '{$this->author}'";
            }
        }
        return "Method '$name' does not exist or is inaccessible.";
    }

    public static function __callStatic($name, $arguments) {
        return "Static method '$name' does not exist or is inaccessible.";
    }

    public function __toString() {
        return "Title: '{$this->title}', Author: '{$this->author}', Pages: '{$this->pages}'";
    }

    public function __invoke() {
        return "This book is callable.";
    }

    public static function __set_state($an_array) {
        return new self($an_array['title'], $an_array['author'], $an_array['pages']);
    }

    public function __clone() {
        echo "Cloning book: '{$this->title}' by '{$this->author}'";
    }

    public function __debugInfo() {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'pages' => $this->pages
        ];
    }

    public function __serialize() {
        return serialize([
            'title' => $this->title,
            'author' => $this->author,
            'pages' => $this->pages
        ]);
    }

    public function __unserialize($data) {
        $data = unserialize($data);
        $this->title = $data['title'];
        $this->author = $data['author'];
        $this->pages = $data['pages'];
    }
}

// Create a Book object
$book = new Book("The Lord of the Rings", "J.R.R. Tolkien", 1178);

// Access properties using magic __get
echo $book->title . "<br>";
echo $book->author . "<br>";

// Set properties using magic __set
$book->pages = 1200;

// Check property existence using __isset
echo isset($book->pages) . "<br>";

// Unset a property using __unset
unset($book->pages);

// Using __call to describe the book
echo $book->describe() . "<br>";
echo $book->describe('short') . "<br>";

// Convert object to string using __toString
echo $book . "<br>";

// Invoke object as callable using __invoke
echo $book() . "<br>";

// Using __set_state to create an object from exported state
$exportedBook = var_export($book, true);
$newBook = eval("return $exportedBook;");

// Clone an object using __clone
$clonedBook = clone $book;
