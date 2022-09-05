<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\logo_upload\Models\logo_upload_model;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;

//use App\Modules\Reports\Models\ReportsModel;

class Gen_Overall_FYWise_report extends BaseController
{

    private static $arrDefData = array();

    private $fiscal_year_model;
  
    private $view_bridge_detail_model;
  
    private $view_district_reg_office_model;
  
    private $template;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_bridge_detail_model = new view_bridge_detail_model();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_bridge_detail_model = $view_bridge_detail_model;
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
      $Postback = @$this->request->getVar('submit');
      $dataStart = @$this->request->getVar('start_year');
      $dateEnd = @$this->request->getVar('end_year');
      $data['blnMM'] = $stat;
      // $this->load->model('fiscal_year/fiscal_year_model');
      // $this->load->model('view/view_brigde_detail_model');
      // $this->load->model('view/view_district_reg_office_model');
      // $this->load->model('view/view_brigde_detail_model');
      $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
      $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
      if ($Postback == 'Back') {
        return redirect()->to(base_url('dashboard'));
      } elseif ($dataStart <= $dateEnd) {
      
        if ($dataStart != 0 || $dateEnd != 0) {
          $selDist = $this->view_district_reg_office_model->findAll(10);
          $data['selDist'] = $selDist;
          $arrPrintList = array();
          if (is_array($selDist)) {
      
            // foreach ($selDist as $k => $v) {
            foreach ($selDist as $v) {
              //   echo "<pre>";
              // var_dump($distinfo['dist01id']);exit;
              $rr = $v['dist01id'];
      
      
              if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                  'bri03construction_type',
                  ENUM_NEW_CONSTRUCTION
                );
              } else {
                $this->view_bridge_detail_model->where(
                  'bri03construction_type',
                  ENUM_MAJOR_MAINTENANCE
                );
              }
              // $data['sel_district_filter'] = '';
              // $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd);
              // $this->view_bridge_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
      
              // if ($this->request->getVar("selFilterByDistrict") != '') {
              //   $distFilter = $this->request->getVar("selFilterByDistrict");
              //   $this->view_bridge_detail_model->where('dist01id', $distFilter);
              //   $data['sel_district_filter'] = $distFilter;
              // }
      
              // $dist = $this->view_bridge_detail_model->where('dist01id', $rr)->findAll(10);
      
      
              // if (is_array($dist) && !empty($dist)) {
              //   //print header
              //   //echo 'header';
              //   $row['dist'] = $v;
              //   $row['data'] = $dist;
              //   $arrPrintList[] = $row;
              // }
            }
          }
          // $data['arrPrintList'] = $arrPrintList;
          $data['arrPrintList'] = array();
          return view('\Modules\Reports\Views\Gen_Overall_FYWise_report', $data);
        } else {
      die("redirect");
          //redirect("reports/Gen_Overall_FYWise/" . $stat);
          return redirect()->to(base_url('reports/Gen_Overall_FYWise/'));
        }
      } else {
        $session = session();
        $session->setFlashdata('message', 'Start date is smaller than End date');
      }
             
    }
}