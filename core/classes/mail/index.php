<?php
/**
 * Mail - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;

require PATH . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

final class Mail {
    private static $mail = null;
    function __construct()
    {
        self::$mail = new PHPMailer(true);
        self::config();
    }

    /**
     * Config E-mail system
     * @return void
     */
    private static function config()
    {
        //Server settings
        self::$mail->isSMTP();
        self::$mail->Host       = $GLOBALS['config']['mail_Host'];
        self::$mail->SMTPAuth   = true;
        self::$mail->Username   = $GLOBALS['config']['mail_Username'];
        self::$mail->Password   = $GLOBALS['config']['mail_Password'];
        self::$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        self::$mail->Port       = $GLOBALS['config']['mail_Port'];
        self::$mail->CharSet    = 'UTF-8';
    }
    /**
     * Before send email this function will valid fields
     * @return void
     */
    private static function validFields(array $params)
    {
        if (empty($params['fromEmail']) || empty($params['toEmail']))
        {
            throw new Exception("Email not found");
        }
        if (empty($params['fromName']) || empty($params['toName']))
        {
            throw new Exception("Name not found");
        }
        if (empty($params['subject']))
        {
            throw new Exception("Subject not found");
        }
    }
    /**
     * Send e-mail
     * @return boolean
     */
    public static function send(array $params)
    {
        try
        {
            self::validFields($params);
            //Recipients
            self::$mail->setFrom($params['fromEmail'], $params['fromName']);
            self::$mail->addAddress($params['toEmail'], $params['toName']);     // Add a recipient

            // Content
            self::$mail->isHTML(true);
            self::$mail->Subject = $params['subject'];
            self::$mail->Body    = $params['body'] ?: '';
            if (!empty($params['attachment']))
            {
                if (is_array($params['attachment']))
                {
                    foreach ($params['attachment'] as $attachment) {
                        self::$mail->addStringAttachment(file_get_contents($attachment), $attachment);
                    }
                }
                else {
                    self::$mail->addStringAttachment(file_get_contents($params['attachment']), $attachment);
                }
            }

            $result = self::$mail->send();
            if ($result) return true;
            return false;
        }
        catch (Exception $e) {
            throw new Exception("Message could not be sent. Mailer Error: {$e->getMessage()}");
        }
    }
}
?>