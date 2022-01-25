<?php 
class User{

    private $id;
    public $login;
    public $email;
    public $password;
    public $firstname;
    public $lastname;


    public function __construct($login,$email,$password,$firstname,$lastname)

    {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->$lastname = $lastname;
    }


    // Méthode register pour s'enregistrer dans la base de donnée. 
    public function register($login,$password,$email,$firstname,$lastname)
   {
        //  connexion à la base de donnée 
        $bdd = mysqli_connect('localhost','root','','classes');
        $req = mysqli_query($bdd,"INSERT INTO utilisateurs ( `login`,`password`,`email`,`firstname`,`lastname`) 
        VALUES ('$login','$password','$email','$firstname','$lastname')");

    
    }

 
    // Méthode connect pour se connecter  au site via la base de donnée.
    public function connect($login,$password)
    {
        $bdd = mysqli_connect('localhost','root','','classes');
        $reqconnexion = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login'");
        $resconnexion = mysqli_fetch_all($reqconnexion,MYSQLI_ASSOC);
        
    } 


    // Méthode disconnect pour se déconnecter du site.
    public function disconnect()
    {
            session_unset();

    } 


    // Méthode disconnect pour se déconnecter du site.
    public function delete()
     {
        
            $bdd = mysqli_connect('localhost','root','','classes');
            mysqli_query($bdd,"DELETE FROM utilisateurs");
            session_destroy();
       

    } 


    // Méthode modifier les informations de la base de donnée.
    public function update($login,$password,$email,$firstname,$lastname)
    {
        
            
        $user = $_SESSION['username'];
            
        $bdd = mysqli_connect('localhost','root','','classes');
        $reqprofil =  mysqli_query($bdd,"UPDATE `utilisateurs` 
        SET `login`='$login',`password`='$password'`email`='$email',`firstname`='$firstname',`lastname`='$lastname', 
        WHERE login='$user'");
        $resprofil= mysqli_fetch_all($reqprofil,MYSQLI_ASSOC);

    } 


    //  Methode pour savoir si je suis connecter 
    public function isConnected()
    {
        if (isset($_SESSION['login'])) {

           return true;

        }else {
            return false;
        }
    }


    // methode pour afficher tout les infos 
    public function getAllInfos()
    {
        $id = $_SESSION['id'];
        $bdd = mysqli_connect('localhost','root','','classes');
        $reqinfo = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE id='$id'");
        $resinfo= mysqli_fetch_all($reqinfo,MYSQLI_ASSOC);
        
        return $resinfo;
    }


    // methode pour afficher tout les infos 
    public function getLogin()
    {
        $id = $_SESSION['id'];
        $bdd = mysqli_connect('localhost','root','','classes');
        $reqinfo = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE id='$id'");
        $resinfo= mysqli_fetch_all($reqinfo,MYSQLI_ASSOC);
        
        return $resinfo[0]['login'];
    }
 

    // methode pour afficher tout les infos 
    public function getEmail()
    {
        $id = $_SESSION['id'];
        $bdd = mysqli_connect('localhost','root','','classes');
        $reqinfo = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE id='$id'");
        $resinfo= mysqli_fetch_all($reqinfo,MYSQLI_ASSOC);
        
        return $resinfo[0]['email'];
    }


    public function getFirstname()
    {
        $id = $_SESSION['id'];
        $bdd = mysqli_connect('localhost','root','','classes');
        $reqinfo = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE id='$id'");
        $resinfo= mysqli_fetch_all($reqinfo,MYSQLI_ASSOC);
        
        return $resinfo[0]['firstname'];
    }


    public function getLastname()
    {
        $id = $_SESSION['id'];
        $bdd = mysqli_connect('localhost','root','','classes');
        $reqinfo = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE id='$id'");
        $resinfo= mysqli_fetch_all($reqinfo,MYSQLI_ASSOC);
        
        return $resinfo[0]['lastname'];
    }
 } 

 
    $user = new User('', '', '', '', '');

 ?>
    

