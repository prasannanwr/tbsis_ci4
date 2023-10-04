<?php
namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\bridge\Models\bridge_beneficiaries_model;
use App\Modules\cost_components\Models\CostComponentsModel;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\province\Models\ProvinceModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\view\Models\view_regional_office_model;
use App\Modules\User\Models\UserModel;

//use App\Modules\Reports\Models\ReportsModel;

class Gen_Dag_UnderConst_FYWise_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;
  
    private $view_bridge_detail_model;

    private $cost_components_model;

    private $province_model;

    private $view_regional_office_model;

    private $bridge_beneficiaries_model;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_bridge_detail_model = new view_bridge_detail_model();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $cost_components_model = new CostComponentsModel();
      $province_model = new ProvinceModel();
      $view_regional_office_model = new view_regional_office_model();
      $bridge_beneficiaries_model  = new bridge_beneficiaries_model();
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_bridge_detail_model = $view_bridge_detail_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
      $this->cost_components_model = $cost_components_model;
      $this->province_model = $province_model;
      $this->view_regional_office_model = $view_regional_office_model;
      $this->bridge_beneficiaries_model = $bridge_beneficiaries_model;
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
        
        $selProvince = @$this->request->getVar('selProvince');       
        $data['selProvince'] = $selProvince;
        $data['blnMM'] = $stat;
        $data['title'] = "DAGS FYWise Report";

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

                //
                if($selProvince != '' && strtolower($selProvince) != "all") {                             
                    $this->view_district_reg_office_model->where('province_id',$selProvince);
                }

                //get user assigned disticts
                $userModel = new UserModel();
                $arrPermittedDistList = $userModel->getArrPermitedDistList();
                $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;
                if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
                  //comma seperated value
                  if (count($arrPermittedDistList) > 0) {
                    $selDist = $this->view_district_reg_office_model->whereIn('dist01id', $arrPermittedDistList)->paginate($perPage);
                  }
                } else {
                  $selDist = $this->view_district_reg_office_model->paginate($perPage);
                }

                // if($selProvince != '' && strtolower($selProvince) != "all") {                             
                //     $selDist=$this->view_district_reg_office_model->where('province_id',$selProvince)->paginate($perPage);
                // } else {
                //     $selDist=$this->view_district_reg_office_model->paginate($perPage);
                // }

                $data['selDist'] = $selDist;
                $data['pager'] = $this->view_district_reg_office_model->pager;
                
                if(is_array( $selDist)){
                    $i =0;
                    foreach( $selDist as $k=>$v){
                        $rr=$v['dist01id'];
                        // var_dump($v1);exit;
                        $arrChild1=null;
                        
                        $arrBridgeList = $this->bridge_beneficiaries_model->getBeneficiaries($dataStart, $dateEnd, $rr, $type=0);
                        //$arrBridgeList = $this->bridge_beneficiaries_model->getDAG($dataStart, $dateEnd, $rr);
                        
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
                /*
                $page = (@$_GET['page']) ? $_GET['page'] : 1;
                $arrBridgeList = $this->bridge_beneficiaries_model->getBeneficiaries($dataStart, $dateEnd, $arrPermittedDistList, $perPage, $page);
                
                //$arrBridgeList = $this->bridge_beneficiaries_model->getDAG($dataStart, $dateEnd, $rr);
                //echo "<pre>";var_dump($arrBridgeList);exit;
                if(is_array($arrBridgeList) && !empty($arrBridgeList)){
                    $row['data'] = $arrBridgeList['bridges'];
                    $arrPrintList[] = $row;
                    //$i++;
                    $data['pager'] = $arrBridgeList['links'];
                }
  //echo "<pre>";var_dump($arrPrintList);exit;
                //$data = ['pager' => $bridge_beneficiaries_model->pager];
                    
                // echo "<pre>";
                // print_r($arrPrintList);exit;*/
                $data['arrPrintList'] = $arrPrintList;
                $data['dataStart'] = $dataStart;
                $data['dateEnd'] = $dateEnd;
                

                
            } else
            {
                redirect("reports/Gen_Dag_FYWise/".$stat);
                //return redirect()->to(base_url('reports/Beneficiaries_FYWise_report/'));  
            }
            
        } else
        {
            'start date is Smaller than End Date';
        }
        // echo "<pre>";
        // var_dump($data['arrPrintList']);exit;
        return view('\Modules\Reports\Views\Gen_Dag_FYWise_report', $data);

    }
}
       
	   
        ?>