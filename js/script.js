$(function() {
    $('#selectdiv').hide();
    $('#select2').change(function() {
        if ($(this).is(":selected")) {
            $('#selectdiv').hide();
        } else {
            $('#selectdiv').show();
        }
    });
});

$(function (){
    $('#terms').click(function(event){
        
        event.preventDefault();
        $('#mod').css('display', 'block').hide().fadeIn(300);
        $('#agreement').css('display', 'block').hide().delay(300).slideToggle(300);
    })
        
    $('#back').click(function(event){
        
        $('#agreement').slideUp(300);
        $('#mod').delay(300).fadeOut(500);
    })

    $(document).keyup(function(e){
        if(e.keyCode == 27){
            $('#agreement').slideUp(300);
            $('#mod').delay(300).fadeOut(500);
        }
    })
})

$(function(){
    $('#login').blur(function(){
        
        if($(this).val().length > 3){
        
            //obsluga zapytan AJAX przez jQuery
            $.ajax({

                url:'sprawdz.php?login='+$(this).val(),

                success:function(s){

                    if(s === 'TAK'){
                        $('#login').css('border-color','red');
                    } else {
                        $('#login').css('border-color','#4BF709');
                    }

                },

                error:function(e){
                    alert('Błąd połączenia');
                }
            });
        } else {
            $('#login').css('border-color','#423F3B');
        }
    });
});