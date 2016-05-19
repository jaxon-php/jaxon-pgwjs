## xajax-pgwjs

Responsive modal dialog for Xajax

#### Installation

Run `composer require lagdo/xajax-pgwjs`, or add `"lagdo/xajax-pgwjs": "dev-master"` in your composer.json.

Add JQuery in the HTML header.

#### Usage

The plugin can be called with the `pgwModal` attribute in the Xajax response object.
```
function myFunction()
{
    $xResponse = new \Xajax\Response\Response();
    // Process the request
    // ...
    // Show a modal dialog
    $buttons = array(array('title' => 'Close', 'class' => 'btn', 'click' => 'close'));
    $options = array('maxWidth' => 400);
    $xResponse->pgwModal->show("Modal Dialog", "This modal dialog is powered by PgwModal!!", $buttons, $options);
    return $xResponse;
}
```
