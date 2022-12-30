<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Unacceptable_Technical_Completed_DateWise_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <!-- <input type="submit"  class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" /> -->
       <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid" id="printArea">

                <div class="row">
                    <div class="col-lg-12 mainBoard">
                        
                         
                                <h2 class="reportHeader center">List of Unacceptable Completed Bridges</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:160px;" class="center">Issues</th>
                                                <th style="width:160px;" class="center">Deficiency</th>
                                                <th style="width:160px;" class="center">Remedial Action</th>
                                            </tr>
                                        </thead>
                                   
                                        <?php 

if(is_array($arrPrintList)){
    $sum1 = 0;
    
    foreach($arrPrintList as $dataRow){

?>
                            <tr>
                            <td colspan="22">
                            <div class="col-lg-12" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name'];?></span></div>
                            </td>
                           </tr>
                           <?php
                    $i=0; 
                   
                    foreach($dataRow['data'] as $dataRow1){
                    ?>
                                        <tbody>

                                            <tr>
                                                <td style="width:120px;" class="center">Bridge No: <?php echo $dataRow1['bri03bridge_no']; ?></td>
                                                <td style="width:120px;" class="center">Bridge Name: <?php echo $dataRow1['bri03bridge_name']; ?></td>
                                                <td class="center">Physical Progress: <?php echo ''; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php $sum1 += $i; ?>
                        <tr>
                            <td class="center">UC Formation >> UC Proportion</td>
                            <td class="center">Not Defined Yet</td>
                        </tr>
                        <?php $i++;} ?>
                                   <?php
                      
                       } //end of dist
                        }
                        ?>
                        </table>
                        <!-- pagination block -->
                        <div class="mt-3">
                            <?php //$pager = \Config\Services::pager(); ?>
                            <?php if ($pager):?>
                                <?php $pagi_path = 'reports/Unacceptable_Technical_Completed_DateWise_report?dataStart='.$dataStart; ?>
                                <?php //$pager->setPath($pagi_path); ?>
                                <?= $pager->links(); ?>
                            <?php endif; ?>
                            <?php //echo "Page ".$pager->getCurrentPage()." of ".$pager->getPageCount();?>
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