<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdminLTE | Data Tables</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
</head>
<body class="skin-black">
    <div class="container">
            
            <section class="nav">
                <center><h1>State Detail</h1></center>
                <div class=" btn-toolbar list-toolbar pull-right">
                    <a class="btn btn-sm btn-primary" href="javascript:void(0);" onclick="exportExcel();" title="excel">Export Excel</a>
                    <a class="btn btn-sm btn-success" href="javascript:void(0);" onclick="exportWord();" title="word">Export Word</a>
                    <a class="btn btn-sm btn-primary" href="javascript:void(0);" onclick="exportPDF();" title="pdf">Export PDF</a>
                    <a class="btn btn-sm btn-success" href="javascript:void(0);" style="margin-left:2px;" onclick="exportCsv()" title="CSV">CSV</a>
            	</div> 
            </section>

            <!-- Main content -->
            <section class="content" style="margin-top:12px;">
                
                <div class="row">
                    <div class="col-xs-12">
                         
                        <div class="table-responsive">
                        	
                            <?php if(count($states) > 0) { ?>
                                <table id="example1" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>State Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = $this->uri->segment(3); 
                                        if($i==0){ $i=1; }else{ $i; }
                                        foreach($states as $state){ 
                                                //$i++;
                                            $state_id=$state['state_id'];
                                            $state_name=$state['state_name'];
                                            ?>
                                            <tr>
                                                <td width="5%"><?php echo $i++; ?></td>
                                                <td ><?php echo $state_name; ?></td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>State Name</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php }  else { ?>
                            	<table class="table table-bordered table-striped table-responsive">
                                	<thead>
                                    	<tr>
                                            <th>Sr. No.</th>
                                            <th>State Name</th>
                                        </tr>
                                    </thead>
                            <?php  echo "<tbody><tr><td colspan='4'><div class='alert alert-danger'> No State Data Found </div></td></tr></tbody>"; ?>
                            		<tfoot>
                                    	<tr>
                                            <th>Sr. No.</th>
                                            <th>State Name</th>
                                        </tr>
                                    </tfoot>
                            	</table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
				
            </section><!-- /.content -->
       
    </div><!-- ./wrapper -->
	
    <!-- AdminLTE App -->
    <!-- DATA TABES SCRIPT -->
 
    <!-- page script -->
    <script type="text/javascript">
        $(function() {
            $("#example1").dataTable({
			});
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });
    </script>
    <script>
		//export csv
		function exportCsv()
		{
			var csv = "csv";
			
			$.ajax({
			url: "<?= base_url(); ?>/admin/state_export_csv",
			type: "POST",
			data: {csv: csv},
			beforeSend: function (data) {
				//alert(data);
				
			},
			success: function (data) {
				alert(data);
				
				if (data == "RECORD NOT FOUND")
				{
					new PNotify({
						text: '<?= ADMIN_RECORD_NOT_FOUND_ONE ?>',
						type: 'error',
						delay: 2500
					});
				} else
				{
					window.open('<?= base_url() ?>/admin/state_export_csv', '_blank');
				}
			},
			error: function (data) {
				alert("CSV file cannot exported!");
			},
			});
		}
		//export excel
		function exportExcel()
        {
            var excl = "excl";
          
            $.ajax({
                url: "<?php  echo base_url(); ?>admin/state_export_excel",
                type: "POST",
                async: false,
                context: document.body,
                data: {excl: excl },
                beforeSend: function (data) {
                    //alert(data);  
                },
                success: function (data) {
                    //alert(data);
                    if (data == "RECORD NOT FOUND")
                    {
                        new PNotify({
                            text: '<?= ADMIN_RECORD_NOT_FOUND_ONE ?>',
                            type: 'error',
                            delay: 2500,
                        });
                    } else
                    {
                        window.open('<?php  echo base_url(); ?>admin/state_export_excel', '_blank');
                    }
                },
                error: function (data) {
                    alert("EXCEL file cannot exported!");
                },
            });
        }
		//export word
		function exportWord()
        {
            $.ajax({
                url: "<?php  echo base_url(); ?>admin/state_export_word",
                type: "POST",
                async: false,
                context: document.body,
                beforeSend: function (data) {
                    //alert(data);  
                },
                success: function (data) {
                    //alert(data);
                    if (data == "RECORD NOT FOUND")
                    {
                        new PNotify({
                            text: '<?= ADMIN_RECORD_NOT_FOUND_ONE ?>',
                            type: 'error',
                            delay: 2500,
                        });
                    } else
                    {
                        window.open('<?php  echo base_url(); ?>admin/state_export_word', '_blank');
                    }
                },
                error: function (data) {
                    alert("Word file cannot exported!");
                },
            });
        }
		function exportPDF()
		{
			$.ajax({
                url: "<?php  echo base_url(); ?>admin/state_export_pdf",
                type: "POST",
                async: false,
                context: document.body,
                beforeSend: function (data) {
                    //alert(data);  
                },
                success: function (data) {
                    //alert(data);
                    if (data == "RECORD NOT FOUND")
                    {
                        new PNotify({
                            text: '<?= ADMIN_RECORD_NOT_FOUND_ONE ?>',
                            type: 'error',
                            delay: 2500,
                        });
                    } else
                    {
                        window.open('<?php  echo base_url(); ?>admin/state_export_pdf', '_blank');
                    }
                },
                error: function (data) {
                    alert("PDF file cannot exported!");
                },
            });
		}
    </script>

</body>
</html>