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
class Ep_pgd_evaluasi_model_detail extends MY_Model {

    public $table = "EP_PGD_EVALUASI_MODEL_DETAIL";
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'EVALUASI';
	
 
    public $elements_conf = array( 
								'KODE_EVALUASI' ,
								'ITEM',
                                                                'STATUS' => array(
                                                                    'type' => 'dropdown', 'options' => array(
                                                                        '0' => 'ADMINISTRASI',
                                                                        '1' => 'TEKNIS'
                                                                )),    
								'BOBOT' 
							);
			 
    public $columns_conf = array('KODE_EVALUASI' =>array('hidden'=>true, 'width'=>0) ,
								 'ITEM' =>array('hidden'=>false, 'width'=>80), 
								 'BOBOT'  =>array('hidden'=>false, 'width'=>10),								 
								 'PROSES'  =>array('hidden'=>false, 'width'=>10),
								 );
	
	
    public $sql_select = "(SELECT  
							E.KODE_EVALUASI ,
							E.ITEM,
							E.BOBOT, 
							 '' as \"PROSES\"
						  FROM 	 EP_PGD_EVALUASI_MODEL_DETAIL E 
						)";
	
  
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