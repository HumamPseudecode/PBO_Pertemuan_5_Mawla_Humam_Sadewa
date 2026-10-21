
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

class BukuFisik extends Buku {
    public function caraAkses(): string {
        return "membaca buku cetak secara langsung";
    }
}

class BukuDigital extends Buku {
    public function caraAkses(): string {
        return "membaca buku digital melalui perangkat elektronik";
    }
}

// Function untuk menampilkan cara akses
function tampilkanAkses(Buku $buku): void {
    echo $buku->caraAkses() . "<br>";
}

// Membuat daftar buku
$daftar = [
    new BukuFisik("Laskar Pelangi"),
    new BukuDigital("Bumi"),
];

// Menampilkan judul dan cara akses
foreach ($daftar as $buku) {
    echo "Judul buku: " . $buku->judul . "<br>";
    echo "Cara akses: ";
    tampilkanAkses($buku);
    echo "<br>";
}

?>
