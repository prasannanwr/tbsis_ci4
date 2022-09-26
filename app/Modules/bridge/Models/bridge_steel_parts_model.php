<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_steel_parts_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_steel_parts';
    protected $primaryKey       = 'bsp_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'bri_quality_steel_check',
        'bri_qa_document_check',
        'bri_welding_check',
        'bri_zinc_coating_check',
        'factory_visit_assessment_by',
        'factory_visit_assessment_date',
        'factory_visit_remarks',
        'factory_visit_active'
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