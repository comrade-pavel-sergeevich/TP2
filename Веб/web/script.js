const makeRequest = (url) => {
	$.ajax({
		type: 'Get',
		url: url,
		dataType: 'html'		
	}).done(function(data){
	document.getElementById('wrapper').innerHTML=data;
	if(url=='do.php')deals();
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
		document.getElementById("home").outerHTML="<li class=\"menu-item\" id=\"home\" onclick=\"makeRequest('do.php');\">TP</li>";
		document.getElementById("log").outerHTML="<li class=\"menu-item\" id=\"log\">Heil, "+data+"</li>";
		if(url!="logout"){
			window.location.hash="do";
			makeRequest('do.php');
			return;
		}
		makeRequest(window.location.hash.slice(1)+'.php');
	}
	else{
		if(url!=="signup"&url!=="login"&url!=="menu"&url!=="home") window.location.hash="home";
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
	}).done(function(data){})
	//makeRequest('home.php');	
	checkHash();
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
	let login=document.getElementById('login').value;
	let email=document.getElementById('email').value;
	let pwd = document.getElementById('pwd').value;
	let pwdrepeat = document.getElementById('pwdrepeat').value;
	if(email==""|pwd==""|pwdrepeat==""){
		document.getElementById('error').innerHTML='<span style = "color:red">Заполните поля</span>';return;}
	if(pwd!=pwdrepeat){
		document.getElementById('error').innerHTML='<span style = "color:red">Пароли не совпадают</span>';return;}	
	if(document.getElementById('email').validity.typeMismatch){
 document.getElementById('error').innerHTML='<span style = "color:red">Невалидный email</span>';return;;
}
	$.ajax({
	type: 'Get',
	url: 'includes/logincheck.inc.php',
	data: {email: email},
	dataType: 'text'	
	}).done(function(data){
		if(data=='exist'){
			document.getElementById('error').innerHTML='<span style = "color:red">Email уже занят</span>'; return;
		}
		$.ajax({
		type: 'Get',
		url: 'includes/signupnew.inc.php',
		data: {login:login, email: email, pwd: pwd},	
		})
		window.location.hash="login";
				checkHash();
		});	
}


