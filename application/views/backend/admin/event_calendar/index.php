<!--title-->
<div class="row ">
   <div class="col-xl-12">
      <div class="card">
         <div class="card-body">
            <h4 class="page-title">
               <i class="mdi mdi-calendar-clock title_icon"></i> <?php echo get_phrase('event_calendar'); ?>
               <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
               <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/event_calendar/create'); ?>', '<?php echo get_phrase('event_calendar'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_new_event'); ?></button>
            </h4>
         </div> <!-- end card body-->
      </div> <!-- end card -->
   </div><!-- end col-->
</div>

<div class="row">
   <div class="col-12 event_calendar_content">
      <?php include 'list.php'; ?>
   </div>
</div>

<script>
   $(document).ready(function() {
      refreshEventCalendar();
   });

   var showAllEvents = function() {
      var url = '<?php echo route('event_calendar/list'); ?>';

      $.ajax({
         type: 'GET',
         url: url,
         success: function(response) {
            $('.event_calendar_content').html(response);
            initDataTable("basic-datatable");
            refreshEventCalendar();
         }
      });
   }

   var refreshEventCalendar = function() {
      var url = '<?php echo route('event_calendar/all_events'); ?>';
      $.ajax({
         type: 'GET',
         url: url,
         dataType: 'json',
         success: function(response) {

            var event_calendar = [];
            for (let i = 0; i < response.length; i++) {

               var obj;
               obj = {
                  "title": response[i].title,
                  "start": response[i].starting_date,
                  "end": response[i].ending_date
               };
               event_calendar.push(obj);
            }

            $('#calendar').fullCalendar({
               disableDragging: true,
               events: event_calendar,
               displayEventTime: false
            });
         }
      });
   }
</script>