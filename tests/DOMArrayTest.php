<?php
/**
 *      __  ___      ____  _     ___                           _                    __
 *     /  |/  /_  __/ / /_(_)___/ (_)___ ___  ___  ____  _____(_)___  ____   ____ _/ /
 *    / /|_/ / / / / / __/ / __  / / __ `__ \/ _ \/ __ \/ ___/ / __ \/ __ \ / __ `/ /
 *   / /  / / /_/ / / /_/ / /_/ / / / / / / /  __/ / / (__  ) / /_/ / / / // /_/ / /
 *  /_/  /_/\__,_/_/\__/_/\__,_/_/_/ /_/ /_/\___/_/ /_/____/_/\____/_/ /_(_)__,_/_/
 *
 *  @author Multidimension.al
 *  @copyright Copyright © 2016-2017 Multidimension.al - All Rights Reserved
 *  @license Proprietary and Confidential
 *
 *  NOTICE:  All information contained herein is, and remains the property of
 *  Multidimension.al and its suppliers, if any.  The intellectual and
 *  technical concepts contained herein are proprietary to Multidimension.al
 *  and its suppliers and may be covered by U.S. and Foreign Patents, patents in
 *  process, and are protected by trade secret or copyright law. Dissemination
 *  of this information or reproduction of this material is strictly forbidden
 *  unless prior written permission is obtained.
 */

namespace Multidimensional\DomArray\Test;

use Multidimensional\DomArray\DOMArray;
use PHPUnit\Framework\TestCase;

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

    public function testExtraComplex()
    {
        $array = ['person' => ['firstname' => 'Test', 'lastname' => 'Man', 'address' => [0 => ['street' => '123 Fake St', 'city' => 'Springfield', 'state' => 'USA'], 1 => ['street' => '456 Real Ave', 'city' => 'New York', 'state' => 'NY']]]];
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><person><firstname>Test</firstname><lastname>Man</lastname><address><street>123 Fake St</street><city>Springfield</city><state>USA</state></address><address><street>456 Real Ave</street><city>New York</city><state>NY</state></address></person>';
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

    public function testTrackRequest()
    {
        $array = ['TrackRequest' => ['TrackID' => [0 => ['@ID' => 'EJ123456780US'], 1 => ['@ID' => 'EJ123456789US'], 2 => ['@ID' => 'EJ123456781US']]]];
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><TrackRequest><TrackID ID="EJ123456780US"/><TrackID ID="EJ123456789US"/><TrackID ID="EJ123456781US"/></TrackRequest>';
        $this->assertEquals($expected, $result);
    }

    public function testAddressValidateRequest()
    {
        $array = ['AddressValidateRequest' => ['Address' => [0 => ['@ID' => 123, 'FirmName' => 'XYZ Corp', 'Address2' => '123 Fake St.', 'City' => 'Los Angeles', 'State' => 'NY', 'Zip5' => '90210', 'Address1' => null, 'Urbanization' => null, 'Zip4' => null], 1 => ['@ID' => 456, 'FirmName' => 'XYZ Corp', 'Address2' => '123 Fake St.', 'City' => 'Los Angeles', 'State' => 'NY', 'Zip5' => '90210', 'Address1' => null, 'Urbanization' => null, 'Zip4' => null], 2 => ['@ID' => 789, 'FirmName' => 'XYZ Corp', 'Address2' => '123 Fake St.', 'City' => 'Los Angeles', 'State' => 'NY', 'Zip5' => '90210', 'Address1' => null, 'Urbanization' => null, 'Zip4' => null]]]];
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><AddressValidateRequest><Address ID="123"><FirmName>XYZ Corp</FirmName><Address2>123 Fake St.</Address2><City>Los Angeles</City><State>NY</State><Zip5>90210</Zip5></Address><Address ID="456"><FirmName>XYZ Corp</FirmName><Address2>123 Fake St.</Address2><City>Los Angeles</City><State>NY</State><Zip5>90210</Zip5></Address><Address ID="789"><FirmName>XYZ Corp</FirmName><Address2>123 Fake St.</Address2><City>Los Angeles</City><State>NY</State><Zip5>90210</Zip5></Address></AddressValidateRequest>';
        $this->assertEquals($expected, $result);
    }

    public function testBoolean()
    {
        $array = ['boolean' => ['true' => true, 'false' => false]];
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><boolean><true>true</true><false>false</false></boolean>';
        $this->assertEquals($expected, $result);
    }

    public function testFlag()
    {
        $array = ['xml' => ['nullthing' => null, 'nothing' => '', 'something' => 'hello']];
        $dom = new DOMArray('1.0', 'utf-8');
        $dom->loadArray($array);
        $result = preg_replace("/\n/", '', $dom->saveXML());
        $expected = '<?xml version="1.0" encoding="utf-8"?><xml><nothing/><something>hello</something></xml>';
        $this->assertEquals($expected, $result);
    }
}
