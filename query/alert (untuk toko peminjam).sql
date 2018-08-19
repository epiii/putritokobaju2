SELECT
  	idPinjam,
  	kode,
  	status,
  	date(tglPinjam)tgl_pinjam,
    curdate() tgl_skrg,  	
	abs(datediff(date(tglPinjam),date(curdate()))) selisih_hari
FROM
  	pinjam 
WHERE
  	toko1 = "B"
  	AND status = "approved" 
	AND abs(datediff(date(tglPinjam),date(curdate())))<=7
ORDER BY
    tgl_pinjam asc