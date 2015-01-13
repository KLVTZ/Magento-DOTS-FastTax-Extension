<?php

/**
 * DOTS Fast Tax Implementation
 *
 * @category DOTS
 * @package DOTS_FastTax 
 * @author Justin Page | KLVTZ
 */

class DOTS_FastTax_Model_Calculation extends Mage_Tax_Model_Calculation
{
    /**
     * List of taxable states and the destination state name
     *
     * @var array
     * @var string 
     */
	protected $taxableStates;
	protected $shippingState;

	/**
	 * Init Tax Calculation and list all taxable states
	 *
	 * @param void
	 * @return void
	 */
	public function __construct() 
	{
		parent::__construct();
		$this->listTaxableStates();
		$this->shippingState = $this->getShippingState($this->getDestRegionId());
	}
	/**
	 * Calculate rated tax based on price and tax rate.
	 * If you are using price including tax $priceInclude should be true.
	 *
	 * @param float $price
	 * @param float $taxRate
	 * @param boolean $priceIncludeTax
	 * @param boolean $round
	 * @return float
	 */
	public function calcTaxAmount($price, $taxRate, $priceIncludeTax = false, $round = true)
	{
		$taxRate = 0.00;

		if (in_array($this->shippingState, $this->taxableStates)) {
			$dots_helper = Mage::helper('DOTS_FastTax/DOTS');
			$taxRate = $dots_helper->getTaxRate();
		}

		if ($priceIncludeTax) {
			$amount = $price * (1 - 1 / (1 + $taxRate));
		} else {
			$amount = $price * $taxRate;
		}

		if ($round) {
			return $this->round($amount);
		}

		return $amount;
	}


	/**
	 * Generate a list of taxable states based on etc/system.xml
	 *
	 * @param void
	 * @return void
	 */
	protected function listTaxableStates()
	{
		$region_list = explode(",", Mage::getStoreConfig('dots_options/fasttax_options/region_id'));

		foreach ($region_list as $region) {
			$this->taxableStates[] = $this->getShippingState($region);
		}
	}

	/**
	 * Lookup Shipping Address State Name from Directory/Region 
	 *
	 * @param string
	 * @return string
	 */
	protected function getShippingState($region)
	{
		return Mage::getSingleton('directory/region')->load($region)->getName();
	}

	/**
	 * Get destination region id from Mage/Checkout Session
	 *
	 * @param void 
	 * @return string
	 */
	protected function getDestRegionId()
	{
		return Mage::getSingleton('checkout/cart')->getQuote()->getShippingAddress()->getRegionId();
	}

}
