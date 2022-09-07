<style>
/* for test 
	.ip-tripwire-wrapper .ip-wrap-btn {
	max-width: fit-content;
	position: relative;
	cursor: pointer
	}
	.ip-tripwire-wrapper .ip-wrap-btn:after {
	content: "";
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	z-index: 12;
	} */
/* for test */

.ip-tripwire-wrapper .ip-wrap-btn .ip-button {
    border: solid 2px #000;
}

.ip-tripwire-wrapper .ip-wrap-btn:hover .ip-button {
    background-color: #fff;
    color: #000
}


.virtual_modal {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100vh;
    z-index: 99999;
    background-color: #373737;
    transition: all ease-in-out 0.3s;
    opacity: 0;
    visibility: hidden;
}

.virtual_modal.active {
    opacity: 1;
    visibility: visible
}

.btns {
    position: absolute;
    right: 6px;
    top: 6px;
    gap: 6px;
    display: flex;
}

.btns button {
    padding: 10px 12px;
    cursor: pointer;
    border: solid 2px #000;
    border-radius: 6px;
    transition: all ease-in-out 0.3s;
    font-weight: bold !important;
    font-size: 12px;
    line-height: 1;
    color: inherit
}

.btns button.active {
    background-color: #000;
    color: #fff;
}

.btns button:hover {
    background-color: #333;
    color: #fff;
    border-color: #fff;
}

