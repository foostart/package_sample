<!DOCTYPE html>
<html>
 <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 </head>
 <body>
  <br />
   <div class="panel panel-default">
    <div class="panel-heading">{!! trans('contact-admin.labels.search') !!}</div>
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="{!! trans('contact-admin.labels.assigner') !!}" />
     </div>
     <div class="table-responsive">
      <h3 align="center">{!! trans('contact-admin.labels.total-data') !!}<span id="total_records"></span></h3>
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>{!! trans('contact-admin.fields.user-id') !!}</th>
         <th>{!! trans('contact-admin.fields.first-name') !!}</th>
         <th>{!! trans('contact-admin.fields.last-name') !!}</th>
        </tr>
       </thead>
       <tbody>

       </tbody>
      </table>
     </div>
    </div>    
   </div>
 </body>
</html>

<script>
$(document).ready(function(){
 fetch_customer_data();
 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('contacts.search') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }
 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>