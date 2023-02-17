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
        'bri_cable_def',
        'bri_cable_action',
        'bri_bulldog_spec_check',
        'bri_bulldog_spec_def',
        'bri_bulldog_action',
        'bri_bulldog_missing_check',
        'bri_bulldog_missing_def',
        'bri_bulldog_missing_action',
        'bri_bulldog_retight_check',
        'bri_bulldog_retight_def',
        'bri_bulldog_retight_action',
        'bri_anchorage_check',
        'bri_anchorage_def',
        'bri_anchorage_action',
        'bri_walkway_check',
        'bri_walkway_def',
        'bri_walkway_action',
        'bri_wire_check',
        'bri_wire_def',
        'bri_wire_action',
        'bri_fixtures_check',
        'bri_fixtures_def',
        'bri_fixtures_action',
        'bri_fixtures_hot_check',
        'bri_fixtures_hot_def',
        'bri_fixtures_hot_action',
        'bri_relative_check',
        'bri_relative_def',
        'bri_relative_action',
        'bri_anchorage_dimension_check',
        'bri_anchorage_dimension_def',
        'bri_anchorage_dimension_action',
        'bri_anchorage_stone_check',
        'bri_anchorage_stone_def',
        'bri_anchorage_stone_action',
        'bri_suspenders_check',
        'bri_suspenders_def',
        'bri_suspenders_action',
        'bri_wire_mesh_uniform_check',
        'bri_wire_mesh_uniform_def',
        'bri_wire_mesh_uniform_action',
        'bri_tower_vertical_check',
        'bri_tower_vertical_def',
        'bri_tower_vertical_action',
        'bri_we_check',
        'bri_we_def',
        'bri_we_action',
        'bri_windties_check',
        'bri_windties_def',
        'bri_windties_action',
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