 <link rel="stylesheet" href="<?php echo asset_url();?>vendor/fullcalendar/dist/fullcalendar.min.css">
 <div class="content-view">
            <button type="button" class="btn btn-primary btn-float shadow">
              <i class="material-icons">create</i>
            </button>
            <div class="fullcalendar"></div>
			
          </div>
		  
     <!-- page scripts -->
 <script src="<?php echo asset_url();?>vendor/moment/min/moment.min.js"></script>
 <script src="<?php echo asset_url();?>vendor/fullcalendar/dist/fullcalendar.min.js"></script>
 <script src="<?php echo asset_url();?>vendor/fullcalendar/dist/gcal.js"></script>
 <!-- end page scripts -->
 <script type="text/javascript">

(function($) {
  'use strict';

  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();
var eventsData = <?php echo json_encode($schedule); ?>;

var result = [];
	$.each(eventsData, function (key, value) {
		result.push({
			title: value.title,
			start: value.start_date,
			end:  value.end_date,
			listColor: 'success',
			className: ['bg-danger']
		});
	});
  $('.fullcalendar').fullCalendar({
    editable: true,
    contentHeight: 520,
    header: {
      left: 'title',
      center: 'month,agendaWeek,agendaDay',
      right: 'today prev,next'
    },
    buttonIcons: {
     prev: 'left-single-arrow',
     next: 'right-single-arrow'
    },
    droppable: true,
    axisFormat: 'h:mm',
    columnFormat: {
      month: 'dddd',
      week: 'ddd M/D',
      day: 'dddd M/d',
      agendaDay: 'dddd D'
    },
    allDaySlot: false,
    drop: function() {
      var originalEventObject = $(this).data('eventObject');
      var copiedEventObject = $.extend({}, originalEventObject);
      copiedEventObject.start = date;
      $('.fullcalendar').fullCalendar('renderEvent', copiedEventObject, true);
      if ($('#drop-remove').is(':checked')) {
        $(this).remove();
      }
    },
	eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {

        alert(
            event.title + " was moved " +
            dayDelta + " days and " +
            minuteDelta + " minutes."
        );

        if (allDay) {
            alert("Job is now all-day");
        }else{
            alert("Job has a time-of-day");
        }

        if (!confirm("Are you sure about this change?")) {
            revertFunc();
        }
		else{
			updateScheduleTime(event.start.format('YYYY-MM-DD h:m:s'),event.end.format('YYYY-MM-DD h:m:s'),event.title);
		}

    },
	eventResize: function(event, delta, revertFunc) {

         
		updateScheduleTime(event.start.format('YYYY-MM-DD h:m:s'),event.end.format('YYYY-MM-DD h:m:s'),event.title);
        if (!confirm("is this okay?")) {
            revertFunc();
        }

    },
    defaultDate: moment().format('YYYY-MM-DD'),
    viewRender: function() {
      $('.fc-button-group').addClass('btn-group');
      $('.fc-button').addClass('btn');
    },
    events: result
  });
})(jQuery);
function updateScheduleTime(start_date,end_date,id) {
     
		$.post("http://localhost/nnnn/schedular/updatescheduletime",{start_date: start_date,end_date : end_date,id :id},function(data){
			if(data.status == 1) {
				alert("Change Successfull");
			} else {
				alert(data.job_id);
			}
		},'json');
    } 

</script>