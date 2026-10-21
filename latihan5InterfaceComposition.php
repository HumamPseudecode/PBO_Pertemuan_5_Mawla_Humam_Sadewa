
<?php

class Buku {
    public string $judul;

    public function __construct(string $judul) {
        $this->judul = $judul;
    }

    public function caraAkses(): string {
        return "akses umum";
    }
}

// Interface untuk buku yang bisa dipinjam
interface BisaDipinjam {
    public function pinjam(): bool;
}

class BukuFisik extends Buku implements BisaDipinjam {
    public function caraAkses(): string {
        return "membaca buku cetak secara langsung";
    }

    public function pinjam(): bool {
        return true;
    }
}

class BukuDigital extends Buku implements BisaDipinjam {
    public function caraAkses(): string {
        return "membaca buku digital melalui perangkat elektronik";
    }

    public function pinjam(): bool {
        return true;
    }
}

// Function untuk menampilkan cara akses
function tampilkanAkses(Buku $buku): void {
    echo $buku->caraAkses() . PHP_EOL;
}

// Composition: keranjang menyimpan object yang bisa dipinjam
class KeranjangPinjaman {
    private array $items = [];

    public function tambah(BisaDipinjam $item): void {
        $this->items[] = $item;
    }

    public function tampilkanPinjaman(): void {
        foreach ($this->items as $item) {
            if ($item->pinjam()) {
                echo "Buku berhasil dipinjam." . PHP_EOL;
            } else {
                echo "Buku tidak dapat dipinjam." . PHP_EOL;
            }
        }
    }
}

// Membuat daftar buku
$daftar = [
    new BukuFisik("Laskar Pelangi"),
    new BukuDigital("Bumi"),
];

// Menampilkan judul dan cara akses
foreach ($daftar as $buku) {
    echo "Judul buku: " . $buku->judul . PHP_EOL;
    echo "Cara akses: ";
    tampilkanAkses($buku);
    echo PHP_EOL;
}

// Membuat keranjang pinjaman
$keranjang = new KeranjangPinjaman();

foreach ($daftar as $buku) {
    $keranjang->tambah($buku);
}

// Menampilkan status pinjaman
$keranjang->tampilkanPinjaman();

?>
