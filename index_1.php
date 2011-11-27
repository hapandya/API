<?php 
$json_string = file_get_contents('http://api.groupon.com/v2/deals?client_id=73dcf33e6c9f2a54daf01a97ab6e1cb0b137d15f');
//echo $json_string2 = htmlspecialchars($json_string);
$json_obj = json_decode($json_string,TRUE);
print_r($json_obj);
//foreach ($groupontype as $grouponjson){
//	print $json_obj['type'];
//}

print_r($json_obj);
//echo $json_string;
?>
<html>
<body>
<h2>JSON Object Creation in JavaScript</h2>
<p>
Name: <span id="jname"></span><br /> 
Age: <span id="jage"></span><br /> 
Address: <span id="jstreet"></span><br /> 
Phone: <span id="jphone"></span><br /> 
</p>
<P>
Click Here For Groupon Deal in JSON <a href="http://api.groupon.com/v2/channels/73dcf33e6c9f2a54daf01a97ab6e1cb0b137d15f/deals">Click Here</a>
</P>

<script type="text/javascript">
var JSONObject= {
"name":"John Johnson",
"street":"Oslo West 555", 
"age":33,
"phone":"555 1234567"};
document.getElementById("jname").innerHTML=JSONObject.name 
document.getElementById("jage").innerHTML=JSONObject.age 
document.getElementById("jstreet").innerHTML=JSONObject.street 
document.getElementById("jphone").innerHTML=JSONObject.phone 
</script>

</body>
</html>