<?php

namespace App\Models;

use CodeIgniter\Model;

class StockHistoryModel extends Model
{
    protected $table = 'stock_history';
    protected $primaryKey = 'history_id';
    protected $allowedFields = [
        'book_id',
        'change_amount',
        'change_date',
        'reason'
    ];

    protected $useTimestamps = false;

    // Fungsi untuk mendapatkan semua data
    public function getAllStockHistory()
    {
        return $this->findAll();
    }

    // Fungsi untuk menambah data baru
    public function createStockHistory($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mendapatkan data berdasarkan ID
    public function getStockHistoryById($id)
    {
        return $this->find($id);
    }

    // Fungsi untuk memperbarui data
    public function updateStockHistory($id, $data)
    {
        return $this->update($id, $data);
    }

    // Fungsi untuk menghapus data
    public function deleteStockHistory($id)
    {
        return $this->delete($id);
    }
}
