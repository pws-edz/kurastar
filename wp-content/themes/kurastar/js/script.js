$(document).ready(function() {
		$('.menu-sp').click(function(){
			 $( "#menu-header-menu" ).fadeToggle('fast');
		});
});
/*
$(document).ready(function() {
		$('div.btn20').click(function(){
			 $(this).next().toggle();
			 $(this).find('img').toggle();
		});
});
*/
$(function(){
	$(window).scroll(function(){
		if($(this).scrollTop()!==0){
			$('#bttop').fadeIn();
		} else {
			$('#bttop').fadeOut();
		}
	});

	$('#bttop').click(function(){
		$('body,html').animate({
			scrollTop:0
		},'fast');
	});
});


$(function(){
	$('#cty').click(function(){
		$('.dropcountry').fadeToggle('fast');
	});
});

$(function(){

	$('.droplistcountry li').each(function() {
		var text = $(this).find("a").text();
		$( this ).click(function(){
			$('#cty').val(text);
			$('.dropcountry').fadeOut('fast');
		});
	});
});

$(function(){
	$('#cat').click(function(){
		$('.dropcategory').fadeToggle('fast');
	});
});

$(function(){

	$('.droplistcategory li').each(function() {
		var text = $(this).find("a").text();
		$( this ).click(function(){
			$('#cat').val(text);
			$('.dropcategory').fadeOut('fast');
		});
	});
});


$(window).load(function() {
	if($("div.flexslider").length > 0){
        $('.flexslider').flexslider({
    		animation: "fade",
    		slideshow: true,
    		slideshowSpeed: 3000,
    		animationSpeed: 1000,
    		pauseOnHover: true,
    		controlNav: false
    	});
    }

	
});

$(document).mouseup(function (e)
{
    var container = $(".dropcountry, .dropcategory");
	var container2 = $(".transwrap, .transwrap input ");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && !container2.is(e.target) && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut('fast');
    }
});


$(window).load(function() {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.imgplaceholder').css('background-image', 'url('+e.target.result+')');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
});


$(window).load(function() {

    $("#inputFile2").keyup(function () {
		var bla = $('#inputFile2').val();
         $('.imgplaceholder').css('background-image', 'url('+bla+')');
    });
});
$('#myTabs a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});


/*Single Article Page & Curator Detail Page*/
$(document).on('click', ".edit-custom-form", function(e) {
	e.preventDefault();

	$('.display_details').hide();
	$('.display_section').show();

});

$(document).on('click', ".update_process", function() {

	if (confirm("Are you sure you want to save the chages?") == true) {

		$('#edit-custom-form').submit();

	} else {

		cancellation();

	}

});

$(document).on('click', ".cancel_process", function(e) {
	e.preventDefault();

	cancellation();
});


function cancellation() {

	$('.userinfo_section').hide();
	$('.user_details').show();

	$('.display_details').show();
	$('.display_section').hide();

}


$(document).on('click', "#change-image", function(e) {
	$('#post_image').trigger('click');
});


$(document).on('click',"#change-image-2", function(e) {
	$('#post_image').trigger('click');
});

function readURL(input) {

  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#uploaded_image').attr('src', e.target.result);
          
          if (document.getElementById('change-image-2') != 0) {
          	document.getElementById("change-image-2").style.backgroundImage = "url('" + e.target.result + "')";
      	  }

      }

      reader.readAsDataURL(input.files[0]);
  }
}

$(document).on('change', "#post_image", function(e) {
  readURL(this);
});

/*Curator Detail Page*/

// $(document).on('click', "#image-button", function(e) {
// 	$('#imgInp').trigger('click');
// });

// function readURL(input) {

//   if (input.files && input.files[0]) {
//       var reader = new FileReader();

//       reader.onload = function (e) {
//           $('#blah').attr('src', e.target.result);
//       }

//       reader.readAsDataURL(input.files[0]);
//   }
// }

// // $("#imgInp").change(function(){
// $(document).on('change', "#imgInp", function(e) {
//   readURL(this);
// });

// $(document).on('click', ".edit", function(e) {
//  e.preventDefault();

//  $('.user_details').hide();
//  $('.userinfo_section').show();

// });

// $(document).on('click', ".update_user_info", function() {

// if (confirm("Are you sure you want to save the chages?") == true) {

//   $('#form-curator-info').submit();

// } else {

//   cancellation();
    
// }

// });

// $(document).on('click', ".cancel_user_info", function(e) {
//  e.preventDefault();

//  cancellation();
// });


// function cancellation() {

//  $('.userinfo_section').hide();
//  $('.user_details').show();

// }