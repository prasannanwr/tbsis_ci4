<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_public_hearing_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_public_hearing';
    protected $primaryKey       = 'ph_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ph_bridge_id',
        'ph_assessment_by',
        'ph_assessment_date',
        'ph_status',
        'dalit_total',
        'dalit_percent',
        'janjati_total',
        'janjati_percent',
        'minorities_total',
        'minorities_percent',
        'bct_total',
        'bct_percent',
        'ph_sum',
        'ph_female',
        'ph_male',
        'ph_sum_percent',
        'ph_female_percent',
        'ph_male_percent'
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
