<?php

namespace App\Modules\Reports\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge\Models\bridge_model;
use App\Modules\bridge_type\Models\bridge_type_model;
use App\Modules\cost_components\Models\cost_components_model;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
//use App\Modules\vdc_municipality\Models\vdc_municipality_model;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\view\Models\view_vdc_model;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\view\Models\view_for_detail_bridge_model;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_carry_previous;
use App\Modules\view\Models\view_dist01_bri05_count_first_constraction_fiscalyear;
use App\Modules\view\Models\view_count_material_handover_fiscalyear;
use App\Modules\view\Models\view_dist01_bri05_count_bridge_completion_fiscalyear_new;
use App\Modules\view\Models\view_count_steel_parts_fiscalyear;
use App\Modules\view\Models\view_count_cable_pulling_fiscalyear;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_site_assessment_dist_new;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_design_estimate_bridges_new;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_community_agreement_dist_new;
use App\Modules\fiscal_data\Models\fiscal_data_model;
use App\Modules\view\Models\view_bridge_actual_supporting_cost;
use App\Modules\view\Models\view_regional_office_model;
use App\Modules\regional_office\Models\regional_office_model;
use App\Modules\vdc_municipality\Models\MunicipalityModel;
use App\Modules\view\Models\view_bridge_actual_cost;
//use App\Modules\Reports\Models\ReportsModel;

