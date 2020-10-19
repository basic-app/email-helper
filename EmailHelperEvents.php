<?php
/**
 * @author basic-app <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\EmailHelper;

use BasicApp\EmailHelper\Events\ComposeEmailEvent;
use BasicApp\EmailHelper\Events\SendEmailEvent;
use CodeIgniter\Email\Email;

class EmailHelperEvents extends \CodeIgniter\Events\Events
{

    const EVENT_COMPOSE_EMAIL = 'ba:compose_email';

    const EVENT_SEND_EMAIL = 'ba:send_email';

    public static function onComposeEmail($callback)
    {
        static::on(static::EVENT_COMPOSE_EMAIL, $callback);
    }

    public static function composeEmail($view, array $params = [], array $options = [])
    {
        $event = new ComposeEmailEvent;

        $event->view = $view;

        $event->params = $params;

        $event->options = $options;

        static::trigger(static::EVENT_COMPOSE_EMAIL, $event);

        return $event->result;
    }

    public static function onSendEmail($callback)
    {
        static::on(static::EVENT_SEND_EMAIL, $callback);
    }

    public static function sendEmail(Email $email, &$error = null)
    {
        $event = new SendEmailEvent;

        $event->email = $email;

        static::trigger(static::EVENT_SEND_EMAIL, $event);

        $error = $event->error;

        return $event->result;
    }

}