<?php
/**
 *       __  ___      ____  _     ___                           _                    __
 *      /  |/  /_  __/ / /_(_)___/ (_)___ ___  ___  ____  _____(_)___  ____   ____ _/ /
 *     / /|_/ / / / / / __/ / __  / / __ `__ \/ _ \/ __ \/ ___/ / __ \/ __ \ / __ `/ /
 *    / /  / / /_/ / / /_/ / /_/ / / / / / / /  __/ / / (__  ) / /_/ / / / // /_/ / /
 *   /_/  /_/\__,_/_/\__/_/\__,_/_/_/ /_/ /_/\___/_/ /_/____/_/\____/_/ /_(_)__,_/_/
 *
 *  Array to  DOM Document Library
 *  Copyright (c) Multidimension.al (http://multidimension.al)
 *  Github : https://github.com/multidimension-al/dom-array
 *
 *  Licensed under The MIT License
 *  For full copyright and license information, please see the LICENSE file
 *  Redistributions of files must retain the above copyright notice.
 *
 *  @copyright  Copyright © 2017-2019 Multidimension.al (http://multidimension.al)
 *  @link       https://github.com/multidimension-al/dom-array Github
 *  @license    http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Multidimensional\DomArray;

class DOMArray extends \DOMDocument
{

    /**
     * @param array|string $data
     * @param \DOMElement $domElement
     */
    public function loadArray($data, \DOMElement $domElement = null)
    {
        $domElement = is_null($domElement) ? $this : $domElement;

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_null($value)) {
                    $domNode = $this->createElement($key);
                    $domNode->setAttributeNS("http://www.w3.org/2001/XMLSchema-instance", "xsi:nil", "true");
                    $domElement->appendChild($domNode);
                } else {
                    if (is_int($key)) {
                        if ($key === 0) {
                            $domNode = $domElement;
                        } else {
                            $domNode = $this->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($domNode);
                        }
                    } else {
                        if (preg_match('/^\@(.*)$/', $key, $attribute)) {
                            $domElement->setAttribute($attribute[1], $value);
                            continue;
                        } else {
                            $domNode = $this->createElement($key);
                            $domElement->appendChild($domNode);
                        }
                    }

                }
                $this->loadArray($value, $domNode);
            }
        } elseif (is_bool($data) === true) {
            $domElement->appendChild($this->createTextNode((boolval($data) ? 'true' : 'false')));
        } elseif (!empty($data)) {
            $domElement->appendChild($this->createTextNode($data));
        }
    }
}
