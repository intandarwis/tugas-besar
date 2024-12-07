<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReturnModel;
use App\Models\LoanModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReturnController extends BaseController
{
    protected $returnModel;
    protected $loanModel;

    public function __construct()
    {
        $this->returnModel = new ReturnModel();
        $this->loanModel = new LoanModel();
    }

    public function index()
    {
        $data['returns'] = $this->returnModel->getAllReturns();
        $data['loans'] = $this->loanModel->getAllLoans();
        return view('pengembalian/index', $data);
    }

    public function store()
    {
        $data = [
            'loan_id' => $this->request->getPost('loan_id'),
            'return_date' => $this->request->getPost('return_date'),
            'fine' => $this->request->getPost('fine'),
            'late' => $this->request->getPost('late'),
        ];

        $this->returnModel->insert($data);
        return redirect()->to('/pengembalian')->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['return'] = $this->returnModel->find($id);
        $data['loans'] = $this->loanModel->getAllLoans();
        return view('pengembalian/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'loan_id' => $this->request->getPost('loan_id'),
            'return_date' => $this->request->getPost('return_date'),
            'fine' => $this->request->getPost('fine'),
            'late' => $this->request->getPost('late'),
        ];

        $this->returnModel->update($id, $data);
        return redirect()->to('/pengembalian')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function delete($id)
    {

        $this->returnModel->delete($id);

        return redirect()->to('/pengembalian')->with('success', 'Data pengembalian berhasil dihapus.');
    }

    public function exportToPdf()
    {
        // Ambil data pengembalian
        $data['returns'] = $this->returnModel->getAllReturns();

        // Set up Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Load HTML
        $html = view('pengembalian/pdf', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data_pengembalian.pdf', ["Attachment" => false]);
    }

    public function printSingleReturn($id)
    {
        // Ambil data pengembalian berdasarkan ID
        $return = $this->returnModel->getReturnById($id);

        // Cek jika data tidak ditemukan
        if (!$return) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data pengembalian dengan ID $id tidak ditemukan.");
        }

        // Set up Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Load HTML
        $data['return'] = $return; // Data pengembalian sudah termasuk visitor_name
        $html = view('pengembalian/single_pdf', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data_pengembalian_' . $id . '.pdf', ["Attachment" => false]);
    }
}
