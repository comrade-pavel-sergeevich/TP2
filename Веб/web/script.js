let ln;
let fn;
let p;	
let e;	
let ph;
let l;
let addrs;
const makeRequest = (url) => {
	$.ajax({
		type: 'Get',
		url: url,
		dataType: 'html'		
	}).done(function(data){
	document.getElementById('wrapper').innerHTML=data;
	if(url=='do.php')deals();
	if(url=="changeinfo.php"){
		saveuserdata();
	}
	window.location.hash=url.split('.')[0];
})}
const deals= ()=>{}
const checkHash = () => {
	let url = window.location.hash.slice(1);
	$.ajax({
	type: 'Get',
	url: 'includes/getname.php',
	dataType: 'text'
	}).done(function(data)	{
		if(data !== '')
	{
		document.getElementById("reg").outerHTML="<li class=\"menu-item\" id=\"reg\" onclick=\"logout();\">LogOut</li>";		
		//document.getElementById("home").outerHTML="<li class=\"menu-item\" id=\"home\" onclick=\"makeRequest('do.php');\">TP</li>";
		document.getElementById("log").outerHTML="<li class=\"menu-item\" onclick=\"makeRequest('changeinfo.php')\" id=\"log\">Heil, "+data+"</li>";
		// if(url!="logout"){
		// 	window.location.hash="do";
		// 	makeRequest('do.php');
		// 	return;
		// }
		makeRequest(window.location.hash.slice(1)+'.php');

	}
	else{
		if(url!=="signup"&url!=="login"&url!=="basket"&url!=="admin"&url!=="menu"&url!=="home"&url!=="changeinfo") window.location.hash="home";
		document.getElementById('ulmenu').outerHTML=`
		<ul class="top-menu" id="ulmenu">
		<li class="menu-item" id="home" onclick="makeRequest('home.php');">Home</li>
		<li class="menu-item" id="menu"onclick="makeRequest('menu.php');window.scrollTo(0, 0);">Menu</li>
		<li class="menu-item" id="basket"onclick="makeRequest('basket.php');">Basket</li>
		<li class="menu-item" id="reg" onclick="makeRequest('signup.php');">Register</li>	
		<li class="menu-item" id="log" onclick="makeRequest('login.php');">Log in</li></ul>
		`;
		makeRequest(window.location.hash.slice(1)+'.php');
	}
	}
	)
}

function get_name(){
	$.ajax({
	type: 'Get',
	url: 'get_email.php',
	dataType: 'string'
	}).done(function(data){return data})
}
function logout(){
	$.ajax({
	type: 'Get',
	url: 'includes/logout.php',
	dataType: 'text'
	}).done(function(data){checkHash();})
	//makeRequest('home.php');	
	//checkHash();
}
function login(){
	let name=document.getElementById('login').value;
	let pwd = document.getElementById('pwd').value;
	if(name==""|pwd==""){document.getElementById('error').innerHTML='<span style = "color:red">Заполните поля</span>';return;}
	$.ajax({
	type: 'Get',
	url: 'includes/loginnew.inc.php',
	data: {name: name,pwd: pwd},
	dataType: 'text'	
	}).done(function(data){
		if(data=="ok"){
			window.location.hash="do";
			checkHash();
		}
		if(data=='wrongpass'){
			document.getElementById('error').innerHTML='<span style = "color:red">Неправильный логин или пароль</span>';
		}
	})
}
function register(){
	let ln=document.getElementById('last_name').value;
	let fn=document.getElementById('first_name').value;
	let pn=document.getElementById('patronymic').value;
	let phn=document.getElementById('phone').value;
	let login=document.getElementById('login').value;
	let email=document.getElementById('email').value;
	let pwd = document.getElementById('pwd').value;
	let pwdrepeat = document.getElementById('pwdrepeat').value;
	if(email==""|pwd==""|pwdrepeat==""|ln==""|fn==""|pn==""|login==""|phn==""){
		document.getElementById('error').innerHTML='<span style = "color:red">Заполните поля</span>';return;}
	if(pwd!=pwdrepeat){
		document.getElementById('error').innerHTML='<span style = "color:red">Пароли не совпадают</span>';return;}	
	if(document.getElementById('email').validity.typeMismatch){
 document.getElementById('error').innerHTML='<span style = "color:red">Невалидный email</span>';return;;
}
	$.ajax({
	type: 'Get',
	url: 'includes/logincheck.inc.php',
	data: {login: login},
	dataType: 'text'	
	}).done(function(data){
		if(data=='exist'){
			document.getElementById('error').innerHTML='<span style = "color:red">Login уже занят</span>'; return;
		}
		$.ajax({
		type: 'Get',
		url: 'includes/signupnew.inc.php',
		data: {ln:ln, fn:fn, pn:pn, phn:phn, login:login, email: email, pwd: pwd},	
		})
		window.location.hash="login";
				checkHash();
		});	
}

function saveuserdata(){
	let userdata=document.getElementById("userdata");
	if (userdata==null){
		setTimeout(saveuserdata, 300);
		return;
	}	
	ln		=	userdata.children[0].children[1].value;
	fn		=	userdata.children[1].children[1].value;
	p		=	userdata.children[2].children[1].value;
	e		=	userdata.children[3].children[1].value;
	ph		=	userdata.children[4].children[1].value;
	l		=	userdata.children[5].children[1].value;
	addrs	=	[];
	let i=7;
	while(userdata.children[i]&&userdata.children[i].children[1].value!=""){
		addrs.push(userdata.children[i].children[1].value);
		i++;
	}
	//console.log(addrs);
}

