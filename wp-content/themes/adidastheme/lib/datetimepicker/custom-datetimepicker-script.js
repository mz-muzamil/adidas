jQuery.noConflict();
(function ($) {
    $(document).ready(function () {
        $.datetimepicker.setDateFormatter({
            parseDate: function (date, format) {
                var d = moment(date, format);
                return d.isValid() ? d.toDate() : false;
            },

            formatDate: function (date, format) {
                return moment(date).format(format);
            },

            //Optional if using mask input
            formatMask: function (format) {
                return format
                    .replace(/Y{4}/g, '9999')
                    .replace(/Y{2}/g, '99')
                    .replace(/M{2}/g, '19')
                    .replace(/D{2}/g, '39')
                    .replace(/H{2}/g, '29')
                    .replace(/m{2}/g, '59')
                    .replace(/s{2}/g, '59');
            }
        });

        $.datetimepicker.setDateFormatter('moment');

        $('#start_date').datetimepicker({
            format: 'MM/DD/YYYY',
            formatDate: 'MM/DD/YYYY',
            timepicker: false,
            onChangeDateTime: function (dp, $input) {
                $('#end_date').datetimepicker({
                    format: 'MM/DD/YYYY',
                    formatDate: 'MM/DD/YYYY',
                    timepicker: false,
                    minDate: $input.val()
                });
            }
        });

        $('#end_date').datetimepicker({
            format: 'MM/DD/YYYY',
            formatDate: 'MM/DD/YYYY',
            timepicker: false,
            onChangeDateTime: function (dp, $input) {
                $('#start_date').datetimepicker({
                    format: 'MM/DD/YYYY',
                    formatDate: 'MM/DD/YYYY',
                    timepicker: false,
                    maxDate: $input.val()
                });
            }
        });


        $('#event_start_time').datetimepicker({
            format: 'hh:mm A',
            formatTime: 'hh:mm A',
            datepicker: false,
            step: 5,
            onChangeDateTime: function (dp, $input) {
                $('#event_end_time').datetimepicker({
                    format: 'hh:mm A',
                    formatTime: 'hh:mm A',
                    datepicker: false,
                    step: 5,
                    minTime: $input.val()
                });
            }
        });

        $('#event_end_time').datetimepicker({
            format: 'hh:mm A',
            formatTime: 'hh:mm A',
            datepicker: false,
            step: 5,
            onChangeDateTime: function (dp, $input) {
                $('#event_start_time').datetimepicker({
                    format: 'hh:mm A',
                    formatTime: 'hh:mm A',
                    datepicker: false,
                    step: 5,
                    maxTime: $input.val()
                });
            }
        });

    });
})(jQuery);