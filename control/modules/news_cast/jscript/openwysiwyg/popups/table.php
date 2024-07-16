<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
	<head>
		<title>openWYSIWYG | Create or Modify Table</title>

		<style type="text/css">
			body, td {
				font-family: arial, verdana, helvetica; 
				font-size: 11px;
			}
			
			select, input, button {
				font-size: 10px;
			}
			
			.table-settings {
				background-color: #F7F7F7; 
				border: 0px  dotted; 
				padding: 5px;			
			}
		</style>

	</head>
	<script type="text/javascript" src="../scripts/wysiwyg-popup.js"></script>
	<script type="text/javascript" src="../scripts/wysiwyg-color.js"></script>
		
	<script type="text/javascript">
	var n = WYSIWYG_Popup.getParam('wysiwyg');
		
	// add stylesheet file
	if(n) document.write('<link rel="stylesheet" type="text/css" href="../' + WYSIWYG.config[n].CSSFile +'">\n');
	
	/* ---------------------------------------------------------------------- *\
	  Function    : buildTable()
	  Description : Builds a table and inserts it into the WYSIWYG.
	\* ---------------------------------------------------------------------- */
	function buildTable() {
	  		
		var WYSIWYG_Table = window.opener.WYSIWYG_Table;
		var doc = WYSIWYG.getEditorWindow(n).document;
		// create a table object
		var table = doc.createElement("TABLE");
		// set cols and rows
		WYSIWYG_Core.setAttribute(table, "tmpcols", document.getElementById("cols").value);
		WYSIWYG_Core.setAttribute(table, "tmprows", document.getElementById("rows").value);
		// alignment
		if(document.getElementById("alignment").value != "") 
			WYSIWYG_Core.setAttribute(table, "align", document.getElementById("alignment").value);
		
		// style attributes
		var style = "";
		// padding
		style += "padding:" + document.getElementById("padding").value + "px;";
		// width
		style += "width:" + document.getElementById("width").value + document.getElementById("widthType").value + ";";
		// border
		style += "border:" + document.getElementById("border").value + "px;";
		// borderstyle
		if(document.getElementById("borderstyle").value != "none")
			style += "border-style:" + document.getElementById("borderstyle").value + ";";
		// border-color
		if(document.getElementById("bordercolor").value != "none")
			style += "border-color:" + document.getElementById("bordercolor").value + ";";
		// border-collapse
		var collapse = document.getElementById("bordercollapse").checked ? "true" : "separate";
		style += "border-collapse:" + collapse + ";";
		// background-color
		if(document.getElementById("backgroundcolor").value != "none")
			style += "background-color:" + document.getElementById("backgroundcolor").value + ";";
		
		WYSIWYG_Core.setAttribute(table, "style", style);
		
		
		WYSIWYG_Table.create(n, table);
		window.close();
		return;
		
		// Checks if the table border will use the BORDER-COLLAPSE CSS attribute
		var collapse;
		if (document.getElementById('borderCollapse').checked == true) {
			collapse = document.getElementById('borderCollapse').value;
		}
		else {
			collapse = "separate";
		}
		
		// Builds a table based on the data input into the form
		var table = '<table border="0" cellpadding="0" cellspacing="0" style="';
		table += 'BORDER-COLLAPSE: ' + collapse + ';';  
		table += ' border: ' + document.getElementById('borderWidth').value + ' ' +  document.getElementById('borderStyle').value + ' ' +  document.getElementById('borderColor').value + ';';	
		table += ' width: ' + document.getElementById('tableWidth').value + document.getElementById('widthType').value + ';';
		table += ' background-color: ' + document.getElementById('shadingColor').value + ';"';
		table += ' alignment="' + document.getElementById('alignment').value + '">\n';	
		
		// Creates the number of rows and cols the table will have
		for (var i = 0; i < document.getElementById('rows').value; i++) {
			table += '<tr>\n';
			for (var j = 0; j < document.getElementById('cols').value; j++) {
				table += '<td style="border: ' + document.getElementById('borderWidth').value + ' ' +  document.getElementById('borderStyle').value + ' ' +  document.getElementById('borderColor').value + '; padding: ' + document.getElementById('padding').value + ';">&nbsp;</td>\n';
			}
			table += '</tr>\n';
		}
		table += '</table>\n';
		
		
		// Inserts the table code into the WYSIWYG editor	
		WYSIWYG.insertHTML(table, n);
		window.close();
	}	
	</script>

	<body bgcolor="#EEEEEE" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" onLoad="WYSIWYG_ColorInst.init();">

		<table border="0" cellpadding="0" cellspacing="0" style="width:100%;padding: 10px;">
			<tr>
				<td>
					<span style=" font-weight: bold;">Table Properties:</span>

					<table style="width:100%;" border="0" cellpadding="1" cellspacing="0"
						class="table-settings">
						<tr>
							<td style="width: 20%;">
								Rows:
							</td>
							<td style="width: 25%;">
								<input type="text" size="4" id="rows" name="rows" value="2" style="width: 50px;">
							</td>
							<td style="width: 25%;">
								Width:
							</td>
							<td style="width: 30%;">
								<input type="text" name="width" id="width" value="100" size="10" style="width: 50px;">
								<select name="widthType" id="widthType"
									style="margin-right: 10px; font-size: 10px;">
									<option value="%">%</option>
									<option value="px">px</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Cols:
							</td>
							<td>
								<input type="text" size="4" id="cols" name="cols" value="2"	style="width: 50px;">
							</td>
							<td>
								Alignment:
							</td>
							<td>
								<select name="alignment" id="alignment" style="margin-right: 10px; width: 95px;">
									<option value="">Not Set</option>
									<option value="left">Left</option>
									<option value="right">Right</option>
									<option value="center">Center</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Padding:
							</td>
							<td>
								<input type="text" id="padding" name="padding" value="2" style="width: 50px;">
							</td>
							<td>
								Background-Color:
							</td>
							<td>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="25">
											<table border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<input type="text" name="backgroundcolor" id="backgroundcolor" value="none" style="width:50px;">
													</td>
												</tr>
											</table>
										</td>
										<td>
											<button style="margin-left: 2px;" onClick="WYSIWYG_ColorInst.choose('backgroundcolor');">
												Choose
											</button>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
						<td>
							Border-Size:
						</td>
						<td>
							<input type="text" size="4" id="border" name="border" value="0" style="width: 50px;">
						</td>
						<td>
							Border-Color:
						</td>
						<td>
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="25">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td>												
													<input type="text" name="bordercolor" id="bordercolor" value="none" style="width:50px;">
												</td>
											</tr>
										</table>
									</td>
									<td>
										<button style="margin-left: 2px;" onClick="WYSIWYG_ColorInst.choose('bordercolor');">
											Choose
										</button>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							Border-Style:
						</td>
						<td>
							<select id="borderstyle" name="borderstyle" style="width: 80px;">
								<option value="none">none</option>
								<option value="solid">solid</option>
								<option value="double">double</option>
								<option value="dotted">dotted</option>
								<option value="dashed">dashed</option>
								<option value="groove">groove</option>
								<option value="ridge">ridge</option>
								<option value="inset">inset</option>
								<option value="outset">outset</option>
							</select>
						</td>
						<td>
							Border-Collapse:
						</td>
						<td>
							<input type="checkbox" name="bordercollapse" id="bordercollapse">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		</table>
			<div align="right">
				<input type="submit" value="  Submit  " onClick="buildTable();"
					style="font-size: 12px;">
				&nbsp;
				<input type="submit" value="  Cancel  " onClick="window.close();"
					style="font-size: 12px; margin-right: 15px;">
			</div>
				</td>
			</tr>
		</table>
	</div>
	</body>
</html>