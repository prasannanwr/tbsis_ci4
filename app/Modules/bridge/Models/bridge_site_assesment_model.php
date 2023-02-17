<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_site_assesment_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bridge_site_assesment';
    protected $primaryKey       = 'bsa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'b_id',
        'bsa_stability',
        'bsa_stability_def',
        'bsa_stability_remark',
        'bsa_stability_soil_conf',
        'bsa_stability_soil_conf_def',
        'bsa_stability_soil_conf_remark',
        'bsa_stability_rock_bed',
        'bsa_stability_rock_bed_def',
        'bsa_stability_rock_bed_remark',
        'bsa_stability_rock_wedge',
        'bsa_stability_rock_wedge_def',
        'bsa_stability_rock_wedge_remark',
        'bsa_meandering',
        'bsa_meandering_def',
        'bsa_meandering_remark',
        'bsa_influencing_rivulet',
        'bsa_rivulet_remark',
        'bsa_rivulet_def',
        'bsa_source_sand',
        'bsa_source_sand_def',
        'bsa_source_sand_remark',
        'bsa_source_stone',
        'bsa_source_stone_def',
        'bsa_source_stone_remark',
        'bsa_source_gravel',
        'bsa_source_gravel_def',
        'bsa_source_gravel_remark',
        'bsa_profile_survey',
        'bsa_profile_survey_def',
        'bsa_profile_survey_remark',
        'bsa_assesment_by',
        'bsa_assesment_date',
        'bsa_remark'
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

    public function getDblist() {
       
    }
}