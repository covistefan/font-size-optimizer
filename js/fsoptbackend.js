var jQ=jQuery.noConflict();

function showWL(wlVal) {
	jQ("#wlarea").hide(); if (wlVal == "wordline") { jQ("#wlarea").show(); }
	jQ("#uoarea").show(); if (wlVal == "line") { jQ("#uoarea").hide(); }
	jQ("#slarea").show(); if (wlVal == "line") { jQ("#slarea").hide(); } 
	}

function insertUpdateCancel() {
	jQ(".editcode").removeClass('editcode');
	jQ("#ceen").val("").attr('readonly',false).attr('disabled',false);
	jQ("#cmcn").val("");
	jQ("#cmsn").val("");
	jQ("#cubn").val("word");
	jQ("#cwln").val("");
	jQ("#editid").val("");
	jQ("#cuon").prop('checked',false);
	jQ("#csln").prop('checked',false);
	jQ("#btnie").val(fso_string.insert);
	showWL("word");
	}

function insertUpdateGenerated() {
	var ceen = jQ("#ceen").val();
	var cmcn = jQ("#cmcn").val();
	var cmsn = jQ("#cmsn").val();
	var cubn = jQ("#cubn").val();
	var cwln = jQ("#cwln").val();
	var cuon = jQ("#cuon").prop('checked'); if (cuon && cubn!='line'){ cuon = 1; } else {cuon=0;}
	var csln = jQ("#csln").prop('checked'); if (csln && cubn!='line'){ csln = 1; } else {csln=0;}
	// reset wordline counter if not needed
	if (cubn!='wordline') { cwln = ''; }

	// container ID
	var conID = Date.now();
	if (!Date.now) { Date.now = function now () { return new Date().getTime(); };}
	var editID = jQ("#editid").val();
	if (editID!=''){ conID = editID; } 
	
	if (ceen != "") {
		if (jQ('#generated_code_area').children().length<1) { jQ('#generated_code_area').show(); }
		
		var output = '<div id="'+ conID +'" class="codeholder"><div class="showcode">';
		output += '<input type="hidden" name="ceen_value[]" value="' + ceen + '" id="ceen_' + conID + '" />' +
		'<input type="hidden" name="cmcn_value[]" value="' + cmcn + '" id="cmcn_' + conID + '" />' +
		'<input type="hidden" name="cmsn_value[]" value="' + cmsn + '" id="cmsn_' + conID + '" />' +
		'<input type="hidden" name="cubn_value[]" value="' + cubn + '" id="cubn_' + conID + '" />' +
		'<input type="hidden" name="cwln_value[]" value="' + cwln + '" id="cwln_' + conID + '" />' +
		'<input type="hidden" name="cuon_value[]" value="' + cuon + '" id="cuon_' + conID + '" />' +
		'<input type="hidden" name="csln_value[]" value="' + csln + '" id="csln_' + conID + '" />';
		
		output += "$('<div style='display: inline;' id='az_ceen_" + conID + "'>" + ceen + "</div>')" + '.optwidth' + "({\n";
		if (cmcn!=""){ output += "<div style='display: inline;' id='az_cmcn_" + conID + "'>\tmc: '" + cmcn + "',\n</div>"; }
		else { output += "<div style='display: none;' id='az_cmcn_" + conID + "'></div>"; }
		if (cmsn>0){ output += "<div style='display: inline;' id='az_cmsn_" + conID + "'>\tms: " + cmsn + ",\n</div>"; }
		else { output += "<div style='display: none;' id='az_cmsn_" + conID + "'></div>"; }
		if (cubn!="word"){ output += "<div style='display: inline;' id='az_cubn_" + conID + "'>\tub: '" + cubn + "',\n</div>";}
		else{ output += "<div style='display: none;' id='az_cbun_" + conID + "'></div>";}
		if (cwln>0){ output += "<div style='display: inline;' id='az_cwln_" + conID + "'>\twl: " + cwln + "\n</div>";}
		else{ output += "<div style='display: none;' id='az_cwln_" + conID + "'></div>";}
		if (cuon == 1 && cubn!='line'){ output += "<div style='display: inline;' id='az_cuon_" + conID + "'>" + "\t" + 'uo: ' + "true,\n</div>";}
		else{ output += "<div style='display: none;' id='az_cuon_" + conID + "'></div>";}
		if (csln==1 && cubn!='line'){output += "<div style='display: inline;' id='az_csln_" + conID + "'>" + "\t" + 'sl: ' + "true,\n</div>";}
		else{ output += "<div style='display: none;' id='az_csln_" + conID + "'></div>";}
		output += "\t});</div>";
		output += '<input type="button" class="button button-small" value="' + fso_string.remove + '" onclick="eraseItem(\'' + conID + '\')" >' +
		'<input type="button" class="button button-small" value="' + fso_string.edit + '" onclick="editItem(\'' + conID + '\')" >' + 
		'<input type="button" class="button button-small" value="' + fso_string.duplicate + '" onclick="dupItem(\'' + conID + '\')" >' +'</div>';
		if (editID!='') { jQ("#" + conID ).replaceWith(output); } else { jQ("#generated_code_area").append(output); }
		insertUpdateCancel();}
	else{
		alert(fso_string.setup_selector);
		}
	}
		
