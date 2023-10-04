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

										'',

										'class="form-control onChangeDist" data-targetvdc="#bri03municipality_lb" ' . $valDisableDist . ' ',
										array('SortBy' => 'dist01name')
									) ?>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-5">Municipality Left Bank</label>
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

								<label class="col-lg-5 ">Fiscal Year</label>

								<div class="col-lg-7 ">
									<?php
									$valDisableFy = "";
									// if (isset($objOldRec['bri03id']) && $objOldRec['bri03id'] != '') {
									// 	if ($is_admin == 0) {
									// 		$valDisableFy = "readonly";
									// 	} else {
									// 		$valDisableFy = "";
									// 	}
									// } else {
									// 	$valDisableFy = "";
									// }

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

									<?php echo et_form_dropdown_db('bri03physical_progress', 'physical_progress_types', 'pp_name', 'pp_id', et_setFormVal('bri03physical_progress', $objOldRec), array('0'=>array('pp_status','where','1')), 'class="form-control"') ?>

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

									<?php echo et_form_dropdown_db_dist('bri03district_name_rb', 'dist01district', 'dist01name', 'dist01id', et_setFormVal('bri03district_name_rb', $objOldRec), '', 'class="form-control onChangeDist" data-targetvdc="#bri03municipality_rb" ' . $valDisableDist . '', array('SortBy' => 'dist01name')) ?>

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

									<?php echo et_form_dropdown_db('bri03supporting_agency', 'sup03basic_supporting_agency', 'sup03sup_agency_name', 'sup03id', et_setFormVal('bri03supporting_agency', $objOldRec), array('0'=>array('status','where','1')), 'class="form-control"', array('SortBy'=> 'sup03index')) ?>

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

								<label class="col-lg-5 ">River Type (No. of months can be crossed)</label>

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
					<div class="col-lg-12">
						
					<table class="table table-bordered table-hover">
								<tr>
									<td>S.No.</td>
									<td>Issues</td>
									<td>Acceptable</td>
									<td width="60">&nbsp;</td>
									<td>Deficiency</td>
									<td>Remedial Action</td>
								</tr>
								<tr>
									<td>1</td>
									<td colspan="5">Stability of the bank/slopes</td>
								</tr>
								<tr>
									<td rowspan="2">1.1</td>
									<td rowspan="2">In case of soil</td>
									<td>No sign of erosion/slides</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_stability" id="bsa_stability" value="1" <?php echo (et_setFormVal('bsa_stability', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_stability_def" size="20" value="<?=et_setFormValBlank('bsa_stability_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_stability_remark" size="60" value="<?=et_setFormValBlank('bsa_stability_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>Far from confluence</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_stability_soil_conf" id="bsa_stability_soil_conf" value="1" <?php echo (et_setFormVal('bsa_stability_soil_conf', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_stability_soil_conf_def" size="20" value="<?=et_setFormValBlank('bsa_stability_soil_conf_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_stability_soil_conf_remark" size="60" value="<?=et_setFormValBlank('bsa_stability_soil_conf_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td rowspan="2">1.2</td>
									<td rowspan="2">In case of rock</td>
									<td>Bedding plane subparallel/opposite to the slope</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_stability_rock_bed" id="bsa_stability_rock_bed" value="1" <?php echo (et_setFormVal('bsa_stability_rock_bed', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_stability_rock_bed_def" size="20" value="<?=et_setFormValBlank('bsa_stability_rock_bed_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_stability_rock_bed_remark" size="60" value="<?=et_setFormValBlank('bsa_stability_rock_bed_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>No sign of wedge/toppling tailor</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_stability_rock_wedge" id="bsa_stability_rock_wedge" value="1" <?php echo (et_setFormVal('bsa_stability_rock_wedge', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_stability_rock_wedge_def" size="20" value="<?=et_setFormValBlank('bsa_stability_rock_wedge_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_stability_rock_wedge_remark" size="60" value="<?=et_setFormValBlank('bsa_stability_rock_wedge_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>2</td>
									<td>Influencing rivulet</td>
									<td>No nearby rivulets</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_influencing_rivulet" id="bsa_influencing_rivulet" value="1" <?php echo (et_setFormVal('bsa_influencing_rivulet', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bsa_rivulet_def" size="20" value="<?=et_setFormValBlank('bsa_rivulet_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_rivulet_remark" size="60" value="<?=et_setFormValBlank('bsa_rivulet_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>3</td>
									<td>Meandering/Curving River</td>
									<td>Rivers not hitting the bank or the bank is rock even if river is hitting</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_meandering" id="bsa_meandering" value="1" <?php echo (et_setFormVal('bsa_meandering', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_meandering_def" size="20" value="<?=et_setFormValBlank('bsa_meandering_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_meandering_remark" size="60" value="<?=et_setFormValBlank('bsa_meandering_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>4</td>
									<td>Source of Gravel</td>
									<td>As per specifications</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_source_gravel" id="bsa_source_gravel" value="1" <?php echo (et_setFormVal('bsa_source_gravel', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_source_gravel_def" size="20" value="<?=et_setFormValBlank('bsa_source_gravel_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_source_gravel_remark" size="60" value="<?=et_setFormValBlank('bsa_source_gravel_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>5</td>
									<td>Source of Sand</td>
									<td>As per specifications</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_source_sand" id="bsa_source_sand" value="1" <?php echo (et_setFormVal('bsa_source_sand', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_source_sand_def" size="20" value="<?=et_setFormValBlank('bsa_source_sand_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_source_sand_remark" size="60" value="<?=et_setFormValBlank('bsa_source_sand_remark', $objSiteAssesment);?>"></td>
								</tr>
								<tr>
									<td>6</td>
									<td>Source of Stone</td>
									<td>As per specifications</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_source_stone" id="bsa_source_stone" value="1" <?php echo (et_setFormVal('bsa_source_stone', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_source_stone_def" size="20" value="<?=et_setFormValBlank('bsa_source_stone_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_source_stone_remark" size="60" value="<?=et_setFormValBlank('bsa_source_stone_remark', $objSiteAssesment);?>"></td>
								</tr>
								
								<tr>
									<td>7</td>
									<td>Profile Survey</td>
									<td>Span and Level Correction and within tolerance</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bsa_profile_survey" id="bsa_profile_survey" value="1" <?php echo (et_setFormVal('bsa_profile_survey', $objSiteAssesment) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bsa_profile_survey_def" size="20" value="<?=et_setFormValBlank('bsa_profile_survey_def', $objSiteAssesment);?>"></td>
									<td><input type="text" name="bsa_profile_survey_remark" size="60" value="<?=et_setFormValBlank('bsa_profile_survey_remark', $objSiteAssesment);?>"></td>
								</tr>
					</table>
					<div class="col-lg-8">

						
							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Assessment By</label>
								<div class="col-lg-3 ">
									<input type="text" class=" form-control " name="site_assessment_by" id="site_assessment_by" value="<?php echo et_setFormValBlank('bsa_assesment_by', $objSiteAssesment); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Assessment Date</label>

								<div class="col-lg-3 datebox-container ">

									<div class="col-lg-10 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="site_assessment_date" id="site_assessment_date" value="<?php if (isset($objSiteAssesment['bsa_assesment_date']) && $objSiteAssesment['bsa_assesment_date'] != "0000-00-00") { echo et_setFormVal('bsa_assesment_date', $objSiteAssesment);} ?>" />
									</div>

								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Remark</label>
								<div class="col-lg-3 ">
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
					<div class="col-lg-12">
						<table class="table table-bordered table-hover">
							<tr>
								<td>S.No.</td>
								<td>Issues</td>
								<td>Acceptable</td>
								<td width="60">&nbsp;</td>
								<td>Deficiency</td>
								<td>Remedial Action</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Cable Sag</td>
								<td>As per design</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_cable_check" id="bri_cable_check" value="1" <?php echo (et_setFormVal('bri_cable_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_cable_def" size="20" value="<?=et_setFormValBlank('bri_cable_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_cable_action" size="60" value="<?=et_setFormValBlank('bri_cable_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Relative Sag</td>
								<td>Equal sag of all cables</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_relative_check" id="bri_relative_check" value="1" <?php echo (et_setFormVal('bri_relative_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_relative_def" size="20" value="<?=et_setFormValBlank('bri_relative_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_relative_action" size="60" value="<?=et_setFormValBlank('bri_relative_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td rowspan="3">3</td>
								<td rowspan="3">Bulldog Grips</td>
								<td>Number as per specification</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_bulldog_spec_check" id="bri_bulldog_spec_check" value="1" <?php echo (et_setFormVal('bri_bulldog_spec_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_bulldog_spec_def" size="20" value="<?=et_setFormValBlank('bri_bulldog_spec_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_bulldog_action" size="60" value="<?=et_setFormValBlank('bri_bulldog_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>No missing</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_bulldog_missing_check" id="bri_bulldog_missing_check" value="1" <?php echo (et_setFormVal('bri_bulldog_missing_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_bulldog_missing_def" size="20" value="<?=et_setFormValBlank('bri_bulldog_missing_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_bulldog_missing_action" size="60" value="<?=et_setFormValBlank('bri_bulldog_missing_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>Retightened</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_bulldog_retight_check" id="bri_bulldog_retight_check" value="1" <?php echo (et_setFormVal('bri_bulldog_retight_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_bulldog_retight_def" size="20" value="<?=et_setFormValBlank('bri_bulldog_retight_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_bulldog_retight_action" size="60" value="<?=et_setFormValBlank('bri_bulldog_retight_action', $objFinalInspection);?>"></td>
							</tr>

							<tr>
								<td rowspan="3">4</td>
								<td rowspan="3">Anchorage/Foundation Block</td>
								<td>Proper cut slopes as per drawing</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_anchorage_check" id="bri_anchorage_check" value="1" <?php echo (et_setFormVal('bri_anchorage_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_anchorage_def" size="20" value="<?=et_setFormValBlank('bri_anchorage_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_anchorage_action" size="60" value="<?=et_setFormValBlank('bri_anchorage_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>Dimensions as per drawing</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_anchorage_dimension_check" id="bri_anchorage_dimension_check" value="1" <?php echo (et_setFormVal('bri_anchorage_dimension_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_anchorage_dimension_def" size="20" value="<?=et_setFormValBlank('bri_anchorage_dimension_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_anchorage_dimension_action" size="60" value="<?=et_setFormValBlank('bri_anchorage_dimension_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>Stone masonry and concreting as per drawing & specifications</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_anchorage_stone_check" id="bri_anchorage_stone_check" value="1" <?php echo (et_setFormVal('bri_anchorage_stone_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_anchorage_stone_def" size="20" value="<?=et_setFormValBlank('bri_anchorage_stone_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_anchorage_stone_action" size="60" value="<?=et_setFormValBlank('bri_anchorage_stone_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>5</td>
								<td>Walkway</td>
								<td>Cross beams and decks are well assembled without missing any nuts and bolts</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_walkway_check" id="bri_walkway_check" value="1" <?php echo (et_setFormVal('bri_walkway_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_walkway_def" size="20" value="<?=et_setFormValBlank('bri_walkway_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_walkway_action" size="60" value="<?=et_setFormValBlank('bri_walkway_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>6</td>
								<td>Suspenders</td>
								<td>No missing suspenders/parts, all suspenders vertical</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_suspenders_check" id="bri_suspenders_check" value="1" <?php echo (et_setFormVal('bri_suspenders_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_suspenders_def" size="20" value="<?=et_setFormValBlank('bri_suspenders_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_suspenders_action" size="60" value="<?=et_setFormValBlank('bri_suspenders_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>7</td>
								<td>Tower</td>
								<td>Vertical, No missing nuts and bolts. Temporary struts are removed</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_tower_vertical_check" id="bri_tower_vertical_check" value="1" <?php echo (et_setFormVal('bri_tower_vertical_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_tower_vertical_def" size="20" value="<?=et_setFormValBlank('bri_tower_vertical_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_tower_vertical_action" size="60" value="<?=et_setFormValBlank('bri_tower_vertical_action', $objFinalInspection);?>"></td>
							</tr>
							
							
							<tr>
								<td rowspan="2">8</td>
								<td rowspan="2">Fixtures</td>
								<td>Hot Dipped Galvanized & Grade is as per specification/drawings</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_fixtures_hot_check" id="bri_fixtures_check" value="1" <?php echo (et_setFormVal('bri_fixtures_hot_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_fixtures_hot_def" size="20" value="<?=et_setFormValBlank('bri_fixtures_hot_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_fixtures_hot_action" size="60" value="<?=et_setFormValBlank('bri_fixtures_hot_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>None missing & fully retightened</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_fixtures_check" id="bri_fixtures_check" value="1" <?php echo (et_setFormVal('bri_fixtures_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_fixtures_def" size="20" value="<?=et_setFormValBlank('bri_fixtures_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_fixtures_action" size="60" value="<?=et_setFormValBlank('bri_fixtures_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td rowspan="2">9</td>
								<td rowspan="2">Wire Mesh</td>
								<td>Wires are heavily zinc coated</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_wire_check" id="bri_wire_check" value="1" <?php echo (et_setFormVal('bri_wire_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_wire_def" size="20" value="<?=et_setFormValBlank('bri_wire_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_wire_action" size="60" value="<?=et_setFormValBlank('bri_wire_action', $objFinalInspection);?>"></td>
							</tr>
							
							
							<tr>
								<td>Uniform mesh weaving and properly fixed with handrail cables & suspenders</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_wire_mesh_uniform_check" id="bri_wire_mesh_uniform_check" value="1" <?php echo (et_setFormVal('bri_wire_mesh_uniform_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_wire_mesh_uniform_def" size="20" value="<?=et_setFormValBlank('bri_wire_mesh_uniform_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_wire_mesh_uniform_action" size="60" value="<?=et_setFormValBlank('bri_wire_mesh_uniform_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td rowspan="2">10</td>
								<td rowspan="2">W/E Arrangement</td>
								<td>W/E cable is inparabola & fully pre-tentioned.</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_we_check" id="bri_we_check" value="1" <?php echo (et_setFormVal('bri_we_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_we_def" size="20" value="<?=et_setFormValBlank('bri_we_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_we_action" size="60" value="<?=et_setFormValBlank('bri_we_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>Angles of W/E anchorage are as per design & truly aligned with W/E Cable.</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_we_angles_check" id="bri_we_angles_check" value="1" <?php echo (et_setFormVal('bri_we_angles_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_we_angles_def" size="20" value="<?=et_setFormValBlank('bri_we_angles_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_we_angles_action" size="60" value="<?=et_setFormValBlank('bri_we_angles_action', $objFinalInspection);?>"></td>
							</tr>
							<tr>
								<td>11</td>
								<td>Windties</td>
								<td>Perpendicular to the bridge axis and fully pre-tensioned</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_windties_check" id="bri_windties_check" value="1" <?php echo (et_setFormVal('bri_windties_check', $objFinalInspection) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_windties_def" size="20" value="<?=et_setFormValBlank('bri_windties_def', $objFinalInspection);?>"></td>
								<td><input type="text" name="bri_windties_action" size="60" value="<?=et_setFormValBlank('bri_windties_action', $objFinalInspection);?>"></td>
							</tr>	
						</table>
						<div class="col-lg-8">
							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Bridge Completion Date</label>

								<div class="col-lg-5 datebox-container ">

									<div class="col-lg-12 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bridge_completion_date" id="bridge_completion_date" value="<?php if (isset($objFinalInspection['bridge_completion_date']) && $objFinalInspection['bridge_completion_date'] != "0000-00-00") { echo et_setFormVal('bridge_completion_date', $objFinalInspection); } ?>" />
									</div>

								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Assessment By</label>
								<div class="col-lg-5 ">
									<input type="text" class=" form-control " name="fi_site_assessment_by" id="fi_site_assessment_by" value="<?php echo et_setFormValBlank('fi_site_assessment_by', $objFinalInspection); ?>" />
								</div>
							</div>
							
							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Assessment Date</label>

								<div class="col-lg-5 datebox-container ">

									<div class="col-lg-12 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="fi_site_assessment_date" id="fi_site_assessment_date" value="<?php if (isset($objFinalInspection['fi_site_assessment_date']) && $objFinalInspection['fi_site_assessment_date'] != "0000-00-00") { echo et_setFormVal('fi_site_assessment_date', $objFinalInspection); } ?>" />
									</div>

								</div>
							</div>

							<div class="form-group clearfix">

								<label class="col-lg-3 ">Bridge Completion Fiscal Year</label>

								<div class="col-lg-5 ">
									<?php
									$valDisableFy = "";
									/*if (isset($objOldRec['bri03id']) && $objOldRec['bri03id'] != '') {
										if ($is_admin == 0) {
											$valDisableFy = "readonly";
										} else {
											$valDisableFy = "";
										}
									} else {
										$valDisableFy = "";
									}*/

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
								<label class="col-lg-3 ">Remarks</label>
								<div class="col-lg-5 ">
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

											<input type="text" class=" form-control " name="bb_assessment_date" id="bb_assessment_date" value="<?php if (isset($objBeneficiariesRec['bb_assessment_date']) && $objBeneficiariesRec['bb_assessment_date'] != "0000-00-00") {	echo et_setFormVal('bb_assessment_date', $objBeneficiariesRec);	} ?>" />

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

											<input type="text" class=" form-control " name="ph_assessment_date" id="ph_assessment_date" value="<?php if (isset($objPublicHearingRec['ph_assessment_date']) && $objPublicHearingRec['ph_assessment_date'] != "0000-00-00") {	echo et_setFormVal('ph_assessment_date', $objPublicHearingRec);	} ?>" />

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
							UC Composition (Applicable for SSTB only) / Contracting (Applicable for LSTB only)
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

									<th class="cost width center">Name of Contractor (LSTB)</th>
									<th><input type="text" class=" form-control " name="uc_contractor_name" id="uc_contractor_name" value="<?php echo et_setFormValBlank('uc_contractor_name', $objUCCompositionRec); ?>" /></th>
									<th>Date of Contract Agreement</th>
									<th class="">
									<div class="col-lg-12 datebox-container ">

										<div class="col-lg-12 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="uc_contract_date" id="uc_contract_date" value="<?php if (isset($objUCCompositionRec['uc_contract_date']) && $objUCCompositionRec['uc_contract_date'] != "0000-00-00") { echo et_setFormVal('uc_contract_date', $objUCCompositionRec); } ?>" />

										</div>

										</div>
									</th>
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
					<div class="col-lg-12">
						<table class="table table-bordered table-hover">
							<tr>
								<td>S.No.</td>
								<td>Issues</td>
								<td>Acceptable</td>
								<td width="60px">&nbsp;</td>
								<td>Deficiency</td>
								<td>Remedial Action</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Bridge Type Selection</td>
								<td>Selected Bridge type is correct(LSTB or SSTB/(Suspension or Suspended))</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_bri_type_check" id="bri_bri_type_check" value="1" <?php echo (et_setFormVal('bri_bri_type_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_bri_type_deficiency" size="20" value="<?=et_setFormValBlank('bri_bri_type_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_bri_type_action" size="60" value="<?=et_setFormValBlank('bri_bri_type_action', $objBridgeDesign);?>"></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Span</td>
								<td>Appropriate</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_design_span_check" id="bri_design_span_check" value="1" <?php echo (et_setFormVal('bri_design_span_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_design_span_deficiency" size="20" value="<?=et_setFormValBlank('bri_design_span_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_design_span_action" size="60" value="<?=et_setFormValBlank('bri_design_span_action', $objBridgeDesign);?>"></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Overall Design</td>
								<td>Meets the norms and standards</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_overall_design_check" id="bri_overall_design_check" value="1" <?php echo (et_setFormVal('bri_overall_design_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_overall_design_deficiency" size="20" value="<?=et_setFormValBlank('bri_overall_design_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_overall_design_action" size="60" value="<?=et_setFormValBlank('bri_overall_design_action', $objBridgeDesign);?>"></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Free Board </td>
								<td>(>= 5m)</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_free_board_check" id="bri_free_board_check" value="1" <?php echo (et_setFormVal('bri_free_board_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_free_board_deficiency" size="20" value="<?=et_setFormValBlank('bri_free_board_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_free_board_action" size="60" value="<?=et_setFormValBlank('bri_free_board_action', $objBridgeDesign);?>"></td>
							</tr>
							<tr>
								<td>5</td>
								<td>Environmental Consideration</td>
								<td>Cutting and filling is balanced and cut sopes maintained</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_env_con_check" id="bri_env_con_check" value="1" <?php echo (et_setFormVal('bri_env_con_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_env_con_deficiency" size="20" value="<?=et_setFormValBlank('bri_env_con_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_env_con_action" size="60" value="<?=et_setFormValBlank('bri_env_con_action', $objBridgeDesign);?>"></td>
							</tr>
							<tr>
								<td>6</td>
								<td>Foundation Location</td>
								<td>Both Criteria(slope angle & frontage) in the standard are met</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_foundation_check" id="bri_foundation_check" value="1" <?php echo (et_setFormVal('bri_foundation_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_foundation_deficiency" size="20" value="<?=et_setFormValBlank('bri_foundation_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_foundation_action" size="60" value="<?=et_setFormValBlank('bri_foundation_action', $objBridgeDesign);?>"></td>
							</tr>
							<tr>
								<td>7</td>
								<td>Cable Geometry</td>
								<td>Meets the norms and standards and Optimized</td>
								<td>
								<div class="col-lg-4 checkPad ">
								<input type="checkbox" class=" form-control " name="bri_cable_geo_check" id="bri_cable_geo_check" value="1" <?php echo (et_setFormVal('bri_cable_geo_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div>
								</td>
								<td><input type="text" name="bri_cable_geo_deficiency" size="20" value="<?=et_setFormValBlank('bri_cable_geo_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_cable_geo_action" size="60" value="<?=et_setFormValBlank('bri_cable_geo_action', $objBridgeDesign);?>"></td>
							</tr>
							<tr>
								<td>8</td>
								<td>Design Optimization</td>
								<td><=20% of the prevailing district linear cost</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_design_opt_check" id="bri_design_opt_check" value="1" <?php echo (et_setFormVal('bri_design_opt_check', $objBridgeDesign) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_design_opt_deficiency" size="20" value="<?=et_setFormValBlank('bri_design_opt_deficiency', $objBridgeDesign);?>"></td>
								<td><input type="text" name="bri_design_opt_action" size="60" value="<?=et_setFormValBlank('bri_design_opt_action', $objBridgeDesign);?>"></td>
							</tr>
						</table>
						<div class="col-lg-4">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="design_site_assessment_by" id="design_site_assessment_by" value="<?php echo et_setFormValBlank('design_site_assessment_by', $objBridgeDesign); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Assessment Date</label>

								<div class="col-lg-6 datebox-container ">

									<div class="col-lg-8 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="design_site_assessment_date" id="design_site_assessment_date" value="<?php if (isset($objBridgeDesign['design_site_assessment_date']) && $objBridgeDesign['design_site_assessment_date'] != "0000-00-00") {	echo et_setFormVal('design_site_assessment_date', $objBridgeDesign); } ?>" />
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
							<input type="text" class=" form-control " name="insurance_exp_date" id="insurance_exp_date" value="<?php if (isset($objBridgeInsurance['insurance_exp_date']) && $objBridgeInsurance['insurance_exp_date'] != "0000-00-00") { echo et_setFormVal('insurance_exp_date', $objBridgeInsurance); } ?>" />
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
							<input type="text" class=" form-control " name="sign_board_date" id="sign_board_date" value="<?php if (isset($objBridgeSignBoard['sign_board_date']) && $objBridgeSignBoard['sign_board_date'] != "0000-00-00") { echo et_setFormVal('sign_board_date', $objBridgeSignBoard); } ?>" />
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
					<div class="col-lg-12">
						<table class="table table-bordered table-hover">
							<tr>
								<td>S.No.</td>
								<td>Issues</td>
								<td>Acceptable</td>
								<td width="60">&nbsp;</td>
								<td>Deficiency</td>
								<td>Remedial Action</td>
							</tr>
							<tr>
								<td rowspan="7">1</td>
								<td rowspan="7">Quality of finished steel parts</td>
								<td>Lab test reports of raw materials is available</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_quality_steel_check" id="bri_quality_steel_check" value="1" <?php echo (et_setFormVal('bri_quality_steel_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_quality_steel_def" size="20" value="<?=et_setFormValBlank('bri_quality_steel_def', $objBridgeSteelParts);?>"></td>
								<td><input type="text" name="bri_quality_steel_action" size="60" value="<?=et_setFormValBlank('bri_quality_steel_action', $objBridgeSteelParts);?>"></td>
							</tr>
							<tr>
								<td>Manufacturer maintains QA documentation of fabrication & Galvanization</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_qa_document_check" id="bri_qa_document_check" value="1" <?php echo (et_setFormVal('bri_qa_document_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_qa_document_def" size="20" value="<?=et_setFormValBlank('bri_qa_document_def', $objBridgeSteelParts);?>"></td>
								<td><input type="text" name="bri_qa_document_action" size="60" value="<?=et_setFormValBlank('bri_qa_document_action', $objBridgeSteelParts);?>"></td>
							</tr>
							<tr>
								<td>Welding is smooth and without pores</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_welding_check" id="bri_welding_check" value="1" <?php echo (et_setFormVal('bri_welding_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_welding_def" size="20" value="<?=et_setFormValBlank('bri_welding_def', $objBridgeSteelParts);?>"></td>
								<td><input type="text" name="bri_welding_action" size="60" value="<?=et_setFormValBlank('bri_welding_action', $objBridgeSteelParts);?>"></td>
							</tr>
							<tr>
								<td>Zinc coating is as per specification</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_zinc_coating_check" id="bri_zinc_coating_check" value="1" <?php echo (et_setFormVal('bri_zinc_coating_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_zinc_coating_def" size="20" value="<?=et_setFormValBlank('bri_zinc_coating_def', $objBridgeSteelParts);?>"></td>
								<td><input type="text" name="bri_zinc_coating_action" size="60" value="<?=et_setFormValBlank('bri_zinc_coating_action', $objBridgeSteelParts);?>"></td>
							</tr>
							<tr>
								<td>100% Assembled fittings have been checked positively</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_assembled_fitting_check" id="bri_assembled_fitting_check" value="1" <?php echo (et_setFormVal('bri_assembled_fitting_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_assembled_fitting_def" size="20" value="<?=et_setFormValBlank('bri_assembled_fitting_def', $objBridgeSteelParts);?>"></td>
								<td><input type="text" name="bri_assembled_fitting_action" size="60" value="<?=et_setFormValBlank('bri_assembled_fitting_action', $objBridgeSteelParts);?>"></td>
							</tr>
							<tr>
								<td>Wire mesh is made of 10 SWG GI Wires and with heavy coating</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_wire_mesh_check" id="bri_wire_mesh_check" value="1" <?php echo (et_setFormVal('bri_wire_mesh_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_wire_mesh_def" size="20" value="<?=et_setFormValBlank('bri_wire_mesh_def', $objBridgeSteelParts);?>"></td>
								<td><input type="text" name="bri_wire_mesh_action" size="60" value="<?=et_setFormValBlank('bri_wire_mesh_action', $objBridgeSteelParts);?>"></td>
							</tr>
							<tr>
								<td>Nuts/bolts are as per specification & drawing</td>
								<td><div class="col-lg-4 checkPad ">
									<input type="checkbox" class=" form-control " name="bri_nuts_bolts_check" id="bri_nuts_bolts_check" value="1" <?php echo (et_setFormVal('bri_nuts_bolts_check', $objBridgeSteelParts) == 1) ? 'checked="checked"' : '' ?>>
								</div></td>
								<td><input type="text" name="bri_nuts_bolts_def" size="20" value="<?=et_setFormValBlank('bri_nuts_bolts_def', $objBridgeSteelParts);?>"></td>
								<td><input type="text" name="bri_nuts_bolts_action" size="60" value="<?=et_setFormValBlank('bri_nuts_bolts_action', $objBridgeSteelParts);?>"></td>
							</tr>
						</table>
						<div class="col-lg-4">
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
										<input type="text" class=" form-control " name="factory_visit_assessment_date" id="factory_visit_assessment_date" value="<?php if (isset($objBridgeSteelParts['factory_visit_assessment_date']) && $objBridgeSteelParts['factory_visit_assessment_date'] != "0000-00-00") { echo et_setFormVal('factory_visit_assessment_date', $objBridgeSteelParts);} ?>" />
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Remark</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="factory_visit_remarks" id="factory_visit_remarks" value="<?php echo et_setFormValBlank('factory_visit_remarks', $objBridgeSteelParts); ?>" />
								</div>
							</div>

							<!-- <div class="form-group clearfix ">
								<label class="col-lg-6 ">Active</label>
								<div class="col-lg-4 ">
									<input name="factory_visit_active" id="factory_visit_active" type="radio" value="1" <?php //echo ($objBridgeSteelParts && $objBridgeSteelParts['factory_visit_active'] == 1)? 'checked="checked"':'';?>><label for="factory_visit_active">Active</label>
								</div>
							</div> -->
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

				<div class="col-lg-12">
						
					<table class="table table-bordered table-hover">
								<tr>
									<td>S.No.</td>
									<td>Issues</td>
									<td>Acceptable</td>
									<td width="60px">&nbsp</td>
									<td>Deficiency</td>
									<td>Remedial Action</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Quality of Cable</td>
									<td>Without kinks and/or broken strands</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_cable_quality_check" id="bri_cable_quality_check" value="1" <?php echo (et_setFormVal('bri_cable_quality_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_cable_quality_def" size="20" value="<?=et_setFormValBlank('bri_cable_quality_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_cable_quality_remarks" size="60" value="<?=et_setFormValBlank('bri_cable_quality_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								
								<tr>
									<td>2</td>
									<td>Cable Sag</td>
									<td>As per design</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_cable_sag_check" id="bri_cable_sag_check" value="1" <?php echo (et_setFormVal('bri_cable_sag_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_cable_sag_def" size="20" value="<?=et_setFormValBlank('bri_cable_sag_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_cable_sag_remarks" size="60" value="<?=et_setFormValBlank('bri_cable_sag_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>3</td>
									<td>Relative Sag</td>
									<td>Equal sag of all cables</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_relative_sag_check" id="bri_relative_sag_check" value="1" <?php echo (et_setFormVal('bri_relative_sag_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_relative_sag_def" size="20" value="<?=et_setFormValBlank('bri_relative_sag_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_relative_sag_remarks" size="60" value="<?=et_setFormValBlank('bri_relative_sag_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>4</td>
									<td>Bulldog Grips</td>
									<td>As per design & specifications</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_bulldog_check" id="bri_bulldog_check" value="1" <?php echo (et_setFormVal('bri_bulldog_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_bulldog_def" size="20" value="<?=et_setFormValBlank('bri_bulldog_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_bulldog_remarks" size="60" value="<?=et_setFormValBlank('bri_bulldog_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>5</td>
									<td>Cross Check the quality of stones/aggregate/sand</td>
									<td>Chiseled dressed, hammer dressed and broken stones are as per drawings and for aggregate & sand refer to CMS 2</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_quality_stones_check" id="bri_quality_stones_check" value="1" <?php echo (et_setFormVal('bri_quality_stones_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_quality_stones_def" size="20" value="<?=et_setFormValBlank('bri_quality_stones_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_quality_stones_remarks" size="60" value="<?=et_setFormValBlank('bri_quality_stones_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>6</td>
									<td>Cement</td>
									<td>OPC Min,43 Grade</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_cement_check" id="bri_cement_check" value="1" <?php echo (et_setFormVal('bri_cement_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bri_cement_def" size="20" value="<?=et_setFormValBlank('bri_cement_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_cement_remarks" size="60" value="<?=et_setFormValBlank('bri_cement_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>7</td>
									<td>Verify Concreting of Drum/Deadman/Anchorage Block</td>
									<td>Laying of Reinforcement and Anchorage steel parts and concreting as per drawing & specifications</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_verify_concrete_drum_check" id="bri_verify_concrete_drum_check" value="1" <?php echo (et_setFormVal('bri_verify_concrete_drum_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bri_verify_concrete_drum_def" size="20" value="<?=et_setFormValBlank('bri_verify_concrete_drum_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_verify_concrete_drum_remarks" size="60" value="<?=et_setFormValBlank('bri_verify_concrete_drum_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td rowspan="2">8</td>
									<td rowspan="2">CSM/Dry stone masonry for dead load</td>
									<td>Laying of broken stones and proper bonding along with the peripheral cement stone masonry</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_masonry_stone_check" id="bri_masonry_stone_check" value="1" <?php echo (et_setFormVal('bri_masonry_stone_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_masonry_stone_def" size="20" value="<?=et_setFormValBlank('bri_masonry_stone_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_masonry_stone_remarks" size="60" value="<?=et_setFormValBlank('bri_masonry_stone_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>Monolithic & stepwise construction</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_masonry_monolithic_check" id="bri_masonry_monolithic_check" value="1" <?php echo (et_setFormVal('bri_masonry_monolithic_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_masonry_monolithic_def" size="20" value="<?=et_setFormValBlank('bri_masonry_monolithic_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_masonry_monolithic_remarks" size="60" value="<?=et_setFormValBlank('bri_masonry_monolithic_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								
								
								<tr>
									<td>9</td>
									<td>Workmanship(General)</td>
									<td>As per specifications: Concrete/Mortar mix, Bond/joints, Plumb vertical/horizontal and Curing</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_workmanship_check" id="bri_workmanship_check" value="1" <?php echo (et_setFormVal('bri_workmanship_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_workmanship_def" size="20" value="<?=et_setFormValBlank('bri_workmanship_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_workmanship_remarks" size="60" value="<?=et_setFormValBlank('bri_workmanship_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td rowspan="2">10</td>
									<td rowspan="2">Plum Concrete</td>
									<!-- <td>60% Concrete + 40% Boulder</td> -->
									<td>Size of Boulder < 10cm</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_plum_concrete_check" id="bri_plum_concrete_check" value="1" <?php echo (et_setFormVal('bri_plum_concrete_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_plum_concrete_def" size="20" value="<?=et_setFormValBlank('bri_plum_concrete_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_plum_concrete_remarks" size="60" value="<?=et_setFormValBlank('bri_plum_concrete_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>Minumum gap of 12cm between boulders maintained</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_plum_concrete_gap_check" id="bri_plum_concrete_gap_check" value="1" <?php echo (et_setFormVal('bri_plum_concrete_gap_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_plum_concrete_gap_check_def" size="20" value="<?=et_setFormValBlank('bri_plum_concrete_gap_check_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_plum_concrete_gap_check_remarks" size="60" value="<?=et_setFormValBlank('bri_plum_concrete_gap_check_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>11</td>
									<td>Dimension of Anchorage & Foundation blocks</td>
									<td>As per design and drawing</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_dimension_anchorage_check" id="bri_dimension_anchorage_check" value="1" <?php echo (et_setFormVal('bri_dimension_anchorage_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_dimension_anchorage_def" size="20" value="<?=et_setFormValBlank('bri_dimension_anchorage_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_dimension_anchorage_remarks" size="60" value="<?=et_setFormValBlank('bri_dimension_anchorage_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>12</td>
									<td>Tower(N Types only)</td>
									<td>Vertical,Nomissing nuts and bolts.Temporary struts are in place</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_tower_check" id="bri_tower_check" value="1" <?php echo (et_setFormVal('bri_tower_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_tower_def" size="20" value="<?=et_setFormValBlank('bri_tower_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_tower_remarks" size="60" value="<?=et_setFormValBlank('bri_tower_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								<tr>
									<td>13</td>
									<td>Painting works of non galvanized steel parts(MM only)</td>
									<td>As per specifications.</td>
									<td><div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_painting_works_check" id="bri_painting_works_check" value="1" <?php echo (et_setFormVal('bri_painting_works_check', $objBridgeConstructionWork) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_painting_works_def" size="20" value="<?=et_setFormValBlank('bri_painting_works_def', $objBridgeConstructionWork);?>"></td>
									<td><input type="text" name="bri_painting_works_remarks" size="60" value="<?=et_setFormValBlank('bri_painting_works_remarks', $objBridgeConstructionWork);?>"></td>
								</tr>
								
					</table>
					<div class="col-lg-8">

						
							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Assessment By</label>
								<div class="col-lg-3 ">
									<input type="text" class=" form-control " name="bcw_assessment_by" id="bcw_assessment_by" value="<?php echo et_setFormValBlank('bcw_assessment_by', $objBridgeConstructionWork); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Assessment Date</label>

								<div class="col-lg-3 datebox-container ">

									<div class="col-lg-10 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bcw_assessment_date" id="bcw_assessment_date" value="<?php if (isset($objBridgeConstructionWork['bcw_assessment_date']) && $objBridgeConstructionWork['bcw_assessment_date'] != "0000-00-00") {	echo et_setFormVal('bcw_assessment_date', $objBridgeConstructionWork);} ?>" />
									</div>

								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-3 ">Remark</label>
								<div class="col-lg-3 ">
									<input type="text" class=" form-control " name="bcw_remarks" id="bcw_remarks" value="<?php echo et_setFormValBlank('bcw_remarks', $objBridgeConstructionWork); ?>" />
								</div>
							</div>
							<input type="hidden" class="form-control " name="bcw_id" id="bcw_id" value="<?php echo et_setFormVal('bcw_id',$objBridgeConstructionWork); ?>"/>

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
					<div class="col-lg-12">
						<table class="table table-bordered table-hover">
								<tr>
									<td>S.No.</td>
									<td>Issues</td>
									<td>Acceptable</td>
									<td width="60px">&nbsp</td>
									<td>Deficiency</td>
									<td>Remedial Action</td>
								</tr>
								<tr>
									<td rowspan="2">1</td>
									<td rowspan="2">Implementation Approach</td>
									<td>SSTB: Commit Approach</td>
									<td><div class="col-lg-4 checkPad ">
											<input type="checkbox" class=" form-control " name="bri_impl_approach_check" id="bri_impl_approach_check" value="1" <?php echo (et_setFormVal('bri_impl_approach_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_impl_approach_deficiency" size="60" value="<?=et_setFormValBlank('bri_impl_approach_deficiency', $objCostEstimate);?>">&nbsp;</td>
									<td><input type="text" name="bri_impl_approach_remarks" size="60" value="<?=et_setFormValBlank('bri_impl_approach_remarks', $objCostEstimate);?>"></td>
								</tr>
								<tr>
									<td>LSTB: Contracting (Lumsum Contract/CTP) </td>
									<td><div class="col-lg-4 checkPad ">
											<input type="checkbox" class=" form-control " name="bri_impl_approach_lstb_check" id="bri_impl_approach_lstb_check" value="1" <?php echo (et_setFormVal('bri_impl_approach_lstb_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div></td>
									<td><input type="text" name="bri_impl_approach_lstb_deficiency" size="60" value="<?=et_setFormValBlank('bri_impl_approach_lstb_deficiency', $objCostEstimate);?>">&nbsp;</td>
									<td><input type="text" name="bri_impl_approach_lstb_remarks" size="60" value="<?=et_setFormValBlank('bri_impl_approach_lstb_remarks', $objCostEstimate);?>"></td>
								</tr>
								<tr>
									<td>2</td>
									<td>Unit Rates of Steel Parts</td>
									<td>Published reference rates based on the norms established by DOLI/MoUD</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_unit_rates_steel_check" id="bri_unit_rates_steel_check" value="1" <?php echo (et_setFormVal('bri_unit_rates_steel_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bri_unit_rates_steel_deficiency" size="60" value="<?=et_setFormValBlank('bri_unit_rates_steel_deficiency', $objCostEstimate);?>">&nbsp;</td>
									<td><input type="text" name="bri_unit_rates_steel_remarks" size="60" value="<?=et_setFormValBlank('bri_unit_rates_steel_remarks', $objCostEstimate);?>"></td>
								</tr>
								<tr>
									<td>3</td>
									<td>Unit Rates(Portering,Labor,Cement etc)</td>
									<td>Approved palika/District rates followed</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_unit_rates_check" id="bri_unit_rates_check" value="1" <?php echo (et_setFormVal('bri_unit_rates_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bri_unit_rates_deficiency" size="60" value="<?=et_setFormValBlank('bri_unit_rates_deficiency', $objCostEstimate);?>">&nbsp;</td>
									<td><input type="text" name="bri_unit_rates_remarks" size="60" value="<?=et_setFormValBlank('bri_unit_rates_remarks', $objCostEstimate);?>"></td>
								</tr>
								<tr>
									<td>4</td>
									<td>Portering distance</td>
									<td>DCC's/Palika norms but not inferior to 1 ported by 12.8 km or 8 miles for 40 kg weight</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_portering_dis_check" id="bri_portering_dis_check" value="1" <?php echo (et_setFormVal('bri_portering_dis_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bri_portering_dis_deficiency" size="60" value="<?=et_setFormValBlank('bri_portering_dis_deficiency', $objCostEstimate);?>">&nbsp;</td>
									<td><input type="text" name="bri_portering_dis_remarks" size="60" value="<?=et_setFormValBlank('bri_portering_dis_remarks', $objCostEstimate);?>"></td>
								</tr>
								<tr>
									<td>5</td>
									<td>Per meter linear cost</td>
									<td>Within limit</td>
									<td>
									<div class="col-lg-4 checkPad ">
										<input type="checkbox" class=" form-control " name="bri_pm_linearcost_check" id="bri_pm_linearcost_check" value="1" <?php echo (et_setFormVal('bri_pm_linearcost_check', $objCostEstimate) == 1) ? 'checked="checked"' : '' ?>>
									</div>
									</td>
									<td><input type="text" name="bri_pm_linearcost_deficiency" size="60" value="<?=et_setFormValBlank('bri_pm_linearcost_deficiency', $objCostEstimate);?>">&nbsp;</td>
									<td><input type="text" name="bri_pm_linearcost_remarks" size="60" value="<?=et_setFormValBlank('bri_pm_linearcost_remarks', $objCostEstimate);?>"></td>
								</tr>
						</table>
						<div class="col-lg-8">
							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Cost Assessment By</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="cost_est_site_assessment_by" id="cost_est_site_assessment_by" value="<?php echo et_setFormValBlank('cost_est_site_assessment_by', $objCostEstimate); ?>" />
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Cost Assessment Date</label>
								<div class="col-lg-6 datebox-container ">
									<div class="col-lg-8 nopad datetimepicker input-group date ">
										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										<input type="text" class=" form-control " name="cost_est_site_assessment_date" id="cost_est_site_assessment_date" value="<?php if (isset($objCostEstimate['cost_est_site_assessment_date']) && $objCostEstimate['cost_est_site_assessment_date'] != "0000-00-00") {	echo et_setFormVal('cost_est_site_assessment_date', $objCostEstimate); } ?>" />
									</div>
								</div>
							</div>

							<div class="form-group clearfix ">
								<label class="col-lg-6 ">Remark</label>
								<div class="col-lg-6 ">
									<input type="text" class=" form-control " name="cost_est_remarks" id="cost_est_remarks" value="<?php echo et_setFormValBlank('cost_est_remarks', $objCostEstimate); ?>" />
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

											<input type="text" class=" form-control " name="pa_assessment_date" id="pa_assessment_date" value="<?php if (isset($objPublicAudit['pa_assessment_date']) && $objPublicAudit['pa_assessment_date'] != "0000-00-00") { echo et_setFormVal('pa_assessment_date', $objPublicAudit); } ?>" />

										</div>

										</div>
									</th>
									<th colspan="2"><input name="pa_status" id="pa_status" type="radio" value="1" <?php echo ($objPublicAudit && $objPublicAudit['pa_status'] == 1)? 'checked="checked"':'';?>><label for="pa_status">Yes</label></th>
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
					$(".uc-text, .uc-female, .uc-male").each(function() {
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