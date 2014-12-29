<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

class SearchTitleBlockPackage extends Package {

	protected $pkgHandle = 'search_title_block';
	protected $appVersionRequired = '5.6.1';
	protected $pkgVersion = '0.1';
	
	public function getPackageDescription() {
		return t("Install the block to show the current search query.");
	}
	
	public function getPackageName() {
		return t("Search Title Block");
	}
	
	public function install() {
		$pkg = parent::install();
		BlockType::installBlockTypeFromPackage('search_title', $pkg);
	}

}