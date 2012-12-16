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
class Ep_pgd_pekerjaan extends MY_Model {

    
  
    public $table = "EP_PGD_KOMENTAR_TENDER";
    //public $table = "EP_NOMORURUT";
    
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'PERENCANAAN';
		
	
    public $elements_conf = array('KODE_KOMENTAR', 
			'KODE_KANTOR'  => array('type' => 'dropdown', 'options' => array()),
			 'JUDUL_PEKERJAAN',  
			 'LINGKUP_PEKERJAAN',
			 'RENCANA_KEBUTUHAN',  
			 'RENCANA_PELAKSANAAN',  
			 'SWAKELOLA' => array(
            'type' => 'dropdown', 'options' => array(
                '0' => 'TIDAK',
                '1' => 'YA'
        )) );
		
		
    public $columns_conf = array('KODE_KOMENTAR' =>array('hidden'=>true, 'width'=>0) 
                        ,'KODE_TENDER' =>array('hidden'=>false, 'width'=>10)  
                        ,'KODE_KANTOR' =>array('hidden'=>false, 'width'=>10) 
                        , 'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>20) 
                        ,'STATUS' =>array('hidden'=>false, 'width'=>20) 
                        ,'NAMA_KANTOR' =>array('hidden'=>false, 'width'=>20) 
                        ,'NAMA_JABATAN' =>array('hidden'=>false, 'width'=>20) 
                        ,'PROSES' =>array('hidden'=>false, 'width'=>7) 
					
        );
	
	
    public $sql_select = "(SELECT P.KODE_KOMENTAR
                , P.KODE_TENDER 
                , P.KODE_KANTOR
                , K.NAMA_KANTOR
                , T.JUDUL_PEKERJAAN 
                , P.NAMA_AKTIFITAS AS STATUS
                , P.NAMA_JABATAN
                ,'' as \"PROSES\"
		FROM EP_PGD_KOMENTAR_TENDER P
		LEFT JOIN MS_KANTOR K ON P.KODE_KANTOR = K.KODE_KANTOR
		LEFT JOIN EP_PGD_TENDER T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR 
                WHERE TGL_BERAKHIR IS NULL  
                )";
     
    function __construct() {
        parent::__construct();
        $this->init();
		$this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnProsesPekerjaan(\'"+cl+"\');\"  >PROSES</button>"; 
				 	
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{PROSES:be});
		}
		
 
		
		';    
    }

}

?>
