<?php 
session_start();
class Userpdo
{
    private $id;
    public $login;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $bdd;

   
   public function __construct($login,$email,$password,$firstname,$lastname)
    {
        
        
        try {
                $this->bdd= new PDO(
            "mysql:host=localhost;dbname=classes",
            "root",
            "");
            echo 'connecté';
        } catch (PDOException $e) {
            die('Erreur : '.$e->getMessage());
            echo 'pas connecté';
        }

        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->$lastname = $lastname;
    }


    // Méthode register pour s'enregistrer dans la base de donnée. 
   public function register($login,$password,$email,$firstname,$lastname)
    {
         
        // si la connexion à la base de donnée est établie alors :

        $register = $this->bdd->prepare("INSERT INTO `utilisateurs`( `login`, `password`, `email`, `firstname`, `lastname`) VALUES (:login, :password, :email, :firstname, :lastname)");
        $array = [':login'=>$login,':password'=>$password, ':email'=>$email,':firstname'=>$firstname,':lastname'=>$lastname];
        $register->execute($array);
         
         
          
    }
  
   
 // Méthode connect pour se connecter  au site via la base de donnée.
    public function connect($login,$password)
    {
       
        // si la connexion à la base de donnée est établie alors :
        
       
        $connect = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login=:login");
       
        $connect->execute([':login'=>$login]);
        $user = $connect->fetch();
        
        $_SESSION['id']= $user['id'];
        
        
    } 
  

    // Méthode disconnect pour se déconnecter du site.
    public function disconnect()
    {
        session_destroy();
  
    } 
  
  
    // Méthode disconnect pour se déconnecter du site.
    public function delete($login)
    {
            
            $delete = $this->bdd->prepare("DELETE FROM utilisateurs WHERE login=:login");
            $delete->execute([':login'=>$login]);
            $delete->fetch();
            
              session_destroy();
         
    } 
  
    // Méthode modifier les informations de la base de donnée.
    public function update($login,$password,$email,$firstname,$lastname)
    {
       

        $update =$this->bdd->prepare("UPDATE `utilisateurs` 
            SET `login`=:login,`password`=:password,`email`=:email,`firstname`=:firstname,`lastname`=:lastname, 
            WHERE login='$login'");
            $array = [':login'=>$login,':password'=>$password, ':email'=>$email,':firstname'=>$firstname,':lastname'=>$lastname,];
        $update->execute($array);
        $update->fetch();
  
    } 
  
  
    //  Methode pour savoir si je suis connecter 
    public function isConnected()
    {
        if (isset($_SESSION['id'])) {
  
          return true;
  
        }else {
             return false;
        }
    }
  
  
    // methode pour afficher tout les infos 
    public function getAllInfos()
    {
      $id = $_SESSION['id'];
      $getinfos= $this->bdd->prepare("SELECT * FROM utilisateurs WHERE id='$id'");
      $getinfos->execute();
       $infos = $getinfos->fetch();
          
       return $infos;
    }


   // methode pour afficher tout les infos 
    public function getLogin()
    {
        $id = $_SESSION['id'];
        $getlogin= $this->bdd->prepare("SELECT 'login' FROM utilisateurs WHERE id='$id'");
        $getlogin->execute();
        $log= $getlogin->fetch();
         
        return $log['login'];
    }
   
  
    // methode pour afficher tout les infos 
    public function getEmail()
    {
        $id = $_SESSION['id'];
        $getmail= $this->bdd->prepare("SELECT 'email' FROM utilisateurs WHERE id='$id'");
        $getmail->execute();
        $mail= $getmail->fetch();
        
        return $mail['email'];
      
    }
  
  
    public function getFirstname()
    {
        $id = $_SESSION['id'];
        $getfirst= $this->bdd->prepare("SELECT 'email' FROM utilisateurs WHERE id='$id'");
        $getfirst->execute();
        $first= $getfirst->fetch();
        
        return $first['firstname'];
        
    }
  
  
    public function getLastname()
    {
        $id = $_SESSION['id'];
        $getlast= $this->bdd->prepare("SELECT 'lastname' FROM utilisateurs WHERE id='$id'");
        $getlast->execute();
        $last= $getfirst->fetch();
        
        return $last['lastname'];
       
    }
}

$user = new Userpdo('','', '', '', '', '');
$user->connect('a','a');
?>

