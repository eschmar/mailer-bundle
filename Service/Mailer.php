<?php

namespace Eschmar\MailerBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * Sends emails with html and plain parts.
 *
 * @author Marcel Eschmann
 **/
class Mailer
{
    /**
     * Swiftmailer
     * @var Swift_Mailer
     **/
    private $mailer;

    /**
     * Twig
     * @var TwigEngine
     **/
    private $twig;

    function __construct(\Swift_Mailer $mailer, TwigEngine $templating) {
        $this->mailer = $mailer;
        $this->twig = $templating;
    }

    /**
     * Sends an email. Expects twig blocks `body_html`, `body_plain` and `subject`.
     *
     * @return boolean
     * @author Marcel Eschmann
     **/
    public function send($template, $context, $from, $to, $bcc = null)
    {
        // load template and enable globals
        $context = $this->twig->mergeGlobals($context);
        $template = $this->twig->loadTemplate($template);

        // render email parts
        $subject = $template->renderBlock('subject', $context);
        $plain = $template->renderBlock('body_plain', $context);
        $html = $template->renderBlock('body_html', $context);

        // create message
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($plain, 'text/plain')
            ->addPart($html, 'text/html');

        if ($bcc) { $message->setBcc($bcc); }

        // send email via swiftmailer
        try {
            $this->mailer->send($message);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

} // END class Mailer