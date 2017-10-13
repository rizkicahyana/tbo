drop database db_tbo;

create database db_tbo;

use db_tbo;

create table level(
	nomor_level int auto_increment,
	nama_level varchar(15) not null,
	level_user int not null,
	constraint pk_nomor_level primary key(nomor_level),
	constraint uniq_nama_level unique(nama_level),
	constraint uniq_level_user unique(level_user)
);

insert into level values
(null, 'Administrator', 1),
(null, 'Member', 2);

create table akun(
	id_akun int auto_increment,
	email varchar(50) not null,
	username varchar(30) not null,
	password varchar(255) not null,
	nomor_level int not null,
	status_akun varchar(15) not null,
	nama varchar(20) not null,
	alamat text,
	nomor_telepon varchar(12),
	constraint pk_id_akun primary key(id_akun),
	constraint uniq_email_akun unique(email),
	constraint uniq_username unique(username),
	constraint uniq_nomor_telepon_akun unique(nomor_telepon),
	constraint fk_nomor_level foreign key(nomor_level) references level(nomor_level),
	constraint chk_status_akun check(status_akun in('Pending', 'Aktif'))
);

create table kategori(
	id_kategori int auto_increment,
	nama_kategori varchar(30) not null,
	deskripsi text not null,
	constraint pk_id_kategori primary key(id_kategori),
	constraint uniq_nama_kategori unique(nama_kategori)
);

create table penerbit(
	id_penerbit int auto_increment,
	nama_penerbit varchar(30) not null,
	alamat text not null,
	email varchar(50) not null,
	website varchar(50) not null,
	nomor_telepon varchar(12) not null,
	constraint pk_id_penerbit primary key(id_penerbit),
	constraint uniq_nama_penerbit unique(nama_penerbit),
	constraint uniq_email_penerbit unique(email),
	constraint uniq_website_penerbit unique(website),
	constraint uniq_nomor_telepon_penerbit unique(nomor_telepon)
);

create table buku(
	id_buku int auto_increment,
	id_kategori int not null,
	id_penerbit int not null,
	judul_buku varchar(50) not null,
	nomor_isbn varchar(30) not null,
	deskripsi_buku text not null,
	harga_buku int not null,
	penulis_buku varchar(50) not null,
	jumlah_halaman_buku int not null,
	tahun_terbit_buku year not null,
	stok_buku int not null,
	gambar_buku varchar(255),
	tgl_dan_waktu datetime not null,
	constraint pk_id_buku primary key(id_buku),
	constraint fk_id_kategori_buku foreign key(id_kategori) references kategori(id_kategori),
	constraint fk_id_penerbit_buku foreign key(id_penerbit) references penerbit(id_penerbit),
	constraint chk_harga_buku check(harga_buku>0),
	constraint chk_jumlah_halaman_buku check(jumlah_halaman_buku>0),
	constraint chk_tahun_terbit_buku check(tahun_terbit_buku between '1900' and '2015'),
	constraint chk_stok_buku check(stok_buku>0)
);

create table keranjang(
	id_keranjang int auto_increment,
	id_buku int,
	id_session varchar(255) not null,
	jumlah_item int not null,
	subtotal_harga int not null,
	constraint pk_id_keranjang primary key(id_keranjang),
	constraint chk_jumlah_item_keranjang check(jumlah_item>0),
	constraint chk_subtotal_harga_keranjang check(subtotal_harga>0)
);

create table transaksi(
	id_transaksi int auto_increment,
	tanggal_transaksi timestamp not null,
	id_akun int,
	total_transaksi int not null,
	status_transaksi varchar(15) not null,
	constraint pk_id_transaksi primary key(id_transaksi),
	constraint fk_id_akun foreign key(id_akun) references akun(id_akun) on delete set null,
	constraint chk_total_transaksi check(total_transaksi>0),
	constraint chk_status_transaksi check(status_transaksi in('Lunas', 'Belum Lunas'))
);

create table detail_transaksi(
	id_detail_transaksi int auto_increment,
	id_transaksi int,
	id_buku int,
	jumlah_item int not null,
	constraint pk_id_detail_transaksi primary key(id_detail_transaksi),
	constraint fk_id_buku_detail foreign key(id_buku) references buku(id_buku) on delete set null,
	constraint chk_jumlah_item_detail check(jumlah_item>0),
	constraint chk_total_harga_detail check(total_harga>0)
);

create table konfirmasi_transaksi(
	id_konfirmasi int auto_increment,
	tanggal_konfirmasi date not null,
	id_transaksi int,
	nomor_rekening varchar(15) not null,
	nama_pemegang_rekening varchar(30) not null,
	nominal int not null,
	constraint pk_id_konfirmasi primary key(id_konfirmasi),
	constraint fk_id_transaksi foreign key(id_transaksi) references transaksi(id_transaksi) on delete set null,
	constraint chk_nominal check(nominal>0)
);