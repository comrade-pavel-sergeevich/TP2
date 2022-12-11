<div class="login-box">
<h1 style="margin-top:5px">Профиль</h1>
<div name="error" id="error">

</div>
<?php
include_once("includes/dbpdoconnection.inc.php");
require_once("includes/function.inc.php");
session_start();
$user=getuser($pdo,$_SESSION['user_name']);
echo<<<A
<div class="cim" id="userdata">
<div class="ci"><p style="width:70px; text-align-last:left; margin-right:15px;">Фамилия</p>         <input type="text" placeholder="Фамилия"        value="$user[last_name]"     oninput="if(!changedln(this.value)) {this.style.background='white';this.nextSibling.nextSibling.setAttribute('disabled','disabled');} else {this.style.background='green';this.nextSibling.nextSibling.removeAttribute('disabled');}" id="last_name">
<input type="submit" disabled name='chl' value="✍" onclick="changel('{$_SESSION['user_name']}',this.previousSibling.previousSibling.value);" style="width:30px; margin-left:15px;padding:0"/></input></div>
<div class="ci"><p style="width:70px; text-align-last:left; margin-right:15px;">Имя</p>             <input type="text" placeholder="Имя"            value="$user[first_name]"    oninput="if(!changedfn(this.value)) {this.style.background='white';this.nextSibling.nextSibling.setAttribute('disabled','disabled');} else {this.style.background='green';this.nextSibling.nextSibling.removeAttribute('disabled');}" id="first_name">
<input type="submit" disabled name='chf' value="✍" onclick="changef('{$_SESSION['user_name']}',this.previousSibling.previousSibling.value);" style="width:30px; margin-left:15px;padding:0"/></input></div>
<div class="ci"><p style="width:70px; text-align-last:left; margin-right:15px;">Отчество</p>        <input type="text" placeholder="Отчество"       value="$user[patronymic]"    oninput="if(!changedp(this.value)) {this.style.background='white';this.nextSibling.nextSibling.setAttribute('disabled','disabled');} else {this.style.background='green';this.nextSibling.nextSibling.removeAttribute('disabled');}"  id="patronymic">
<input type="submit" disabled name='chp' value="✍" onclick="changep('{$_SESSION['user_name']}',this.previousSibling.previousSibling.value);" style="width:30px; margin-left:15px;padding:0"/></input></div>
<div class="ci"><p style="width:70px; text-align-last:left; margin-right:15px;">Почта</p>           <input type="email" placeholder="Email"         value="$user[email]"         oninput="if(!changede(this.value)) {this.style.background='white';this.nextSibling.nextSibling.setAttribute('disabled','disabled');} else {this.style.background='green';this.nextSibling.nextSibling.removeAttribute('disabled');}" id="email">
<input type="submit" disabled name='che' value="✍" onclick="changee('{$_SESSION['user_name']}',this.previousSibling.previousSibling.value);" style="width:30px; margin-left:15px;padding:0"/></input></div>
<div class="ci"><p style="width:70px; text-align-last:left; margin-right:15px;">Телефон</p>    <input type="text" placeholder="Номер мобилы"        value="$user[phone]"         oninput="if(!changedph(this.value)) {this.style.background='white';this.nextSibling.nextSibling.setAttribute('disabled','disabled');} else {this.style.background='green';this.nextSibling.nextSibling.removeAttribute('disabled');}"  id="phone">
<input type="submit" disabled name='chph' value="✍" onclick="changeph('{$_SESSION['user_name']}',this.previousSibling.previousSibling.value);" style="width:30px; margin-left:15px;padding:0"/></input></div>
<div class="ci"><p style="width:70px; text-align-last:left; margin-right:15px;">Логин</p>           <input type="text" placeholder="Login"          value="$user[login]"         oninput="if(!changedl(this.value)) {this.style.background='white';this.nextSibling.nextSibling.setAttribute('disabled','disabled');} else {this.style.background='green';this.nextSibling.nextSibling.removeAttribute('disabled');}" id="login">
<input type="submit" disabled name='chln' value="✍" onclick="changeln('{$_SESSION['user_name']}',this.previousSibling.previousSibling.value);" style="width:30px; margin-left:15px;padding:0"/></input></div>

<br>
Адреса:

A;
$addresses=getaddresses($pdo,$_SESSION['user_name']);
$i=1;
foreach ($addresses as &$value){
    echo<<<A
    <div class="ci">
    <p style="width:70px; text-align-last:left; margin-right:15px;">Адрес $i</p>
    <input type="text" name="address{$i}" placeholder="Адрес" oninput="if(!changedaddrs(this.value,parseInt(this.name.slice(7))-1)) {this.style.background='white';this.nextSibling.nextSibling.setAttribute('disabled','disabled');} else {this.style.background='green';this.nextSibling.nextSibling.removeAttribute('disabled');}" id="address{$value["address_id"]}" value = "{$value["address_name"]}"></input>
    <input type="submit" disabled name='chad' value="✍" onclick="chad({$value["address_id"]},this.previousElementSibling.value,$i);" style="width:30px; margin-left:15px;padding:0"/></input>
    <input type="submit" name='delad' value="🗑️" onclick="delad({$value["address_id"]});" style="width:30px; margin-left:15px;padding:0"/></input>
    </div>
    A;
    $i++;
}
echo<<<A
<div class="ci"><p style="width:70px; text-align-last:left; margin-right:15px;">Новый</p><input type="text" name="address" placeholder="Адрес" oninput="if(this.value!='')this.nextSibling.removeAttribute('disabled');else this.nextSibling.setAttribute('disabled',null)"id="address0"></input><input type="button" name="AddAddress" value="Добавить" onclick="addaddress('{$_SESSION['user_name']}',this.previousSibling.value);"  disabled  style="width:75px; height:26; margin-left:15px;padding:0" /></div>
</div>
<br>
Сменить пароль:
<input type="password" placeholder="Текущий пароль" id="pwd" oninput="if(this.value!=''&this.nextSibling.nextSibling.value!='')document.getElementsByName('chpass')[0].removeAttribute('disabled');else document.getElementsByName('chpass')[0].setAttribute('disabled',null)"></input>
<input type="password" placeholder="Новый пароль" id="pwdrepeat" oninput="if(this.value!=''&this.previousSibling.previousSibling.value!='')document.getElementsByName('chpass')[0].removeAttribute('disabled');else document.getElementsByName('chpass')[0].setAttribute('disabled',null)"></input>
<input type="submit" name='chpass' value="Сменить пароль" disabled onclick="changepass('{$_SESSION['user_name']}',document.getElementById('pwd').value,document.getElementById('pwdrepeat').value);" />
<br>
</div>
A;
?>