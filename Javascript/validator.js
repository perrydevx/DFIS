
<!-- 	Javascript Functions		-->

var alpha_format = /^[a-zA-Z\.\-]*$/;
var alphanum_format = /^\w+$/;
var integer_format = /^\d*$/;
//var unsigned_format = /^\d+$/;
//var real_format = /^[\+\-]?\d*\.?\d*$/;
var currency_format = /^\d+(?:\.\d{0,2})?$/;
var email_format = /^[\w-\.]+\@[\w\.-]+\.[a-z]{2,4}$/;
var phone_format = /^[\d\.\s\-]+$/;
var userid_password =  /^[a-zA-Z]\w+$/;



function format_currency(num) {
	num	=	num.toString().replace(/\$|\,/g,'');

	if(isNaN(num)) num = "0";

	sign	=	(num == (num = Math.abs(num)));
	num		=	Math.floor(num*100+0.50000000001);
	cents	=	num%100;
	num		=	Math.floor(num/100).toString();

	if (cents<10) cents = "0" + cents;

	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3)) + ',' + num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + num + '.' + cents);
}


function check_key (p_format) {
	var input_key =  event.keyCode;
	var return_code = true;
 
 	switch(p_format) {
	
		case 'integer' 	: 	// Numbers 
							if (input_key > 47 && input_key < 58 ) {
								return;
							}
							else {
								event.keyCode = 0;
								return false;
							}
							break;
 	
		case 'alpha' 	: 	// Alpha 
							if ((input_key > 64 && input_key < 91 ) 
								|| (input_key > 96 && input_key < 123 )) {
								return;
							}
							else {
								event.keyCode = 0;
								return false;
							}
							break;
							
		case 'alphanum'	: 	// Alpha numeric
							if ((input_key > 64 && input_key < 91 ) 
								|| (input_key > 96 && input_key < 123 )
								|| (input_key > 47 && input_key < 58 )) {
								return;
							}
							else {
								event.keyCode = 0;
								return false;
							}
							break;
							
		case 'currency'	: 	// Currency
							if ((input_key > 47 && input_key < 58 ) 
								|| (input_key == 46)) {
								return;
							}
							else {
								event.keyCode = 0;
								return false;
							}
							break;
 
 	}		
 
}




function check_format(p_val, p_format) {

	if (p_val=="") {
		return false;
	}

	switch(p_format) {
	
		case 'alpha' 	: 	if (!alpha_format.test(p_val)) {
								//alert ("Not Alpha");
								return false;
							}
							break;
						
		case 'alphanum' : 	if (!alphanum_format.test(p_val)) {
								//alert ("Not Alpha Numeric");
								return false;
							}
							break;
							
		case 'integer' 	:	if (!integer_format.test(p_val)) {
								//alert ("Not Integer");
								return false;
							}
							break;
		
		case 'userid_password' :   if (!userid_password.test(p_val)) {
										//alert ("Not Integer");
										return false;
									}
									break;
		/*
		case 'unsigned' :	if (!unsigned_format.test(p_val)) {
								//alert ("Not Unsigned");
								return false;
							}
							break;
								
		case 'real' :		if (!real_format.test(p_val)) {
								//alert ("Not Real");
								return false;
							}
							break;*/
		
		
		case 'currency' :	if (!currency_format.test(p_val)) {
								//alert ("Currency");
								return false;
							}
							break;
		
		case 'email' 	:	if (!email_format.test(p_val)) {
								//alert ("Not Email");
								return false;
							}
							break;
							
		case 'phone' 	:	if (!phone_format.test(p_val)) {
								//alert ("Not Phone");
								return false;
							}
							break;
	}

	return true;
}


function validate_datetime(p_datetime){
	var arr_datetime = p_datetime.split(' ');
	/*
	alert("'" + arr_datetime[0] + "'");
	alert("'" + arr_datetime[1] + "'");
	alert("'" + arr_datetime[2] + "'");
	*/
	if (arr_datetime.length==3)
	{
		if (validate_date(arr_datetime[0])) {
			return validate_time(arr_datetime[1], validate_date(arr_datetime[0]), arr_datetime[2].toUpperCase());
		}
	}
	else
	{
		alert("Invalid Date and Time Format.");
		return false;
	}
		
}

function validate_datetime_nomsg(p_datetime){
	var arr_datetime = p_datetime.split(' ');
	/*
	alert("'" + arr_datetime[0] + "'");
	alert("'" + arr_datetime[1] + "'");
	alert("'" + arr_datetime[2] + "'");
	*/
	if (arr_datetime.length==3)
	{
		if (validate_date_nomsg(arr_datetime[0])) {
			return validate_time_nomsg(arr_datetime[1], validate_date_nomsg(arr_datetime[0]), arr_datetime[2].toUpperCase());
		}
	}
	else
		return false;
}

