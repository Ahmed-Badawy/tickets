
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
<script type="text/javascript" src="{{ asset('js/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fancy-file-uploader/jquery.fileupload.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('js/file.js') }}"></script>
<script type="text/javascript">
    var token = document.head.querySelector('meta[name="csrf-token"]').content;
    $.ajaxSetup({
        headers: { '_token': token }
    });

let myfiles = {
    secon1: [],
    secon2: [],
}


</script>
<script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-36251023-1']);
      _gaq.push(['_setDomainName', 'jqueryscript.net']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

</script>
<script>
    $(document).on('click', '#togglePasswordField', function(){
        $('#passwordField').attr('type', $('#passwordField').attr('type') == 'text' ? 'password' : 'text');
        var type = $('#passwordField').attr('type');
        type == 'password' ?
                            $(this).html('<i class="fa fa-eye-slash"></i>'):
                            $(this).html('<i class="fa fa-eye"></i>');
    })

    $(document).on('mouseenter', '.readNotification', function(){
        var that = $(this);
        if($(this).attr('data-read') == "true"){
            $.get('{{ URL::to("supplier/readnotification") }}/'+ $(this).attr('data-id'), function(data){
                if(data.success){
                    that.attr('data-read',"false");
                    that.removeClass('backGray')
                    if(parseInt($('#notiftcount').text()) > 0){
                        $('#notiftcount').text(parseInt($('#notiftcount').text()) - 1);
                        if(parseInt($('#notiftcount').text()) == 0){
                            $('#notificationimage').attr('src', "{{ asset(asset('images/notifications-deactive.svg')) }}")
                            $('#notiftcount').text("");
                        }
                    }
                    else{
                        $('#notificationimage').attr('src', "{{ asset(asset('images/notifications-deactive.svg')) }}")
                    }
                }
            })
        }

    })

</script>
