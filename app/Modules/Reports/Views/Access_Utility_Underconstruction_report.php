<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

    <div class="alignRight">
        <form method="post" action="<?php echo site_url(); ?>/reports/UC_Proportion_Representation_FYWise_report<?php echo (isset($blnMM) && $blnMM) ? '/' . MM_CODE : ''; ?>" target="_blank">
            <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
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
                                <th rowspan="2" style="width:55px;" class="center">SN</th>
                                <th rowspan="2" class="center" style="width:150px;">Bridge Id</th>
                                <th rowspan="2" class="center" style="width:160px;">Bridge Name</th>
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
                            $i = 0; $j = 0;
                            foreach ($arrPrintList as $dataRow) {

                        ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="col-lg-12" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name']; ?></span></div>
                                    </td>
                                </tr>
                                <?php
                                
                                foreach ($dataRow['data'] as $dataRow1) {
                                    
                                ?>
                                    <tbody>

                                        <tr>
                                            <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                            <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
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
                        }
                            ?>
                    </table>
                    <!-- pagination block -->
                    <div class="mt-3">
                        <?php //$pager = \Config\Services::pager(); 
                        ?>
                        <?php if ($pager) : ?>
                            <?php $pagi_path = 'reports/UC_Proportion_Representation_FYWise_report'; ?>
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