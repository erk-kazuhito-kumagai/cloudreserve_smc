//loadCSS('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')
loadJs('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');


$(function () {

  $('.dtYYMM').datepicker({
  
  format:'yyyy/mm',
  language:'ja',
  autoclose:true,
   minViewMode: 'months',
   clearBtn    : true,
    clear       : '•Â‚¶‚é'
  });
  
  $('.dtYYMMDD').datepicker({
  
  format:'yyyy/mm/dd',
  language:'ja',
  autoclose:true,
   clearBtn    : true,
    clear       : '•Â‚¶‚é'
  });

});