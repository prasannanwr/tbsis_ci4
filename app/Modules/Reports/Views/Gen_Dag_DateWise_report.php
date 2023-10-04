<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

<div class="alignLeft"> 
        <form method="get" name="frmProvinceFilter" action="<?php echo site_url();?>/reports/Gen_Dag_DateWise_report<?php echo (isset($blnMM) && $blnMM)? '/'.$blnMM: ''; ?>">
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
                        
                                <h2 class="reportHeader center">Disadvantaged Group (Between <?php echo $startdate." - ".$enddate; ?>) <!--as of <?php //echo date("j F, Y");?>--></h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:55px;" rowspan="2" class="center">SN</th>
                                                <th rowspan="2" class="center" style="width:150px;">Bridge Id</th>
                                                <th rowspan="2" class="center" style="width:150px;">Name</th>
                                                <th style="width:160px;" rowspan="2" class="center">Total Households</th>
                                                <th style="width:160px;" rowspan="2" class="center">Total Beneficiaries Population</th>
                                                <th colspan="5" class="center">DAG Population</th>
                                            </tr>
                                            <tr>
                                                <th class="center">Dalit</th>
                                                <th class="center">Janjati</th>
                                                <th class="center">Minorities</th>
                                                <th class="center">BCT</th> 
                                                <th class="center">Total</th>
                                            </tr>
                                        </thead>
                                   
                                        <?php 

