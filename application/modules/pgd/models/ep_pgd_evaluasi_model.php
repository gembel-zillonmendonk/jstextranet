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
class Ep_pgd_evaluasi_model extends MY_Model {

    public $table = "EP_PGD_EVALUASI_MODEL";
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'EVALUASI';
	
 
    public $elements_conf = array( 
								'KODE_TIPE'  => array('type' => 'dropdown', 'options' => array()) ,
								'NAMA',
								'TINGKAT',
								'BOBOT_TEKNIS',
								'BOBOT_HARGA',

							 );
			 
    public $columns_conf = array('KODE_EVALUASI' =>array('hidden'=>true, 'width'=>0) ,
								 'KODE_TIPE' =>array('hidden'=>true, 'width'=>0), 
								 'NAMA'  =>array('hidden'=>false, 'width'=>50),								 
								 'NAMA_TIPE' =>array('hidden'=>false, 'width'=>40) ,
								 'PROSES' =>array('hidden'=>false, 'width'=>10) 
								 );
	
	
    public $sql_select = "(SELECT  
							E.KODE_EVALUASI ,
							E.KODE_TIPE,
							T.NAMA_TIPE AS NAMA_TIPE,
							E.NAMA, 
							 '' as \"PROSES\"
						  FROM 	 EP_PGD_EVALUASI_MODEL E
						  LEFT JOIN EP_PGD_EVALUASI_TIPE T ON E.KODE_TIPE = T.KODE_TIPE
						)";
	
 
	protected function _before_insert()
    {
        
		
		
        $query = $this->db->query("SELECT max(NOMORURUT)  as IDX FROM EP_NOMORURUT where KODE_NOMORURUT = '".$this->kode_nomerurut."' AND KODE_KANTOR = '" .$this->kode_kantor. "'" );
        $row = $query->row();
        $this->attributes['KODE_EVALUASI'] = $row->IDX;
        $this->attributes['TGL_REKAM'] = date("Y-m-d");
    }
    
    protected function _after_insert()
    {
	
       $sql = "SELECT NOMORURUT FROM EP_NOMORURUT WHERE KODE_KANTOR='" . $this->kode_kantor . "' AND KODE_NOMORURUT = '".$this->kode_nomerurut."' ";
		$query = $this->db->query($sql);
		
		$result = $query->result();
                
                echo $sql;
	
		if (count($result)== 0)	{
		
			$sql = "INSERT INTO EP_NOMORURUT (KODE_KANTOR,KODE_NOMORURUT,NOMORURUT) ";
			$sql .= " VALUES ('" .$this->kode_kantor . "', '" . $this->kode_nomerurut . "',1) ";
			$this->db->simple_query($sql);
			  
		} else {
			$urut = $result[0]->NOMORURUT + 1;
			$sql = "UPDATE EP_NOMORURUT SET  NOMORURUT = ".$urut ;
			$sql .= " WHERE  KODE_KANTOR = '" .$this->kode_kantor . "' AND KODE_NOMORURUT =  '" . $this->kode_nomerurut . "' ";
			 
			$this->db->simple_query($sql);
			
			
		}	
	 
 
    }
 
	function __construct() {
        parent::__construct();
        $this->init();	 
        
       
        $CI = & get_instance();
         if ($CI->input->get('KODE_EVALUASI')) {
        $this->attributes['KODE_EVALUASI'] = $CI->input->get('KODE_EVALUASI');
        }	
$this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnEditEvaluasi(\'"+cl+"\');\"  >EDIT</button>"; 
				 	
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{PROSES:be});
		}';
		
		
		$query = $this->db->query('SELECT KODE_TIPE, NAMA_TIPE FROM EP_PGD_EVALUASI_TIPE ');
        $rows = $query->result_array();
        
        $this->elements_conf['KODE_TIPE']['options'] = array();
		
        foreach ($rows as $v)
        {
			
		

			$this->elements_conf['KODE_TIPE']['options'][$v['KODE_TIPE']] = $v['NAMA_TIPE'];
        
		
		}
		 
    }
	
}	