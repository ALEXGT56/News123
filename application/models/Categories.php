<?php
class Application_Model_Categories extends Zend_Db_Table_Abstract
{
    
    protected $_name = 'categories';
    protected $_primary = 'id';
    
    public function getAsKeyValue()
    {
        
        $rowset = $this->fetchAll();
        
        $data = array();
        
        foreach( $rowset as $row ){            
            $data[$row->id] = $row->name ;
        }
        
        
        return $data;
        
    }
    
    public function getAllNews()
    {
        $query = $this->select()
                ->from( array( 'p'=>'posts' ), array('*'))
				->join(array( 'pc' =>'posts_categories'), 'p.id = pc.post_id', 
                        array() )
               ->join(array( 'c' =>'categories'), 'c.id = pc.category_id', 
                        array('cname' => 'name' ) )
                ->setIntegrityCheck(false);
        
        
        return $this->fetchAll( $query );
    }
    
    public function getAllNewsById( $id )
    {
        $query = $this->select()
                ->from( array( 'p'=>'posts' ), array('*'))
              		->join(array( 'pc' =>'posts_categories'), 'p.id = pc.post_id', 
                        array() )
               ->join(array( 'c' =>'categories'), 'c.id = pc.category_id', 
                        array('cname' => 'name' ) )
                ->where('c.id = ?' , $id )
                ->setIntegrityCheck(false);
        
        
        return $this->fetchAll( $query );
    }
}
