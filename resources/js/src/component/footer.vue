<template>
    <!-- <footer class="footer">
      <div class="footer-content">
        <div class="footer-section">
          <h4 class="footer-section-title">Contact</h4>
          <p class="footer-section-info">
            Adresse : 123 Rue de l'École<br>
            Ville, Pays<br>
            Téléphone : +12 345 6789<br>
            Email : info@gestionscolaire.com
          </p>
        </div>
        <div class="footer-section">
          <h4 class="footer-section-title">Liens utiles</h4>
          <ul class="footer-links">
            <li><a href="#">Accueil</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Actualités</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h4 class="footer-section-title">Suivez-nous</h4>
          <div class="footer-social-media">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2023 Gestion Scolaire. Tous droits réservés.</p>
      </div>
    </footer> -->
    <footer id="dk-footer" class="dk-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="dk-footer-box-info">
                        <a href="index.html" class="footer-logo">
                            <img :src="images1" alt="footer_logo" class="img-fluid">
                        </a>
                       
                        <div class="footer-social-link">
                            <h3>Suivez-nous</h3>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Social link -->
                    </div>
                    <!-- End Footer info -->
                   
                </div>
                <!-- End Col -->
                <div class="col-md-12 col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-us">
                                <div class="contact-icon">
                                    <i class="fa fa-map-o" aria-hidden="true"></i>
                                </div>
                                <!-- End contact Icon -->
                                <div class="contact-info">
                                    <h3>Tanger Maroc</h3>
                                    <p>90 Rue</p>
                                </div>
                                <!-- End Contact Info -->
                            </div>
                            <!-- End Contact Us -->
                        </div>
                        <!-- End Col -->
                        <div class="col-md-6">
                            <div class="contact-us contact-us-last">
                                <div class="contact-icon">
                                    <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                </div>
                                <!-- End contact Icon -->
                                <div class="contact-info">
                                    <h3> 06 63 54 67 89</h3>
                                    <p>Contactez-nous</p>
                                </div>
                                <!-- End Contact Info -->
                            </div>
                            <!-- End Contact Us -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Contact Row -->
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="footer-widget footer-left-widget">
                                <div class="section-heading">
                                    <h3>Liens utiles</h3>
                                    <span class="animate-border border-black"></span>
                                </div>
                                <ul>
                                    <li>
                                        <a href="#">Accueil</a>
                                    </li>
                                    <li>
                                        <a href="#"> À propos de nous</a>
                                    </li>
                                    <li>
                                        <a href="#">Services</a>
                                    </li>
                                    
                                </ul>
                                <ul>
                                    <li>
                                        <a href="#">Contactez-nous</a>
                                    </li>
                                    <li>
                                        <a href="#"> Notre équipe</a>
                                    </li>
                                    
                                </ul>
                            </div>
                            <!-- End Footer Widget -->
                        </div>
                        <!-- End col -->
                       
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Widget Row -->
        </div>
        <!-- End Contact Container -->


       
        <!-- End Copyright -->
        <!-- Back to top -->
        <!-- <div id="back-to-top" class="back-to-top">
            <button class="btn btn-dark" title="Back to Top" style="display: block;">
                <i class="fa fa-angle-up"></i>
            </button>
        </div> -->
        <!-- End Back to top -->
</footer>
  </template>
  <script>
  import logoImag from '../assest/images/logoo.png'

export default {
  data() {
    return {
    name :"Footer",
      images1 : logoImag
       
    }
  },};

</script>