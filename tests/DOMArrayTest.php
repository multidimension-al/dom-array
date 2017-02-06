<?php
/**
 * CONFIDENTIAL
 *
 * © 2017 Multidimension.al - All Rights Reserved
 * 
 * NOTICE:  All information contained herein is, and remains
 * the property of Multidimension.al and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Multidimension.al and its suppliers
 * and may be covered by U.S. and Foreign Patents, patents in
 * process, and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained.
 */

namespace Multidimensional\DomArray\Test;

use Multidimensional\DomArray;
use PHPUnit_Framework_TestCase;

class DOMArrayTest extends TestCase
{
	
	public function testSimple()
	{
		$array = ['simple' => 'true'];
		$dom = new DOMArray('1.0', 'utf-8');
		$dom->loadArray($array);
		$result = preg_replace("/\n/", "", $dom->saveXML());
		$expected = '<?xml version="1.0" encoding="utf-8"?><simple>true</simple>';
		$this->assertEquals($result, $expected);
	}
	
	public function testComplex()
	{
		$this->markTestIncomplete();
	}
	
	public function testAttribute()
	{
		$this->markTestIncomplete();
	}
	
	
}