<?php
namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\bridge\Models\bridge_uc_formation_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\province\Models\ProvinceModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\view\Models\view_regional_office_model;
use App\Modules\User\Models\UserModel;
//use App\Modules\Reports\Models\ReportsModel;

class UC_Executive_Position_FYWise_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $province_model;

    private $view_regional_office_model;

    private $bridge_uc_formation_model;

    private $view_district_reg_office_model;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_regional_office_model = new view_regional_office_model();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $bridge_uc_formation_model = new bridge_uc_formation_model();
      $province_model = new ProvinceModel();
      
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_regional_office_model = $view_regional_office_model;
      $this->province_model = $province_model;
      $this->bridge_uc_formation_model = $bridge_uc_formation_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
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
            $dataStart = @$this->request->getVar('start_year');
            $dateEnd = @$this->request->getVar('end_year');
        } 
          
            $data['blnMM'] = $stat;
            $data['title'] = "UC Executive Position FYWise report";
            $selProvince = @$this->request->getVar('selProvince');       
            $data['selProvince'] = $selProvince;
            //echo $dataStart;exit;
        
            $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dataStart)->first();
            $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
            $data['provinceList'] = $this->province_model->asObject()->findAll();
            if ($Postback == 'Back')
            {
                redirect(site_url());
            } elseif ($dataStart <= $dateEnd)
            {
                if ($dataStart != 0 || $dateEnd != 0)
                {
                    $arrPrintList = array();
                    $perPage = ITEMS_PER_PAGE;
                    //pager
                    // $pager=service('pager');
                    // $page=(int)(($this->request->getVar('page')!==null)?$this->request->getVar('page'):1)-1;
                    // $total = $this->view_district_reg_office_model->countAll();
                    // $pager->makeLinks($page+1, $perPage, $total);
                    // $offset = $page * $perPage;
                    //$selDist=$this->view_district_reg_office_model->findAll($perPage, $offset);
                    if($selProvince != '' && strtolower($selProvince) != "all") {                             
                        $selDist=$this->view_district_reg_office_model->where('province_id',$selProvince)->paginate($perPage);
                    } else {
                        $selDist=$this->view_district_reg_office_model->paginate($perPage);
                    } 
                    $data['selDist'] = $selDist;
                    $data['pager'] = $this->view_district_reg_office_model->pager;
                    
                    if(is_array( $selDist)){
                        $i =0;
                        foreach( $selDist as $k=>$v){
                            $rr=$v['dist01id'];
                            // var_dump($v1);exit;
                            $arrChild1=null;
                            
                            $arrBridgeList = $this->bridge_uc_formation_model->getUCExecutivePosition($dataStart, $dateEnd, $rr);
                            
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

                    //$data = ['pager' => $bridge_beneficiaries_model->pager];
                        
                    // echo "<pre>";
                    // print_r($arrPrintList);exit;
                    $data['arrPrintList'] = $arrPrintList;
                    $data['dataStart'] = $dataStart;
                    $data['dateEnd'] = $dateEnd;
                    

                    
                } else
                {
                    redirect("reports/UC_Executive_Position_FYWise/".$stat);
                    //return redirect()->to(base_url('reports/Beneficiaries_FYWise_report/'));  
                }
                
            } else
            {
                'start date is Smaller than End Date';
            }
            // echo "<pre>";
            // var_dump($data['arrPrintList']);exit;
            return view('\Modules\Reports\Views\UC_Executive_Position_FYWise_report', $data);

    }
}
       
	   
        ?>