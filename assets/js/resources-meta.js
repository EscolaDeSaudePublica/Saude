$(document).ready(function () {
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('#opportunityIdResources').val(MapasCulturais.entity.id);
    $('#insertData').hide();
});

$(function () {
    $( "#resourceOptions" ).change(function() {
        var opt =  $( "#resourceOptions" ).val();
        
        if (opt == '0'){
            $('#insertData').show();
        }else{
            $('#insertData').hide();
        }
      });

    $("#buttonSendData").click(function (e) { 
        e.preventDefault();
        
        var form = $("#resourceFormData").serialize();
        $.ajax({
            type: "POST",
            url: MapasCulturais.baseURL+'recursos/opportunityEnabled',
            data: form,
            dataType: "json",
            success: function (response) {
                console.log(response);
                
            }
        });
    });
});