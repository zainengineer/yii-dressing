<?php
/**
 * @var $this ContactUsController
 * @var $contactUs ContactUs
 */

// index
if ($this->action->id == 'index') {
    $this->menu = Menu::getItemsFromMenu('Log');
    return; // no more links
}

// create
if ($contactUs->isNewRecord) {
    $this->menu[] = array(
        'label' => t('Create'),
        'url' => array('/contactUs/create'),
    );
    return; // no more links
}

// view
$this->menu[] = array(
    'label' => t('View'),
    'url' => $contactUs->getUrl(),
);

// others
foreach ($contactUs->getDropdownLinkItems(true) as $linkItem) {
    $this->menu[] = $linkItem;
}
