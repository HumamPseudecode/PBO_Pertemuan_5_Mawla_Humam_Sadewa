<?php

class buku {
    public string $judul;

    public function __construct(string $judul) {
        $this->judul = $judul;
    }

    public function caraAkses(): string {
        return "akses umum perpustakaan";
    }
}

// TODO 1: buat BukuFisik extends Buku
class BukuFisik extends buku {
    public function caraAkses(): string {
        return "membaca buku cetak secara langsung";
    }
}

// TODO 2: buat BukuDigital extends Buku
class BukuDigital extends buku {
    public function caraAkses(): string {
        return "membaca buku digital melalui perangkat elektronik";
    }
}

// TODO 3: override caraAkses()
// Sudah dilakukan pada class BukuFisik dan BukuDigital.

// TODO 4: buat 1 object masing-masing
$buku1 = new BukuFisik("Laskar Pelangi");
$buku2 = new BukuDigital("Bumi");

echo "Judul buku: " . $buku1->judul . "<br>";
echo "Cara akses: " . $buku1->caraAkses() . "<br>";

echo "<br>";

echo "Judul buku: " . $buku2->judul . "<br>";
echo "Cara akses: " . $buku2->caraAkses() . "<br>";

// todo 5 : polymorphism
function tampilkanCaraAkses(buku $buku): void {
    echo $buku->caraAkses() . "<br><br>";
}

$daftar = [
    new BukuFisik("Laskar Pelangi"),
    new BukuDigital("Bumi"),
];
foreach ($daftar as $buku) {
    echo " Judul buku: " . $buku->judul . "<br>";
    echo " Cara akses: ";
    tampilkanAkses($buku);
    echo "<br>";
}
?>