if(isset($arrPrintList) && is_array($arrPrintList)){
    $sum1 = 0;
    $i=0; 
    $g_total_household = 0;
    $g_total_beneficiaries = 0;
    $g_dalit_total = 0;
    $g_bct_total = 0;
    $g_janjati_total = 0;
    $g_minorities_total = 0;
    $g_grand_total = 0;
    $g_dalit_percent = 0;
    $g_janjati_percent = 0;
    $g_minorities_percent = 0;
    $g_bct_percent = 0;
    $g_grand_total_pecent = 0;
    foreach($arrPrintList as $dataRow){

?>
                            <tr>
                            <td colspan="22">
                            <div class="col-lg-12" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name'];?></span></div>
                            </td>
                           </tr>
                           <?php
                    // $i=0; 
                    $total_beneficiaries = 0;
                    $total_household = 0;
                    $dalit_total = 0;
                    $janjati_total = 0;
                    $minorities_total = 0;
                    $bct_total = 0;
                    $grand_total = 0;
                     
                    $percent_women = 0;
                    $percent_men = 0;
                    $dalit_percent = 0;
                    $dalit_poor_percent = 0;
                    $janjati_percent = 0;
                    $janjati_poor_percent = 0;
                    $minorities_percent = 0;
                    $minorities_poor_percent = 0;
                    $bct_percent = 0;
                    $bct_poor_percent = 0;
                    $grand_total_pecent = 0;

                    foreach($dataRow['data'] as $dataRow1){
                        $beneficiaries = $dataRow1['total_women'] + $dataRow1['total_men'];
                        $total_household = $total_household + $dataRow1['total_household'];
                        $total_beneficiaries = $total_beneficiaries + $beneficiaries;

                        
						if(is_numeric($dataRow1['dalit_total'])) {
						$dalit_total = $dalit_total + $dataRow1['dalit_total'];	
						}
                        $bct_total = $bct_total + $dataRow1['bct_total'];
                        $janjati_total = $janjati_total + $dataRow1['janjati_total'];
                        $minorities_total = $minorities_total + $dataRow1['minorities_total'];

						$total_dag = $dalit_total + $janjati_total + $minorities_total + $bct_total;
                        $grand_total = $grand_total + $total_dag;
                    ?>
                            
                                
                                
                                
                                        <tbody>

                                            <tr>
                                            <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                                <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                                <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                                <td style="width:60px;" class="center"><?php echo ($dataRow1['total_household'] != ''? $dataRow1['total_household']:0); ?></td>
                                                <td style="width:75px;" class="center"><?php echo $beneficiaries; ?></td>
                                                
                                                <td class="center"><?php echo ($dataRow1['dalit_total'] != ''? $dataRow1['dalit_total']: 0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['janjati_total'] != ''? $dataRow1['janjati_total'] : 0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['minorities_total'] != ''?$dataRow1['minorities_total'] : 0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['bct_total'] != ''? $dataRow1['bct_total']:0); ?></td>
                                                <td class="center"><?php echo $total_dag; ?></td>
                                            </tr>
                                            <?php $i++;} ?>
                                        </tbody>
                                        <?php $sum1 += $i; ?>
                                        <?php
                                   if($total_beneficiaries > 0) :
                                        $dalit_percent = ($dalit_total/$total_beneficiaries) * 100;
                                        $janjati_percent = ($janjati_total/$total_beneficiaries) * 100;
                                        $minorities_percent = ($minorities_total/$total_beneficiaries) * 100;
                                        $bct_percent = ($bct_total/$total_beneficiaries) * 100;

                                        $grand_total_pecent = ($grand_total/$total_beneficiaries) * 100;
                                   endif;
                                    $g_dalit_percent = $g_dalit_percent + $dalit_percent;
                                    $g_janjati_percent = $g_janjati_percent + $janjati_percent;
                                    $g_minorities_percent = $g_minorities_percent + $minorities_percent;
                                    $g_bct_percent = $g_bct_percent + $bct_percent;
                                    $g_grand_total_pecent = $g_grand_total_pecent + $grand_total_pecent;
                        ?>
                        <tr>
                            <td colspan="3" class="center">Total per District: </td>
                            <td class="center"><?php echo $total_household;?></td>
                            <td class="center"><?php echo $total_beneficiaries;?></td>
                            <td class="center"><?php echo $dalit_total;?></td>
                            <td class="center"><?php echo $janjati_total;?></td>
                            <td class="center"><?php echo $minorities_total;?></td>
                            <td class="center"><?php echo $bct_total;?></td>
                            <td class="center"><?php echo $grand_total;?></td>
                        </tr> 
                        <tr>
                            <td class="center" colspan="5">%</td>
                            <td class="center"><?php echo number_format($dalit_percent, 2);?></td>
                            <td class="center"><?php echo number_format($janjati_percent,2);?></td>
                            <td class="center"><?php echo number_format($minorities_percent, 2);?></td>
                            <td class="center"><?php echo number_format($bct_percent, 2);?></td>
                            <td class="center"><?php echo number_format($grand_total_pecent, 2);?></td>
                        </tr>
                                   <?php
                      
                       } //end of dist
                        }
                        ?>
                        <tr>
                            <td colspan="3" class="center">Overall</td>
                            <td class="center"><?php echo $g_total_household;?></td>
                            <td class="center"><?php echo $g_total_beneficiaries;?></td>
                            <td class="center"><?php echo $g_dalit_total;?></td>
                            <td class="center"><?php echo $g_janjati_total;?></td>
                            <td class="center"><?php echo $g_minorities_total;?></td>
                            <td class="center"><?php echo $g_bct_total;?></td>
                            <td class="center"><?php echo $g_grand_total;?></td>
                        </tr>
                        <tr>
                            <td class="center" colspan="5">%</td>
                            <td class="center"><?php echo number_format($g_dalit_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_janjati_percent,2);?></td>
                            <td class="center"><?php echo number_format($g_minorities_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_bct_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_grand_total_pecent, 2);?></td>
                        </tr>
                        <?php
                           /* if($currentPage == $pageCount) {*/
                            $total_bridges = $i;
                            ?>
                            <tr>
                                <td colspan="7" style="text-align: right">Total:</td>
                                <td><?=$total_bridges;?></td>
                            </tr>
                        <?php /*} */ ?>
                        </table>
                        <!-- pagination block -->
                        <div class="mt-3">
                            <?php //$pager = \Config\Services::pager(); ?>
                            <?php if (isset($pager)):?>
                                <?php $pagi_path = 'reports/Gen_Dag_DateWise_report?dataStart='.$dataStart; ?>
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