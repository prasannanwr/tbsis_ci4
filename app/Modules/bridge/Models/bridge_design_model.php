<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_design_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_design';
    protected $primaryKey       = 'bd_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'bri_bri_type_check',
        'bri_bri_type_action',
        'bri_cable_geo_check',
        'bri_cable_geo_action',
        'bri_overall_design_check',
        'bri_overall_design_action',
        'bri_foundation_check',
        'bri_foundation_action',
        'bri_env_con_check',
        'bri_env_con_action',
        'bri_design_opt_check',
        'bri_design_opt_action',
        'bri_free_board_check',
        'bri_free_board_action',
        'bri_design_status',
        'design_site_assessment_date',
        'design_site_assessment_by',
        'bri_design_remarks'
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