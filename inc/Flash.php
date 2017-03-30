<?php

class Flash{

    private $text = '';
    private $type = '';
    private $message = false;

    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            throw new Exception("Vous devez appeler session_start() avant d'utiliser cette classe", 1);
        }

        if(! empty($_SESSION['flash_message'])){
            $this->text = $_SESSION['flash_message']['text'];
            $this->type = $_SESSION['flash_message']['type'];
            $this->message = true;
        }

        $_SESSION['flash_message'] = null;
    }

    /**
     * Retourne le texte du message
     * @return [string] Le texte du message
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Retourne le type du message
     * @return [string] Le type du message
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Vérifie si un message est disponible
     * @method hasMessage
     * @return [boolean] retourne true si un message est disponile sinon retourne false
     */
    public function hasMessage(){
        return $this->message;
    }

    /**
     * Céer le message
     * @method setMessage
     * @param  [string]     $text Texte du message
     * @param  [string]     $type Type du message. Par défault une chaine de caractères vide.
     */
    public function setMessage($text, $type = ''){
        $_SESSION['flash_message'] = array(
            'text' => $text,
            'type' => $type
        );
    }
}
