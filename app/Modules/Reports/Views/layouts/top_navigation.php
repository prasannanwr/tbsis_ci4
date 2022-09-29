<!-- Navigation -->
<nav class="navbar navbar-fixed-top noPrint" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">
                        Toggle navigation
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                </button>
                <img src="<?php echo  base_url("images/0349198001423239216.jpg"); ?> " style="max-height: 100px;" />
                <!--    <img src="<?php // echo base_url(); 
                                    ?>images/final_tbssp.gif" /> -->
                <a href="<?php echo  base_url() ?>" class="navbar-brand"><?php //echo $logoimg['log01name']; ?></a>
                <?php // echo anchor( '', 'Trail Bridge Support Unit', array( 'class'=>
                //'navbar-brand')); 
                ?>
                <div class="clear">
                </div>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav clearfix">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo session()->get('name'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo anchor('user/profile', '<i class="fa fa-fw fa-user"></i> Profile') ?>
                        </li>
                        <li>
                            <?php echo anchor('user/change_password', '<i class="fa fa-fw fa-user"></i> Change Password') ?>

                            <!--    <a href="#"><i class="fa fa-fw fa-envelope"></i> Change Password</a> -->
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <?php echo anchor('user/logout', '<i class="fa fa-fw fa-power-off"></i> Logout') ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clear clearfix">
                    <div class="navbar-inverse">
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                    <!--a href="<?php echo site_url(); ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a-->
                                </li>
                                <?php if (session()->get('user_rights') != 6) { ?>
                                    <li>
                                        <?php echo anchor('bridge/lists', 'All Bridges'); ?>
                                    </li>
                                <?php  } ?>

                                <!--- start new Report list-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Reports <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Social Issues<b class="caret"></b>
                                            </a>


                                            <ul class="dropdown-menu1">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        DAGS <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dag_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dag_FYWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <!-- start Completed Bridges Report -->
                                                <li class="divider" style="display:none"></li>

                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Immediate Beneficiaries <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Beneficiaries_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Beneficiaries_FYWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        UC Composition <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        UC Proportion Representation <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        UC Executive Position <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Public Hearing <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Public Audit <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Local Employment Generation <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                    </ul>
                                    <!--end  Committed bridege -->
                                </li>
                                
                                <!-- Access & Utility -->
                                <li class="divider"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Access & Utility<b class="caret"></b>
                                    </a>

                                    <ul class="dropdown-menu1">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Completed <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu2">
                                                <li>
                                                <?php echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                <?php echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                </li>
                                                <li class="divider"></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <!--end  Committed bridege -->
                                </li>
                            </ul>
                            </li>
                            <li>
                                <?php // echo anchor( 'settings', 'Settings');
                                ?>
                            </li>
                            <!--setting--->
                            <?php
                            //     if  ($this->session->userdata('type') == ENUM_ADMINISTRATOR || $this->session->userdata('type') == ENUM_CENTRAL_MANAGER)
                            // {
                            if (session()->get('user_rights') == ENUM_ADMINISTRATOR) {
                            ?>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Settings <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu Bgset" style="width: 500px; display:none" >
                                        <div class="" style="width: 230px; overflow: hidden; float: left; margin-right: 10px; margin-left:10px ;">
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('bridge_type', '<i class="fa  fa-tasks fa-1x"></i> Bridge Types'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('bridge_design_standard', '
                                                                <i class="fa fa-pencil-square-o fa-1x"></i> Bridge Design Standard'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('bridge_designer', '
                                                                <i class="fa fa-pencil fa-1x"></i> Bridge Designer'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li><?php echo anchor('country', ' <i class="fa fa-flag fa-1x"></i> Countries'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('cost_components', '
                                                                <i class="fa fa-money fa-1x"></i> Cost Components'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('construction', '
                                                                <i class="fa fa-comments fa-1x"></i> Contruction Components'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('development_region', '
                                                                <i class="fa fa-align-justify fa-1x"></i> Development Region'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('province', '
                                                                <i class="fa fa-align-justify fa-1x"></i> States'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('district_name', '
                                                                    <i class="fa fa-align-left fa-1x"></i> District Name'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('fiscal_year', '
                                                                <i class="fa fa-comments fa-1x"></i> Fiscal Year'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('handrail_cable', '
                                                                <i class="fa fa-comments fa-1x"></i> Handrail Cable'); ?>
                                            </li>

                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('logo_upload', '
                                                                <i class="fa fa-align-center fa-1x"></i> Logo Upload'); ?>
                                            </li>
                                            <li class="divider"></li>

                                            <li>
                                                <?php echo anchor('vcd_municipality', '
                                                                <i class="fa fa-align-right fa-1x"></i> Municipality and VDC'); ?>

                                            </li>
                                            <li class="divider"></li>


                                        </div>


                                        <div class="" style="width: 230px; overflow: hidden; float: left;">
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('main_walkway_cable_diam', '
                                                                <i class="fa fa-comments fa-1x"></i> Main Walkway Cable Diam'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('main_walkway_cable_number', '
                                                                <i class="fa fa-comments fa-1x"></i> Main Walkway Cable Number'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('rust_prev_measures', '
                                                                <i class="fa fa-comments fa-1x"></i>  Rust Prev Measures'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('regional_office', '
                                                                <i class="fa fa-comment fa-1x"></i>  Regional Office '); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('basic_supporting_agencies', '
                                                            <i class="fa fa-users fa-1x"></i> Supporting Agencies'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('supporting_agencies', '
                                                            <i class="fa fa-users fa-1x"></i> Contributing Agencies'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('site_surveyors', '
                                                                <i class="fa fa-square fa-1x"></i> Site Surveyors'); ?>
                                            </li>
                                            <li class="divider"> </li>

                                            <li>
                                                <?php echo anchor('user', '<i class="fa fa-user fa-1x"></i> Users'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('walkway_width', '
                                                                <i class="fa fa-comments fa-1x"></i> Walk way Width'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('walkway_deck', '
                                                                <i class="fa fa-comments fa-1x"></i> Walk way Deck'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('weighted', '
                                                                <i class="fa fa-align-center fa-1x"></i> Weighted'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('work_category', '
                                                                <i class="fa fa-comments fa-1x"></i> Work Category'); ?>
                                            </li>
                                            <li class="divider"> </li>

                                            <li>
                                                <?php echo anchor('zone', '
                                                                <i class="fa fa-align-center fa-1x"></i> Zone'); ?>
                                            </li>
                                            <li class="divider"></li>


                                        </div>
                                    </ul>
                                </li>
                            <?php } ?>
                            <!--setting end---->
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <!-- /.navbar-collapse -->
        </nav>