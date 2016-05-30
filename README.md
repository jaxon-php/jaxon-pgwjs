Modal Dialog for Xajax with PgwJs
=================================

This package implements responsive modal dialog in Xajax applications using the PgwJS library.
http://pgwjs.com.

Features
--------

- Enrich the Xajax response with functions to show and hide dialogs.
- Automatically insert the Js and CSS files of the PgwJs library into the HTML page.

Installation
------------

Add the following line in the `composer.json` file.
```json
"require": {
    "lagdo/xajax-pgwjs": "dev-master"
}
```

Or run the command
```bash
composer require lagdo/xajax-pgwjs
```

Configuration
------------

By default the plugin loads the version 2.0.0 of Js and CSS files from the Xajax website.

- assets.lagdo-software.net/libs/pgwjs/modal/2.0.0/pgwmodal.min.js
- assets.lagdo-software.net/libs/pgwjs/modal/2.0.0/pgwmodal.min.css

This can be disabled by setting the `assets.include.pgw` option to `false`.

The options of the PgwModal plugin can be set under the `pgw.modal.options.` section of the Xajax configuration.
See [here](http://pgwjs.com/pgwmodal/) for the full list of options.

Usage
-----

This example shows how to display a modal dialog.
```
function myFunction()
{
    $response = new \Xajax\Response\Response();

    // Process the request
    // ...

    // Show a modal dialog
    $buttons = array(array('title' => 'Close', 'class' => 'btn', 'click' => 'close'));
    $options = array('maxWidth' => 400);
    $response->pgw->modal("Modal Dialog", "This modal dialog is powered by PgwModal!!", $buttons, $options);

    return $response;
}
```

The `pgw` attribute of Xajax response provides the following functions.
```
public function modal($title, $content, $buttons, array $aOptions = array());   // Show a modal dialog
public function hide();                                                         // Hide the modal dialog
```

Contribute
----------

- Issue Tracker: github.com/lagdo/xajax-pgwjs/issues
- Source Code: github.com/lagdo/xajax-pgwjs

License
-------

The project is licensed under the BSD license.
