<script type="text/javascript">

    $(function () {
        $('#take_photo').on('click', take_photo);
        $(".directions").on("click", directions);
        $(".set-default").on("click", default_all);
    });

    function take_photo()
    {
        var iso = $( "#iso option:selected" ).val();
        var size = $( "#size option:selected" ).val();
        var quality = $( "#quality option:selected" ).val();
        var encoding = $( "#encoding option:selected" ).val();
        var imxfx = $( "#imxfx option:selected" ).val();
        var brightness = $( "#brightness option:selected" ).val();
        var contrast = $( "#contrast option:selected" ).val();
        var sharpness = $( "#sharpness option:selected" ).val();
        var saturation = $( "#saturation option:selected" ).val();
        var awb = $( "#awb option:selected" ).val();
        var ev_comp =  $( "#ev_comp option:selected" ).val();
        var exposure = $( "#exposure option:selected" ).val();
        var rotation = $( "#rotation option:selected" ).val();
        var metering = $( "#metering option:selected" ).val();
        var flip     = $( "#flip option:selected" ).val();
        
        var data = {iso: iso, size: size, quality: quality, encoding: encoding, imxfx: imxfx, brightness:brightness, 
            contrast: contrast, sharpness: sharpness, saturation: saturation, awb:awb, ev_comp: ev_comp, exposure:exposure, rotation: rotation,
            metering:metering, flip:flip};
        
        
        $('#take_photo').addClass('disabled');
        $('#take_photo').html('<i class="fa fa-spinner fa-spin"></i> Taking picture...');
        $("#raspi_picture").addClass('sfumatura');
        $.ajax({
              url: "<?php echo site_url("cam/takePicture") ?>",
              dataType : 'json',
              type: "POST", 
              async: true,
              data : data
        }).done(function(response) {
            d = new Date();
            
            var src ="<?php echo site_url("cam/getPicture") ?>" + '/'+d.getTime();
            
            $('#result').html(response.result);
            $("#raspi_picture").attr('src',src);
            $('#take_photo').removeClass('disabled');
            $("#raspi_picture").removeClass('sfumatura');
            $('#take_photo').html('<i class="fa fa-camera"></i> Take a pic');   
        });
    }
    
    function directions()
    {
        var value = $(this).attr("data-attribue-direction");
        fabApp.jogMoveXY(value);
    }
    
    function default_all()
    {
        $( "#encoding" ).val('jpg');
        $( "#size" ).val('640x480');
        $( "#iso" ).val('800');
        $( "#quality" ).val('100');
        $( "#imxfx" ).val('none');
        $( "#brightness" ).val('50');
        $( "#contrast" ).val('0');
        $( "#sharpness" ).val('0');
        $( "#saturation" ).val('0');
        $( "#awb" ).val('auto');
        $( "#ev_comp" ).val('5');
        $( "#exposure" ).val('auto');
        $( "#rotation" ).val('90');
        $( "#metering" ).val('average');
    }
    
    
</script>
