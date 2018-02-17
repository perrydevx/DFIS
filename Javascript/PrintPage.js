// START FUNCTION for PRINTing a Web Page
	function PrintThisPage() {
	
	var NS = (navigator.appName == "Netscape");
	var VERSION = parseInt(navigator.appVersion);
	if (VERSION > 3) {
		if (NS) {
			window.print();
			}
		else {
			var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
			document.body.insertAdjacentHTML('beforeEnd' , WebBrowser);
			WebBrowser1.outerHTML = "";
			window.print();
			}
		}
	else {
		prompt('Sorry this function is not supported in your browser. Use the "File -> Print" command from you browser menu.');
		}
	}

	function CountTheTotalNumOfPages(){
		newHTML  = "<IE:DEVICERECT ID='devicerect1' MEDIA='print' CLASS='masterstyle'>";
		newHTML += "<IE:LAYOUTRECT ID='layoutrect1' CONTENTSRC='document' ONLAYOUTCOMPLETE='onPageComplete()' NEXTRECT='layoutrect2' CLASS='contentstyle'/>";
		newHTML += "</IE:DEVICERECT>";
	}
// END FUNCTION for PRINTing a Web Page