<?php

namespace sh\FlashMessage;

require_once(__DIR__ . '/../../src/FlashMessage.php');

class FlashMessageTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        $this->flash = new FlashMessage();
    }
    /**
     * This is a test method to test if the clear funktion works
     *
     */
    public function testClear() {
        // Create a information flash message
        $this->flash->message('information', 'Information type message');
        // Test type of message 
        $exp = "information";
        $this->assertEquals($exp, $_SESSION['flash'][0]['type']);
        // Test the message content
        $exp = "Information type message";
        $this->assertEquals($exp, $_SESSION['flash'][0]['message']);

        // Test the clear method is working
        $this->flash->clear();
        $this->assertEquals(null, $_SESSION['flash']);
    }
    
    /**
     * This is a method to test if message method works
     */
    public function testMessage() {
        
        //Create 5 possible messages that will be tested
        $this->flash->message('information', 'Information message');
        $this->flash->message('success', 'Success message');
        $this->flash->message('warning', 'Warning message');
        $this->flash->message('error', 'Error message');
        $this->flash->message('Not supported type', 'Should be information type message');
        
        // These are the expected values for the message type test
        $exp = ['information', 'success', 'warning', 'error', 'information'];
        
        // Do 5 testes for all the possible messeges that can be generated for the type
        for ($i = 0; $i < 5; $i++) {
            $this->assertEquals($exp[$i], $_SESSION['flash'][$i]['type']);
        }
        // These are the expected values for the message content test
        $exp = ['Information message', 'Success message', 'Warning message', 'Error message', 'Should be information type message'];
        
        // Do 4 tests for the message contet
        for ($i = 0; $i < 5; $i++) {
            $this->assertEquals($exp[$i], $_SESSION['flash'][$i]['message']);
        }
    }
    
    /*
     * Thes the specific message functions
     */
    public function testSpecificMessageFunctions() {
        
        $this->flash->information('Information message');
        $this->flash->success('Success message');
        $this->flash->warning('Warning message');
        $this->flash->error('Error message');
        
        $exp = ['information', 'success', 'warning', 'error'];
        
        for ($i = 0; $i < 4; $i++) {
            $this->assertEquals($exp[$i], $_SESSION['flash'][$i]['type']);
        }
        
        $exp = ['Information message', 'Success message', 'Warning message', 'Error message'];
        
        for ($i = 0; $i < 4; $i++) {
            $this->assertEquals($exp[$i], $_SESSION['flash'][$i]['message']);
        }
        
    }
    
    /*
     * Test if the get message works
     */
    public function testGetMessages() {
        $this->flash->clear();
        $this->flash->message('information', 'Information example message');
        $expectedResult = "<div class='flash_information'>\n" . "Information example message" . "\n</div>\n";
        $this->assertEquals($expectedResult, $this->flash->getMessages());
    }

    /*
     * Test if clear clear gets a empty message
     */
    public function testEmptyGetMessages() {
        $this->flash->clear();
        $this->assertEquals(null, $this->flash->getMessages());
    }

}
