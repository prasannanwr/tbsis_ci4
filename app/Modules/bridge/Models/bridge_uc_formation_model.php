<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_uc_formation_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_uc_composition';
    protected $primaryKey       = 'b_uc_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'b_uc_assessment_by',
        'b_uc_assessment_date',
        'b_uc_cp_dalit',
        'b_uc_cp_janjati',
        'b_uc_cp_minorities',
        'b_uc_cp_bct',
        'b_uc_cp_female',
        'b_uc_cp_male',
        'b_uc_dy_dalit',
        'b_uc_dy_janjati',
        'b_uc_dy_minorities',
        'b_uc_dy_bct',
        'b_uc_dy_female',
        'b_uc_dy_male',
        'b_uc_sc_dalit',
        'b_uc_sc_janjati',
        'b_uc_sc_minorities',
        'b_uc_sc_bct',
        'b_uc_sc_female',
        'b_uc_sc_male',
        'b_uc_tr_dalit',
        'b_uc_tr_janjati',
        'b_uc_tr_minorities',
        'b_uc_tr_bct',
        'b_uc_tr_female',
        'b_uc_tr_male',
        'b_uc_mm_dalit',
        'b_uc_mm_janjati',
        'b_uc_mm_minorities',
        'b_uc_mm_bct',
        'b_uc_mm_female',
        'b_uc_mm_male',
        'b_uc_cp_total',
        'b_uc_dy_total',
        'b_uc_sc_total',
        'b_uc_tr_total',
        'b_uc_mm_total',
        'b_uc_status',
        'b_uc_added_date',
        'b_uc_updated_date'
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
