<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_employment_generation_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_employment_generation';
    protected $primaryKey       = 'beg_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'beg_dalit_women',
        'beg_dalit_men',
        'beg_dalit_poor',
        'beg_janjati_women',
        'beg_janjati_men',
        'beg_janjati_poor',
        'beg_minorities_women',
        'beg_minorities_men',
        'beg_minorities_poor',
        'beg_bct_women',
        'beg_bct_men',
        'beg_bct_poor',
        'beg_total_women',
        'beg_total_men',
        'beg_total_poor',
        'beg_total',
        'beg_percent_women',
        'beg_percent_men',
        'beg_percent_poor',
        'beg_percent_total'
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
