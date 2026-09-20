const form = document.getElementById('healthForm');
const hasilBox = document.getElementById('hasil');
const hitungBtn = document.getElementById('hitungBtn');
const resetBtn = document.getElementById('resetBtn');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    hitungKesehatan();
});

resetBtn.addEventListener('click', function() {
    hasilBox.style.display = 'none';
    hasilBox.classList.remove('show');
    document.querySelectorAll('input').forEach(input => {
        input.classList.remove('error');
    });
});

function hitungKesehatan() {
    const nama = document.getElementById('nama').value.trim();
    const usia = parseFloat(document.getElementById('usia').value);
    const jenisKelamin = document.getElementById('jenisKelamin').value;
    const tinggi = parseFloat(document.getElementById('tinggi').value);
    const berat = parseFloat(document.getElementById('berat').value);
    const aktivitas = parseFloat(document.getElementById('aktivitas').value);
    if (!validasiInput(nama, usia, jenisKelamin, tinggi, berat, aktivitas)) {
        return;
    }
    const bmi = hitungBMI(berat, tinggi);
    const kategoriBMI = tentukanKategoriBMI(bmi);
    const kalori = hitungKalori(berat, tinggi, usia, jenisKelamin, aktivitas);
    tampilkanHasil(nama, bmi, kategoriBMI, kalori);
    hasilBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function validasiInput(nama, usia, jenisKelamin, tinggi, berat, aktivitas) {
    let valid = true;

    document.querySelectorAll('input, select').forEach(el => {
        el.classList.remove('error');
    });
    if (!nama) {
        document.getElementById('nama').classList.add('error');
        valid = false;
    }
    if (!usia || usia < 1 || usia > 100) {
        document.getElementById('usia').classList.add('error');
        alert('Usia harus antara 1-100 tahun!');
        valid = false;
    }
    if (!jenisKelamin) {
        document.getElementById('jenisKelamin').classList.add('error');
        valid = false;
    }
    if (!tinggi || tinggi < 50 || tinggi > 250) {
        document.getElementById('tinggi').classList.add('error');
        alert('Tinggi badan harus antara 50-250 cm!');
        valid = false;
    }
    if (!berat || berat < 20 || berat > 300) {
        document.getElementById('berat').classList.add('error');
        alert('Berat badan harus antara 20-300 kg!');
        valid = false;
    }
    if (!aktivitas) {
        document.getElementById('aktivitas').classList.add('error');
        valid = false;
    }
    return valid;
}

function hitungBMI(berat, tinggiCm) {
    const tinggiM = tinggiCm / 100;
    const bmi = berat / (tinggiM * tinggiM);
    return bmi.toFixed(1);
}

function tentukanKategoriBMI(bmi) {
    bmi = parseFloat(bmi);
    
    if (bmi < 18.5) {
        return {
            kategori: 'Kekurangan Berat Badan (Underweight)',
            class: 'underweight'
        };
    } else if (bmi >= 18.5 && bmi < 25) {
        return {
            kategori: 'Berat Badan Normal',
            class: 'normal'
        };
    } else if (bmi >= 25 && bmi < 30) {
        return {
            kategori: 'Kelebihan Berat Badan (Overweight)',
            class: 'overweight'
        };
    } else {
        return {
            kategori: 'Obesitas',
            class: 'obese'
        };
    }
}

function hitungKalori(berat, tinggi, usia, jenisKelamin, aktivitas) {
    let bmr;
    if (jenisKelamin === 'laki-laki') {
        bmr = (10 * berat) + (6.25 * tinggi) - (5 * usia) + 5;
    } else {
        bmr = (10 * berat) + (6.25 * tinggi) - (5 * usia) - 161;
    }
    const tdee = bmr * aktivitas;
    return Math.round(tdee);
}

function tampilkanHasil(nama, bmi, bmiData, kalori) {
    hasilBox.style.display = 'block';
    hasilBox.classList.add('show');
    document.getElementById('resultNama').textContent = nama;
    document.getElementById('resultBMI').textContent = bmi;
    const kategoriEl = document.getElementById('kategoriBMI');
    kategoriEl.textContent = bmiData.kategori;
    kategoriEl.className = `kategori ${bmiData.class}`;
    document.getElementById('resultKalori').textContent = `${kalori} kkal/hari`;
    generateRekomendasi(bmiData.class, kalori);
}

function generateRekomendasi(kategoriBMI, kalori) {
    const rekomendasiList = document.getElementById('rekomendasiList');
    rekomendasiList.innerHTML = '';
    let rekomendasi = [];
    switch(kategoriBMI) {
        case 'underweight':
            rekomendasi = [
                'Konsumsi makanan tinggi kalori dan protein',
                'Makan lebih sering (5-6 kali sehari)',
                'Lakukan latihan beban untuk menambah massa otot',
                'Tambahkan camilan sehat di antara waktu makan',
                'Konsultasi dengan ahli gizi jika diperlukan'
            ];
            break;
        
        case 'normal':
            rekomendasi = [
                'Pertahankan pola makan seimbang',
                'Olahraga teratur minimal 30 menit/hari',
                'Perbanyak konsumsi sayur dan buah',
                'Minum air putih minimal 8 gelas/hari',
                'Tidur cukup 7-8 jam per hari'
            ];
            break;
        
        case 'overweight':
            rekomendasi = [
                'Kurangi makanan tinggi lemak dan gula',
                'Perbanyak konsumsi serat (sayur dan buah)',
                'Lakukan cardio minimal 150 menit/minggu',
                'Kontrol porsi makan',
                'Hindari makan larut malam'
            ];
            break;
        
        case 'obese':
            rekomendasi = [
                'Segera konsultasi dengan dokter/ahli gizi',
                'Program penurunan berat badan terkontrol',
                'Hindari makanan cepat saji dan processed food',
                'Olahraga intensitas sedang secara rutin',
                'Monitor berat badan setiap minggu'
            ];
            break;
    }

    rekomendasi.push(`Kebutuhan kalori Anda: ${kalori} kkal/hari`);
    rekomendasi.push('Untuk turun berat badan: kurangi 500 kkal/hari');
    rekomendasi.push('Untuk naik berat badan: tambah 500 kkal/hari');

    rekomendasi.forEach(item => {
        const li = document.createElement('li');
        li.textContent = item;
        rekomendasiList.appendChild(li);
    });
}

console.log('Kalkulator BMI & Kalori siap digunakan!');
console.log('Mini Project Kelompok 2');