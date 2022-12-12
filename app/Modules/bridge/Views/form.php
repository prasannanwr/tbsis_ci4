<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<?php
if ($objOldRec && $objOldRec['bri03id'] != '') {
	$bridgeid = $objOldRec['bri03id'];
} else {
	$bridgeid = '';
}
?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading 

	<form role="form form-group New_Bridge">-->
		
		<?php if (session()->getFlashdata('warning')) {
			echo "warning: " . session()->getFlashdata('warning');
		} ?>
		<?php if(isset($validation)) { ?> 
			<div class="alert alert-danger" role="alert">
			<?php echo $validation->listErrors(); ?>
			</div>
		<?php } ?>
		</div>
		<?php echo form_open_multipart($postURL, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role' => 'form', 'data-form' => 'validate')) ?>

		<?php // var_dump($objOldRec); 
		?>

		<div class="row add_form_btn">
			<?php $valDisable = ($objOldRec && $objOldRec['bri03id'] != '') ? "readonly" : " "; ?>
			<a href="<?php echo site_url(); ?>/bridge/form" class="btn btn-md btn-primary">Add New</a>

			<!-- <input type="submit" name="cmdSubmitX" class="btn btn-md btn-success btnDisableNSave" value="Save and Close">

    <input type="submit" name="cmdSubmitX" class="btn btn-md btn-primary btnDisableNSave" value="Save"> -->
			<a href="<?php echo site_url('bridge'); ?>" class="btn btn-md btn-danger">Close</a>

		</div>

		<div class="row">

			<div class="NewFormTopHeader">

				<div class="header">

					<ul class="nav navbar-nav tabHeads nav-tabs">
						<li class="active"><a href="#Basic_Data">Basic Data</a></li>
						<li><a href="#Site_Assesment">Site Assesment</a></li>
						<li><a href="#Beneficiaries_Composition">Beneficiaries' Composition</a></li>
						<li><a href="#Public_Hearing">Public Hearing</a></li>
						<li><a href="#UC_Formation">UC Formation</a></li>
						<li><a href="#Design">Design</a></li>
						<li><a href="#Estimated_Cost">Cost Estimate</a></li>
						<!-- <li><a href="#Land_Donation">Land Donation</a></li> -->
						<li><a href="#Insurance">Insurance</a></li>
						<li><a href="#Sign_Board">Sign Board</a></li>
						<li><a href="#Steel_Parts">Steel Parts</a></li>
						<li><a href="#Construction_Work">Construction Work</a></li>
						<li><a href="#Final_Inspection">Final Inspection</a></li>
						<li><a href="#Public_Audit">Public Audit</a></li>
						<li><a href="#Employment_Generation">Employment Generation</a></li>
					</ul>

					<div class="clear"></div>

				</div>

			</div>

		</div>



		<div id='content' class="tab-content">

			<div class="tab-pane active" id="Basic_Data">

				<!--/ start first Bridge .row-->

				<div class="row">

					<div class="col-lg-12">

						<h1 class="page-header font">

							<u>Basic Bridge Data</u>

						</h1>

					</div>

				</div>

				<!-- /.row -->

				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="col-lg-4">



							<input type="hidden" class="form-control" name="bri03id" id="bri03id" value="<?php echo et_setFormVal('bri03id', $objOldRec); ?>" />

							<div class="form-group clearfix required">

								<label class="col-lg-5 ">Bridge Name</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03bridge_name" id="bri03bridge_name" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" />

								</div>

							</div>

							<?php //print_r(getPermittedDistCondStr());
							?>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">District Name Left Bank</label>

								<div class="col-lg-7 ">
									<?php if ($objOldRec && $objOldRec['bri03id'] != '') {
										if ($is_admin == 0) {
											$valDisableDist = "readonly";
										} else {
											$valDisableDist = "";
										}
									} else {
										$valDisableDist = "";
									} ?>
									<?php echo et_form_dropdown_db_dist(
										'bri03district_name_lb',

										'dist01district',
										'dist01name',
										'dist01id',

										et_setFormVal('bri03district_name_lb', $objOldRec),

										getPermittedDists(),

										'class="form-control onChangeDist" data-targetvdc="#bri03municipality_lb" ' . $valDisableDist . ' ',
										array('SortBy' => 'dist01name')
									) ?>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-5">Palika/Municipality LB</label>
								<div class="col-lg-7 ">
									<?php echo et_form_dropdown_db(
										'bri03municipality_lb',

										'muni01municipality_vcd',
										'muni01name',
										'muni01id',

										et_setFormVal('bri03municipality_lb', $objOldRec),

										'',
										'class="form-control" ' . $valDisable . '',
										array('SortBy' => 'muni01name DESC')
									) ?>
								</div>
							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Major Municipality</label>

								<div class="col-lg-7 ">

									<select class="form-control height" name="bri03major_vdc" <?php echo $valDisable; ?>>

										<option value="<?php echo MAJOR_LEFT; ?>" <?php echo MAJOR_LEFT == et_setFormVal('bri03major_vdc', $objOldRec) ? 'selected' : ''; ?>>Left</option>

										<option value="<?php echo MAJOR_RIGHT; ?>" <?php echo MAJOR_RIGHT == et_setFormVal('bri03major_vdc', $objOldRec) ? 'selected' : ''; ?>>Right</option>

									</select>



								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 ">Ward LB</label>

								<div class="col-lg-7 ">

									<input type="text" class="form-control height" name="bri03ward_lb" id="bri03ward_lb" value="<?php echo et_setFormVal('bri03ward_lb', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Distance gained (Hrs)</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03portering_distance" id="bri03portering_distance" value="<?php echo et_setFormVal('bri03portering_distance', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5  ">Distance to Road Head (days)</label>

								<div class="col-lg-7 ">

									<input type="text" class="form-control height" name="bri03road_head" id="bri03road_head" value="<?php echo et_setFormVal('bri03road_head', $objOldRec); ?>" />

								</div>

							</div>



							<!-- <div class="form-group clearfix">

								<label class="col-lg-5">Bridge Type</label>

								<div class="col-lg-7 ">

									<?php //echo et_form_dropdown_db('bri03bridge_type', 'bri01bridge_type_table', 'bri01bridge_type_name', 'bri01id', et_setFormVal('bri03bridge_type',$objOldRec), '', 'class="form-control"') 
									?>

								</div>

							</div> -->



							<!-- <div class="form-group clearfix">

								<label class="col-lg-5">WW Width(cm)</label>

								<div class="col-lg-7 ">

									<?php //echo et_form_dropdown_db('bri03ww_width', 'wal01walkway_width_table', 'wal01walkway_width', 'wal01id', et_setFormVal('bri03ww_width',$objOldRec), '', 'class="form-control"') 
									?>
								</div>

							</div>
 -->


							<!--<div class="form-group clearfix">

										<label class="col-lg-5">Development Region</label>

										<div class="col-lg-7 ">

                     <?php //echo et_form_dropdown_db('bri03development_region', 'dev01development_region', 'dev01name', 'dev01id', et_setFormVal('bri03development_region', $objOldRec), '', 'class="form-control"') 
						?>

										

										</div>

									</div>-->


							<div class="form-group clearfix">

								<label class="col-lg-5 ">Project Status</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03work_category', 'wkc01work_category_table', 'wkc01work_category_name', 'wkc01id', et_setFormVal('bri03work_category', $objOldRec), '', 'class="form-control"') ?>

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Implementing Year</label>

								<div class="col-lg-7 ">
									<?php
									if (isset($objOldRec['bri03id']) && $objOldRec['bri03id'] != '') {
										if ($is_admin == 0) {
											$valDisableFy = "readonly";
										} else {
											$valDisableFy = "";
										}
									} else {
										$valDisableFy = "";
									}

									?>
									<?php echo et_form_dropdown_db('bri03project_fiscal_year', 'fis01fiscal_year', 'fis01year', 'fis01id', et_setFormVal('bri03project_fiscal_year', $objOldRec), '', 'class="form-control" ', array('SortBy' => 'fis01year desc')) ?>
									<?php if ($valDisableFy == 'readonly') { ?>
										<script type="text/javascript">
											$("#bri03project_fiscal_year").css("pointer-events", "none");
										</script>
									<?php } ?>


								</div>

							</div>

							<div class="form-group clearfix"><h4><strong>Utility of Bridge</strong></h4></div>

							<div class="form-group clearfix">
								<label class="col-lg-5">Left Bank</label>
								<div class="col-lg-7 ">
									<?php echo et_form_dropdown_db(
										'bri03utility_left_bank',

										'bridge_utilities',
										'bu_name',
										'bu_id',

										et_setFormVal('bri03utility_left_bank', $objOldRec),

										'',
										'class="form-control" ' . $valDisable . '',
										array('SortBy' => 'bu_id ASC')
									) ?>
								</div>
							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Physical Progress</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03physical_progress', 'physical_progress_types', 'pp_name', 'pp_id', et_setFormVal('bri03physical_progress', $objOldRec), '', 'class="form-control"') ?>

								</div>

							</div>



							<!-- <div class="form-group clearfix">

								<label class="col-lg-5 ">Coordinate North</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03coordinate_north" id="bri03coordinate_north" value="<?php //echo et_setFormVal('bri03coordinate_north',$objOldRec); 
																																				?>" />



								</div>

							</div> -->





						</div>

						<div class="col-lg-5">

							<div class="form-group clearfix">

								<label class="col-lg-5">Name of Place</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03place_name" id="bri03place_name" value="<?php echo et_setFormValBlank('bri03place_name', $objOldRec); ?>" />

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 ">District Name Right Bank</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db_dist('bri03district_name_rb', 'dist01district', 'dist01name', 'dist01id', et_setFormVal('bri03district_name_rb', $objOldRec), getPermittedDists(), 'class="form-control onChangeDist" data-targetvdc="#bri03municipality_rb" ' . $valDisableDist . '', array('SortBy' => 'dist01name')) ?>

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Municipality Right Bank</label>
								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03municipality_rb', 'muni01municipality_vcd', 'muni01name', 'muni01id', et_setFormVal('bri03municipality_rb', $objOldRec), '', 'class="form-control" ' . $valDisable . '', array('SortBy' => 'muni01name')) ?>

								</div>
							</div>

							<!-- <div class="form-group clearfix">

								<label class="col-lg-5 ">Bridge Series</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03bridge_series" id="bri03bridge_series" value="<?php //echo et_setFormVal('bri03bridge_series', $objOldRec); 
																																		?>" />

								</div>

							</div> -->


							<div class="form-group clearfix">

								<label class="col-lg-5 ">Funding agency</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03supporting_agency', 'sup03basic_supporting_agency', 'sup03sup_agency_name', 'sup03id', et_setFormVal('bri03supporting_agency', $objOldRec), '', 'class="form-control"') ?>

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Ward RB</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03ward_rb" id="bri03ward_rb" value="<?php echo et_setFormVal('bri03ward_rb', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix hide">

								<label class="col-lg-5  ">Distance to District HQ (days)</label>

								<div class="col-lg-7 ">

									<input type="text" class="form-control height" name="bri03district_distance" id="bri03district_distance" value="<?php echo et_setFormVal('bri03district_distance', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">River Type (months)</label>

								<div class="col-lg-7 ">

									<input type="text" class="form-control height" name="bri03river_type" id="bri03river_type" value="<?php echo et_setFormVal('bri03river_type', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix">&nbsp;</div>

							<div class="form-group clearfix">&nbsp;</div>

							<div class="form-group clearfix">&nbsp;</div>

							<div class="form-group clearfix">&nbsp;</div>

							<div class="form-group clearfix">&nbsp;</div>

							<div class="form-group clearfix">&nbsp;</div>

							<div class="form-group clearfix">
								<label class="col-lg-5">Right Bank</label>
								<div class="col-lg-7 ">
									<?php echo et_form_dropdown_db(
										'bri03utility_right_bank',

										'bridge_utilities',
										'bu_name',
										'bu_id',

										et_setFormVal('bri03utility_right_bank', $objOldRec),

										'',
										'class="form-control" ' . $valDisable . '',
										array('SortBy' => 'bu_id ASC')
									) ?>
								</div>
							</div>



							<!-- <div class="form-group clearfix">

								<label class="col-lg-5 ">Topo Map No</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03topo_map_no" id="bri03topo_map_no" value="<?php //echo et_setFormVal('bri03topo_map_no', $objOldRec); 
																																	?>" />

								</div>

							</div> -->



							<!-- <div class="form-group clearfix">

								<label class="col-lg-5 ">Coordinate East</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03coordinate_east" id="bri03coordinate_east" value="<?php //echo et_setFormVal('bri03coordinate_east', $objOldRec); 
																																			?>" />

								</div>

							</div> -->





						</div>

						<div class="col-lg-3">

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Bridge No</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03bridge_no" id="bri03bridge_no" value="<?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?>" readonly="readonly" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5">River Name</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03river_name" id="bri03river_name" value="<?php echo et_setFormValBlank('bri03river_name', $objOldRec); ?>" />

								</div>

							</div>

						</div>



					</div>

				</div>

				<!--  /.row -->



			</div> <!-- end first Bridge -->

			<!----start second Bridge--->

			<div class="tab-pane" id="Site_Assesment">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
							Site Assesment
						</h1>
					</div>
				</div>
				<input type="hidden" class="form-control " name="bsa_id" id="bsa_id" value="<?php echo et_setFormVal('bsa_id',$objSiteAssesment ); ?>"/>

				<div class="row clearfix">
					<div class="col-lg-10">
						
					<table class="table table-bordered table-hover">
								<tr>
									<td>S.No.</td>
									<td>Issues</td>
									<td>Acceptable</td>
									<td>Deficiency</td>
									<td>Remedial Action</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Stability of the bank/slopes</td>
									<td>Solid rock or soil and fully vegetated</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_stablility_check" id="bri_stablility_check" value="1" <?php echo (et_setFormVal('bsa_stability', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_stability_remark" value="<?=et_setFormValBlank('bsa_stability_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>2</td>
									<td>Influencing rivulet</td>
									<td>No nearby rivulets</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_influencing_check" id="bsa_influencing_check" value="1" <?php echo (et_setFormVal('bsa_influencing_rivulet', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bsa_rivulet_remark" value="<?=et_setFormValBlank('bsa_rivulet_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>3</td>
									<td>Source of Gravel</td>
									<td>Solid rock or soil and fully vegetated</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_source_gravel_check" id="bri_source_gravel_check" value="1" <?php echo (et_setFormVal('bsa_source_gravel', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_source_gravel_remark" value="<?=et_setFormValBlank('bsa_source_gravel_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>4</td>
									<td>Source of Sand</td>
									<td>Solid rock or soil and fully vegetated</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_source_sand_check" id="bri_source_sand_check" value="1" <?php echo (et_setFormVal('bsa_source_sand', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_source_sand_remark" value="<?=et_setFormValBlank('bsa_source_sand_remark', $objSiteAssesment);?>"></td>
								</tr>
					</table>
					<div class="col-lg-8">

						
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="site_assessment_by" id="site_assessment_by" value="<?php echo et_setFormValBlank('bsa_assesment_by', $objSiteAssesment); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment Date</label>

								<div class="col-lg-6 datebox-container ">

									<div class="col-lg-10 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="site_assessment_date" id="site_assessment_date" value="<?php if (isset($objSiteAssesment['bsa_assesment_date']) && $objSiteAssesment['bsa_assesment_date'] != "0000-00-00") {
																																					echo et_setFormVal('bsa_assesment_date', $objSiteAssesment);
																																				} ?>" />
									</div>

								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Remark</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="bsa_remarks" id="bsa_remarks" value="<?php echo et_setFormValBlank('bsa_remark', $objSiteAssesment); ?>" />
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>

			<!-- Final Inspection -->
			<div class="tab-pane" id="Final_Inspection">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
							Final Inspection (Site Visit)
						</h1>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-13">
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-10 ">Cable Sag</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_cable_check" id="bri_cable_check" value="1" <?php echo (et_setFormVal('bri_cable_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-10 ">Bulldog Grips</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_bulldog_check" id="bri_bulldog_check" value="1" <?php echo (et_setFormVal('bri_bulldog_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-10 ">Anchorage Foundation (Proper cut slopes per drawing)</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_anchorage_check" id="bri_anchorage_check" value="1" <?php echo (et_setFormVal('bri_anchorage_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-10 ">Walkway</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_walkway_check" id="bri_walkway_check" value="1" <?php echo (et_setFormVal('bri_walkway_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-10 ">Wire Mesh</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_wire_check" id="bri_wire_check" value="1" <?php echo (et_setFormVal('bri_wire_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-10 ">Fixtures</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_fixtures_check" id="bri_fixtures_check" value="1" <?php echo (et_setFormVal('bri_fixtures_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Bridge Completion Date</label>

								<div class="col-lg-6 datebox-container ">

									<div class="col-lg-12 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bridge_completion_date" id="bridge_completion_date" value="<?php if (isset($objFinalInspection['bridge_completion_date']) && $objFinalInspection['bridge_completion_date'] != "0000-00-00") {
																																					echo et_setFormVal('bridge_completion_date', $objFinalInspection);
																																				} ?>" />
									</div>

								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="fi_site_assessment_by" id="fi_site_assessment_by" value="<?php echo et_setFormValBlank('fi_site_assessment_by', $objFinalInspection); ?>" />
								</div>
							</div>
							
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment Date</label>

								<div class="col-lg-6 datebox-container ">

									<div class="col-lg-12 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="fi_site_assessment_date" id="fi_site_assessment_date" value="<?php if (isset($objFinalInspection['fi_site_assessment_date']) && $objFinalInspection['fi_site_assessment_date'] != "0000-00-00") {
																																					echo et_setFormVal('fi_site_assessment_date', $objFinalInspection);
																																				} ?>" />
									</div>

								</div>
							</div>

						</div>
						<div class="col-lg-6">

							<div class="form-group clearfix ">
								<label class="col-lg-8 ">Relative Sag</label>
								<div class="col-lg-2 ">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_relative_check" id="bri_relative_check" value="1" <?php echo (et_setFormVal('bri_relative_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-8 ">Anchorage Foundation Block (Dimensions as per drawing)</label>
								<div class="col-lg-2">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_anchorage_dimension_check" id="bri_anchorage_dimension_check" value="1" <?php echo (et_setFormVal('bri_anchorage_dimension_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-8 ">Anchorage/Foundation (Stone masonry and concreting as per drawing & specifications)</label>
								<div class="col-lg-2">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_anchorage_stone_check" id="bri_anchorage_stone_check" value="1" <?php echo (et_setFormVal('bri_anchorage_stone_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-8 ">Suspenders (No missing suspenders/parts, all suspenders vertical)</label>
								<div class="col-lg-2">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_suspenders_check" id="bri_suspenders_check" value="1" <?php echo (et_setFormVal('bri_suspenders_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-8 ">Wire Mesh (Wires are heavy zic coated)</label>
								<div class="col-lg-2">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_wire_mesh_check" id="bri_wire_mesh_check" value="1" <?php echo (et_setFormVal('bri_wire_mesh_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">

								<label class="col-lg-8 ">Bridge Completion Fiscal Year</label>

								<div class="col-lg-4 ">
									<?php
									if (isset($objOldRec['bri03id']) && $objOldRec['bri03id'] != '') {
										if ($is_admin == 0) {
											$valDisableFy = "readonly";
										} else {
											$valDisableFy = "";
										}
									} else {
										$valDisableFy = "";
									}

									?>
									<?php echo et_form_dropdown_db('bri_completion_fiscal_year', 'fis01fiscal_year', 'fis01year', 'fis01id', et_setFormVal('bri_completion_fiscal_year', $objFinalInspection), '', 'class="form-control" ', array('SortBy' => 'fis01year desc')) ?>
									<?php if ($valDisableFy == 'readonly') { ?>
										<script type="text/javascript">
											$("#bri_completion_fiscal_year").css("pointer-events", "none");
										</script>
									<?php } ?>


								</div>

							</div>


							<div class="form-group clearfix ">
								<label class="col-lg-8 ">Remark</label>
								<div class="col-lg-4 ">
									<input type="text" class=" form-control " name="bri_remarks" id="bri_remarks" value="<?php echo et_setFormValBlank('bri_remarks', $objFinalInspection); ?>" />
									<input type="hidden" class="form-control " name="bri_f_id" id="bri_f_id" value="<?php echo et_setFormVal('bri_f_id',$objFinalInspection); ?>"/>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>

			<!----end second Bridge--->

			<!----start third Bridge--->

			<div class="tab-pane" id="Beneficiaries_Composition">

				<div class="row">
					<div class="col-lg-12">
						<u>
							<h1 class="page-header font">
								Immediate Beneficiaries' Composition
							</h1>
						</u>
					</div>
				</div>
			
				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="form-group clearfix ">
							
							<table class="table table-bordered table-hover">
								<tr>
									<td rowspan="2">Cast/Ethinicity</td>
									<td colspan="2">No. of Households</td>
									<td colspan="2">Beneficiary Population</td>
									<td rowspan="2">Total</td>
								</tr>
								<tr>
									<td>Total</td>
									<td>Poor</td>
									<td>Women</td>
									<td>Men</td>
								</tr>
								<?php
								$total = 0;
								$grand_total = 0;
								$total_percent = 0;
								foreach ($casteGroup as $key => $caste) :
									$caste = strtolower($caste);
									if(is_array($objBeneficiariesRec)) {
										$total = $objBeneficiariesRec[$caste.'_men'] + $objBeneficiariesRec[$caste.'_women'];
										// $grand_total = $objBeneficiariesRec['total_household'] + $objBeneficiariesRec['total_poor'] + $objBeneficiariesRec['total_men'] + $objBeneficiariesRec['total_women']; 
										$grand_total = $grand_total+ $total; 
										$total_percent = $objBeneficiariesRec['percent_household'] + $objBeneficiariesRec['percent_poor'] + $objBeneficiariesRec['percent_men'] + $objBeneficiariesRec['percent_women'];  
									}
								?>
									<tr>
										<td><?= ucfirst($caste) ?></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_total form-control bc_total_<?= $key; ?>" name="bc_total_<?= $caste; ?>" id="bc_total_<?= $key; ?>" value="<?php echo (is_array($objBeneficiariesRec)? $objBeneficiariesRec[$caste.'_total']:0); ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_poor form-control bc_poor_<?= $key; ?>" name="bc_poor_<?= $caste; ?>" id="bc_poor_<?= $key; ?>" value="<?php echo (is_array($objBeneficiariesRec)? $objBeneficiariesRec[$caste.'_poor']:0); ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_women form-control bc_women_<?= $key; ?>" name="bc_women_<?= $caste; ?>" id="bc_women_<?= $key; ?>" value="<?php echo (is_array($objBeneficiariesRec)? $objBeneficiariesRec[$caste.'_women']:0);; ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_men form-control bc_men_<?= $key; ?>" name="bc_men_<?= $caste; ?>" id="bc_men_<?= $key; ?>" value="<?php echo (is_array($objBeneficiariesRec)? $objBeneficiariesRec[$caste.'_men']:0);; ?>" /></td>
										<td><input type="text" readonly data-row="<?=$key; ?>" data-col="" class="bc_sub_total bc_sub_total_<?= $key; ?> form-control " name="bc_sub_total_<?= $caste; ?>" id="bc_sub_total_<?= $key; ?>" value="<?php echo $total; ?>" /></td>
									</tr>
								<?php endforeach; ?>
								<tr>
									<td>Total</td>
									<td><input type="text" readonly class="bc-total form-control " name="total_no_households" id="total_no_households" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['total_household']:0); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="total_no_households_poor" id="total_no_households_poor" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['total_poor']:0); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="bp_women_total" id="bp_women_total" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['total_women']:0); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="bp_men_total" id="bp_men_total" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['total_men']:0); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="grand_total" id="grand_total" value="<?php echo $grand_total; ?>" /></td>
								</tr>
								<tr>
									<td>%</td>
									<td><input type="text" readonly class=" form-control " name="percent_no_households" id="percent_no_households" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['percent_household']:0); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="percent_no_households_poor" id="percent_no_households_poor" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['percent_poor']:0); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="bp_women_percent" id="bp_women_percent" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['percent_women']:0); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="bp_men_percent" id="bp_men_percent" value="<?php echo (is_array($objBeneficiariesRec)?$objBeneficiariesRec['percent_men']:0); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="grand_percent" id="grand_percent" value="<?php echo $total_percent; ?>" /></td>
								</tr>
								<tr>

									<th class="cost width center">Assessment By</th>
									<th><input type="text" class=" form-control " name="bb_assessment_by" id="bb_assessment_by" value="<?php echo et_setFormValBlank('bb_assessment_by', $objBeneficiariesRec); ?>" /></th>
									<th>Assessment Date</th>
									<th class="">
									<div class="col-lg-7 datebox-container ">

										<div class="col-lg-10 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="bb_assessment_date" id="bb_assessment_date" value="<?php if (isset($objBeneficiariesRec['bb_assessment_date']) && $objBeneficiariesRec['bb_assessment_date'] != "0000-00-00") {
																																						echo et_setFormVal('bb_assessment_date', $objBeneficiariesRec);
																																					} ?>" />

										</div>

										</div>
									</th>
									<th colspan="2"><input name="bb_status" id="bb_status" type="radio" value="1" <?php echo (is_array($objBeneficiariesRec) && $objBeneficiariesRec['bb_status'] == 1 ? "checked='checked'" : '');?>><label for="bb_status">Active</label></th>
									<input type="hidden" class="form-control " name="bb_id" id="bb_id" value="<?php echo et_setFormVal('bb_id',$objBeneficiariesRec ); ?>"/>
								</tr>
							</table>

						</div>


					</div>
				</div>
				<!-- /.row -->



			</div>


			<!----ens third Bridge--->

			<!----start forth Bridge--->

			<div class="tab-pane" id="Public_Hearing">

				<!--/.row-->

				<div class="row">

					<div class="col-lg-12">

						<u>
							<h1 class="page-header font">

								Public Hearing

							</h1>
						</u>

					</div>

				</div>

				<!-- /.row -->
				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="form-group clearfix ">
							
							<table class="table table-bordered table-hover">
								<tr>
									<td rowspan="2">Total</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td rowspan="2"><?= $caste ?></td>
									<?php endforeach; ?>
									<td colspan="3">Total</td>
								</tr>
								<tr>
									<td>Sum</td>
									<td>Female</td>
									<td>Male</td>
								</tr>
								
									<tr>
										<td>Members from community</td>
										<?php
										foreach ($casteGroup as $key => $caste) :
											$caste = strtolower($caste).'_total';
										?>
										<td><input type="text" data-row="<?=$key; ?>" class="ph-text form-control ph_total_<?= $key; ?>" name="ph_total_<?=strtolower($caste); ?>" id="ph_total_<?= $key; ?>" value="<?php echo (is_array($objPublicHearingRec)?$objPublicHearingRec[$caste]:0); ?>" /></td>
										<?php endforeach; ?>										
										<td><input type="text" readonly class=" ph-sum form-control " name="ph-sum" id="ph-sum" value="<?php echo et_setFormVal('ph_sum', $objPublicHearingRec); ?>" /></td>
										<td><input type="text" class=" ph-female form-control " name="ph-female" id="ph-female" value="<?php echo et_setFormVal('ph_female', $objPublicHearingRec); ?>" /></td>
										<td><input type="text" class=" ph-male form-control " name="ph-male" id="ph-male" value="<?php echo et_setFormVal('ph_male', $objPublicHearingRec); ?>" /></td>
									</tr>
								<tr>
									<td>%</td>
									<?php
										foreach ($casteGroup as $key => $caste) :
											$castename = strtolower($caste);
											$caste = strtolower($caste).'_percent';
										?>
										<td><input type="text" readonly class="total_caste_percent form-control " name="total_ph_caste_percent_<?=$castename;?>" id="total_ph_caste_percent_<?=$key;?>" value="<?php echo (is_array($objPublicHearingRec)?$objPublicHearingRec[$caste]:0); ?>" /></td>
										<?php endforeach; ?>
									
										<td><input type="text" readonly class="total_sum_percent form-control " name="total_sum_percent" id="total_sum_percent" value="<?php echo et_setFormVal('ph_sum_percent', $objPublicHearingRec); ?>" /></td>
										<td><input type="text" class="total_female_percent form-control " name="total_female_percent" id="total_female_percent" value="<?php echo et_setFormVal('ph_female_percent', $objPublicHearingRec); ?>" /></td>
										<td><input type="text" class="total_male_percent form-control " name="total_male_percent" id="total_male_percent" value="<?php echo et_setFormVal('ph_male_percent', $objPublicHearingRec); ?>" /></td>

								</tr>
								
								<tr>

									<th class="cost width center">Assessment By</th>
									<th><input type="text" class=" form-control " name="ph_assessment_by" id="ph_assessment_by" value="<?php echo et_setFormValBlank('ph_assessment_by', $objPublicHearingRec); ?>" /></th>
									<th>Assessment Date</th>
									<th class="">
									<div class="col-lg-12 datebox-container ">

										<div class="col-lg-12 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="ph_assessment_date" id="ph_assessment_date" value="<?php if (isset($objPublicHearingRec['ph_assessment_date']) && $objPublicHearingRec['ph_assessment_date'] != "0000-00-00") {
																																						echo et_setFormVal('ph_assessment_date', $objPublicHearingRec);
																																					} ?>" />

										</div>

										</div>
									</th>
									<th colspan="2"><input name="ph_status" id="ph_status" type="radio" value="1" <?php echo (is_array($objPublicHearingRec) && $objPublicHearingRec['ph_status'] == 1 ? "checked='checked'" : '');?>><label for="ph_status">Active</label></th>
									<input type="hidden" class="form-control " name="ph_id" id="ph_id" value="<?php echo et_setFormVal('ph_id',$objPublicHearingRec); ?>"/>								</tr>
							</table>

						</div>


					</div>
				</div>
			</div>



			<!----end forth Bridge--->



			<!----start fifth Bridge---->



			<div class="tab-pane" id="UC_Formation">

				<!--/.row-->

				<div class="row form-group">

					<div class="col-lg-12" >
						<h1 class="page-header">
							<u>																													
							UC Composition
							</u>

						</h1>
					</div>



				</div>

				<!-- /.row -->
				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="form-group clearfix ">
							
							<table class="table table-bordered table-hover">
								<tr>
									<td rowspan="2">Positions</td>
									<?php
										foreach ($casteGroup as $key => $caste) :
										?>
										<td rowspan="2"><?=$caste;?></td>
										<?php endforeach; ?>
									<td colspan="3">Total</td>
								</tr>
								<tr>
									<td>Sum</td>
									<td>Female</td>
									<td>Male</td>
								</tr>
								<tr>
									<td>Chairperson</td>
									<?php
									$totalcp = 0;
									$totaldy = 0;
									$totalsc = 0;
									$totaltr = 0;
									$totalmm = 0;
									foreach ($casteGroup as $key => $caste) :
										$castename = strtolower($caste);
										$caste = 'b_uc_cp_'.strtolower($caste);
										if(is_array($objUCCompositionRec)) { $totalcp = $totalcp + $objUCCompositionRec[$caste]; }
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="cp" class="uc-text uc-cp-text form-control uc_caste_<?= $key; ?> uc_cp_total_<?= $key; ?>" name="uc_cp_total_<?=$castename; ?>" id="uc_cp_total_<?= $key; ?>" value="<?php echo (is_array($objUCCompositionRec)?$objUCCompositionRec[$caste]:0); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-cp-sum" id="uc-cp-sum" value="<?php echo $totalcp; ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc_cp_female" id="uc-cp-female" value="<?php echo et_setFormVal('b_uc_cp_female', $objUCCompositionRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc_cp_male" value="<?php echo et_setFormVal('b_uc_cp_male', $objUCCompositionRec); ?>" /></td>
								</tr>
								<tr>
									<td>(DY) Chairperson</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
										$castename = strtolower($caste);
										$caste = 'b_uc_dy_'.strtolower($caste);
										if(is_array($objUCCompositionRec)) { $totaldy = $totaldy + $objUCCompositionRec[$caste]; }
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="dy" class="uc-text uc-dy-text form-control uc_caste_<?= $key; ?> uc_dy_total_<?= $key; ?>" name="uc_dy_total_<?= $castename; ?>" id="uc_dy_total_<?= $key; ?>" value="<?php echo (is_array($objUCCompositionRec)?$objUCCompositionRec[$caste]:0); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-dy-sum" id="uc-dy-sum" value="<?php echo $totaldy; ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-dy-female" id="uc-dy-female" value="<?php echo et_setFormVal('b_uc_dy_female', $objUCCompositionRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-dy-male" id="uc-dy-male" value="<?php echo et_setFormVal('b_uc_dy_male', $objUCCompositionRec); ?>" /></td>
								</tr>
								<tr>
									<td>Secretary</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
										$castename = strtolower($caste);
										$caste = 'b_uc_sc_'.strtolower($caste);
										if(is_array($objUCCompositionRec)) { $totalsc = $totalsc + $objUCCompositionRec[$caste]; }
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="sc" class="uc-text uc-sc-text form-control uc_caste_<?= $key; ?> uc_sc_total_<?= $key; ?>" name="uc_sc_total_<?= $castename; ?>" id="uc_sc_total_<?= $key; ?>" value="<?php echo (is_array($objUCCompositionRec)?$objUCCompositionRec[$caste]:0); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-sc-sum" id="uc-sc-sum" value="<?php echo $totalsc; ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-sc-female" id="uc-sc-female" value="<?php echo et_setFormVal('b_uc_sc_female', $objUCCompositionRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-sc-male" id="uc-sc-male" value="<?php echo et_setFormVal('b_uc_sc_male', $objUCCompositionRec); ?>" /></td>
								</tr>
								<tr>
									<td>Treasurer</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
										$castename = strtolower($caste);
										$caste = 'b_uc_tr_'.strtolower($caste);
										if(is_array($objUCCompositionRec)) { $totaltr = $totaltr + $objUCCompositionRec[$caste]; }
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="tr" class="uc-text uc-tr-text form-control uc_caste_<?= $key; ?> uc_tr_total_<?= $key; ?>" name="uc_tr_total_<?= $castename; ?>" id="uc_tr_total_<?= $key; ?>" value="<?php echo (is_array($objUCCompositionRec)?$objUCCompositionRec[$caste]:0); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-tr-sum" id="uc-tr-sum" value="<?php echo $totaltr; ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-tr-female" id="uc-tr-female" value="<?php echo et_setFormVal('b_uc_tr_female', $objUCCompositionRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-tr-male" id="uc-tr-male" value="<?php echo et_setFormVal('b_uc_tr_male', $objUCCompositionRec); ?>" /></td>
								</tr>
								<tr>
									<td>UC Members</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
										$castename = strtolower($caste);
										$caste = 'b_uc_mm_'.strtolower($caste);
										if(is_array($objUCCompositionRec)) { $totalmm = $totalmm + $objUCCompositionRec[$caste]; }
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="mem" class="uc-text uc-mem-text form-control uc_caste_<?= $key; ?> uc_mem_total_<?= $key; ?>" name="uc_mem_total_<?= $castename; ?>" id="uc_mem_total_<?= $key; ?>" value="<?php echo (is_array($objUCCompositionRec)?$objUCCompositionRec[$caste]:0); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-mm-sum" id="uc-mem-sum" value="<?php echo $totalmm; ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-mem-female" id="uc-mem-female" value="<?php echo et_setFormVal('b_uc_mm_female', $objUCCompositionRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-mem-male" id="uc-mem-male" value="<?php echo et_setFormVal('b_uc_mm_male', $objUCCompositionRec); ?>" /></td>
								</tr>
								<tr>
									<td>Total</td>
									<?php
									$total = 0;
									$total_sum = 0;
									$total_female = 0;
									$total_male = 0;
									
									$female_percent = 0;
									$male_percent = 0;
									if(is_array($objUCCompositionRec)) {
										$total_sum = $objUCCompositionRec['b_uc_cp_total'] + $objUCCompositionRec['b_uc_dy_total'] + $objUCCompositionRec['b_uc_sc_total'] + $objUCCompositionRec['b_uc_tr_total'] + $objUCCompositionRec['b_uc_mm_total'];
										$total_female = $objUCCompositionRec['b_uc_cp_female'] + $objUCCompositionRec['b_uc_dy_female'] + $objUCCompositionRec['b_uc_sc_female'] + $objUCCompositionRec['b_uc_tr_female'] + $objUCCompositionRec['b_uc_mm_female'];
										$total_male = $objUCCompositionRec['b_uc_cp_male'] + $objUCCompositionRec['b_uc_dy_male'] + $objUCCompositionRec['b_uc_sc_male'] + $objUCCompositionRec['b_uc_tr_male'] + $objUCCompositionRec['b_uc_mm_male'];
										if($total_sum > 0) {
											$female_percent = ($total_female/$total_sum) * 100;
											$male_percent = ($total_male/$total_sum) * 100;
										}
									}
									foreach ($casteGroup as $key => $caste) :
										if(is_array($objUCCompositionRec)) {
											$total = $objUCCompositionRec['b_uc_cp_'.strtolower($caste)] + $objUCCompositionRec['b_uc_dy_'.strtolower($caste)] + $objUCCompositionRec['b_uc_sc_'.strtolower($caste)] + $objUCCompositionRec['b_uc_tr_'.strtolower($caste)] + $objUCCompositionRec['b_uc_mm_'.strtolower($caste)];
										}
									?>
									<td><input type="text" readonly data-row="<?=$key; ?>" class="uc-text form-control uc_total_<?= $key; ?>" name="uc_total_<?= $key; ?>" id="uc_total_<?= $key; ?>" value="<?php echo $total; ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="form-control " name="uc-sum" id="uc-sum" value="<?php echo $total_sum; ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="uc-female" id="uc-female" value="<?php echo $total_female; ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="uc-male" id="uc-male" value="<?php echo $total_male; ?>" /></td>
								</tr>
								<tr>
								<td>%</td>
									<?php
									$total = 0;
									$percent = 0;
									foreach ($casteGroup as $key => $caste) :
										if(is_array($objUCCompositionRec)) {
											$total = $objUCCompositionRec['b_uc_cp_'.strtolower($caste)] + $objUCCompositionRec['b_uc_dy_'.strtolower($caste)] + $objUCCompositionRec['b_uc_sc_'.strtolower($caste)] + $objUCCompositionRec['b_uc_tr_'.strtolower($caste)] + $objUCCompositionRec['b_uc_mm_'.strtolower($caste)];
											if($total_sum > 0) {
												$percent = ($total/$total_sum) * 100;
											}
										}
									?>
									<td><input type="text" readonly data-row="<?=$key; ?>" class="uc-percent form-control uc_percent_<?= $key; ?>" name="uc_percent_<?= $key; ?>" id="uc_percent_<?= $key; ?>" value="<?php echo number_format($percent,2); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc_total_sum_percent form-control " name="uc_total_sum_percent" id="uc_total_sum_percent" value="<?php echo '100'; ?>" /></td>
									<td><input type="text" readonly class="uc_total_female_percent form-control " name="uc_total_female_percent" id="uc_total_female_percent" value="<?php echo number_format($female_percent,2); ?>" /></td>
									<td><input type="text" readonly class="uc_total_male_percent form-control " name="uc_total_male_percent" id="uc_total_male_percent" value="<?php echo number_format($male_percent,2); ?>" /></td>
								</tr>
								<tr>

									<th class="cost width center">Assessment By</th>
									<th><input type="text" class=" form-control " name="uc_assessment_by" id="uc_assessment_by" value="<?php echo et_setFormValBlank('b_uc_assessment_by', $objUCCompositionRec); ?>" /></th>
									<th>Assessment Date</th>
									<th class="">
									<div class="col-lg-12 datebox-container ">

										<div class="col-lg-12 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="uc_assessment_date" id="uc_assessment_date" value="<?php if (isset($objUCCompositionRec['b_uc_assessment_date']) && $objUCCompositionRec['b_uc_assessment_date'] != "0000-00-00") { echo et_setFormVal('b_uc_assessment_date', $objUCCompositionRec); } ?>" />

										</div>

										</div>
									</th>
									<th colspan="4"><input name="b_uc_status" id="b_uc_status" type="radio" value="1" <?php echo (is_array($objUCCompositionRec) && $objUCCompositionRec['b_uc_status'] == 1 ? "checked='checked'" : '');?>><label for="b_uc_status">Active</label></th>
									<input type="hidden" class="form-control" name="b_uc_id" id="b_uc_id" value="<?php echo et_setFormVal('b_uc_id',$objUCCompositionRec); ?>"/>								
								</tr>
								</tr>
							</table>

						</div>
					</div>
				</div>
			</div>

			<!-- Design -->
			<div class="tab-pane" id="Design">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
						Design (Desk Study)
						</h1>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-13">
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Bridge Type Selection</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_bri_type_check" id="bri_bri_type_check" value="1" <?php echo (et_setFormVal('bri_bri_type_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Cable Geometry</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_cable_geo_check" id="bri_cable_geo_check" value="1" <?php echo (et_setFormVal('bri_cable_geo_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Overall Design</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_overall_design_check" id="bri_overall_design_check" value="1" <?php echo (et_setFormVal('bri_overall_design_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Free Board (>= 5m)</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_free_board_check" id="bri_free_board_check" value="1" <?php echo (et_setFormVal('bri_free_board_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="design_site_assessment_by" id="design_site_assessment_by" value="<?php echo et_setFormValBlank('design_site_assessment_by', $objBridgeDesign); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Active</label>
								<div class="col-lg-4 ">
									<input name="design_active" id="design_active" type="radio" value="1" <?php echo ($objBridgeDesign && $objBridgeDesign['bri_design_status'] == 1)? 'checked="checked"':'';?>><label for="design_active">Active</label>
								</div>
							</div>
							

						</div>
						<div class="col-lg-6">

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Foundation Location</label>
								<div class="col-lg-2 ">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_foundation_check" id="bri_foundation_check" value="1" <?php echo (et_setFormVal('bri_foundation_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Environmental Consideration</label>
								<div class="col-lg-2">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_env_con_check" id="bri_env_con_check" value="1" <?php echo (et_setFormVal('bri_env_con_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Design Optimization</label>
								<div class="col-lg-2">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_design_opt_check" id="bri_design_opt_check" value="1" <?php echo (et_setFormVal('bri_design_opt_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment Date</label>

								<div class="col-lg-6 datebox-container ">

									<div class="col-lg-8 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="design_site_assessment_date" id="design_site_assessment_date" value="<?php if (isset($objBridgeDesign['design_site_assessment_date']) && $objBridgeDesign['design_site_assessment_date'] != "0000-00-00") {
																																					echo et_setFormVal('design_site_assessment_date', $objBridgeDesign);
																																				} ?>" />
									</div>

								</div>
							</div>


							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Remark</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="bri_design_remarks" id="bri_design_remarks" value="<?php echo et_setFormValBlank('bri_design_remarks', $objBridgeDesign); ?>" />
									<input type="hidden" class="form-control " name="bd_id" id="bd_id" value="<?php echo et_setFormVal('bd_id',$objBridgeDesign); ?>"/>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>

			<!-- Insurance -->
			<div class="tab-pane" id="Insurance">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
						Insurance
						</h1>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-13">
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Insurance Coverage</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_insurance_check" id="bri_insurance_check" value="1" <?php echo (et_setFormVal('bri_insurance_check', $objBridgeInsurance) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group clearfix ">
					<label class="col-lg-2 ">Insurance Expiry Date</label>
					<div class="col-lg-6 datebox-container ">
						<div class="col-lg-4 nopad datetimepicker input-group date ">
							<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
							<input type="text" class=" form-control " name="insurance_exp_date" id="insurance_exp_date" value="<?php if (isset($objBridgeInsurance['insurance_exp_date']) && $objBridgeInsurance['insurance_exp_date'] != "0000-00-00") {
																																		echo et_setFormVal('insurance_exp_date', $objBridgeInsurance);
																																	} ?>" />
						</div>
					</div>
				</div>
				<input type="hidden" class="form-control " name="bi_id" id="bi_id" value="<?php echo et_setFormVal('bi_id',$objBridgeInsurance); ?>"/>
			</div>

			<!-- Sign Board -->
			<div class="tab-pane" id="Sign_Board">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
						Sign Board
						</h1>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-13">
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Sign Board</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="sign_board_check" id="sign_board_check" value="1" <?php echo (et_setFormVal('sign_board_check', $objBridgeSignBoard) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group clearfix ">
					<label class="col-lg-2 ">Date</label>
					<div class="col-lg-6 datebox-container ">
						<div class="col-lg-4 nopad datetimepicker input-group date ">
							<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
							<input type="text" class=" form-control " name="sign_board_date" id="sign_board_date" value="<?php if (isset($objBridgeSignBoard['sign_board_date']) && $objBridgeSignBoard['sign_board_date'] != "0000-00-00") {
																																		echo et_setFormVal('sign_board_date', $objBridgeSignBoard);
																																	} ?>" />
						</div>
						<input type="hidden" class="form-control " name="bsb_id" id="bsb_id" value="<?php echo et_setFormVal('bsb_id',$objBridgeSignBoard); ?>"/>
					</div>
				</div>

			</div>

			<!-- Steel Parts -->
			<div class="tab-pane" id="Steel_Parts">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
						Quality of Fabricated Steel Parts (Factory Visit)
						</h1>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-13">
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Quality of finished steel parts</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_quality_steel_check" id="bri_quality_steel_check" value="1" <?php echo (et_setFormVal('bri_quality_steel_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Manufacturer maintains QA documentation</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_qa_document_check" id="bri_qa_document_check" value="1" <?php echo (et_setFormVal('bri_qa_document_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Welding appears professionally done</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_welding_check" id="bri_welding_check" value="1" <?php echo (et_setFormVal('bri_welding_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Zinc coating checked positively</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_zinc_coating_check" id="bri_zinc_coating_check" value="1" <?php echo (et_setFormVal('bri_zinc_coating_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>							

						</div>
						<div class="col-lg-6">

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="factory_visit_assessment_by" id="factory_visit_assessment_by" value="<?php echo et_setFormValBlank('factory_visit_assessment_by', $objBridgeSteelParts); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment Date</label>
								<div class="col-lg-6 datebox-container ">
									<div class="col-lg-8 nopad datetimepicker input-group date ">
										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										<input type="text" class=" form-control " name="factory_visit_assessment_date" id="factory_visit_assessment_date" value="<?php if (isset($objBridgeSteelParts['factory_visit_assessment_date']) && $objBridgeSteelParts['factory_visit_assessment_date'] != "0000-00-00") {
																																					echo et_setFormVal('factory_visit_assessment_date', $objBridgeSteelParts);
																																				} ?>" />
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Remark</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="factory_visit_remarks" id="factory_visit_remarks" value="<?php echo et_setFormValBlank('factory_visit_remarks', $objBridgeSteelParts); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Active</label>
								<div class="col-lg-4 ">
									<input name="factory_visit_active" id="factory_visit_active" type="radio" value="1" <?php echo ($objBridgeSteelParts && $objBridgeSteelParts['factory_visit_active'] == 1)? 'checked="checked"':'';?>><label for="factory_visit_active">Active</label>
								</div>
							</div>
							<input type="hidden" class="form-control " name="bsp_id" id="bsp_id" value="<?php echo et_setFormVal('bsp_id',$objBridgeSteelParts); ?>"/>
						</div>
					</div>
				</div>
			</div>

			<!-- Construction Work -->
			<div class="tab-pane" id="Construction_Work">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
						Quality of Civil Works and Cable Sag (Site Visit)
						</h1>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-13">
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Cross Check the quality of stones/aggregate/sand</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_quality_steel_check" id="bri_quality_steel_check" value="1" <?php echo (et_setFormVal('bri_quality_steel_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Verify Concreting of Drum</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_qa_document_check" id="bri_qa_document_check" value="1" <?php echo (et_setFormVal('bri_qa_document_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Bulldog Grips</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_welding_check" id="bri_welding_check" value="1" <?php echo (et_setFormVal('bri_welding_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Workmanship(General)</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_zinc_coating_check" id="bri_zinc_coating_check" value="1" <?php echo (et_setFormVal('bri_zinc_coating_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>	
							
							<div class="form-group clearfix">
								<label class="col-lg-6 ">Dry stone masonry for dead load</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_zinc_coating_check" id="bri_zinc_coating_check" value="1" <?php echo (et_setFormVal('bri_zinc_coating_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>	

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Verify Concreting of Anchorage/Foundation Block</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_zinc_coating_check" id="bri_zinc_coating_check" value="1" <?php echo (et_setFormVal('bri_zinc_coating_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>	

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Tower (N Types only)</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_zinc_coating_check" id="bri_zinc_coating_check" value="1" <?php echo (et_setFormVal('bri_zinc_coating_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>	

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Cement</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_zinc_coating_check" id="bri_zinc_coating_check" value="1" <?php echo (et_setFormVal('bri_zinc_coating_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>	

						</div>
						<div class="col-lg-6">

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="factory_visit_assessment_by" id="factory_visit_assessment_by" value="<?php echo et_setFormValBlank('factory_visit_assessment_by', $objBridgeSteelParts); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment Date</label>
								<div class="col-lg-6 datebox-container ">
									<div class="col-lg-8 nopad datetimepicker input-group date ">
										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										<input type="text" class=" form-control " name="factory_visit_assessment_date" id="factory_visit_assessment_date" value="<?php if (isset($objBridgeSteelParts['factory_visit_assessment_date']) && $objBridgeSteelParts['factory_visit_assessment_date'] != "0000-00-00") {
																																					echo et_setFormVal('factory_visit_assessment_date', $objBridgeSteelParts);
																																				} ?>" />
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Remark</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="factory_visit_remarks" id="factory_visit_remarks" value="<?php echo et_setFormValBlank('factory_visit_remarks', $objBridgeSteelParts); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Active</label>
								<div class="col-lg-4 ">
									<input name="factory_visit_active" id="factory_visit_active" type="radio" value="1" <?php echo ($objBridgeSteelParts && $objBridgeSteelParts['factory_visit_active'] == 1)? 'checked="checked"':'';?>><label for="factory_visit_active">Active</label>
								</div>
							</div>
							<input type="hidden" class="form-control " name="bsp_id" id="bsp_id" value="<?php echo et_setFormVal('bsp_id',$objBridgeSteelParts); ?>"/>
						</div>
					</div>
				</div>
			</div>

			<!-- Cost Estimate -->
			<div class="tab-pane" id="Estimated_Cost">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header font">
						Cost Estimate (Desk Study)
						</h1>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-lg-13">
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Implementation Approach</label>
								<div class="col-lg-2 ">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_impl_approach_check" id="bri_impl_approach_check" value="1" <?php echo (et_setFormVal('bri_impl_approach_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Unit Rates of Steel Parts</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_unit_rates_steel_check" id="bri_unit_rates_steel_check" value="1" <?php echo (et_setFormVal('bri_unit_rates_steel_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Unit Rates (portering, Labor, Cement etc)</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_unit_rates_check" id="bri_unit_rates_check" value="1" <?php echo (et_setFormVal('bri_unit_rates_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-6 ">Portering distance</label>
								<div class="col-lg-2">
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_portering_dis_check" id="bri_portering_dis_check" value="1" <?php echo (et_setFormVal('bri_portering_dis_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
								</div>
							</div>							

						</div>
						<div class="col-lg-6">

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="cost_est_site_assessment_by" id="cost_est_site_assessment_by" value="<?php echo et_setFormValBlank('cost_est_site_assessment_by', $objCostEstimate); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment Date</label>
								<div class="col-lg-6 datebox-container ">
									<div class="col-lg-8 nopad datetimepicker input-group date ">
										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										<input type="text" class=" form-control " name="cost_est_site_assessment_date" id="cost_est_site_assessment_date" value="<?php if (isset($objCostEstimate['cost_est_site_assessment_date']) && $objCostEstimate['cost_est_site_assessment_date'] != "0000-00-00") {
																																					echo et_setFormVal('cost_est_site_assessment_date', $objCostEstimate);
																																				} ?>" />
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Remark</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="cost_est_remarks" id="cost_est_remarks" value="<?php echo et_setFormValBlank('cost_est_remarks', $objCostEstimate); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Active</label>
								<div class="col-lg-4 ">
									<input name="cost_est_active" id="cost_est_active" type="radio" value="1" <?php echo ($objCostEstimate && $objCostEstimate['cost_est_active'] == 1)? 'checked="checked"':'';?>><label for="design_active">Active</label>
								</div>
							</div>
							<input type="hidden" class="form-control " name="bce_id" id="bce_id" value="<?php echo et_setFormVal('bce_id',$objCostEstimate); ?>"/>

						</div>
					</div>
				</div>

			</div>

			<!-- Public Audit -->
			<div class="tab-pane" id="Public_Audit">

				<!--/.row-->

				<div class="row">

					<div class="col-lg-12">

						<u>
							<h1 class="page-header font">

								Participants during Public Audit

							</h1>
						</u>

					</div>

				</div>

				<!-- /.row -->
				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="form-group clearfix ">
							
							<table class="table table-bordered table-hover">
								<tr>
									<td rowspan="2">Total</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td rowspan="2"><?= $caste ?></td>
									<?php endforeach; ?>
									<td colspan="3">Total</td>
								</tr>
								<tr>
									<td>Sum</td>
									<td>Female</td>
									<td>Male</td>
								</tr>
								
									<tr>
										<td>Members from community</td>
										<?php
										foreach ($casteGroup as $key => $caste) :
											$caste = strtolower($caste).'_total';
										?>
										<td><input type="text" data-row="<?=$key; ?>" class="pa-text form-control pa_total_<?= $key; ?>" name="pa_<?=strtolower($caste); ?>" id="pa_total_<?= $key; ?>" value="<?php echo (is_array($objPublicAudit)?$objPublicAudit[$caste]:0); ?>" /></td>
										<?php endforeach; ?>										
										<td><input type="text" readonly class=" pa-sum form-control " name="pa-sum" id="pa-sum" value="<?php echo et_setFormVal('pa_sum', $objPublicAudit); ?>" /></td>
										<td><input type="text" class=" pa-female form-control " name="pa-female" id="pa-female" value="<?php echo et_setFormVal('pa_female', $objPublicAudit); ?>" /></td>
										<td><input type="text" class=" pa-male form-control " name="pa-male" id="pa-male" value="<?php echo et_setFormVal('pa_male', $objPublicAudit); ?>" /></td>
									</tr>
								<tr>
									<td>Total %</td>
									<?php
										foreach ($casteGroup as $key => $caste) :
											$castename = strtolower($caste);
											$caste = strtolower($caste).'_percent';
										?>
										<td><input type="text" readonly class="total_caste_percent total_pa_caste_percent form-control " name="total_pa_caste_percent_<?=$castename;?>" id="total_pa_caste_percent_<?=$key;?>" value="<?php echo (is_array($objPublicAudit)?$objPublicAudit[$caste]:0); ?>" /></td>
										<?php endforeach; ?>
									
										<td><input type="text" readonly class="total_sum_percent total_pa_sum_percent form-control " name="total_sum_percent_pa" id="total_sum_percent_pa" value="<?php echo et_setFormVal('pa_sum_percent', $objPublicAudit); ?>" /></td>
										<td><input type="text" class="total_female_percent form-control " name="total_female_percent_pa" id="total_female_percent_pa" value="<?php echo et_setFormVal('pa_female_percent', $objPublicAudit); ?>" /></td>
										<td><input type="text" class="total_male_percent form-control " name="total_male_percent_pa" id="total_male_percent_pa" value="<?php echo et_setFormVal('pa_male_percent', $objPublicAudit); ?>" /></td>

								</tr>
								
								<tr>

									<th class="cost width center">Assessment By</th>
									<th><input type="text" class=" form-control " name="pa_assessment_by" id="pa_assessment_by" value="<?php echo et_setFormValBlank('pa_assessment_by', $objPublicAudit); ?>" /></th>
									<th>Assessment Date</th>
									<th class="">
									<div class="col-lg-12 datebox-container ">

										<div class="col-lg-12 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="pa_assessment_date" id="pa_assessment_date" value="<?php if (isset($objPublicAudit['pa_assessment_date']) && $objPublicAudit['pa_assessment_date'] != "0000-00-00") {
																																						echo et_setFormVal('pa_assessment_date', $objPublicAudit);
																																					} ?>" />

										</div>

										</div>
									</th>
									<th colspan="2"><input name="pa_status" id="pa_status" type="radio" value="1" <?php echo ($objPublicAudit && $objPublicAudit['pa_status'] == 1)? 'checked="checked"':'';?>><label for="pa_status">Active</label></th>
									<input type="hidden" class="form-control " name="pa_id" id="pa_id" value="<?php echo et_setFormVal('pa_id',$objPublicAudit); ?>"/>
								</tr>
							</table>

						</div>


					</div>
				</div>
			</div>

			<div class="tab-pane" id="Employment_Generation">

				<div class="row">
					<div class="col-lg-12">
						<u>
							<h1 class="page-header font">
								Local Employment Generation

							</h1>
						</u>
					</div>
				</div>

				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="form-group clearfix ">
							
							<table class="table table-bordered table-hover">
								<tr>
									<td>Cast/Ethinicity</td>
									<td>Women</td>
									<td>Men</td>
									<td>Poor</td>
									<td>Total</td>
								</tr>
								<?php
								$grand_total = 0;
								$total_percent = 0;
								$total = 0;
								if(is_array($objEmploymentGeneration)) {
									// $grand_total = $objEmploymentGeneration['beg_total_women'] + $objEmploymentGeneration['beg_total_men'] + $objEmploymentGeneration['beg_total_poor'];
									// $total_percent = $objEmploymentGeneration['beg_percent_women'] + $objEmploymentGeneration['beg_percent_men'] + $objEmploymentGeneration['beg_percent_poor'];
									$total_percent = '100';
								}
			
								foreach ($bctcasteGroup as $key => $caste) :
									$beg_caste = 'beg_'.strtolower($caste);
									$disabled_m = '';
									$disabled_f = '';
									if(strtolower($caste) == "bct_m") {
										$disabled_f = "disabled";
										$caste = "BCT (Male)";
									} elseif(strtolower($caste) == "bct_f") {
										$disabled_m = "disabled";
										$caste = "BCT (Female)";
									}
									if(is_array($objEmploymentGeneration)) { 
										// $total = $objEmploymentGeneration[$beg_caste.'_women'] + $objEmploymentGeneration[$beg_caste.'_men'] + $objEmploymentGeneration[$beg_caste.'_poor']; 
										if(strtolower($caste) == "bct_m") {
										$total = $objEmploymentGeneration[$beg_caste.'_men']; 
										} elseif(strtolower($caste) == "bct_f") {
										$total = $objEmploymentGeneration[$beg_caste.'_women']; 
										} else {
											$total = $objEmploymentGeneration[$beg_caste.'_women'] + $objEmploymentGeneration[$beg_caste.'_men'];
										}
										
										$grand_total = $grand_total + $total;

									}
								?>
									<tr>
										<td><?= $caste ?></td>
										<td><input type="text" data-row="<?=$key; ?>" <?=$disabled_f;?> class="eg-text eg_women form-control eg_women_<?= $key; ?>" name="<?= $beg_caste; ?>_women" id="eg_women_<?= $key; ?>" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration[$beg_caste.'_women']:0); ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" <?=$disabled_m;?> <?php echo (strtolower($caste) == "bct_f") ? 'disabled':'';?> class="eg-text eg_men form-control eg_men_<?= $key; ?>" name="<?= $beg_caste; ?>_men" id="eg_men_<?= $key; ?>" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration[$beg_caste.'_men']:0); ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" class="eg-text eg_poor form-control eg_poor_<?= $key; ?>" name="<?= $beg_caste; ?>_poor" id="eg_poor_<?= $key; ?>" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration[$beg_caste.'_poor']:0); ?>" /></td>
										<td><input type="text" readonly data-row="<?=$key; ?>" data-col="" class="eg_sub_total eg_sub_total_<?= $key; ?> form-control " name="eg_sub_total_<?= $key; ?>" id="eg_sub_total_<?= $key; ?>" value="<?php echo $total; ?>" /></td>
									</tr>
								<?php endforeach; ?>
								<tr>
									<td>Total</td>
									<td><input type="text" readonly class="eg-total form-control " name="eg_women_total" id="eg_women_total" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration['beg_total_women']:0); ?>" /></td>
									<td><input type="text" readonly class="eg-total form-control " name="eg_men_total" id="eg_men_total" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration['beg_total_men']:0); ?>" /></td>
									<td><input type="text" readonly class="eg-total form-control " name="eg_poor" id="eg_poor_total" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration['beg_total_poor']:0); ?>" /></td>
									<td><input type="text" readonly class="form-control " name="eg_grand_total" id="eg_grand_total" value="<?php echo $grand_total; ?>" /></td>
								</tr>
								<tr>
									<td>%</td>
									<td><input type="text" readonly class=" form-control " name="eg_women_percent" id="eg_women_percent" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration['beg_percent_women']:0); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="eg_men_percent" id="eg_men_percent" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration['beg_percent_men']:0); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="eg_poor_percent" id="eg_poor_percent" value="<?php echo (is_array($objEmploymentGeneration) ? $objEmploymentGeneration['beg_percent_poor']:0); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="eg_grand_percent" id="eg_grand_percent" value="<?php echo $total_percent; ?>" /></td>
								</tr>
							</table>

						</div>
						<input type="hidden" class="form-control " name="beg_id" id="beg_id" value="<?php echo et_setFormVal('beg_id',$objEmploymentGeneration); ?>"/>

					</div>
				</div>
				<!-- /.row -->



			</div>
			<!----end fifth Bridge---->
			<script type="text/javascript">
				$(document).ready(function() {
					//iterate through each textboxes and add keyup
					//uc composition
					$(".uc-text").each(function() {
						$(this).keyup(function() {
							rowId = $(this).data('row');
							colId = $(this).data('col');
							total_cp = sumNum('.uc-'+colId+'-text');
							$("#uc-"+colId+"-sum").val(total_cp);
							total = sumNum('.uc_caste_'+rowId);
							$(".uc_total_"+rowId).val(total)
							// total_sum = sumNum('.uc-sum');
							// $("#uc-sum").val(total_sum);
							//total sum
							total_sum = sumNum('.uc-sum');
							$("#uc-sum").val(total_sum);
							//total female
							total_female = sumNum('.uc-female');
							$("#uc-female").val(total_female);
							//total male
							total_male = sumNum('.uc-male');
							$("#uc-male").val(total_male);
							//total percentage
							calculateUcPercent($(this));
							$("#uc_total_sum_percent").val(100);
							total_female_percent = ($('#uc-female').val()/$('#uc-sum').val())*100;
							total_male_percent = ($('#uc-male').val()/$('#uc-sum').val())*100;
							$('#uc_total_female_percent').val(total_female_percent.toFixed(2));
							$('#uc_total_male_percent').val(total_male_percent.toFixed(2));
						});
					});
					
					//handler to trigger sum event
					$(".ph-text").each(function() {
						$(this).keyup(function() {
							total_members_community = sumNum('.ph-text');
							$(".ph-sum").val(total_members_community);
							calculatePublicSum($(this));
							total_caste_percent = sumPercent(".total_caste_percent");
							$(".total_sum_percent").val(total_caste_percent);
							//calculate percent
							//reCalc();
						});
					});
					$(".ph-female").keyup(function() {
						var phtotal = $(this).val();
						if (!isNaN(phtotal) && phtotal.length != 0) {
							var percent_total = (phtotal/$("#ph-sum").val()) * 100;
							$("#total_female_percent").val(percent_total.toFixed(2));
						}
					});
					$(".ph-male").keyup(function() {
						var phtotal = $(this).val();
						if (!isNaN(phtotal) && phtotal.length != 0) {
							var percent_total = (phtotal/$("#ph-sum").val()) * 100;
							$("#total_male_percent").val(percent_total.toFixed(2));
						}
					});

					//public audit
					$(".pa-text").each(function() {
						$(this).keyup(function() {
							total_members_community = sumNum('.pa-text');
							$(".pa-sum").val(total_members_community);
							calculatePublicSum($(this),'','pa');
							total_caste_percent = sumPercent(".total_pa_caste_percent");
							$(".total_pa_sum_percent").val(total_caste_percent);
							//calculate percent
							//reCalc();
						});
					});
					$(".pa-female").keyup(function() {
						var phtotal = $(this).val();
						if (!isNaN(phtotal) && phtotal.length != 0) {
							var percent_total = (phtotal/$("#pa-sum").val()) * 100;
							$("#total_female_percent_pa").val(percent_total.toFixed(2));
						}
					});
					$(".pa-male").keyup(function() {
						var phtotal = $(this).val();
						if (!isNaN(phtotal) && phtotal.length != 0) {
							var percent_total = (phtotal/$("#pa-sum").val()) * 100;
							$("#total_male_percent_pa").val(percent_total.toFixed(2));
						}
					});

					//employment generation
					$(".eg-text").each(function() {
						$(this).keyup(function() {
							rowId = $(this).data('row');
						//calculate sub-total
						const eg_women = parseInt($(".eg_women_"+rowId).val());
						const eg_men = parseInt($(".eg_men_"+rowId).val());
						const eg_poor = parseInt($(".eg_poor_"+rowId).val());

						//console.log(bc_men);
						var sub_total = parseInt(eg_women+eg_men);
						$('.eg_sub_total_' + rowId).val(sub_total);
						
						// var bc_total = sumNum('.bc_total').toFixed(2);
						//const eg_sub_total = sumNum('.eg-total');
						const eg_sub_total = sumNum('.eg_sub_total'); 
						const eg_poor_total = sumNum('.eg_poor');
						const eg_women_total = sumNum('.eg_women');
						const eg_men_total = sumNum('.eg_men');
						const percent_poor = (eg_poor_total/eg_sub_total) * 100;
						const percent_women = (eg_women_total/eg_sub_total) * 100;
						const percent_men = (eg_men_total/eg_sub_total) * 100;
						//const percent_total = (parseInt($('#total_no_households').val()) / parseInt($("#grand_total").val())) * 100;
						
						$('#eg_poor_total').val(eg_poor_total);
						$('#eg_women_total').val(eg_women_total);
						$('#eg_men_total').val(eg_men_total);
						$('#eg_grand_total').val(eg_sub_total);
							
						$('#eg_women_percent').val(percent_women.toFixed(2));	
						$('#eg_men_percent').val(percent_men.toFixed(2));
						$('#eg_poor_percent').val(percent_poor.toFixed(2));		
						$('#eg_grand_percent').val("100.00");	
						});
					});

					//beneficiaries composition
					$(".bc-text").each(function() {
						$(this).keyup(function() {
							calculateSum($(this));
							//calculate grand total
							//calculate percent
							//reCalc();
						});
					});
					function calculateSum($obj, $strRef='') {
						//colId = $obj.data('col');
						rowId = $obj.data('row');
						//calculate sub-total
						const bc_women = parseInt($(".bc_women_"+rowId).val());
						const bc_men = parseInt($(".bc_men_"+rowId).val());
						//var bc_total_col = parseFloat($(".bc_total_"+rowId).value());
						//console.log(bc_women);
						//console.log(bc_men);
						var sub_total = parseInt(bc_women+bc_men);
						$('.bc_sub_total_' + rowId).val(sub_total);
						
						// var bc_total = sumNum('.bc_total').toFixed(2);
						const bc_total = sumNum('.bc_total');
						const bc_poor = sumNum('.bc_poor');
						const bc_women_no = sumNum('.bc_women');
						const bc_men_no = sumNum('.bc_men');
						const bc_sub_total = sumNum('.bc_sub_total');
						const percent_poor = (bc_poor/bc_total) * 100;
						const percent_women = (bc_women_no/bc_sub_total) * 100;
						const percent_men = (bc_men_no/bc_sub_total) * 100;
						// const percent_total = (parseInt($('#total_no_households').val()) / parseInt($("#grand_total").val())) * 100;
						const percent_total = parseFloat($('#bp_women_percent').val()) + parseFloat($('#bp_men_percent').val());
						
						$('#total_no_households').val(bc_total);
						$('#total_no_households_poor').val(bc_poor);
						$('#bp_women_total').val(bc_women_no);
						$('#bp_men_total').val(bc_men_no);
						$('#grand_total').val(bc_sub_total);
						$('#percent_no_households').val("100");	
						$('#percent_no_households_poor').val(percent_poor.toFixed(2));	
						$('#bp_women_percent').val(percent_women.toFixed(2));	
						$('#bp_men_percent').val(percent_men.toFixed(2));		
						//$('#grand_percent').val(percent_total.toFixed(2));										
						$('#grand_percent').val(percent_total.toFixed(2));	

						//x = sumNum('.' + $strRef + 'Amt.' + colId).toFixed(2);
						//$('.' + $strRef + 'Total.' + colId).html(x);
					}
					function sumNum($selector) {
						sum = 0;
						$($selector).each(function() {
							//add only if the value is number
							const selected = parseInt(this.value);
							if (!isNaN(selected) && selected.length != 0) {
								sum += parseInt(selected);
							}
						});
						return sum;
					}
					function sumPercent($selector) {
						sum = 0;
						$($selector).each(function() {
							//add only if the value is number
							const selected = parseFloat(this.value);
							if (!isNaN(selected) && selected.length != 0) {
								sum += parseFloat(selected);
							}
						});
						return sum.toFixed(2);
					}

					function calculatePublicSum($obj, $strRef='', classref = 'ph') {
						//colId = $obj.data('col');
						rowId = $obj.data('row');											
						$("."+classref+"-text").each(function() {
							id = $(this).data('row');
							const ph_total = $("#"+classref+"_total_"+id).val();
							const ph_sum = $("#"+classref+"-sum").val();
							const total_caste_percent = (ph_total/ph_sum) * 100;
							$("#total_"+classref+"_caste_percent_"+id).val(total_caste_percent.toFixed(2));
						});
					}
					function calculateUcPercent($obj, $strRef='') {
						//colId = $obj.data('col');
						rowId = $obj.data('row');											
						$(".uc-percent").each(function() {
							rowId = $(this).data('row');
							uc_sum = $("#uc-sum").val();
							uc_total = $("#uc_total_"+rowId).val();
							uc_percent = (uc_total/uc_sum) * 100;
							$("#uc_percent_"+rowId).val(uc_percent.toFixed(2));
						});
					}
				});
			</script>


			<!----start six Bridge---->



			<div class="tab-pane" id="Actual_Cost">

				<!--/.row-->

				<div class="row">

					<h3 class="form-group" style="text-align:center;">contribution of agencies</h3>

					<div class="col-lg-12 ">
					</div>

				</div>

				<!-- /.row -->
				<!-- /.row -->
				<!-- /.row -->

			</div>

			<!----end six Bridge---->

		</div>
		<div class="row add_form_btn">
			<?php $valDisable = ($objOldRec && $objOldRec['bri03id'] != '') ? "readonly" : " "; ?>
			<input type="button" name="cmd_Submit" class="btn btn-md btn-success btnDisableNSave" value="Save and Close">
			<input type="button" name="cmd_Submit" class="btn btn-md btn-primary btnDisableNSave" value="Save">
			<input type="hidden" name="cmdSubmit" value="" class="tgSubmit">
			<a href="<?php echo site_url(); ?>bridge" class="btn btn-md btn-danger">Close</a>
		</div>


		</form>

	</div> <!-- /.container-fluid -->


