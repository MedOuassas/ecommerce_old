$(document).ready(function(){
    function check_all() {
        $('.item_checkbox:checkbox').each(function(){
          if($('.check_all:checkbox:checked').length == 0){
            $(this).prop('checked',false);
          } else {
            $(this).prop('checked',true);
          }
        });
    }
    $(document).on('click', '.check_all', function(){
        check_all();
    });
    $(document).on('click', '.del_all', function(){
        $('#form_data').submit();
    });
    function delete_all(){
        $(document).on('click', '.btn-deleteall', function(){
            var item_checkbox = $('.item_checkbox:checkbox:checked').length;
            $('.record_count').text(item_checkbox);
            if(item_checkbox > 0){
                $('.not_empty_record').removeClass('hidden');
                $('.empty_record').addClass('hidden');
            } else {
                $('.not_empty_record').addClass('hidden');
                $('.empty_record').removeClass('hidden');
            }
            $('#deleteall_modal').modal('show');
        });
    }
    delete_all();
});