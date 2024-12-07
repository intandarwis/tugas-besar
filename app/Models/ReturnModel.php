<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'return_id';
    protected $allowedFields = [
        'loan_id',
        'visitor_id',
        'return_date',
        'fine',
        'late'
    ];

    protected $useTtimestamps = false; // Tidak ada kolom timestamps

    // Method untuk mendapatkan semua pengembalian dengan join tabel loans, visitors, dan books
    public function getAllReturns()
    {
        return $this->select('returns.*, loans.visitor_id, loans.book_id, loans.loan_date, visitors.visitor_name, books.title')
            ->join('loans', 'loans.loan_id = returns.loan_id')
            ->join('visitors', 'visitors.visitor_id = loans.visitor_id')
            ->join('books', 'books.book_id = loans.book_id')
            ->findAll();
    }

    // Fungsi untuk mengambil data pengembalian berdasarkan bulan dan tahun
    public function getReturnsByMonth($month, $year)
    {
        return $this->select('returns.*, loans.visitor_id, loans.book_id, loans.loan_date, visitors.visitor_name, books.title')
            ->join('loans', 'loans.loan_id = returns.loan_id')
            ->join('visitors', 'visitors.visitor_id = loans.visitor_id')
            ->join('books', 'books.book_id = loans.book_id')
            ->where('MONTH(return_date)', $month)
            ->where('YEAR(return_date)', $year)
            ->findAll();
    }

    public function getReturnById($id)
    {
        return $this->select('returns.*, visitors.visitor_name')
            ->join('visitors', 'visitors.visitor_id = returns.visitor_id')
            ->where(['returns.return_id' => $id])
            ->asArray()
            ->first();
    }
}
