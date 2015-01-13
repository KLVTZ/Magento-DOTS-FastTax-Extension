<?php

/**
 * DOTS FastTax Helper: Returns Tax Percentage
 *
 * @category DOTS
 * @package DOTS_FastTax
 * @author Justin Page | KLVTZ
 */
class DOTS_FastTax_Helper_DOTS extends Mage_Core_Helper_Abstract
{
	/**
	 * Get Tax Rate from DOTS FastTax REST API
	 *
	 * @param void
	 * @return float $rate
	 */
	public function getTaxRate()
	{
		$url = $this->buildURL();
		return  $this->getQuote($url);
	}

	/**
	 * Build REST from Mage Checkout Session
	 *
	 * @param void
	 * @return String $url
	 */
	protected function buildURL()
	{
		$url = $this->getBaseURL();
		$url .= $this->getPostcode() . DS;
		$url .= 'Sales' . DS;
		$url .= $this->getLicenseKey();
		$url .= '?format=json';

		return $url;
	}

	/**
	 * Get Base URL from String
	 *
	 * @param void
	 * @return String $base_url
	 */
	protected function getBaseURL()
	{
		return Mage::getStoreConfig('dots_options/fasttax_creds/base_url');
	}

	/**
	 * Get Post Code from Mage Checkout Session
	 *
	 * @param void
	 * @return String $post_code
	 */
	protected function getPostcode()
	{
		$postal_code = Mage::getSingleton('checkout/cart')->getQuote()->getShippingAddress()->getPostcode();
		if (null === $postal_code)
			return Mage::getStoreConfig('carriers/yrc_ratequote/postcode');
		return $postal_code;
	}
	
	/**
	 * Get License Key provided by DOTS FastTax
	 *
	 * @param void
	 * @return String $license_key
	 */
	protected function getLicenseKey()
	{
		return Mage::helper('core')->decrypt(Mage::getStoreConfig('dots_options/fasttax_creds/auth_key'));
		
	}

	/**
	 * Get Quote from DOTS REST API
	 *
	 * @param void
	 * @return float $rate
	 */
	protected function getQuote($url)
	{
		$json_helper = Mage::helper('DOTS_FastTax/JSON');
		return $json_helper->getTaxRate($url);
	}
}
