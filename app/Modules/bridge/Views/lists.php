<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">
       
            <div class="container-fluid">
                <form action="<?php echo site_url();?>/bridge/ajaxData" method="post" id="manualSearch"  >
                <!-- Page Heading -->
                 
                <div class="row form-group">
                    <div class="col-lg-12">
						<div class="header">
							<!--<h2 class="page-header">Trial Bridge Support Unit/Helvetas Nepal</h2>-->
							<div class="col-lg-8 options">
                                 
                             	<div class="form-group">
                                 <?php
                                   $blnoption1 = false;
                                    if( $dataRadio == '0' || $dataRadio =='' ){
                                        $blnoption1 = true;
                                       
                                        }
                                     
                                  ?>
									
									
									
								</div>
        
							</div>
							
							<div class="clear"></div>
						</div>
                    </div>
                </div>
                <!-- /.row -->

				<div class="row ">
					<div class="mainBoard">
						<div class="col-lg-3 left">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Utilities</h3>
								</div>
								<div class="padd" style="padding:7px 15px;">
								   <?php echo anchor('bridge/form', 'Add Bridge') ?>
								</div>
							<!--	<div class="panel-body  padd">
								   <a href="#">Delete Bridge</a>
								</div>
								<div class="panel-body padd">
								   <a href="#">Display Details</a>
								</div> -->
							</div>
                            
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Search - Bridge</h3>
								</div>
                               
                               
								<div class="panel-body">
									<div class="form-group">
									<label>Enter Bridge Number/Name</label>
									<input name="bridge_no" type="text" class="form-control bottom form-group number" id="manu_search" />
                                    <!--<input type="submit"  name="ShowSubmit" class="btn btn-sm btn-primary" value="Show" />
				                   <input type="submit"  name="ShowAll" class="btn btn-sm btn-info" value="Show All" />-->
									
									</div>
								</div>
                                
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Search - District Wise</h3>
								</div>
                              
								<div class="panel-body">
									<div class="form-group">
									<label>Select District</label>
         <?php echo et_form_dropdown_db('district', 'dist01district', 'dist01name', 'dist01id','', '', 'class="form-control distName_search"', array('AddNone'=>true, 'NoneCaption'=>'All District', 'NoneValue'=>'', 'SortBy'=>'dist01name')) ?>
 		                             
                                    <!-- <input type="submit"  name="distSubmit" class="btn btn-sm btn-primary" value="Show" />
				                    <input type="submit"  name="ShowAll" class="btn btn-sm btn-info" value="Show All" />-->
		
									</div>
								</div>
                                
							</div>
						</div>                        
						<div class="col-lg-9 right">                            
						<h3 style="text-align: center;" class="bltitle">Bridge List</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-hover ajaxdata" id="bridgeList">
									<thead>
										<tr>
											<!--<th>S.N.</th>-->
											<th>Bridge No</th>
											<th>Name</th>
											<th>River name</th>
											<th>District</th>
                                            <th>Location</th>
                                            <th>Supporting Agency</th>
											<th>Completed Date</th>
								            <th><?php echo lang('Locale.index_action_th'); ?></th> 
										</tr>
									</thead>
									
								</table>
							</div>
						</div>
                        
						<div class="clear"></div>
					</div>
							<!--<div class="col-lg-12">
								<div class="alert alert-info alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
								</div>
							</div>-->
				</div>
                <!-- /.row -->

                </form>
                </div>
               
                <!-- /.row -->

            </div>
            
   
        
    <script>
    var table;
    $(document).ready(function(){
        $url = '<?php echo site_url();?>/bridge/ajaxData/';
        $del=  '<img src="<?php echo base_url('images/del-btn.png');?>">';
        $add=  '<img src="<?php echo base_url('images/edit-btn.png');?>" width="15px" height= "15px" ">';

        var btype ='<?php echo $btype;?>';   
		//$url = $url+"?iscancelled=0";
		//$('.optChange').on('change', function(ev){
		//	var bb = $(this).val();			
	//		$url = $url+"?iscancelled="+bb;
//	});
	    
        table = $('#bridgeList').dataTable({
            "processing": true,
            "serverSide": true,
            
             ajax: $url,
             columns: [
                {data: 'bri03bridge_no'},
                {data: 'bri03bridge_name'}, 
                {data: 'bri03river_name'}, 
                {name: 'dist01name', data: 'dist01name', visible: true},
                {name: 'bri03place_name', data: 'bri03place_name', visible: true},
                {name: 'bri03supporting_agency', data: 'sup01sup_agency_name', visible: true},
                {name: 'bri05bridge_complete', data: 'bridge_completion_date',
                    mRender: function( data, type, full){
                        if(data == '0000-00-00'){
                            return '';
                        }
                        return data;
                    }
                },
                {type: 'html',
                    data: 'bri03bridge_no', //bri03id
                    mRender: function( data, type, full ){
                        //console.log( data );
                        return '<a href="<?php echo site_url();?>/bridge/form/'+ data +'">'+ $add +'</a> <?php  if(session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_REGIONAL_MANAGER  ){ ?> <a href="<?php echo site_url('bridge/delete/');?>'+data+'" onclick="return confirm(\'Warning: Once deleted, the action cannot be reverted. Are you sure you want to delete the selected bridge?\');">'+ $del +'</a> <?php }?>';                        
                    }
                }
             ],       
             order: [[6, 'asc'], [5, 'desc'], [4, 'asc']]
        
        });		

	
        if(btype == '0') {
            $('#bridgeList').DataTable().column( 7 )
                .search( btype )
                .draw();  
                
        } else if(btype == '1') {
            $('#bridgeList').DataTable().column( 7 )
            .search( btype )
            .draw();                
            
        }

        $('.dataTables_filter label input').on('keyup', function(){
            $('#manu_search').val( $(this).val());
        });
        $('#manu_search').on('keyup', function(){
            $('.dataTables_filter label input').val( $(this).val()).trigger('keyup');
            
        });
		$('input[name="ShowSubmit"], input[name="distSubmit"]').on('click', function(e){
			e.preventDefault();
            $('.dataTables_filter label input').trigger('keyup');
            
        });
		$('input[name="ShowAll"]').on('click', function(e){
			e.preventDefault();
            $('#manu_search').val('');
			$('#district').val('').trigger('change');
            
        });
            
        $('#district').on('change', function(ev){
            //4 for column: dist01name;
            $('#bridgeList').DataTable().column( 3 )
                .search( $('#district option:selected').text() )
                .draw();
                ev.preventDefault();
            return false;
        });
        $('.optChange').on('change', function(ev){
            //console.log($(this).val());
            //5 for column: construction type;
            
		    var table = $('#bridgeList').DataTable();
				table
				 .search( '' )
				 .columns().search( '' )
				 .draw();

            if($(this).val() == '') {
                $(".bltitle").html("List of All bridges"); 
            }

            $('#bridgeList').DataTable().column( 7 )
            .search( $(this).val() )
            .draw();
            ev.preventDefault();
            return false;      
        });
    });
       
</script>
<?= $this->endSection() ?>    