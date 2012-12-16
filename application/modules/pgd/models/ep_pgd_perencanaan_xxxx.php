<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author  
 */
class Ep_pgd_perencanaan extends MY_Model {

    
  
    public $table = "EP_PGD_PERENCANAAN";
    //public $table = "EP_NOMORURUT";
    
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'PERENCANAAN';
		
	
    public $elements_conf = array('KODE_PERENCANAAN', 
			'KODE_KANTOR'  => array('type' => 'dropdown', 'options' => array()),
			 'JUDUL_PEKERJAAN',  
			 'LINGKUP_PEKERJAAN',
			 'RENCANA_KEBUTUHAN',  
			 'RENCANA_PELAKSANAAN',  
			 'SWAKELOLA' => array(
            'type' => 'dropdown', 'options' => array(
                '0' => 'TIDAK',
                '1' => 'YA'
        ))
			 

			 );
    public $columns_conf = array('KODE_PERENCANAAN' =>array('hidden'=>true, 'width'=>0) ,
								 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0) ,
								 'PERENCANA' =>array('hidden'=>false, 'width'=>20),
								 'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>30) ,
								 'NAMA_KANTOR' =>array('hidden'=>false, 'width'=>20),
								 'RENCANA_KEBUTUHAN' =>array('hidden'=>false, 'width'=>10),
								 'RENCANA_PELAKSANAAN' =>array('hidden'=>false, 'width'=>10),
 								 'STATUS' =>array('hidden'=>false, 'width'=>10)
								 );
	
	
    public $sql_select = "(SELECT P.PERENCANA, P.KODE_PERENCANAAN ,  P.KODE_KANTOR, P.JUDUL_PEKERJAAN, K.NAMA_KANTOR, P.RENCANA_KEBUTUHAN, P.RENCANA_PELAKSANAAN, P.STATUS  
		FROM EP_PGD_PERENCANAAN P
		LEFT JOIN MS_KANTOR K ON P.KODE_KANTOR = K.KODE_KANTOR
		)";
    
    /*
      public $columns = array(
      'KODE_VENDOR'=>array('name'=>'KODE VENDOR', 'raw_name'=>'KODE_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'NAMA_VENDOR'=>array('name'=>'NAMA VENDOR', 'raw_name'=>'NAMA_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'KODE_LOGIN'=>array('name'=>'KODE LOGIN', 'raw_name'=>'KODE_LOGIN', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      );
     */

	protected function _before_insert()
    {
        print_r($this->attributes);
        die('x');
		
		
        $query = $this->db->query("SELECT max(NOMORURUT) + 1 as idx FROM EP_NOMORURUT where KODE_NOMORURUT = 'PERENCANAAN' AND KODE_KANTOR = '" .$this->kode_kantor. "'" );
        $row = $query->row();
        $this->attributes['KODE_VENDOR'] = $row->IDX;
        $this->attributes['TGL_REKAM'] = date("Y-m-d");
    }
    
    protected function _after_insert()
    {
		$kode_kantor = $this->session->userdata("kode_kantor");
		$kode_nomerurut = 'PERENCANAAN';
       $sql = "SELECT NOMORURUT FROM EP_NOMORURUT WHERE KODE_KANTOR='" . $this->kode_kantor . "' AND KODE_NOMORURUT = '".$this->kode_nomerurut."' ";
		$query = $this->db->query($sql);
		
		$result = $query->result();
 
	
		if (count($result)== 0)	{
		
			$sql = "INSERT INTO EP_NOMORURUT (KODE_KANTOR,KODE_NOMORURUT,NOMORURUT) ";
			$sql .= " VALUES ('" .$this->kode_kantor . "', '" . $this->kode_nomerurut . "',1) ";
			$this->db->simple_query($sql);
			  
		} else {
			$urut = $result[0]->NOMORURUT + 1;
			$sql = "UPDATE EP_NOMORURUT SET  NOMORURUT = ".$urut ;
			$sql .= " WHERE  KODE_KANTOR = '" .$this->kode_kantor . "' AND KODE_NOMORURUT =  '" . $kode_nomerurut . "' ";
			 
			$this->db->simple_query($sql);
			
			
		}	
	 
 
    }
	 
    function __construct() {
        parent::__construct();
        $this->init();
		
		$this->kode_kantor = $this->session->userdata("kode_kantor");
	//	$this->attributes['KODE_KANTOR'] = $this->input->get('KODE_KANTOR');
		
        // get selected value 
        $query = $this->db->query('SELECT * FROM MS_KANTOR ');
        $rows = $query->result_array();
        
        $this->elements_conf['KODE_KANTOR']['options'] = array();
		
        foreach ($rows as $v)
        {
			
		

			$this->elements_conf['KODE_KANTOR']['options'][$v['KODE_KANTOR']] = $v['NAMA_KANTOR'];
        
		
		}

			  
			if ($this->input->get('KODE_KANTOR')) {
				 $this->elements_conf['KODE_KANTOR']['value'][] = $this->input->get('KODE_KANTOR');
			} else {
				$this->elements_conf['KODE_KANTOR']['value'][] = $this->session->userdata("kode_kantor");
			
			}
		  
		
    }

}

?>
