<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'log_id';
    protected $allowedFields = [
        'activity_type',
        'activity_date',
        'details'
    ];

    protected $useTimestamps = false;
}
