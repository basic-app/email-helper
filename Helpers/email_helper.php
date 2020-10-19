<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
use CodeIgniter\Email\Email;
use BasicApp\EmailHelper\EmailHelperEvents;

if (!function_exists('send_email'))
{
    function send_email(Email $email, &$error = null)
    {
        $result = EmailHelperEvents::sendEmail($email, $error);

        if ($result !== null)
        {
            return $result;
        }

        $return = $email->send();

        if (!$return)
        {
            if (CI_DEBUG)
            {
                $error = $email->printDebugger([]); 
            }
            else
            {
                $error = 'There was an error sending your message.';
            }
        }

        return $return;
    }
}

if (!function_exists('compose_email'))
{
    function compose_email(string $view, array $params = [], array $options = []) : Email
    {
        $email = EmailHelperEvents::composeEmail($view, $params, $options);

        if ($email)
        {
            return $email;
        }

        $message = view($view, $params, ['saveData' => false]);

        $view = service('renderer');

        $data = $view->getData();

        $subject = $data['subject'] ?? null;

        $mailType = $data['mailType'] ?? 'html';

        $email = single_service('email');

        $options['mailType'] = $mailType;

        $email->initialize($options);

        if ($subject)
        {
            $email->setSubject($subject);
        }

        $email->setMessage($message);

        return $email;
    }
}

/**
 * Parse string "User 1 <user@example.com>, user2@example.com" to array ["user@example.com>" => "User 1", user2@example.com]
 */
if (!function_exists('parse_recipients'))
{
    function parse_recipients(string $string) : array
    {
        $return = [];

        foreach(explode(',', $string) as $segment)
        {
            $segment = trim($segment);

            if (preg_match('|(.*)' . preg_quote('<', '|'). '(.+)' . preg_quote('>', '|') .'|', $segment, $matches))
            {
                $to_name = $matches[1];

                $to_email = $matches[2];

                $to_name = trim($to_name);

                $return[$email] = $name;
            }
            else
            {
                $return[] = $string;
            }
        }

        return $return;
    }
}