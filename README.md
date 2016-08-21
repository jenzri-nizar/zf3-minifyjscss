# Zend Framework 3 minify
Zend Framework 3 minify  (Css | Js)

##Installation

1) Ajouter l'exigence suivante à votre fichier composer.json.
Dans la section:"require"

```php
"jenzri-nizar/zf3-minifyjscss": "dev-master"
```
2) Ouvrez votre ligne de commande et exécutez

```php
composer update
```

Le module doit être enregistré dans **config/modules.config.php**
```php
'modules' => array(
    '...',
    'Zf3\Minifyjscss'
),
```