function changedln(data){
	return(data!==ln);
}
function changedfn(data){
	return(data!=fn);
}
function changedp(data){
	return(data!=p);
}
function changede(data){
	return(data!=e);
}
function changedph(data){
	return(data!=ph);
}
function changedl(data){
	return(data!=l);
}
function changedaddrs(data,i){
	return(data!=addrs[i]);
}

function changepass(login,pass,newpass){
	$.ajax({
		type: 'POST',
		url: 'includes/checkpass.php',
		data: {email: login, pwd:pass},
		dataType: 'text'	
		}).done(function(data){
			if(data=='1'){
			$.ajax({
			type: 'POST',
			url: 'includes/changepass.inc.php',
			data: {login: login, pass: newpass},	
			}).done(function(){
				document.getElementsByName('chpass')[0].value="пароль успешно изменён";
			})
			}
			else{
				document.getElementsByName('chpass')[0].value="неправильный пароль";
			}
});		
}
function changel(login, data){
	$.ajax({
		type: 'POST',
		url: 'includes/changeuserdata.inc.php',
		data: {login: login, param:"last_name", data:data},
		dataType: 'text'	
		}).done(function(){			
				document.getElementsByName('chl')[0].value="✔";	
				document.getElementById('last_name').style.backgroundColor="white";
				ln=data;		
			});			
}
function changef(login, data){
	$.ajax({
		type: 'POST',
		url: 'includes/changeuserdata.inc.php',
		data: {login: login, param:"first_name", data:data},
		dataType: 'text'	
		}).done(function(){			
				document.getElementsByName('chf')[0].value="✔";	
				document.getElementById('first_name').style.backgroundColor="white";
				fn=data;			
			});			
}
function changep(login, data){
	$.ajax({
		type: 'POST',
		url: 'includes/changeuserdata.inc.php',
		data: {login: login, param:"patronymic", data:data},
		dataType: 'text'	
		}).done(function(){			
				document.getElementsByName('chp')[0].value="✔";	
				document.getElementById('patronymic').style.backgroundColor="white";
				p=data;
			});			
}
function changee(login, data){
	$.ajax({
		type: 'POST',
		url: 'includes/changeuserdata.inc.php',
		data: {login: login, param:"email", data:data},
		dataType: 'text'	
		}).done(function(){			
				document.getElementsByName('che')[0].value="✔";	
				document.getElementById('email').style.backgroundColor="white";	
				e=data;	
			});			
}
function changeph(login, data){
	$.ajax({
		type: 'POST',
		url: 'includes/changeuserdata.inc.php',
		data: {login: login, param:"phone", data:data},
		dataType: 'text'	
		}).done(function(){			
				document.getElementsByName('chph')[0].value="✔";	
				document.getElementById('phone').style.backgroundColor="white";
				ph=data;
			});			
}
function changeln(login, data){
	$.ajax({
		type: 'POST',
		url: 'includes/logincheck.inc.php',
		data: {login: login},
		dataType: 'text'	
		}).done(function(res){
			if(res=="exist"){
				document.getElementById('login').value="Логин занят!";		
				return;
			};
			$.ajax({
			type: 'POST',
			url: 'includes/changeuserdata.inc.php',
			data: {login: login, param:"login", data:data},
			dataType: 'text'	
			}).done(function(){			
				document.getElementsByName('chln')[0].value="✔";	
				document.getElementById('login').style.backgroundColor="white";
				document.getElementById("log").innerHTML="Heil, "+data;
				l=data;
				$.ajax({
					type: 'POST',
					url: 'includes/setlogin.inc.php',
					data: {login: login,},
					dataType: 'text'	
					})			
			})
		});			
}
function addaddress(login,addr){
	addrs.push(addr);
	$.ajax({
		type: 'POST',
		url: 'includes/addaddress.inc.php',
		data: {data: addr},
		dataType: 'text'	
		}).done(function(data){	
			data=parseInt(data);		
			$.ajax({
				type: 'POST',
				url: 'includes/addresstouser.inc.php',
				data: {login: login, id: data},
				dataType: 'text'	
				}).done(function(){
					var ci = document.getElementsByClassName("ci");
					ci=document.getElementsByClassName("cim")[0];
					var tmp = ci.children[ci.children.length-1].outerHTML;
					ci.appendChild(document.createElement("div"));					
					ci.children[ci.children.length-1].outerHTML=tmp;
					ci.children[ci.children.length-2].children[2].value="Добавлен ✔";
					ci.children[ci.children.length-2].children[2].onclick=null;
					var num = ci.children.length>9? parseInt(ci.children[ci.children.length-3].children[0].innerHTML.slice(6))+1:1;
					ci.children[ci.children.length-2].children[0].innerHTML="Адрес "+num;
					ci.children[ci.children.length-2].children[1].name="address"+num;
					
							});	
			});			
}
function delad(id){
	id=parseInt(id);
	$.ajax({
		type: 'POST',
		url: 'includes/deladdress.inc.php',
		data: {id: id},
		dataType: 'text'	
		}).done(function(){
			document.getElementById("address"+id).parentElement.outerHTML=null;
		});
}
function chad(id, name,masid){
	id=parseInt(id);
	$.ajax({
		type: 'POST',
		url: 'includes/chaddress.inc.php',
		data: {id: id, name:name},
		dataType: 'text'	
		}).done(function(){
			document.getElementById("address"+id).style.backgroundColor="white";
			document.getElementById("address"+id).nextElementSibling.value="✔";
			addrs[masid-1]=name;
		});
}
function Add(id){
	
}
function Chan_count(count,price,id){
	let sum = count*price;	
	document.getElementById('sum'+id).innerText = sum+" руб.";
	let sums=document.getElementsByName("sum");
	let itogo=0;
	sums.forEach(element => {
		itogo+=parseInt("0"+element.innerHTML.slice(0,-5));
	});
	document.getElementById("itogo").innerHTML=itogo+" руб.";
}