function validate_date(p_date) {

	var arr_date = p_date.split('-');

	if (arr_date.length != 3) {
		alert ("Invalid date format: '" + p_date + "'.\nFormat accepted is dd-mmm-yyyy.");
		return false;
	}
	
	if (!check_format(arr_date[1],"alpha"))
	{
		alert ("Invalid month value: '" + arr_date[1] + "'.\nAllowed values are JAN-DEC.");
		return false;
	}
	
	for (var i=0; i<ARR_MONTHS.length; i++){
		if (ARR_MONTHS[i].substr(0,3).toUpperCase() == arr_date[1].toUpperCase()){
			arr_date[1] = (i < 9 ? '0' : '') + (i + 1);
			break;
		}
	}
	
	if (!arr_date[0]) {
		alert ("Invalid date format: '" + p_date + "'.\nNo day of month value can be found.");
		return false;
	}
	
	if (!RE_NUM.exec(arr_date[0])) {
		alert ("Invalid day of month value: '" + arr_date[0] + "'.\nAllowed values are unsigned integers.");
		return false;
	}
	
	if (!arr_date[1]) {
		alert ("Invalid date format: '" + p_date + "'.\nNo month value can be found.");
		return false;
	}
	
	if (!RE_NUM.exec(arr_date[1])) {
		alert ("Invalid month value: '" + arr_date[1] + "'.\nAllowed values are JAN-DEC.");
		return false;
	}
	
	if (!arr_date[2]) {
		alert ("Invalid date format: '" + p_date + "'.\nNo year value can be found.");
		return false;
	}
	
	if (!RE_NUM.exec(arr_date[2])) {
		alert ("Invalid year value: '" + arr_date[2] + "'.\nAllowed values are unsigned integers.");
		return false;
	}
	
	if ((arr_date[2] < 1900) || (arr_date[2] > 2050))
	{
		alert ("Invalid year value: '" + arr_date[2] + "'.\nValues should be between 1900 to 2050.");
		return false;
	}
	
	var dt_date = new Date();
	dt_date.setDate(1);

	if (arr_date[1] < 1 || arr_date[1] > 12) {
		alert ("Invalid month value: '" + arr_date[1] + "'.\nAllowed range is 01-12.");
		return false;
	}
	dt_date.setMonth(arr_date[1]-1);
	 
	if (arr_date[2] < 100) {
		arr_date[2] = Number(arr_date[2]) + (arr_date[2] < NUM_CENTYEAR ? 2000 : 1900);
		return false;
	}
	dt_date.setFullYear(arr_date[2]);

	var dt_numdays = new Date(arr_date[2], arr_date[1], 0);
	dt_date.setDate(arr_date[0]);
	if (dt_date.getMonth() != (arr_date[1]-1)) {
		alert ("Invalid day of month value: '" + arr_date[0] + "'.\nAllowed range is 01-"+dt_numdays.getDate()+".");
		return false;
	}

	return true;
}

function validate_date_nomsg(p_date) {

	var arr_date = p_date.split('-');

	if (arr_date.length != 3) {
		return false;
	}

	if (!check_format(arr_date[1],"alpha"))
	{
		return false;
	}
	
	for (var i=0; i<ARR_MONTHS.length; i++){
		if (ARR_MONTHS[i].substr(0,3).toUpperCase() == arr_date[1].toUpperCase()){
			arr_date[1] = (i < 9 ? '0' : '') + (i + 1);
			break;
		}
	}
	
	if (!arr_date[0]) {
		return false;
	}
	
	if (!RE_NUM.exec(arr_date[0])) {
		return false;
	}
	
	if (!arr_date[1]) {
		return false;
	}
	
	if (!RE_NUM.exec(arr_date[1])) {
		return false;
	}
	
	if (!arr_date[2]) {
		return false;
	}
	
	if (!RE_NUM.exec(arr_date[2])) {
		return false;
	}
	
	if ((arr_date[2] < 1900) || (arr_date[2] > 2050))
	{
		return false;
	}
	
	var dt_date = new Date();
	dt_date.setDate(1);

	if (arr_date[1] < 1 || arr_date[1] > 12) {
		return false;
	}
	dt_date.setMonth(arr_date[1]-1);
	 
	if (arr_date[2] < 100) {
		arr_date[2] = Number(arr_date[2]) + (arr_date[2] < NUM_CENTYEAR ? 2000 : 1900);
		return false;
	}
	dt_date.setFullYear(arr_date[2]);

	var dt_numdays = new Date(arr_date[2], arr_date[1], 0);
	dt_date.setDate(arr_date[0]);
	if (dt_date.getMonth() != (arr_date[1]-1)) {
		return false;
	}

	return true;
}

