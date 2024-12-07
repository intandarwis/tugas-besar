<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'visitor_id';
    protected $allowedFields = [
        'visitor_name',
        'visitor_email',
        'visitor_phone',
        'visitor_address',
        'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Tidak ada kolom updated_at

    public function getAllVisitors()
    {
        return $this->findAll();
    }

    public function getVisitor($id)
    {
        return $this->find($id);
    }

    public function addVisitor($data)
    {
        return $this->insert($data);
    }

    public function updateVisitor($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteVisitor($id)
    {
        return $this->delete($id);
    }
}
