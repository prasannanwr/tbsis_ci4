<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

    <div class="alignLeft">
        <form method="get" name="frmProvinceFilter" action="<?php echo site_url(); ?>/reports/UC_Composition_FYWise_report<?php echo (isset($blnMM) && $blnMM) ? '/' . $blnMM : ''; ?>">
            <input type="hidden" name="start_year" value="<?php echo $startyear['fis01id']; ?>" />
            <input type="hidden" name="end_year" value="<?php echo $endyear['fis01id']; ?>" />
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


                <h2 class="reportHeader center">User Committee Composition (Between <?php echo $startyear['fis01code'] . " - " . $endyear['fis01code']; ?>) <!--as of <?php //echo date("j F, Y"); ?>--></h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:55px;" class="center">SN</th>
                                <th class="center" style="width:150px;">Bridge Id</th>
                                <th class="center" style="width:150px;">Name</th>
                                <th style="width:160px;" class="center">Total no. of Members</th>
                                <th class="center">Men</th>
                                <th class="center">Women</th>
                                <th class="center">Dalits</th>
                                <th class="center">Janjaties</th>
                                <th class="center">Minorities</th>
                                <th class="center">BCT</th>
                            </tr>
                        </thead>

                        <?php

                        if (is_array($arrPrintList)) {
                            $sum1 = 0;
                            $i = 0;
                            foreach ($arrPrintList as $dataRow) {

                        ?>
                                <tr>
                                    <td colspan="10">
                                        <div class="col-lg-10" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name']; ?></span></div>
                                    </td>
                                </tr>
                                <?php
                                $grand_total_members = 0;
                                $total_members = 0;
                                $total_men = 0;
                                $total_women = 0;
                                $dalit_total = 0;
                                $janjati_total = 0;
                                $minorities_total = 0;
                                $bct_total = 0;

                                $percent_women = 0;
                                $percent_men = 0;
                                $dalit_percent = 0;
                                $janjati_percent = 0;
                                $minorities_percent = 0;
                                $bct_percent = 0;
                                foreach ($dataRow['data'] as $dataRow1) {
                                    $total_members = $dataRow1['b_uc_cp_total'] + $dataRow1['b_uc_dy_total'] + $dataRow1['b_uc_sc_total'] + $dataRow1['b_uc_tr_total'] + $dataRow1['b_uc_mm_total'];
                                    $men = $dataRow1['b_uc_cp_male'] + $dataRow1['b_uc_dy_male'] + $dataRow1['b_uc_sc_male'] + $dataRow1['b_uc_tr_male'] + $dataRow1['b_uc_mm_male']; 
                                    $women = $dataRow1['b_uc_cp_female'] + $dataRow1['b_uc_dy_female'] + $dataRow1['b_uc_sc_female'] + $dataRow1['b_uc_tr_female'] + $dataRow1['b_uc_mm_female']; 

                                    $dalit = $dataRow1['b_uc_cp_dalit'] + $dataRow1['b_uc_dy_dalit'] + $dataRow1['b_uc_sc_dalit'] + $dataRow1['b_uc_tr_dalit'] + $dataRow1['b_uc_mm_dalit'];
                                    $janjati = $dataRow1['b_uc_cp_janjati'] + $dataRow1['b_uc_dy_janjati'] + $dataRow1['b_uc_sc_janjati'] + $dataRow1['b_uc_tr_janjati'] + $dataRow1['b_uc_mm_janjati'];
                                    $minorities = $dataRow1['b_uc_cp_minorities'] + $dataRow1['b_uc_dy_minorities'] + $dataRow1['b_uc_sc_minorities'] + $dataRow1['b_uc_tr_minorities'] + $dataRow1['b_uc_mm_minorities'];
                                    $bct = $dataRow1['b_uc_cp_bct'] + $dataRow1['b_uc_dy_bct'] + $dataRow1['b_uc_sc_bct'] + $dataRow1['b_uc_tr_bct'] + $dataRow1['b_uc_mm_bct'];

                                    $grand_total_members = $grand_total_members + $total_members;
                                    $total_men = $total_men + $men;
                                    $total_women = $total_women + $women;

                                    $dalit_total = $dalit_total + $dalit;
                                    $bct_total = $bct_total + $bct;
                                    $janjati_total = $janjati_total + $janjati;
                                    $minorities_total = $minorities_total + $minorities;
                                    //$grand_total = $grand_total + $total_dag;
                                ?>




                                    <tbody>

                                        <tr>
                                            <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $total_members; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $men; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $women; ?></td>

                                            <td style="width:75px;" class="center"><?php echo $dalit; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $janjati; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $minorities; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $bct; ?></td>

                                            
                                        </tr>
                                    <?php $i++;
                                } ?>
                                    </tbody>
                                    <?php $sum1 += $i; ?>
                                    <?php
                                    if ($grand_total_members > 0) :
                                        $dalit_percent = ($dalit_total / $grand_total_members) * 100;
                                        $janjati_percent = ($janjati_total / $grand_total_members) * 100;
                                        $minorities_percent = ($minorities_total / $grand_total_members) * 100;
                                        $bct_percent = ($bct_total / $grand_total_members) * 100;

                                        $percent_women = ($total_women / $grand_total_members) * 100;
                                        $percent_men = ($total_men / $grand_total_members) * 100;
                                    endif;
                                    ?>
                                    <tr>
                                        <td colspan="3" class="center">Total: </td>
                                        <td class="center"><?php echo $grand_total_members; ?></td>
                                        <td class="center"><?php echo $total_men; ?></td>
                                        <td class="center"><?php echo $total_women; ?></td>
                                        <td class="center"><?php echo $dalit_total; ?></td>
                                        <td class="center"><?php echo $janjati_total; ?></td>
                                        <td class="center"><?php echo $minorities_total; ?></td>
                                        <td class="center"><?php echo $bct_total; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="center" colspan="4">%</td>
                                        <td class="center"><?php echo number_format($percent_men, 2); ?></td>
                                        <td class="center"><?php echo number_format($percent_women, 2); ?></td>
                                        <td class="center"><?php echo number_format($dalit_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($janjati_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($minorities_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($bct_percent, 2); ?></td>
                                    </tr>
                            <?php

                            } //end of dist
                        }
                            ?>
                    </table>
                    <!-- pagination block -->
                    <div class="mt-3">
                        <?php //$pager = \Config\Services::pager(); 
                        ?>
                        <?php if (isset($pager)) : ?>
                            <?php $pagi_path = 'reports/UC_Composition_FYWise_report?dataStart=' . $dataStart; ?>
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