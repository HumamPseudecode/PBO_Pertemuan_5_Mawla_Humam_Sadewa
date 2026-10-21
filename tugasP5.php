<?php

// IMPLEMENTASI INTERFACE
interface BisaDilacak {
    public function cekStatus(): string;
}

// IMPLEMENTASI ABSTRACT CLASS[cite: 9]
abstract class LayananLaundry {
    protected string $namaLayanan;
    protected float $hargaPerKg;

    public function __construct(string $namaLayanan, float $hargaPerKg) {
        $this->namaLayanan = $namaLayanan;
        $this->hargaPerKg = $hargaPerKg;
    }

    // Abstract method yang wajib diwujudkan subclass
    abstract public function hitungHarga(float $berat): float;

    public function getInfo(): string {
        return "Layanan: " . $this->namaLayanan;
    }
}

// INHERITANCE
class LayananReguler extends LayananLaundry {
    
    // OVERRIDING: Implementasi spesifik untuk Reguler
    public function hitungHarga(float $berat): float {
        return $this->hargaPerKg * $berat;
    }
}

class LayananExpress extends LayananLaundry {
    private float $biayaTambahan;

    public function __construct(string $namaLayanan, float $hargaPerKg, float $biayaTambahan) {
        parent::__construct($namaLayanan, $hargaPerKg);
        $this->biayaTambahan = $biayaTambahan;
    }

    // OVERRIDING[cite: 7]: Implementasi spesifik untuk Express
    public function hitungHarga(float $berat): float {
        return ($this->hargaPerKg * $berat) + $this->biayaTambahan;
    }
    
    // OVERRIDING
    public function getInfo(): string {
        return parent::getInfo() . " (KILAT)";
    }
}

// COMPOSITION & INTERFACE
class Pesanan implements BisaDilacak {
    private string $namaPelanggan;
    // Composition: Objek Pesanan tersusun dari objek LayananLaundry
    private array $daftarLayanan = []; 
    private string $status = "Diterima";

    public function __construct(string $namaPelanggan) {
        $this->namaPelanggan = $namaPelanggan;
    }

    public function tambahLayanan(LayananLaundry $layanan, float $berat): void {
        $this->daftarLayanan[] = [
            'layanan' => $layanan,
            'berat' => $berat
        ];
    }

    public function ubahStatus(string $statusBaru): void {
        $this->status = $statusBaru;
    }

    // Memenuhi kontrak Interface
    public function cekStatus(): string {
        return "Status cucian {$this->namaPelanggan}: {$this->status}";
    }

    public function cetakStruk(): void {
        echo "=== STRUK LAUNDRY: {$this->namaPelanggan} ===\n";
        $totalBiaya = 0;
        
        // POLYMORPHISM: 
        // Satu kontrak pemanggilan method (hitungHarga & getInfo), 
        // objek berbeda memberi perilaku berbeda tanpa if/else.
        foreach ($this->daftarLayanan as $item) {
            $objLayanan = $item['layanan'];
            $berat = $item['berat'];
            
            $harga = $objLayanan->hitungHarga($berat);
            $totalBiaya += $harga;
            
            echo $objLayanan->getInfo() . " | Berat: {$berat}kg | Rp" . number_format($harga, 0, ',', '.') . "\n";
        }
        
        echo "--------------------------------------\n";
        echo "Total Pembayaran: Rp" . number_format($totalBiaya, 0, ',', '.') . "\n";
    }
}

// --- JALANKAN PROGRAM ---
$pesanan = new Pesanan("Mawla Humam Sadewa");

$cuciReguler = new LayananReguler("Cuci Setrika", 6000);
$cuciExpress = new LayananExpress("Cuci Kering", 8000, 15000);

// Menambahkan objek layanan ke dalam pesanan (Composition)
$pesanan->tambahLayanan($cuciReguler, 3.5); 
$pesanan->tambahLayanan($cuciExpress, 2);   

$pesanan->ubahStatus("Sedang Dicuci");

echo $pesanan->cekStatus() . "\n\n";
$pesanan->cetakStruk();

?>