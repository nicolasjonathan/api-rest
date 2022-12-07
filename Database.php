<?php

// classe permettant la connexion à la base de donnée.

class Database extends PDO
{  
    /**  @var string database id connexion */
    /** à modifier en fonction de vos identifiants serveur / hebergeur */
    private $dbHost = 'localhost';    
    private $dbUser = 'root';     
    private $dbName = 'apirest';
    private $dbPassword = 'root'; 
    private $dbPort = 8889; 

    /**  @var $pdo hold la connexion */
    public $pdo;

    /**  @var string hold le nom de la table */
    protected $table;

    /**  Constructor methode */ 
    public function __construct ()
    {
        // DSN de connexion
        $dsn = "mysql:dbname={$this->dbName};host={$this->dbHost}";

        // parent construct
        parent::__construct($dsn, $this->dbUser, $this->dbPassword);

        $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $this->setConnexion();
    }

    /**
     * setConnexion () 
     * instancie une PDO classe et la stocke dans la varable $pdo.
     */
    public function setConnexion ()
    {     
        // DSN de connexion
        $dsn = "mysql:dbname={$this->dbName};host={$this->dbHost}";

        $this->pdo = new PDO ($dsn, $this->dbUser, $this->dbPassword); 
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }


}

