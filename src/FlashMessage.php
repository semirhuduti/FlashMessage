<?php

namespace sh\FlashMessage;

class FlashMessage {

    // There are 4 different types of messages.
    public $valid = ['information', 'success', 'warning', 'error'];

    function __construct() {
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = array();
        }
    }

    /**
     * Clear all existing messages.
     *
     */
    public function clear() {
        $_SESSION['flash'] = null;
    }

    /**
     * Create a message with a type and a value.
     *
     * @param string $type defines the tyoe of message. It can be one of four. (information, warning, success, error)
     * @param string $message defines the value of the message.
     */
    public function message($type = 'information', $message) {
        // check if the type of message is valid, if so add to session
        if (!in_array($type, $this->valid)) {
            $type = $this->valid[0];
        }

        $_SESSION['flash'][] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    /**
     * Create a information message
     * @param string $message the message
     */
    public function information($message) {
        $this->message('information', $message);
    }

    /**
     * Create a warning message.
     * @param string $message the message
     */
    public function warning($message) {
        $this->message('warning', $message);
    }

    /**
     * Create a success message 
     * @param string $message the message
     */
    public function success($message) {
        $this->message('success', $message);
    }

    /**
     * Create a error message
     * @param string $message the message
     */
    public function error($message) {
        $this->message('error', $message);
    }

    /**
     * This is used to retrive the HTML-code for the message.
     * @return string HTML-code for message.
     */
    public function getMessages() {
        $messages = null;
        if (isset($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $flashes => $flash) {
                $type = $flash['type'];
                $message = $flash['message'];
                $messages .= "<div class='flash_{$type}'>\n";
                $messages .= $message . "\n</div>\n";
            }
// done, clear messages
            $_SESSION['flash'] = null;
        }
        return $messages;
    }

}
