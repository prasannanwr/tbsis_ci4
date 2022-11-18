<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

    <div class="alignRight">
        <form method="post" action="<?php echo site_url(); ?>/reports/UC_Proportion_Representation_FYWise_report<?php echo (isset($blnMM) && $blnMM) ? '/' . MM_CODE : ''; ?>" target="_blank">
            <input type="hidden" name="start_year" value="<?php echo $startyear['fis01id']; ?>" />
            <input type="hidden" name="end_year" value="<?php echo $endyear['fis01id']; ?>" />
            <!-- <input type="submit"  class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" /> -->
            <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
        </form>
    </div>

    <div class="container-fluid" id="printArea">

        <div class="row">
            <div class="col-lg-12 mainBoard">


                <h2 class="reportHeader center">UC Proportion Representation Report (Between <?php echo $startyear['fis01code'] . " - " . $endyear['fis01code']; ?>) as of <?php echo date("j F, Y"); ?></h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width:55px;" class="center">SN</th>
                                <th rowspan="2" class="center" style="width:150px;">Bridge Id</th>
                                <th rowspan="2" class="center" style="width:160px;">Name</th>
                                <th colspan="4" class="center" >Beneficiary Population</th>
                                <th colspan="4" class="center">UC Compostion</th>
                                <th rowspan="2" class="center" style="width:150px;">Proportionally Representative</th>
                            </tr>
                            <tr>
                                <th class="center">Dalits (%)</th>
                                <th class="center">Janjaties (%)</th>
                                <th class="center">Minorities (%)</th>
                                <th class="center">Others (%)</th>
                                <th class="center">Dalits (%)</th>
                                <th class="center">Janjaties (%)</th>
                                <th class="center">Minorities (%)</th>
                                <th class="center">BCT (%)</th>
                            </tr>
                        </thead>

                        <?php

                        if (is_array($arrPrintList)) {
                            $sum1 = 0;
                            $i = 0; $j = 0;
                            foreach ($arrPrintList as $dataRow) {

                        ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="col-lg-12" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name']; ?></span></div>
                                    </td>
                                </tr>
                                <?php
                                $dalit_pecent = 0;
                                $janjati_pecent = 0;
                                $minorities_pecent = 0;
                                $bct_pecent = 0;
                                $uc_dalit_percent = 0;
                                $uc_janjati_percent = 0;
                                $uc_minorities_percent = 0;
                                $uc_bct_percent = 0;
                                foreach ($dataRow['data'] as $dataRow1) {
                                    $total_beneficiaries = $dataRow1['total_women'] + $dataRow1['total_men'];
                                    if($total_beneficiaries > 0) {
                                        $dalit_pecent = ($dataRow1['dalit_total']/$total_beneficiaries) * 100;
                                        $janjati_pecent = ($dataRow1['janjati_total']/$total_beneficiaries) * 100;
                                        $minorities_pecent = ($dataRow1['minorities_total']/$total_beneficiaries) * 100;
                                        $bct_pecent = ($dataRow1['bct_total']/$total_beneficiaries) * 100;
                                    }

                                    $grand_total = $dataRow1['b_uc_cp_total'] + $dataRow1['b_uc_dy_total'] + $dataRow1['b_uc_sc_total'] + $dataRow1['b_uc_tr_total'] + $dataRow1['b_uc_mm_total'];
                                    $dalit_total = $dataRow1['b_uc_cp_dalit'] + $dataRow1['b_uc_cp_janjati'] + $dataRow1['b_uc_sc_janjati'] + $dataRow1['b_uc_tr_janjati'] + $dataRow1['b_uc_mm_janjati'];
                                    $janjati_total = $dataRow1['b_uc_cp_janjati'] + $dataRow1['b_uc_cp_janjati'] + $dataRow1['b_uc_sc_janjati'] + $dataRow1['b_uc_tr_janjati'] + $dataRow1['b_uc_mm_janjati'];
                                    $minorities_total = $dataRow1['b_uc_cp_minorities'] + $dataRow1['b_uc_dy_minorities'] + $dataRow1['b_uc_sc_minorities'] + $dataRow1['b_uc_tr_minorities'] + $dataRow1['b_uc_mm_minorities'];
                                    $bct_total = $dataRow1['b_uc_cp_bct'] + $dataRow1['b_uc_dy_bct'] + $dataRow1['b_uc_sc_bct'] + $dataRow1['b_uc_tr_bct'] + $dataRow1['b_uc_mm_bct'];

                                    if($grand_total > 0) {
                                        $uc_dalit_percent = ($dalit_total/$grand_total) * 100;
                                        $uc_janjati_percent = ($janjati_total/$grand_total) * 100;
                                        $uc_minorities_percent = ($minorities_total/$grand_total) * 100;
                                        $uc_bct_percent = ($bct_total/$grand_total) * 100;
                                    }
                                ?>
                                    <tbody>

                                        <tr>
                                            <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                            <td style="width:60px;" class="center"><?php echo number_format($dalit_pecent,2); ?></td>
                                            <td style="width:60px;" class="center"><?php echo number_format($janjati_pecent,2); ?></td>
                                            <td style="width:75px;" class="center"><?php echo number_format($minorities_pecent,2); ?></td>
                                            <td style="width:75px;" class="center"><?php echo number_format($bct_pecent,2); ?></td>

                                            <td style="width:75px;" class="center"><?php echo number_format($uc_dalit_percent,2); ?></td>
                                            <td style="width:75px;" class="center"><?php echo number_format($uc_janjati_percent,2); ?></td>
                                            <td style="width:75px;" class="center"><?php echo number_format($uc_minorities_percent,2); ?></td>
                                            <td style="width:75px;" class="center"><?php echo number_format($uc_bct_percent,2); ?></td>

                                            <td>&nbsp;</td>
                                        </tr>
                                    <?php $i++;
                                } ?>
                                    <tr>
                                        <td colspan="11" style="text-align:right;">Total (Accepted):</td>
                                        <td><?=$j;?></td>
                                    </tr>
                                    </tbody>
                                    
                            <?php
                            $j++;
                            } //end of dist
                        }
                            ?>
                    </table>
                    <!-- pagination block -->
                    <div class="mt-3">
                        <?php //$pager = \Config\Services::pager(); 
                        ?>
                        <?php if ($pager) : ?>
                            <?php $pagi_path = 'reports/UC_Proportion_Representation_FYWise_report?dataStart=' . $dataStart; ?>
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