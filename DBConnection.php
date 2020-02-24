<?php
    namespace GluMobile;

    class DBConnection extends \mysqli {
        private $host;
        private $userName;
        private $passWord;

        public $connection;

        function __construct () {
            // We can get the config values from .env file (staging & prod will use different config)
            $this->host = "127.0.0.1";
            $this->userName = "root";
            $this->passWord = "";
            $this->database = "development";

            // Create connection
            try {
                parent::__construct($this->host, $this->userName, $this->passWord, $this->database);
            } catch(Exception $e){
                echo "Exception::" . $e->getMessage();
            }
        }

    }
?>