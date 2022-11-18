<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

    <div class="alignRight">
        <form method="post" action="<?php echo site_url(); ?>/reports/Employment_Generation_DateWise_report<?php echo (isset($blnMM) && $blnMM) ? '/' . MM_CODE : ''; ?>" target="_blank">
            <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
            <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
            <!-- <input type="submit"  class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" /> -->
            <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
        </form>
    </div>

    <div class="container-fluid" id="printArea">

        <div class="row">
            <div class="col-lg-12 mainBoard">

                <h2 class="reportHeader center">Employment Generation (Between <?php echo $startdate." - ".$enddate; ?>) as of <?php echo date("j F, Y"); ?></h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:55px;" rowspan="3" class="center">SN</th>
                                <th class="center" rowspan="3 style="width:150px;">Bridge Id</th>
                                <th class="center" rowspan="3" style="width:150px;">Name</th>
                                <th class="center" colspan="2" rowspan="2">Dalits</th>
                                <th class="center" colspan="2" rowspan="2">Janjati</th>
                                <th class="center" colspan="2" rowspan="2">Minorities</th>
                                <th class="center" colspan="3">BCT</th>
                                <th class="center" colspan="3" rowspan="2">Total</th>
                                <th class="center" rowspan="3">Total</th>

                            </tr>
                            <tr>
                                <th class="center" colspan="2">Women</th>
                                <th class="center" rowspan="3">Men</th>
                            </tr>
                            <tr>
                                <th class="center">Poor</th>
                                <th class="center">Non-Poor</th>
                                <th class="center">Poor</th>
                                <th class="center">Non-Poor</th>
                                <th class="center">Poor</th>
                                <th class="center">Non-Poor</th>
                                <th class="center">Poor</th>
                                <th class="center">Non-Poor</th>
                                <th class="center">DAG</th>
                                <th class="center">Non-DAG</th>
                                <th class="center">Women</th>
                            </tr>
                            
                        </thead>

                        <?php

                        if (is_array($arrPrintList) && sizeof($arrPrintList) > 0) {
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
                                $dalit_poor_total = 0;
                                $dalit_non_poor_total = 0;
                                $janjati_poor_total = 0;
                                $janjati_non_poor_total = 0;
                                $minor_poor_total = 0;
                                $minor_non_poor_total = 0;
                                $bct_women_poor_total = 0;
                                $bct_women_non_poor_total = 0;
                                $bct_men_total = 0;
                                $toal_dag = 0;
                                $total_non_dag = 0;
                                $total_women = 0;
                                $grand_total = 0;

                                $percent_dalit_poor = 0;
                                $percent_dalit_non_poor = 0;
                                $janjati_poor_total_percent = 0;
                                $janjati_non_poor_total_percent = 0;
                                $minor_poor_total_percent = 0;
                                $minor_non_poor_total_percent = 0;
                                $bct_women_poor_percent = 0;
                                $bct_women_non_poor_percent = 0;
                                $bct_men_percent = 0;
                                $dag_percent = 0;
                                $non_dag_percent = 0;
                                $women_percent = 0;
                                $grand_percent = 0;

                                foreach ($dataRow['data'] as $dataRow1) {
                                    $dalit_nonpoor = ($dataRow1['beg_dalit_women'] + $dataRow1['beg_dalit_men']) - $dataRow1['beg_dalit_poor'];
                                    $janjati_nonpoor = ($dataRow1['beg_janjati_women'] + $dataRow1['beg_janjati_men']) - $dataRow1['beg_janjati_poor'];
                                    $minorities_nonpoor = ($dataRow1['beg_minorities_women'] + $dataRow1['beg_minorities_men']) - $dataRow1['beg_minorities_poor'];
                                    //$grand_total = $grand_total + $total_dag;
                                    $bct_women_non_poor = $dataRow1['beg_bct_f_women'] - $dataRow1['beg_bct_f_poor'];
                                    $dag = $dataRow1['beg_dalit_poor'] + $dataRow1['beg_janjati_poor'] + $dataRow1['beg_minorities_poor'] + $dataRow1['beg_bct_f_poor'];
                                    
                                    $non_dag = $dalit_nonpoor + $janjati_nonpoor + $minorities_nonpoor + $bct_women_non_poor + $dataRow1['beg_bct_m_men'];
                                    $women = $dataRow1['beg_dalit_women'] + $dataRow1['beg_janjati_women'] + $dataRow1['beg_minorities_women'] + $dataRow1['beg_bct_f_women'];
                                    $total = $dag + $non_dag;
                                    
                                    //totals
                                    $dalit_poor_total = $dalit_poor_total + $dataRow1['beg_dalit_poor'];
                                    $dalit_non_poor_total = $dalit_non_poor_total + $dalit_nonpoor;
                                    $janjati_poor_total = $janjati_poor_total + $dataRow1['beg_janjati_women'];
                                    $janjati_non_poor_total = $janjati_non_poor_total + $janjati_nonpoor;
                                    $minor_poor_total = $minor_poor_total + $dataRow1['beg_minorities_poor'];
                                    $minor_non_poor_total = $minor_non_poor_total + $minorities_nonpoor;
                                    $bct_women_poor_total = $bct_women_poor_total + $dataRow1['beg_bct_f_poor'];
                                    $bct_women_non_poor_total = $bct_women_non_poor_total + $bct_women_non_poor;
                                    $bct_men_total = $bct_men_total + $dataRow1['beg_bct_m_men'];
                                    $toal_dag = $toal_dag + $dag;
                                    $total_non_dag = $total_non_dag + $non_dag;
                                    $total_women = $total_women + $women;
                                    $grand_total = $grand_total + $total;
                                   
                                    ?>
                                    <tbody>

                                        <tr>
                                            <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $dataRow1['beg_dalit_poor']; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $dalit_nonpoor; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $dataRow1['beg_janjati_poor']; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $janjati_nonpoor; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $dataRow1['beg_minorities_poor']; ?></td>
                                            <td style="width:60px;" class="center"><?php echo $minorities_nonpoor; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $dataRow1['beg_bct_f_poor']; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $bct_women_non_poor; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $dataRow1['beg_bct_m_men']; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $dag; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $non_dag; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $women; ?></td>
                                            <td style="width:75px;" class="center"><?php echo $total; ?></td>

                                            
                                        </tr>
                                    <?php $i++;
                                } ?>
                                    </tbody>
                                    <?php $sum1 += $i; ?>
                                    <?php
                                    if($grand_total > 0) {
                                        $percent_dalit_poor = ($dalit_poor_total / $grand_total) * 100;
                                        $percent_dalit_non_poor = ($dalit_non_poor_total / $grand_total) * 100;
                                        $janjati_poor_total_percent = ($janjati_poor_total / $grand_total) * 100;
                                        $janjati_non_poor_total_percent = ($janjati_non_poor_total / $grand_total) * 100;
                                        $minor_poor_total_percent = ($minor_poor_total / $grand_total) * 100;
                                        $minor_non_poor_total_percent = ($minor_non_poor_total / $grand_total) * 100;
                                        $bct_women_poor_percent = ($bct_women_poor_total / $grand_total) * 100;
                                        $bct_women_non_poor_percent = ($bct_women_non_poor_total / $grand_total) * 100;
                                        $bct_men_percent = ($bct_men_total / $grand_total) * 100;
                                        $dag_percent = ($toal_dag / $grand_total) * 100;
                                        $non_dag_percent = ($total_non_dag / $grand_total) * 100;
                                        $women_percent = ($total_women / $grand_total) * 100;
                                        $grand_percent = ($grand_total / $grand_total) * 100;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" class="center">Total per District: </td>
                                        <td class="center"><?php echo $dalit_poor_total; ?></td>
                                        <td class="center"><?php echo $dalit_non_poor_total; ?></td>
                                        <td class="center"><?php echo $janjati_poor_total; ?></td>
                                        <td class="center"><?php echo $janjati_non_poor_total; ?></td>
                                        <td class="center"><?php echo $minor_poor_total; ?></td>
                                        <td class="center"><?php echo $minor_non_poor_total; ?></td>
                                        <td class="center"><?php echo $bct_women_poor_total; ?></td>
                                        <td class="center"><?php echo $bct_women_non_poor_total; ?></td>
                                        <td class="center"><?php echo $bct_men_total; ?></td>
                                        <td class="center"><?php echo $toal_dag; ?></td>
                                        <td class="center"><?php echo $total_non_dag; ?></td>
                                        <td class="center"><?php echo $total_women; ?></td>
                                        <td class="center"><?php echo $grand_total; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="center" colspan="3">%</td>
                                        <td class="center"><?php echo number_format($percent_dalit_poor, 2); ?></td>
                                        <td class="center"><?php echo number_format($percent_dalit_non_poor, 2); ?></td>
                                        <td class="center"><?php echo number_format($janjati_poor_total_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($janjati_non_poor_total_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($minor_poor_total_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($minor_non_poor_total_percent, 2); ?></td>

                                        <td class="center"><?php echo number_format($bct_women_poor_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($bct_women_non_poor_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($bct_men_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($dag_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($non_dag_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($women_percent, 2); ?></td>
                                        <td class="center"><?php echo number_format($grand_percent, 2); ?></td>

                                    </tr>
                            <?php

                            } //end of dist
                        } else { ?>
                        <tr>
                            <td colspan="16">There are no records.</td>
                        </tr>
                        <?php }
                            ?>
                    </table>
                    <!-- pagination block -->
                    <div class="mt-3">
                        <?php //$pager = \Config\Services::pager(); 
                        ?>
                        <?php if ($pager) : ?>
                            <?php $pagi_path = 'reports/Employment_Generation_FYWise_report?dataStart=' . $dataStart; ?>
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