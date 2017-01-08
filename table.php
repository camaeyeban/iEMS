<html>
	<head>
		<title> Add/Remove dynamic rows in HTML table </title>
		<script language="javascript">
		function addRow(tableID)
		{
			var table=document.getElementById(tableID);
			var rowCount=table.rows.length;
			var row=table.insertRow(rowCount);
			var colCount=table.rows[0].cells.length;
			for(var i=0;i<colCount;i++)
			{
				var newcell=row.insertCell(i);
				newcell.innerHTML=table.rows[0].cells[i].innerHTML;
				switch(newcell.childNodes[0].type)
				{
					case "text"      : newcell.childNodes[0].value = 0; break;
					case "checkbox"  : newcell.childNodes[0].checked=false; break;
					case "select-one": newcell.childNodes[0].selectedIndex=0;break;
				}
				newcell.className = 'dp';
			}
		}
		function deleteRow(tableID)
		{
			try
			{
				var table=document.getElementById(tableID);
				var rowCount=table.rows.length;
				for(var i=0;i<rowCount;i++)
				{
					var row=table.rows[i];
					var chkbox=row.cells[0].childNodes[0];
					if(null!=chkbox&&true==chkbox.checked)
					{
						if(rowCount<=1)
						{
							alert("Cannot delete all the rows.");
							break;
						}
						table.deleteRow(i);rowCount--;
						i--;
					}
				}
			}
			catch(e)
			{
				alert(e);
			}
		}
		</script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
			$(function()
			{
				$('.dp').datepicker();
			});
		</script>
	</head>
	<body>

		<input type="button" value="Add Rbbow" onclick="addRow('dataTable')">

		<input type="button" value="Delete Row" onclick="deleteRow('dataTable')">

		<table id="dataTable" border = 0>
			<tbody>
				<tr>
					<td><input type="checkbox" name="chk"/></td>
					<td><input type="text" name="poil[]" id = "haha[]" class="dp"/></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>