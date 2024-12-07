<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitorModel;
use App\Models\LoanModel;
use App\Models\ReturnModel;
use Dompdf\Dompdf;


use CodeIgniter\HTTP\ResponseInterface;

class Visitors extends BaseController
{
    protected $visitorModel;
    protected $loanModel;
    protected $returnModel;

    public function __construct()
    {
        $this->loanModel = new LoanModel();
        $this->visitorModel = new VisitorModel();
        $this->returnModel = new ReturnModel(); // Inisialisasi returnModel
    }

    public function index()
    {
        $data['visitors'] = $this->visitorModel->getAllVisitors();
        return view('/pengunjung/index', $data);
    }

    public function create()
    {
        return view('/pengunjung/create');
    }

    public function store()
    {
        $data = [
            'visitor_name' => $this->request->getPost('visitor_name'),
            'visitor_email' => $this->request->getPost('visitor_email'),
            'visitor_phone' => $this->request->getPost('visitor_phone'),
            'visitor_address' => $this->request->getPost('visitor_address'),
        ];
        $this->visitorModel->addVisitor($data);
        return redirect()->to('/pengunjung');
    }

    public function edit($id)
    {
        $data['visitor'] = $this->visitorModel->getVisitor($id);
        return view('/pengunjung/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'visitor_name' => $this->request->getPost('visitor_name'),
            'visitor_email' => $this->request->getPost('visitor_email'),
            'visitor_phone' => $this->request->getPost('visitor_phone'),
            'visitor_address' => $this->request->getPost('visitor_address'),
        ];
        $this->visitorModel->updateVisitor($id, $data);
        return redirect()->to('/pengunjung');
    }

    public function delete($id)
    {
        // Hapus data di tabel return
        $this->returnModel->where('visitor_id', $id)->delete();

        // Hapus data di tabel loan
        $this->loanModel->where('visitor_id', $id)->delete();

        // Hapus data pengunjung
        $this->visitorModel->deleteVisitor($id);

        return redirect()->to('/pengunjung');
    }

    public function exportPDF()
    {
        $visitors = $this->visitorModel->getAllVisitors();

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Load view yang akan dijadikan PDF
        $html = view('pengunjung/pdf', ['visitors' => $visitors]);

        // Render PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output ke browser
        $dompdf->stream('daftar_pengunjung.pdf', ['Attachment' => false]);
    }

    public function exportVisitorPDF($id)
    {
        // Ambil data pengunjung berdasarkan ID
        $visitor = $this->visitorModel->getVisitor($id);

        // Inisialisasi Dompdf
        $dompdf = new \Dompdf\Dompdf();

        // Load view dengan data pengunjung yang dipilih
        $html = view('pengunjung/pdf_single', ['visitor' => $visitor]);

        // Render PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream('visitor_' . $id . '.pdf', ['Attachment' => false]);
    }
}
