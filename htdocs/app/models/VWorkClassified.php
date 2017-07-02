<?php
class VWorkClassified extends ModelBase
{
    
    public $workClassifiedId;
    public $itemId;
    public $checkupId;
    public $name;
    public $detail;
    public $fromDate;
    public $toDate;
    public $status;


    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'        => 'workClassifiedId',
            'item_id'   => 'itemId',
            'checkup_id'=> 'checkupId', 
            'name'      => 'name', 
            'detail'    => 'detail', 
            'status'    => 'status', 
            'from_date' => 'fromDate',
            'to_date'   => 'toDate'
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'workClassifiedId',
            'itemId',
            'checkupId', 
            'name', 
            'detail', 
            'status', 
            'fromDate',
            'toDate'
        );
    }
    
     
 
    public function getSource()
    {
        return 'v_smc_work_classified';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }
}
