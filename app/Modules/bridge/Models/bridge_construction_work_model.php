<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_construction_work_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_construction_work';
    protected $primaryKey       = 'bcw_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'bri_quality_stones_check',
        'bri_quality_stones_def',
        'bri_quality_stones_remarks',
        'bri_verify_concrete_drum_check',
        'bri_verify_concrete_drum_def',
        'bri_verify_concrete_drum_remarks',
        'bri_bulldog_check',
        'bri_bulldog_def',
        'bri_bulldog_remarks',
        'bri_workmanship_check',
        'bri_workmanship_def',
        'bri_workmanship_remarks',
        'bri_masonry_stone_check',
        'bri_masonry_stone_def',
        'bri_masonry_stone_remarks',
        'bri_masonry_monolithic_check',
        'bri_masonry_monolithic_def',
        'bri_masonry_monolithic_remarks',
        'bri_verify_concrete_foundation_check',
        'bri_verify_concrete_foundation_def',
        'bri_verify_concrete_foundation_remarks',
        'bri_tower_check',
        'bri_tower_def',
        'bri_tower_remarks',
        'bri_cement_check',
        'bri_cement_def',
        'bri_cement_remarks',
        'bri_dimension_anchorage_check',
        'bri_dimension_anchorage_def',
        'bri_dimension_anchorage_remarks',
        'bri_cable_quality_check',
        'bri_cable_quality_def',
        'bri_cable_quality_remarks',
        'bri_cable_sag_check',
        'bri_cable_sag_def',
        'bri_cable_sag_remarks',
        'bri_verify_concreting_deadman_check',
        'bri_verify_concreting_deadman_def',
        'bri_verify_concreting_deadman_remarks',
        'bri_relative_sag_check',
        'bri_relative_sag_def',
        'bri_relative_sag_remarks',
        'bri_painting_works_check',
        'bri_painting_works_def',
        'bri_painting_works_remarks',
        'bri_plum_concrete_check',
        'bri_plum_concrete_def',
        'bri_plum_concrete_remarks',
        'bri_plum_concrete_gap_check',
        'bri_plum_concrete_gap_check_def',
        'bri_plum_concrete_gap_check_remarks',
        'bcw_assessment_by',
        'bcw_assessment_date',
        'bcw_remarks',
        'bcw_active'
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