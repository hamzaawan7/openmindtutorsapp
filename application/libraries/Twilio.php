<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twilio
{
    public function __construct()
    {
        require_once 'twilio/Services/Twilio.php';
    }
}