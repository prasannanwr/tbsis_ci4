<?php

namespace App\Modules\bridge\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge\Models\bridge_basic_data_model;
use App\Modules\bridge\Models\bridge_beneficiaries_composition_model;
use App\Modules\bridge\Models\bridge_beneficiaries_model;
use App\Modules\bridge\Models\bridge_construction_work_model;
use App\Modules\bridge\Models\bridge_cost_estimate_model;
use App\Modules\bridge\Models\bridge_design_model;
use App\Modules\bridge\Models\bridge_employment_generation_detail_model;
use App\Modules\bridge\Models\bridge_employment_generation_model;
use App\Modules\bridge\Models\bridge_final_inspection_model;
use App\Modules\bridge\Models\bridge_insurance_model;
use App\Modules\bridge\Models\bridge_model;
use App\Modules\bridge\Models\bridge_public_audit_model;
use App\Modules\bridge\Models\bridge_public_hearing_members_model;
use App\Modules\bridge\Models\bridge_public_hearing_model;
use App\Modules\bridge\Models\bridge_sign_board_model;
use App\Modules\bridge\Models\bridge_site_assesment_model;
use App\Modules\bridge\Models\bridge_steel_parts_model;
use App\Modules\bridge\Models\bridge_uc_formation_data_model;
use App\Modules\bridge\Models\bridge_uc_formation_model;
use App\Modules\construction\Models\construction_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\view\Models\view_all_join_bridge_table_model;
use App\Modules\view\Models\view_vdc_model;

//use App\Modules\Reports\Models\ReportsModel;

class bridge extends BaseController
{
	private static $arrDefData = array();

	private $fiscal_year_model;

	private $construction_model;

	private $view_vdc_model;

	private $view_all_join_bridge_table_model;

	private $supporting_agencies_model;

	private $bridge_model;

	private $bridge_basic_data_model;

	private $bridge_beneficiaries_model;

	private $bridge_beneficiaries_composition_model;

	private $bridge_public_hearing_model;

	private $bridge_public_hearing_members_model;

	private $bridge_uc_formation_model;

	private $bridge_uc_formation_data_model;

	private $bridge_employment_generation_model;

	private $bridge_employment_generation_detail_model;

	private $bridge_site_assesment_model;

	private $bridge_final_inspection_model;

	private $bridge_design_model;

	private $bridge_public_audit_model;

	private $bridge_insurance_model;

	private $bridge_sign_board_model;

	private $bridge_cost_estimate_model;

	private $bridge_steel_parts_model;

	private $bridge_construction_work_model;

	protected $table = 'view_all_join_bridge_table';

	private $db;

	public function __construct()
	{
		helper(['form', 'html', 'et_helper']);
		$this->db = \Config\Database::connect();
		$fiscal_year_model = new FiscalYearModel();
		$construction_model = new construction_model();
		$view_vdc_model = new view_vdc_model();
		$view_all_join_bridge_table_model = new view_all_join_bridge_table_model();
		$supporting_agencies_model = new supporting_agencies_model();
		$bridge_model = new bridge_model();
		$bridge_basic_data_model = new bridge_basic_data_model();
		$bridge_beneficiaries_model = new bridge_beneficiaries_model();
		$bridge_beneficiaries_composition_model = new bridge_beneficiaries_composition_model();
		$bridge_public_hearing_model = new bridge_public_hearing_model();
		$bridge_public_hearing_members_model = new bridge_public_hearing_members_model();
		$bridge_uc_formation_model = new bridge_uc_formation_model();
		$bridge_uc_formation_data_model = new bridge_uc_formation_data_model();
		$bridge_employment_generation_model = new bridge_employment_generation_model();
		$bridge_employment_generation_detail_model = new bridge_employment_generation_detail_model();
		$bridge_site_assesment_model = new bridge_site_assesment_model();
		$bridge_final_inspection_model = new bridge_final_inspection_model();
		$bridge_design_model = new bridge_design_model();
		$bridge_public_audit_model = new bridge_public_audit_model();
		$bridge_insurance_model = new bridge_insurance_model();
		$bridge_sign_board_model = new bridge_sign_board_model();
		$bridge_cost_estimate_model = new bridge_cost_estimate_model();
		$bridge_steel_parts_model = new bridge_steel_parts_model();
		$bridge_construction_work_model = new bridge_construction_work_model();
		$this->fiscal_year_model = $fiscal_year_model;
		$this->construction_model = $construction_model;
		$this->view_vdc_model = $view_vdc_model;
		$this->view_all_join_bridge_table_model = $view_all_join_bridge_table_model;
		$this->supporting_agencies_model = $supporting_agencies_model;
		$this->bridge_model = $bridge_model;
		$this->bridge_basic_data_model = $bridge_basic_data_model;
		$this->bridge_beneficiaries_model = $bridge_beneficiaries_model;
		$this->bridge_beneficiaries_composition_model = $bridge_beneficiaries_composition_model;
		$this->bridge_public_hearing_model = $bridge_public_hearing_model;
		$this->bridge_public_hearing_members_model = $bridge_public_hearing_members_model; 
		$this->bridge_uc_formation_model = $bridge_uc_formation_model;
		$this->bridge_uc_formation_data_model = $bridge_uc_formation_data_model;
		$this->bridge_employment_generation_model = $bridge_employment_generation_model;
		$this->bridge_employment_generation_detail_model = $bridge_employment_generation_detail_model;
		$this->bridge_site_assesment_model = $bridge_site_assesment_model;
		$this->bridge_final_inspection_model = $bridge_final_inspection_model;
		$this->bridge_design_model = $bridge_design_model;
		$this->bridge_public_audit_model = $bridge_public_audit_model;
		$this->bridge_insurance_model = $bridge_insurance_model;
		$this->bridge_sign_board_model = $bridge_sign_board_model;
		$this->bridge_cost_estimate_model = $bridge_cost_estimate_model;
		$this->bridge_steel_parts_model = $bridge_steel_parts_model;
		$this->bridge_construction_work_model = $bridge_construction_work_model;
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

	function index($type = "")
	{
		//check access
		//_check(array('org_view'), 'general', '', "You don't have permission to view New_bridge.", 'info', 'dashboard');
		$data['view_file'] = __FUNCTION__;
		$data = self::$arrDefData;
		$PostRadio = @$this->request->getVar('sort');
		$data['dataRadio'] = $PostRadio;
		if ($type == "new")
			$data['btype'] = 0;
		elseif ($type == "mm")
			$data['btype'] = 1;
		else
			$data['btype'] = 0;
		$data['arrConstructionTypeList'] = $this->construction_model->findAll();
		// return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR . 'lists', $data);
	}

	function form($emp_id = FALSE)
	{
		/*if($emp_id) {
				var_dump($emp_id);exit;
		}*/
		
		//return redirect()->to('bridge/form2/06 3 0536 18 06 13');
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;

		$data['title'] = 'Add Bridge';
		$data['view_file'] = __FUNCTION__;


		// if (session()->get('user_rights') == 3 || session()->get('user_rights') == 5) {
		if (session()->get('user_rights') == 1) {
			$data['is_admin'] = 1;
		} else {
			$data['is_admin'] = 0;
		}

		$data['objOldRec'] = '';
		$data['objbasicRec'] = '';
		$data['objImplementationRec'] = '';
		$data['objPublicHearingRec'] = '';
		$data['objUCCompositionRec'] = '';
		$data['objEmploymentGeneration'] = '';
		$data['objBeneficiariesRec'] = '';
		$data['objSiteAssesment'] = '';
		$data['objFinalInspection'] = '';
		$data['objBridgeDesign'] = '';
		$data['objCostEstimate'] = '';
		$data['objBridgeInsurance'] = '';
		$data['objBridgeSignBoard'] = '';
		$data['objBridgeSteelParts'] = '';
		$data['objPublicAudit'] = '';
		$data['objBridgeConstructionWork'] = '';

		$data['postURL'] = "bridge/form";
		

		//added by prasannanwr@gmail.com
		//under revision
		$data['constypeArr'] = $this->construction_model->findAll();

		$data['countLocal'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_LOCAL)->orderBy('sup01index asc')->findAll();
		$data['countGovt'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_GOVERMENT)->orderBy('sup01index asc')->findAll();
		$data['countOther'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_OTHER)->orderBy('sup01index asc')->findAll();
		
		$casteGroup = array("1" => "Dalit", "2" => "Janjati", "3" => "Minorities", "4" => "BCT");
		$bctcasteGroup = array("1" => "Dalit", "2" => "Janjati", "3" => "Minorities", "4" => "BCT_M", "5" => "BCT_F");
		$data['casteGroup'] = $casteGroup;
		$data['bctcasteGroup'] = $bctcasteGroup;
		// $egCasteGroup = array("1" => "Dalit", "2" => "Janjati", "3" => "Minorities", "4" => "BCT (Male)", "5" => "BCT (Female)");
		// $data['egCasteGroup'] = $egCasteGroup;

		if ($emp_id !== false) {
			$emp_id = urldecode($emp_id);
			$data['title'] = 'Edit Bridge';

			$data['objOldRec'] = $this->bridge_basic_data_model->where('bri03bridge_no', $emp_id)->first();
			
			if (empty($data['objOldRec'])) {
				redirect('/bridge');
			}
			
			$data['objSiteAssesment'] = $this->bridge_site_assesment_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objBeneficiariesRec'] = $this->bridge_beneficiaries_model->where('bb_bridge_id', $data['objOldRec']['bri03id'])->first();
			$data['objPublicHearingRec'] = $this->bridge_public_hearing_model->where('ph_bridge_id', $data['objOldRec']['bri03id'])->first();
			$data['objUCCompositionRec'] = $this->bridge_uc_formation_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objBridgeDesign'] = $this->bridge_design_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objCostEstimate'] = $this->bridge_cost_estimate_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objBridgeInsurance'] = $this->bridge_insurance_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objBridgeSignBoard'] = $this->bridge_sign_board_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objBridgeSteelParts'] = $this->bridge_steel_parts_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			
			$data['objFinalInspection'] = $this->bridge_final_inspection_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objPublicAudit'] = $this->bridge_public_audit_model->where('pa_bridge_id', $data['objOldRec']['bri03id'])->first();
			$data['objEmploymentGeneration'] = $this->bridge_employment_generation_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objBridgeConstructionWork'] = $this->bridge_construction_work_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			
			
			
			// $builder = $this->bridge_uc_formation_model->builder();
			// $builder->select('*');
			// $builder->join('bridge_uc_composition_detail', 'bridge_uc_composition_detail.b_uc_id = bridge_uc_composition.b_uc_id');
			// $query = $builder->where('bridge_uc_composition.b_id', $data['objOldRec']['bri03id'])->get();
			// $data['objUCCompositionRec'] = $query->getRow();

			// $builder = $this->bridge_public_hearing_model->builder();
			// $builder->select('*');
			// $builder->join('bridge_public_hearing_members', 'bridge_public_hearing_members.ph_id = bridge_public_hearing.ph_id');
			// $query = $builder->where('ph_bridge_id', $data['objOldRec']['bri03id'])->get();
			// $data['objPublicHearingRec'] = $query->getResult();
			
			//$data['objbasicRec'] = $this->bridge_technical_data_model->where('bri04bridge_no', $emp_id)->first();
			$oldmajor_vdc = $data['objOldRec']['bri03major_vdc'];
			if ($oldmajor_vdc == 1) { //right
				$oldmajor_municipality = $data['objOldRec']['bri03municipality_rb'];
			} else {
				$oldmajor_municipality = $data['objOldRec']['bri03municipality_lb'];
			}
			//echo $oldmajor_municipality;exit;
			$data['postURL'] .= '/' . $emp_id;
			//var_dump( $data['arrEstCost'] );
		}
		//Load Helping data For form
		$data['arrSupList'] = $this->supporting_agencies_model->orderBy('sup01sup_agency_type asc')->orderBy('sup01index asc')->findAll();
		$data['arrVDCList'] = $this->view_vdc_model->orderBy('muni01remark DESC')->orderBy('muni01name ASC')->findAll();

