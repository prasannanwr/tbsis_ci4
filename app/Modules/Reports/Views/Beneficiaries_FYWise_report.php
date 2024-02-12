<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

<div class="alignLeft"> 
        <form method="get" name="frmProvinceFilter" action="<?php echo site_url();?>/reports/Beneficiaries_FYWise_report<?php echo (isset($blnMM) && $blnMM)? '/'.$blnMM: ''; ?>" >
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
                        
                         
                                <h2 class="reportHeader center">Immediate Beneficiaries Report (Between <?php echo $startyear['fis01code']." - ".$endyear['fis01code']; ?>) <!--as of <?php //echo date("j F, Y");?>--></h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:55px;" rowspan="2" class="center">SN</th>
                                                <th rowspan="2" class="center">Bridge Id</th>
                                                <th style="width:150px;" rowspan="2" class="center">Bridge Name</th>
                                                <th style="width:150px;" rowspan="2" class="center">Palika</th>
                                                <th style="width:150px;" rowspan="2" class="center">Total Beneficiaries</th>
                                                <th style="width:80px;" rowspan="2" class="center">Men</th>
                                                <th style="width:80px;" rowspan="2" class="center">Women</th>
                                                <th colspan="2" class="center">Dalits (Households)</th>
                                                <th colspan="2">Janjatis (Households)</th>
                                                <th colspan="2" class="center">Minorities (Households)</th>
                                                <th colspan="2" class="center">BCT (Households)</th>
                                            </tr>
                                            <tr>
                                                <th class="center">Total</th>
                                                <th class="center">Poor</th>
                                                <th class="center">Total</th>
                                                <th class="center">Poor</th>
                                                <th class="center">Total</th>
                                                <th class="center">Poor</th>
                                                <th class="center">Total</th>
                                                <th class="center">Poor</th>
                                                 
                                            </tr>
                                        </thead>
                                   
                                                 <?php 
                    if(isset($arrPrintList) && is_array($arrPrintList)){
                        
                            $sum1 = 0;
                            $i=0;
                            $g_total_beneficiaries = 0;
                            $g_total_women = 0;
                            $g_total_men = 0;
                            $g_dalit_total = 0;
                            $g_dalit_poor = 0;
                            $g_janjati_total = 0;
                            $g_janjati_poor = 0;
                            $g_minorities_total = 0;
                            $g_minorities_poor = 0;
                            $g_bct_total = 0;
                            $g_bct_poor = 0;
                            $g_percent_women = 0;
                            $g_percent_men = 0;
                            $g_dalit_percent = 0;
                            $g_dalit_poor_percent = 0;
                            $g_janjati_percent = 0;
                            $g_janjati_poor_percent = 0;
                            $g_minorities_percent = 0;
                            $g_minorities_poor_percent = 0;
                            $g_bct_percent = 0;
                            $g_bct_poor_percent = 0;
                            
							foreach($arrPrintList as $dataRow){
                        
                        ?>
                           <tr>
                            <td colspan="22">
                            <div class="col-lg-12" style="text-align: center; font-size: 12px;"><b><span>District:<?php echo $dataRow['dist']['dist01name'];?></span></div>
                            </td>
                           </tr>
                           <tbody>       
                   
           <?php
                    // $i=0; 
                    $total_beneficiaries = 0;
                    $total_women = 0;
                     $total_men = 0;
                     $dalit_total = 0;
                     $dalit_poor = 0;
                     $janjati_total = 0;
                     $janjati_poor = 0;
                     $minorities_total = 0;
                     $minorities_poor = 0;
                     $bct_total = 0;
                     $bct_poor = 0;
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
                    foreach($dataRow['data'] as $dataRow1){
						//echo $dataRow1['dalit_total'];
							//	echo "<br>";
                        $beneficiaries = intval($dataRow1['total_women']) + intval($dataRow1['total_men']);
                        $total_beneficiaries = $total_beneficiaries + $beneficiaries;
                        $total_women = $total_women + intval($dataRow1['total_women']);
                        $total_men = $total_men + intval($dataRow1['total_men']);
                        $dalit_total = $dalit_total + intval($dataRow1['dalit_total']);
                        $dalit_poor = $dalit_poor + intval($dataRow1['dalit_poor']);
                        $janjati_total = $janjati_total + intval($dataRow1['janjati_total']);
                        $janjati_poor = $janjati_poor + intval($dataRow1['janjati_poor']);
                        $minorities_total = $minorities_total + intval($dataRow1['minorities_total']);
                        $minorities_poor = $minorities_poor + intval($dataRow1['minorities_poor']);
                        $bct_total = $bct_total + intval($dataRow1['bct_total']);
                        $bct_poor = $bct_poor + intval($dataRow1['bct_poor']);

                        if($dataRow1['major_vdc'] == 0) {
                            $palika = $dataRow1['left_palika'];
                        } else {
                            $palika = $dataRow1['right_palika'];
                        }
                    ?>

                                            <tr>
                                                <td style="width:55px;" class="center"><?php echo $i + 1; ?></td>
                                                <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_no']; ?></td>
                                                <td style="width:120px;" class="center"><?php echo $dataRow1['bri03bridge_name']; ?></td>
                                                <td style="width:120px;" class="center"><?php echo $palika; ?></td>
                                                <td style="width:60px;" class="center"><?php echo $beneficiaries; ?></td>
                                                <td style="width:75px;" class="center"><?php echo ($dataRow1['total_men'] != ''?$dataRow1['total_men']:0); ?></td>
                                                <td style="width:150px;" class="center"><?php echo ($dataRow1['total_women'] != ''? $dataRow1['total_women']:0) ?></td>
                                                <td class="center"><?php echo ($dataRow1['dalit_total'] != ''? $dataRow1['dalit_total']: 0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['dalit_poor'] != ''? $dataRow1['dalit_poor'] : 0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['janjati_total'] != ''? $dataRow1['janjati_total'] : 0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['janjati_poor'] != ''?$dataRow1['janjati_poor']:0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['minorities_total'] != ''?$dataRow1['minorities_total'] : 0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['minorities_poor'] != ''?$dataRow1['minorities_poor']:0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['bct_total'] != ''? $dataRow1['bct_total']:0); ?></td>
                                                <td class="center"><?php echo ($dataRow1['bct_poor'] != ''? $dataRow1['bct_poor']:0); ?></td>
                                            </tr>
                                            <?php $i++;} ?>
                                        </tbody>
                                    
                                   <?php $sum1 += $i; ?>
                                   <?php
                                   //grant total
                                    $g_total_beneficiaries = $g_total_beneficiaries + $total_beneficiaries;
                                    $g_total_women = $g_total_women + $total_women;
                                    $g_total_men = $g_total_men + $total_men;
                                    $g_dalit_total = $g_dalit_total + $dalit_total;
                                    $g_dalit_poor = $g_dalit_poor + $dalit_poor;
                                    $g_janjati_total = $g_janjati_total + $janjati_total;
                                    $g_janjati_poor = $g_janjati_poor + $janjati_poor;
                                    $g_minorities_total = $g_minorities_total + $minorities_total;
                                    $g_minorities_poor = $g_minorities_poor + $minorities_poor;
                                    $g_bct_total = $g_bct_total + $bct_total;
                                    $g_bct_poor = $g_bct_poor + $bct_poor;

                                   if($total_beneficiaries > 0) :
                                        $percent_women = ($total_women/$total_beneficiaries) * 100;
                                        $percent_men = ($total_men/$total_beneficiaries) * 100;
                                        $dalit_percent = ($dalit_total/$total_beneficiaries) * 100;
                                        $dalit_poor_percent = ($dalit_poor/$total_beneficiaries) * 100;
                                        $janjati_percent = ($janjati_total/$total_beneficiaries) * 100;
                                        $janjati_poor_percent = ($janjati_poor/$total_beneficiaries) * 100;
                                        $minorities_percent = ($minorities_total/$total_beneficiaries) * 100;
                                        $minorities_poor_percent = ($minorities_poor/$total_beneficiaries) * 100;
                                        $bct_percent = ($bct_total/$total_beneficiaries) * 100;
                                        $bct_poor_percent = ($bct_poor/$total_beneficiaries) * 100;
                                    endif;

                                    /*$g_percent_women = $g_percent_women + $percent_women;
                                    $g_percent_men = $g_percent_men + $percent_men;
                                    $g_dalit_percent = $g_dalit_percent + $dalit_percent;
                                    $g_dalit_poor_percent = $g_dalit_poor_percent + $dalit_poor_percent;
                                    $g_janjati_percent = $g_janjati_percent + $janjati_percent;
                                    $g_janjati_poor_percent = $g_janjati_poor_percent + $janjati_poor_percent;
                                    $g_minorities_percent = $g_minorities_percent + $minorities_percent;
                                    $g_minorities_poor_percent = $g_minorities_poor_percent + $minorities_poor_percent;
                                    $g_bct_percent = $g_bct_percent + $bct_percent;
                                    $g_bct_poor_percent = $g_bct_poor_percent + $bct_poor_percent;*/
                        ?>
                                    <tr>
                            <td colspan="4" rowspan="2" class="center">Total</td>
                            <td class="center"><?php echo $total_beneficiaries;?></td>
                            <td class="center"><?php echo $total_men;?></td>
                            <td class="center"><?php echo $total_women;?></td>
                            <td class="center"><?php echo $dalit_total;?></td>
                            <td class="center"><?php echo $dalit_poor;?></td>
                            <td class="center"><?php echo $janjati_total;?></td>
                            <td class="center"><?php echo $janjati_poor;?></td>
                            <td class="center"><?php echo $minorities_total;?></td>
                            <td class="center"><?php echo $minorities_poor;?></td>
                            <td class="center"><?php echo $bct_total;?></td>
                            <td class="center"><?php echo $bct_poor;?></td>
                        </tr>
                        <tr>
                            <td class="center">%</td>
                            <td class="center"><?php echo number_format($percent_men,2);?></td>
                            <td class="center"><?php echo number_format($percent_women, 2);?></td>
                            <td class="center"><?php echo number_format($dalit_percent, 2);?></td>
                            <td class="center"><?php echo number_format($dalit_poor_percent, 2);?></td>
                            <td class="center"><?php echo number_format($janjati_percent, 2);?></td>
                            <td class="center"><?php echo number_format($janjati_poor_percent, 2);?></td>
                            <td class="center"><?php echo number_format($minorities_percent, 2);?></td>
                            <td class="center"><?php echo number_format($minorities_poor_percent, 2);?></td>
                            <td class="center"><?php echo number_format($bct_percent, 2);?></td>
                            <td class="center"><?php echo number_format($bct_poor_percent, 2);?></td>
                        </tr>
                        <?php 
                         
                     } //end of dist
                        }
                         $g_percent_women = ($g_total_women/$g_total_beneficiaries) * 100;
                         $g_percent_men = ($g_total_men/$g_total_beneficiaries) * 100;
                         $g_dalit_percent = ($g_dalit_total/$g_total_beneficiaries) * 100;
                         $g_dalit_poor_percent = ($g_dalit_poor/$g_total_beneficiaries) * 100;
                         $g_janjati_percent = ($g_janjati_total/$g_total_beneficiaries) * 100;
                         $g_janjati_poor_percent = ($g_janjati_poor/$g_total_beneficiaries) * 100;
                         $g_minorities_percent = ($g_minorities_total/$g_total_beneficiaries) * 100;
                         $g_minorities_poor_percent = ($g_minorities_poor/$g_total_beneficiaries) * 100;
                         $g_bct_percent = ($g_bct_total/$g_total_beneficiaries) * 100;
                         $g_bct_poor_percent = ($g_bct_poor/$g_total_beneficiaries) * 100;

                        ?>
                        <tr>
                            <td colspan="4" rowspan="2" class="center">Overall</td>
                            <td class="center"><?php echo $g_total_beneficiaries;?></td>
                            <td class="center"><?php echo $g_total_men;?></td>
                            <td class="center"><?php echo $g_total_women;?></td>
                            <td class="center"><?php echo $g_dalit_total;?></td>
                            <td class="center"><?php echo $g_dalit_poor;?></td>
                            <td class="center"><?php echo $g_janjati_total;?></td>
                            <td class="center"><?php echo $g_janjati_poor;?></td>
                            <td class="center"><?php echo $g_minorities_total;?></td>
                            <td class="center"><?php echo $g_minorities_poor;?></td>
                            <td class="center"><?php echo $g_bct_total;?></td>
                            <td class="center"><?php echo $g_bct_poor;?></td>
                        </tr>
                        <tr>
                            <td class="center">%</td>
                            <td class="center"><?php echo number_format($g_percent_men,2);?></td>
                            <td class="center"><?php echo number_format($g_percent_women, 2);?></td>
                            <td class="center"><?php echo number_format($g_dalit_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_dalit_poor_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_janjati_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_janjati_poor_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_minorities_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_minorities_poor_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_bct_percent, 2);?></td>
                            <td class="center"><?php echo number_format($g_bct_poor_percent, 2);?></td>
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
                                <?php $pagi_path = 'reports/Beneficiaries_FYWise_report?dataStart='.$dataStart; ?>
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