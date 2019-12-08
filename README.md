<p align="center">
    <h3 align="center">Skripsi Sistem Informasi Manajemen Inventaris Barang Sarana dan Prasarana</h3>
    <br>
</p>

Pengguna sistem:
- Petugas Sarpras
- Waka Sarpras

Fungsional sistem:
- CRUD Master Barang
- CRUD Pengajuan (CR untuk petugas, dan perlu adanya persetujuan UR dari waka)
- CRUD Transaksi Masuk
- CRUD Transaksi Keluar
- RU Peminjaman (dari Transaksi Keluar melakukan edit pada kolom: tanggal kembali untuk jenis barang: Tidak Habis pakai)
- Pengaturan Akur (ubah password)
- Login
- Logout
- Tampilan dashboard

yg belum:
- format rupiah (otomatis terdapat tanda titik, setalah x.000)
- sent email ke vendor
- history stok barang (transaksi masuk = +, transaksi keluar = -, dan peminjaman)
- sort by gridview (ada yg tidak bisa)
- cetak laporan (filter berdasrkan waktu, filter berdasarkan jenis barang, filter berdasarkan pilihan kertas =A4/F4)
- menampilkan modal (yii2 dan admin lte)
- filter data berdasarkan range date
- notifikasi ketika ada pengajuan dan persetujuan
