<?php

namespace WPGMZA;

class ProMarkerPanel extends MarkerPanel
{
	public function __construct($map_id)
	{
		MarkerPanel::__construct($map_id);
		
		$this->initCategoryPicker($map_id);
		$this->initCustomFields();
	}
	
	protected function initCategoryPicker($map_id)
	{
		$categoryPicker = new CategoryPicker(array(
			'ajaxName' => 'category',
			'map_id' => $map_id
		));

		$this->querySelector(".wpgmza-category-picker-container")->import($categoryPicker);
	}
	
	protected function initCustomFields()
	{
		$panel = $this->querySelector('.wpgmza-marker-panel');
		
		// Add custom fields
		$customFieldsHTML = CustomFeatureFields::adminHtml();
		$panel->import($customFieldsHTML);
		
		// Move save button to back (after custom fields added)
		$fieldset = $this->querySelector(".wpgmza-save-feature-container");
		$panel->appendChild($fieldset);
	}
}

