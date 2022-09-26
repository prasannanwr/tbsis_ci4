<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_beneficiaries_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_beneficiaries';
    protected $primaryKey       = 'bb_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bb_id',
        'bb_bridge_id',
        'dalit_total',
        'dalit_poor',
        'dalit_women',
        'dalit_men',
        'janjati_total',
        'janjati_poor',
        'janjati_women',
        'janjati_men',
        'minorities_total',
        'minorities_poor',
        'minorities_women',
        'minorities_men',
        'bct_total',
        'bct_poor',
        'bct_women',
        'bct_men',
        'total_household',
        'total_poor',
        'total_women',
        'total_men',
        'percent_household',
        'percent_poor',
        'percent_women',
        'percent_men',
        'bb_assessment_by',
        'bb_assessment_date',
        'bb_status',
        'bb_added_date',
        'bb_updated_date'
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
