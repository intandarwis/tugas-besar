<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['category_name'];

    protected $useTimestamps = false;

    // Fungsi untuk mendapatkan semua kategori
    public function getAllCategories()
    {
        return $this->findAll();
    }

    // Fungsi untuk mendapatkan kategori berdasarkan ID
    public function getCategoryById($id)
    {
        return $this->find($id);
    }
}
