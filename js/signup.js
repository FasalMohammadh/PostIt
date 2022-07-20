function validate(event) {
    let proPic = document.getElementById('proPic');
    let filePath = proPic.value;
     
    let parent=proPic.parentElement;
    if(!(filePath==="")){
    	let allowedExtensions =/(.jpg|.jpeg|.png)$/; 
    	if (!allowedExtensions.exec(filePath)) {
			profileMsg.classList.toggle('err',true);
			profileMsg.classList.toggle('noErr',false);
        	profileMsg.innerText="Please Select an Image";
        	document.getElementsByClassName('box')[0].innerHTML=`<span class="bi bi-person-plus rounded-circle logo"></span>`;
        	proPic.value=null;
    	}else{
    		let img=event.currentTarget.files[0];
			document.getElementsByClassName('box')[0].innerHTML=`<img class="rounded-circle logo border" src=`+URL.createObjectURL(img)+`></img>`;
			document.getElementsByClassName('box')[0].getElementsByTagName('img')[0].style.padding="0";
		}
    }else{
    	profileMsg.innerText="";
    	document.getElementsByClassName('box')[0].innerHTML=`<span class="bi bi-person-plus rounded-circle logo"></span>`;
    }
}
function validateAll(event){

	function msgPrinter(type,msg,element){
	if(type==="err"){
		event.preventDefault();
		let msgbox=element.parentElement.getElementsByTagName('small')[0];
		msgbox.classList.toggle('err',true);
		msgbox.classList.toggle('noErr',false);
		msgbox.innerText=msg;
	}else{
		let msgbox=element.parentElement.getElementsByTagName('small')[0];
		msgbox.classList.toggle('noErr',true);
		msgbox.classList.toggle('err',false);
		msgbox.innerText=msg;
	}
}


	let proPic = document.getElementById('proPic');
	if(proPic.value===""){
		msgPrinter("err","Please Select an Image",proPic);
	}else{
		msgPrinter("success","Amazing",proPic);
	}


	let fullname=document.getElementsByName('fullname')[0];
	if(fullname.value===""){
		msgPrinter("err","Full Name is Required",fullname);
	}else{
		msgPrinter("success","Nice Name",fullname);
	}

	let email=document.getElementsByName('email')[0];
	if(email.value===""){
		msgPrinter("err","Email is Required",email);
	}else{
		msgPrinter("success","Looks Good",email);
	}

	let dob=document.getElementsByName('DOB')[0];
	if(dob.value===""){
		msgPrinter("err","DOB is Required",dob);
	}else{
		let dobDate=new Date(dob.value);
		let current=new Date();
		let diff=((current.getTime()-dobDate.getTime())/1000/60/60/24/365);
		if(diff<18){
			msgPrinter("err","You must be atleast 18",dob);
		}
		else{
			msgPrinter("success","Valid",dob);
		}
	}

	let pass=document.getElementsByName("pass")[0];
	if(pass.value===""){
		msgPrinter("err","Password is Required",pass);
	}else if(pass.value.length<8){
		msgPrinter("err","Password must atleast 8 characters",pass);
	}else{
		msgPrinter("success","Looks Good",pass);
		let repass=document.getElementsByName("repass")[0];
		if(pass.value===repass.value){
			msgPrinter("success","Passwords match",repass);
		}else{
			msgPrinter("err","Password Do not match",repass);
		}
	}
}
