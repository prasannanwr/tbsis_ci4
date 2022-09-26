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
        'bsa_meandering',
        'bsa_influencing_rivulet',
        'bsa_source_sand',
        'bsa_source_stone',
        'bsa_source_gravel',
        'bsa_profile_survey',
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