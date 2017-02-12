<?php
/**    __  ___      ____  _     ___                           _                    __
 *    /  |/  /_  __/ / /_(_)___/ (_)___ ___  ___  ____  _____(_)___  ____   ____ _/ /
 *   / /|_/ / / / / / __/ / __  / / __ `__ \/ _ \/ __ \/ ___/ / __ \/ __ \ / __ `/ / 
 *  / /  / / /_/ / / /_/ / /_/ / / / / / / /  __/ / / (__  ) / /_/ / / / // /_/ / /  
 * /_/  /_/\__,_/_/\__/_/\__,_/_/_/ /_/ /_/\___/_/ /_/____/_/\____/_/ /_(_)__,_/_/   
 *                                                                                  
 * CONFIDENTIAL
 *
 * © 2017 Multidimension.al - All Rights Reserved
 * 
 * NOTICE:  All information contained herein is, and remains the property of
 * Multidimension.al and its suppliers, if any.  The intellectual and
 * technical concepts contained herein are proprietary to Multidimension.al
 * and its suppliers and may be covered by U.S. and Foreign Patents, patents in
 * process, and are protected by trade secret or copyright law. Dissemination
 * of this information or reproduction of this material is strictly forbidden
 * unless prior written permission is obtained.
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
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><simple>true</simple>';
        $this->assertEquals($result, $expected);
    }
    
    public function testComplex()
    {
        $array = ['person' => ['firstname' => 'Test', 'lastname' => 'Man', 'address' => ['street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA']]];
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><person><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address></person>';
        $this->assertEquals($result, $expected);
    }
    
    public function testAttribute()
    {
        $array = ['simple' => ['complex' => 'true', '@plan' => '123']];
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><simple plan="123"><complex>true</complex></simple>';
        $this->assertEquals($result, $expected);
    }
    
    public function testNullArray()
    {
        $array = null;
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?>';
        $this->assertEquals($result, $expected);
    }
    
    public function testDifferentVersion()
    {
        $array = null;
        $dom = new DOMArray('1.1', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.1" encoding="utf-8"?>';
        $this->assertEquals($result, $expected);    
    }
    
    public function testDifferentEncoding()
    {
        $array = null;
        $dom = new DOMArray('1.0', 'iso-8859-1');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="iso-8859-1"?>';
        $this->assertEquals($result, $expected);        
    }
    
    public function testDefault()
    {
        $array = null;
        $dom = new DOMArray();
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0"?>';
        $this->assertEquals($result, $expected);
    }
    
    public function testNothing()
    {
        $dom = new DOMArray();
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0"?>';
        $this->assertEquals($result, $expected);    
    }
}