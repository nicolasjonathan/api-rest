<?php

// Controlêur général. Se charge de dispatcher les differentes actions à effectuer en fonction de l'url et des requêtes reçues.
class Controller
{
    public $db;
    public $table;

    // Set la connexion à la database
    public function getDb()
    {
        if (!$this->db){ 
            $this->db = new Database();
        }
        return $this->db;
    }

    /** 
     * Methode qui va recevoir les requêtes et dispatcher le traitement à effectuer 
     * à une seconde méthode en fonction du type de la requête.
     * @param string $method = type de la requête (POST, GET, PUT, etc, ...)
     * @param $secondParam = correspond à l'action à effectuer, selon si le client demande une string, un id, etc
     **/
    public function manageRequest(string $method, $secondParam = null, $thirdParam = null): void 
    { 
        // si il y'a un troisième parametre dans notre url et qu'il NI null NI vide ...
        if ($thirdParam !== null && !empty($thirdParam)) {
            // on instancie sa class(1erparam = $controller), 
            $objToCall = get_class($this);
            $obj = new $objToCall();
            // on call la méthode appelée en parametre dans l'url apres avoir vérifié qu'elle existe vraiment(2emeparam), 
            if (method_exists(get_class($this), $thirdParam)) {
                // et on lui met un parametre (3emeParam)
                echo json_encode(call_user_func_array([$obj, $thirdParam], [$secondParam]));
            } else {
                throw new Exception ('Les ressources demandées n\'ont pas été trouvé.');
            }
        // si il y'a un deuxieme parametre dans l'uri (= second param) : 
        } elseif ($secondParam !== null && $thirdParam === null) {
            $fetchSingleEntity = $this->getOne($secondParam);
            echo json_encode($fetchSingleEntity, true);

        // s'il y'en a pas du tout on traite l'action à effectuer :
        } elseif ($secondParam === null && $thirdParam === null) {
            $this->manageRequestMethod($method);
        }
            
    }

    /** 
     * Traitement à effectuer selon le type de requête envoyée. 
     * Fonction qui mérite d'être factorisé --> beaucoup de redondance...
     */
    public function manageRequestMethod(string $method) : void
    {
        switch ($method) {
            
            case 'GET' :
                // On retourne code 200.
                $get = json_encode($this->getAll(), JSON_UNESCAPED_UNICODE);
                if ($get) {
                    echo $get;
                    http_response_code(200);
                }
                break;

            case 'POST' :
                $post = (array) json_decode(file_get_contents("php://input"), true);
                $req = $this->create($post);
                if ($req) {
                    http_response_code(201);
                    // On retourne un message à l'utilisateur que tout s'est bien déroulé.
                    echo json_encode([
                            'message' => 'Ajout de ' . $this->table .  ' correctement effectué.',
                            "{$this->table}" => $this->getById($this->db->lastInsertId())],
                        JSON_UNESCAPED_UNICODE);
                }
                break;

            case 'PUT':
                $update = (array) json_decode(file_get_contents("php://input"), true);
                $req = $this->update($update);
                if ($req) {
                    http_response_code(200);
                    // On retourne un message indiquant à l'utilisateur que tout s'est bien déroulé.
                    echo json_encode(
                        [
                            'message' => ucfirst($this->table) . ' correctement mis à jour.',
                            "{$this->table}" => $this->getById($update[1]["id"])
                        ],
                        JSON_UNESCAPED_UNICODE);
                }
                break;

            case 'DELETE':
                $delete = json_decode(file_get_contents("php://input"), true);
                $req = is_int($delete) ? $this->delete($delete) : null;
                if ($req) {
                    http_response_code(202);
                    // On retourne un message indiquant à l'utilisateur que tout s'est bien déroulé.
                    echo json_encode(
                        [
                            'message' => "Suppression de {$this->table} correctement effectuée.",
                            "{$this->table}" => $this->getById($delete)
                        ]
                    );
                }
                break;
        }
    }

    /**
     * getById ()
     * chercher une entrée de la db à partir de son id.
     */
    public function getById(int $id)
    {
        // check if table is set
        if (!$this->table) {
            return false;
        }
        $sql = "SELECT * FROM `{$this->table}` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $req = $stmt->fetch(PDO::FETCH_ASSOC);

        return $req;
    }

