<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\EmailHelper\Config;

use CodeIgniter\Events\Events;

Events::on('pre_system', function() {
    
    helper(['email']);
});