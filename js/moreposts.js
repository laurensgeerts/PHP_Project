$(function(){
    $(document).on('click','.loadmore',function(){
       // var $this = $(this);
       console.log('testtt');
        var startpos = Number($('#start').val())
        var endpos = Number($('#end').val());
                var ids = $('#ids').val();
                if(ids != "")
                {             
                   $.post('http://localhost/PHP_Project/PHP_Project/loadmoreposts.php', {start: startpos, end: endpos, ids: ids}, function(data){
                   alert (data);   
                   $('.center-div-image:last').after(data).show();              
                    }); 
                }
        
    });
});