class Reports extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $view_bridge_detail_model;

    private $view_district_reg_office_model;

    private $template;

    private $vcd_municipality_model;

    private $district_name_model;

    private $view_vdc_model;

    private $supporting_agencies_model;

    private $view_sup03_dist01_bri05_count_carry_previous;

    private $bridge_model;

    private $cost_components_model;

    private $view_for_detail_bridge_model;

    private $bridge_type_model;

    private $view_dist01_bri05_count_first_constraction_fiscalyear;

    private $view_count_material_handover_fiscalyear;

    private $view_dist01_bri05_count_bridge_completion_fiscalyear_new;

    private $view_count_steel_parts_fiscalyear;

    private $view_count_cable_pulling_fiscalyear;

    private $view_sup03_dist01_bri05_count_site_assessment_dist_new;

    private $view_sup03_dist01_bri05_count_design_estimate_bridges_new;

    private $view_sup03_dist01_bri05_count_community_agreement_dist_new;

    private $fiscal_data_model;

    private $view_bridge_actual_supporting_cost;

    private $view_regional_office_model;

    private $regional_office_model;

    private $view_bridge_actual_cost;

    public function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        $fiscal_year_model = new FiscalYearModel();
        $view_bridge_detail_model = new view_bridge_detail_model();
        $view_district_reg_office_model = new view_district_reg_office_model();
        $vcd_municipality_model = new MunicipalityModel();
        $district_name_model = new district_name_model();
        $view_vdc_model  = new view_vdc_model();
        $supporting_agencies_model = new supporting_agencies_model();
        $view_sup03_dist01_bri05_count_carry_previous = new view_sup03_dist01_bri05_count_carry_previous();
        $bridge_model = new bridge_model();
        $cost_components_model = new cost_components_model();
        $view_for_detail_bridge_model = new view_for_detail_bridge_model();
        $bridge_type_model = new bridge_type_model();
        $view_dist01_bri05_count_first_constraction_fiscalyear = new view_dist01_bri05_count_first_constraction_fiscalyear();
        $view_count_material_handover_fiscalyear = new view_count_material_handover_fiscalyear();
        $view_dist01_bri05_count_bridge_completion_fiscalyear_new = new view_dist01_bri05_count_bridge_completion_fiscalyear_new();
        $view_count_steel_parts_fiscalyear = new view_count_steel_parts_fiscalyear();
        $view_count_cable_pulling_fiscalyear = new view_count_cable_pulling_fiscalyear();
        $view_sup03_dist01_bri05_count_site_assessment_dist_new = new view_sup03_dist01_bri05_count_site_assessment_dist_new();
        $view_sup03_dist01_bri05_count_design_estimate_bridges_new = new view_sup03_dist01_bri05_count_design_estimate_bridges_new();
        $view_sup03_dist01_bri05_count_community_agreement_dist_new = new view_sup03_dist01_bri05_count_community_agreement_dist_new();
        $fiscal_data_model = new fiscal_data_model();
        $view_bridge_actual_supporting_cost = new view_bridge_actual_supporting_cost();
        $view_regional_office_model = new view_regional_office_model();
        $regional_office_model = new regional_office_model();
        $view_bridge_actual_cost = new view_bridge_actual_cost();
        $this->fiscal_year_model = $fiscal_year_model;
        $this->fiscal_data_model = $fiscal_data_model;
        $this->view_bridge_detail_model = $view_bridge_detail_model;
        $this->view_district_reg_office_model = $view_district_reg_office_model;
        $this->vcd_municipality_model = $vcd_municipality_model;
        $this->district_name_model = $district_name_model;
        $this->view_vdc_model = $view_vdc_model;
        $this->supporting_agencies_model = $supporting_agencies_model;
        $this->view_sup03_dist01_bri05_count_carry_previous = $view_sup03_dist01_bri05_count_carry_previous;
        $this->bridge_model = $bridge_model;
        $this->cost_components_model = $cost_components_model;
        $this->view_for_detail_bridge_model = $view_for_detail_bridge_model;
        $this->bridge_type_model = $bridge_type_model;
        $this->view_dist01_bri05_count_first_constraction_fiscalyear = $view_dist01_bri05_count_first_constraction_fiscalyear;
        $this->view_count_material_handover_fiscalyear = $view_count_material_handover_fiscalyear;
        $this->view_dist01_bri05_count_bridge_completion_fiscalyear_new = $view_dist01_bri05_count_bridge_completion_fiscalyear_new;
        $this->view_count_steel_parts_fiscalyear = $view_count_steel_parts_fiscalyear;
        $this->view_count_cable_pulling_fiscalyear = $view_count_cable_pulling_fiscalyear;
        $this->view_sup03_dist01_bri05_count_site_assessment_dist_new = $view_sup03_dist01_bri05_count_site_assessment_dist_new;
        $this->view_sup03_dist01_bri05_count_design_estimate_bridges_new = $view_sup03_dist01_bri05_count_design_estimate_bridges_new;
        $this->view_sup03_dist01_bri05_count_community_agreement_dist_new = $view_sup03_dist01_bri05_count_community_agreement_dist_new;
        $this->view_bridge_actual_supporting_cost = $view_bridge_actual_supporting_cost;
        $this->view_regional_office_model = $view_regional_office_model;
        $this->regional_office_model = $regional_office_model;
        $this->view_bridge_actual_cost = $view_bridge_actual_cost;

        $this->template = new Template();
        if (count(self::$arrDefData) <= 0) {
            $FName = basename(__FILE__, '.php');
            $fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName,
                'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
                'module'        => $fName,
                'view_file'     => 'index',
            );
        }
    }
    public function index()
    {
        return view('\Modules\Dashboard\Views\Index');
    }

    public function Gen_Dag_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Gen_Dag_FYWise', $data);
    }

    function Gen_Dag_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function Gen_Dag_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Gen_Dag_DateWise', $data);
    }

    function Gen_Dag_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    //beneficiaries
    public function Beneficiaries_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Beneficiaries_FYWise', $data);
    }

    function Beneficiaries_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function Beneficiaries_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Beneficiaries_DateWise', $data);
    }

    function Beneficiaries_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function UC_Composition_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\UC_Composition_FYWise', $data);
    }

    function UC_Composition_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function UC_Composition_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\UC_Composition_DateWise', $data);
    }

    function UC_Composition_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function UC_Proportion_Representation_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\UC_Proportion_Representation_FYWise', $data);
    }

    function UC_Proportion_Representation_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function UC_Proportion_Representation_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\UC_Proportion_Representation_DateWise', $data);
    }

    function UC_Proportion_Representation_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function UC_Executive_Position_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\UC_Executive_Position_FYWise', $data);
    }

    function UC_Executive_Position_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function UC_Executive_Position_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\UC_Executive_Position_DateWise', $data);
    }

    function UC_Executive_Position_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    public function Employment_Generation_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Employment_Generation_FYWise', $data);
    }

    function Employment_Generation_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function Employment_Generation_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Employment_Generation_DateWise', $data);
    }

    function Employment_Generation_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function Public_Audit_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Public_Audit_FYWise', $data);
    }

    function Public_Audit_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    public function Public_Audit_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Public_Audit_DateWise', $data);
    }

    function Public_Audit_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    //unacceptable
    // public function Unacceptable_Underconstruction($ext = '')
    // {
    //     $data = self::$arrDefData;
    //     $data['view_file'] = __FUNCTION__;
    //     // 
    //     $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
    //     $data['blnMM'] = $ext;
    //     return view('\Modules\Reports\Views\Unacceptable_Underconstruction', $data);
    // }
    public function Unacceptable_Technical_UnderConstruction($ext = '') 
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;

        $perPage = 4;
        $dataStart = "";
        $dateEnd = "";
        $data['dataStart'] = $dataStart;
        $data['dateEnd'] = $dateEnd;
        $arrPrintList = array();
        $selDist=$this->view_district_reg_office_model->paginate($perPage);
        $data['selDist'] = $selDist;
        $data['pager'] = $this->view_district_reg_office_model->pager;
        if(is_array( $selDist)){
            $i = 0;
            // echo "<pre>";
            // var_dump($selDist);exit;
            foreach( $selDist as $k=>$v){
                $rr=$v['dist01id'];
                // var_dump($v1);exit;
                $arrChild1=null;
                
                $arrBridgeList = $this->bridge_model->getBridgeUtilities($rr);
                
                if(is_array($arrBridgeList) && !empty($arrBridgeList)){
                    //print header
                    //echo 'header';
                    $row['dist'] = $v;
                    $row['data'] = $arrBridgeList;
                    $arrPrintList[] = $row;
                    $i++;
                }
            }
        }
        $data['arrPrintList'] = $arrPrintList;
        return view('\Modules\Reports\Views\Unacceptable_Technical_UnderConstruction', $data);
    }

    //access utility
    public function Access_Utility_Completed_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Access_Utility_Completed_FYWise', $data);
    }

    public function Access_Utility_Completed_FYWise_report($ext = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }
  
}