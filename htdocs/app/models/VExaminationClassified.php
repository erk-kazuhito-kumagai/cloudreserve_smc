<?php
class VExaminationClassified extends ModelBase
{
    
    public $classifiedId;
    public $itemId;
    public $parentId;
    public $checkupId;
    public $name;
    public $detail;
    public $fromDate;
    public $toDate;
    public $status;
    public $type;
    public $template;


    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'        => 'classifiedId',
            'item_id'   => 'itemId',
            'parent_id' => 'parentId',
            'checkup_id'=> 'checkupId', 
            'name'      => 'name', 
            'detail'    => 'detail', 
            'status'    => 'status', 
            'from_date' => 'fromDate',
            'to_date'   => 'toDate', 
            'item_type' => 'type', 
            'template'  => 'template'
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'classifiedId',
            'itemId',
            'parentId',
            'checkupId', 
            'name', 
            'detail', 
            'status', 
            'fromDate',
            'toDate', 
            'type', 
            'template'
        );
    }
    
     
 
    public function getSource()
    {
        return 'v_smc_examination_classified';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }
}
