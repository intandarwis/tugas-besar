<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    protected $allowedFields = ['visitor_id', 'book_id', 'loan_date', 'due_date', 'return_status'];

    // Method untuk mendapatkan semua pinjaman dengan join tabel visitors dan books
    public function getAllLoans()
    {
        return $this->select('loans.*, visitors.visitor_name, books.title')
            ->join('visitors', 'visitors.visitor_id = loans.visitor_id')
            ->join('books', 'books.book_id = loans.book_id')
            ->findAll();
    }

    // Fungsi untuk mengambil data peminjaman berdasarkan bulan dan tahun
    public function getLoansByMonth($month, $year)
    {
        return $this->select('loans.*, visitors.visitor_name, books.title')
            ->join('visitors', 'visitors.visitor_id = loans.visitor_id')
            ->join('books', 'books.book_id = loans.book_id')
            ->where('MONTH(loan_date)', $month)
            ->where('YEAR(loan_date)', $year)
            ->findAll();
    }

    // Fungsi untuk menyimpan data peminjaman baru
    public function addLoan($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mengupdate data peminjaman
    public function updateLoan($id, $data)
    {
        return $this->update($id, $data);
    }

    // Fungsi untuk menghapus data peminjaman
    public function deleteLoan($id)
    {
        return $this->delete($id);
    }
}
