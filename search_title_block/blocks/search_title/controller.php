<?php
defined('C5_EXECUTE') or die("Access Denied.");

class SearchTitleBlockController extends BlockController {
	
	protected $btCacheBlockRecord = true;

	public function getBlockTypeDescription() {
		return t("Show the current search query.");
	}
	
	public function getBlockTypeName() {
		return t("Search Title");
	}
	
	public function view() {
		$query = (isset($_REQUEST['query'])) ? $_REQUEST['query'] : '';
		$this->set('query', $query);
		
		$month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : '';
		$year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : '';
		if ($month && $year) {
			$dt = new DateTime($year . '-' . $month . '-01');
			$this->set('dt', $dt);
		}
		
		$optionQuery = array();
		if (is_array($_REQUEST['akID'])) {
			Loader::model('attribute/categories/collection');
			foreach($_REQUEST['akID'] as $akID => $req) {
				$ak = CollectionAttributeKey::getByID($akID);
				if (is_object($ak)) {
					$type = $ak->getAttributeType();
					$cnt = $type->getController();
					$cnt->setAttributeKey($ak);
					$options = $cnt->request('atSelectOptionID');
					foreach($options as $id) {
						if (Loader::helper('validation/numbers')->integer($id) && $id > 0) {
							$opt = SelectAttributeTypeOption::getByID($id);
							if (is_object($opt)) {
								$optionQuery[] = $opt->getSelectAttributeOptionDisplayValue(false);
							}
						}
					}
				}
			}
		}
		$this->set('optionQuery', $optionQuery);
	}
	
}