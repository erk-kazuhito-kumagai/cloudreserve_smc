<?php
class CustomTranslate extends \Phalcon\Translate\Adapter\NativeArray
{
    public function _($translateKey, $placeholders=NULL)
    {
    
        $return = parent::_($translateKey, $placeholders);
        if($return != $translateKey) {
            return $return;
        }
    }
    
    public function get($translateKey) {
        if(isset($this->_translate[$translateKey])) {
            return $this->_translate[$translateKey];
        }
        return null;
    }
    
    public function getLists() {
        return $this->_translate;
    }
}