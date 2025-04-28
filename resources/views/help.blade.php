<div class="wrapper">
    <div style="margin-top: 50px;" class="faq d-flex flex-column faq">

        <div class="faq__item--opened">
            <div class="d-flex align-center">
                <b class="faq__item-question d-flex align-center justify-center">?</b>
                <span>Техническая поддержка</span>
            </div>
            <div class="faq__item-body">
                <p>В случае возникновения подобной проблемы напишите в <a href="https://vk.com/store_gambling" class="link" target="_blank">поддержку</a> с указанием: даты платежа, способа оплаты, реквизитов оплаты.<br>
                    Если ваш часовой пояс не UTC+3:00, укажите свой часовой пояс или город/регион проживания.</p>
            </div>
        </div>


<script type="text/javascript">
   $('.faq__item .faq__item-heading').click(function(e){
    e.preventDefault();
    if($(this).parent().hasClass('faq__item--opened')) {
        $(this).parent().removeClass('faq__item--opened').css({'max-height':'60px'});
    } else {
        $('.faq__item.faq__item--opened').removeClass('faq__item--opened').css({'max-height':'60px'});
        $(this).parent().addClass('faq__item--opened').css({'max-height': $(this).parent()[0].scrollHeight});
    }
});
</script>