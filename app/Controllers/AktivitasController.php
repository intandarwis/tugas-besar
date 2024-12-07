<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AktivitasController extends BaseController
{
    public function index()
    {
        $activityLogModel = new \App\Models\ActivityLogModel();
        $data['activityLogs'] = $activityLogModel->findAll();

        return view('aktivitas/index', $data);
    }
}
