<?php

class ArrayToXML
{
	/**
	 * @param array $arr
	 * @return string XML
	 */
	public static function arrtoxml($arr,$dom=0,$item=0)
	{
		if (!$dom){
        $dom = new DOMDocument("1.0");
    }
    if(!$item){
        $item = $dom->createElement("xml"); 
        $dom->appendChild($item);
    }
    foreach ($arr as $key=>$val){
        $itemx = $dom->createElement(is_string($key)?$key:"item");
        $item->appendChild($itemx);
        if (!is_array($val)){
            $text = $dom->createTextNode($val);
            $itemx->appendChild($text);
            
        }else {
            self::arrtoxml($val,$dom,$itemx);
        }
    }
    return $dom->saveXML();
	}
}