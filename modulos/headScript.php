<head>  
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sigla V.1</title>
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" /> 
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../../assets/todo/bootstrap-datetimepicker.min.css" rel="stylesheet" />    
    <link href="../../assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript" src="../../assets/js/funcionesjs.js"></script>
    <link href="../../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.metisMenu.js"></script>
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../../assets/todo/bootstrap-datetimepicker.js"></script>
    <script src="../../assets/todo/locales/bootstrap-datetimepicker.es.js"></script>
    <script src="../../assets/js/jasny-bootstrap.min.js"></script>
    <script  src="../../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script  src="../../assets/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../../assets/js/custom.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
   <script type="text/javascript">
        $(function () {
           $('#form_date').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('#form_time').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
      $('#form_datex').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });	
        });
   </script>
</head>