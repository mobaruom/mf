<?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=test;charset=utf8", "root", ""); 

if (isset($_POST['pseudo']) AND isset($_POST['message']) AND !empty($_POST['message']))
{

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $message = htmlspecialchars($_POST['message']);
    $insertmsg = $bdd ->prepare('INSERT INTO chat(pseudo, message) VALUES(?, ?)');
    $insertmsg->execute(array($pseudo, $message));

}

?>
<html>
<head>
	<title>chat</title>
	<link rel="shortcut icon" href="https://d1r7943vfkqpts.cloudfront.net/ec2877ee-9ff2-4c55-90d8-bfbebd768704.png"/>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<center><h1>bienvenue au chat</h1></center>
	<center><form method="post" action="">
  <input type="text" name="pseudo" placeholder="PSEUDO" /><br><br>
  <input type="text" name="message" placeholder="MESSAGE"/>
  <input type="submit" value="envoyer!" />
</form>
<?php
$allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC');
while($msg = $allmsg->fetch())
{
  ?>
  <b><?php echo $msg['pseudo']; ?> : </b>
  <?php echo $msg['message']; ?><br/>
  <?php
}
?>
</center>
</body>
</html>