<?php
class Compte implements JsonSerializable{
    private $login;
    private $password;
    private static int $count = 0;

    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
        self::$count++;
    }

    public function getLogin(){
        return $this->login;
    } 

    public function getPassword(){
        return $this->password;
    } 

    public function setLogin($login){
        $this->login = $login;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function masquerLogin(){
        $taille = strlen($this->login);
        $v = substr($this->login, 0 ,2). '***' . substr($this->login, -1); 
        return $v;
    }
    

    public function toArray(){
        return ['login' => $this->login, "password" =>  $this->password];
    }

    public function __toString(){
        return "Compte(login={$this->login})";
    }

    public function checkPassword($plain){
        return $this->password === $plain;
    }

    public function changePassword($new) {
        $this->password = $new;
    }

    public static function isValidLogin(string $login): bool {
        return preg_match('/^[a-zA-Z0-9._-]{3,20}$/', $login) === 1;
    }
    

    public static function isStrongPassword(string $pwd): bool {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $pwd) === 1;
    }
    
    public function changePasswordBonus($new) {
        if (self::isStrongPassword($new)) {
            $this->password = $new;
            return true;
        }
        return false;      
    }

    // ?? '' : si la clé n’existe pas on peu mettre une valeur vide par-défaut pour éviter une erreur.
    public static function fromArray(array $row): Compte {
        $login = $row['login'] ?? '';
        $password = $row['password'] ?? '';
    
        if (!self::isValidLogin($login) || !self::isStrongPassword($password)) {
            return null;
        }
    
        return new Compte($login, $password);
    }

    public static function count(): int{
        return self::$count;
    }
    
    public static function resetCounter(): void {
        self::$count = 0;
    }

    public static function cmpByLoginLen(Compte $a, Compte $b): int {
        return strlen($a->getLogin()) <=> strlen($b->getLogin());
    }

    // mixed c'est pour retourner n'importe quel type.
    public function jsonSerialize(): mixed{
        return ['login' => $this->login, 'password' => '*****'];
    }
    
}


$compte = new Compte("ethane", "jdprefg45");
echo $compte->getLogin()."\n";
echo $compte->getPassword()."\n";
echo $compte->masquerLogin()."\n";
$compte->setLogin("le-rat");
$compte->setPassword("gtikdf45");
echo $compte->getLogin()."\n";
echo $compte->getPassword()."\n";
echo $compte->masquerLogin()."\n";
var_dump($compte->checkPassword("le-rat")); 
var_dump($compte->checkPassword("gtikdf45")); 
print_r($compte->toArray());
print_r($compte->__toString());
$compte->changePassword("newpassword");
echo $compte->getPassword(); 
var_dump(Compte::isValidLogin("le-rat"));
var_dump(Compte::isValidLogin("ethan"));
var_dump(Compte::isValidLogin("a"));
var_dump(Compte::isValidLogin("ethane!!"));
var_dump(Compte::isStrongPassword("Abcdef12"));
var_dump(Compte::isStrongPassword("abcdef12"));   
var_dump(Compte::isStrongPassword("ABCDEFGH1"));  
var_dump(Compte::isStrongPassword("Abcdefgh"));   
var_dump(Compte::isStrongPassword("Ab1"));
$donne = ['login' => 'fatoumata', 'password' => 'lffkvkfrfK18'];
$compte2 = Compte::fromArray($donne);
echo $compte2->getLogin()."\n";
echo $compte2->getPassword()."\n";
echo "Instances créés: ".Compte::count()."\n";
$comptes = [$compte, $compte2];
usort($comptes, ['Compte', 'cmpByLoginLen']);
foreach ($comptes as $c) {
    echo $c->getLogin()." (".strlen($c->getLogin()).")\n";
}
$comp1 = new Compte("ethane", "fkdflssMGFD32");
$comp2 = Compte::fromArray(['login' => 'fatoumata', 'password' => 'hsSYZse78']);
echo "JSON comp1:\n";
echo json_encode($comp1, JSON_PRETTY_PRINT) . "\n";
echo "JSON comp2:\n";
echo json_encode($comp2, JSON_PRETTY_PRINT) . "\n";
echo "Instances créés: " . Compte::count() . "\n"; 
echo $comp1->masquerLogin() . "\n";
echo $comp2->__toString() . "\n";
?>

