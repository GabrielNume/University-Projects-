<?php 

class DatabaseConnector{
    private static ?DatabaseConnector $instance = null;
    private $conn;

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "data_base";

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    }
        
    public static function getInstance(){
        if (!self::$instance)
            self::$instance = new DatabaseConnector();

        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }
}

// WHAT IT IS 
/**
 * Singleton este un model de design creational care 
 * va permite sa va asigurati ca o clasa are o singura instanta, 
 * oferind in acelasi timp un punct de acces global la aceasta instanta.
 * 
 * FOR MORE INFOR
 * https://refactoring.guru/design-patterns/singleton
 */

//  WHY WE NEED IT
/**
 * In cazul lucrului cu baze de date, noi ca developeri,
 * putem genera mai multe conexiuni la o baza de date (ACEASI BAZA DE DATE)
 * din cadrul aplicatiei curente.
 * 
 * Acest lucru produce urmatoarea problema:
 *      Wich connexion is the source of truth for our application?
 * 
 * Adica, avand 2 sau mai multe conexiuni recurente la aceasi baza de date
 * ne putem "impusca singuri in picior" prin faptul ca la un moment de timp
 * nu putem fi sigur care dintre cele 2 | N conexiuni are cele mai noi date din baza de date
 * 
 * EXAMPLE :
 *      Sa presupunem ca avem 2 conexiuni la o baza de date : conA & conB
 *      Daca permitem ambelor conexiuni sa realizeze operatii de citire & scriere in paralel
 *      ne inchipuim urmatorul scenariu.
 *      conA ruleaza pe Thread1 si conB ruleaza oe Thread2.
 *      Trimitem o operatie de citire la Thread1 si o operatie de scriere la Thread2.
 *      In functie de complexitatea operatilor (cat timp le va lua sa se execute) vom avea urmatoarele exemple
 * 
 *      A
 *          1) Thread2 va scrie cu succes in baza de date
 *          2) Thread1 va citi cu succes din baza de date (incluzand datele scrise de Thread2)
 * 
 *      B
 *          1) Thread1 va citi cu succes din baza de date (fara datele scrise de Thread2)
 *          2) Thread2 va scrie cu succes in baza de date
 *      
 *      C
 *          1) Thread1 va da eroare de citire
 *          2) Thread2 va scrie cu succes
 *      
 *      D
 *          1) Thread2 va da eroare la scriere
 *          2) Thread1 va citi cu succes
 * 
 *      E   
 *          Ambele Threaduri dau eroare
 * 
 *      Privind aceste exemple putem observa ca 
 *          Doar CAZUL A e singurul caz care are logica si executa operatile bine pentru a 
 *          putea obtine cele mai noi date din baza de date
 *          
 *          In Cazurile B C D se observa problema ca indiferent de  erroare / succes nu putem 
 *          fi siguri ca aplicatia noastra va contine cele mai noi date 
 * 
 *          In cazul E putem observa ca nu incurca cu nimmic din punct de vedere al datelor 
 *          si anume: In ambele cazuri nu se vor lua datele
 *          DAR acest caz incurca mesajele de eroare pe care noi le vom afisa, ceea ce va produce
 *          o situatie ambigua pentru utilizatori sau chiar pentru developeri
*/

// INFO
/**
 *      Aceasta clasa contine membri necesari pentru conectare la o baza de date
 *          1  INPUTS  :   Server, User, Password, Database
 *          2  OUTPUTS :   Conn (obiectul unde se va stoca conexiunea)
 *      
 *      Deci pana aici la fel ca in varianta simpla
 *          3 Singleton Members:   Instance (rolul lui in clasa asta e sa ne zica daca exista un obiect creat la un anumit moment)
 *          4 Metoda getConnection() ----- Aceasta metoda ne va intoarce conexiunea curenta la baza de date.
 *          5 Metoda getInstance() --- Aceasta metoda verifica daca avem o conexiune la baza de date
 *              In cazul in care nu avem vom genera o conexiune si intoarce obiectul de tipul DatabaseConnector
 *              In cazul in care avem se va intoarce direct obiectul DatabaseConnector
 *              Adica metoda asta aplica principiul SINGLETON in sensul in care:
 *                  Daca avem o conexiune o folosim
 *                  Daca nu avem ne generam una
 */

// HOW TO USE
/**
 * 1. Se va apela metoda statica getInstace  (apelul metodelor statice se face cu operatorul :: )
 *      Asta ne va intoarce un obiect DatabaseConnector (din clasa DatabaseConnector va intoarce $this->instance)
 *      Adica INSTANTA curenta
 *      
 * 2. Pentru a accesa conexiunea se va apela metoda getConnection()
 *      Asta ne va da CONEXIUNEA curenta
 *      CU CONEXIUNEA VOM IMPLEMENTA OPERATIILE DE CITIRE SCRIERE IN BAZA DE DATE
 *      
 * 3.  Ca la metoda simpla se verifica daca exista erori
 * 
 * 
 * 4.  WARNING : CLASA DATABASE CONNECTOR E DOAR IMPLEMENTAREA UNUI DESSIGN PATTERN
 *          PENTRU A LUCRA CU BAZA DE DATE SE FOLOSESTE CONEXIUNEA ;)
 * 
 *      Exemplu mai jos
 */


$singletonInstance = DatabaseConnector::getInstance();

$singletonConnection = $singletonInstance->getConnection();
if ($singletonConnection->connect_error) {
  die("Connection failed: " . $singletonConnection->connect_error);
}

