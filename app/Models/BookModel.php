<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'book_id';
    protected $allowedFields = [
        'title',
        'author',
        'publisher',
        'year_published',
        'stock',
        'category_id'
    ];

    protected $useTimestamps = false;

    // Get all books with their category names
    public function getBooksWithCategory()
    {
        return $this->select('books.*, categories.category_name')
            ->join('categories', 'categories.category_id = books.category_id')
            ->findAll();
    }

    // Get a single book by ID
    public function getBookById($id)
    {
        return $this->find($id);
    }

    // Get all books by category ID
    public function getBooksByCategoryId($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }
}
