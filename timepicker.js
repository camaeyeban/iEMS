$('#timepicker').timepicker({
    // Options
    timeSeparator: ':',           // The character to use to separate hours and minutes. (default: ':')
    showLeadingZero: true,        // Define whether or not to show a leading zero for hours < 10. (default: true)
    showMinutesLeadingZero: true, // Define whether or not to show a leading zero for minutes < 10. (default: true)
    showPeriod: false,            // Define whether or not to show AM/PM with selected time. (default: false)
    showPeriodLabels: true,       // Define if the AM/PM labels on the left are displayed. (default: true)
    altField: '#alternate_input', // Define an alternate input to parse selected time to
    defaultTime: '12:34',         // Used as default time when input field is empty or for inline timePicker
                                  // (set to 'now' for the current time, '' for no highlighted time, default value: now)

    zIndex: null,                 // Overwrite the default zIndex used by the time picker
    
    // trigger options
    showOn: 'focus',              // Define when the timepicker is shown.
                                  // 'focus': when the input gets focus, 'button' when the button trigger element is clicked,
                                  // 'both': when the input gets focus and when the button is clicked.
    button: null,                 // jQuery selector that acts as button trigger. ex: '#trigger_button'

    // Localization
    hourText: 'Hour',             // Define the locale text for "Hours"
    minuteText: 'Minute',         // Define the locale text for "Minute"
    amPmText: ['AM', 'PM'],       // Define the locale text for periods

    // Events
    onSelect: onSelectCallback,   // Define a callback function when an hour / minutes is selected.
    onClose: onCloseCallback,     // Define a callback function when the timepicker is closed.
    onHourShow: onHourShow,       // Define a callback to enable / disable certain hours. ex: function onHourShow(hour)
    onMinuteShow: onMinuteShow,   // Define a callback to enable / disable certain minutes. ex: function onMinuteShow(hour, minute)

    // custom hours and minutes
    hours: {
        starts: 0,                  // first displayed hour
        ends: 23                    // last displayed hour
    },
    minutes: {
        starts: 0,                  // first displayed minute
        ends: 55,                   // last displayed minute
        interval: 5                 // interval of displayed minutes
    },
    rows: 4                         // number of rows for the input tables, minimum 2, makes more sense if you use multiple of 2
});