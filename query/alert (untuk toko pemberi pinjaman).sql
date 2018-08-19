select 
    idPinjam,
    kode,
    status,
    date(tglPinjam)tgl_pinjam,
    curdate() tgl_skrg,  	
    abs(datediff(date(tglPinjam),date(curdate()))) selisih_hari
from 
    pinjam
where
	toko2 = "A" and 
	status = "pending" and
	abs(datediff(date(tglPinjam),date(curdate())))<=7