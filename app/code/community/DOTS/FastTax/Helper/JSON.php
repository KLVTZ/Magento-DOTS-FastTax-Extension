<?php

/**
 * DOTS FastTax JSON Helper
 * @package DOTS_FastTax
 * @author Justin Page | KLVTZ
 */
class DOTS_FastTax_Helper_JSON extends Mage_Core_Helper_Abstract
{
	/**
	 * Get Tax Rate from requested JSON
	 *
	 * @param void
	 *
	 * @return float $rate
	 */
	public function getTaxRate($url)
	{
		$taxObj = $this->requestJSON($url);
		$rate = $taxObj->MultiTaxInfo[0]->TaxInfo->TotalTaxRate;
		if (!isset($rate))
			return 0.0;

		return $rate;
	}

	/**
	 * Request JSON from DOTS REST API
	 *
	 * @param String $url
	 *
	 * @return Object $taxObj
	 */
	protected function requestJSON($url)
	{
		return $this->json_to_object(file_get_contents($url));
	}

	/**
	 * JSON to stdClass
	 *
	 * @param String JSON
	 *
	 * @return $taxObj
	 */
	protected function json_to_object($json)
	{
		return json_decode($json);
	}
}