</div>

<script type="text/javascript">
	$(document).ready(function()

		{

			$('.tabHeads li a').click(function(e) {

				e.preventDefault()

				$(this).tab('show')

			})

		});
</script>

<script type="text/javascript">
	$(document).ready(function()

		{

			$('.tabHeads li a').click(function(e) {

				e.preventDefault()

				$(this).tab('show')

			})

		});
</script>

<script type="text/javascript">
	$(document).ready(function()

		{

			$('.tabHeads li a').click(function(e) {

				e.preventDefault()

				$(this).tab('show')

			})

		});
</script>
<script>
	$(document).ready(function() {
		//iterate through each textboxes and add keyup

		//handler to trigger sum event

		// $(".bc-text").each(function() {

		// 	$(this).keyup(function() {

		// 		calculateSum1($(this), 'Estimated');
		// 		//calculate grand total
		// 		//calculate percent
		// 		reCalc();
		// 	});

		// });

		$(".ContributionAmt").each(function() {



			$(this).keyup(function() {

				calculateSum1($(this), 'Contribution');
				reCalc();

			});

		});

	});

	// function sumNum($selector) {

	// 	sum = 0;

	// 	$($selector).each(function() {

	// 		//add only if the value is number
	// 		if (!isNaN(this.value) && this.value.length != 0) {

	// 			sum += parseFloat(this.value);

	// 		}

	// 	});
	// 	console.log($selector);
	// 	console.log(sum);

	// 	return sum;



	// }

	// function calculateSum1($obj, $strRef) {

	// 	colId = $obj.data('col');

	// 	rowId = $obj.data('row');

	// 	x = sumNum('.' + $strRef + 'Amt.' + colId).toFixed(2);

	// 	y = sumNum('.' + $strRef + 'Amt.' + rowId).toFixed(2);

	// 	$('.' + $strRef + 'Total.' + colId).html(x);

	// 	$('.' + $strRef + 'Total.' + rowId).html(y);

	// 	}

	// function calculateSum() {

	// 	return;

	// }
