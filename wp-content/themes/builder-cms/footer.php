<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/project.min.js"></script>

<?php if(is_front_page()) { ?>
<script>
(function($) {
    /*
    $("#ip-section-home .ip-wrap-btn .ibc-c-button").click(function(e){
    	$(".ip-tripwire-content .ip-button").trigger('click');
    	e.preventDefault();
    }); 
    */


    $(`<a style="margin-left: 12px; margin-right: 12px" target="_blank" href="https://18401collinsavenue.com/"><img style="display:block; width:18px;" loading='lazy' width="18" class='lang-icon' src='<?php echo get_template_directory_uri(); ?>/images/en-flag.png' alt='English' title="English Version" ></a>`)
        .insertBefore(".ip-header-top .ip-contact-email");





    $(".ip-section-home .ibc-c-button, #ip-section-text-xfzaiedd7 .ibc-c-button").click(function(e) {
        // $(".js-modal-tripwire").addClass('show').show();
        $('<div class="bs-modal-backdrop fade show"></div>').appendTo($('.js-modal-tripwire'));
        $('body').addClass('bs-modal-open');
        $('body').css('overflow', 'hidden');
        $('.js-modal-tripwire').addClass('show in').show();

        e.preventDefault();
    });

    //  Translate text from terms
    $('.ip-form-wrap .ip-form-content li:nth-last-child(2) .ip-form-check label').html(
        `He Leído y estoy de acuerdo con los <a class="ip-link" href="/terms-and-conditions/" target="_blank">términos y condiciones</a>`
    );


})(jQuery);
</script>
<?php }?>



<script>
(function($) {
    //$(".ip-contact-phone .ip-contact-value, .ip-footer-info ul li:nth-child(2) .ip-footer-info-link").html('305.BENTLEY'); 

    $(".ip-footer-info .address, .ip-info-list .ip-address").html(
        `<strong>Galería de ventas</strong><br>18325 Collins Avenue, Sunny Isles Beach, FL 33160<br><strong class="wicon">Dirección de la propiedad</strong><br>18401 Collins Avenue, Sunny Isles Beach, FL 33160`
    );

    $(".ip-footer-links").html(
        `<a href="/terms-of-use/" title="Terms of Use">Términos de uso</a> - <a href="/privacy-policy/" title="Privacy Policy">Política de privacidad</a> - <a href="/disclaimer/" title="Disclaimer">Descargo de responsabilidad</a>`
    );

    // Home Floorplans buttons 	 		

    $("#ip-section-about-wru1bzu9a .ip-wrap-image").append(
        `<a class="tbtn tbtn1" href="https://residence-bacalar-3-beds-floors-07-6163e828.idxboost.io/" 
title="Residence Bacalar"> <span>Residence Bacalar</span> </a><br><a class="tbtn tbtn2" href="https://residence-arnage-3-beds-floors-07-61da4666.idxboost.io/" 
title="Residence Arnage"> <span>Residence Arnage</span> </a><br><a  class="tbtn tbtn3" href="https://residence-bentayga-3-beds-floors-07-16.idxboost.io/" 
title="Residence Bentayga"> <span>Residence Bentayga</span> </a><br><a class="tbtn tbtn4" href="https://residence-azure.idxboost.io/" title="Residence Azure"> <span>Residence Azure</span> </a>`
    );
})(jQuery);
</script>
<!-- testingv2 -->
<?php get_template_part('blocks/virtual-tour'); ?>

</body>

</html>