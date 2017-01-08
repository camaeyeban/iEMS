<head>
	<style type = 'text/css'>
		td
		{
			white-space : nowrap;
		}
		.small
		{
			font-size : 14;
		}
    	.align-center {
    		display: block;
    		margin: 1.0em auto;
    		text-align: center;
		}
	</style>
	<meta charset="utf-8">
  	<!-- datepicker -->
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<link rel="stylesheet" href="/resources/demos/style.css">
	<script>
	$(function() {
		$('.datepicker').each(function()
		{
			$(this).datepicker(
			{
				dateFormat : 'yy-mm-dd',
				changeMonth: true,
				changeYear : true,
				onClose: function( selectedDate)
				{
					$tempdate = selectedDate;
				}
			});
		 });
	});
	</script>

	<script type="text/javascript">
		var max_row = 5;
		var x = 1;
		var i = 0;
		
		$(document).ready(function()
		{
			$(".add").click(function()
			{
				if(x < max_row)
				{
					x++;
					var clone = $('#ot_rendered tbody>tr:last').clone(true).insertAfter('#ot_rendered tbody>tr:last');
						
					 clone.find(".datepicker").removeClass('hasDatepicker').removeAttr('id').attr('id', 'ot['+ otIndex +'].date').val('').datepicker({
            changeMonth: true,
            changeYear : true,
            onClose: function( selectedDate){
              $tempdate = selectedDate;
              searchDate(otIndex);
            }
           });
            clone.find('[id="othrs[0]"]').attr('id','ot['+ otIndex + '].hrs').val('0');
            clone.find('[id="offset[0]"').attr('id','ot['+ otIndex + '].offset').val('0');
            
one.find('[id="offset[0]"]').attr('id','otdate[' + otIndex + ']').val('');
				
				}
				else
					alert("Maximun of 5 OT Dates Only");
			
			});
		});
		
		function deleteRow(el)
		{
			while (el.parentNode && el.tagName.toLowerCase() != 'tr')
				el = el.parentNode;
     
			if (el.parentNode && el.parentNode.rows.length > 2)
			{
				el.parentNode.removeChild(el);
				x--;
			}
		}	
		
	</script>
</head>
<body>
	<body style = "font-family : courier new;" onLoad="initValue()">
	<form name="offset_form" method="POST" action="<?php $PHP_SELF; ?>">
		<h1>Offset Application</h1>
		<table>
		<td style="vertical-align:top">
			<fieldset class="align-center input_fields_wrap" style="height:200px">
			<legend><b> Overtime Rendered</b></legend>
				<table id="ot_rendered" width="500" border="1" cellspacing="0" cellpadding="2">
				<tbody>
				  <tr>
					  <th> OT date </th>
					  <th> OT hour/s </th>
					  <th> Offset hour/s</th>
					  <th> <input type = 'button' class="add" value = 'ADD' /></th>
				  </tr>
				  <tr align="center">
					  <div id="input_fields">
						  <td><input type="text" style="text-align:center" class="datepicker" id="otdate[0]" size="25" maxlength="10"></td>
						  <td><input type="text" style="text-align:center" size="10" maxlength="5" value="0" readonly="readonly" id ="othrs[0]"></td>
						  <td><input type="text" style="text-align:center" size="10" maxlength="5" id="offset[0]" value = 0 readonly="readonly" onkeyup="fill_totalhrs()"></td>
						  <td><a href="#" class="remove_field small" style="text-decoration:none" onclick="deleteRow(this)"> Remove</a></td>
					  </div>
				  </tr>
				</tbody>
				</table>
			</fieldset>
		</td>
		<td style="vertical-align:top">
			<fieldset style="width:270px;height:215px;">
				<legend><b> Offset Request </b></legend>
				Total Hours: <input type="text" style="text-align:center" id="total_hrs" size = "5" readonly="readonly" value="0" maxlength="5" name="hrs_total">
			</fieldset>
		</td>
		</table>
	</form>
</body>