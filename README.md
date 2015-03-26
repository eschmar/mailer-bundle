# Mailer Bundle
Conveniently send html/plaintext emails in Symfony2. This bundle ships with a version of [Mailgun's Action Email](https://github.com/mailgun/transactional-email-templates) ready to send emails.

![test.html.twig](https://raw.githubusercontent.com/eschmar/mailer-bundle/master/test.html.twig.jpg)

# Installation
Composer (<a href="https://packagist.org/packages/eschmar/mailer-bundle" target="_blank">Packagist</a>):
```json
"require": {
    "eschmar/css-inliner-bundle": "dev-master",
    "eschmar/mailer-bundle": "dev-master"
},
```

app/Appkernel.php:
```php
new Eschmar\CssInlinerBundle\EschmarCssInlinerBundle(),
new Eschmar\MailerBundle\EschmarMailerBundle(),
```

# Usage
The ``emailer`` service expects templates to have the 3 blocks ``subject``, ``body_html`` and ``body_plain`` and already includes a layout file ``EschmarMailerBundle:Mail:layout.html.twig`` ready to go. I do not recommend using embedded base64 images, this is just for demo purposes. Of course this layout is entirely optional, you may build your own templates. Using the Twig tag ``{% cssinline %}{% endcssinline %}``, CSS styles are inlined (some email clients strip out ``<head>`` and ``<style>`` tags).

````php
$mailer = $this->get('emailer');
if (!$mailer->send("EschmarMailerBundle:Mail:test.html.twig", [], $from, $to[, $bcc])) {
    // Oops!
    return;
}

// success
````

# License
MIT License.
