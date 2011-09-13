<?php


/***************************************************************
*  Copyright notice
*
*  (c) 2004 
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once (t3lib_extMgm :: extPath('cal').'view/class.tx_cal_base_view.php');

/**
 * A concrete view for the calendar.
 * It is based on the phpicalendar project
 *
 * @author Mario Matzulla <mario(at)matzullas.de>
 */
class tx_cal_locationview extends tx_cal_base_view {

	function tx_cal_locationview(){
		$this->tx_cal_base_view();
	}
	
	/**
	 *  Draws a location.
	 *  @param		object		The location to be drawn.
	 *	@return		string		The HTML output.
	 */
	function drawLocation($location) {
		$array = array();
		$this->_init($array);
		$lastview = $this->controller->extendLastView();
		$uid = $this->conf['uid'];
		$type = $this->conf['type'];
		$page = $this->cObj->fileResource($this->conf['view.']['event.']['eventTemplate']);
		if ($page == '') {
			return '<h3>calendar: no template file found:</h3>'.$this->conf['view.']['event.']['eventTemplate'];
		}
		if(is_object($location)){
			$rems['###EVENT###'] = $location->renderLocation();
			$GLOBALS['TSFE']->page['title'] = $location->getName();
		}else{
			$rems['###EVENT###'] = $this->cObj->stdWrap($this->controller->pi_getLL('l_no_location_results'),$this->conf['view.']['location.']['noLocationFound_stdWrap.']);
		}
		
		return $this->finish($page, $rems);
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cal/view/class.tx_cal_locationview.php']) {
	include_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cal/view/class.tx_cal_locationview.php']);
}
?>