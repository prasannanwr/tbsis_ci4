<?php

namespace App\Modules\bridge\Models;

use App\Modules\auth\Models\sel_district_model;
use CodeIgniter\Model;

class bridge_basic_data_model extends Model
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
        "bri03river_name",
        "bri03municipality_lb",
        "bri03municipality_rb",
        "bri03major_vdc",
        "bri03place_name",
        "bri03bridge_series",
        "bri03ward_lb",
        "bri03ward_rb",
        "bri03road_head",
        "bri03portering_distance",
        "bri03district_distance",
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
        "cost_estimated_reference",
        "bri03utility_left_bank",
        "bri03utility_right_bank",
        "bri03physical_progress",
        "bri03river_type"
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
        foreach ($arrPermittedDistListFull as $k => $v) {
            $arrPermittedDistList[] = $v['user02dist01id'];
        }
        $blnIsLogged = empty(session());
        $intUserType = ($blnIsLogged) ? session()->get('type') : ENUM_GUEST;
        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
            //comma seperated value
            if (count($arrPermittedDistList) > 0) {
                $this->where_in('dist01id', $arrPermittedDistList);
            } else {
                $this->where('dist01id', null);
            }
        }
        return parent::dbGetList();
    }
}