		//if post
		if ($this->request->getMethod() == 'post') {
			// $ph_data = array(
			// 	'ph_bridge_id' => '33',
			// 	'ph_assessment_by' => @$this->request->getVar('ph_assessment_by'),
			// 	'ph_assessment_date' => @$this->request->getVar('ph_assessment_date'),
			// 	'ph_status' => @$this->request->getVar('ph_active'),
			// 	'ph_sum' => @$this->request->getVar('ph-sum'),
			// 	'ph_female' => @$this->request->getVar('ph-female'),
			// 	'ph_male' => @$this->request->getVar('ph-male'),
			// 	'ph_sum_percent' => @$this->request->getVar('total_sum_percent'),
			// 	'ph_female_percent' => @$this->request->getVar('total_female_percent'),
			// 	'ph_male_percent' => @$this->request->getVar('total_male_percent')
			// );
			// $this->bridge_public_hearing_model->save($ph_data);
			// $ph_id = $this->bridge_public_hearing_model->getInsertID();
			// foreach ($casteGroup as $key => $caste) :
			// 	$ph_members_data = array(
			// 		'ph_id' => $ph_id,
			// 		'ph_caste' => $key,
			// 		'ph_total' => @$this->request->getVar("ph_total_".$key),
			// 		'ph_percent' => @$this->request->getVar("total_caste_percent_".$key)
			// 	);
			// 	$this->bridge_public_hearing_members_model->save($ph_members_data);
			// endforeach;
			
			//check if the form is submitted or not bri03project_fiscal_year
			// $rules = [
			// 	'bri03bridge_name' => 'required',
			// 	'bri03place_name' => 'required',
			// 	'bri03district_name_lb' => 'required',
			// 	'bri03district_name_rb' => 'required',
			// 	'bri03river_name' => 'required',
			// 	'bri03supporting_agency' => 'required',
			// 	'bri03work_category' => 'required',
			// 	'bri03project_fiscal_year' => 'required'
			// ];

			$rules = [
	            "bri03bridge_name" => [
	                "label" => "Bridge name", 
	                "rules" => "required"
	            ],
	            "bri03place_name" => [
	                "label" => "Place name", 
	                "rules" => "required"
	            ],
	            "bri03river_name" => [
	                "label" => "River name", 
	                "rules" => "required"
	            ],
	            "bri03district_name_lb" => [
	                "label" => "Left bank district", 
	                "rules" => "required"
	            ],
	            "bri03district_name_rb" => [
	                "label" => "Right bank district", 
	                "rules" => "required"
	            ],
	            "bri03supporting_agency" => [
	                "label" => "Supporing agency", 
	                "rules" => "required"
	            ],
	            "bri03work_category" => [
	                "label" => "Work category", 
	                "rules" => "required"
	            ],
	            "bri03project_fiscal_year" => [
	                "label" => "Project fiscal year", 
	                "rules" => "required"
	            ],

	        ];

			// $errors = [
			// 	'bri03bridge_name' => 'Bridge name is required',
			// 	'bri03place_name' => 'Place name required',
			// 	'bri03district_name_lb' => 'District is required',
			// 	'bri03district_name_rb' => 'District is required',
			// 	'bri03river_name' => 'River name is required',
			// 	'bri03supporting_agency' => 'Agency is required',
			// 	'bri03work_category' => 'Work category is required',
			// 	'bri03project_fiscal_year' => 'Fiscal year is required'
			// ];

		if (!$this->validate($rules)) {
			die('validation failed');
			$data['validation'] = $this->validator;
			return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
		} else {
			//$act = $this->request->getVar('cmdSubmit');
			//log_message('error', $this->request->getVar('cmdSubmit'));
			if ($this->request->getVar('cmdSubmit') == 'Close') {
				redirect('bridge');
			} else {

				if ($this->request->getVar('cmdSubmit') == 'Save' || $this->request->getVar('cmdSubmit') == 'Save and Close') {
					$cmdSubmit = $this->request->getVar('cmdSubmit');
				//	log_message('error', 'inside the save condition');

					//save
					$bridge_no = @$this->request->getVar('bri03bridge_no');
					$bridge_id = @$this->request->getVar('bri03id');
					$bridge_name = @$this->request->getVar('bri03bridge_name');
					$blnIsNew = false;
					// log_message('error', 'bno:'.$bridge_no);
					// log_message('error', 'bid:'.$bridge_id);
					// echo $bridge_no;
					// echo "<br>";
					// echo $bridge_id;exit;
					if (($bridge_no == '' && $bridge_id == '') || ($bridge_no == 0 && $bridge_id == 0)) {
						$blnIsNew = true;
						$bridge_no = '';
						//new case
						//$bridge_no = $this->bridge_model->generate_bridge_code(); //'123456789'; //will be autogenerated as per function
					} else {
						//update case
					}

					$enumMajorVDC = @$this->request->getVar('bri03major_vdc');

					if ($blnIsNew) {
						$mVDC = @$this->request->getVar('bri03municipality_rb');
						if ($enumMajorVDC == MAJOR_LEFT) {
							$mVDC = @$this->request->getVar('bri03municipality_lb');
						}
						$bridge_no = $this->bridge_model->generate_bridge_code($mVDC);
						//echo $bridge_no;exit;
					} else {
						$mVDC = @$this->request->getVar('bri03municipality_rb');
						if ($enumMajorVDC == MAJOR_LEFT) {
							$mVDC = @$this->request->getVar('bri03municipality_lb');
						}
						if ($oldmajor_municipality != $mVDC) {
							$bridge_no = $this->bridge_model->generate_bridge_code($mVDC);
						}
						//echo "old:".$bridge_no;exit;
					}

					/*
                    * check if the bridge is from past fiscal year and not complete 
                    * update work category to carry over 
                    */
					//$this->load->model('fiscal_year/fiscal_year_model');
					$current_fiscal_year = $this->fiscal_year_model->orderBy("fis01id", "DESC")->limit(1, 0)->first();
					/*if(($this->request->getVar('bri03project_fiscal_year') < $current_fiscal_year->fis01id) && $this->request->getVar('bri05bridge_complete_check') != 1) {
                        $bri03work_category = "2"; //carrry over                    
                    } else {
                        $bri03work_category = @$this->request->getVar('bri03work_category');
                    }
					*/
					if (!empty(trim($this->request->getVar('bri03work_category')))) {
						$bri03work_category = @$this->request->getVar('bri03work_category');
					} else {
						$bri03work_category = 1; //new
					}

					/* 
						convert the completed date to completed fiscal year
						assign completion fiscal year according to date
						*/
					$bri05bridge_complete_date = @$this->request->getVar('bri05bridge_complete');
					$completed_year = (int) (date("Y", strtotime($bri05bridge_complete_date)));
					$completed_month = (int) (date("n", strtotime($bri05bridge_complete_date)));
					$completed_day = (int) (date("d", strtotime($bri05bridge_complete_date)));

					$current_year = (int) (date("Y"));
					$current_year = (int) (date("Y"));
					
					if ($completed_year == $current_year) {
						if ($completed_month < 7) {
							$completed_fy = $this->getCorrespondingFY($completed_year - 1);
						} elseif ($completed_month == 7 && $completed_day <= 15) {
							$completed_fy = $this->getCorrespondingFY($completed_year - 1);
						} elseif ($completed_month == 7 && $completed_day > 15) {
							$completed_fy = $this->getCorrespondingFY($completed_year);
						} elseif ($completed_month > 7) {
							$completed_fy = $this->getCorrespondingFY($completed_year);
						}
					} elseif ($completed_year < $current_year) {
						if ($completed_month <= 7) {
							if ($completed_month == 7) {
								if ($completed_month == 7 && $completed_day < 16) {
									$completed_fy = $this->getCorrespondingFY($completed_year - 1);
								} elseif ($completed_month == 7 && $completed_day >= 16) {
									$completed_fy = $this->getCorrespondingFY($completed_year);
								}
							} elseif ($completed_month < 7) {

								$completed_fy = $this->getCorrespondingFY($completed_year - 1);
							}
						} elseif ($completed_month > 7) {

							$completed_fy = $this->getCorrespondingFY($completed_year);
						}
					}

					$completed_fy = $this->fiscal_year_model->where("fis01code", $completed_fy)->first();
					if($completed_fy != NULL)
					$completed_fis01id = $completed_fy['fis01id'];
					else 
					$completed_fis01id = $completed_fy;
					
					if (!empty(trim($this->request->getVar('bri03tbsu_regional_office')))) {
						$bri03tbsu_regional_office = $this->request->getVar('bri03tbsu_regional_office');
					} else {
						$bri03tbsu_regional_office = 0;
					}

					$form_data1 = array(
						'bri03id' => $bridge_id,
						'bri03bridge_name' => @$this->request->getVar('bri03bridge_name'),
						'bri03bridge_no' => $bridge_no,
						'bri03river_name' => @$this->request->getVar('bri03river_name'),
						'bri03place_name' => @$this->request->getVar('bri03place_name'),
						'bri03ward_lb' => @$this->request->getVar('bri03ward_lb'),
						'bri03ward_rb' => @$this->request->getVar('bri03ward_rb'),
						'bri03road_head' => @$this->request->getVar('bri03road_head'),
						'bri03portering_distance' => @$this->request->getVar('bri03portering_distance'),
						'bri03district_distance' => @$this->request->getVar('bri03district_distance'),
						'bri03bridge_type' => @$this->request->getVar('bri03bridge_type'),
						'bri03design' => @$this->request->getVar('bri03design'),
						'bri03ww_width' => @$this->request->getVar('bri03ww_width'),
						'bri03ww_deck_type' => @$this->request->getVar('bri03ww_deck_type'),
						'bri03development_region' => @$this->request->getVar('bri03development_region'),
						'bri03tbsu_regional_office' => $bri03tbsu_regional_office,
						'bri03supporting_agency' => @$this->request->getVar('bri03supporting_agency'),
						'bri03work_category' => $bri03work_category,
						'bri03project_fiscal_year' => @$this->request->getVar('bri03project_fiscal_year'),
						'bri03topo_map_no' => @$this->request->getVar('bri03topo_map_no'),
						'bri03coordinate_north' => @$this->request->getVar('bri03coordinate_north'),
						'bri03coordinate_east' => @$this->request->getVar('bri03coordinate_east'),
						'bri03e_span' => @$this->request->getVar('bri03e_span'),
						'bri03utility_left_bank' => @$this->request->getVar('bri03utility_left_bank'),
						'bri03utility_right_bank' => @$this->request->getVar('bri03utility_right_bank'),
						'bri03physical_progress' => @$this->request->getVar('bri03physical_progress'),
						'bri03river_type' => @$this->request->getVar('bri03river_type')

					);
					
					//if( (int) $bridge_id <= 0 ){
					$dist_left =  @$this->request->getVar('bri03district_name_lb');
					//var_dump( $dist_left );
					if ($dist_left) {
						$form_data1['bri03district_name_lb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03district_name_rb');
					if ($dist_left) {
						$form_data1['bri03district_name_rb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03municipality_lb');
					if ($dist_left) {
						$form_data1['bri03municipality_lb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03municipality_rb');
					if ($dist_left) {
						$form_data1['bri03municipality_rb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03bridge_series');
					if ($dist_left) {
						$form_data1['bri03bridge_series'] = $dist_left;
					}
					$form_data1['bri03major_vdc'] = @$this->request->getVar('bri03major_vdc');
					
					$xx = $this->bridge_basic_data_model->save($form_data1);
					if($bridge_id > 0)
					$bri03id = $bridge_id;
					else 
					$bri03id = $this->bridge_basic_data_model->getInsertID();					

					//site assesment
					$sa_data = array(
						'bsa_id' => @$this->request->getVar("bsa_id"),
						'b_id' => $bri03id,
						'bsa_stability' =>  @$this->request->getVar("bsa_stability"),
						'bsa_stability_def' => @$this->request->getVar("bsa_stability_def"),
						'bsa_stability_remark' =>  @$this->request->getVar("bsa_stability_remark"),
						'bsa_stability_soil_conf' =>  @$this->request->getVar("bsa_stability_soil_conf"),
						'bsa_stability_soil_conf_def' =>  @$this->request->getVar("bsa_stability_soil_conf_def"),
						'bsa_stability_soil_conf_remark' =>  @$this->request->getVar("bsa_stability_soil_conf_remark"),
						'bsa_stability_rock_bed' =>  @$this->request->getVar("bsa_stability_rock_bed"),
						'bsa_stability_rock_bed_def' =>  @$this->request->getVar("bsa_stability_rock_bed_def"),
						'bsa_stability_rock_bed_remark' =>  @$this->request->getVar("bsa_stability_rock_bed_remark"),
						'bsa_stability_rock_wedge' =>  @$this->request->getVar("bsa_stability_rock_wedge"),
						'bsa_stability_rock_wedge_def' =>  @$this->request->getVar("bsa_stability_rock_wedge_def"),
						'bsa_stability_rock_wedge_remark' =>  @$this->request->getVar("bsa_stability_rock_wedge_remark"),
						'bsa_meandering' => @$this->request->getVar("bsa_meandering"),
						'bsa_meandering_def' => @$this->request->getVar("bsa_meandering_def"),
						'bsa_meandering_remark' => @$this->request->getVar("bsa_meandering_remark"),
						'bsa_influencing_rivulet' => @$this->request->getVar("bsa_influencing_rivulet"),
						'bsa_rivulet_def' => @$this->request->getVar("bsa_rivulet_def"),
						'bsa_rivulet_remark' => @$this->request->getVar("bsa_rivulet_remark"),
						'bsa_source_sand' => @$this->request->getVar("bsa_source_sand"),
						'bsa_source_sand_def' => @$this->request->getVar("bsa_source_sand_def"),
						'bsa_source_sand_remark' => @$this->request->getVar("bsa_source_sand_remark"),
						'bsa_source_stone' => @$this->request->getVar("bsa_source_stone"),
						'bsa_source_stone_def' => @$this->request->getVar("bsa_source_stone_def"),
						'bsa_source_stone_remark' => @$this->request->getVar("bsa_source_stone_remark"),
						'bsa_source_gravel' => @$this->request->getVar("bsa_source_gravel"),
						'bsa_source_gravel_def' => @$this->request->getVar("bsa_source_gravel_def"),
						'bsa_source_gravel_remark' => @$this->request->getVar("bsa_source_gravel_remark"),
						'bsa_profile_survey' => @$this->request->getVar("bsa_profile_survey"),
						'bsa_profile_survey_def' => @$this->request->getVar("bsa_profile_survey_def"),
						'bsa_profile_survey_remark' => @$this->request->getVar("bsa_profile_survey_remark"),
						'bsa_assesment_by' => @$this->request->getVar("site_assessment_by"),
						'bsa_assesment_date' => @$this->request->getVar("site_assessment_date"),
						'bsa_remark' => @$this->request->getVar("bsa_remarks")
					);
					//echo "<pre>";var_dump($sa_data);exit;
					$this->bridge_site_assesment_model->save($sa_data);

					// $form_data2 = array(
					// 	'bb_bridge_id' => $bri03id,
					// 	'bb_assessment_by' => @$this->request->getVar('bb_assessment_by'),
					// 	'bb_assessment_date' => @$this->request->getVar('bb_assessment_date'),
					// 	'bb_status' => @$this->request->getVar('rd_active')
					// );
					// $this->bridge_beneficiaries_model->save($form_data2);
					// $bb_id = $this->bridge_beneficiaries_model->getInsertID();
					// foreach ($casteGroup as $key => $caste) :
					// 	$form_data2 = array(
					// 		'bb_id' => $bb_id,
					// 		'bc_caste' => $key,
					// 		'bc_total' => @$this->request->getVar("bc_total_".$key),
					// 		'bc_poor' => @$this->request->getVar("bc_poor_".$key),
					// 		'bc_women' => @$this->request->getVar("bc_women_".$key),
					// 		'bc_men' => @$this->request->getVar("bc_men_".$key),
					// 	);
					// 	$xxx = $this->bridge_beneficiaries_composition_model->save($form_data2);
					// endforeach;

					//beneficiaries composition
					//$bri03id = $bridge_id;
					$form_data2 = array(
						'bb_id' => @$this->request->getVar("bb_id"),
						'bb_bridge_id' => $bri03id,
						'dalit_total' => @$this->request->getVar("bc_total_dalit"),
						'dalit_poor' => @$this->request->getVar("bc_poor_dalit"),
						'dalit_women' => @$this->request->getVar("bc_women_dalit"),
						'dalit_men' => @$this->request->getVar("bc_men_dalit"),

						'janjati_total' => @$this->request->getVar("bc_total_janjati"),
						'janjati_poor' => @$this->request->getVar("bc_poor_janjati"),
						'janjati_women' => @$this->request->getVar("bc_women_janjati"),
						'janjati_men' => @$this->request->getVar("bc_men_janjati"),

						'minorities_total' => @$this->request->getVar("bc_total_minorities"),
						'minorities_poor' => @$this->request->getVar("bc_poor_minorities"),
						'minorities_women' => @$this->request->getVar("bc_women_minorities"),
						'minorities_men' => @$this->request->getVar("bc_men_minorities"),

						'bct_total' => @$this->request->getVar("bc_total_bct"),
						'bct_poor' => @$this->request->getVar("bc_poor_bct"),
						'bct_women' => @$this->request->getVar("bc_women_bct"),
						'bct_men' => @$this->request->getVar("bc_men_bct"),

						'total_household' => @$this->request->getVar("total_no_households"),
						'total_poor' => @$this->request->getVar("total_no_households_poor"),
						'total_women' => @$this->request->getVar("bp_women_total"),
						'total_men' => @$this->request->getVar("bp_men_total"),

						'percent_household' => @$this->request->getVar("percent_no_households"),
						'percent_poor' => @$this->request->getVar("percent_no_households_poor"),
						'percent_women' => @$this->request->getVar("bp_women_percent"),
						'percent_men' => @$this->request->getVar("bp_men_percent"),

						'bb_assessment_by' => @$this->request->getVar('bb_assessment_by'),
						'bb_assessment_date' => @$this->request->getVar('bb_assessment_date'),
						'bb_status' => @$this->request->getVar('bb_status')
					);
					//echo "<pre>";
					//var_dump($form_data2);exit;
					$this->bridge_beneficiaries_model->save($form_data2);
					//exit;
					//public hearing
					// $ph_data = array(
					// 	'ph_bridge_id' => $bri03id,
					// 	'ph_assessment_by' => @$this->request->getVar('ph_assessment_by'),
					// 	'ph_assessment_date' => @$this->request->getVar('ph_assessment_date'),
					// 	'ph_status' => @$this->request->getVar('ph_active'),
					// 	'ph_sum' => @$this->request->getVar('ph-sum'),
					// 	'ph_female' => @$this->request->getVar('ph-female'),
					// 	'ph_male' => @$this->request->getVar('ph-male'),
					// 	'ph_sum_percent' => @$this->request->getVar('total_sum_percent'),
					// 	'ph_female_percent' => @$this->request->getVar('total_female_percent'),
					// 	'ph_male_percent' => @$this->request->getVar('total_male_percent')
					// );
					// $this->bridge_public_hearing_model->save($ph_data);
					// $ph_id = $this->bridge_public_hearing_model->getInsertID();
					// foreach ($casteGroup as $key => $caste) :
					// 	$ph_members_data = array(
					// 		'ph_id' => $ph_id,
					// 		'ph_caste' => $key,
					// 		'ph_total' => @$this->request->getVar("ph_total_".$key),
					// 		'ph_percent' => @$this->request->getVar("total_caste_percent_".$key)
					// 	);
					// 	$this->bridge_public_hearing_members_model->save($ph_members_data);
					// endforeach;

					$ph_data = array(
						'ph_id' => @$this->request->getVar("ph_id"),
						'ph_bridge_id' => $bri03id,
						'ph_assessment_by' => @$this->request->getVar('ph_assessment_by'),
						'ph_assessment_date' => @$this->request->getVar('ph_assessment_date'),
						'ph_status' => @$this->request->getVar('ph_status'),
						'dalit_total' => @$this->request->getVar("ph_total_dalit_total"),
						'dalit_percent' => @$this->request->getVar("total_ph_caste_percent_dalit"),
						'janjati_total' => @$this->request->getVar("ph_total_janjati_total"),
						'janjati_percent' => @$this->request->getVar("total_ph_caste_percent_janjati"),
						'minorities_total' => @$this->request->getVar("ph_total_minorities_total"),
						'minorities_percent' => @$this->request->getVar("total_ph_caste_percent_minorities"),
						'bct_total' => @$this->request->getVar("ph_total_bct_total"),
						'bct_percent' => @$this->request->getVar("total_ph_caste_percent_bct"),
						'ph_sum' => @$this->request->getVar('ph-sum'),
						'ph_female' => @$this->request->getVar('ph-female'),
						'ph_male' => @$this->request->getVar('ph-male'),
						'ph_sum_percent' => @$this->request->getVar('total_sum_percent'),
						'ph_female_percent' => @$this->request->getVar('total_female_percent'),
						'ph_male_percent' => @$this->request->getVar('total_male_percent')
					);
					$this->bridge_public_hearing_model->save($ph_data);


					//uc formation
					// $uc_data = array(
					// 	'b_id' => $bri03id,
					// 	'b_uc_assessment_by' => @$this->request->getVar('uc_assessment_by'),
					// 	'b_uc_assessment_date' => @$this->request->getVar('uc_assessment_date'),
					// 	'b_uc_status' => @$this->request->getVar('uc_active')
					// );
					// $this->bridge_uc_formation_model->save($uc_data);
					// $uc_id = $this->bridge_uc_formation_model->getInsertID();
					// foreach ($casteGroup as $key => $caste) :
					// 	$uc_members_data = array(
					// 		'b_uc_id ' => $uc_id,
					// 		'b_uc_position' => $key,
					// 		'b_uc_caste' => $key,
					// 		'b_uc_female' => @$this->request->getVar("uc-".$key."-female"),
					// 		'b_uc_male' => @$this->request->getVar("uc-".$key."-male")
					// 	);
					// 	$this->bridge_uc_formation_data_model->save($uc_members_data);
					// endforeach;

					$uc_data = array(
						'b_uc_id' => @$this->request->getVar("b_uc_id"),
						'b_id' => $bri03id,
						'b_uc_assessment_by' => @$this->request->getVar('uc_assessment_by'),
						'b_uc_assessment_date' => @$this->request->getVar('uc_assessment_date'),
						'uc_contractor_name' => @$this->request->getVar('uc_contractor_name'),
						'uc_contract_date' => @$this->request->getVar('uc_contract_date'),
						'b_uc_cp_dalit' => @$this->request->getVar('uc_cp_total_dalit'),
						'b_uc_cp_janjati' => @$this->request->getVar('uc_cp_total_janjati'),
						'b_uc_cp_minorities' => @$this->request->getVar('uc_cp_total_minorities'),
						'b_uc_cp_bct' => @$this->request->getVar('uc_cp_total_bct'),
						'b_uc_cp_female' => @$this->request->getVar('uc_cp_female'),
						'b_uc_cp_male' => @$this->request->getVar('uc_cp_male'),
						'b_uc_cp_total' => @$this->request->getVar('uc-cp-sum'), 

						'b_uc_dy_dalit' => @$this->request->getVar('uc_dy_total_dalit'),
						'b_uc_dy_janjati' => @$this->request->getVar('uc_dy_total_janjati'),
						'b_uc_dy_minorities' => @$this->request->getVar('uc_dy_total_minorities'),
						'b_uc_dy_bct' => @$this->request->getVar('uc_dy_total_bct'),
						'b_uc_dy_female' => @$this->request->getVar('uc-dy-female'),
						'b_uc_dy_male' => @$this->request->getVar('uc-dy-male'),
						'b_uc_dy_total' => @$this->request->getVar('uc-dy-sum'), 

						'b_uc_sc_dalit' => @$this->request->getVar('uc_sc_total_dalit'),
						'b_uc_sc_janjati' => @$this->request->getVar('uc_sc_total_janjati'),
						'b_uc_sc_minorities' => @$this->request->getVar('uc_sc_total_minorities'),
						'b_uc_sc_bct' => @$this->request->getVar('uc_sc_total_bct'),
						'b_uc_sc_female' => @$this->request->getVar('uc-sc-female'),
						'b_uc_sc_male' => @$this->request->getVar('uc-sc-male'),
						'b_uc_sc_total' => @$this->request->getVar('uc-sc-sum'), 

						'b_uc_tr_dalit' => @$this->request->getVar('uc_tr_total_dalit'),
						'b_uc_tr_janjati' => @$this->request->getVar('uc_tr_total_janjati'),
						'b_uc_tr_minorities' => @$this->request->getVar('uc_tr_total_minorities'),
						'b_uc_tr_bct' => @$this->request->getVar('uc_tr_total_bct'),
						'b_uc_tr_female' => @$this->request->getVar('uc-tr-female'),
						'b_uc_tr_male' => @$this->request->getVar('uc-tr-male'),
						'b_uc_tr_total' => @$this->request->getVar('uc-tr-sum'), 

						'b_uc_mm_dalit' => @$this->request->getVar('uc_mem_total_dalit'),
						'b_uc_mm_janjati' => @$this->request->getVar('uc_mem_total_janjati'),
						'b_uc_mm_minorities' => @$this->request->getVar('uc_mem_total_minorities'),
						'b_uc_mm_bct' => @$this->request->getVar('uc_mem_total_bct'),
						'b_uc_mm_female' => @$this->request->getVar('uc-mem-female'),
						'b_uc_mm_male' => @$this->request->getVar('uc-mem-male'),
						'b_uc_mm_total' => @$this->request->getVar('uc-mm-sum'),

						'b_uc_status' => @$this->request->getVar('b_uc_status')
					);
					$this->bridge_uc_formation_model->save($uc_data);

					//Design
					$design_data = array(
						'bd_id' => @$this->request->getVar("bd_id"),
						'b_id' => $bri03id,
						'bri_bri_type_check' =>  @$this->request->getVar("bri_bri_type_check"),
						'bri_bri_type_deficiency' =>  @$this->request->getVar("bri_bri_type_deficiency"),
						'bri_bri_type_action' =>  @$this->request->getVar("bri_bri_type_action"),
						'bri_cable_geo_check' =>  @$this->request->getVar("bri_cable_geo_check"),
						'bri_cable_geo_deficiency' =>  @$this->request->getVar("bri_cable_geo_deficiency"),
						'bri_cable_geo_action' =>  @$this->request->getVar("bri_cable_geo_action"),
						'bri_overall_design_check' =>  @$this->request->getVar("bri_overall_design_check"),
						'bri_overall_design_deficiency' =>  @$this->request->getVar("bri_overall_design_deficiency"),
						'bri_overall_design_action' =>  @$this->request->getVar("bri_overall_design_action"),
						'bri_foundation_check' =>  @$this->request->getVar("bri_foundation_check"),
						'bri_foundation_deficiency' =>  @$this->request->getVar("bri_foundation_deficiency"),
						'bri_foundation_action' =>  @$this->request->getVar("bri_foundation_action"),
						'bri_env_con_check' =>  @$this->request->getVar("bri_env_con_check"),
						'bri_env_con_deficiency' =>  @$this->request->getVar("bri_env_con_deficiency"),
						'bri_env_con_action' =>  @$this->request->getVar("bri_env_con_action"),
						'bri_design_opt_check' =>  @$this->request->getVar("bri_design_opt_check"),
						'bri_design_opt_deficiency' =>  @$this->request->getVar("bri_design_opt_deficiency"),
						'bri_design_opt_action' =>  @$this->request->getVar("bri_design_opt_action"),
						'bri_free_board_check' =>  @$this->request->getVar("bri_free_board_check"),
						'bri_free_board_deficiency' =>  @$this->request->getVar("bri_free_board_deficiency"),
						'bri_free_board_action' =>  @$this->request->getVar("bri_free_board_action"),
						'bri_design_status' =>  @$this->request->getVar("design_active"),
						'bri_design_span_check' =>  @$this->request->getVar("bri_design_span_check"),
						'bri_design_span_deficiency' =>  @$this->request->getVar("bri_design_span_deficiency"),
						'bri_design_span_action' =>  @$this->request->getVar("bri_design_span_action"),
						'design_site_assessment_date' =>  @$this->request->getVar("design_site_assessment_date"),
						'design_site_assessment_by' =>  @$this->request->getVar("design_site_assessment_by"),
						'bri_design_remarks' =>  @$this->request->getVar("bri_design_remarks")
					);
					$this->bridge_design_model->save($design_data);

					//Cost Estimate
					$cost_est_data = array(
						'bce_id' => @$this->request->getVar("bce_id"),
						'b_id' => $bri03id,
						'bri_impl_approach_check' =>  @$this->request->getVar("bri_impl_approach_check"),
						'bri_impl_approach_deficiency' =>  @$this->request->getVar("bri_impl_approach_deficiency"),
						'bri_impl_approach_remarks' =>  @$this->request->getVar("bri_impl_approach_remarks"),
						'bri_impl_approach_lstb_check' =>  @$this->request->getVar("bri_impl_approach_lstb_check"),
						'bri_impl_approach_lstb_deficiency' =>  @$this->request->getVar("bri_impl_approach_lstb_deficiency"),
						'bri_impl_approach_lstb_remarks' =>  @$this->request->getVar("bri_impl_approach_lstb_remarks"),
						'bri_unit_rates_steel_check' =>  @$this->request->getVar("bri_unit_rates_steel_check"),
						'bri_unit_rates_steel_deficiency' =>  @$this->request->getVar("bri_unit_rates_steel_deficiency"),
						'bri_unit_rates_steel_remarks' =>  @$this->request->getVar("bri_unit_rates_steel_remarks"),
						'bri_unit_rates_check' =>  @$this->request->getVar("bri_unit_rates_check"),
						'bri_unit_rates_deficiency' =>  @$this->request->getVar("bri_unit_rates_deficiency"),
						'bri_unit_rates_remarks' =>  @$this->request->getVar("bri_unit_rates_remarks"),
						'bri_portering_dis_check' =>  @$this->request->getVar("bri_portering_dis_check"),
						'bri_portering_dis_deficiency' =>  @$this->request->getVar("bri_portering_dis_deficiency"),
						'bri_portering_dis_remarks' =>  @$this->request->getVar("bri_portering_dis_remarks"),
						'bri_pm_linearcost_check' =>  @$this->request->getVar("bri_pm_linearcost_check"),
						'bri_pm_linearcost_deficiency' =>  @$this->request->getVar("bri_pm_linearcost_deficiency"),
						'bri_pm_linearcost_remarks' =>  @$this->request->getVar("bri_pm_linearcost_remarks"),
						'cost_est_site_assessment_by' =>  @$this->request->getVar("cost_est_site_assessment_by"),
						'cost_est_site_assessment_date' =>  @$this->request->getVar("cost_est_site_assessment_date"),
						'cost_est_remarks' =>  @$this->request->getVar("cost_est_remarks"),
						'cost_est_active' =>  @$this->request->getVar("cost_est_active"),

					);
					$this->bridge_cost_estimate_model->save($cost_est_data);

					//Steel Parts

					//employment generation
					// $eg_data = array(
					// 	'b_id' => $bri03id,
					// 	'beg_total_women' => @$this->request->getVar('eg_women_total'),
					// 	'beg_total_men' => @$this->request->getVar('eg_men_total'),
					// 	'beg_total_poor' => @$this->request->getVar('eg_poor'),
					// 	'beg_total' => @$this->request->getVar('eg_grand_total'),
					// 	'beg_percent_women' => @$this->request->getVar('eg_women_percent'),
					// 	'beg_percent_men' => @$this->request->getVar('eg_men_percent'),
					// 	'beg_percent_poor' => @$this->request->getVar('eg_poor_percent'),
					// 	'beg_percent_total' => @$this->request->getVar('eg_grand_percent')
					// );
					// $this->bridge_employment_generation_model->save($eg_data);
					// $eg_id = $this->bridge_employment_generation_model->getInsertID();
					// foreach ($casteGroup as $key => $caste) :
					// 	$eg_data2 = array(
					// 		'beg_id' => $eg_id,
					// 		'begi_caste' => $key,
					// 		'begi_women' => @$this->request->getVar('eg_women_'.$key),
					// 		'begi_men' => @$this->request->getVar('eg_men_'.$key),
					// 		'begi_poor' => @$this->request->getVar('eg_poor_'.$key),
					// 		'begi_total' => @$this->request->getVar('eg_sub_total_'.$key)
					// 	);
					// 	$this->bridge_employment_generation_detail_model->save($eg_data2);
					// endforeach;
					$eg_data = array(
						'beg_id' => @$this->request->getVar("beg_id"),
						'b_id' => $bri03id,
						'beg_dalit_women' => @$this->request->getVar('beg_dalit_women'),
						'beg_dalit_men' => @$this->request->getVar('beg_dalit_men'),
						'beg_dalit_poor' => @$this->request->getVar('beg_dalit_poor'),
						
						'beg_janjati_women' => @$this->request->getVar('beg_janjati_women'),
						'beg_janjati_men' => @$this->request->getVar('beg_janjati_men'),
						'beg_janjati_poor' => @$this->request->getVar('beg_janjati_poor'),

						'beg_minorities_women' => @$this->request->getVar('beg_minorities_women'),
						'beg_minorities_men' => @$this->request->getVar('beg_minorities_men'),
						'beg_minorities_poor' => @$this->request->getVar('beg_minorities_poor'),

						// 'beg_bct_women' => @$this->request->getVar('beg_bct_women'),
						// 'beg_bct_men' => @$this->request->getVar('beg_bct_men'),
						// 'beg_bct_poor' => @$this->request->getVar('beg_bct_poor'),

						'beg_bct_m_men' => @$this->request->getVar('beg_bct_m_men'),
						'beg_bct_f_women' => @$this->request->getVar('beg_bct_f_women'),
						'beg_bct_m_poor' => @$this->request->getVar('beg_bct_m_poor'),
						'beg_bct_f_poor' => @$this->request->getVar('beg_bct_f_poor'),

						'beg_total_women' => @$this->request->getVar('eg_women_total'),
						'beg_total_men' => @$this->request->getVar('eg_men_total'),
						'beg_total_poor' => @$this->request->getVar('eg_poor'),
						'beg_total' => @$this->request->getVar('eg_grand_total'),
						'beg_percent_women' => @$this->request->getVar('eg_women_percent'),
						'beg_percent_men' => @$this->request->getVar('eg_men_percent'),
						'beg_percent_poor' => @$this->request->getVar('eg_poor_percent'),
						'beg_percent_total' => @$this->request->getVar('eg_grand_percent')
					);
					
					$this->bridge_employment_generation_model->save($eg_data);

					$pa_data = array(
						'pa_id' => @$this->request->getVar("pa_id"),
						'pa_bridge_id' => $bri03id,
						'pa_assessment_by' => @$this->request->getVar('pa_assessment_by'),
						'pa_assessment_date' => @$this->request->getVar('pa_assessment_date'),
						'pa_status' => @$this->request->getVar('pa_status'),
						'dalit_total' => @$this->request->getVar('pa_dalit_total'),
						'dalit_percent' => @$this->request->getVar('total_pa_caste_percent_dalit'),
						'janjati_total' => @$this->request->getVar('pa_janjati_total'),
						'janjati_percent' => @$this->request->getVar('total_pa_caste_percent_janjati'),
						'minorities_total' => @$this->request->getVar('pa_minorities_total'),
						'minorities_percent' => @$this->request->getVar('total_pa_caste_percent_minorities'),
						'bct_total' => @$this->request->getVar('pa_bct_total'),
						'bct_percent' => @$this->request->getVar('total_pa_caste_percent_bct'),
						'pa_sum' => @$this->request->getVar('pa-sum'),
						'pa_female' => @$this->request->getVar('pa-female'),
						'pa_male' => @$this->request->getVar('pa-male'),
						'pa_sum_percent' => @$this->request->getVar('total_sum_percent_pa'),
						'pa_female_percent' => @$this->request->getVar('total_female_percent_pa'),
						'pa_male_percent' => @$this->request->getVar('total_male_percent_pa'),
					);
					$this->bridge_public_audit_model->save($pa_data);

					//final inspection
					$fi_data = array(
						'bri_f_id' => @$this->request->getVar("bri_f_id"),
						'b_id' => $bri03id,
						'bri_cable_check' =>  @$this->request->getVar("bri_cable_check"),
						'bri_cable_def' =>  @$this->request->getVar("bri_cable_def"),
						'bri_cable_action' =>  @$this->request->getVar("bri_cable_action"),
						'bri_bulldog_spec_check' => @$this->request->getVar("bri_bulldog_spec_check"),
						'bri_bulldog_spec_def' =>  @$this->request->getVar("bri_bulldog_spec_def"),
						'bri_bulldog_action' =>  @$this->request->getVar("bri_bulldog_action"),
						'bri_bulldog_missing_check' =>  @$this->request->getVar("bri_bulldog_missing_check"),
						'bri_bulldog_missing_def' =>  @$this->request->getVar("bri_bulldog_missing_def"),
						'bri_bulldog_missing_action' =>  @$this->request->getVar("bri_bulldog_missing_action"),
						'bri_bulldog_retight_check' =>  @$this->request->getVar("bri_bulldog_retight_check"),
						'bri_bulldog_retight_def' =>  @$this->request->getVar("bri_bulldog_retight_def"),
						'bri_bulldog_retight_action' =>  @$this->request->getVar("bri_bulldog_retight_action"),
						'bri_anchorage_check' => @$this->request->getVar("bri_anchorage_check"),
						'bri_anchorage_def' =>  @$this->request->getVar("bri_anchorage_def"),
						'bri_anchorage_action' =>  @$this->request->getVar("bri_anchorage_action"),
						'bri_walkway_check' => @$this->request->getVar("bri_walkway_check"),
						'bri_walkway_def' =>  @$this->request->getVar("bri_walkway_def"),
						'bri_walkway_action' =>  @$this->request->getVar("bri_walkway_action"),
						'bri_wire_check' => @$this->request->getVar("bri_wire_check"),
						'bri_wire_def' =>  @$this->request->getVar("bri_wire_def"),
						'bri_wire_action' =>  @$this->request->getVar("bri_wire_action"),
						'bri_fixtures_check' => @$this->request->getVar("bri_fixtures_check"),
						'bri_fixtures_def' =>  @$this->request->getVar("bri_fixtures_def"),
						'bri_fixtures_action' =>  @$this->request->getVar("bri_fixtures_action"),
						'bri_fixtures_hot_check' => @$this->request->getVar("bri_fixtures_hot_check"),
						'bri_fixtures_hot_def' =>  @$this->request->getVar("bri_fixtures_hot_def"),
						'bri_fixtures_hot_action' =>  @$this->request->getVar("bri_fixtures_hot_action"),
						'bri_relative_check' => @$this->request->getVar("bri_relative_check"),
						'bri_relative_def' =>  @$this->request->getVar("bri_relative_def"),
						'bri_relative_action' =>  @$this->request->getVar("bri_relative_action"),
						'bri_anchorage_dimension_check' => @$this->request->getVar("bri_anchorage_dimension_check"),
						'bri_anchorage_dimension_def' =>  @$this->request->getVar("bri_anchorage_dimension_def"),
						'bri_anchorage_dimension_action' =>  @$this->request->getVar("bri_anchorage_dimension_action"),
						'bri_anchorage_stone_check' => @$this->request->getVar("bri_anchorage_stone_check"),
						'bri_anchorage_stone_def' =>  @$this->request->getVar("bri_anchorage_stone_def"),
						'bri_anchorage_stone_action' =>  @$this->request->getVar("bri_anchorage_stone_action"),
						'bri_suspenders_check' => @$this->request->getVar("bri_suspenders_check"),
						'bri_suspenders_def' =>  @$this->request->getVar("bri_suspenders_def"),
						'bri_suspenders_action' =>  @$this->request->getVar("bri_suspenders_action"),
						'bri_wire_mesh_uniform_check' => @$this->request->getVar("bri_wire_mesh_uniform_check"),
						'bri_wire_mesh_uniform_def' =>  @$this->request->getVar("bri_wire_mesh_uniform_def"),
						'bri_wire_mesh_uniform_action' =>  @$this->request->getVar("bri_wire_mesh_uniform_action"),
						'bri_tower_vertical_check' =>  @$this->request->getVar("bri_tower_vertical_check"),
						'bri_tower_vertical_def' =>  @$this->request->getVar("bri_tower_vertical_def"),
						'bri_tower_vertical_action' =>  @$this->request->getVar("bri_tower_vertical_action"),
						'bri_we_check' =>  @$this->request->getVar("bri_we_check"),
						'bri_we_def' =>  @$this->request->getVar("bri_we_def"),
						'bri_we_action' =>  @$this->request->getVar("bri_we_action"),

						'bri_we_angles_check' =>  @$this->request->getVar("bri_we_angles_check"),
						'bri_we_angles_def' =>  @$this->request->getVar("bri_we_angles_def"),
						'bri_we_angles_action' =>  @$this->request->getVar("bri_we_angles_action"),

						'bri_windties_check' =>  @$this->request->getVar("bri_windties_check"),
						'bri_windties_def' =>  @$this->request->getVar("bri_windties_def"),
						'bri_windties_action' =>  @$this->request->getVar("bri_windties_action"),
						'bridge_completion_date' => @$this->request->getVar("bridge_completion_date"),
						'fi_site_assessment_by' => @$this->request->getVar("fi_site_assessment_by"),
						'fi_site_assessment_date' => @$this->request->getVar("fi_site_assessment_date"),
						'bri_completion_fiscal_year' => @$this->request->getVar("bri_completion_fiscal_year"),
						'bri_remarks' => @$this->request->getVar("bri_remarks")
					);
					//echo "<pre>";var_dump($sa_data);exit;
					$this->bridge_final_inspection_model->save($fi_data);

					//insurance
					$bi_data = array(
						'bi_id' => @$this->request->getVar("bi_id"),
						'b_id' => $bri03id,
						'bri_insurance_check' =>  @$this->request->getVar("bri_insurance_check"),
						'insurance_exp_date' => @$this->request->getVar("insurance_exp_date")
					);
					//echo "<pre>";var_dump($sa_data);exit;
					$this->bridge_insurance_model->save($bi_data);

					//sign board
					$sb_data = array(
						'bsb_id' => @$this->request->getVar("bsb_id"),
						'b_id' => $bri03id,
						'sign_board_check' =>  @$this->request->getVar("sign_board_check"),
						'sign_board_date' => @$this->request->getVar("sign_board_date")
					);
					$this->bridge_sign_board_model->save($sb_data);

					//steel parts
					$sp_data = array(
						'bsp_id' => @$this->request->getVar("bsp_id"),
						'b_id' => $bri03id,
						'bri_quality_steel_check' =>  @$this->request->getVar("bri_quality_steel_check"),
						'bri_quality_steel_def' =>  @$this->request->getVar("bri_quality_steel_def"),
						'bri_quality_steel_action' =>  @$this->request->getVar("bri_quality_steel_action"),
						'bri_qa_document_check' =>  @$this->request->getVar("bri_qa_document_check"),
						'bri_qa_document_def' =>  @$this->request->getVar("bri_qa_document_def"),
						'bri_qa_document_action' =>  @$this->request->getVar("bri_qa_document_action"),
						'bri_welding_check' =>  @$this->request->getVar("bri_welding_check"),
						'bri_welding_def' =>  @$this->request->getVar("bri_welding_def"),
						'bri_welding_action' =>  @$this->request->getVar("bri_welding_action"),
						'bri_zinc_coating_check' =>  @$this->request->getVar("bri_zinc_coating_check"),
						'bri_zinc_coating_def' =>  @$this->request->getVar("bri_zinc_coating_def"),
						'bri_zinc_coating_action' =>  @$this->request->getVar("bri_zinc_coating_action"),
						'bri_assembled_fitting_check' =>  @$this->request->getVar("bri_assembled_fitting_check"),
						'bri_assembled_fitting_def' =>  @$this->request->getVar("bri_assembled_fitting_def"),
						'bri_assembled_fitting_action' =>  @$this->request->getVar("bri_assembled_fitting_action"),
						'bri_wire_mesh_check' =>  @$this->request->getVar("bri_wire_mesh_check"),
						'bri_wire_mesh_def' =>  @$this->request->getVar("bri_wire_mesh_def"),
						'bri_wire_mesh_action' =>  @$this->request->getVar("bri_wire_mesh_action"),
						'bri_nuts_bolts_check' =>  @$this->request->getVar("bri_nuts_bolts_check"),
						'bri_nuts_bolts_def' =>  @$this->request->getVar("bri_nuts_bolts_def"),
						'bri_nuts_bolts_action' =>  @$this->request->getVar("bri_nuts_bolts_action"),
						'factory_visit_assessment_by' =>  @$this->request->getVar("factory_visit_assessment_by"),
						'factory_visit_assessment_date' => @$this->request->getVar("factory_visit_assessment_date"),
						'factory_visit_remarks' =>  @$this->request->getVar("factory_visit_remarks"),
						'factory_visit_active' =>  @$this->request->getVar("factory_visit_active"),
						'bsp_updated_date' =>  @$this->request->getVar("bsp_updated_date")
					);
					$this->bridge_steel_parts_model->save($sp_data);

					//construction
					$bcw_data = array(
						'bcw_id' => @$this->request->getVar("bcw_id"),
						'b_id' => $bri03id,
						'bri_quality_stones_check' =>  @$this->request->getVar("bri_quality_stones_check"),
						'bri_quality_stones_def' =>  @$this->request->getVar("bri_quality_stones_def"),
						'bri_quality_stones_remarks' =>  @$this->request->getVar("bri_quality_stones_remarks"),
						'bri_verify_concrete_drum_check' =>  @$this->request->getVar("bri_verify_concrete_drum_check"),
						'bri_verify_concrete_drum_def' =>  @$this->request->getVar("bri_verify_concrete_drum_def"),
						'bri_verify_concrete_drum_remarks' =>  @$this->request->getVar("bri_verify_concrete_drum_remarks"),
						'bri_bulldog_check' =>  @$this->request->getVar("bri_bulldog_check"),
						'bri_bulldog_def' =>  @$this->request->getVar("bri_bulldog_def"),
						'bri_bulldog_remarks' =>  @$this->request->getVar("bri_bulldog_remarks"),
						'bri_workmanship_check' =>  @$this->request->getVar("bri_workmanship_check"),
						'bri_workmanship_def' =>  @$this->request->getVar("bri_workmanship_def"),
						'bri_workmanship_remarks' =>  @$this->request->getVar("bri_workmanship_remarks"),
						'bri_masonry_stone_check' =>  @$this->request->getVar("bri_masonry_stone_check"),
						'bri_masonry_stone_def' =>  @$this->request->getVar("bri_masonry_stone_def"),
						'bri_masonry_stone_remarks' =>  @$this->request->getVar("bri_masonry_stone_remarks"),
						'bri_masonry_monolithic_check' =>  @$this->request->getVar("bri_masonry_monolithic_check"),
						'bri_masonry_monolithic_def' =>  @$this->request->getVar("bri_masonry_monolithic_def"),
						'bri_masonry_monolithic_remarks' =>  @$this->request->getVar("bri_masonry_monolithic_remarks"),
						'bri_verify_concrete_foundation_check' =>  @$this->request->getVar("bri_verify_concrete_foundation_check"),
						'bri_verify_concrete_foundation_def' =>  @$this->request->getVar("bri_verify_concrete_foundation_def"),
						'bri_verify_concrete_foundation_remarks' =>  @$this->request->getVar("bri_verify_concrete_foundation_remarks"),
						'bri_tower_check' =>  @$this->request->getVar("bri_tower_check"),
						'bri_tower_def' =>  @$this->request->getVar("bri_tower_def"),
						'bri_tower_remarks' =>  @$this->request->getVar("bri_tower_remarks"),
						'bri_cement_check' =>  @$this->request->getVar("bri_cement_check"),
						'bri_cement_def' =>  @$this->request->getVar("bri_cement_def"),
						'bri_cement_remarks' =>  @$this->request->getVar("bri_cement_remarks"),
						'bri_dimension_anchorage_check' =>  @$this->request->getVar("bri_dimension_anchorage_check"),
						'bri_dimension_anchorage_def' =>  @$this->request->getVar("bri_dimension_anchorage_def"),
						'bri_dimension_anchorage_remarks' =>  @$this->request->getVar("bri_dimension_anchorage_remarks"),
						'bri_cable_quality_check' =>  @$this->request->getVar("bri_cable_quality_check"),
						'bri_cable_quality_def' =>  @$this->request->getVar("bri_cable_quality_def"),
						'bri_cable_quality_remarks' =>  @$this->request->getVar("bri_cable_quality_remarks"),
						'bri_cable_sag_check' =>  @$this->request->getVar("bri_cable_sag_check"),
						'bri_cable_sag_def' =>  @$this->request->getVar("bri_cable_sag_def"),
						'bri_cable_sag_remarks' =>  @$this->request->getVar("bri_cable_sag_remarks"),
						'bri_verify_concreting_deadman_check' =>  @$this->request->getVar("bri_verify_concreting_deadman_check"),
						'bri_verify_concreting_deadman_def' =>  @$this->request->getVar("bri_verify_concreting_deadman_def"),
						'bri_verify_concreting_deadman_remarks' =>  @$this->request->getVar("bri_verify_concreting_deadman_remarks"),
						'bri_relative_sag_check' =>  @$this->request->getVar("bri_relative_sag_check"),
						'bri_relative_sag_def' =>  @$this->request->getVar("bri_relative_sag_def"),
						'bri_relative_sag_remarks' =>  @$this->request->getVar("bri_relative_sag_remarks"),
						'bri_painting_works_check' =>  @$this->request->getVar("bri_painting_works_check"),
						'bri_painting_works_def' =>  @$this->request->getVar("bri_painting_works_def"),
						'bri_painting_works_remarks' =>  @$this->request->getVar("bri_painting_works_remarks"),
						'bri_plum_concrete_check' =>  @$this->request->getVar("bri_plum_concrete_check"),
						'bri_plum_concrete_def' =>  @$this->request->getVar("bri_plum_concrete_def"),
						'bri_plum_concrete_remarks' =>  @$this->request->getVar("bri_plum_concrete_remarks"),
						'bri_plum_concrete_gap_check' =>  @$this->request->getVar("bri_plum_concrete_gap_check"),
						'bri_plum_concrete_gap_check_def' =>  @$this->request->getVar("bri_plum_concrete_gap_check_def"),
						'bri_plum_concrete_gap_check_remarks' =>  @$this->request->getVar("bri_plum_concrete_gap_check_remarks"),
						'bcw_assessment_by' => @$this->request->getVar("bcw_assessment_by"),
						'bcw_assessment_date' =>  @$this->request->getVar("bcw_assessment_date"),
						'bcw_remarks' =>  @$this->request->getVar("bcw_remarks"),
						'bcw_active' =>  @$this->request->getVar("bcw_active")
					);
					//var_dump($bcw_data);exit;
					$this->bridge_construction_work_model->save($bcw_data);
					
					// $this->bridge_technical_data_model->save($form_data2);
					session()->setFlashdata('message', 'Updated successfully.');
					if ($cmdSubmit == 'Save and Close') {
						return redirect()->to('bridge/lists/');
					} else {
						return redirect()->to('bridge/form/' . $bridge_no);
					}
				} else {
					//log_message('error', 'no submit');
				}
			}
		}
		}
		//echo "<pre>"; var_dump($data['arrVDCList']);exit;

		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	function view()
	{

		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$GetBridgeNo = @$this->request->getVar('id');
		//var_dump($GetBridgeNo);
		//

		$data['objOldRec'] = $this->view_all_join_bridge_table_model->where('bri03bridge_no', $GetBridgeNo)->first();
		$data['Completion_Fiscal_Year'] = $this->fiscal_year_model->where('fis01id', $data['objOldRec']->bri05bridge_completion_fiscalyear)->first();
		// $data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['objOldRec']->bri03bridge_no)->findAll();
		// $data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['objOldRec']->bri03bridge_no)->findAll();

		// $data['arrSupList'] = $this->supporting_agencies_model->findAll();
		// $data['arrCostCompList'] = $this->cost_components_model->findAll();
		$data['arrVDCList'] = $this->view_vdc_model->findAll();

		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	function delete($delete_id= '')
	{
		if (session()->get('type') == 6) {
			redirect('bridge/lists', 'refresh');
		}
		if (session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_REGIONAL_MANAGER) {

			$arrdeltable = $this->bridge_model->where('bri03bridge_no', $delete_id)->asObject()->first();
			$this->bridge_model->where('bri03id', $arrdeltable->bri03id)->delete();

			session()->setFlashdata('message', 'Selected Data Deleted.');
			return redirect()->to('bridge/lists');
		} else {
			return redirect()->to('bridge/lists');
		}
	}

	function deleteAll()
	{
		exit;
		if (session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_REGIONAL_MANAGER) {

			//$delete_ids = $this->request->getVar('bids');
			$delete_ids = $this->bridge_model->limit(200, 0)->findAll();
			//print_r($delete_ids);exit;
			foreach ($delete_ids as $delete_id) {
				//print_r($delete_id->bri03bridge_no);exit;
				//$arrdeltable = $this->bridge_model->where('bri03id', $delete_id)->first();
				//print_r($arrdeltable->bri03bridge_no);exit;
				$this->bridge_model->where('bri03bridge_no', $delete_id->bri03bridge_no)->delete();
				// $this->bridge_technical_data_model->where('bri04bridge_no', $delete_id->bri03bridge_no)->delete();
				// $this->bridge_beneficiaries_model->where('bri05bridge_no', $delete_id->bri03bridge_no)->delete();
				// $this->personnel_information_model->where('bri06bridge_no', $delete_id->bri03bridge_no)->delete();
				// $this->bridge_est_cost_model->where('bri07bridge_no', $delete_id->bri03bridge_no)->delete();
				// $this->contribution_agencies_model->where('bri08bridge_no', $delete_id->bri03bridge_no)->delete();
			}
			//exit;


			$message = 'Selected Data Deleted.';
			// log_query($message);
			// set_message($message, 'success');


			redirect('bridge');
		} else {
			redirect('bridge');
		}
	}

	function ajaxDataApplyWhere()
	{

		$gtc = @$this->request->getVar('columns');
		//var_dump($gtc);exit;
		if (is_array($gtc)) {
			foreach ($gtc as $k => $v) {
				if ($v['search']['value'] !== '' && $v['search']['value'] !== '0' && $v['search']['value'] != 'All District') {
					$this->view_all_join_bridge_table_model->where($v['data'], $v['search']['value']);
				}
			}
		}

		$search = $this->request->getVar('search');
		if ($search['value'] !== '') {
			$this->view_all_join_bridge_table_model->like('bri03bridge_name', $search['value']);
			$this->view_all_join_bridge_table_model->orLike('bri03bridge_no', $search['value']);
			//$this->view_all_join_bridge_table_model->orLike('dist01name', $search['value']);
		}
	}

	function ajaxDataApplyWhereOptimized()
	{

		$gtc = @$this->request->getVar('columns');
		$sql = '';
		if (is_array($gtc)) {
			foreach ($gtc as $k => $v) {
				$search_value = trim($v['search']['value']);
				//echo "search val: ".$search_value;
				if ( $search_value !== '' && $search_value != '0' && $search_value != 'All District') {
					$sql .=" AND `{$v['data']}` = '{$v['search']['value']}'";
				} 
			}
		}


		$search = $this->request->getVar('search');
		//var_dump($search['value']);exit;
		if ($search['value'] !== '') {
			$sql .= " AND (`bri03bridge_name` LIKE '%{$search['value']}%'";
			$sql .= " OR `bri03bridge_no` LIKE '%{$search['value']}%')";
		}
		
		return $sql;
	}

	function ajaxData()
	{
		//Apply Where condition for Data
		//$this->ajaxDataApplyWhere();
		//Apply Limit for data
		$length = ($this->request->getVar('length') != ''?$this->request->getVar('length'):10);
		$start  = ($this->request->getVar('start') != ''?$this->request->getVar('start'):0);
		$search = $this->request->getVar('search');
		$arrDataList = '';
		$extra_sql = '';

		//for ordering
		//$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type');
		// $arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type', 'bri03work_category');
		$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type', 'bri03work_category');
		$order = $this->request->getVar('order');
		
		//$arrDataList = $this->view_all_join_bridge_table_model->findAll($length, $start);
		//new
		$sql = "select `a`.* FROM `view_all_bridges_list_major_dist` a WHERE 1=1";
		$extra_sql = $this->ajaxDataApplyWhereOptimized();
		$sql .=$extra_sql;
		//echo $sql;exit;

		$arrPermittedDistList = $this->view_all_join_bridge_table_model->permittedDistrict();
        $blnIsLogged = empty($this->session);
        //var_dump($arrPermittedDistList);exit;
        //var_dump(session()->get('type'));
        $intUserType = ($blnIsLogged)? session()->get('type'): ENUM_GUEST; 
        //echo $ENUM_REGIONAL_MANAGER;exit;
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            $data = '';
            if( count( $arrPermittedDistList )> 0) {
            	$permittedDistList = implode(',', $arrPermittedDistList);
            	//var_dump($arrPermittedDistList);exit;
                $sql .= " AND `a`.`dist01id` in ($permittedDistList)";
            }
        }
		$sql .=" LIMIT {$start}, {$length}";

		$arrDataList = $this->db->query($sql)->getResult();
		//

		//$total = sizeof($this->view_all_join_bridge_table_model->findAll());
		$total = $this->view_all_join_bridge_table_model->totalBridges($search, $arrPermittedDistList, $extra_sql);
		//$total = 100;
		//echo($this->view_all_join_bridge_table_model->getLastQuery());exit;

		$output['draw'] = $this->request->getVar('draw');
		$output['recordsTotal'] = $total;
		$output['recordsFiltered'] = $total;

		$output['data'] = $arrDataList;
		echo json_encode($output);
		die();
	}

	function x()
	{
		$manualSearch = @$this->request->getVar('hidden_sort');
		if ($manualSearch) {
			$PostRadio = @$this->request->getVar('sort');
			//$PostDel = @$this->request->getVar('cmdDelSubmit');
			$PostShow = @$this->request->getVar('ShowSubmit');
			$PostDistShow = @$this->request->getVar('ShowAll');
			$PostInt = @$this->request->getVar('bridge_no');
			$PostDist = @$this->request->getVar('district');
			$blnSearchByDist = @$this->request->getVar('distSubmit');
			$data['dataRadio'] = $PostRadio;

			$total = 0;
			$output['draw'] = '-1';
		} else {
		}
	}

	function saveCostRef()
	{
		$bridgeid = $_POST['bid'];
		$costref = $_POST['cost'];

		$form_data = array(
			'bri03id' => $bridgeid,
			'cost_estimated_reference' => $costref
		);
		//$bid = $this->bridge_basic_data_model->dbUpdate($bridgeid, array('cost_estimated_reference' => $costref));
		// $bid = $this->bridge_basic_data_model->save($form_data);
		echo $bid;
	}

	function lists($type = "")
	{
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;

		if ($type == "new")
			$data['btype'] = 0;
		elseif ($type == "mm")
			$data['btype'] = 1;
		else
			$data['btype'] = 0;

		$PostRadio = @$this->request->getVar('sort');
		$data['dataRadio'] = $PostRadio;
		$data['arrConstructionTypeList'] = $this->construction_model->findAll();
		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	/*
	* get fiscal year accoding to date
	*/
	function getCorrespondingFY($year)
	{

		$FY = $year . ($year + 1);
		return $FY;
	}

	function list_cancelled($type = "")
	{
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;

		$PostRadio = @$this->request->getVar('sort');
		$data['dataRadio'] = $PostRadio;
		$data['arrConstructionTypeList'] = $this->construction_model->findAll();
		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
}
