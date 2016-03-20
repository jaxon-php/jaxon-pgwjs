<?php

namespace Xajax\Pgw;

class Modal extends \Xajax\Plugin\Response
{
	protected $aOptions;
	protected $bInclude;

	public function __construct()
	{
		$this->aOptions = array();
		$this->bInclude = true;
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

	public function setInclude($bInclude)
	{
		$this->bInclude = ($bInclude);
	}

	public function setOption($name, $value)
	{
		$this->aOptions[$name] = $value;
	}

	public function setOptions(array $aOptions)
	{
		$this->aOptions = array_merge($this->aOptions, $aOptions);
	}

	public function getJsInclude()
 	{
 		return (!$this->bInclude ? '' :
 			'<script type="text/javascript" src="//assets.lagdo-software.net/libs/pgwjs/modal/2.0.0/pgwmodal.min.js"></script>');
 	}

 	public function getCssInclude()
 	{
 		return (!$this->bInclude ? '' :
 			'<link href="//assets.lagdo-software.net/libs/pgwjs/modal/2.0.0/pgwmodal.min.css" rel="stylesheet" type="text/css">');
 	}

	public function getClientScript()
	{
		$sScript = '
jQuery(document).ready(function($){
	xajax.command.handler.register("pgwModal", function(args) {
		var options = {';
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
		};
		// Override defaults options with call options
		jQuery.extend(options, args.data.options);
		$.pgwModal(options);
	});
});
';
	}

	public function show($title, $content, $buttons, array $aOptions = array())
	{
		// Set the value of the max width, if there is no value defined
		if(!array_key_exists('maxWidth', $this->aOptions) && !array_key_exists('maxWidth', $aOptions))
		{
			$aOptions['maxWidth'] = 600;
		}
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
		<div class="modal-footer" style="padding:10px 5px 5px;">' . $modalButtons . '
		</div>
';
		// Affectations du contenu de la fenêtre
		$this->addCommand(array('cmd'=>'pgwModal'), array('title' => $title, 'content' => $modalHtml, 'options' => $aOptions));
	}

	public function hide()
	{
		$this->response()->script('$.pgwModal("close")');
	}
}

?>