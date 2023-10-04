<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

    <div class="alignLeft">
        <form method="get" name="frmProvinceFilter" action="<?php echo site_url(); ?>/reports/UC_Executive_Position_FYWise_report<?php echo (isset($blnMM) && $blnMM) ? '/' . MM_CODE : ''; ?>">
            <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
            <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
            <!-- <input type="submit"  class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" /> -->
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


                <h2 class="reportHeader center">Executive Position Held in UC DateWise (Between <?php echo $startdate." - ".$enddate; ?>) as of <?php echo date("j F, Y"); ?></h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width:55px;" class="center">SN</th>
                                <th rowspan="2" class="center" style="width:150px;">Bridge Id</th>
                                <th rowspan="2" class="center" style="width:160px;">Bridge Name</th>
                                <th colspan="4" class="center" >Chairperson</th>
                                <th colspan="4" class="center">(DY) Chairperson</th>
                                <th colspan="4" class="center">Secretary</th>
                                <th colspan="4" class="center">Treasurer</th>
                                <th rowspan="2" style="width: 150px;" class="center">Status</th>
                            </tr>
                            <tr>
                                <th class="center">D</th>
                                <th class="center">J</th>
                                <th class="center">M</th>
                                <th class="center">W</th>
                                <th class="center">D</th>
                                <th class="center">J</th>
                                <th class="center">M</th>
                                <th class="center">W</th>
                                <th class="center">D</th>
                                <th class="center">J</th>
                                <th class="center">M</th>
                                <th class="center">W</th>
                                <th class="center">D</th>
                                <th class="center">J</th>
                                <th class="center">M</th>
                                <th class="center">W</th>
                            </tr>
                        </thead>

                        <?php

                        if (is_array($arrPrintList)) {
                            $sum1 = 0;
                            $i = 0;
                            foreach ($arrPrintList as $dataRow) {

                        ?>
                                <tr>
                                    <td colspan="20">
                                        <div class="col-lg-20" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name']; ?></span></div>
                                    </td>
                                </tr>
                                <?php
                                $dalit_cp_total = 0;
                                $janjati_cp_total = 0;
                                $minorities_cp_total = 0;
                                $bct_cp_total = 0;
                                
                                $dalit_dy_total = 0;
                                $janjati_dy_total = 0;
                                $minorities_dy_total = 0;
                                $bct_dy_total = 0;

                                $dalit_sc_total = 0;
                                $janjati_sc_total = 0;
                                $minorities_sc_total = 0;
                                $bct_sc_total = 0;

                                $dalit_tr_total = 0;
                                $janjati_tr_total = 0;
                                $minorities_tr_total = 0;
                                $bct_tr_total = 0;
                                $j = 0;
                                foreach ($dataRow['data'] as $dataRow1) {
                                    $dalit_cp_total = $dalit_cp_total + $dataRow1['b_uc_cp_dalit'];
                                    $janjati_cp_total = $janjati_cp_total + $dataRow1['b_uc_cp_janjati'];
                                    $minorities_cp_total = $minorities_cp_total + $dataRow1['b_uc_cp_minorities'];
                                    $bct_cp_total = $bct_cp_total + $dataRow1['b_uc_cp_bct'];

                                    $dalit_dy_total = $dalit_dy_total + $dataRow1['b_uc_dy_dalit'];
                                    $janjati_dy_total = $janjati_dy_total + $dataRow1['b_uc_dy_janjati'];
                                    $minorities_dy_total = $minorities_dy_total + $dataRow1['b_uc_dy_minorities'];
                                    $bct_dy_total = $bct_dy_total + $dataRow1['b_uc_dy_bct'];

                                    $dalit_sc_total = $dalit_sc_total + $dataRow1['b_uc_sc_dalit'];
                                    $janjati_sc_total = $janjati_sc_total + $dataRow1['b_uc_sc_janjati'];
                                    $minorities_sc_total = $minorities_sc_total + $dataRow1['b_uc_sc_minorities'];
                                    $bct_sc_total = $bct_sc_total + $dataRow1['b_uc_sc_bct'];

                                    $dalit_tr_total = $dalit_tr_total + $dataRow1['b_uc_tr_dalit'];
                                    $janjati_tr_total = $janjati_tr_total + $dataRow1['b_uc_tr_janjati'];
                                    $minorities_tr_total = $minorities_tr_total + $dataRow1['b_uc_tr_minorities'];
                                    $bct_tr_total = $bct_tr_total + $dataRow1['b_uc_tr_bct'];
                                    
                                ?>
                                    <tbody>

                                        <tr>
                                            <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_cp_dalit']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_cp_janjati']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_cp_minorities']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_cp_bct']; ?></td>

                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_dy_dalit']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_dy_janjati']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_dy_minorities']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_dy_bct']; ?></td>

                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_sc_dalit']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_sc_janjati']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_sc_minorities']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_sc_bct']; ?></td>

                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_tr_dalit']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_tr_janjati']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_tr_minorities']; ?></td>
                                            <td style="width:40px;" class="center"><?php echo $dataRow1['b_uc_tr_bct']; ?></td>

                                            <td>&nbsp;</td>
                                        </tr>
                                    <?php $i++;
                                    $j++;
                                } ?>
                                    <tr>
                                        <td colspan="3" style="text-align:right">Total (Accepted):</td>
                                        <td class="center"><?=$dalit_cp_total;?></td>
                                        <td class="center"><?=$janjati_cp_total;?></td>
                                        <td class="center"><?=$minorities_cp_total;?></td>
                                        <td class="center"><?=$bct_cp_total;?></td>

                                        <td class="center"><?=$dalit_dy_total;?></td>
                                        <td class="center"><?=$janjati_dy_total;?></td>
                                        <td class="center"><?=$minorities_dy_total;?></td>
                                        <td class="center"><?=$bct_dy_total;?></td>

                                        <td class="center"><?=$dalit_sc_total;?></td>
                                        <td class="center"><?=$janjati_sc_total;?></td>
                                        <td class="center"><?=$minorities_sc_total;?></td>
                                        <td class="center"><?=$bct_sc_total;?></td>

                                        <td class="center"><?=$dalit_tr_total;?></td>
                                        <td class="center"><?=$janjati_tr_total;?></td>
                                        <td class="center"><?=$minorities_tr_total;?></td>
                                        <td class="center"><?=$bct_tr_total;?></td>
                                      
                                        <td class="center"><?=$j;?></td>
                                    </tr>
                                    </tbody>
                                    
                            <?php
                            } //end of dist
                        }
                            ?>
                    </table>
                    <!-- pagination block -->
                    <div class="mt-3">
                        <?php //$pager = \Config\Services::pager(); 
                        ?>
                        <?php if ($pager) : ?>
                            <?php $pagi_path = 'reports/UC_Executive_Position_FYWise_report?dataStart=' . $dataStart; ?>
                            <?php //$pager->setPath($pagi_path); 
                            ?>
                            <?= $pager->links(); ?>
                        <?php endif; ?>
                        <?php //echo "Page ".$pager->getCurrentPage()." of ".$pager->getPageCount();
                        ?>
                    </div>
                    <div class="mt-3">
                        <strong>D:Dalits, J:Janjati, M:Minority, W:Women </strong>
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