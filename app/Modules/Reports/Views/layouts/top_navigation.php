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
                <img src="<?php echo base_url("images/tbsu_logo.jpg"); ?> " style="max-height: 110px;" />
                <!--    <img src="<?php // echo base_url(); 
                                    ?>images/final_tbssp.gif" /> -->
                <a href="<?php echo base_url() ?>" class="navbar-brand"><?php //echo $logoimg['log01name']; ?></a>
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
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Completed<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
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
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Under Construction<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                <?php echo anchor('reports/Gen_Dag_DateWise/2', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/Gen_Dag_FYWise/2', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
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
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Completed<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
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
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Under Construction<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                <?php echo anchor('reports/Beneficiaries_DateWise/2', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/Beneficiaries_FYWise/2', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
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
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Completed<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                <?php echo anchor('reports/UC_Composition_DateWise', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/UC_Composition_FYWise', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Under Construction<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                <?php echo anchor('reports/UC_Composition_DateWise/2', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/UC_Composition_FYWise/2', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
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
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Completed<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                 <?php echo anchor('reports/UC_Proportion_Representation_DateWise', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/UC_Proportion_Representation_FYWise', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                       
                                                        </li>
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Under Construction<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                 <?php echo anchor('reports/UC_Proportion_Representation_DateWise/2', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/UC_Proportion_Representation_FYWise/2', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                       
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
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Completed<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                 <?php echo anchor('reports/UC_Executive_Position_DateWise', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/UC_Executive_Position_FYWise', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        
                                                        </li>
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Under Construction<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                 <?php echo anchor('reports/UC_Executive_Position_DateWise/2', 'DateWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                <?php echo anchor('reports/UC_Executive_Position_FYWise/2', 'FYWise'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        
                                                        </li>
                                                        
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                                <!-- <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Public Hearing <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php //echo anchor('reports/Gen_Dist_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php //echo anchor('reports/Gen_Dist_DateWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
 -->
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Public Audit <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>
                                                        <?php echo anchor('reports/Public_Audit_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Public_Audit_FYWise', 'FYWise'); ?>
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
                                                        <?php echo anchor('reports/Employment_Generation_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Employment_Generation_FYWise', 'FYWise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>

                                    </ul>
                                    <!--end  Committed bridege -->
                                </li>
                                <!-- Unacceptable -->
                                <li class="divider"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Unacceptable Bridge<b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu1">
                                        <!-- <li class="dropdown" style="display: none;">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Social <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu2">
                                                <li>
                                                <?php //echo anchor('reports/Unacceptable_Social_UnderConstruction', 'Under Construction'); ?>
                                                </li>
                                            </ul>
                                        </li> -->
                                         <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Technical <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu2">
                                                <li>
                                                    <?php echo anchor('reports/Unacceptable_Technical_UnderConstruction', 'Under Construction'); ?>
                                                    <!-- <ul class="dropdown-menu3">
                                                        <li>
                                                        <?php //echo anchor('reports/Unacceptable_Technical_UnderConstruction_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li>
                                                        <?php //echo anchor('reports/Unacceptable_Technical_UnderConstruction_FYWise', 'FYWise'); ?>
                                                        </li>
                                                    </ul> -->
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    Completed <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <li>
                                                        <?php echo anchor('reports/Unacceptable_Technical_Completed_DateWise', 'DateWise'); ?>
                                                        </li>
                                                        <li>
                                                        <?php echo anchor('reports/Unacceptable_Technical_Completed_FYWise', 'FYWise'); ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Access & Utility -->
                                <li class="divider"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Access & Utility<b class="caret"></b>
                                    </a>

                                    <ul class="dropdown-menu1">
                                        <!-- <li class="dropdown">
                                            <?php //echo anchor('reports/Access_Utility_Underconstruction', 'Under construction'); ?>
                                        </li> -->
                                         <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Completed <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu2">
                                                <li>
                                                <?php echo anchor('reports/Access_Utility_Completed_DateWise', 'DateWise'); ?>
                                                </li>
                                                <li>
                                                <?php echo anchor('reports/Access_Utility_Completed_FYWise', 'FYWise'); ?>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Underconstruction <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu2">
                                                <li>
                                                <?php echo anchor('reports/Access_Utility_Completed_DateWise/2', 'DateWise'); ?>
                                                </li>
                                                <li>
                                                <?php echo anchor('reports/Access_Utility_Completed_FYWise/2', 'FYWise'); ?>
                                                </li>
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
                                    <ul class="dropdown-menu Bgset">
                                        <div class="" style="width: 230px; overflow: hidden; float: left; margin-right: 10px; margin-left:10px ;">
                                            <li class="divider"> </li>
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
                                                <?php echo anchor('vdc_municipality', '
                                                                <i class="fa fa-align-right fa-1x"></i> Municipality and VDC'); ?>

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
                                            <li class="divider"> </li>

                                            <li>
                                                <?php echo anchor('user/list', '<i class="fa fa-user fa-1x"></i> Users'); ?>
                                            </li>

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