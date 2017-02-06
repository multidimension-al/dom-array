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

namespace Multidimensional\DomArray;

class DOMArray extends \DOMDocument {
        
    /**
     * @param array|string $data
     * @param \DOMElement $domElement
     */
    public function loadArray($data, \DOMElement $domElement = null)
    {        
        $domElement = is_null($domElement) ? $this : $domElement;
        
        if (is_array($data)) {
            foreach ($data as $key => $value) {
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
                
               $this->loadArray($value, $domNode);
                
            }
        } else {
            $domElement->appendChild($this->createTextNode($data));
        }
        
    }
}