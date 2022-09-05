<?php

namespace App\Modules\view\Models;

use App\Modules\auth\Models\sel_district_model;
use CodeIgniter\Model;

class view_all_join_bridge_table_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'view_all_join_bridge_table';
    protected $primaryKey       = 'bri03id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    public function dbGetList()
    {
        //$this->load->model('auth/sel_district_model');
        $sel_district_model = new sel_district_model();
        $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
        

        $arrPermittedDistList = array();
        foreach( $arrPermittedDistListFull as $k=>$v ){
            $arrPermittedDistList[] = $v['user02dist01id'];
        }
        $blnIsLogged = empty($this->session);
        //var_dump(session()->get('type'));
        $intUserType = ($blnIsLogged)? session()->get('type'): ENUM_GUEST; 
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            $data = '';
            if( count( $arrPermittedDistList )> 0){
                $data = $this->whereIn('dist01id', $arrPermittedDistList);
            }else{
                $data = $this->where('dist01id', null);
            }
        }
        //return parent::findAll();
        return $data;

    }
}