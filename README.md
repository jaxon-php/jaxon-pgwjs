Modal Dialog for Jaxon with PgwJs
=================================

This package implements responsive modal dialog in Jaxon applications using the PgwJS library.
http://pgwjs.com.

Features
--------

- Enrich the Jaxon response with functions to show and hide dialogs.
- Automatically insert the Js and CSS files of the PgwJs library into the HTML page.

Installation
------------

Add the following line in the `composer.json` file.
```json
"require": {
    "jaxon-php/jaxon-pgwjs": "dev-master"
}
```

Or run the command
```bash
composer require jaxon-php/jaxon-pgwjs
```

Configuration
------------

By default the plugin loads the version 2.0.0 of Js and CSS files from the Jaxon website.

- lib.jaxon-php.org/pgwjs/modal/2.0.0/pgwmodal.min.js
- lib.jaxon-php.org/pgwjs/modal/2.0.0/pgwmodal.min.css

This can be disabled by setting the `assets.include.pgw` option to `false`.

The options of the PgwModal plugin can be set under the `pgw.modal.options.` section of the Jaxon configuration.
See [here](http://pgwjs.com/pgwmodal/) for the full list of options.

Usage
-----

This example shows how to display a modal dialog.
```php
function myFunction()
{
    $response = new \Jaxon\Response\Response();

    // Process the request
    // ...

    // Show a modal dialog
    $buttons = array(array('title' => 'Close', 'class' => 'btn', 'click' => 'close'));
    $options = array('maxWidth' => 400);
    $response->pgw->modal("Modal Dialog", "This modal dialog is powered by PgwModal!!", $buttons, $options);

    return $response;
}
```

The `pgw` attribute of Jaxon response provides the following functions.
```php
public function modal($title, $content, $buttons, array $aOptions = array());   // Show a modal dialog
public function hide();                                                         // Hide the modal dialog
```

Contribute
----------

- Issue Tracker: github.com/jaxon-php/jaxon-pgwjs/issues
- Source Code: github.com/jaxon-php/jaxon-pgwjs

License
-------

The project is licensed under the BSD license.
