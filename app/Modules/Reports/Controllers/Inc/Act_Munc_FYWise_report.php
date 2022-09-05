<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\view\Models\view_bridge_actual_cost;
use App\Modules\view\Models\view_brigde_detail_model;
use App\Modules\view\Models\view_vdc_model;

//use App\Modules\Reports\Models\ReportsModel;

class Act_Munc_FYWise_report extends BaseController
{
  private static $arrDefData = array();

  private $fiscal_year_model;

  private $view_vdc_model;

  private $view_brigde_detail_model;

  private $view_bridge_actual_cost;

  public function __construct()
  {
    helper(['form', 'html', 'et_helper']);
    $fiscal_year_model = new FiscalYearModel();
    $view_vdc_model  = new view_vdc_model();
    $view_brigde_detail_model= new view_brigde_detail_model();
    $view_bridge_actual_cost = new view_bridge_actual_cost();
    $this->fiscal_year_model = $fiscal_year_model;
    $this->view_vdc_model = $view_vdc_model;
    $this->view_brigde_detail_model = $view_brigde_detail_model;
    $this->view_bridge_actual_cost = $view_bridge_actual_cost;
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
    $Postback = @$this->request->getVar('submit');
    $dataStart = @$this->request->getVar('start_year');
    $dateEnd = @$this->request->getVar('end_year');
    $data['blnMM'] = $stat;
    //$data['title'] = "Overall";
        $bri03municipality = @$this->request->getVar('bri03municipality');
            
        $data['vdcInfo'] = $this->view_vdc_model->where('muni01id',$bri03municipality)->asObject()->first();
		
    
      $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();
        if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
                $data['arrCostCompList'] = $this->cost_components_model->asObject()->findAll();
                $arrDistList = $this->view_regional_office_model->asObject()->findAll();
                $arrSupList = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                 if (empty($stat))
                        {
                            $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_NEW_CONSTRUCTION);
                        } else
                        {
                            $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_MAJOR_MAINTENANCE);
                        }
                /*$data['arrDevList']= $this->view_brigde_detail_model->
                        where('bri03project_fiscal_year >=',$dataStart)->
                       where('bri03project_fiscal_year <=', $dateEnd)->findAll();*/
					   
				$data['arrDevList']= $this->view_brigde_detail_model->
                        where('bri03project_fiscal_year >=',$dataStart)->
                       where('bri03project_fiscal_year <=', $dateEnd)->where('bri05bridge_complete_check', 1)->asObject()->findAll();
                                
                
                if (is_array($arrDistList)){
                     foreach ($arrDistList as $k => $v){
                        $data['arrDistrictList']['dist_'.$v->dist01id] = $v;
                     }
                }

                    //print_r($data['arrDevList']);exit;
               
                    $arrBridgeIdList=null;
                    if (is_array($data['arrDevList'])){
                        foreach ($data['arrDevList'] as $k => $v){
                            $arrChild2=null;
                            
						$bri03bridge_no = trim($v->bri03bridge_no);
						$bridgeToalCostAmount = $this->contribution_agencies_model->getSum($bri03bridge_no);
						
						
						if($bridgeToalCostAmount->totalAmt > 0) {
						
                            $arrBridgeIdList[]=$v->bri03bridge_no;
                            $arrPrintList['dist_'.$v->dist01id][] = array('info'=>$v);
						}	
							
                        }
						//print_r($arrPrintList);
                    }
                    
                    $arrBridgeCostList = $this->view_bridge_actual_cost->
                        whereIn('bri08bridge_no', $arrBridgeIdList)->
                        asObject()->
                        findAll();
                    foreach ($arrBridgeCostList as $x2)
                    {
                    
                    $arrChild2['bri_'.$x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                    }
                    
                    //$arrChild = array('info' => $v);//, 'arrChildList' => $arrChild2);
                    $data['arrCostList'] = $arrChild2;
               
             // print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
                
            } else
            {
                redirect("reports/Act_Munc_FYWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
        
    return view('\Modules\Reports\Views\Act_Munc_FYWise_report', $data);
  }
}