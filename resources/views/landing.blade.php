<x-deliny-layout>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg" style="background-image: url('assets/img/menu/fondo-comida.jpg');">
  <div class="container">
    <div class="row justify-content-between gy-5">
      <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center text-center text-lg-start">
        <h2 data-aos="fade-up" style="padding: 10px; border-radius: 20px; color: #fff;"><br>Deliny<span style="color: #FFD700;">.</span> 
        Explora un mundo de sabores</h2>
        <p data-aos="fade-up" data-aos-delay="100" style="background-color: #F5F5DC; color: #333; font-size: 20px; padding: 15px; border-radius: 10px; margin-top: 10px;">
          ¡Explora un mundo de sabores en nuestro blog de comida, donde cada plato es una historia que te invitamos a saborear!
        </p>
        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="{{ route('recetas.index') }}" class="btn btn-primary" style="background-color: crimson; color: #fff;">¡Explora nuestras recetas!</a>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 d-flex align-items-center">
        <img src="{{ asset('assets/img/menu/personas-cocina.png') }}" alt="Hombre comiendo" style="max-width: 100%;">
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>¿Quienes somos?</h2>
          <p>Conoce más acerca de <span>Deliny</span></p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/about.jpg) ;" data-aos="fade-up" data-aos-delay="150">
          </div>
          <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                Deliny es una página dedicada a la recopilación de deliciosas recetas, además de proporcionar
                una opción de creación de un menú personal, cada usuario puede disfrutar de un espacio
                en donde un sinfín de recetas pueden ser compartidas ¡Explora ya!
              </p>
              <ul>
                <li><i class="bi bi-check2-all"></i> Sube recetas que te encantan junto con sus ingredientes y procedimiento. </li>
                <li><i class="bi bi-check2-all"></i> Realiza tus propios menús semanales a partir de las recetas. </li>
                <li><i class="bi bi-check2-all"></i> Comenta y califica recetas, nos importa tu opinión.</li>
              </ul>
              <p>
                Explora este delicioso mundo y encuentra tus recetas favoritas. 
              </p>

              <div class="position-relative mt-4">
                <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=sWDGh0j7v80&ab_channel=Videossincopyright" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

 

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="zoom-out">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1" class="purecounter"></span>
              <p>Usuarios registrados</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1" class="purecounter"></span>
              <p>Nuevas recetas</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="300" data-purecounter-duration="1" class="purecounter"></span>
              <p>Ingredientes a utilizar</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
              <p>Tipos de comida</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>
    </section><!-- End Stats Counter Section -->


  <!-- ======= Book A Table Section ======= -->
<section id="book-a-table" class="book-a-table">
  <div class="container" data-aos="fade-up">
    <div class="section-header">
      <h2>Sube tus recetas</h2>
      <p>¿Tienes alguna receta? <span>Súbela</span> y empieza a disfrutar</p>
    </div>
    <div class="row g-0">
      <div class="col-lg-4 reservation-img" style="background-image: url(assets/img/reservation.jpg);" data-aos="zoom-out" data-aos-delay="200"></div>
      <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="200">
        <div class="content ps-0 ps-lg-5" style="position: relative; top: -100px;">
          <p class="fst-italic"> ¿Quisieras subir tus propias recetas? ¿Buscas nuevos menús? 
            ¿Te gustaría comentar y calificar recetas de otros usuarios? En Deliny nos encanta 
            saber qué opinas, tus recetas favoritas y qué recetas te gustaría ver, por ello seguimos
            trabajando para mejorar la página y que tú también la disfrutes al máximo. 
            Regístrate y obtén más beneficios de esta página web. Si ya tienes cuenta, ¡bienvenido de nuevo!
          </p>
          <ul>
            <li><i class="bi bi-check2-all"></i> Empieza a subir recetas y disfruta de las delicias existentes en Deliny </li>
          </ul>
          <p>
            ¡Ingresa ya!
          </p>
          <div class="text-center">
            <a href="{{route('recetas.create')}}" class="btn btn-primary" style="background-color: crimson; color: white; margin-right: 30px;">Inicia sesión</a>
            <a href="{{route('recetas.create')}}" class="btn btn-primary" style="background-color: crimson; color: white;">Regístrate</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Book A Table Section -->




  
    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Registrate</h2>
          <p>Encuentra tus recetas en <span> DELINY </span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">

          <div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-1.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-1.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-2.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-2.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-3.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-3.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-4.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-4.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-5.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-5.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-6.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-6.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>


           
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Gallery Section -->



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Dirección</h4>
            <p>
              Guadalajara, Jalisco <br>
              México<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contáctanos</h4>
            <p>
              <strong>Teléfono:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>

       

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Siguenos en redes</h4>
          <div class="social-links d-flex">
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
           
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Deliny</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

</x-deliny-layout>