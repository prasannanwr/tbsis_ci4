<?php

namespace App\Modules\bridge\Models;

use App\Modules\auth\Models\sel_district_model;
use App\Modules\vdc_municipality\Models\vdc_municipality_model;
use App\Modules\view\Models\view_vdc_new_model;
use CodeIgniter\Model;

class bridge_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bri03basic_bridge_datatable';
    protected $primaryKey       = 'bri03id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "bri03bridge_name",
        "bri03construction_type",
        "bri03bridge_no",
        "bri03district_name_lb",
        "bri03district_name_rb",
        "bri03river_nam",
        "bri03municipality_lb",
        "bri03municipality_rb",
        "bri03major_vdc",
        "bri03bridge_series",
        "bri03ward_lb",
        "bri03ward_rb",
        "bri03road_head",
        "bri03portering_distance",
        "bri03bridge_type",
        "bri03design",
        "bri03ww_width",
        "bri03ww_deck_type",
        "bri03development_region",
        "bri03tbsu_regional_office",
        "bri03supporting_agency",
        "bri03work_category",
        "bri03project_fiscal_year",
        "bri03topo_map_no",
        "bri03coordinate_north",
        "bri03coordinate_east",
        "bri03e_span",
        "bri03is_new",
        "bri03ci_nol",
        "bri03ci_nor",
        "bri03ci_nomain",
        "bri03deleted",
        "bri03status",
        "dist_code",
        "bri03left_old_vdc_name",
        "bri03right_old_vdc_name",
        "cost_estimated_reference"
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

    public function dbGetList()
    {
        //check if loggged in or not
        //check if it has all district permission or not
        //
        $sel_district_model = new sel_district_model();
        $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
       
        $arrPermittedDistList = array();
        foreach( $arrPermittedDistListFull as $k=>$v ){
            $arrPermittedDistList[] = $v->user02dist01id;
        }
        $blnIsLogged = empty(session());
        $intUserType = ($blnIsLogged)? session()->get('type'): ENUM_GUEST; 
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            /*if( count( $arrPermittedDistList )> 0){
                $this->where_in('dist01id', $arrPermittedDistList);
            }else{
                $this->where('dist01id', null);
            }*/
			
			 if( count( $arrPermittedDistList )> 0){
                $this->where_in('bri03district_name_lb', $arrPermittedDistList);
            }else{
                $this->where('bri03district_name_lb', null);
            }
			
			
        }
		//echo $this->db->last_query();		
        return parent::dbGetList();
    }
    public function generate_bridge_code($intVDCNo, $ctype='')
    {
        $view_vdc_new_model = new view_vdc_new_model();
        
        $arrInfo = $view_vdc_new_model->where('muni01id', $intVDCNo)->first();
        
        $nb = ((int)$arrInfo['muni01last_bridge_no']) + 1;
        $nb = ($nb < 10) ? '0' . $nb : $nb;
        $x = $arrInfo['dist01code'] . ' ' . $arrInfo['muni01code'] . '' . BRIDGE_INF_CODE .'' . $nb;
        
        if($ctype== ENUM_MAJOR_MAINTENANCE){
            //$x .= MM_CODE;
            $x .= "M";
        }
        
        $vdc_municipality_model = new vdc_municipality_model();
        $vdc_municipality_model->update($intVDCNo, array('muni01id'=>$intVDCNo, 'muni01last_bridge_no'=> $arrInfo['muni01last_bridge_no'] + 1 ));
        //echo $this->db->last_query();
        //die();

        return $x;
    }

    /**
     * Access_Utility_Completed_FYWise_report

     *
     * @param [type] $distId
     * @param string $perPage
     * @param integer $offset
     * @return void
     */
    public function getBridgeUtilities($distId, $perPage='', $offset = 0) {

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`,`view_bridge_child`.`bri03portering_distance` AS `bri03portering_distance`,`view_bridge_child`.`bri03road_head` AS `bri03road_head`,`view_bridge_child`.`bri03river_type` AS `bri03river_type`,`bu`.`bu_name` as 'bri03utility_lb_name',`bu1`.`bu_name` as `bri03utility_rb_name`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_utilities as `bu`','`bu`.`bu_id` = `view_bridge_child`.`bri03utility_left_bank`', 'left')
            ->join('bridge_utilities as `bu1`','`bu1`.`bu_id` = `view_bridge_child`.`bri03utility_right_bank`', 'left');
        
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }

    /**
     * Unacceptable_Technical_UnderConstruction
     *
     * @param [type] $distId
     * @param string $perPage
     * @param integer $offset
     * @return void
     */
    public function getUTechUnderConstruction($distId, $perPage='', $offset = 0) {

        //using builder
        $builder = $this->db->table("view_bridge_child");
        $builder = $builder
            ->select("`view_district`.`dist01id` AS `dist01id`,`view_district`.`dist01name` AS `dist01name`,`view_bridge_child`.`bri03id` AS `bri03id`,`view_bridge_child`.`bri03bridge_name` AS `bri03bridge_name`,`view_bridge_child`.`bri03bridge_no` AS `bri03bridge_no`,`view_bridge_child`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`view_bridge_child`.`bri03status` AS `bri03status`,`view_bridge_child`.`bri03major_dist_id` AS `bri03major_dist_id`,`view_bridge_child`.`bri03portering_distance` AS `bri03portering_distance`,`view_bridge_child`.`bri03road_head` AS `bri03road_head`,`view_bridge_child`.`bri03river_type` AS `bri03river_type`,`bu`.`bu_name` as 'bri03utility_lb_name',`bu1`.`bu_name` as `bri03utility_rb_name`")
            ->join('view_district','`view_bridge_child`.`bri03major_dist_id` = `view_district`.`dist01id`', 'left')
            ->join('bridge_utilities as `bu`','`bu`.`bu_id` = `view_bridge_child`.`bri03utility_left_bank`', 'left');
        
        if($distId != '')
            $builder = $builder->where('`view_district`.`dist01id` =', $distId);

        $result = $builder->get();
        

        if($result->getNumRows() <= 0)
            return '';

        return $result->getResultArray();
    }
}