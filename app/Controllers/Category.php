<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\BookModel;
use App\Models\LoanModel;
use App\Models\StockHistoryModel;

use CodeIgniter\Controller;

class Category extends Controller
{
    protected $categoryModel;
    protected $bookModel;
    protected $loanModel;


    public function __construct()
    {
        $this->loanModel = new LoanModel();
        $this->categoryModel = new CategoryModel();
        $this->bookModel = new BookModel(); // Inisialisasi model buku
    }

    public function index()
    {
        $data['categories'] = $this->categoryModel->getAllCategories();
        return view('category/index', $data);
    }

    public function create()
    {
        return view('category/create');
    }

    public function store()
    {
        $this->categoryModel->save([
            'category_name' => $this->request->getPost('category_name')
        ]);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data['category'] = $this->categoryModel->getCategoryById($id);
        return view('category/edit', $data);
    }

    public function update($id)
    {
        $this->categoryModel->update($id, [
            'category_name' => $this->request->getPost('category_name')
        ]);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diupdate!');
    }

    public function delete($id)
    {
        // Mengambil semua buku berdasarkan kategori yang akan dihapus
        $books = $this->bookModel->where('category_id', $id)->findAll();

        // Hapus semua data pinjaman yang terkait dengan buku-buku di kategori ini
        foreach ($books as $book) {
            $this->loanModel->where('book_id', $book['book_id'])->delete();
        }

        // Hapus semua buku yang terkait dengan kategori ini
        $this->bookModel->where('category_id', $id)->delete();

        // Hapus kategori
        $this->categoryModel->delete($id);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
