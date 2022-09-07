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
						<li><a href="#Land_Donation">Land Donation</a></li>
						<li><a href="#Insurance">Insurance</a></li>
						<li><a href="#Sign_Board">Sign Board</a></li>
						<li><a href="#Steel_Parts">Steel Parts</a></li>
						<li><a href="#Construction_Work">Construction Work</a></li>
						<li><a href="#Public_Review">Public Review</a></li>
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

							<div class="form-group clearfix ">

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
								<label class="col-lg-5">VDC/Municipality LB</label>
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
								<label class="col-lg-5">Utility of Bridge LB</label>
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

								<label class="col-lg-5 ">Major VDC/Municipality</label>

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

								<label class="col-lg-5 ">Project Fiscal Year</label>

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

								<label class="col-lg-5 ">VDC/Municipality Right Bank</label>
								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03municipality_rb', 'muni01municipality_vcd', 'muni01name', 'muni01id', et_setFormVal('bri03municipality_rb', $objOldRec), '', 'class="form-control" ' . $valDisable . '', array('SortBy' => 'muni01name')) ?>

								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-5">Utility of Bridge Right Bank</label>
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

								<label class="col-lg-5 ">Bridge Series</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03bridge_series" id="bri03bridge_series" value="<?php //echo et_setFormVal('bri03bridge_series', $objOldRec); 
																																		?>" />

								</div>

							</div> -->


							<div class="form-group clearfix">

								<label class="col-lg-5 ">Supporting agency</label>

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

							<div class="form-group clearfix">

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

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Physical Progress</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03physical_progress', 'physical_progress_types', 'pp_name', 'pp_id', et_setFormVal('bri03physical_progress', $objOldRec), '', 'class="form-control"') ?>

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

					<!-- /.row -->



					<!-- /.row -->





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


						<input type="hidden" class="form-control" name="bri03id" id="bri03id" value="0">

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
								foreach ($casteGroup as $key => $caste) :
								?>
									<tr>
										<td><?= $caste ?></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_total form-control bc_total_<?= $key; ?>" name="bc_total_<?= $key; ?>" id="bc_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_poor form-control bc_poor_<?= $key; ?>" name="bc_poor_<?= $key; ?>" id="bc_poor_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_women form-control bc_women_<?= $key; ?>" name="bc_women_<?= $key; ?>" id="bc_women_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
										<td><input type="text" data-row="<?=$key; ?>" class="bc-text bc_men form-control bc_men_<?= $key; ?>" name="bc_men_<?= $key; ?>" id="bc_men_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
										<td><input type="text" readonly data-row="<?=$key; ?>" data-col="" class="bc_sub_total bc_sub_total_<?= $key; ?> form-control " name="bc_sub_total_<?= $key; ?>" id="bc_sub_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									</tr>
								<?php endforeach; ?>
								<tr>
									<td>Total</td>
									<td><input type="text" readonly class="bc-total form-control " name="total_no_households" id="total_no_households" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="total_no_households_poor" id="total_no_households_poor" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="bp_women_total" id="bp_women_total" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="bp_men_total" id="bp_men_total" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class="bc-total form-control " name="grand_total" id="grand_total" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
								</tr>
								<tr>
									<td>%</td>
									<td><input type="text" readonly class=" form-control " name="percent_no_households" id="percent_no_households" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="percent_no_households_poor" id="percent_no_households_poor" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="bp_women_percent" id="bp_women_percent" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="bp_men_percent" id="bp_men_percent" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="grand_percent" id="grand_percent" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" /></td>
								</tr>
								<tr>

									<th class="cost width center">Assessment By</th>
									<th><input type="text" class=" form-control " name="bb_assessment_by" id="bb_assessment_by" value="<?php echo et_setFormValBlank('bb_assessment_by', $objOldRec); ?>" /></th>
									<th>Assessment Date</th>
									<th class="">
									<div class="col-lg-7 datebox-container ">

										<div class="col-lg-10 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="bb_assessment_date" id="bb_assessment_date" value="<?php if (isset($objImplementationRec['bb_assessment_date']) && $objImplementationRec['bri05site_assessment'] != "0000-00-00") {
																																						echo et_setFormVal('bb_assessment_date', $objImplementationRec);
																																					} ?>" />

										</div>

										</div>
									</th>
									<th colspan="2"><input name="rd_active" id="rd_active" type="radio" value="1"><label for="rd_active">Active</label></th>

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


						<input type="hidden" class="form-control" name="bri03id" id="bri03id" value="0">

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
										?>
										<td><input type="text" data-row="<?=$key; ?>" class="ph-text form-control ph_total_<?= $key; ?>" name="ph_total_<?= $key; ?>" id="ph_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
										<?php endforeach; ?>										
										<td><input type="text" readonly class=" ph-sum form-control " name="ph-sum" id="ph-sum" value="<?php echo et_setFormVal('ph-sum', $objOldRec); ?>" /></td>
										<td><input type="text" class=" ph-female form-control " name="ph-female" id="ph-female" value="<?php echo et_setFormVal('ph-female', $objOldRec); ?>" /></td>
										<td><input type="text" class=" ph-male form-control " name="ph-male" id="ph-male" value="<?php echo et_setFormVal('ph-male', $objOldRec); ?>" /></td>
									</tr>
								<tr>
									<td>%</td>
									<?php
										foreach ($casteGroup as $key => $caste) :
										?>
										<td><input type="text" readonly class="total_caste_percent form-control " name="total_caste_percent_<?=$key;?>" id="total_caste_percent_<?=$key;?>" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" /></td>
										<?php endforeach; ?>
									
										<td><input type="text" readonly class="total_sum_percent form-control " name="total_sum_percent" id="total_sum_percent" value="<?php echo et_setFormVal('total_sum_percent', $objOldRec); ?>" /></td>
										<td><input type="text" class="total_female_percent form-control " name="total_female_percent" id="total_female_percent" value="<?php echo et_setFormVal('total_female_percent', $objOldRec); ?>" /></td>
										<td><input type="text" class="total_male_percent form-control " name="total_male_percent" id="total_male_percent" value="<?php echo et_setFormVal('total_male_percent', $objOldRec); ?>" /></td>

								</tr>
								
								<tr>

									<th class="cost width center">Assessment By</th>
									<th><input type="text" class=" form-control " name="ph_assessment_by" id="ph_assessment_by" value="<?php echo et_setFormValBlank('ph_assessment_by', $objOldRec); ?>" /></th>
									<th>Assessment Date</th>
									<th class="">
									<div class="col-lg-12 datebox-container ">

										<div class="col-lg-12 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="ph_assessment_date" id="ph_assessment_date" value="<?php if (isset($objImplementationRec['ph_assessment_date']) && $objImplementationRec['bri05site_assessment'] != "0000-00-00") {
																																						echo et_setFormVal('ph_assessment_date', $objImplementationRec);
																																					} ?>" />

										</div>

										</div>
									</th>
									<th colspan="2"><input name="ph_active" id="ph_active" type="radio" value="1"><label for="ph_active">Active</label></th>

								</tr>
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

					<div class="form-group" style="text-align: center;">
						<h3 class="">

							UC Composition

						</h3>
					</div>



				</div>

				<!-- /.row -->
				<div class="row clearfix">

					<div class="col-lg-12">


						<input type="hidden" class="form-control" name="bri03id" id="bri03id" value="0">

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
									foreach ($casteGroup as $key => $caste) :
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="cp" class="uc-text uc-cp-text form-control uc_caste_<?= $key; ?> uc_cp_total_<?= $key; ?>" name="uc_cp_total_<?= $key; ?>" id="uc_cp_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-cp-sum" id="uc-cp-sum" value="<?php echo et_setFormVal('uc-cp-sum', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-<?=$key;?>-female" id="uc-cp-female" value="<?php echo et_setFormVal('uc-cp-female', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-<?=$key;?>-male" value="<?php echo et_setFormVal('uc-male', $objOldRec); ?>" /></td>
								</tr>
								<tr>
									<td>(DY) Chairperson</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="dy" class="uc-text uc-dy-text form-control uc_caste_<?= $key; ?> uc_dy_total_<?= $key; ?>" name="uc_dy_total_<?= $key; ?>" id="uc_dy_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-dy-sum" id="uc-dy-sum" value="<?php echo et_setFormVal('uc-dy-sum', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-<?=$key;?>-female" id="uc-dy-female" value="<?php echo et_setFormVal('uc-dy-female', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-<?=$key;?>-male" id="uc-dy-male" value="<?php echo et_setFormVal('uc-dy-male', $objOldRec); ?>" /></td>
								</tr>
								<tr>
									<td>Secretary</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="sc" class="uc-text uc-sc-text form-control uc_caste_<?= $key; ?> uc_sc_total_<?= $key; ?>" name="uc_sc_total_<?= $key; ?>" id="uc_sc_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-sc-sum" id="uc-sc-sum" value="<?php echo et_setFormVal('uc-sc-sum', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-<?=$key;?>-female" id="uc-sc-female" value="<?php echo et_setFormVal('uc-sc-female', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-<?=$key;?>-male" id="uc-sc-male" value="<?php echo et_setFormVal('uc-sc-male', $objOldRec); ?>" /></td>
								</tr>
								<tr>
									<td>Treasurer</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="tr" class="uc-text uc-tr-text form-control uc_caste_<?= $key; ?> uc_tr_total_<?= $key; ?>" name="uc_tr_total_<?= $key; ?>" id="uc_tr_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-tr-sum" id="uc-tr-sum" value="<?php echo et_setFormVal('uc-tr-sum', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-<?=$key;?>-female" id="uc-tr-female" value="<?php echo et_setFormVal('uc-tr-female', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-<?=$key;?>-male" id="uc-tr-male" value="<?php echo et_setFormVal('uc-tr-male', $objOldRec); ?>" /></td>
								</tr>
								<tr>
									<td>UC Members</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td><input type="text" data-row="<?=$key; ?>" data-col="mem" class="uc-text uc-mem-text form-control uc_caste_<?= $key; ?> uc_mem_total_<?= $key; ?>" name="uc_mem_total_<?= $key; ?>" id="uc_mem_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc-sum form-control " name="uc-mem-sum" id="uc-mem-sum" value="<?php echo et_setFormVal('uc-mem-sum', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-female form-control " name="uc-<?=$key;?>-female" id="uc-mem-female" value="<?php echo et_setFormVal('uc-mem-female', $objOldRec); ?>" /></td>
									<td><input type="text" class=" uc-male form-control " name="uc-<?=$key;?>-male" id="uc-mem-male" value="<?php echo et_setFormVal('uc-mem-male', $objOldRec); ?>" /></td>
								</tr>
								<tr>
									<td>Total</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td><input type="text" readonly data-row="<?=$key; ?>" class="uc-text form-control uc_total_<?= $key; ?>" name="uc_total_<?= $key; ?>" id="uc_total_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="form-control " name="uc-sum" id="uc-sum" value="<?php echo et_setFormVal('uc-sum', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="uc-female" id="uc-female" value="<?php echo et_setFormVal('uc-female', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class=" form-control " name="uc-male" id="uc-male" value="<?php echo et_setFormVal('uc-male', $objOldRec); ?>" /></td>
								</tr>
								<tr>
								<td>%</td>
									<?php
									foreach ($casteGroup as $key => $caste) :
									?>
									<td><input type="text" readonly data-row="<?=$key; ?>" class="uc-percent form-control uc_percent_<?= $key; ?>" name="uc_percent_<?= $key; ?>" id="uc_percent_<?= $key; ?>" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" /></td>
									<?php endforeach; ?>
									<td><input type="text" readonly class="uc_total_sum_percent form-control " name="uc_total_sum_percent" id="uc_total_sum_percent" value="<?php echo et_setFormVal('uc_total_sum_percent', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class="uc_total_female_percent form-control " name="uc_total_female_percent" id="uc_total_female_percent" value="<?php echo et_setFormVal('uc_total_female_percent', $objOldRec); ?>" /></td>
									<td><input type="text" readonly class="uc_total_male_percent form-control " name="uc_total_male_percent" id="uc_total_male_percent" value="<?php echo et_setFormVal('uc_total_male_percent', $objOldRec); ?>" /></td>
								</tr>
								<tr>

									<th class="cost width center">Assessment By</th>
									<th><input type="text" class=" form-control " name="uc_assessment_by" id="uc_assessment_by" value="<?php echo et_setFormValBlank('uc_assessment_by', $objOldRec); ?>" /></th>
									<th>Assessment Date</th>
									<th class="">
									<div class="col-lg-12 datebox-container ">

										<div class="col-lg-12 nopad datetimepicker input-group date ">

											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

											<input type="text" class=" form-control " name="uc_assessment_date" id="uc_assessment_date" value="<?php if (isset($objImplementationRec['uc_assessment_date']) && $objImplementationRec['bri05site_assessment'] != "0000-00-00") { echo et_setFormVal('uc_assessment_date', $objImplementationRec); } ?>" />

										</div>

										</div>
									</th>
									<th colspan="4"><input name="uc_active" id="uc_active" type="radio" value="1"><label for="uc_active">Active</label></th>

								</tr>
							</table>

						</div>
					</div>
				</div>
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
						const percent_women = (bc_women_no/bc_total) * 100;
						const percent_men = (bc_men_no/bc_total) * 100;
						const percent_total = (parseInt($('#total_no_households').val()) / parseInt($("#grand_total").val())) * 100;
						// console.log(parseInt($('#total_no_households').val()));
						// console.log(parseInt($('#grand_total').val()));
						// console.log(percent_total);
						$('#total_no_households').val(bc_total);
						$('#total_no_households_poor').val(bc_poor);
						$('#bp_women_total').val(bc_women_no);
						$('#bp_men_total').val(bc_men_no);
						$('#grand_total').val(bc_sub_total);
						$('#percent_no_households').val("100");	
						$('#percent_no_households_poor').val(percent_poor.toFixed(2));	
						$('#bp_women_percent').val(percent_women.toFixed(2));	
						$('#bp_men_percent').val(percent_men.toFixed(2));		
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

					function calculatePublicSum($obj, $strRef='') {
						//colId = $obj.data('col');
						rowId = $obj.data('row');											
						$(".ph-text").each(function() {
							id = $(this).data('row');
							const ph_total = $("#ph_total_"+id).val();
							const ph_sum = $("#ph-sum").val();
							const total_caste_percent = (ph_total/ph_sum) * 100;
							$("#total_caste_percent_"+id).val(total_caste_percent.toFixed(2));
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