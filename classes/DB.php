<?php
    class DB {
        private static $_instance = null;
        private $_pdo,
                $_query,
                $_error = false,
                $_results,
                $_count = 0;

        private function __construct(){
            try {
                // This is the Connection String - Basically using PDO (PHP Database Objects)
                $this->_pdo = new PDO('mysql:host=' .  Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
                //$this->_pdo = new PDO('mysql:host=127.0.0.1;dbname=lr','root', 'Madison1'); // This Works
                //echo Config::get('mysql/host');
                //echo Config::get('mysql/db');
                //echo Config::get('mysql/username');
                //echo Config::get('mysql/password');                
                //echo 'mysql:host=' .  Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db');
                //echo 'Connected';
            } catch (PDOException $e) {
                die($e->getMessage());
                
            }
        }

        public static function getInstance() {
          if(!isset(self::$_instance)) {
            self::$_instance = new DB();
          }
          return self::$_instance;
        }
        
        public function query($sql, $params = array()) {
            $this->_error = false; // resets the error back to false
            if($this->_query = $this->_pdo->prepare($sql)){
                $x=1;
                //echo 'Success';
                if(count($params)) {
                    foreach($params as $param) {
                        $this->_query->bindValue($x, $param); //each param in query
                        $x++; //increment X for the position
                    }
                }
                
                if($this->_query->execute()){
                    //echo 'Success';
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                }
                else {
                    $this->_error = true;
                }
            }
            return $this;
        }
        
        // Not Required but makes life easier
        // Update, Alter
        private function action($action, $table, $where = array()){
            if(count($where) === 3){ // ensures there are 3 elements from the where passed in, "field", "operator like =' and a "value"
                $operators = array('=', '<', '>', '>=', '<=');
                $field      =$where[0];
                $operator   =$where[1];
                $value      =$where[2];
                
                if(in_array($operator, $operators)){
                    //$sql ="SELECT * FROM users WHERE username = 'Alex'";
                    $sql ="{$action} * FROM {$table} WHERE {$field} {$operator}  ?";  //? instead of {$value} because we will bind that on later
                    if(!$this->query($sql, array($value))->error()) {
                        return $this;
                    }
                }
                
            }
            return false;
        }
        // select
        public function get($table, $where){
            
        }
        public function delete($table, $where){
            
        }
        public function error() {
            return $this->_error;
        }
    }
?>
