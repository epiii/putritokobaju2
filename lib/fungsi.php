<?php
  include 'dbcon.php';

  function pr($par) {
    echo "<pre>";
      print_r($par);
    echo"</pre>";
    exit();
  }
  function vd($par) {
    echo "<pre>";
      var_dump($par);
    echo"</pre>";
    exit();
  }

  function getDataByParam($table,$par,$val){
    global $conn;
    // pr($conn);
    $whr = $val!=''?' WHERE '.$par.'="'.$val.'"':'';
    $s='SELECT * FROM '.$table.$whr.' ORDER BY '.$par.' ASC';
    // pr($s);
    $e=mysqli_query($conn,$s);
    $r=mysqli_fetch_assoc($e);
    return [
      'status'=>$e?'success':'failed to load data',
      'data'  =>$r
    ];
  }

  function getListByParam($table,$par,$val){
    global $conn;
    $whr = $val!=''?' WHERE '.$par.'="'.$val.'"':'';
    $s='SELECT * FROM '.$table.$whr.' ORDER BY '.$par.' ASC';
    $e=mysqli_query($conn,$s);
    $n=mysqli_num_rows($e);
    $data=[];
    // pr($s);

    while ($r=mysqli_fetch_assoc($e)){
      $data[]=$r;
    }
    $out= [
      'status'=>$e?'success':'failed to load data',
      'num'  =>$n,
      'data'  =>$data
    ];
    return $out;
  }

  function getNotifPeminjaman($tipe,$toko,$durasi){
    global $conn;
    $s = 'SELECT
              idPinjam,
              kode,
              status,
              toko1,
              toko2,
              merk,
              ukuran,
              jumlah,
              status,
              jenisBarang,
              date(tglPinjam)tgl_pinjam,
              curdate() tgl_skrg,
              abs(datediff(date(tglPinjam),date(curdate()))) selisih_hari
          FROM
              pinjam
          WHERE
              '.($tipe=='meminjam'?'toko2 = "'.$toko.'"':'toko1= "'.$toko.'"').'
              AND status="'.($tipe=='meminjam'?'approved':'pending').'"
              AND abs(datediff(date(tglPinjam),date(curdate())))<='.$durasi.'
          ORDER BY
              tgl_pinjam DESC
              ';
    // pr($tipe);
    // pr($s);
    $e=mysqli_query($conn,$s);
    $alerts='';

    while ($r=mysqli_fetch_assoc($e)) {
      // data-title="konfirmasi"
      if($tipe=='meminjam'){
        $color = 'success';
        $detailInfo = 'Toko <strong>'.$r['toko1'].'</strong> telah menyediakan barang dengan';
        $button = '<a href="#" class="btn btn-xs btn-success pull-rightx float-right"
            data-toggle="modal"
            data-target="#confirmModal"
            onclick="ambilBarang('.$r['idPinjam'].')"
            merk="'.$r['merk'].'",
            ukuran="'.$r['ukuran'].'",
            jumlah="'.$r['jumlah'].'"
            data-message="Anda yakin sudah mengambil
              (
                '.$r['jumlah'].'
                '.$r['jenisBarang'].',
                merk '.$r['merk'].',
                ukuran '.$r['ukuran'].'
              ) ke toko '.$r['toko1'].'
            ?"
            >
              ambil
            </a>';
      }
      else {
        $color = 'warning';
        $detailInfo = 'Toko <strong>'.$r['toko2'].'</strong> ingin meminjam';
        $button = '<a href="#" class="btn btn-xs btn-warning pull-rightx float-right"
            id="sediakan_'.$r['idPinjam'].'"
            data-toggle="modal"
            data-target="#formModal"
            onclick="formSediakanBarang('.$r['idPinjam'].')"
            jenisBarang="'.$r['jenisBarang'].'",
            merk="'.$r['merk'].'",
            ukuran="'.$r['ukuran'].'",
            jumlah="'.$r['jumlah'].'"
            >
              sediakan
            </a>
            <a  href="#"
                onclick="tolakPeminjaman('.$r['idPinjam'].');return false;"
                class="btn btn-secondary btn-xs float-right"

                data-toggle="modal"
                data-target="#confirmModal"
                onclick="tolak('.$r['idPinjam'].')"
                data-message="Anda yakin menolak permintaan
                  (
                    '.$r['jumlah'].'
                    '.$r['jenisBarang'].',
                    merk '.$r['merk'].',
                    ukuran '.$r['ukuran'].'
                  ) dr toko '.$r['toko2'].'
                ?"
            >
              Tolak
            </a>
            ';
      }

      $alerts.='<div id="idAlert_'.$r['idPinjam'].'" class="alert alert-'.$color.'" role="alert">
          '.$button.'
          '.$detailInfo.'
          jenis <b>'.$r['jenisBarang'].'</b>,
          merk <b>'.$r['merk'].'</b>,
          ukuran <b> '.$r['ukuran'].'</b>,
          sebanyak <b> '.$r['jumlah'].'</b>,
        </div>';
    } echo $alerts;
  }

?>
