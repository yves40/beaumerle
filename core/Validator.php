<?php
    namespace app\core;;
    
    use app\core\Logger;


    abstract class Validator
    {
        protected const RULE_EMAIL = 'Email incorrect';
        protected const RULE_NOTEMPTY = 'Ce champ doit être renseigné';
        protected const RULE_ALLNOTEMPTY = 'Tous les champs doivent être renseignés';
        protected const RULE_MATCH = 'Le contenu de ce champ doit être identique à {field}';
        protected const RULE_MAX = "Ce champ ne doit pas dépasser {nbcar} caractères";
        protected const RULE_MIN = "Ce champ doit contenir au moins {nbcar} caractères";
        protected const RULE_FILESIZE = "Fichier trop volumineux. La limite est de {tmax} Mo";
        protected const RULE_FILETYPE = "Format autorisés : jpg, jpeg et png";

        private $logger;

        private $errors = [];
        private $values = [];       // Used to remember previously entered values

        public function __construct($theClass)
        {
            $this->logger = new Logger($theClass);
        }
        
        public function check(array $fieldsAndRules)
        {
            if(!empty($fieldsAndRules))
            {
                foreach($fieldsAndRules as $key=>$checkEntry)
                {
                    foreach($checkEntry["rules"] as $rule)
                    {
                        if(is_array($rule))
                        {
                            $compositRule = $rule;
                            $rule = $compositRule["rule"];
                        }
                        if($rule === self::RULE_EMAIL && !filter_var($checkEntry["value"], FILTER_VALIDATE_EMAIL))
                        {
                            $this->addError($key, $rule);
                        }
                        if($rule === self::RULE_NOTEMPTY && !$checkEntry["value"])
                        {
                            $this->addError($key, $rule);
                        }
                        //&& ($fieldsAndRules["pass"]["value"] !== $fieldsAndRules["confirm-pass"]["value"]) pas générique
                        if($rule === self::RULE_MATCH)
                        {
                            $fieldName = $compositRule["match"];
                            $message = str_replace('{field}', $checkEntry['label'] ?? $fieldName, $rule);
                            $ref = $fieldsAndRules[$fieldName]["value"];
                            if($checkEntry['value'] !== $ref)
                            {
                                $this->addError($key, $message);
                            }                            
                        }
                        if($rule === self::RULE_MIN)
                        {
                            $limit = $compositRule["length"];
                            $length = strlen($checkEntry["value"]);
                            $message = str_replace('{nbcar}', $limit, $rule);
                            if($length < $limit)
                            {
                                $this->addError($key, $message);
                            }                            
                        }
                        if($rule === self::RULE_MAX)
                        {
                            $limit = $compositRule["length"];
                            $length = strlen($checkEntry["value"]);
                            $message = str_replace('{nbcar}', $limit, $rule);
                            if($length > $limit)
                            {
                                $this->addError($key, $message);
                            }                            
                        }
                        // ----------------------------------- Check upload rules -------------------------
                        $uploaddberror = false;
                        if($rule === self::RULE_FILETYPE)
                        {
                            if(!empty($_FILES))
                            {

                                $target_dir = "/images/profile_pictures";
                                $target_file = $target_dir .'\/'.$_FILES["profilepicture"]["name"];
                                $allowed = [
                                    "jpg" => "image/jpeg",
                                    "jpeg" => "image/jpeg",
                                    "png" => "image/png"
                                ];
                                $filename = $_FILES["profilepicture"]["name"];
                                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                                if(!isset($allowed[$extension]))
                                {
                                    $this->addError($key, $rule);
                                    $uploaddberror = true;
                                }
                            }                             
                        }
                        if($rule === self::RULE_FILESIZE)
                        {
                            $limit = $compositRule["tmax"];
                            $filesize = $_FILES["profilepicture"]["size"];
                            $message = str_replace('{tmax}', $limit, $rule);
                            $this->logger->console('Check max size is under '.$limit.' MO');
                            if($limit  * 1024 * 1024 < $filesize ) {
                                $this->addError($key, $message);
                                $uploaddberror = true;
                            }
                        }
                    }
                    if(!$uploaddberror) { $this->values[$key] = $checkEntry["value"]; } // Do not update filename value if an upload error occurred
                    
                }
            }
            return $this->errors;
        }
        
        // -------------------------------------------------------------------
        public function addError($attribute, $message)
        {
            $this->errors[$attribute][] = $message;
            $this->logger->console("Adding [$attribute] error message [$message]");
            return;
        }  

        // -------------------------------------------------------------------
        public function getFirstError($attribute)
        {
            if(!empty($this->errors)) {
                if(isset($this->errors["$attribute"][0]))
                {
                    return '<p class="myerror">'.$this->errors["$attribute"][0].'</p>';
                }
            }
            return '<p class="hidden"></p>';
        }
        // -------------------------------------------------------------------
        public function addValue($attribute, $val) 
        {
            $this->values["$attribute"] = $val;
            return;
        }
        // -------------------------------------------------------------------
        public function replaceValue($attribute, $val) 
        {
            if(isset($this->values["$attribute"])) {
                unset($this->values["$attribute"]);
                $this->values["$attribute"] = $val;
            }
            return;
        }
        // -------------------------------------------------------------------
        public function getValue($attribute) 
        {
            if(isset($this->values["$attribute"])) {
                return $this->values["$attribute"];
            }
            return '';
        }
        // -------------------------------------------------------------------
        public function hasError()
        {
            return !empty($this->errors);
        }

        // -------------------------------------------------------------------
        public function getAllErrors()
        {
            return $this->errors;
        }

    }
?>