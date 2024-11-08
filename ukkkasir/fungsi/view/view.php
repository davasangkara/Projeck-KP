<?php
/*
* PROSES TAMPIL
*/
class view
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function member()
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function member_edit($id)
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member
                where member.id_member= ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    public function toko()
    {
        $sql = "select*from toko where id_toko='1'";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function kategori()
    {
        $sql = "select*from kategori";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function barang()
    {
        $sql = "select barang.*, 
                kategori.id_kategori, 
                kategori.nama_kategori,
                units.id as unit_id,
                units.name as unit_name
                from barang 
                inner join kategori on barang.id_kategori = kategori.id_kategori
                inner join units on barang.unit_id = units.id
                ORDER BY id DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function barang_stok()
    {
        $sql = "select barang.*, 
                kategori.id_kategori, 
                kategori.nama_kategori,
                units.id as unit_id,
                units.name as unit_name
                from barang 
                inner join kategori on barang.id_kategori = kategori.id_kategori
                inner join units on barang.unit_id = units.id
                where stok <= 3 
                ORDER BY id DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function barang_edit($id)
    {
        $sql = "select barang.*, 
                kategori.id_kategori, 
                kategori.nama_kategori,
                units.id as unit_id,
                units.name as unit_name
                from barang 
                inner join kategori on barang.id_kategori = kategori.id_kategori
                inner join units on barang.unit_id = units.id
                where id_barang=?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    // public function barang_cari($cari)
    // {
    //     $sql = "select barang.*, 
    //             kategori.id_kategori, 
    //             kategori.nama_kategori,
    //             units.id as unit_id,
    //             units.name as unit_name
    //             from barang 
    //             inner join kategori on barang.id_kategori = kategori.id_kategori
    //             inner join units on barang.unit_id = units.id
    //             where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
    //     $row = $this->db->prepare($sql);
    //     $row->execute();
    //     $hasil = $row->fetchAll();
    //     return $hasil;
    // }

    public function barang_cari($cari)
    {
        $sql = "SELECT transaksi.*, 
                barang.id,
                barang.merk,
                barang.nama_barang 
        FROM transaksi
        INNER JOIN barang ON transaksi.barang_id = barang.id
        WHERE barang.nama_barang LIKE ? OR barang.merk LIKE ?";

        $row = $this->db->prepare($sql);
        $row->execute(["%$cari%", "%$cari%"]);
        $hasil1 = $row->fetchAll();

        return $hasil1;
    }

    public function barang_id()
    {
        $sql = 'SELECT * FROM barang ORDER BY id DESC';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();

        $urut = substr($hasil['id_barang'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'BR00' . $tambah . '';
        } elseif (strlen($tambah) == 2) {
            $format = 'BR0' . $tambah . '';
        } else {
            $ex = explode('BR', $hasil['id_barang']);
            $no = (int) $ex[1] + 1;
            $format = 'BR' . $no . '';
        }
        return $format;
    }

    public function kategori_edit($id)
    {
        $sql = "select*from kategori where id_kategori=?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    public function kategori_row()
    {
        $sql = "select*from kategori";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
        return $hasil;
    }

    public function barang_row()
    {
        $sql = "select*from barang";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
        return $hasil;
    }

    public function barang_stok_row()
    {
        $sql = "SELECT SUM(stok) as jml FROM barang";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function barang_beli_row()
    {
        $sql = "SELECT SUM(harga_beli) as beli FROM barang";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jual_row()
    {
        $sql = "SELECT SUM(jumlah) as stok FROM nota";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jual()
    {
        $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
                member.nm_member from nota 
                left join barang on barang.id_barang=nota.id_barang 
                left join member on member.id_member=nota.id_member 
                where nota.periode = ?
                ORDER BY id_nota DESC";
        $row = $this->db->prepare($sql);
        $row->execute(array(date('m-Y')));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function periode_jual($periode)
    {
        $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
                member.nm_member from nota 
                left join barang on barang.id_barang=nota.id_barang 
                left join member on member.id_member=nota.id_member WHERE nota.periode = ? 
                ORDER BY id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array($periode));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function hari_jual($hari)
    {
        $ex = explode('-', $hari);
        $monthNum  = $ex[1];
        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        if ($ex[2] > 9) {
            $tgl = $ex[2];
        } else {
            $tgl1 = explode('0', $ex[2]);
            $tgl = $tgl1[1];
        }
        $cek = $tgl . ' ' . $monthName . ' ' . $ex[0];
        $param = "%{$cek}%";
        $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang,  barang.harga_beli, member.id_member,
                member.nm_member from nota 
                left join barang on barang.id_barang=nota.id_barang 
                left join member on member.id_member=nota.id_member WHERE nota.tanggal_input LIKE ? 
                ORDER BY id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array($param));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function penjualan()
    {
        $sql = "SELECT penjualan.* ,
                barang.id, 
                barang.nama_barang, 
                barang.type,
                barang.merk,
                member.id_member,
                member.nm_member from penjualan 
                left join barang on barang.id=penjualan.barang_id 
                left join member on member.id_member=penjualan.id_member
                ORDER BY id_penjualan";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function jumlah()
    {
        $sql = "SELECT SUM(total) as bayar FROM penjualan";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jumlah_nota()
    {
        $sql = "SELECT SUM(total) as bayar FROM nota";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function jml()
    {
        $sql = "SELECT SUM(harga_beli*stok) as byr FROM transaksi";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function getAllUnits()
    {
        $sql = "SELECT * FROM units";

        $row = $this->db->prepare($sql);
        $row->execute();

        $hasil = $row->fetchAll(PDO::FETCH_ASSOC);

        return $hasil;
    }

    public function getAllTransactionStockIn()
    {
        $sql = "select stok_transactions.*,
                barang.nama_barang,
                barang.merk,
                barang.type as barang_type
                from stok_transactions 
                inner join barang on stok_transactions.barang_id = barang.id
                where stok_transactions.type like 'IN'
                ";
        $row = $this->db->prepare($sql);
        $row->execute();

        $hasil = $row->fetchAll(PDO::FETCH_ASSOC);

        return $hasil;
    }

    public function getBarangStockTransaction()
    {
        $sql = "select transaksi.* ,
                barang.nama_barang,
                barang.type as barang_type,
                barang.merk
                from transaksi
                inner join barang on transaksi.barang_id = barang.id
        ";

        $row = $this->db->prepare($sql);

        $row->execute();

        $hasil = $row->fetchAll(PDO::FETCH_ASSOC);

        return $hasil;
    }

    public function getAllMasterBarang()
    {
        $sql = "select barang.*,
                kategori.id_kategori,
                kategori.nama_kategori,
                units.id as unit_id,
                units.name as unit_name
                from barang 
                inner join kategori on barang.id_kategori = kategori.id_kategori
                inner join units on barang.unit_id = units.id
        ";

        $row = $this->db->prepare($sql);

        $row->execute();

        $hasil = $row->fetchAll(PDO::FETCH_ASSOC);

        return $hasil;
    }

    public function getAllTransactionStockOut()
    {
        $sql = "select stok_transactions.*,
                barang.nama_barang,
                barang.merk,
                barang.type as barang_type
                from stok_transactions 
                inner join barang on stok_transactions.barang_id = barang.id
                where stok_transactions.type like 'OUT'
                ";
        $row = $this->db->prepare($sql);
        $row->execute();

        $hasil = $row->fetchAll(PDO::FETCH_ASSOC);

        return $hasil;
    }
}
