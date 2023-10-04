<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

    <div class="alignRight">
        <form method="post" action="<?php echo site_url(); ?>/reports/UC_Composition_DateWise_report<?php echo (isset($blnMM) && $blnMM) ? '/' . MM_CODE : ''; ?>" target="_blank">
            <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
            <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
            <!-- <input type="submit"  class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" /> -->
            <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
        </form>
    </div>

    <div class="container-fluid" id="printArea">

        <div class="row">
            <div class="col-lg-12 mainBoard">


                <h2 class="reportHeader center">Participation during Public Audit (Between <?php echo $startdate." - ".$enddate;?>)</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:55px;" class="center">SN</th>
                                <th class="center" style="width:150px;">Bridge Id</th>
                                <th class="center" style="width:150px;">Name</th>
                                <th class="center" style="width: 300px;">Public Audit Conducted</th>
                            </tr>
                        </thead>

                        <?php
                        if(sizeof($arrPrintList) > 0) {
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
                                    foreach ($dataRow['data'] as $dataRow1) {
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                                <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                                <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                                <td style="width:60px;" class="center"><?php echo ($dataRow1['pa_status'] == 1? 'yes':'no'); ?></td> 
                                            </tr>
                                        <?php $i++;
                                    } ?>
                                    </tbody>
                            <?php
                                } //end of dist
                            }
                        } else { ?>
                            <tr>
                                <td colspan="4"><?="There are no records.";?></td>
                            </tr>
                        <?php }
                            ?>
                    </table>
                    <!-- pagination block -->
                    <div class="mt-3">
                        <?php //$pager = \Config\Services::pager(); 
                        ?>
                        <?php if ($pager) : ?>
                            <?php $pagi_path = 'reports/Public_Audit_FYWise_report?dataStart=' . $dataStart; ?>
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