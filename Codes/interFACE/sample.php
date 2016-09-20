<html>
<title>PLM CRS</title>

<style>
body { 
	   
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: left; 
	overflow:hidden;

}

.container {
  margin: 50% auto;
  width: 640%;
}
 
.login {
  position: relative;
  margin: 0 auto;
  padding: 3% 10% 3%;
  width: 280;
}

.login p.submit{
  text-align: center;
}
 
:-moz-placeholder {
  color: #c9c9c9 !important;
  font-size: 13px;
}
 
::-webkit-input-placeholder {
  color: #ccc;
  font-size: 13px;
}

.container {
  margin: 50px auto;
  width: 640px;
}
.login:before {
  content: '';
  position: absolute;
  top: -8px;
  right: -8px;
  bottom: -8px;
  left: -8px;
  z-index: -1;
  background: rgba(0, 0, 0, 0.08);
  border-radius: 4px;
}
 
.login p {
  margin: 20px 0 0;
}
 
.login p:first-child {
  margin-top: 0;
}
 
.login input[type=text], .login input[type=password] {
  width: 278px;
}
 
input {
  font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif;
  font-size: 14px;
}
 
input[type=text], input[type=password] {
  margin: 5px;
  padding: 0 10px;
  width: 200px;
  height: 34px;
  color: #404040;
  background: white;
  border: 1px solid;
  border-color: #c4c4c4 #d1d1d1 #d4d4d4;
  border-radius: 2px;
  outline: 5px solid #eff4f7;
  -moz-outline-radius: 3px;
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
}
 
input[type=password]:focus {
  border-color: ;
  outline-color: ;
  outline-offset: 0;
}
 
input[type=submit] {
  padding: 0 18px;
  height: 29px;
  font-size: 12px;
  font-weight: bold;
  color: black;
  text-shadow: 0 1px #e3f1f1;
  background: gray;
  border: 1px solid;
  border-color: maroon maroon maroon;
  border-radius: 16px;
  outline: 0;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  background-image: -webkit-linear-gradient(top, #edf5f8, #cde5ef);
  background-image: -moz-linear-gradient(top, #edf5f8, #cde5ef);
  background-image: -o-linear-gradient(top, #edf5f8, #cde5ef);
  background-image: linear-gradient(to bottom, #edf5f8, #cde5ef);
  -webkit-box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
  box-shadow: inset 0 1px #93ed6e, 0 1px 2px rgba(0, 0, 0, 0.15);
}

input[type=submit]:active {
  background: gray;
  border-color: gray gray gray;
  -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
}

#background{
	width: 100%;
	length: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: -15;
	
}

</style>
<body>

	<form action="students.php" method="POST">
		
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<center><h3 style="font-family:verdana;">COMPUTERIZED REGISTRATION SYSTEM</h3></center>
<div class="container">
<img id="background" src="backgroundplm.jpg">
  <div class="login">
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USER LEVEL:</b> <select name="userlvl">
				<option value="STUDENT">STUDENT</option>
				<option value="FACULTY">FACULTY</option>
				<option value="DEAN">DEAN</option>
				<option value="CHAIRPERSON">CHAIRPERSON</option>
				<option value="VPAA">VPAA</option>
				<option value="ADMIN">ADMIN</option>
			</select><br>

<input type="text" name="user" required="required" placeholder="USERNAME"><br>
<input type="password" name="pass" required="required" placeholder="PASSCODE"><br>
<p class="submit"><input type="submit" name="submit" value="SUBMIT"></p>
	</form>
	</div>
<br><br><center>The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</center>
</div>	



</body>
</html>
