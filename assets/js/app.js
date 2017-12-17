require('../css/global.scss');
require('jqueryui');

var $ = require('jquery');


$( function() {
    var dateFormat = "yy-mm-dd",
        from = $( "#historical_form_startDate" )
            .datepicker({
                changeMonth: true,
                dateFormat: dateFormat
            })
            .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
            })
            .attr('type','text'),
        to = $( "#historical_form_endDate" ).datepicker({
            changeMonth: true,
            dateFormat: dateFormat
        })
            .on( "change", function() {
                from.datepicker( "option", "maxDate", getDate( this ) );
            })
            .attr('type','text');

    function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }

        return date;
    }
} );