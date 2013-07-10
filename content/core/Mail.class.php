<?php
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 3:51 PM
 */
if(!defined('xDEC')){
    echo "c indirect access".$_SERVER['PHP_SELF'];
exit;
}
class Mail {
    function __construct()
    {
        $this->eol = '\r\n';
    }

    var $eol, $to, $message, $headers, $params;

    function html_mail($to, $subject, $message, $from, $cc = null, $bcc = null){
        $this->to = $to;
        $this->message = $message;
        $this->headers = "From: $from".$this->eol.
                         "Mime-Version: 1.0".$this->eol.
                         "Content-type: text/html; charset=iso-8859-1Content-type: text/html; charset=iso-8859-1".$this->eol.
                         "To: $to".$this->eol.
                         (($cc)?"Cc: $cc".$this->eol:'').
                         (($bcc)?"Bcc: $bcc".$this->eol:'');
        mail($to, $subject, $message, $this->headers);
    }

    function mail($to, $subject, $message, $from, $cc = null, $bcc = null){
        $this->to = $to;
        $this->message = $message;
        $this->headers = "From: $from".$this->eol.
            "To: $to".$this->eol.
            (($cc)?"Cc: $cc".$this->eol:'').
            (($bcc)?"Bcc: $bcc".$this->eol:'');
        mail($to, $subject, $message, $this->headers);
    }
}