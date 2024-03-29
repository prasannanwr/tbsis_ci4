<?php

namespace App\Modules\basic_supporting_agencies\Models;

use CodeIgniter\Model;

class basic_supporting_agencies_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sup03basic_supporting_agency';
    protected $primaryKey       = 'sup03id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'sup03id',
				'sup03sup_agency_code',
				'sup03sup_agency_name',
				'sup03sup_agency_type',
				'sup03description',
				'sup03index'
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

	public function view_sup01_sup02(){
        $this->table = __FUNCTION__;
        return $this->asObject()->findAll();
    }

}