</script>

<script>
	$arrVDCList = <?php echo json_encode($arrVDCList); ?>;
	$fcase = <?php echo ($objOldRec && $objOldRec['bri03id'] != '') ? 1 : 0; ?>;
	//$lVDCID = <?php // echo (property_exists($objOldRec, 'bri03municipality_lb') && $objOldRec['bri03municipality_lb'] =='')? 1: 0  ;
				?>;
	//$rVDCID = <?php // echo (property_exists($objOldRec, 'bri03municipality_rb') && $objOldRec['bri03municipality_rb'] =='')? 1: 0  ;
				?>;
	$lVDCID = <?php echo ($objOldRec && $objOldRec['bri03municipality_lb'] != '') ? $objOldRec['bri03municipality_lb'] : 0; ?>;
	$rVDCID = <?php echo ($objOldRec && $objOldRec['bri03municipality_rb'] != '') ? $objOldRec['bri03municipality_rb'] : 0; ?>;

	function popCombo($strTarget, $arrList, $strBind, $strDisp, $strSel) {

		$strRet = '';

		$.each($arrList, function() {

			$strRet += '<option value="' + this[$strBind] + '">' + this[$strDisp] + '</option>';

		});

		$($strTarget).append($strRet);

	}

	function onChangeDistrict($targetObj, $srcSelDist) {

		items = $arrVDCList.filter(function(item) {

			return (item.dist01id == $srcSelDist);

		});

		$($targetObj).html('');

		popCombo($targetObj, items, 'muni01id', 'muni01name');

	}

	$('.onChangeDist').on('change', function() {

		$target = $(this).data('targetvdc');

		onChangeDistrict($target, $(this).val());

	})

	//$arrDistList = <?php echo ''; ?>;

	$(document).ready(function() {

		//$("input").val(document.getElementById("bri03id").innerHTML);

		$('#bri03bridge_name').on('change', function() {

			$('.bri03disp_name').val($(this).val());

		});

		//$('.onChangeDist').trigger('change');
		if ($fcase == 1) {
			$('#bri03municipality_lb').val($lVDCID);
			$('#bri03municipality_rb').val($rVDCID);
		} else {}



	});



	$(document).ready(function() {

		$('.datebox-container .checkPad input').on('change', function() {

			if ($(this).is(":checked")) {

				$target = $(this).closest('.datebox-container');

				$target.find('.date input').val('<?php echo _day(); ?>');

			} else {
				$target = $(this).closest('.datebox-container');

				$target.find('.date input').val('');
			}

		})

	});
</script>
<script type="text/javascript">
	$(document).ready(function() {

		$('.btnDisableNSave').on('click', function(e) {
			$(this).attr('readonly', 'readonly');
			$('.tgSubmit').val($(this).attr('value'));
			$(this).closest('form').submit();
		});
		$('[autofocus]:not(:focus)').eq(0).focus();

		$('#emp-form').validate({
			rules: {
				EstimatedAmt: {
					number: true,
					maxlength: 10
				},
				ContributionAmt: {
					required: true,
					maxlength: 10
				},
				bri03e_span: {
					number: true,
					maxlength: 10
				},


			},
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element.addClass('valid').closest('.form-group').removeClass('error');
			}
		});



	});
</script>
<?= $this->endSection() ?>