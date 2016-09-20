<html>
<body>
<style>
ul {

    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #989590;
}

li {
    float: left;
}

li a {
	font-size: 13;
    display: block;
    color: white;
    text-align: center;
    padding: 5px 5px;
    text-decoration: none;
}


a:hover
{
	background-color: black;
	color:white;
}

table {
	color:white;
}
td {
	color:white;
}


.container {
  margin: 50px auto;
  width: 640px;
}
 
.login {
  position: relative;
  margin: 0 auto;
  padding: 20px 20px 20px;
  width: 310px;
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
  background: #cde5ef;
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
  background: red;
  border-color: #93ed6e #b3c0c8 #b4ccce;
  -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
}




</style>
<body background="gitna.jpg">
    	<ul>
			<div id="menu" align="center">
				<li><a href="viewfaculty2.php">Viewing of Grades</a></li>
				<li><a href="chair2.php">Viewing of Top 10 Students</a></li>
				<li><a href="viewchair2.php">Viewing of Handled Faculty</a></li>
				<li><a href="dean2.php">Viewing of Top 15 Students</a></li>
				<li><a href="viewdean2.php">Viewing of Handled Chairperson</a></li>
				<li><a href="graph.php">Graph of Passed and Failed Students</a></li>
				<li><a href="audit.php">Audit</a></li>
				<li><a href="changepassvpaa.php">Change Password</a></li>
				<li><a href="sample.php">Log-Out</a></li>
			</div>
		</ul>
		<br><br>
		
		<form action="#" method="POST">
		<div class="container">
			<div class="login">
				<font color="white">Enter Old Passcode: <input type="password" name="pass"  placeholder="OLD PASSCODE"><br>
				<font color="white">Enter New Passcode: <input type="password" name="pass2" placeholder="NEW PASSCODE"><br>
				<font color="white">Confirm New Passcode: <input type="password" name="pass2" placeholder="CONFIRM NEW PASSCODE"><br>
				<p class="submit"><input type="submit" name="submit" value="SUBMIT"></p>
		
			</div>
		</div>
		</form>
		
<br><br><br><br><br><br><br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>
</body>
</html>