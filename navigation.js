$(document).ready(function(){

//for the main navigator


      $("a.admin").click(function(){
         $(this).parent().find("ul.subnav").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav").hide('fast');
      });
	  return false;
      });

      $("a.eim" || "a.eim2").click(function(){
         $(this).parent().find("ul.subnav2").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav2").hide('fast');
      });
	  return false;
      });
	  
	  $("a.TR").click(function(){
         $(this).parent().find("ul.subnav3").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav3").hide('fast');
      });
	  return false;
      });
	  
	  $("a.AR").click(function(){
         $(this).parent().find("ul.subnav4").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav4").hide('fast');
      });
	  return false;
      });

      $("a.LU").click(function(){
         $(this).parent().find("ul.subnav3").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav3").hide('fast');
      });
	  return false;
      });

      $("a.OT").click(function(){
         $(this).parent().find("ul.subnav4").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav4").hide('fast');
      });
	  return false;
      });
	  
	  
	  $("a.OB").click(function(){
         $(this).parent().find("ul.subnav5").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav5").hide('fast');
      });
	  return false;
      });
	  
	        $("a.AA").click(function(){
         $(this).parent().find("ul.subnav6").show('fast');
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav6").hide('fast');
      });
	  return false;
      });


    //for the submenus
          //Company Info

     $(".comp").mouseenter(function(){
         $(this).parent().find(".subgen").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subgen").hide('fast');
      });
      });

      $(".job").mouseenter(function(){
         $(this).parent().find(".subjob").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subjob").hide('fast');
      });
      });
	  
      $(".user").mouseenter(function(){
         $(this).parent().find(".subuser").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subuser").hide('fast');
      });
      });
	  
      $(".ot").mouseenter(function(){
         $(this).parent().find(".subot").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subot").hide('fast');
      });
      });
	  
      $(".ot").mouseenter(function(){
         $(this).parent().find(".suboff").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".suboff").hide('fast');
      });
      });
	  
	  $(".ob").mouseenter(function(){
		$(this).parent().find(".subob").show();
	  $(this).parent().hover(function(){
	    }, function(){
		  $(this).parent().find(".subob").hide('fast');
	  });
	  });

      $(".request").mouseenter(function(){
         $(this).parent().find(".subrqst").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subrqst").hide('fast');
      });
      });
	  
	   $(".off").mouseenter(function(){
         $(this).parent().find(".suboff").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".suboff").hide('fast');
      });
      });
	  
	  $(".rsrv").mouseenter(function(){
         $(this).parent().find(".subrsrv").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subrsrv").hide('fast');
      });
      });
	  
	  $(".rqst").mouseenter(function(){
         $(this).parent().find(".subrqst").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subrqst").hide('fast');
      });
      });
	  
	  $(".air").mouseenter(function(){
         $(this).parent().find(".subair").show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subair").hide('fast');
      });
      });
	  
	  $(".show").click(function(){
			$(".leave").show('fast');
			// $(this).hide();
			$(".undertime").hide();
			$(".show2").show();
			$(".t").width(670);
	  });
	  
	  $(".show2").click(function(){
			$(".undertime").show('fast');
			// $(this).hide();
			$(".leave").hide();
			$(".show").show();
			$(".t").width(670);
	  });
	  
	$("#a").click(function(){
		$(".remarks").toggle("fast");
		$("#a").html("");
		$(".hide").html("");
	});
	
	$(".log").click(function(){
		$(".details").slideToggle('fast');
	});

	$(".adm").mouseenter(function(){
		$(this).parent().find(".subadm").show();
		$(this).parent().hover(function(){
	}, function(){
		$(this).parent().find(".subadm").hide('fast');
	});
	});
	
	$("#per").click(function(){
		$(".subper").slideToggle('fast');
	});

	$("#emp").click(function(){
		$(".subemp").slideToggle('fast');
	});
	
	$("#leave").click(function(){
		$(".sublv").slideToggle('fast');
	});
	
	$("#other").click(function(){
		$(".subother").slideToggle('fast');
	});
	
	$("#username").blur(function()
	{
	var usr = document.getElementById('username');
	 //remove all the class add the messagebox classes and start fading
	 $("#msgbox").removeClass().addClass('messagebox').text('').fadeIn("slow");
	 //check the username exists or not from ajax
	 $.post("check_user.php",{ username:$(this).val() } ,function(data)
	 {
	  if(data=='yes' || data=='empty') //if username not avaiable
	  {
	   $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
	   {
		//add message and change the class of the box and start fading
		$(this).html('').addClass('messageboxerror').fadeTo(900,1);
	   });
	  }else{
	   $("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
	   {
		//add message and change the class of the box and start fading
		$(this).html('').addClass('messageboxok').fadeTo(900,1);
	   });
	  }
	 });
	});
	
	$("#empid").blur(function()
	{
	 //remove all the class add the messagebox classes and start fading
	 $("#msgbox1").removeClass().addClass('messagebox').text('').fadeIn("slow");
	 //check the username exists or not from ajax
	 $.post("check_user.php",{ empid:$(this).val() } ,function(data)
	 {
	  if(data=='yes' || data=='empty') //if username not avaiable
	  {
	   $("#msgbox1").fadeTo(200,0.1,function() //start fading the messagebox
	   {
		//add message and change the class of the box and start fading
		$(this).html('').addClass('messageboxerror').fadeTo(900,1);
	   });
	  }else{
	   $("#msgbox1").fadeTo(200,0.1,function()  //start fading the messagebox
	   {
		//add message and change the class of the box and start fading
		$(this).html('').addClass('messageboxok').fadeTo(900,1);
	   });
	  }
	 });
	});
	
	$("#add").click(function(){	
		$(".add_rem").show('slow');
		$("#save_remarks").focus();	
	});

	$("#edit").click(function(){
		$(".edit_rem").show('slow');
	});	
	
	$("#can_save").click(function(){
		$(".add_rem").hide('slow');
	});
	
	$("#can_edit").click(function(){
		$(".edit_rem").hide('slow');
	});
	
});