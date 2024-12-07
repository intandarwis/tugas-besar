<?php

namespace App\Controllers;

namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\ReturnModel;
use App\Models\VisitorModel;
use App\Models\BookModel;
use Dompdf\Dompdf;

class Loan extends BaseController
{
    protected $loanModel;
    protected $returnModel;

    public function __construct()
    {
        $this->loanModel = new LoanModel(); // Inisialisasi loanModel
        $this->returnModel = new ReturnModel(); // Inisialisasi returnModel
    }

    public function index()
    {
        $visitorModel = new VisitorModel();
        $bookModel = new BookModel();

        $data['loans'] = $this->loanModel->getAllLoans();
        $data['visitors'] = $visitorModel->getAllVisitors();
        $data['books'] = $bookModel->findAll();

        return view('peminjaman/index', $data);
    }

    public function add()
    {
        $data = [
            'visitor_id' => $this->request->getPost('visitor_id'),
            'book_id' => $this->request->getPost('book_id'),
            'loan_date' => $this->request->getPost('loan_date'),
            'due_date' => $this->request->getPost('due_date'),
            'return_status' => $this->request->getPost('return_status')
        ];

        $this->loanModel->insert($data);

        return redirect()->to('/loan');
    }

    public function getLoan($loan_id)
    {
        $loan = $this->loanModel->find($loan_id);
        echo json_encode($loan);
    }

    public function update()
    {
        $data = [
            'loan_id' => $this->request->getPost('loan_id'),
            'book_id' => $this->request->getPost('book_id'),
            'visitor_id' => $this->request->getPost('visitor_id'),
            'loan_date' => $this->request->getPost('loan_date'),
            'due_date' => $this->request->getPost('due_date'),
            'return_status' => $this->request->getPost('return_status'),
        ];

        $this->loanModel->updateLoan($data['loan_id'], $data);
        return redirect()->to('/loan');
    }

    public function delete($id)
    {
        // Menghapus record terkait di tabel returns berdasarkan loan_id
        $this->returnModel->where('loan_id', $id)->delete();

        // Menghapus record dari tabel loans
        $this->loanModel->delete($id);

        return redirect()->to('/loan');
    }

    public function exportAllLoansToPdf()
    {
        $loans = $this->loanModel->getAllLoans(); // Ambil semua data peminjaman

        // Inisialisasi Dompdf
        $dompdf = new \Dompdf\Dompdf();

        // Load view dengan semua data peminjaman
        $html = view('peminjaman/pdf_all', ['loans' => $loans]);

        // Render PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Menggunakan orientasi landscape
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream('all_loans.pdf', ['Attachment' => false]);
    }

    public function exportLoanToPdf($loan_id)
    {
        // Ambil data peminjaman berdasarkan loan_id
        $loan = $this->loanModel->find($loan_id);

        // Inisialisasi Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $visitorModel = new VisitorModel();
        $bookModel = new BookModel();

        // Ambil data visitor dan book berdasarkan id
        $visitor = $visitorModel->find($loan['visitor_id']);
        $book = $bookModel->find($loan['book_id']);

        // Siapkan data untuk view
        $data = [
            'loan' => $loan,
            'visitor_name' => $visitor ? $visitor['visitor_name'] : 'N/A',
            'book_title' => $book ? $book['title'] : 'N/A'
        ];

        // Load view dengan data peminjaman yang dipilih
        $html = view('peminjaman/pdf_single', $data);

        // Render PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream('loan_' . $loan_id . '.pdf', ['Attachment' => false]);
    }
}
