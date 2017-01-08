//Javascript funtions

	
	function confirmation(action, form){
		if(form=="un"){
			var id = document.getElementsByName("itemChk2[]");	
		}else{
			var id = document.getElementsByName("itemChk[]");
		}
		
		var first = action.slice(0,1);
		var Caps = first.toUpperCase() + action.substring(1);
		var valid = false;
		for(var i in id){
			if(id[i].checked){
				valid = true;
				break;
			}
		}
			if(valid){
				var x = confirm(Caps+" selected application/s?");
				if(x){
					return true;
				}else{
					return false;
				}
			}else{
					alert("Select atleast one application to "+action+".");
					return false;
			}
	}
	
	function conf_air(action){
		var name = document.getElementsByName('rad_air');		
		var valid =false;
		for(var i in name){
			if(name[i].checked){
				valid = true;
				break;
			}
		}
			if(valid){
				return true;
			}else{
				alert("Select one application to "+action+".");
				return false;
			}
	}
	
	function open_ot(ot_id){
		var left = parseInt((screen.availWidth/2) - (500/2));
		var top = parseInt((screen.availHeight/2) - (270/2));
		window.open("ot_details.php?ot_id="+ot_id,"_blank","modal=yes, toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=1, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=500, height=270");      
	}

	function open_acc(ot_id){
		var left = parseInt((screen.availWidth/2) - (550/2));
		var top = parseInt((screen.availHeight/2) - (360/2));
		window.open("acc_details.php?ot_id="+ot_id,"_blank","modal=yes, toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=550, height=360");
	}
		
	function remarks(ID){
		var left = parseInt((screen.availWidth/2) - (398/2));
		var top = parseInt((screen.availHeight/2) - (418/2));
		window.open("remarks.php?ID="+ID+"&id=0","_blank","modal=yes, toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=yes, width=398, height=418");
	}
	
	function announce(id){
		var left = parseInt((screen.availWidth/2) - (410/2));
		var top = parseInt((screen.availHeight/2) - (460/2));
		window.open("announcement.php?ID="+id,"_blank", "modal=yes, toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=1, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=410, height=460");
	}

	function view_all(){
		var left = parseInt((screen.availWidth/2) - (450/2));
		var top = parseInt((screen.availHeight/2) - (500/2));
		window.open("view_announcement.php","_blank", "modal=yes, toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=1, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=450, height=500");
	}
	
	function load_edit(ID, action){
		switch(action){
			case "leave_edit":
			case "undr_edit":
				window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
			break;
			
			case "ot_edit":
				window.open("ot.php?ID="+ID+"&action="+action,"_self")
			break;
			
			case "off_edit":
				window.open("offset.php?ID="+ID+"&action="+action,"_self")
			break;
			
			case "ob_edit":
				window.open("ob.php?ID="+ID+"&action="+action,"_self")
			break;
			
			case "equip_edit":
				window.open("equip_request.php?ID="+ID+"&action="+action,"_self")
			break;
			
			case "request_edit":
				window.open("request_equip.php?ID="+ID+"&action="+action,"_self")
			break;
			
			case "air_edit":
				window.open("airticket.php?ID="+ID+"&action="+action,"_self")
			break;
		}
	}
	
	// var cnt = 1;
	// function checkit(ID){
		// if(document.getElementById(ID).checked==false){
			// document.getElementById(ID).checked = true;
			// cnt++;
		// }else{
			// document.getElementById(ID).checked = false;
			// cnt--;
		// }
	// }

	
	var val = 1;
	var val2 = 1;
	var val3 = 1;
	var val4 = 1;

	function toggle(menu){

	
	switch(menu){
		case "personal":
				if(val==1){
					document.getElementById('per').innerHTML = "Personal[+]";
					val++;
				}else{
					document.getElementById('per').innerHTML = "Personal[-]";
					val--;
				}
			break;
		case "emp":
				if(val2==1){
					document.getElementById('emp').innerHTML = "Employment[+]";
					val2++;
				}else{
					document.getElementById('emp').innerHTML = "Employment[-]";
					val2--;
				}
			break;	

		case "leave":
				if(val3==1){
					document.getElementById('leave').innerHTML = "Leave[+]";
					val3++;
				}else{
					document.getElementById('leave').innerHTML = "Leave[-]";
					val3--;
				}
			break;	

		case "other":
				if(val4==1){
					document.getElementById('other').innerHTML = "Other[+]";
					val4++;
				}else{
					document.getElementById('other').innerHTML = "Other[-]";
					val4--;
				}
			break;	
			
		default:
			break;
	}
}

	function bread(url){
		switch(url){
			case "/ems/inbox.php":
				document.getElementById('inbox').style.color = "black";
			break;
	
			case "/ems/leave_undr_summary.php":
			case "/ems/leave_undertime.php":
				document.getElementById('LU').style.color = "black";
			break;

			case "/ems/view_ot_request.php":
			case "/ems/ot.php":
			case "/ems/view_edit_offset.php":
			case "/ems/offset.php":
				document.getElementById('OT').style.color = "black";
			break;
	
			case "/ems/view_edit_ob.php":
			case "/ems/ob.php":
				document.getElementById('OB').style.color = "black";
			break;
			
			case "/ems/equip_request.php":
			case "/ems/view_edit_equip.php":
			case "/ems/request_equip.php":
			case "/ems/view_edit_requisition.php":
			case "/ems/airticket.php":
			case "/ems/view_edit_airticket.php":
				document.getElementById('AA').style.color = "black";
			break;
			
			case "/ems/view_leave_undr.php":
			case "/ems/view_ot_accomplishment.php":
			case "/ems/view_offset_request.php":
			case "/ems/view_ob_request.php":
			case "/ems/view_reservation.php":
			case "/ems/view_requisition.php":
			case "/ems/view_airticket_request.php":
				document.getElementById('TR').style.color = "black";
			break;			
			
			case "/ems/comp_info.php":
			case "/ems/comp_structure.php":
			case "/ems/business_units.php":
			case "/ems/view_jobtitle.php":
			case "/ems/view_joblevel.php":
			case "/ems/view_empstatus.php":
			case "/ems/view_admin_users.php":
			case "/ems/view_ems_users.php":
			case "/ems/add_ems_users.php":
			case "/ems/add_admin_user.php":
			case "/ems/job_title.php":
			case "/ems/job_level.php":
			case "/ems/emp_status.php":
				document.getElementById('AD').style.color = "black";
			break;		
			
			case "/ems/view_edit_personal.php":
				document.getElementById('PD').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;

			case "/ems/view_edit_contacts.php":
				document.getElementById('CD').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;
			
			case "/ems/view_edit_emergency.php":
				document.getElementById('EC').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;
			
			case "/ems/view_edit_dependents.php":
				document.getElementById('D').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;

			case "/ems/photo.php":
				document.getElementById('PH').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;
			
			case "/ems/view_edit_benefits.php":
				document.getElementById('BEN').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;
			
			case "/ems/view_edit_job.php":
				document.getElementById('JOB').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;

			case "/ems/attachments.php":
				document.getElementById('ATT').style.color = "black";					
				document.getElementById('eim').style.color = "black";	
			break;
			//REQUEST DEMO UNIT ---------------------------------------------------------//
			case "/ems/demo_unit_request.php":
				document.getElementById('DU').style.color = "black";
			break;
			default:
				document.getElementById('eim').style.color = "black";			
			break;
		}
	}

	function mouseOut(ID){
		switch(ID){
			case "save":
				document.getElementById(ID).style.backgroundImage = "url('icons/save.png')";
			break;
		}		
	}
	
	function mouseDown(ID){
		switch(ID){
			case "save":
				document.getElementById(ID).style.backgroundImage = "url('icons/save2.png')";		
			break;
		}

	}