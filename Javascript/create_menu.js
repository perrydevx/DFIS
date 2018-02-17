// JavaScript Document
function create_menu(p_seqno,p_id,p_divid)
{
	
	WriteInnerHTML('divMenu','');
	tempX = event.clientX + document.body.scrollLeft;
    tempY = event.clientY + document.body.scrollTop;
	changelocation(p_divid,tempX,tempY);
 	WriteInnerHTML(p_divid,create_table_html(p_seqno,p_id));
	//event.clientX 
}
function WriteInnerHTML(p_divid,p_htmlstr){
	
 if (document.getElementById) {
       document.getElementById(p_divid).innerHTML= p_htmlstr;
 } else {
     with (document.layers[p_divid].document) {
     open();
     write(p_htmlstr);
     close();
     }
 }
}

function changelocation(p_div,p_x,p_y)
{

	/*if(x>200&&f==0){f=1;return;}
	
	if(x<101&&f==1){f=0;return;}
	
	if(f)q=-5;if(!f)q=5;x=x+q;*/
	e=document.getElementById(p_div);
	//p_y = p_y - 8;
	//p_x = p_x - 8;
	e.style.top = p_y + 'px';
	e.style.left = p_x + 'px';
	
	//t=setTimeout("changewidth();",0);
}

function create_table_html(p_seqno, p_id)
{
	//alert("<table border='1' cellpadding='2' cellspacing='0' bgcolor='#FFFFCC' bordercolor='#CCCCCC'><tr><td>&nbsp;<a href=" + '"' + "JavaScript:open_medical_history('" + p_seqno + "');" + '"' + "Medical History</a></td></tr></table>");
	return "<table border='1' cellpadding='2' cellspacing='0' bgcolor='#FFFFCC' bordercolor='#CCCCCC'><tr><td class='tbl_header_ctrl'>&nbsp;DETAILS</td></tr><tr><td>&nbsp;<a href='../BDMIS/DonorRegistryForm.php?tran=VP&ftid=donor" + p_id + "'>Personal Profile</a></td></tr><tr><td>&nbsp;<a href=" + '"' + "JavaScript:open_medical_history('" + p_seqno + "');" + '"' + ">Medical History</a></td></tr><tr><td>&nbsp;<a href=" + '"' + "JavaScript:open_physicalexam_history('" + p_seqno + "');" + '"' + ">Physical Examination</a></td></tr></table>";
	//return "Physical Educaion"
	
}
