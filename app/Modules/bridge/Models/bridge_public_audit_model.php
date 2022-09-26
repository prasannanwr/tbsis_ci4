<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_public_audit_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_public_audit';
    protected $primaryKey       = 'pa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pa_bridge_id',
        'pa_assessment_by',
        'pa_assessment_date',
        'pa_status',
        'dalit_total',
        'dalit_percent',
        'janjati_total',
        'janjati_percent',
        'minorities_total',
        'minorities_percent',
        'bct_total',
        'bct_percent',
        'pa_sum',
        'pa_female',
        'pa_male',
        'pa_sum_percent',
        'pa_female_percent',
        'pa_male_percent',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


}