.virtual_close {
    width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.virtual_close span {
    display: none
}

.virtual_close:after {
    content: "x";
    font-size: 20px;
    position: absolute;
    line-height: 1;
    margin-top: -4px;
}

.virtualTour {
    border: 0;
    display: block;
    width: 100%;
    height: 100%;
}




/* 	small modal */
.modal_small_wrap {
    background-color: #fff;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    transition: all ease-in-out 0.3s;
    visibility: hidden;
    opacity: 0;
    width: 100%;
    height: 100vh;
    left: 0;
    top: 0;
}

.modal_small_wrap.active {
    visibility: visible;
    opacity: 1;
}

.modal_small {
    padding: 30px 15px 20px 15px;
    text-align: center;
    width: 90%;
    max-width: 480px;
    background-color: #fff;
}

.modal_small_close {
    position: absolute;
    right: 15%;
    top: 5%;
    width: 30px;
    height: 30px;
    border-radius: 50px;
    font-size: 20px;
    line-height: 0;
    transition: all ease-in-out 0.3s;
    border: solid 2px #000;
    cursor: pointer;
    background-color: #000;
    color: #fff;
}

.modal_small_close:hover {
    background-color: #fff;
    color: #000;
}



.modal_small h3 {
    font-weight: bold;
    margin-bottom: 18px;
}

.modal_small .cbtns {
    display: flex;
    justify-content: center;
    gap: 12px
}

.modal_small .cbtns a {
    display: block;
    padding: 12px;
    border: solid 2px #000;
    font-size: 14px;
    border-radius: 50px;
    width: 100%;
    transition: all ease-in-out 0.3s;
    background-color: #000;
    color: #fff;
}

.modal_small .cbtns a:hover {
    background-color: #fff;
    color: #000;
}


.page-id-292 .ip-tripwire-wrapper {
    display: none;
}

@media (max-width: 767px) {

    .ip-form-content input[type='text'],
    .ip-form-content input[type='number'],
    .ip-form-content input[type='email'],
    .ip-form-content textarea {
        font-size: 16px;
    }
}
</style>


<?php if ( wp_is_mobile() ) : ?>
<div class="modal_small_wrap">
    <div class="modal_small">
        <button class="modal_small_close">x</button>

        <h3>Elige en qué entorno quieres hacer el tour 3D</h3>

        <div class="cbtns">
            <a target="_blank" href="https://show.original3d.com/tbr_west_b/">Tour Virtual Este</a>
            <a target="_blank" href="https://show.original3d.com/tbr_east_b/">Tour Virtual Oeste</a>
        </div>
    </div>
</div>


<script>
(function($) {
    $(".modal_small_close").click(function(e) {
        $(".modal_small_wrap").removeClass("active");
    });
    /*
    $(".ip-tripwire-wrapper .ip-wrap-btn").click(function (e) {  
    	$(".modal_small_wrap").addClass("active");
    });
    */

    // 		$('#ip-form-1211 input[name="ib_tags"]').val('Virtual_Tour_requested') 

    $('#ip-form-1211').submit(function() {
        var $fieldComments = $('#ip-form-1211 textarea')
        var comments = $fieldComments.val()
        var formTag = $('#ip-form-1211 input[name="ib_tags"]').val()
        var additionalComments = 'Virtual Tour requested, ' + formTag
        if (comments) {
            comments = comments + '...' + additionalComments
        } else {
            comments = additionalComments
        }
        $fieldComments.val(comments)

        $(".modal_small_wrap").addClass("active");
    })
})(jQuery);
</script>


<?php else : ?>



<div class="virtual_modal">
    <div class="btns">
        <button class="opt1 active">
            Tour Virtual Este
        </button>
        <button class="opt2">
            Tour Virtual Oeste
        </button>
        <button class="virtual_close">
            <span>Cerrar</span>
        </button>
    </div>
    <iframe src="https://show.original3d.com/tbr_west_b/" class="virtualTour" height="800" width="1280" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
</div>

<script>
(function($) {

    var url1 = "https://show.original3d.com/tbr_west_b/"
    var url2 = "https://show.original3d.com/tbr_east_b/"

    // for test only
    /*
		$(".ip-tripwire-wrapper .ip-wrap-btn").click(function (e) { 
			$('.virtualTour').attr('src', url1);  
			$(".virtual_modal").addClass("active");
		});
	 */
    // for test only	


    $(".opt1").click(function(e) {
        $('.virtualTour').attr('src', url1);
        $(this).addClass("active");
        $(".opt2").removeClass("active")
    });

    $(".opt2").click(function(e) {
        $('.virtualTour').attr('src', url2);
        $(this).addClass("active")
        $(".opt1").removeClass("active")
    });

    $(".virtual_close").click(function(e) {
        $(".virtual_modal").removeClass("active")
    });


    // 		$('#ip-form-1211 input[name="ib_tags"]').val('Virtual_Tour_requested') 

    $('#ip-form-1211').submit(function() {

        var $fieldComments = $('#ip-form-1211 textarea')
        var comments = $fieldComments.val()
        var formTag = $('#ip-form-1211 input[name="ib_tags"]').val()
        var additionalComments = 'Virtual Tour requested, ' + formTag

        if (comments) {
            comments = comments + '...' + additionalComments
        } else {
            comments = additionalComments
        }

        $fieldComments.val(comments)


        $(".virtual_modal").addClass("active");
        $('.virtualTour').attr('src', url1);

    })


})(jQuery);
</script>
<?php endif; ?>




<script>
(function($) {
    //RECUPERANDO ID DE FORMA GLOBAL
    var tagNameInquireForm = $("#ip-form-1211").find("input[name='ib_tags']").val();
    var tagNameVirtualForm = $("#test").find("input[name='ib_tags']").val();
    console.log(tagNameInquireForm + "/" + tagNameVirtualForm);

    $(document).on("change", ".ip-form-wrap input[type=radio]", function() {
        //Recuperamos el valor del checkbox
        var tagName = $(this).parents("form").find("input[name='ib_tags']").val("");
        var formId = $(this).parents("form").attr("id");
        switch (formId) {
            case 'ip-form-1211':
                $(this).parents("form").find("input[name='ib_tags']").val(tagNameInquireForm + "," + this
                    .value);
                break;

            case 'test':
                $(this).parents("form").find("input[name='ib_tags']").val(tagNameVirtualForm + "," + this
                    .value);
                break;
        }
    });
})(jQuery);
</script>