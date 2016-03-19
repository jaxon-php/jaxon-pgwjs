<?php

namespace Xajax\Pgw;

class Modal extends \Xajax\Plugin\Response
{
	protected $aOptions;

	public function __construct()
	{
		$this->aOptions = array();
	}

	public function getName()
	{
		return 'pgwModal';
	}

	public function generateHash()
	{
		// Use the version number as hash
		return '0.1.0';
	}

	public function setOption($name, $value)
	{
		$this->aOptions[$name] = $value;
	}

	public function setOptions(array $aOptions)
	{
		$this->aOptions = array_merge($this->aOptions, $aOptions);
	}

	public function getClientScript()
	{
		$sScript = '
xajax.command.handler.register("pgwmodal", function(args) {
	$.pgwModal({';
		foreach($this->aOptions as $name => $value)
		{
			if(is_string($value))
			{
				$value = "'$value'";
			}
			else if(is_bool($value))
			{
				$value = ($value ? 'true' : 'false');
			}
			else if(!is_numeric($value))
			{
				$value = print_r($value, true);
			}
			$sScript .= '
	    ' . $name . ': ' . $value . ',';
		}
		return $sScript . '
	    title: args.data.title,
		content: args.data.content
	});
});
';
	}

	public function show($title, $content, $buttons = array(), array $aOptions = array())
	{
		// Buttons
		$modalButtons = '
';
		foreach($buttons as $button)
		{
			if($button['click'] == 'close')
			{
				$modalButtons .= '
			<button type="button" class="' . $button['class'] . '" onclick="$.pgwModal(\'close\')">' . $button['title'] . '</button>';
			}
			else
			{
				$modalButtons .= '
			<button type="button" class="' . $button['class'] . '" onclick="' . $button['click'] . '">' . $button['title'] . '</button>';
			}
		}
		// Dialog body and footer
		$modalHtml = '
		<div class="modal-body">
' . $content . '
		</div>
		<div class="modal-footer">' . $modalButtons . '
		</div>
';
		// Affectations du contenu de la fenêtre
		$this->addCommand(array('cmd'=>'pgwmodal'), array('title' => $title, 'content' => $modalHtml, 'options' => $aOptions));
	}

	public function hide()
	{
		$this->response()->script('$.pgwModal("close")');
	}
}

?>