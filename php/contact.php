<?php
$array=array("firstname"=>"",
            "email"=>"",
            "phone"=>"",
            "message"=>"",
            "thanks"=>"",
            "firstnameError"=>"",
            "nameError"=>"",
            "emailError"=>"",
            "phoneError"=>"",
            "messageError"=>"",
            "validate"=>false,);

$emailTo="Pierrelouis11@gmail.com";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $array["firstname"]=verifyInput($_POST["prenom"]);
  $array["name"]=verifyInput($_POST["nom"]);
  $array["email"]=verifyInput($_POST["email"]);
  $array["phone"]=verifyInput($_POST["telephone"]);
  $array["message"]=verifyInput($_POST["message"]);
  $array["validate"]=true;
  $emailText="";
  
  
  if(empty($array["firstname"])){
    $array["firstnameError"]= "Tu n'a pas renseigné ton prénom.";
    $array["validate"]=false;
  }
  else{
    $emailText.="Prenom : {$array["firstname"]}\n";
  }
  if(empty($array["name"])){
    $array["nameError"]= "Tu n'a pas renseigné ton nom.";
    $array["validate"]=false;
  }
  else{
    $emailText.="Nom : {$array["name"]}\n";
  }
  if(!filter_var($array["email"],FILTER_VALIDATE_EMAIL)){
    $array["emailError"]= "Ton Email n'est pas valide.";
    $array["validate"]=false;
  }
  else{
    $emailText.="Email : {$array["email"]}\n";
  }
  if(!preg_match("/^[0-9 ]*$/",$array["phone"])) {
    $array["phoneError"]= "Ton numero de telephone n'est pas valide";
    $array["validate"]=false;
    } 
    else{
      $emailText.="Telephone : {$array["phone"]}\n";
    }
  if(empty($array["message"])){
    $array["messageError"]= "Tu n'a pas ecrit de message.";
    $array["validate"]=false;
  }
  else{
    $emailText.="Message: {$array["message"]} \n";
  }
  
}

function verifyInput($var){
  $var=trim($var);
  $var=stripslashes($var);
  $var=htmlspecialchars($var);
  return $var;
}

if($array["validate"]==true){
  $headers="From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To:{$array["email"]}";
  mail($emailTo,"CONTACT SITE",$emailText,$headers);
}
echo json_encode($array)

?>