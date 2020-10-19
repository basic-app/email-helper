<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\EmailHelper\Events;

class ComposeEmailEvent
{

    public $view;

    public $params = [];

    public $options = [];

    public $result;
    
}