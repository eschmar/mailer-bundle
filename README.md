# Eschmar Mailer Bundle
Conveniently send html/plaintext emails in Symfony2. **Work in progress.**

# Installation
Composer (<a href="https://packagist.org/packages/eschmar/mailer-bundle" target="_blank">Packagist</a>):
```json
"require": {
    "eschmar/mailer-bundle": "dev-master"
},
```

app/Appkernel.php:
```php
new Eschmar\MailerBundle\EschmarMailerBundle(),
```

# Usage
Inject the mailer service ``@emailer``.

````php
$mailer = $this->get('emailer');
$mailer->send("EschmarMailerBundle:Mail:test.html.twig", [], $from, $to);
````

# License
MIT License.