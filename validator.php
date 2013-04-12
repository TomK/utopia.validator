<?php

/*
	uValidator processes the dom and corrects common validation mistakes
*/

uEvents::AddCallback('ProcessDomDocument','uValidator::ProcessDomDocument','',99999999);
class uValidator {
	static function ProcessDomDocument($event,$obj,$templateDoc) {
		$head = $templateDoc->getElementsByTagName('head')->item(0);
		
		/* FORMS */
		$forms = $templateDoc->getElementsByTagName('form');
		foreach ($forms as $form) {
			// lowercase METHOD attribute
			if ($form->hasAttribute('method')) $form->setAttribute('method',strtolower($form->getAttribute('method')));
			// missing ACTION attribute
			if ((!$form->hasAttribute('action') || !$form->getAttribute('action')) && !utopia::IsAjaxRequest()) $form->setAttribute('action',$_SERVER['REQUEST_URI']);
		}
		
		/* IMAGES */
		$images = $templateDoc->getElementsByTagName('img');
		foreach ($images as $img) {
			// missing ALT tag
			if (!$img->hasAttribute('alt')) $img->setAttribute('alt','');
		}
	}
}
