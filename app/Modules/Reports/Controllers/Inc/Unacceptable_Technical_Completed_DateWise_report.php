<?php
namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\bridge\Models\bridge_model;
use App\Modules\province\Models\ProvinceModel;
use App\Modules\User\Models\UserModel;

class Unacceptable_Technical_Completed_DateWise_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $view_district_reg_office_model;

    private $bridge_model;

    private $province_model;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $bridge_model = new bridge_model();
      $province_model = new ProvinceModel();
      
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
      $this->bridge_model = $bridge_model;
      $this->province_model = $province_model;
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
        $request = service('request');
        $searchData = $request->getGet();

        $dataStart = "";
        $dateEnd = "";
        if(isset($searchData) && isset($searchData['dataStart'])){
           $dataStart = $searchData['dataStart'];
           $dateEnd = $searchData['dateEnd'];
           $Postback = '';
        } else {
            $Postback = @$this->request->getVar('submit');
            $dateStart = @$this->request->getVar('start_date');
            $dateEnd = @$this->request->getVar('end_date');
        } 

        $perPage = ITEMS_PER_PAGE;
        $arrPrintList = array();
        $selProvince = @$this->request->getVar('selProvince');       
        $data['selProvince'] = $selProvince;
        if($selProvince != '' && strtolower($selProvince) != "all") {                          
          $selDist=$this->view_district_reg_office_model->where('province_id',$selProvince)->paginate($perPage);
        } else {
          $selDist=$this->view_district_reg_office_model->paginate($perPage);
        } 
        
        if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
              $data['selDist'] = $selDist;
              $data['pager'] = $this->view_district_reg_office_model->pager;
              $data['provinceList'] = $this->province_model->asObject()->findAll();
              $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dataStart)->first();
              $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
              
              if(is_array( $selDist)){
                  $i = 0;
                  // echo "<pre>";
                  // var_dump($selDist);exit;
                  foreach( $selDist as $k=>$v){
                      $rr=$v['dist01id'];
                      // var_dump($v1);exit;
                      $arrChild1=null;
                      
                      $arrBridgeList = $this->bridge_model->getUnacceptableTechnical(4,$rr,$dataStart, $dateEnd);
                      
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
              $data['provinceList'] = $this->province_model->asObject()->findAll();
              
                $data['dataStart'] = $dataStart;
                $data['dateEnd'] = $dateEnd;

              return view('\Modules\Reports\Views\Unacceptable_Technical_Completed_DateWise_report', $data);
            }
        }
        
    }
}