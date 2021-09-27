  $(document).ready(function(){
    $('.setinterval').on('click', function(){

      $('#intervalform').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();

        console.log(data);
 
      $('#interval_value').val(data[6]);
      $('#my_id').val(data[0]);
    });
  });

    $('.close').on('click', function(){
      location.reload();
    });
