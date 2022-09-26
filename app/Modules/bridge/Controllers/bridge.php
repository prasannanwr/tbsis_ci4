<?php

namespace App\Modules\bridge\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge\Models\bridge_basic_data_model;
use App\Modules\bridge\Models\bridge_beneficiaries_composition_model;
use App\Modules\bridge\Models\bridge_beneficiaries_model;
use App\Modules\bridge\Models\bridge_employment_generation_detail_model;
use App\Modules\bridge\Models\bridge_employment_generation_model;
use App\Modules\bridge\Models\bridge_final_inspection_model;
use App\Modules\bridge\Models\bridge_model;
use App\Modules\bridge\Models\bridge_public_hearing_members_model;
use App\Modules\bridge\Models\bridge_public_hearing_model;
use App\Modules\bridge\Models\bridge_site_assesment_model;
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

	public function __construct()
	{
		helper(['form', 'html', 'et_helper']);
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

	function index()
	{
		//check access
		//_check(array('org_view'), 'general', '', "You don't have permission to view New_bridge.", 'info', 'dashboard');
		$data['view_file'] = __FUNCTION__;
		$data = self::$arrDefData;
		$PostRadio = @$this->request->getVar('sort');
		$data['dataRadio'] = $PostRadio;
		$data['arrConstructionTypeList'] = $this->construction_model->findAll();
		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	function form($emp_id = FALSE)
	{
		//return redirect()->to('bridge/form2/06 3 0536 18 06 13');
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;

		$data['title'] = 'Add Bridge';
		$data['view_file'] = __FUNCTION__;


		if (session()->get('user_rights') == 3 || session()->get('user_rights') == 5) {
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
		$data['postURL'] = "bridge/form";
		

		//added by prasannanwr@gmail.com
		//under revision
		$data['constypeArr'] = $this->construction_model->findAll();

		$data['countLocal'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_LOCAL)->orderBy('sup01index asc')->findAll();
		$data['countGovt'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_GOVERMENT)->orderBy('sup01index asc')->findAll();
		$data['countOther'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_OTHER)->orderBy('sup01index asc')->findAll();
		
		$casteGroup = array("1" => "Dalit", "2" => "Janjati", "3" => "Minorities", "4" => "BCT");
		$data['casteGroup'] = $casteGroup;
		// $egCasteGroup = array("1" => "Dalit", "2" => "Janjati", "3" => "Minorities", "4" => "BCT (Male)", "5" => "BCT (Female)");
		// $data['egCasteGroup'] = $egCasteGroup;

		if ($emp_id !== false) {
			$emp_id = urldecode($emp_id);

			$data['objOldRec'] = $this->bridge_basic_data_model->where('bri03bridge_no', $emp_id)->first();
			
			if (empty($data['objOldRec'])) {
				redirect('/bridge');
			}
			
			$data['objBeneficiariesRec'] = $this->bridge_beneficiaries_model->where('bb_bridge_id', $data['objOldRec']['bri03id'])->first();
			$data['objPublicHearingRec'] = $this->bridge_public_hearing_model->where('ph_bridge_id', $data['objOldRec']['bri03id'])->first();
			$data['objUCCompositionRec'] = $this->bridge_uc_formation_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objEmploymentGeneration'] = $this->bridge_employment_generation_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objSiteAssesment'] = $this->bridge_site_assesment_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			$data['objFinalInspection'] = $this->bridge_final_inspection_model->where('b_id', $data['objOldRec']['bri03id'])->first();
			
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
			$rules = [
				'bri03bridge_name' => 'required',
				'bri03place_name' => 'required',
				'bri03district_name_lb' => 'required',
				'bri03district_name_rb' => 'required',
				'bri03river_name' => 'required',
				'bri03supporting_agency' => 'required',
				'bri03work_category' => 'required',
				'bri03project_fiscal_year' => 'required'
			];

		if (!$this->validate($rules)) {
			$data['validation'] = $this->validator;
			return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
		} else {

			//$act = $this->request->getVar('cmdSubmit');
			//log_message('error', $this->request->getVar('cmdSubmit'));
			if ($this->request->getVar('cmdSubmit') == 'Close') {
				redirect('bridge');
			} else {

				if ($this->request->getVar('cmdSubmit') == 'Save' || $this->request->getVar('cmdSubmit') == 'Save and Close') {
				//	log_message('error', 'inside the save condition');

					//save
					$bridge_no = @$this->request->getVar('bri03bridge_no');
					$bridge_id = @$this->request->getVar('bri03id');
					$bridge_name = @$this->request->getVar('bri03bridge_name');
					$blnIsNew = false;
					// log_message('error', 'bno:'.$bridge_no);
					// log_message('error', 'bid:'.$bridge_id);
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
					$bri03id = $this->bridge_basic_data_model->getInsertID();

					//site assesment
					$sa_data = array(
						'b_id' => $bri03id,
						'bsa_stability' =>  @$this->request->getVar("bri_stablility_check"),
						'bsa_meandering' => @$this->request->getVar("bri_meandering_check"),
						'bsa_influencing_rivulet' => @$this->request->getVar("bri_influencing_check"),
						'bsa_source_sand' => @$this->request->getVar("bri_source_sand_check"),
						'bsa_source_stone' => @$this->request->getVar("bri_source_stone_check"),
						'bsa_source_gravel' => @$this->request->getVar("bri_source_gravel_check"),
						'bsa_profile_survey' => @$this->request->getVar("bri_profile_survey_check"),
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
						'ph_bridge_id' => $bri03id,
						'ph_assessment_by' => @$this->request->getVar('ph_assessment_by'),
						'ph_assessment_date' => @$this->request->getVar('ph_assessment_date'),
						'ph_status' => @$this->request->getVar('ph_active'),
						'dalit_total' => @$this->request->getVar("ph_total_dalit_total"),
						'dalit_percent' => @$this->request->getVar("total_caste_percent_dalit"),
						'janjati_total' => @$this->request->getVar("ph_total_janjati_total"),
						'janjati_percent' => @$this->request->getVar("total_caste_percent_janjati"),
						'minorities_total' => @$this->request->getVar("ph_total_minorities_total"),
						'minorities_percent' => @$this->request->getVar("total_caste_percent_minorities"),
						'bct_total' => @$this->request->getVar("ph_total_bct_total"),
						'bct_percent' => @$this->request->getVar("total_caste_percent_bct"),
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
						'b_id' => $bri03id,
						'b_uc_assessment_by' => @$this->request->getVar('uc_assessment_by'),
						'b_uc_assessment_date' => @$this->request->getVar('uc_assessment_date'),
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

						'b_uc_status' => @$this->request->getVar('uc_active')
					);
					$this->bridge_uc_formation_model->save($uc_data);

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

						'beg_bct_women' => @$this->request->getVar('beg_bct_women'),
						'beg_bct_men' => @$this->request->getVar('beg_bct_men'),
						'beg_bct_poor' => @$this->request->getVar('beg_bct_poor'),

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

					//final inspection
					$fi_data = array(
						'b_id' => $bri03id,
						'bri_cable_check' =>  @$this->request->getVar("bri_cable_check"),
						'bri_bulldog_check' => @$this->request->getVar("bri_bulldog_check"),
						'bri_anchorage_check' => @$this->request->getVar("bri_anchorage_check"),
						'bri_walkway_check' => @$this->request->getVar("bri_walkway_check"),
						'bri_wire_check' => @$this->request->getVar("bri_wire_check"),
						'bri_fixtures_check' => @$this->request->getVar("bri_fixtures_check"),
						'bri_relative_check' => @$this->request->getVar("bri_relative_check"),
						'bri_anchorage_dimension_check' => @$this->request->getVar("bri_anchorage_dimension_check"),
						'bri_anchorage_stone_check' => @$this->request->getVar("bri_anchorage_stone_check"),
						'bri_suspenders_check' => @$this->request->getVar("bri_suspenders_check"),
						'bri_wire_mesh_check' => @$this->request->getVar("bri_wire_mesh_check"),
						'bridge_completion_date' => @$this->request->getVar("bridge_completion_date"),
						'fi_site_assessment_by' => @$this->request->getVar("fi_site_assessment_by"),
						'fi_site_assessment_date' => @$this->request->getVar("fi_site_assessment_date"),
						'bri_completion_fiscal_year' => @$this->request->getVar("bri_completion_fiscal_year"),
						'bri_remarks' => @$this->request->getVar("bri_remarks")
					);
					//echo "<pre>";var_dump($sa_data);exit;
					$this->bridge_site_assesment_model->save($sa_data);
					
					// $this->bridge_technical_data_model->save($form_data2);
					session()->setFlashdata('message', 'Updated successfully.');
					if ($this->request->getVar('cmdSubmit') == 'Save and Close') {
						redirect('bridge');
					} else {
						//open it in edit mode
						//log_message('error', 'edit mode');
						//redirect('bridge/form/' . $bridge_no);

						return redirect()->to('bridge/form/' . $bridge_no);
					}
				} else {
					//log_message('error', 'no submit');
				}
			}
		}
		}

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
		$data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['objOldRec']->bri03bridge_no)->findAll();
		$data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['objOldRec']->bri03bridge_no)->findAll();

		$data['arrSupList'] = $this->supporting_agencies_model->findAll();
		$data['arrCostCompList'] = $this->cost_components_model->findAll();
		$data['arrVDCList'] = $this->view_vdc_model->findAll();

		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}


	function delete()
	{
		//var_dump($_GET);
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		if (session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_REGIONAL_MANAGER) {

			$delete_id = $this->request->getVar('id');

			$arrdeltable = $this->bridge_model->where('bri03bridge_no', $delete_id)->first();

			$this->bridge_model->where('bri03bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->bridge_technical_data_model->where('bri04bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->bridge_beneficiaries_model->where('bri05bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->personnel_information_model->where('bri06bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->bridge_est_cost_model->where('bri07bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->contribution_agencies_model->where('bri08bridge_no', $arrdeltable->bri03bridge_no)->delete();

			$message = 'Selected Data Deleted.';
			// log_query($message);
			// set_message($message, 'success');


			redirect('bridge');
		} else {
			redirect('bridge');
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
				$this->bridge_technical_data_model->where('bri04bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->bridge_beneficiaries_model->where('bri05bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->personnel_information_model->where('bri06bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->bridge_est_cost_model->where('bri07bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->contribution_agencies_model->where('bri08bridge_no', $delete_id->bri03bridge_no)->delete();
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

	function ajaxData()
	{

		//todo: count total records and put the no here
		//Apply Where Condition for counting
		//$this->ajaxDataApplyWhere();
		
		//Apply Where condition for Data
		$this->ajaxDataApplyWhere();

		//Apply Limit for data
		$length = ($this->request->getVar('length') != ''?$this->request->getVar('length'):10);
		$start  = ($this->request->getVar('start') != ''?$this->request->getVar('start'):0);

		//for ordering
		//$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type');
		$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type', 'bri03work_category');
		$order = $this->request->getVar('order');
		// var_dump($order['0']['column']);
		// if (is_array($order)) {
		// 	$x = $order;
		// 	foreach ($order as $k => $v) {
		// 		$this->view_all_join_bridge_table_model->orderBy($arrColumns[$v['column']] . ' ' .  $v['dir']);
		// 	}
		// } else {
		// 	$this->view_all_join_bridge_table_model->orderBy('bri05bridge_complete_check asc')->orderBy('bri05bridge_complete desc');
		// 	$x = false;
		// }
		// $arrDataList = $this->view_all_join_bridge_table_model->findAll($length, $start);
		$arrDataList = $this->view_all_join_bridge_table_model->findAll($length, $start);

		$total = sizeof($arrDataList);
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
