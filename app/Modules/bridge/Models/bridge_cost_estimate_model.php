<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_cost_estimate_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_cost_estimate';
    protected $primaryKey       = 'bce_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'bri_impl_approach_check',
        'bri_impl_approach_deficiency',
        'bri_impl_approach_remarks',
        'bri_unit_rates_steel_check',
        'bri_unit_rates_steel_remarks',
        'bri_unit_rates_check',
        'bri_unit_rates_remarks',
        'bri_portering_dis_check',
        'bri_portering_dis_remarks',
        'bri_pm_linearcost_check',
        'bri_pm_linearcost_deficiency',
        'bri_pm_linearcost_remarks',
        'cost_est_site_assessment_by',
        'cost_est_site_assessment_date',
        'cost_est_remarks',
        'cost_est_active'
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