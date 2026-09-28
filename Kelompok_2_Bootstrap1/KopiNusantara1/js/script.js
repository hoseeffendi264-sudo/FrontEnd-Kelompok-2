$(document).ready(function() {
  const productsData = {
    1: {
      name: 'Kopi Gayo',
      image: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800&h=400&fit=crop',
      description: 'Kopi arabika premium dari dataran tinggi Gayo, Aceh. Diproses secara wet-hulled (Giling Basah) yang khas Sumatera, menghasilkan rasa full body dengan aroma earthy, sedikit fruity, dan tingkat keasaman yang rendah.',
      price: 'Rp 25.000',
      details: [
        'Asal: Gayo, Aceh',
        'Roast Level: Medium-Dark',
        'Notes: Earthy, Fruity, Full Body',
        'Proses: Wet-Hulled'
      ]
    },
    2: {
      name: 'Kopi Toraja',
      image: 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800&h=400&fit=crop',
      description: 'Kopi arabika khas Sulawesi Selatan yang tumbuh di ketinggian 1.100-1.800 mdpl. Memiliki cita rasa herbal, spicy, dan dark chocolate dengan body yang tebal dan aftertaste yang panjang.',
      price: 'Rp 28.000',
      details: [
        'Asal: Toraja, Sulawesi Selatan',
        'Roast Level: Medium',
        'Notes: Herbal, Spicy, Dark Chocolate',
        'Ketinggian: 1.100-1.800 mdpl'
      ]
    },
    3: {
      name: 'Kopi Kintamani',
      image: 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=800&h=400&fit=crop',
      description: 'Kopi arabika dari dataran tinggi Kintamani, Bali. Ditanam berdampingan dengan pohon jeruk sehingga menghasilkan karakter citrusy yang unik, clean, dan menyegarkan.',
      price: 'Rp 27.000',
      details: [
        'Asal: Kintamani, Bali',
        'Roast Level: Light-Medium',
        'Notes: Citrusy, Clean, Fresh',
        'Tanam: Berdampingan dengan jeruk'
      ]
    },
    4: {
      name: 'Es Kopi Susu Nusantara',
      image: 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefda?w=800&h=400&fit=crop',
      description: 'Signature drink kami! Perpaduan sempurna antara double shot espresso, susu segar premium, dan gula aren asli dari Banten. Creamy, manis alami, dan menyegarkan.',
      price: 'Rp 22.000',
      details: [
        'Best Seller',
        'Disajikan dingin',
        'Notes: Creamy, Sweet, Bold',
        'Gula aren asli Banten'
      ]
    },
    5: {
      name: 'Kopi Flores Bajawa',
      image: 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=800&h=400&fit=crop',
      description: 'Kopi arabika dari dataran tinggi Bajawa, Flores, NTT. Diproses secara semi-washed menghasilkan rasa nutty, chocolatey, dengan body medium dan keasaman yang seimbang.',
      price: 'Rp 30.000',
      details: [
        'Asal: Bajawa, Flores, NTT',
        'Roast Level: Medium',
        'Notes: Nutty, Chocolatey, Balanced',
        'Proses: Semi-Washed'
      ]
    },
    6: {
      name: 'Matcha Latte',
      image: 'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?w=800&h=400&fit=crop',
      description: 'Minuman non-kopi favorit! Matcha ceremonial grade premium dicampur dengan susu segar, menghasilkan rasa creamy, sedikit earthy, dan menyegarkan. Bisa disajikan panas atau dingin.',
      price: 'Rp 25.000',
      details: [
        'Hot / Iced available',
        'Non-kopi',
        'Notes: Creamy, Earthy, Refreshing',
        'Matcha ceremonial grade'
      ]
    }
  };

  $('#navbarToggle').on('click', function() {
    $('#navbarMenu').slideToggle(300);
    $(this).toggleClass('active');
    
    const hamburgers = $(this).find('.hamburger');
    if ($('#navbarMenu').is(':visible')) {
      hamburgers.eq(0).css('transform', 'rotate(45deg) translate(5px, 5px)');
      hamburgers.eq(1).css('opacity', '0');
      hamburgers.eq(2).css('transform', 'rotate(-45deg) translate(7px, -6px)');
    } else {
      hamburgers.css({ 'transform': 'none', 'opacity': '1' });
    }
  });

  $('.nav-link').on('click', function(e) {
    e.preventDefault();
    
    const targetId = $(this).attr('href');
    const targetElement = $(targetId);
    
    if (targetElement.length) {
      // Tutup mobile menu jika sedang terbuka
      if ($('#navbarMenu').is(':visible')) {
        $('#navbarMenu').slideUp(300);
        $('#navbarToggle').removeClass('active');
        $('#navbarToggle').find('.hamburger').css({ 'transform': 'none', 'opacity': '1' });
      }
      
      $('html, body').animate({
        scrollTop: targetElement.offset().top - 70
      }, 600);
      
      $('.nav-link').removeClass('active');
      $(this).addClass('active');
    }
  });

  $(window).on('scroll', function() {
    let currentSection = '';
    
    $('section[id], footer[id]').each(function() {
      const sectionTop = $(this).offset().top - 100;
      const sectionHeight = $(this).outerHeight();
      
      if ($(window).scrollTop() >= sectionTop && $(window).scrollTop() < sectionTop + sectionHeight) {
        currentSection = $(this).attr('id');
      }
    });
    
    $('.nav-link').removeClass('active');
    if (currentSection) {
      $(`.nav-link[href="#${currentSection}"]`).addClass('active');
    }
  });

  $('.accordion-header').on('click', function() {
    const targetId = $(this).data('accordion');
    const content = $(`#${targetId}`);
    const isActive = $(this).hasClass('active');
    
    $('.accordion-header').removeClass('active');
    $('.accordion-content').slideUp(300);
    
    if (!isActive) {
      $(this).addClass('active');
      content.slideDown(300);
    }
  });

  $('.btn-detail').on('click', function() {
    const productId = $(this).data('product');
    const product = productsData[productId];
    
    if (product) {
      let detailsHTML = '';
      product.details.forEach(function(detail) {
        detailsHTML += `<li>${detail}</li>`;
      });
      
      const modalContent = `
        <img src="${product.image}" alt="${product.name}" />
        <h3>${product.name}</h3>
        <p>${product.description}</p>
        <ul>${detailsHTML}</ul>
        <p style="font-size: 1.3rem; color: var(--brown-medium); font-weight: bold;">${product.price}</p>
        <button class="btn btn-primary" style="width: 100%; margin-top: 15px;">Pesan Sekarang</button>
      `;
      
      $('#modalBody').html(modalContent);
      $('#productModal').css('display', 'flex').hide().fadeIn(300);
      $('body').css('overflow', 'hidden');
    }
  });

  function closeModal() {
    $('#productModal').fadeOut(300);
    $('body').css('overflow', '');
  }

  $('#modalClose, .modal-overlay').on('click', closeModal);

  $(document).on('keydown', function(e) {
    if (e.key === 'Escape' && $('#productModal').is(':visible')) {
      closeModal();
    }
  });

  $(window).on('scroll', function() {
    $('.product-card').each(function(i) {
      const bottomOfObject = $(this).offset().top + $(this).outerHeight() / 4;
      const bottomOfWindow = $(window).scrollTop() + $(window).height();
      
      if (bottomOfWindow > bottomOfObject && !$(this).hasClass('animated')) {
        $(this).addClass('animated');
        $(this).delay(i * 100).animate({ opacity: 1, marginTop: '0px' }, 600);
      }
    });
  });
  
  $('.product-card').css({ opacity: 0, marginTop: '30px' });

  console.log('Kopi Nusantara jQuery loaded successfully!');
});