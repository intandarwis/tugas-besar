<?php

namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\ReturnModel;

class Home extends BaseController
{
    public function index(): string
    {
        $loanModel = new LoanModel();
        $returnModel = new ReturnModel();

        // Mengambil jumlah peminjaman per bulan
        $loansByMonth = $loanModel->select("MONTH(loan_date) as month, COUNT(*) as total_loans")
            ->groupBy("MONTH(loan_date)")
            ->findAll();

        // Mengambil jumlah pengembalian per bulan
        $returnsByMonth = $returnModel->select("MONTH(return_date) as month, COUNT(*) as total_returns")
            ->groupBy("MONTH(return_date)")
            ->findAll();

        // Menyusun data ke dalam array yang akan dipakai di view
        $loanData = array_fill(1, 12, 0);  // Array untuk menyimpan data peminjaman 12 bulan
        $returnData = array_fill(1, 12, 0);  // Array untuk menyimpan data pengembalian 12 bulan

        foreach ($loansByMonth as $loan) {
            $loanData[(int) $loan['month']] = $loan['total_loans'];
        }

        foreach ($returnsByMonth as $return) {
            $returnData[(int) $return['month']] = $return['total_returns'];
        }

        // Mengirim data ke view
        $data = [
            'loanData' => $loanData,
            'returnData' => $returnData
        ];

        return view('welcome_message', $data);
    }
}
