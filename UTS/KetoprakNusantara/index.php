<!DOCTYPE html>
<html lang="id">
<?php
  include("includes\config.php");
  include("includes\session.php");
  $foodlist = $conn->query("SELECT * FROM foodlist");
  $drinklist = $conn->query("SELECT * FROM drinklist");
  $itemlist = $conn->query("SELECT * FROM tempcheckout");
  if ($login) {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }
  }
  if (isset($_POST['Simpan'])) {
    $ID = $_POST['itemid'];
    $QTY = $_POST['quantity'];
    $NAME = implode(mysqli_fetch_assoc($conn->query("SELECT foodName AS itemname FROM foodlist WHERE foodID = '$ID' UNION ALL SELECT drinkName AS itemname FROM drinklist WHERE drinkID = '$ID'")));
    $TOTAL = implode(mysqli_fetch_assoc($conn->query("SELECT price FROM foodlist WHERE foodID = '$ID' UNION ALL SELECT price FROM drinklist WHERE drinkID = '$ID'")));
    
    if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tempcheckout WHERE itemID = '$ID'")) < 1) {
      mysqli_query($conn,"INSERT INTO tempcheckout VALUES('$ID', '$NAME', '$QTY', '$TOTAL')");
    } else {
      mysqli_query($conn,"UPDATE tempcheckout SET quantity = quantity + '$QTY' WHERE itemID = '$ID'");
    }
    header("location:index.php");
  }
  if (isset($_POST['Bayar'])) {
    mysqli_query( $conn,'DELETE FROM tempcheckout'); //placeholder
    header("location:index.php");
  }
  if (isset($_POST['Remove'])) {
    $ID = $_POST['itemsid'];
    mysqli_query( $conn,"DELETE FROM tempcheckout WHERE itemID = '$ID' ");
    header("location:index.php");
  }
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ketoprak Nusantara — Cita Rasa Nusantara</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark kn-navbar sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
        <i class="bi bi-cup-hot-fill me-2 fs-4"></i>
        Ketoprak Nusantara
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="#beranda">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#faq">Pesanan</a></li>
          <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="beranda">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active kn-carousel-item">
          <img src="img/carousel1.jpg" class="d-block w-100" alt="Hero 1">
          <div class="kn-carousel-overlay d-flex align-items-center justify-content-center text-center">
            <div class="container">
              <h1 class="display-4 fw-bold text-white mb-3">Cita Rasa Bumbu Kacang Autentik</h1>
              <p class="lead text-white-50 mb-4">Ketoprak tradisional dengan resep turun-temurun, disajikan segar dengan lontong pulen, tauge renyah, dan siraman bumbu kacang yang gurih.</p>
              <a href="#menu" class="btn btn-lg kn-btn-primary rounded-pill px-4">Lihat Menu</a>
            </div>
          </div>
        </div>
        <div class="carousel-item kn-carousel-item">
          <img src="img/carousel2.jpg" class="d-block w-100" alt="Hero 2">
          <div class="kn-carousel-overlay d-flex align-items-center justify-content-center text-center">
            <div class="container">
              <h1 class="display-4 fw-bold text-white mb-3">Promo Spesial Minggu Ini</h1>
              <p class="lead text-white-50 mb-4">Diskon 20% untuk semua menu ketoprak</p>
              <a href="#menu" class="btn btn-lg kn-btn-primary rounded-pill px-4">Pesan Sekarang</a>
            </div>
          </div>
        </div>
        <div class="carousel-item kn-carousel-item">
          <img src="img/carousel3.jpg" class="d-block w-100" alt="Hero 3">
          <div class="kn-carousel-overlay d-flex align-items-center justify-content-center text-center">
            <div class="container">
              <h1 class="display-4 fw-bold text-white mb-3">Ketoprak pilihan #1</h1>
              <p class="lead text-white-50 mb-4">Placeholder</p>
              <a href="#tentang" class="btn btn-lg kn-btn-primary rounded-pill px-4">Tentang Kami</a>
            </div>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

  <section id="menu" class="py-5 kn-section-menu">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold kn-heading">Menu Ketoprak</h2>
        <p class="text-muted">Pilihan ketoprak terbaik dari seluruh Nusantara</p>
      </div>

      <div class="row g-4">
        <?php while($row = mysqli_fetch_array($foodlist)) { ?>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card kn-card h-100 shadow-sm rounded-3 border-0" data-bs-toggle="modal" data-bs-target="#<?php echo $row['foodID'] ?>" style="cursor:pointer;">
            <img src="img\<?php echo $row['foodIMG'] ?>" class="card-img-top kn-card-img" alt="<?php echo $row['foodName'] ?>" />
            <div class="card-body text-center p-4">
              <h5 class="card-title fw-bold"><?php echo $row['foodName'] ?></h5>
              <p class="card-text text-muted"><?php echo $row['foodDesc']?></p>
              <p class="kn-price fw-bold">Rp. <?php echo number_format($row['price']) ?></p>
            </div>
          </div>
        </div>

        <div class="modal fade" id="<?php echo $row['foodID'] ?>" tabindex="-1" aria-labelledby="<?php echo $row['foodID'] ?>Label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content kn-modal-content border-0 rounded-4 overflow-hidden">
              <img src="img\<?php echo $row['foodIMG'] ?>" class="img-fluid" alt="<?php echo $row['foodName'] ?>" />
              <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="<?php echo $row['foodID'] ?>Label"><?php echo $row['foodName'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="text-muted"><?php echo $row['foodDesc'] ?></p>
                <!-- <ul class="list-unstyled text-muted small">
                  <li><i class="bi bi-geo-alt me-1 kn-text-primary"></i> Asal: Toraja, Sulawesi Selatan</li>
                  <li><i class="bi bi-bar-chart me-1 kn-text-primary"></i> Roast Level: Medium</li>
                  <li><i class="bi bi-cup-straw me-1 kn-text-primary"></i> Notes: Herbal, Spicy, Dark Chocolate</li>
                </ul> -->
                <h5 class="kn-price fw-bold mt-3">Rp. <?php echo number_format($row['price']) ?></h5>
              </div>
              <div class="modal-footer border-0">
                <form method="POST">
                  <input type="hidden" id="itemid" name="itemid" value="<?php echo $row['foodID']?>">
                  <input type="number" class="form-control text-center quantity-input mb-3" id="quantity" name="quantity" value="1" min="1" style="width: 160px;">
                  <input type="submit" class="btn kn-btn-primary rounded-pill px-4" name="Simpan" value="Pesan Sekarang">
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <section id="menu" class="py-5 kn-section-menu">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold kn-heading">Menu Minuman</h2>
        <p class="text-muted">Pilihan ketoprak terbaik dari seluruh Nusantara</p>
      </div>

      <div class="row g-4">
        <?php while($row = mysqli_fetch_array($drinklist)) { ?>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card kn-card h-100 shadow-sm rounded-3 border-0" data-bs-toggle="modal" data-bs-target="#<?php echo $row['drinkID']?>" style="cursor:pointer;">
            <img src="img\<?php echo $row['drinkIMG'] ?>" class="card-img-top kn-card-img" alt="<?php echo $row['drinkName'] ?>" />
            <div class="card-body text-center p-4">
              <h5 class="card-title fw-bold"><?php echo $row['drinkName'] ?></h5>
              <p class="card-text text-muted"><?php echo $row['drinkDesc']?></p>
              <p class="kn-price fw-bold">Rp. <?php echo number_format($row['price']) ?></p>
            </div>
          </div>
        </div>

        <div class="modal fade" id="<?php echo $row['drinkID'] ?>" tabindex="-1" aria-labelledby="<?php echo $row['drinkID'] ?>Label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content kn-modal-content border-0 rounded-4 overflow-hidden">
              <img src="img\<?php echo $row['drinkIMG'] ?>" class="img-fluid" alt="<?php echo $row['drinkName'] ?>" />
              <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="<?php echo $row['drinkID'] ?>Label"><?php echo $row['drinkName'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="text-muted"><?php echo $row['drinkDesc'] ?></p>
                <!-- <ul class="list-unstyled text-muted small">
                  <li><i class="bi bi-geo-alt me-1 kn-text-primary"></i> Asal: Toraja, Sulawesi Selatan</li>
                  <li><i class="bi bi-bar-chart me-1 kn-text-primary"></i> Roast Level: Medium</li>
                  <li><i class="bi bi-cup-straw me-1 kn-text-primary"></i> Notes: Herbal, Spicy, Dark Chocolate</li>
                </ul> -->
                <h5 class="kn-price fw-bold mt-3">Rp. <?php echo number_format($row['price']) ?></h5>
              </div>
              <div class="modal-footer border-0">
                <form method="POST">
                  <input type="hidden" id="itemid" name="itemid" value="<?php echo $row['drinkID']?>">
                  <input type="number" class="form-control text-center quantity-input mb-3" id="quantity" name="quantity" value="1" min="1" style="width: 160px;">
                  <input type="submit" class="btn kn-btn-primary rounded-pill px-4" name="Simpan" value="Pesan Sekarang">
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <section id="tentang" class="py-5 kn-section-tentang">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-12 col-lg-6 text-center">
          <img src="img/about.jpg" alt="Tentang Ketoprak Nusantara" class="img-fluid rounded-4 shadow" />
        </div>
        <div class="col-12 col-lg-6">
          <h2 class="fw-bold kn-heading mb-3">Tentang Ketoprak Nusantara</h2>
          <p class="text-muted mb-3">
            <strong>Ketoprak</strong> adalah salah satu kuliner khas Indonesia yang lahir dari kesederhanaan dan kaya akan cita rasa. Di Ketoprak Nusantara, kami menghadirkan sajian ini dengan perhatian pada kualitas bahan, keseimbangan rasa, dan pengalaman menikmati makanan.
          </p>
          <p class="text-muted mb-4">
            Mulai dari tahu yang lembut, tauge segar, bihun, lontong, hingga saus kacang khas yang menjadi karakter utama—setiap elemen dipersiapkan untuk menciptakan rasa yang familiar sekaligus berkesan.
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <div class="text-center p-3 bg-white rounded-3 shadow-sm kn-stat-box">
              <h4 class="fw-bold kn-text-primary mb-0">20+</h4>
              <small class="text-muted">Branch</small>
            </div>
            <div class="text-center p-3 bg-white rounded-3 shadow-sm kn-stat-box">
              <h4 class="fw-bold kn-text-primary mb-0">100K+</h4>
              <small class="text-muted">Ketoprak Terjual</small>
            </div>
            <div class="text-center p-3 bg-white rounded-3 shadow-sm kn-stat-box">
              <h4 class="fw-bold kn-text-primary mb-0">4.8</h4>
              <small class="text-muted">Rating</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="faq" class="py-5 kn-section-faq">
    <div class="container">
      <?php if($login) { ?>
      <?php if(mysqli_num_rows($itemlist) < 1) { ?>
        <div class="text-center mb-5">
          <h2 class="fw-bold kn-heading">Sudah selesai memesan?</h2>
          <p class="text-muted">Belum ada produk yang dibeli, klik salah satu menu dan tekan "Pesan Sekarang"!</p>
        </div>
        <?php } else { ?>
        <div class="text-center mb-5">
          <h2 class="fw-bold kn-heading">Sudah selesai memesan?</h2>
          <p class="text-muted">Tekan tombol dibawah ini untuk memulai proses pembayaran!</p>
        </div>

        <div class="row justify-content-center">
          <table class="table">
            <thead>
              <td>ID Produk</td>
              <td>Nama Produk</td>
              <td>Harga</td>
              <td>Jumlah</td>
              <td>Total</td>
              <td>Remove</td>
            </thead>
            <tbody>
              <?php $total = 0 ?>
              <?php while($row = mysqli_fetch_array($itemlist)) { ?>
                <?php $total = $total + ($row['price']*$row['quantity']) ?>
                <tr>
                  <td><?php echo $row['itemID'] ?></td>
                  <td><?php echo $row['itemName'] ?></td>
                  <td><?php echo $row['price'] ?></td>
                  <td><?php echo number_format($row['quantity']) ?></td>
                  <td>Rp. <?php echo number_format($row['price']*$row['quantity']) ?></td>
                  <td>
                    <form method="POST">
                      <input type="hidden" id="itemsid" name="itemsid" value="<?php echo $row['itemID'] ?>" readonly>
                      <input type="submit" class="btn kn-btn-primary rounded-pill px-4" name="Remove" value="Remove">
                    </form>
                  </td>
                </tr>
              <?php } ?>
                <tr>
                  <td colspan="4">Grand Total</td>
                  <td colspan="2">Rp. <?php echo number_format($total) ?></td>
                </tr>
            </tbody>
          </table>
          <button type="button" class="btn kn-btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#checkout">Checkout</button>
        </div>
        <?php } ?>
      <?php } else { ?>
      <div class="text-center mb-5">
        <h2 class="fw-bold kn-heading">Sudah selesai memilih makanan yang mau dipesan?</h2>
        <p class="text-muted">Ayo login untuk memilih dan membeli!</p>
        <!-- <div class="col-12 col-lg-8">
          <div class="accordion kn-accordion" id="faqAccordion">

            <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button kn-accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                  Dari mana saja biji kopi Kopi Nusantara berasal?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                  Kami mengambil biji kopi langsung dari petani di berbagai daerah Indonesia, antara lain Gayo (Aceh), Toraja (Sulawesi Selatan), Kintamani (Bali), Bajawa (Flores, NTT), dan Wamena (Papua). Setiap daerah memiliki karakteristik rasa yang unik.
                </div>
              </div>
            </div>

            <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button kn-accordion-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                  Apakah bisa pesan untuk delivery?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                  Ya! Kami bekerja sama dengan GoFood, GrabFood, dan ShopeeFood. Anda juga bisa memesan langsung melalui WhatsApp kami di nomor 0812-3456-7890 untuk area sekitar kedai.
                </div>
              </div>
            </div>

            <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button kn-accordion-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                  Apakah tersedia opsi non-kopi?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                  Tentu saja! Kami menyediakan Matcha Latte, Cokelat Panas, Thai Tea, dan berbagai minuman non-kopi lainnya yang tak kalah lezat.
                </div>
              </div>
            </div>

            <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button kn-accordion-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                  Jam operasional Kopi Nusantara?
                </button>
              </h2>
              <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                  Kami buka setiap hari dari pukul 07.00 - 22.00 WIB. Untuk hari libur nasional, jam operasional mungkin menyesuaikan. Silakan cek media sosial kami untuk informasi terbaru.
                </div>
              </div>
            </div>

          </div>
        </div> -->
      </div>
      <?php }?>
    </div>
  </section>

  <div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="checkoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content kn-modal-content border-0 rounded-4 overflow-hidden">
        <img src="img\carousel1.jpg" class="img-fluid" alt="pembayaran" />
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold" id="checkoutLabel">Total Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="kn-price fw-bold mt-3">Rp. <?php echo number_format($total) ?></h5>
          <form method="POST" id="bayarform">
            <label for="emailbf">Email</label>
            <input type="email" id="emailbf" class="form-control" placeholder="Email anda" required>
            <label for="alamatbf">Alamat</label>
            <input type="text" id="alamatbf" class="form-control" placeholder="Alamat anda" required>
            <div class="form-group">
              <label for="methodbf">Metode pembayaran</label>
              <select class="form-control" id="methodbf">
                <option>Bank</option>
                <option>OVO</option>
                <option>DANA</option>
                <option>GoPay</option>
                <option>Cash</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn kn-btn-primary rounded-pill px-4" form="bayarform" id="Bayar" name="Bayar">Bayar sekarang</button>
        </div>
      </div>
    </div>
  </div>

  <footer id="kontak" class="kn-footer py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-12 col-md-4 text-center text-md-start">
          <h5 class="fw-bold text-white mb-3">
            <i class="bi bi-cup-hot-fill me-2"></i>Ketoprak Nusantara
          </h5>
          <p class="text-white-50 small">
            Menghadirkan cita rasa ketoprak terbaik dari berbagai penjuru Nusantara ke dalam setiap mangkok yang kami sajikan.
          </p>
        </div>
        <div class="col-12 col-md-4 text-center">
          <h5 class="fw-bold text-white mb-3">Jam Operasional</h5>
          <ul class="list-unstyled text-white-50 small">
            <li>Senin s/d Minggu: 06:00AM - 10:00PM</li>
          </ul>
        </div>
        <div class="col-12 col-md-4 text-center text-md-end">
          <h5 class="fw-bold text-white mb-3">Hubungi Kami</h5>
          <ul class="list-unstyled text-white-50 small">
            <li><i class="bi bi-geo-alt-fill me-1"></i> Jl. Koprak No. 5, Jakarta Pusat</li>
            <li><i class="bi bi-telephone-fill me-1"></i> 0812-3456-7890</li>
            <li><i class="bi bi-envelope-fill me-1"></i> Kelompok2@ketopraknusantara.id</li>
          </ul>
          <div class="d-flex gap-2 justify-content-center justify-content-md-end mt-3">
            <a href="#" class="kn-social-icon"><i class="bi bi-instagram"></i></a>
            <a href="#" class="kn-social-icon"><i class="bi bi-tiktok"></i></a>
            <a href="#" class="kn-social-icon"><i class="bi bi-twitter-x"></i></a>
          </div>
        </div>
      </div>
      <hr class="border-secondary my-4" />
      <p class="text-center text-white-50 small mb-0">&copy; 2026 Ketoprak Nusantara. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>