    /**
     * getAll()
     * Renvoie tous les magasins ou categories de magasins de la base de donnée.
     */
    public function getAll()
    {
        $sql = 'SELECT * FROM `'.$this->table.'`';
        $stmt = $this->db->query($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * getOne()
     * Renvoie Un.e seul.e magasin ou catégorie.
     */
    public function getOne($optionalParam)
    {
        $sql = 'SELECT * from '. $this->table .' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $optionalParam, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    /** create ()  
     * to push une nouvelle entrée into une table, through une classe enfant désolé pour le franglais
     * @param array $attributes = data to send par exemple : ['user_title' => 'Mr Foo', 'user_password' => 'azerty']
     */
    public function create(array $attributes)
    {
        if (!$this->table) {
            return false;
        }

        // init 
        $key = [];
        $bind = [];
        $value = [];
        $bindValue = [];

        // Let's separates key from values in differents arrays and bind params to execute
        foreach ($attributes as $keys => $values) {            
            // table's columns
            $key[] = $keys;
            // values of columns
            $value[] = $values;
            // Bind param
            $bind[] = ":{$keys}";
            $bindValue[":{$keys}"] = $values;
        }
        
        // serialize arrays
        $keyArray = implode (", " , $key);
        $bindArray = implode (", " , $bind); 
        $valueArray = implode (", " , $value);
            
        // prepared statement
        $sql = ("INSERT INTO `{$this->table}` ({$keyArray}) VALUES ({$bindArray})");
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($bindValue);
            
    }

    /**
     * update ()
     * update une entrée d'une db table à partir de son id.
     * @param int $id = id de l'entrée à updater.
     * $Magasins->update(['nom' => 'carrefour market'], [':id' => 8]);
     */
    public function update(array $data)
    {
        if (!$this->table) {
            return false;
        }
        if (count($data) != 2) {
            return false;
        }
        $attributes = $data[0];
        $id = $data[1]["id"];
        
        // init 
        $statement = [];
        $bindValue = [];
        // Let's separates key from values in differents arrays and bind params to execute
        foreach ($attributes as $keys => $values) {            
            // statement
            $statement[] = "{$keys} = :{$keys}";
            $bindValue[":{$keys}"] = $values;
        }
        // serialize arrays
        $statementArray = implode (", " , $statement);
        // prepared statement
        $sql = "UPDATE `{$this->table}` SET {$statementArray} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        foreach($bindValue as $k => $v) {
            $stmt->bindValue($k, $v, is_string($v) ? PDO::PARAM_STR : PDO::PARAM_INT);
        }
        return $stmt->execute();

    }

    /**
     * delete ()
     * pour supprimer une entrée de la database à partir de l'id.
     * @param int $id = id de l'entrée à supprimer.
     */
    public function delete(int $id)
    {
        if (!$this->table) {
            return false;
        }
        
        $sql = "DELETE FROM `{$this->table}` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $req = $stmt->execute();
        return $req;
    }

    /**
     * find()
     * pour chercher une instance avec attributs
     * Example :
     * $this->table = `user`
     * ['user_id' => 3] 
     * will return :  SELECT * FROM `tableX` WHERE user_id = 3
     */
    public function find (array $attributes, string $select = '*')
    {
        // check si table est set
        if (!$this->table) {
            return false;
        }
        // init 
        $whereArray = []; 
        $bindValueArray = [];
        // Let's separates key from values in differents tableaux et bind les parametres à executer
        foreach ($attributes as $keys => $values) {
            // where
            $whereArray[] = "{$keys} = :{$keys}";
            // exec
            $bindValueArray[":{$keys}"] = $values;
        } 
        $where = count($attributes) > 0 ? implode(" AND ", $whereArray) : $attributes[0];
        
        // the statement
        $sql = "SELECT {$select} FROM `{$this->table}` WHERE {$where}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindValueArray);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByName(int $id): string
    {
        $sql = "SELECT nom FROM `{$this->table}` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $req = $stmt->fetch(PDO::FETCH_ASSOC);
        return $req;
    }    
}