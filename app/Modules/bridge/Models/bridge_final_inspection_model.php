<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_final_inspection_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_final_inspection';
    protected $primaryKey       = 'bri_f_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'bri_cable_check',
        'bri_bulldog_check',
        'bri_anchorage_check',
        'bri_walkway_check',
        'bri_wire_check',
        'bri_fixtures_check',
        'bri_relative_check',
        'bri_anchorage_dimension_check',
        'bri_anchorage_stone_check',
        'bri_suspenders_check',
        'bri_wire_mesh_check',
        'bri_completion_fiscal_year',
        'bri_remarks',
        'bridge_completion_date',
        'fi_site_assessment_by',
        'fi_site_assessment_date',
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