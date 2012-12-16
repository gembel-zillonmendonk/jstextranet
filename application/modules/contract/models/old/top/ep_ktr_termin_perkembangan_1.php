
<?php

class ep_ktr_invoice_dok extends MY_Model {

    public $table = 'EP_KTR_INVOICE_DOK';
    public $elements_conf = array(
        'KODE_DOKUMEN',
        'KODE_INVOICE',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'KATEGORI',
        'KETERANGAN',
        'NAMA_FILE',
        'STATUS',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_invoice_item extends MY_Model {

    public $table = 'EP_KTR_INVOICE_ITEM';
    public $elements_conf = array(
        'KODE_ITEM',
        'KODE_INVOICE',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'NO_BASTP',
        'NILAI_BASTP',
        'MATA_UANG_BASTP',
        'PENALTI_BASTP',
        'PPH23_BASTP',
        'PPN_BASTP',
        'DP_BASTP',
        'SUBTOTAL_BASTP',
        'KETERANGAN_BASTP',
        'KOMENTAR_BASTP',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_invoice_komentar extends MY_Model {

    public $table = 'EP_KTR_INVOICE_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_INVOICE',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_jangka_komentar extends MY_Model {

    public $table = 'EP_KTR_JANGKA_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_JANGKA',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_jangka_kontrak extends MY_Model {

    public $table = 'EP_KTR_JANGKA_KONTRAK';
    public $elements_conf = array(
        'KODE_JANGKA',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
        'PERSENTASI_PERKEMBANGAN',
        'STATUS_PERKEMBANGAN',
        'NO_BASTP',
        'TGL_BASTP',
        'JUDUL_BASTP',
        'LAMPIRAN_BASTP',
        'TGL_BUAT_BASTP',
        'STATUS_BASTP',
        'POSISI_PERSETUJUAN',
        'DP_PERSENTASI',
        'KETERANGAN',
        'KETERANGAN_BASTP',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_jangka_perkembangan extends MY_Model {

    public $table = 'EP_KTR_JANGKA_PERKEMBANGAN';
    public $elements_conf = array(
        'KODE_PERKEMBANGAN',
        'KODE_JANGKA',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TGL_PERKEMBANGAN',
        'PERSENTASI',
        'STATUS',
        'KETERANGAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_kontrak extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_TENDER',
        'USER_PEMINTA',
        'JABATAN_PEMINTA',
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'TGL_TTD',
        'TGL_MULAI',
        'TGL_AKHIR',
        'TGL_BUAT',
        'JUDUL_PEKERJAAN',
        'TIPE_KONTRAK',
        'JENIS_KONTRAK',
        'PESANAN_ULANG',
        'MATA_UANG',
        'NILAI_KONTRAK',
        'PERIODE_BAYAR_SEWA',
        'UNIT_BAYAR_SEWA',
        'TERMIN_BAYAR_SEWA',
        'STATUS',
        'TGL_PEMUTUSAN',
        'POSISI_PERSETUJUAN',
        'JUMLAH_PERUBAHAN',
        'TGL_AKHIR_PENAWARAN',
        'NILAI_JAMINAN',
        'BANK_JAMINAN',
        'NO_JAMINAN',
        'TGL_MULAI_JAMINAN',
        'TGL_AKHIR_JAMINAN',
        'LAMPIRAN_JAMINAN',
        'UM_PERSENTASI',
        'UM_NILAI',
        'JABATAN_PEMBUAT',
        'ALASAN_PEMUTUSAN',
        'CATATAN_PEMUTUSAN',
        'LINGKUP_KERJA',
        'CATATAN',
        'DP_CATATAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_kontrak_dok extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_DOK';
    public $elements_conf = array(
        'KODE_DOKUMEN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_KATEGORI',
        'KETERANGAN',
        'NAMA_FILE',
        'STATUS',
        'STATUS_PUBLISH',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_kontrak_item extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_ITEM';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_kontrak_jaminan_pel extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_JAMINAN_PEL';
    public $elements_conf = array(
        'KODE_JAMINAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'NOMOR',
        'DIBUAT_OLEH',
        'TGL_BUAT',
        'TGL_KADALUARSA',
        'MATA_UANG',
        'NILAI',
        'LAMPIRAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_kontrak_komentar extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_kontrak_pemeriksaan extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_PEMERIKSAAN';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_PARAM',
        'NAMA_PARAM',
        'HASIL',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_kontrak_penutupan extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_PENUTUPAN';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KEPUTUSAN_MASALAH',
        'KEPUTUSAN_WAN',
        'ALASAN_PENUTUPAN',
        'PERNYATAAN_MASALAH',
        'PERNYATAAN_WAN',
        'EVAL_TENDER',
        'EVAL_PENYELESAIAN',
        'EVAL_PENGIRIMAN',
        'EVAL_KINERJA',
        'EVAL_PERNYATAAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_perubahan extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TGL_MULAI',
        'TGL_AKHIR',
        'MATA_UANG',
        'NILAI_KONTRAK',
        'STATUS',
        'POSISI_PERSETUJUAN',
        'TGL_PERUBAHAN',
        'KONTRAK_TIPE',
        'KONTRAK_TIPE_2',
        'NO_KONTRAK',
        'PERIODE_BAYAR_SEWA',
        'UNIT_BAYAR_SEWA',
        'TERMIN_BAYAR_SEWA',
        'KET_PERUBAHAN',
        'ALASAN_PERUBAHAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_perubahan_item extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_ITEM';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_perubahan_jaminan_pel extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_JAMINAN_PEL';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_JAMINAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'NOMOR',
        'DIBUAT_OLEH',
        'TGL_BUAT',
        'TGL_KADALUARSA',
        'MATA_UANG',
        'NILAI',
        'LAMPIRAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_perubahan_jangka extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_JANGKA';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_JANGKA',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
        'KETERANGAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_perubahan_komentar extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_PERUBAHAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_perubahan_termin extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_TERMIN';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TERMIN',
        'KETERANGAN',
        'PERSENTASI',
        'TGL_BAYAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_po extends MY_Model {

    public $table = 'EP_KTR_PO';
    public $elements_conf = array(
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'NAMA_PEMBUAT',
        'NAMA_LENGKAP_PEMBUAT',
        'POSISI_PEMBUAT',
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'MATA_UANG',
        'TGL_MULAI',
        'TGL_AKHIR',
        'TGL_BUAT',
        'CATATAN_PO',
        'TGL_PERSETUJUAN',
        'STATUS',
        'POSISI_PERSETUJUAN',
        'PERSENTASI_PERKEMBANGAN',
        'STATUS_PERKEMBANGAN',
        'NO_BASTP',
        'TGL_BASTP',
        'JUDUL_BASTP',
        'LAMPIRAN_BASTP',
        'TGL_BUAT_BASTP',
        'STATUS_BASTP',
        'TGL_PERSETUJUAN_BASTP',
        'KETERANGAN_BASTP',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_po_item extends MY_Model {

    public $table = 'EP_KTR_PO_ITEM';
    public $elements_conf = array(
        'KODE_PO_ITEM',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_po_item_perkembangan extends MY_Model {

    public $table = 'EP_KTR_PO_ITEM_PERKEMBANGAN';
    public $elements_conf = array(
        'KODE_ITEM_PERKEMBANGAN',
        'KODE_PERKEMBANGAN',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_PO_ITEM',
        'QTY_PERKEMBANGAN',
        'QTY_DISETUJUI',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_po_komentar extends MY_Model {

    public $table = 'EP_KTR_PO_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_po_perkembangan extends MY_Model {

    public $table = 'EP_KTR_PO_PERKEMBANGAN';
    public $elements_conf = array(
        'KODE_PERKEMBANGAN',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TGL_PERKEMBANGAN',
        'TGL_BUAT',
        'PEMBUAT',
        'NAMA_PEMBUAT',
        'STATUS',
        'PERSENTASI_PERKEMBANGAN',
        'POSISI_PERSETUJUAN',
        'KETERANGAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_termin_komentar extends MY_Model {

    public $table = 'EP_KTR_TERMIN_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_termin_kontrak extends MY_Model {

    public $table = 'EP_KTR_TERMIN_KONTRAK';
    public $elements_conf = array(
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TERMIN',
        'KETERANGAN',
        'PERSENTASI',
        'TGL_BAYAR',
        'PERSENTASI_PERKEMBANGAN',
        'STATUS_PERKEMBANGAN',
        'NO_BASTP',
        'TGL_BASTP',
        'JUDUL_BASTP',
        'LAMPIRAN_BASTP',
        'TGL_BUAT_BASTP',
        'STATUS_BASTP',
        'POSISI_PERSETUJUAN',
        'DP_PERSENTASI',
        'KETERANGAN_BASTP',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>
<?php

class ep_ktr_termin_perkembangan extends MY_Model {

    public $table = 'EP_KTR_TERMIN_PERKEMBANGAN';
    public $elements_conf = array(
        'KODE_PERKEMBANGAN',
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TGL_PERKEMBANGAN',
        'PERSENTASI',
        'STATUS',
        'KETERANGAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>