<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StockHistoryModel;
use App\Models\BookModel;

class Stock extends BaseController
{
    protected $stockHistoryModel;
    protected $bookModel;

    public function __construct()
    {
        $this->stockHistoryModel = new StockHistoryModel();
        $this->bookModel = new BookModel(); // Tambahkan ini
    }

    public function index()
    {
        // Memuat model
        $stockHistoryModel = new \App\Models\StockHistoryModel();
        $bookModel = new \App\Models\BookModel();

        // Ambil semua data stock history
        $stock_history = $stockHistoryModel->findAll();

        // Ambil semua buku untuk dropdown
        $books = $bookModel->findAll();

        // Tambahkan judul buku ke dalam setiap history
        foreach ($stock_history as &$history) {
            $book = $bookModel->find($history['book_id']);
            $history['book_title'] = $book ? $book['title'] : 'Buku Tidak Ditemukan'; // Menyimpan judul buku
        }

        return view('stok/index', [
            'stock_history' => $stock_history,
            'books' => $books,
        ]);
    }


    public function store()
    {
        $data = [
            'book_id' => $this->request->getPost('book_id'),
            'change_amount' => $this->request->getPost('change_amount'),
            'change_date' => $this->request->getPost('change_date'),
            'reason' => $this->request->getPost('reason'),
        ];
        $this->stockHistoryModel->createStockHistory($data);
        return redirect()->to('/stok');
    }

    public function edit($id)
    {
        $data['stock_history'] = $this->stockHistoryModel->getStockHistoryById($id);
        return view('stok/edit', $data); // Tampilkan form untuk mengedit stok
    }

    public function update($id)
    {
        $data = [
            'book_id' => $this->request->getPost('book_id'),
            'change_amount' => $this->request->getPost('change_amount'),
            'change_date' => $this->request->getPost('change_date'),
            'reason' => $this->request->getPost('reason'),
        ];
        $this->stockHistoryModel->updateStockHistory($id, $data);
        return redirect()->to('/stok');
    }

    public function delete($id)
    {
        $this->stockHistoryModel->deleteStockHistory($id);
        return redirect()->to('/stok');
    }
}
