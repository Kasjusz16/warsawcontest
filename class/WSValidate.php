<?php


    class WSValidate
    {
        private $error;
        public $countError;
        function __construct() 
        {
            $this->error='';
            $this->countError=0;
        }
        
        function AddError($text)
        {
            $this->error.=$text.'<br>';
        }
        
        function emptyField($text, $field)
        {
            if(empty(trim($text)))
            {
                $this->AddError("$field field cannot be empty");
                $this->countError++;
            }
        }
        function bDayField($value, $field)
        {
            if($value == $field)
            {
                $this->AddError("$field field cannot be empty");
                $this->countError++;
            }
        }
        
        function maxCharsAmount($text, $field, $max)
        {
            if(strlen(trim($text)) > $max)
            {
                $this->AddError("$field field is able to accommodate maximum $max characters");
                $this->countError++;
            }
        }
        
        function checkMail($text, $field)
        {
           if(!filter_var($text,FILTER_VALIDATE_EMAIL))
           {
                $this->AddError("Please insert correct e-mail into $field field");   
                $this->countError++;
           }
        }
        
        function checkCheckBox($terms)
        {
            $this->AddError("$terms field has to be checked");
            $this->countError++;
        }
        
        function onlyLetters($text, $field)
        {
            if(!preg_match('/[a-z_.]/i', $text))
            {
            $this->AddError("Use only letters in $field field");
            $this->countError++;
            }
        }
        
        function phoneField($text, $field)
        {
            if(!preg_match("/^(+[0-9]){3}[0-9]$/", $text))
            {
            $this->AddError("Please insert correct phone number into $field field");
            $this->countError++;
            }
        }
        
        function __destruct() 
        {
            if(!empty($this->error))
            {
                echo '<div id="errors">'.$this->error.'</div>';
            }
        }        
    }
