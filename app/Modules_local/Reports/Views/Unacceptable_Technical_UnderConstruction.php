<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Unacceptable_Technical_UnderConstruction<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <!-- <input type="submit"  class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" /> -->
       <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid" id="printArea">

                <div class="row">
                    <div class="col-lg-12 mainBoard">
                        
                         
                                <h2 class="reportHeader center">List of Unacceptable Under Construction Bridges</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:140px;" class="center">Issues</th>
                                                <th style="width:160px;" class="center">Deficiency</th>
                                                <th style="width:160px;" class="center">Remedial Action</th>
                                            </tr>
                                        </thead>
                                   
                                        <?php 

if(is_array($arrPrintList)){
    $sum1 = 0;
    $sumPro = 0;
    
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
                        $bri03physical_progress = $dataRow1['bri03physical_progress'];
                        $issues = array();
                        switch ($bri03physical_progress) {
                            case '1':
                                $sumPro = 3;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '2': //design
                                $sumPro = 5;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '3': //contract 
                                $sumPro = 7;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '4':
                                $sumPro = 5;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '5': //first phase construction
                                $sumPro = 10;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '6': //material deliverd to site
                                $sumPro = 40;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //steel parts
                                $steel_parts_arr = array(
                                    'bri_quality_steel_check' => 'Lab test reports of raw materials is available',
                                    'bri_qa_document_check' => 'Manufacturer maintains QA documentation of fabrication & Galvanization',
                                    'bri_welding_check' => 'Welding is smooth and without pores',
                                    'bri_zinc_coating_check' => 'Zinc coating is as per specification',
                                    'bri_assembled_fitting_check' => '100% Assembled fittings have been checked positively',
                                    'bri_wire_mesh_check' => 'Wire mesh is made of 10 SWG GI Wires and with heavy coating',
                                    'bri_nuts_bolts_check' => 'Nuts/bolts are as per specification & drawing');
                                foreach ($steel_parts_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Steel parts >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '7': //foundation and concrete
                                $sumPro = 87;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //steel parts
                                $steel_parts_arr = array(
                                    'bri_quality_steel_check' => 'Lab test reports of raw materials is available',
                                    'bri_qa_document_check' => 'Manufacturer maintains QA documentation of fabrication & Galvanization',
                                    'bri_welding_check' => 'Welding is smooth and without pores',
                                    'bri_zinc_coating_check' => 'Zinc coating is as per specification',
                                    'bri_assembled_fitting_check' => '100% Assembled fittings have been checked positively',
                                    'bri_wire_mesh_check' => 'Wire mesh is made of 10 SWG GI Wires and with heavy coating',
                                    'bri_nuts_bolts_check' => 'Nuts/bolts are as per specification & drawing');
                                foreach ($steel_parts_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Steel parts >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //construction work
                                $construction_arr = array(
                                    'bri_quality_stones_check' => 'Cross Check the quality of stones/aggregate/sand',
                                    'bri_verify_concrete_drum_check' => 'Verify Concreting of Drum/Deadman/Anchorage Block',
                                    'bri_bulldog_check' => 'Bulldog Grips',
                                    'bri_workmanship_check' => 'Workmanship(General)',
                                    'bri_masonry_stone_check' => 'CSM/Dry stone masonry for dead load',
                                    'bri_masonry_monolithic_check' => 'Monolithic & stepwise construction',
                                    //'bri_verify_concrete_foundation_check' => 'Nuts/bolts are as per specification & drawing',
                                    'bri_tower_check' => 'Tower(N Types only)',
                                    'bri_cement_check' => 'Cement',
                                    'bri_dimension_anchorage_check' => 'Dimension of Anchorage & Foundation blocks',
                                    'bri_cable_quality_check' => 'Quality of Cable',
                                    'bri_cable_sag_check' => 'Cable Sag',
                                    'bri_relative_sag_check' => 'Relative Sag',
                                    'bri_painting_works_check' => 'Painting works of non galvanized steel parts(MM only)',
                                    'bri_plum_concrete_check' => 'Plum Concrete Size of Boulder < 10cm'
                                    //'bri_plum_concrete_gap_check' => 'Minumum gap of 12cm between boulders maintained'
                                    );
                                foreach ($construction_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) == 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } elseif(sizeof($key_parts) >= 5) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Construction work >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '8': //cable pull and bridge erection
                                $sumPro = 92;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //steel parts
                                $steel_parts_arr = array(
                                    'bri_quality_steel_check' => 'Lab test reports of raw materials is available',
                                    'bri_qa_document_check' => 'Manufacturer maintains QA documentation of fabrication & Galvanization',
                                    'bri_welding_check' => 'Welding is smooth and without pores',
                                    'bri_zinc_coating_check' => 'Zinc coating is as per specification',
                                    'bri_assembled_fitting_check' => '100% Assembled fittings have been checked positively',
                                    'bri_wire_mesh_check' => 'Wire mesh is made of 10 SWG GI Wires and with heavy coating',
                                    'bri_nuts_bolts_check' => 'Nuts/bolts are as per specification & drawing');
                                foreach ($steel_parts_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Steel parts >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //construction work
                                $construction_arr = array(
                                    'bri_quality_stones_check' => 'Cross Check the quality of stones/aggregate/sand',
                                    'bri_verify_concrete_drum_check' => 'Verify Concreting of Drum/Deadman/Anchorage Block',
                                    'bri_bulldog_check' => 'Bulldog Grips',
                                    'bri_workmanship_check' => 'Workmanship(General)',
                                    'bri_masonry_stone_check' => 'CSM/Dry stone masonry for dead load',
                                    'bri_masonry_monolithic_check' => 'Monolithic & stepwise construction',
                                    //'bri_verify_concrete_foundation_check' => 'Nuts/bolts are as per specification & drawing',
                                    'bri_tower_check' => 'Tower(N Types only)',
                                    'bri_cement_check' => 'Cement',
                                    'bri_dimension_anchorage_check' => 'Dimension of Anchorage & Foundation blocks',
                                    'bri_cable_quality_check' => 'Quality of Cable',
                                    'bri_cable_sag_check' => 'Cable Sag',
                                    'bri_relative_sag_check' => 'Relative Sag',
                                    'bri_painting_works_check' => 'Painting works of non galvanized steel parts(MM only)',
                                    'bri_plum_concrete_check' => 'Plum Concrete Size of Boulder < 10cm'
                                    //'bri_plum_concrete_gap_check' => 'Minumum gap of 12cm between boulders maintained'
                                    );
                                foreach ($construction_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) == 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } elseif(sizeof($key_parts) >= 5) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Construction work >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '9': //bridge complete
                                $sumPro = 97;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //steel parts
                                $steel_parts_arr = array(
                                    'bri_quality_steel_check' => 'Lab test reports of raw materials is available',
                                    'bri_qa_document_check' => 'Manufacturer maintains QA documentation of fabrication & Galvanization',
                                    'bri_welding_check' => 'Welding is smooth and without pores',
                                    'bri_zinc_coating_check' => 'Zinc coating is as per specification',
                                    'bri_assembled_fitting_check' => '100% Assembled fittings have been checked positively',
                                    'bri_wire_mesh_check' => 'Wire mesh is made of 10 SWG GI Wires and with heavy coating',
                                    'bri_nuts_bolts_check' => 'Nuts/bolts are as per specification & drawing');
                                foreach ($steel_parts_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Steel parts >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //construction work
                                $construction_arr = array(
                                    'bri_quality_stones_check' => 'Cross Check the quality of stones/aggregate/sand',
                                    'bri_verify_concrete_drum_check' => 'Verify Concreting of Drum/Deadman/Anchorage Block',
                                    'bri_bulldog_check' => 'Bulldog Grips',
                                    'bri_workmanship_check' => 'Workmanship(General)',
                                    'bri_masonry_stone_check' => 'CSM/Dry stone masonry for dead load',
                                    'bri_masonry_monolithic_check' => 'Monolithic & stepwise construction',
                                    //'bri_verify_concrete_foundation_check' => 'Nuts/bolts are as per specification & drawing',
                                    'bri_tower_check' => 'Tower(N Types only)',
                                    'bri_cement_check' => 'Cement',
                                    'bri_dimension_anchorage_check' => 'Dimension of Anchorage & Foundation blocks',
                                    'bri_cable_quality_check' => 'Quality of Cable',
                                    'bri_cable_sag_check' => 'Cable Sag',
                                    'bri_relative_sag_check' => 'Relative Sag',
                                    'bri_painting_works_check' => 'Painting works of non galvanized steel parts(MM only)',
                                    'bri_plum_concrete_check' => 'Plum Concrete Size of Boulder < 10cm'
                                    //'bri_plum_concrete_gap_check' => 'Minumum gap of 12cm between boulders maintained'
                                    );
                                foreach ($construction_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) == 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } elseif(sizeof($key_parts) >= 5) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Construction work >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            case '10': //final inspection
                                $sumPro = 100;
                                //site assessment
                                $site_arr = array(
                                    'bsa_stability' => 'No sign of erosion/slides (soil)',
                                    'bsa_stability_soil_conf' => 'Far from confluence (soil)',
                                    'bsa_stability_rock_bed' => 'Bedding plane subparallel/opposite to the slope (rock)',
                                    'bsa_stability_rock_wedge' => 'No sign of wedge/toppling tailor (rock)',
                                    'bsa_meandering' => 'Meandering/Curving River',
                                    //'bsa_influencing_rivulet' => 'Influencing rivulet',
                                    'bsa_source_sand' => 'Source of Sand',
                                    'bsa_source_stone' => 'Source of Stone',
                                    'bsa_source_gravel' => 'Source of Gravel',
                                    'bsa_profile_survey' => 'Profile Survey');
                                foreach ($site_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    // if($key == 'bsa_source_sand') {
                                    //     echo "sizeof key:".sizeof($key_parts); exit;    
                                    // }
                                    
                                    if(sizeof($key_parts) >= 4) {
                                        
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remark';
                                       
                                        
                                    } else {
                                        if(sizeof($key_parts) == 3) {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remark';
                                        } else {
                                            $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                            $action = $key_parts[0].'_'.$key_parts[1].'_remark';
                                        }
                                        
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Site Assesment >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //bridge design
                                $design_arr = array(
                                    'bri_bri_type_check' => 'Bridge Type Selection',
                                    'bri_cable_geo_check' => 'Cable Geometry',
                                    'bri_overall_design_check' => 'Overall Design',
                                    'bri_foundation_check' => 'Foundation Location',
                                    'bri_env_con_check' => 'Environmental Consideration',
                                    'bri_design_opt_check' => 'Design Optimization',
                                    'bri_free_board_check' => 'Free Board',
                                    'bri_design_span_check' => 'Span');
                                foreach ($design_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Design >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //cost estimate
                                $cost_est_arr = array(
                                    'bri_impl_approach_check' => 'Implementation Approach (SSTB)',
                                    'bri_impl_approach_lstb_check' => 'Implementation Approach (LSTB)',
                                    'bri_unit_rates_steel_check' => 'Unit Rates of Steel Parts',
                                    'bri_unit_rates_check' => 'Unit Rates(Portering,Labor,Cement etc)',
                                    'bri_portering_dis_check' => 'Portering distance',
                                    'bri_pm_linearcost_check' => 'Per meter linear cost');
                                foreach ($cost_est_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_deficiency';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Cost Estimate >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //steel parts
                                $steel_parts_arr = array(
                                    'bri_quality_steel_check' => 'Lab test reports of raw materials is available',
                                    'bri_qa_document_check' => 'Manufacturer maintains QA documentation of fabrication & Galvanization',
                                    'bri_welding_check' => 'Welding is smooth and without pores',
                                    'bri_zinc_coating_check' => 'Zinc coating is as per specification',
                                    'bri_assembled_fitting_check' => '100% Assembled fittings have been checked positively',
                                    'bri_wire_mesh_check' => 'Wire mesh is made of 10 SWG GI Wires and with heavy coating',
                                    'bri_nuts_bolts_check' => 'Nuts/bolts are as per specification & drawing');
                                foreach ($steel_parts_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) >= 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Steel parts >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //construction work
                                $construction_arr = array(
                                    'bri_quality_stones_check' => 'Cross Check the quality of stones/aggregate/sand',
                                    'bri_verify_concrete_drum_check' => 'Verify Concreting of Drum/Deadman/Anchorage Block',
                                    'bri_bulldog_check' => 'Bulldog Grips',
                                    'bri_workmanship_check' => 'Workmanship(General)',
                                    'bri_masonry_stone_check' => 'CSM/Dry stone masonry for dead load',
                                    'bri_masonry_monolithic_check' => 'Monolithic & stepwise construction',
                                    //'bri_verify_concrete_foundation_check' => 'Nuts/bolts are as per specification & drawing',
                                    'bri_tower_check' => 'Tower(N Types only)',
                                    'bri_cement_check' => 'Cement',
                                    'bri_dimension_anchorage_check' => 'Dimension of Anchorage & Foundation blocks',
                                    'bri_cable_quality_check' => 'Quality of Cable',
                                    'bri_cable_sag_check' => 'Cable Sag',
                                    'bri_relative_sag_check' => 'Relative Sag',
                                    'bri_painting_works_check' => 'Painting works of non galvanized steel parts(MM only)',
                                    'bri_plum_concrete_check' => 'Plum Concrete Size of Boulder < 10cm'
                                    //'bri_plum_concrete_gap_check' => 'Minumum gap of 12cm between boulders maintained'
                                    );
                                foreach ($construction_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) == 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_remarks';
                                    } elseif(sizeof($key_parts) >= 5) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_remarks';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_remarks';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Construction work >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                //final inspection
                                $final_arr = array(
                                    'bri_cable_check' => 'Cable Sag',
                                    //'bri_bulldog_spec_check' => 'Bulldog Grips (Number as per specification)',
                                    //'bri_bulldog_missing_check' => 'Bulldog Grips (No missing)',
                                    'bri_bulldog_retight_check' => 'Bulldog Grips (Retightened)',
                                    'bri_anchorage_check' => 'Anchorage/Foundation Block',
                                    'bri_walkway_check' => 'Walkway',
                                    'bri_wire_check' => '   Wire Mesh',
                                    'bri_fixtures_check' => 'Fixtures (None missing & fully retightened)',
                                    'bri_fixtures_hot_check' => 'Fixtures (Hot Dipped Galvanized & Grade is as per specification/drawings)',
                                    'bri_relative_check' => 'Equal sag of all cables',
                                    'bri_anchorage_dimension_check' => 'Anchorage/Foundation Block (Dimensions as per drawing)',
                                    'bri_anchorage_stone_check' => 'Stone masonry and concreting as per drawing & specifications',
                                    'bri_suspenders_check' => 'No missing suspenders/parts, all suspenders vertical',
                                    'bri_wire_mesh_uniform_check' => 'Wires are heavily zinc coated',
                                    'bri_tower_vertical_check' => 'Vertical, No missing nuts and bolts. Temporary struts are removed',
                                    'bri_we_check' => 'W/E cable is inparabola & fully pre-tentioned.',
                                    'bri_we_angles_check' => 'Angles of W/E anchorage are as per design & truly aligned with W/E Cable.',
                                    'bri_windties_check' => 'Perpendicular to the bridge axis and fully pre-tensioned');
                                foreach ($final_arr as $key => $value) {
                                    $key_parts = explode('_', $key);
                                    if(sizeof($key_parts) == 4) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_action';
                                    } elseif(sizeof($key_parts) >= 5) {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_'.$key_parts[2].'_'.$key_parts[3].'_action';
                                    } else {
                                        $deficiency = $key_parts[0].'_'.$key_parts[1].'_def';
                                        $action = $key_parts[0].'_'.$key_parts[1].'_action';
                                    }
                                    
                                    if($dataRow1[$key] != 1) {
                                        $issue = array(
                                            'title' => 'Final Inspection >> '.$value,
                                            'deficiency' => $dataRow1[$deficiency],
                                            'action' => $dataRow1[$action]
                                        );
                                        array_push($issues, $issue);
                                    }
                                }
                                break;
                            default:
                                $sumPro = 0;
                                break;
                        }
                          
                    ?>
                                        <?php 
                                        if(sizeof($issues) > 0) :
                                        ?>
                                        <tbody>

                                            <tr>
                                                <td style="width:120px;font-weight: bold" >Bridge No: <?php echo $dataRow1['bri03bridge_no']; ?></td>
                                                <td style="width:120px;font-weight: bold" >Bridge Name: <?php echo $dataRow1['bri03bridge_name']; ?></td>
                                                <td style="font-weight: bold" >Physical Progress: <?php echo $dataRow1['physical_progress']; ?>&nbsp;(<?=$sumPro;?>%)</td>
                                            </tr>
                                        </tbody>
                                        <?php $sum1 += $i; ?>
                                        
                                        <?php foreach ($issues as $value) { ?>
                                            <tr>
                                                <td><?=$value['title'];?></td>
                                                <td><?=($value['deficiency'] != ''?$value['deficiency']:'Not defined yet');?></td>
                                                <td><?=$value['action'];?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <?php endif;?>
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
                                <?php $pagi_path = 'reports/Unacceptable_Technical_UnderConstruction?dataStart='.$dataStart; ?>
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