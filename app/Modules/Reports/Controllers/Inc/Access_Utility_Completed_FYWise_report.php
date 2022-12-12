<?php
namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\bridge\Models\bridge_model;

class Access_Utility_Completed_FYWise_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $view_district_reg_office_model;

    private $bridge_model;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $bridge_model = new bridge_model();
      
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
      $this->bridge_model = $bridge_model;
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

    public function index($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $perPage = 4;
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

        return view('\Modules\Reports\Views\Access_Utility_Completed_FYWise_report', $data);
    }
}