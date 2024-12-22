 <!-- Hero Section Begin -->
 <section class="hero hero-normal">
     <div class="container">
         <div class="row">
             <div class="col-lg-3">
                 <div class="hero__categories">
                     <div class="hero__categories__all">
                         <i class="fa fa-bars"></i>
                         <span>All departments</span>
                     </div>
                     <ul>
                         <li><a href="#">Fresh Meat</a></li>
                         <li><a href="#">Vegetables</a></li>
                         <li><a href="#">Fruit & Nut Gifts</a></li>
                         <li><a href="#">Fresh Berries</a></li>
                         <li><a href="#">Ocean Foods</a></li>
                         <li><a href="#">Butter & Eggs</a></li>
                         <li><a href="#">Fastfood</a></li>
                         <li><a href="#">Fresh Onion</a></li>
                         <li><a href="#">Papayaya & Crisps</a></li>
                         <li><a href="#">Oatmeal</a></li>
                         <li><a href="#">Fresh Bananas</a></li>
                     </ul>
                 </div>
             </div>
             <div class="col-lg-9">
                 <div class="hero__search">
                     <div class="hero__search__form">
                         <form action="#">
                             <div class="hero__search__categories">
                                 All Categories
                                 <span class="arrow_carrot-down"></span>
                             </div>
                             <input type="text" placeholder="What do yo u need?">
                             <button type="submit" class="site-btn">SEARCH</button>
                         </form>
                     </div>
                     <div class="hero__search__phone">
                         <div class="hero__search__phone__icon">
                             <i class="fa fa-phone"></i>
                         </div>
                         <div class="hero__search__phone__text">
                             <h5>+65 11.188.888</h5>
                             <span>support 24/7 time</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Hero Section End -->

 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-section set-bg" data-setbg="/ogani-master/img/breadcrumb.jpg">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="breadcrumb__text">
                     <h2>Contact Us</h2>
                     <div class="breadcrumb__option">
                         <a href="./index.html">Home</a>
                         <span>Contact Us</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Breadcrumb Section End -->

 <!-- Contact Section Begin -->
 <section class="contact spad">
     <div class="container">
         <div class="row">
             <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                 <div class="contact__widget">
                     <span class="icon_phone"></span>
                     <h4>Phone</h4>
                     <p>+01-3-8888-6868</p>
                 </div>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                 <div class="contact__widget">
                     <span class="icon_pin_alt"></span>
                     <h4>Address</h4>
                     <p>60-49 Road 11378 New York</p>
                 </div>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                 <div class="contact__widget">
                     <span class="icon_clock_alt"></span>
                     <h4>Open time</h4>
                     <p>10:00 am to 23:00 pm</p>
                 </div>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                 <div class="contact__widget">
                     <span class="icon_mail_alt"></span>
                     <h4>Email</h4>
                     <p>hello@colorlib.com</p>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Contact Section End -->

 <!-- Map Begin -->
 <div style="position: relative; max-width: 100%; margin: auto;">
     <!-- Bản đồ -->
     <iframe
         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7339261720144!2d108.25065207519647!3d15.975265441946371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2sVietnam%20-%20Korea%20University%20of%20Information%20and%20Communication%20Technology!5e0!3m2!1sen!2s!4v1734713022597!5m2!1sen!2s"
         width="100%" height="450" style="border: 0;"
         allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
     </iframe>

     <!-- Mô tả -->
     <div style="position: absolute; top: 20px; left: 20px; background: rgba(255, 255, 255, 0.9); padding: 15px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
         <h4>Vietnam - Korea University</h4>
         <p>Address: Đà Nẵng, Việt Nam</p>
         <p>Phone: +84 123 456 789</p>
     </div>
 </div>

 <!-- Map End -->

 <!-- Contact Form Begin -->
 <div class="contact-form spad">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="contact__form__title">
                     <h2>Leave Message</h2>
                 </div>
             </div>
         </div>
         <form action="/contactcontroller/handleContactForm" method="POST">
             <div class="row">
                 <div class="col-lg-6 col-md-6">
                     <input type="text" name="name" placeholder="Your name" required>
                 </div>
                 <div class="col-lg-6 col-md-6">
                     <input type="email" name="email" placeholder="Your Email" required>
                 </div>
                 <div class="col-lg-12 text-center">
                     <textarea name="message" placeholder="Your message" required></textarea>
                     <button type="submit" class="site-btn">SEND MESSAGE</button>
                 </div>
             </div>
         </form>

     </div>
 </div>


 <!-- Contact Form End -->