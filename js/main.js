$(document).ready(function() {
	
	hidediv('success');
	hidediv('info');
	hidediv('warning');
	hidediv('danger');
	
	$('#login_form').ajaxForm(function() { 
		var queryString = $('#login_form').formSerialize(); 
		$.post('func/login.php', queryString, function(data) {
			var json = JSON.parse(data);
			console.log(json);
			if(json.login == true){
				showsuccess(json.msg,1000);
				window.location.hash = "home";
				setTimeout("location.reload();",1010);
			}else if(json.login == false){
				showwarning(json.msg,5000);
			}
		});
    });
	
	$('#register_form').ajaxForm(function() { 
		var queryString = $('#register_form').formSerialize(); 
		$.post('func/register.php', queryString, function(data) {
			var json = JSON.parse(data);
			console.log(json);
			if(json.register == true){
				showsuccess(json.msg,1000);
				window.location.hash = "home";
				setTimeout("location.reload();",1010);
			}else if(json.register == false){
				showwarning(json.msg,5000);
			}
		});
    });
	
});

function showdiv(id)
{
document.getElementById(id).style.display='block';
}

function hidediv(id)
{
document.getElementById(id).style.display='none';
}	

function showsuccess(text,time) {
		document.getElementById('success').innerHTML="<strong>Success!</strong> "+text;
		showdiv("success");
		setTimeout("document.getElementById('success').innerHTML='Nichts';",time);
		setTimeout("hidediv('success');",time);
}

function showinfo(text,time) {
		document.getElementById('info').innerHTML="<strong>Info!</strong> "+text;
		showdiv("info");
		setTimeout("document.getElementById('info').innerHTML='Nichts';",time);
		setTimeout("hidediv('info');",time);
}

function showwarning(text,time) {
		document.getElementById('warning').innerHTML="<strong>Warning!</strong> "+text;
		showdiv("warning");
		setTimeout("document.getElementById('warning').innerHTML='Nichts';",time);
		setTimeout("hidediv('warning');",time);
}

function showdanger(text,time) {
		document.getElementById('danger').innerHTML="<strong>Danger!</strong> "+text;
		showdiv("danger");
		setTimeout("document.getElementById('danger').innerHTML='Nichts';",time);
		setTimeout("hidediv('danger');",time);
}