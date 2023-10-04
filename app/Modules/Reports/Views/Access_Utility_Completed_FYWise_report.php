<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<?php
// $currentPage = $pager->getCurrentPage();
// $pageCount = $pager->getPageCount();
//$start_from = ($currentPage-1) * $records_per_page+1;
// if($currentPage > 1)
// $start_from = $previous_records + 1;
// else
// $start_from = 1;

?>
<div id="page-wrapper" class="largeRpt">

    <div class="alignLeft">
        <form method="get" name="frmProvinceFilter" action="<?php echo site_url(); ?>/reports/Access_Utility_Completed_FYWise_report<?php echo (isset($blnMM) && $blnMM) ? '/' . $blnMM : ''; ?>">
            <input type="hidden" name="start_year" value="<?php echo $startyear['fis01id']; ?>" />
            <input type="hidden" name="end_year" value="<?php echo $endyear['fis01id']; ?>" />
            <input type="button" class="btn btn-md btn-success no-print" name="btn_submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
            <p><h4 class="no-print">Filter By Province</h4></p>
            <select name="selProvince" onchange="document.frmProvinceFilter.submit();" class="no-print">
                    <option value="">--Select--</option>
                    <?php                         
                    foreach($provinceList as $province) {                                              
                        ?>                            
                    <option value="<?php echo $province->province_id;?>" <?php echo ($selProvince != '' && $selProvince == $province->province_id)?'selected="selected"':'';?>><?php echo $province->province_name;?></option>
                    <?php } ?>
                    <option value="all">All</option>
                </select> 
        </form>
    </div>

    <div class="container-fluid" id="printArea">

        <div class="row">
            <div class="col-lg-12 mainBoard">

                <h2 class="reportHeader center">Access and Utility Report</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width:30px;" class="center">SN</th>
                                <th rowspan="2" class="center" style="width:100px;">Bridge Id</th>
                                <th rowspan="2" class="center" style="width:120px;">Bridge Name</th>
                                <th style="width:80px;" rowspan="2" class="center">Palika</th>
                                <th rowspan="2" class="center" >Distance Gained (hrs)</th>
                                <th rowspan="2" class="center">Distance to Road Head (days)</th>
                                <th rowspan="2" class="center">River Type (months)</th>
                                <th colspan="2" class="center" style="width:150px;">Bridge Utility</th>
                            </tr>
                            <tr>
                                <th class="center">Left Bank</th>
                                <th class="center">Right Bank</th>
                            </tr>
                        </thead>

                        <?php

                        if (is_array($arrPrintList)) {

                            $sum1 = 0;
                            $i = 1; $j = 0;
                            // if($pager->getCurrentPage() > 1) {
                            //     $i = ITEMS_PER_PAGE;
                            // }

                            //$i= $start_from;
                            //$start=0;
                            
                           
                            $total_bri03portering_distance = 0;
                            $total_bri03road_head = 0;
                            $total_bri03river_type = 0;
                            //total utilities
                            $total_markets = 0;
                            $total_health_posts = 0;
                            $total_schools = 0;
                            $total_social_functions = 0;
                            $total_household_activities = 0;
                            foreach ($arrPrintList as $dataRow) {
                        ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="col-lg-12" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name']; ?></span></div>
                                    </td>
                                </tr>
                                <?php
                                $total_bri03portering_distance = 0; $total_bri03road_head = 0; $total_bri03river_type = 0;
                                //echo "<pre>"; var_dump($dataRow['data']);exit;
                                foreach ($dataRow['data'] as $dataRow1) {

                                    //totals
                                    if(isset($dataRow1['bri03portering_distance']))
                                        $total_bri03portering_distance = $total_bri03portering_distance + $dataRow1['bri03portering_distance'];
                                    if(isset($dataRow1['bri03road_head']))
                                        $total_bri03road_head = $total_bri03road_head + (float) $dataRow1['bri03road_head'];
                                    if(isset($dataRow1['bri03river_type']))
                                        $total_bri03river_type = $total_bri03river_type + (float) $dataRow1['bri03river_type'];

                                    if($dataRow1['major_vdc'] == 0) {
                                        $palika = $dataRow1['left_palika'];
                                    } else {
                                        $palika = $dataRow1['right_palika'];
                                    }
                                    $total_bri03portering_distance = $total_bri03portering_distance + $dataRow1['bri03portering_distance'];
                                    if(is_numeric($dataRow1['bri03road_head'])) {
                                        $total_bri03road_head = $total_bri03road_head + $dataRow1['bri03road_head'];    
                                    }
                                    
                                    if(is_numeric($dataRow1['bri03river_type'])) {
                                        $total_bri03river_type = $total_bri03river_type + $dataRow1['bri03river_type']; 
                                    }

                                    foreach ($getUtilities as $utility) { 
                                        if($utility['bu_id'] == $dataRow1['bri03utility_left_bank'] || $utility['bu_id'] == $dataRow1['bri03utility_right_bank']) {
                                            $uname = str_replace(' ', '_',strtolower(trim($utility['bu_name'])));
                                            $total_uname = 'total_'.$uname;
                                            if($utility['bu_id'] == $dataRow1['bri03utility_left_bank']) {
                                                $$total_uname = $$total_uname + $dataRow1['bri03utility_left_bank'];    
                                            }
                                            if($utility['bu_id'] == $dataRow1['bri03utility_right_bank']) {
                                                $$total_uname = $$total_uname + $dataRow1['bri03utility_right_bank'];    
                                            }
                                            
                                            //break;    
                                        }

                                        
                                    }
                                ?>
                                    <tbody>

                                        <tr>
                                            <td style="width:30px;" class="center"><?php echo $i; ?></td>
                                            <td style="width:100px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                            <td style="width:80px;" class="center"><?php echo $palika; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $dataRow1['bri03portering_distance']; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $dataRow1['bri03road_head']; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $dataRow1['bri03river_type']; ?></td>

                                            <td style="width:75px;" class="center"><?php echo $dataRow1['bri03utility_lb_name']; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $dataRow1['bri03utility_rb_name']; ?></td>
                                        </tr>
                                    <?php $i++;
                                } ?>
                                
                                    </tbody>
                                    
                            <?php
                            $j++;
                            } //end of dist
                            ?>
                            <?php //if($currentPage == $pageCount) : ?>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">Total:</td>
                                        <td class="center"><?=$arrTotals['total_bri03portering_distance'];?></td>
                                        <td class="center"><?=$arrTotals['total_bri03road_head'];?></td>
                                        <td class="center"><?=$arrTotals['total_bri03river_type'];?></td>
                                        <td colspan="2" rowspan="6">
                                            <table>
                                                <?php foreach ($getUtilities as $utility) { 
                                                    $buname = str_replace(' ', '_',strtolower(trim($utility['bu_name'])));
                                                    //$total_buname = 'total_'.$buname;
                                                    if($utility['bu_id'] == 1)
                                                        $percent_buname = $arrTotals['markets_percent'];
                                                    elseif($utility['bu_id'] == 2)
                                                        $percent_buname = $arrTotals['health_percent'];
                                                    elseif($utility['bu_id'] == 3)
                                                        $percent_buname = $arrTotals['schools_percent'];
                                                    elseif($utility['bu_id'] == 4)
                                                        $percent_buname = $arrTotals['social_percent'];
                                                    elseif($utility['bu_id'] == 5)
                                                        $percent_buname = $arrTotals['household_percent'];

                                                    ?>
                                                <tr>
                                                    <td style="font-size: 12px;width:165px;"><strong><?=$utility['bu_name'];?></strong></td>
                                                    <!-- <td><?php //$$total_buname;?></td> -->
                                                    <td style="text-align: right;"><?=$percent_buname;?> %</td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" rowspan="5">&nbsp;</td>
                                        <!-- <td colspan="2">
                                            
                                        </td> -->
                                    </tr>
                                    <tr>
                                  </tr>
                                  <tr>
                                  </tr>
                                  <tr>
                                  </tr>
                                  <tr>
                                  </tr>
                                <?php //endif; ?>
                                <input type="hidden" name="records_per_page" value="<?=$records_per_page;?>">
                            <?php
                        }
                            ?>
                            <?php
                            /*if($currentPage == $pageCount) {
                            ?>
                            <tr>
                                <td colspan="7">Total:</td>
                                <td><?=$total_bridges;?></td>
                            </tr>
                        <?php }*/ ?>
                    </table>
                    <!-- pagination block -->
                    <div class="mt-3 hidden-print">
                        <?php //$pager = \Config\Services::pager(); 
                        ?>
                        <?php if (isset($pager)) : ?>
                            <?php $pagi_path = 'reports/Access_Utility_Completed_FYWise_report'; ?>
                            <?php //$pager->setPath($pagi_path); 
                            ?>
                            <?= $pager->links(); ?>
                        <?php endif; ?>
                        <?php //echo "Page ".$pager->getCurrentPage()." of ".$pager->getPageCount();
                        ?>
                    </div>
                </div>

                <div class="clear"></div>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<?= $this->endSection() ?>