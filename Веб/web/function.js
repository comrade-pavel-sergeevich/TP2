/*function makeRequest(url) {
	var R = new XMLHttpRequest();
	R.open('GET',url,true);
	R.send();
	R.onreadystatechange = function() { 
	    if (R.readyState == 4) {
	        if (R.status == 200) {
	            document.getElementById('wrapper').innerHTML=R.responseText;
	            window.location.hash=url.split('.')[0];
	        }
	        else { console.log(R.status);}
	    }
	}
}
function checkHash() {

	if (window.location.hash.length>1){
		let hash = window.location.hash.slice(1) + '.html';
		console.log(hash);
		makeRequest(hash);
		}
}*/
function regist(data){
	
}

function bdconn(url,method, functionName, dataArr){
	var Rbd = new XMLHttpRequest();
	Rbd.open(method,url,true);
	Rbd.send(dataArr);
	Rbd.onreadystatechange = function() { 
		if (R.readyState == 4) {
			if (R.status == 200) {
				functionName(this);
			}
		}
}
}

function requestData(dataArr){
	let out = '';
	for (let key in dataArr){
		out += `${key}=${dataArr[key]}`;

	}
	return out;
}


function emptyField(fiels){
	let result = false;
	fiels.forEach ((item)=>{
			if(empty(fiels)){
				result = true;
				return result;
			}
	})
	return result;
	
}
function missPassword(pwd, pwdrepeat){
	let result = false;
	if(pwd !== pwdrepeat)
	{
		result = true;
	}
	return result;

}

