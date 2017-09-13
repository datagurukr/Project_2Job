(function($){
    $(function(){
        $('.button-collapse').sideNav();
        $('select').material_select();      
        $('.modal').modal();
        $('.datepicker').pickadate({
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',            
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
        });        
    }); // end of document ready
})(jQuery); // end of jQuery name space