function eraseItem(dnum){
	jQ('#' + dnum).remove();
	jQ("#ceen").val("").attr('readonly',false).attr('disabled',false);
	jQ("#cmcn").val("");
	jQ("#cmsn").val("");
	jQ("#cubn").val("word");
	jQ("#cwln").val("");
	jQ("#editid").val("");
	jQ("#delhint").show();
    jQ("#cuon").prop('checked',false);
	jQ("#csln").prop('checked',false);
	jQ("#btnie").val(fso_string.insert);
	if (jQ('#generated_code_area').children().length<1) { jQ('#generated_code_area').hide(); }
	}
	
function editItem(editnum){
	var ceen = jQ("#ceen_" + editnum).val();
	var cmcn = jQ("#cmcn_" + editnum).val();
	var cmsn = jQ("#cmsn_" + editnum).val(); if ((cmsn*1)==0) { cmsn = ''; }
	var cubn = jQ("#cubn_" + editnum).val();
	var cwln = jQ("#cwln_" + editnum).val(); if ((cwln*1)==0) { cwln = ''; }
	var cuon = jQ("#cuon_" + editnum).val();
	var csln = jQ("#csln_" + editnum).val();	
	jQ(".editcode").removeClass('editcode');
	jQ('#' + editnum).addClass('editcode');		
	jQ("#btnie").val(fso_string.dochanges);
	jQ("#editid").val(editnum);
	jQ("#ceen").val(ceen).attr('readonly','readonly').attr('disabled','disabled');
	jQ("#cmcn").val(cmcn);
	jQ("#cmsn").val(cmsn);
	jQ("#cubn").val(cubn);
	jQ("#cwln").val(cwln);
	if (cuon == "1"){jQ("#cuon").prop('checked',true);}
	else{jQ("#cuon").prop('checked',false);}
	if (csln == "1"){jQ("#csln").prop('checked',true);}
	else{jQ("#csln").prop('checked',false);}
	showWL(cubn);
	}

function dupItem(dupnum){
	var ceen = jQ("#ceen_" + dupnum).val();
	var cmcn = jQ("#cmcn_" + dupnum).val();
	var cmsn = jQ("#cmsn_" + dupnum).val(); if ((cmsn*1)==0) { cmsn = ''; }
	var cubn = jQ("#cubn_" + dupnum).val();
	var cwln = jQ("#cwln_" + dupnum).val(); if ((cwln*1)==0) { cwln = ''; }
	var cuon = jQ("#cuon_" + dupnum).val();
	var csln = jQ("#csln_" + dupnum).val();	
	jQ(".editcode").removeClass('editcode');
	jQ("#ceen").val("").attr('readonly',false).attr('disabled',false);
	jQ("#cmcn").val(cmcn);
	jQ("#cmsn").val(cmsn);
	jQ("#cubn").val(cubn);
	jQ("#cwln").val(cwln);
	jQ("#editid").val('');
	if (cuon == "1"){jQ("#cuon").prop('checked',true);}
	else{jQ("#cuon").prop('checked',false);}
	if (csln == "1"){jQ("#csln").prop('checked',true);}
	else{jQ("#csln").prop('checked',false);}
	showWL(cubn);
	}