<?php
namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\bridge\Models\bridge_model;
use App\Modules\province\Models\ProvinceModel;
use App\Modules\User\Models\UserModel;

class Access_Utility_Completed_DateWise_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $view_district_reg_office_model;

    private $bridge_model;

    private $province_model;

    private $user_model;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $bridge_model = new bridge_model();
      $province_model = new ProvinceModel();
      $user_model = new UserModel();
      
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
      $this->bridge_model = $bridge_model;
      $this->province_model = $province_model;
      $this->user_model = $user_model;
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
    
        $dateStart = "";
        $dateEnd = "";
        if(isset($searchData) && isset($searchData['dateStart'])){
           $dateStart = $searchData['dateStart'];
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

        $permittedDist = '';
        if (session()->get('user_rights') != 1) {
          $permittedDistArr = $this->user_model->getArrPermitedDistList();
          $permittedDist = implode(',', $permittedDistArr);
          //var_dump($permittedDist);exit;
        }
var_dump($selProvince);exit;
        if($selProvince != '' && strtolower($selProvince) != "all") {                          
          $selDist=$this->view_district_reg_office_model->where('province_id',$selProvince);
        } else {
          $selDist=$this->view_district_reg_office_model;
        } 
        if($permittedDist != ''){
          $selDist = $selDist->whereIn('dist01id',$permittedDistArr);
        }
        $selDist = $selDist->paginate($perPage);

        $data['startdate'] = $dateStart;
        $data['enddate'] = $dateEnd;
       
        if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dateStart <= $dateEnd)
        {
            if ($dateStart != 0 || $dateEnd != 0)
            {
                $data['selDist'] = $selDist;
                $data['pager'] = $this->view_district_reg_office_model->pager;
                $data['provinceList'] = $this->province_model->asObject()->findAll();

                $currentPage = $data['pager']->getCurrentPage();
                $pageCount = $data['pager']->getPageCount();
                if($currentPage == $pageCount) { //last page
                  $data['getUtilities'] = $this->bridge_model->getUtilities();
                  //convert date to fy
                  $startDate = explode("-",$dateStart);
                  $endDate = explode("-",$dateEnd);

                  $startYear = $startDate[0];
                  $startMonth = $startDate[1];
                  $startDay = $startDate[2];
                  $endYear = $endDate[0];
                  $endMonth = $endDate[1];
                  $endDay = $endDate[2];
                  // $fstartfy = $startfy . "-07-16";
                  // $fendfy = $endfy . "-07-15";
                  if($startMonth <= 7) {
                      $startYear = $startYear;
                  } else {
                      $startYear = $startYear + 1;
                  }
                  if($endMonth <= 7) {
                      $endYear = $endYear;
                  } else {
                      $endYear = $endYear + 1;
                  }

                  //var_dump($endYear);exit;
                  //get fiscal year id
                  $sfiscalYear = $startYear.($startYear+1);
                  $efiscalYear = $endYear.($endYear+1);
                  // echo $sfiscalYear;
                  // echo "<br>";
                  // echo $efiscalYear;
                  // exit;
                  //$fiscalYearModel = new FiscalYearModel();
                  $fiscalStartYear = $this->fiscal_year_model->where('fis01year',$sfiscalYear)->first();
                  $fiscalEndYear = $this->fiscal_year_model->where('fis01year',$efiscalYear)->first();
                  //echo "<pre>";var_dump($fiscalEndYear);exit;
                  if($fiscalStartYear) {
                      $startDate = $fiscalStartYear['fis01id'];
                  } else {
                      $startDate = 33;
                  }    
                  if($fiscalEndYear) {
                      $endDate = $fiscalEndYear['fis01id'];    
                  } else {
                      $endDate = $startDate;
                  }
                  
                  $totalBridge  = $this->bridge_model->getTotalBridgeUtilities($startDate, $endDate,$permittedDist);
                  $total_bri03portering_distance = 0;
                  $total_bri03road_head = 0;
                  $total_bri03river_type = 0;
                  $total_markets = $total_health = $total_schools = $total_social = $total_household = 0;

                  foreach ($totalBridge as $value) {
                    if(is_numeric($value['bri03portering_distance'])) {
                      $total_bri03portering_distance = $total_bri03portering_distance + $value['bri03portering_distance'];  
                    }
                    if(is_numeric($value['bri03road_head'])) {
                      $total_bri03road_head = $total_bri03road_head + $value['bri03road_head'];
                    }
                    if(is_numeric($value['bri03river_type'])) {
                      $total_bri03river_type = $total_bri03river_type + $value['bri03river_type'];
                    }
                    $bri03utility_left_bank = $value['bri03utility_left_bank'];
                    $bri03utility_right_bank = $value['bri03utility_right_bank'];
                    if($bri03utility_left_bank == 1) //markets
                    $total_markets++;
                    elseif($bri03utility_left_bank == 2) //health posts
                    $total_health++;
                    elseif($bri03utility_left_bank == 3) //schools
                    $total_schools++;
                    elseif($bri03utility_left_bank == 4) //social functions
                    $total_social++;
                    elseif($bri03utility_left_bank == 5) //household activities
                    $total_household++;

                    if($bri03utility_right_bank == 1) //markets
                    $total_markets++;
                    elseif($bri03utility_right_bank == 2) //health posts
                    $total_health++;
                    elseif($bri03utility_right_bank == 3) //schools
                    $total_schools++;
                    elseif($bri03utility_right_bank == 4) //social functions
                    $total_social++;
                    elseif($bri03utility_right_bank == 5) //household activities
                    $total_household++;
                    
                  }
                  $grand_total_utility = $total_markets + $total_health + $total_schools + $total_social + $total_household;
                  $markets_percent = number_format((($total_markets/$grand_total_utility) * 100),2);
                  $health_percent = number_format((($total_health/$grand_total_utility) * 100),2);
                  $schools_percent = number_format((($total_schools/$grand_total_utility) * 100),2);
                  $social_percent = number_format((($total_social/$grand_total_utility) * 100),2);
                  $household_percent = number_format((($total_household/$grand_total_utility) * 100),2);

                  $data['arrTotals'] = array('total_bri03portering_distance' => $total_bri03portering_distance,
                                            'total_bri03road_head' => $total_bri03road_head,
                                            'total_bri03river_type' => $total_bri03river_type,
                                            'markets_percent' => $markets_percent,
                                            'health_percent' => $health_percent,
                                            'schools_percent' => $schools_percent,
                                            'social_percent' => $social_percent,
                                            'household_percent' => $household_percent);

                  //echo "<pre>";var_dump($data['arrTotals']);exit;
                }
                
                if(is_array( $selDist)){
                    $i = 0;
                    // echo "<pre>";
                    // var_dump($selDist);exit;
                    foreach( $selDist as $k=>$v){
                        $rr=$v['dist01id'];
                        // var_dump($v1);exit;
                        $arrChild1=null;
                        $arrBridgeList = $this->bridge_model->getBridgeUtilitiesByDate($rr, $dateStart, $dateEnd);
                        
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

                return view('\Modules\Reports\Views\Access_Utility_Completed_DateWise_report', $data);
            }
        }
    }
}