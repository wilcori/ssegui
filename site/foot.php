        </div> <!-- /container -->
    <script src="site/js/jquery.min.js"></script>
    <script src="site/js/bootstrap.min.js"></script>

    <script src="site/js/ie10-viewport-bug-workaround.js"></script>
    <script src="site/js/ui/jquery.ui.core.js"></script>
    <script src="site/js/ui/jquery.ui.widget.js"></script>
    <script src="site/js/ui/jquery.ui.datepicker.js"></script>
    <script src="site/dist/js/select2.js"></script>
    
<script>
$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);     
  $(function() {   
    $("#fecha").datepicker();
    $('#remitente').select2();
    $('#destinatario').select2();
    $('#concopia').select2(); 
        
  });
     
</script>      

</body>
</html>