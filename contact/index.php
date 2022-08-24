<?php
$firstname=$name=$email=$phone=$message=$thanks=$firstnameError=$nameError=$emailError=$phoneError=$messageError="";
$validate=false;
$emailTo="Pierrelouis11@gmail.com";
if ($_SERVER["REQUEST_METHOD"]== "POST"){
  $firstname=verifyInput($_POST["prenom"]);
  $name=verifyInput($_POST["nom"]);
  $email=verifyInput($_POST["email"]);
  $phone=verifyInput($_POST["telephone"]);
  $message=verifyInput($_POST["message"]);
  $validate=true;
  $emailText="";
  
  
  if(empty($firstname)){
    $firstnameError= "Tu n'a pas renseigné ton prénom.";
    $validate=false;
  }
  else{
    $emailText.="Prenom : $firstname\n";
  }
  if(empty($name)){
    $nameError= "Tu n'a pas renseigné ton nom.";
    $validate=false;
  }
  else{
    $emailText.="Nom : $name\n";
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $emailError= "Ton Email n'est pas valide.";
    $validate=false;
  }
  else{
    $emailText.="Email : $email\n";
  }
  if(!preg_match("/^[0-9 ]*$/",$phone)) {
    $phoneError= "Ton numero de telephone n'est pas valide";
    $validate=false;
    } 
    else{
      $emailText.="Telephone : $phone\n";
    }
  if(empty($message)){
    $messageError= "Tu n'a pas ecrit de message.";
    $validate=false;
  }
  else{
    $emailText.="Message: $message\n";
  }
  
}

function verifyInput($var){
  $var=trim($var);
  $var=stripslashes($var);
  $var=htmlspecialchars($var);
  return $var;
}

if($validate==true){
  $thanks="Votre message m'a bien été envoyer, merci de m'avoir contacté.";
  $headers="From: $firstname $name <$email>\r\nReply-To:$email";
  mail($emailTo,"CONTACT SITE",$emailText,$headers);
  $firstname=$name=$email=$phone=$message="";
}

?>
<!DOCTYPE html>
<html>
  <head>
      <title>Contactez-moi !</title>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/contact/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  </head>
    
  <body class="container">
    <div class="divider"></div>
    <p></p>
    <div class="heading">
        <h1>contactez-moi</h1> 
    </div>
    <div id="main">
      <form id="contact" method="post" action=<?php echo htmlspecialchars( $_SERVER["PHP_SELF"]); ?> role="form" class="row g-3   ">
        <div class="col-md-6">
          <label for="prenom" class="form-label">Prénom <span class="red">*</span></label>
          <input type="text" name="prenom" id="prenom"  class="form-control" placeholder="Votre Prénom" value="<?php echo $firstname; ?>">
          <p class="erreur red"><?php echo $firstnameError; ?></p> 
        </div>
        <div class="col-md-6">
          <label for="nom" class="form-label">Nom <span class="red">*</span></label>
          <input type="text" class="form-control" id="nom"  name="nom" placeholder="Votre Nom" value="<?php echo $name; ?>" > 
          <p class="erreur red"><?php echo $nameError; ?></p>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email <span class="red">*</span></label>
          <input type="email" class="form-control" id="email"  name="email" placeholder="Votre Email" value="<?php echo $email; ?>">
          <p class="erreur red"><?php echo $emailError; ?></p>
        </div>
        <div class="col-md-6">
          <label for="telephone" class="form-label">Téléphone</label>
          <input type="tel" class="form-control" id="telephone"  name="telephone" placeholder="Votre Téléphone" value="<?php echo $phone; ?>"> 
          <p class="erreur red"><?php echo $phoneError; ?></p>
        </div>
        <div class="col-md-12">
          <label for="message" class="form-label">Message <span class="red">*</span></label>
          <div class="col-md-12">
            <textarea class="form-control" name="message"  placeholder="Votre Message" id="message" style="height: 100px"><?php echo $message; ?></textarea>
            <p class="erreur red"><?php echo $messageError; ?></p>
          </div>
        <p class=" red">*Ces informations sont requises.</p>
        <div class="col-12">
          <button type="submit" class="button">Envoyer</button>
        </div>
        <p class="thank-you"> <?php echo $thanks; ?> </p>
      </form>
    </div>
  </body>
</html>
