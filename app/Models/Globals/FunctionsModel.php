<?php

namespace App\Models\Globals;

use CodeIgniter\Model;

class FunctionsModel extends Model
{
    public function slugify($text)
    {
        // Strip html tags
        $text = strip_tags($text);
        // Replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // Transliterate
        setlocale(LC_ALL, 'en_US.utf8');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // Remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // Trim
        $text = trim($text, '-');
        // Remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // Lowercase
        $text = strtolower($text);
        // Check if it is empty
        if (empty($text)) {
            return 'n-a';
        }
        // Return result
        return $text;
    }

    public function sendEmail($emailTo, $emailFrom, $nameFrom, $subject, $htmlMessage, $textMessage = '', $smtp = null,  $cc = '', $bcc = '', $replyTo = '')
    {
        $email = \Config\Services::email();

        if ($smtp !== null) {
            $config['protocol'] = 'smtp';
            $config['SMTPHost'] = $smtp['SMTPHost'];
            $config['SMTPUser'] = $smtp['SMTPUser'];
            $config['SMTPPass'] = $smtp['SMTPPass'];
            $config['SMTPPort'] = $smtp['SMTPPort'];
            $config['SMTPTimeout'] = $smtp['SMTPTimeout'] ? $smtp['SMTPTimeout'] : 5;
            $config['SMTPKeepAlive'] = $smtp['SMTPKeepAlive'] ? $smtp['SMTPKeepAlive'] : false;
            $config['SMTPCrypto'] = $smtp['SMTPCrypto'] ? $smtp['SMTPCrypto'] : 'ttl';
        } else {
            $config['protocol'] = 'sendmail';
        }

        // $config['mailPath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'iso-8859-1';
        $config['mailType'] = 'html';
        $config['priority'] = 1;

        $email->initialize($config);

        $email->setHeader('Header1', 'Value1');

        $email->setFrom($emailFrom, $nameFrom);
        if ($replyTo !== '') {
            $email->setReplyTo($replyTo, 'Hillstay');
        }
        $email->setTo($emailTo);
        if ($cc !== '') {
            $email->setCC($cc);
        }
        if ($bcc !== '') {
            $email->setBCC($bcc);
        }
        $email->setSubject($subject);
        $email->setMessage($htmlMessage);
        if ($textMessage !== '') {
            $email->setAltMessage($textMessage);
        }

        return $email->send();
    }
}
