<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use App\Models\StockHistoryModel;

use CodeIgniter\Controller;

class Book extends Controller
{
    protected $bookModel;
    protected $categoryModel;
    protected $stokHistoryModel;


    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->categoryModel = new CategoryModel();
        $this->stokHistoryModel = new StockHistoryModel();
    }

    public function index()
    {
        $data['books'] = $this->bookModel->select('books.*, categories.category_name')
            ->join('categories', 'books.category_id = categories.category_id')
            ->findAll();

        $data['categories'] = $this->categoryModel->findAll();
        return view('book/index', $data);
    }

    public function store()
    {
        $this->bookModel->save([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'publisher' => $this->request->getPost('publisher'),
            'year_published' => $this->request->getPost('year_published'),
            'stock' => $this->request->getPost('stock'),
            'category_id' => $this->request->getPost('category_id')
        ]);

        return redirect()->to('/buku')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->bookModel->update($id, [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'publisher' => $this->request->getPost('publisher'),
            'year_published' => $this->request->getPost('year_published'),
            'stock' => $this->request->getPost('stock'),
            'category_id' => $this->request->getPost('category_id')
        ]);

        return redirect()->to('/buku')->with('success', 'Buku berhasil diupdate!');
    }

    public function delete($id)
    {
        $this->stokHistoryModel->where('book_id', $id)->delete();
        $this->bookModel->delete($id);
        return redirect()->to('/buku')->with('success', 'Buku berhasil dihapus!');
    }
}