function validate_time (str_time, dt_date, am_pm) {

	if (!dt_date) return null;
	var arr_time = String(str_time ? str_time : '').split(':');
	
	if (!arr_time[0]) dt_date.setHours(0);
	else if (RE_NUM.exec(parseInt(arr_time[0],10))) {
		//if (arr_time[0] < 24) dt_date.setHours(arr_time[0]);
		if ((arr_time[0] < 1) && (arr_time[0] > 12)) {
			alert("Invalid hours value: '" + arr_time[0] + "'.\nAllowed range is 01-12.");
			return false;
		}
	}
	else {
		alert ("Invalid hours value: '" + arr_time[0] + "'.\nAllowed values are unsigned integers.");
		return false;
	}
	
	if (!arr_time[1]) dt_date.setMinutes(0);
	else if (RE_NUM.exec(parseInt(arr_time[1],10))) {
		if (arr_time[1] >= 60) {
			alert("Invalid minutes value: '" + arr_time[1] + "'.\nAllowed range is 00-59.");
			return false;
		}
	}
	else {
		alert("Invalid minutes value: '" + arr_time[1] + "'.\nAllowed values are unsigned integers.");	
		return false;
	}
	
	if (!am_pm) {
		alert("Invalid AM/PM value: '" + am_pm + "'.\nAllowed values are AM and PM.");
		return false;
	}
	else if (am_pm == "") {
		alert("Invalid AM/PM value: '" + am_pm + "'.\nAllowed values are AM and PM.");
		return false;
	}
	else if ((am_pm != "AM") && (am_pm != "PM")) {
		alert("Invalid AM/PM value: '" + am_pm + "'.\nAllowed values are AM and PM.");
		return false;
	}
	/*
	if (am_pm == "PM") {
		dt_date.setHours(parseInt(arr_time[0],10) + 12);
	}
	*/
	/*
	if (!arr_time[2]) dt_date.setSeconds(0);
	else if (RE_NUM.exec(arr_time[2]))
		if (arr_time[2] < 60) dt_date.setSeconds(arr_time[2]);
		else alert ("Invalid seconds value: '" + arr_time[2] + "'.\nAllowed range is 00-59.");
	else alert ("Invalid seconds value: '" + arr_time[2] + "'.\nAllowed values are unsigned integers.");
	*/	

	//dt_date.setMilliseconds(0);
	
	//alert(dt_date);
	
	return true;
}

function validate_time_nomsg (str_time, dt_date, am_pm) {

	if (!dt_date) return null;
	var arr_time = String(str_time ? str_time : '').split(':');
	
	if (!arr_time[0]) dt_date.setHours(0);
	else if (RE_NUM.exec(parseInt(arr_time[0],10))) {
		//if (arr_time[0] < 24) dt_date.setHours(arr_time[0]);
		if ((arr_time[0] < 1) && (arr_time[0] > 12)) {
			//alert("Invalid hours value: '" + arr_time[0] + "'.\nAllowed range is 01-12.");
			return false;
		}
	}
	else {
		//alert ("Invalid hours value: '" + arr_time[0] + "'.\nAllowed values are unsigned integers.");
		return false;
	}
	
	if (!arr_time[1]) dt_date.setMinutes(0);
	else if (RE_NUM.exec(parseInt(arr_time[1],10))) {
		
		if (arr_time[1] >= 60) {
			//alert("Invalid minutes value: '" + arr_time[1] + "'.\nAllowed range is 00-59.");
			return false;
		}
		
	}
	else {
		//alert("Invalid minutes value: '" + arr_time[1] + "'.\nAllowed values are unsigned integers.");	
		return false;
	}
	
	if (!am_pm) {
		//alert("Invalid AM/PM value: '" + am_pm + "'.\nAllowed values are AM and PM.");
		return false;
	}
	else if (am_pm == "") {
		//alert("Invalid AM/PM value111: '" + am_pm + "'.\nAllowed values are AM and PM.");
		return false;
	}
	else if ((am_pm != "AM") && (am_pm != "PM")) {
		//alert("Invalid AM/PM value: '" + am_pm + "'.\nAllowed values are AM and PM.");
		return false;
	}
	/*
	if (am_pm == "PM") {
		dt_date.setHours(parseInt(arr_time[0],10) + 12);
	}
	*/
	/*
	if (!arr_time[2]) dt_date.setSeconds(0);
	else if (RE_NUM.exec(arr_time[2]))
		if (arr_time[2] < 60) dt_date.setSeconds(arr_time[2]);
		else alert ("Invalid seconds value: '" + arr_time[2] + "'.\nAllowed range is 00-59.");
	else alert ("Invalid seconds value: '" + arr_time[2] + "'.\nAllowed values are unsigned integers.");
	*/	

	//dt_date.setMilliseconds(0);
	
	//alert(dt_date);
	
	return true;
}

