
    <style type="text/css">


/*=== MEDIA QUERY ===*/
@import url("https://fonts.googleapis.com/css?family=Exo:500,600,700|Roboto&amp;display=swap");
html {
  overflow-x: hidden;
  scroll-behavior: smooth;
}

body {
  line-height: 1.6;
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  font-size: 16px;
  color: #6F8BA4;
  font-weight: 400;
  overflow-x: hidden;
}

h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
  font-family: "Exo", sans-serif;
  font-weight: 700;
  color: #222;
}

h1, .h1 {
  font-size: 2.5rem;
}

h2, .h2 {
  font-size: 44px;
}

h3, .h3 {
  font-size: 1.5rem;
}

h4, .h4 {
  font-size: 1.3rem;
  line-height: 30px;
}

h5, .h5 {
  font-size: 1.25rem;
}

h6, .h6 {
  font-size: 1rem;
}

p {
  line-height: 30px;
}

.navbar-toggle .icon-bar {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

input[type="email"], input[type="password"], input[type="text"], input[type="tel"] {
  box-shadow: none;
  height: 45px;
  outline: none;
  font-size: 14px;
}

input[type="email"]:focus, input[type="password"]:focus, input[type="text"]:focus, input[type="tel"]:focus {
  box-shadow: none;
  border: 1px solid @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.form-control {
  box-shadow: none;
  border-radius: 0;
}

.form-control:focus {
  box-shadow: none;
  border: 1px solid @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.py-7 {
  padding: 7rem 0px;
}

.btn {
  display: inline-block;
  font-size: 14px;
  font-size: 0.8125rem;
  font-weight: 700;
  letter-spacing: .5px;
  padding: .75rem 2rem;
  font-family: "Exo", sans-serif;
  text-transform: uppercase;
  border-radius: 5px;
  border: 2px solid transparent;
  transition: all .35s ease;
}

.btn.btn-icon i {
  border-left: 1px solid rgba(255, 255, 255, 0.09);
  padding-left: 15px;
}

.btn:focus {
  outline: 0px;
  box-shadow: none;
}

.btn-main {
  background: @isset(site_info()->btnbackground) {{site_info()->btnbackground}} @endisset;
  color: #fff;
  border-color: @isset(site_info()->btnbackground){{site_info()->btnbackground}}@endisset;
}

.btn-main:hover {
  background:   @isset(site_info()->btnbackground){{site_info()->btnbackground}}@endisset;
  border-color:   @isset(site_info()->btnbackground){{site_info()->btnbackground}}@endisset;
  color: #fff;
}

.btn-main-2 {
  background:   @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset
;
  color: #fff;
  border-color:   @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset
;
}

.btn-main-2:hover {
  background: @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset;
  color: #fff;
  border-color: @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset;
}

.btn-solid-border {
  border: 2px solid @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset;
  background: transparent;
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.btn-solid-border:hover {
  border: 2px solid @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset;
  color: #fff;
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.btn-solid-border:hover.btn-icon i {
  border-left: 1px solid rgba(255, 255, 255, 0.09);
}

.btn-solid-border.btn-icon i {
  border-left: 1px solid rgba(0, 0, 0, 0.09);
}

.btn-transparent {
  background: transparent;
  color: #222;
  border-color: #6F8BA4;
}

.btn-transparent:hover {
  background: #6F8BA4;
  color: #fff;
}

.btn-white {
  background: #fff;
  border-color: #fff;
  color: #222;
}

.btn-white:hover {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  color: #fff;
  border-color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.btn-solid-white {
  border-color: #fff;
  color: #fff;
}

.btn-solid-white:hover {
  background: #fff;
  color: #222;
}

.btn-round {
  border-radius: 4px;
}

.btn-round-full {
  border-radius: 50px;
}

.btn.active:focus, .btn:active:focus, .btn:focus {
  outline: 0;
}

.bg-gray {
  background: #eff0f3;
}

.bg-primary {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.bg-primary-dark {
  background: #152440;
}

.bg-primary-darker {
  background: #090f1a;
}

.bg-dark {
  background: #222;
}

.bg-gradient {
  background-image: linear-gradient(145deg, rgba(19, 177, 205, 0.95) 0%, rgba(152, 119, 234, 0.95) 100%);
  background-repeat: repeat-x;
}

.section {
  padding: 100px 0;
}

.section-sm {
  padding: 70px 0;
}

.section-bottom {
  padding-bottom: 100px;
}

.subtitle {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  font-size: 14px;
  letter-spacing: 1px;
}

.overlay:before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  opacity: 0.9;
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.overly-2 {
  position: relative;
}

.overly-2:before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
}

.text-sm {
  font-size: 14px;
}

.text-md {
  font-size: 2.25rem;
}

.text-lg {
  font-size: 3.75rem;
}

.no-spacing {
  letter-spacing: 0px;
}

/* Links */
a {
  color: #222;
  text-decoration: none;
  transition: all .35s ease;
}

a:focus, a:hover {
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
  text-decoration: none;
}

a:focus {
  outline: none;
}

.content-title {
  font-size: 40px;
  line-height: 50px;
}

.page-title {
  padding: 120px 0px 70px 0px;
  position: relative;
  margin-top: -86px;
    z-index: -1;
}

.page-title .block h1 {
  color: #fff;
}

.page-title .block p {
  color: #fff;
}

.page-title .breadcumb-nav {
  margin-top: 60px;
  padding-top: 30px;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
}

.slick-slide:focus, .slick-slide a {
  outline: none;
}

@media (max-width: 480px) {
  h2, .h2 {
    font-size: 1.3rem;
    line-height: 36px;
  }
}

.title-color {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.secondary-bg {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.section-title {
  margin-bottom: 70px;
}

.section-title h2 {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.text-lg {
  font-size: 50px;
}

.gray-bg {
  background: #f4f9fc;
}

@media (max-width: 480px) {
  .text-lg {
    font-size: 28px;
  }
}

@media (max-width: 400px) {
  .text-lg {
    font-size: 28px;
  }
}

#navbarmain .nav-link {
  font-weight: normal;
  padding: 15px 20px;
  color: #fff;
  text-transform: uppercase;
  font-size: 16px;
  transition: all .25s ease;
}

#navbarmain .nav-link:hover,
#navbarmain .active .nav-link {
  color:   @isset(site_info()->btnbackground){{site_info()->btnbackground}}@endisset;
}

.dropdown-toggle::after {
  display: none;
}

.navbar-brand {
  margin-top: 0;
  margin-right: 5rem;
}
.navbar{
  padding-top: 0;
}
.translate_form select {
  padding: 5px;
  border: 1px solid #ddd;
  border-radius: 3px;
  color: #616161;
}
.lang {
  margin-left: 20px;
}
.header-top-bar {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  font-size: 14px;
  padding: 10px 0px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  color: #fff;
  display: none;
}

.top-bar-info li a {
  color: #fff;
  margin-right: 20px;
}

.top-right-bar a span {
  color: #fff;
  font-weight: 600;
  letter-spacing: 1px;
  vertical-align: middle;
}

.top-right-bar a i {
  color: #fff;
  margin-right: 10px;
}

@media (max-width: 992px) {
  .navigation {
    text-align: center;
  }
}

.navigation .dropdown-menu {
  padding: 0px;
  border: 0px;
  border-top: 5px solid   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
  background: #fff;
  border-radius: 0px;
}

@media (max-width: 992px) {
  .navigation .dropdown-menu {
    text-align: center;
    float: left !important;
    width: 100%;
    margin: 0;
  }
}

.navigation .dropdown-toggle::after {
  display: none;
}

.navigation .dropleft .dropdown-menu,
.navigation .dropright .dropdown-menu {
  margin: 0;
}

.navigation .dropleft .dropdown-toggle::before,
.navigation .dropright .dropdown-toggle::after {
  font-weight: bold;
  font-size: 14px;
  border: 0;
  display: inline-block;
  font-family: IcoFont !important;
  vertical-align: 1px;
}

.navigation .dropleft .dropdown-toggle::before {
  content: "\eac9";
  margin-right: 5px;
}

.navigation .dropright .dropdown-toggle::after {
  content: "\eaca";
  margin-left: 5px;
}

.navigation .dropdown-item {
  padding: 13px 20px;
  background: transparent;
  font-weight: 400;
  color: #555;
  border-bottom: 1px solid #eee;
}

.navigation li:last-child .dropdown-item {
  border-bottom: 0;
}

.navigation .dropdown-submenu.active > .dropdown-toggle,
.navigation .dropdown-submenu:hover > .dropdown-item,
.navigation .dropdown-item.active,
.navigation .dropdown-item:hover {
  background: rgba(225, 36, 84, 0.05);
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.navigation button:focus {
  outline: 0;
}

@media (min-width: 992px) {
  .navigation .dropdown-menu {
    display: block;
    opacity: 0;
    visibility: hidden;
    transition: all .2s ease-in, visibility 0s linear .2s, -webkit-transform .2s linear;
    transition: all .2s ease-in, visibility 0s linear .2s, transform .2s linear;
    transition: all .2s ease-in, visibility 0s linear .2s, transform .2s linear, -webkit-transform .2s linear;
    display: block;
    visibility: hidden;
    opacity: 0;
    min-width: 200px;
    -webkit-transform: translateY(10px);
            transform: translateY(10px);
  }
  .navigation .dropleft .dropdown-menu,
  .navigation .dropright .dropdown-menu {
    margin-top: -5px;
  }
  .navigation .dropdown:hover > .dropdown-menu {
    visibility: visible;
    transition: all .3s ease 0s;
    opacity: 1;
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
}

.bg-1 {
  background: url("../images/bg/22.jpg") no-repeat 50% 50%;
  background-size: cover;
  position: relative;
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset !important;
}

.banner {
  /*position: relative;*/
  overflow: hidden;
  background: #fff;
  background: no-repeat;
  background-size: 90%;
  min-height: auto;
  margin-top: -85px;
  padding-top: 73px;
  z-index: -1;
}

.banner .block {
  padding: 80px 0px 510px;
}

.banner .block h1 {
  font-size: 60px;
  line-height: 1.2;
  letter-spacing: 0;
  text-transform: uppercase;
  color: #ffffff;
  font-weight: bolder;
}
.banner .block span, .banner .block p {
  color: rgb(255,255,255);
}
.letter-spacing {
  letter-spacing: 0;
}

.text-color {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.text-color-2 {
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.divider {
  width: 40px;
  height: 5px;
  background:   @isset(site_info()->btnbackground){{site_info()->btnbackground}}@endisset;
}

@media (max-width: 480px) {
  .banner .block h1 {
    font-size: 38px;
    line-height: 50px;
  }
  .banner {
    min-height: 450px;
    background-size: cover;
  }
}

@media (max-width: 400px) {
  .banner .block h1 {
    font-size: 28px;
    line-height: 40px;
  }
  .banner {
    min-height: 450px;
  }
}

@media (max-width: 768px) {
  .banner .block h1 {
    font-size: 56px;
    line-height: 70px;
  }

}



.about-img img {
  border-radius: 5px;
  box-shadow: 0px 0px 30px 0px rgba(0, 42, 106, 0.1);
}

.award-img {
  height: 120px;
  margin-bottom: 10px;
  align-items: center;
  display: flex;
  justify-content: center;
  background: #eff0f3;
}

.appoinment-content {
  position: relative;
}

.appoinment-content img {
  width: 85%;
}

.appoinment-content .emergency {
  position: absolute;
  content: "";
  right: 10px;
  bottom: 20px;
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  padding: 48px;
}

.appoinment-content .emergency h2 {
  color: #fff;
}

.appoinment-content .emergency i {
  margin-right: 10px;
  color: rgba(255, 255, 255, 0.7);
}

.appoinment-form {
  margin-top: 40px;
}

.appoinment-form .form-control {
  background: #f4f9fc;
  height: 55px;
  border-color: rgba(0, 0, 0, 0.05);
}

.appoinment-form textarea.form-control {
  height: auto;
}

.client-thumb {
  text-align: center;
  margin: 15px;
}

.features {
  margin-top: -70px;
}

.feature-item {
  flex-basis: 33.33%;
  margin: 0px 10px;
  padding: 40px 30px;
  background-color: #fff;
  border-radius: 15px 15px 15px 15px;
  transition: all 0.5s;
  text-align: center;
  cursor: pointer;
  border: 1px solid #f1f1f1;
}
.feature-item:hover , .service-item:hover{
  box-shadow: 0px 0px 30px 0px rgba(0, 42, 106, 0.1);

}
.feature-icon {
  background: transparent;
  display: inline-block;
  width: 90px;
  height: 90px;
  line-height: 90px;
  text-align: center;
  border-radius: 50%;
  padding: 0;
}
.feature-icon img {
  width: 90px;
  height: 90px;
  line-height: 90px;
}
.feature-item .feature-icon i {
  font-size: 50px;
    color: #ffffff;
    padding: 0;
    margin: 0;
    line-height: inherit;
}

.feature-item h4 {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.feature-item p {
  font-size: 14px;
}

.feature-section.border-top {
  border-top: 1px solid rgba(0, 0, 0, 0.05) !important;
}

.w-hours li {
  padding: 6px 0px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.counter-stat {
  text-align: center;
  padding: 41px 0px 40px 0px;
  position: relative;
}

.counter-stat i {
  display: block;
  font-size: 40px;
  position: relative;
  margin-bottom: 20px;
  color: #fff;
}

.counter-stat span {
  font-size: 29px;
  color: #fff;
  font-weight: normal;
}

.counter-stat p {
  margin-bottom: 0px;
  color: rgba(255, 255, 255, 0.7);
}

.mb--80 {
  margin-bottom: -80px;
}

.service {
  padding-top: 62px;
}

.service .service-item {
  background: #fff;
  padding: 30px;
  border-radius: 5px;
  transition: all 0.5s;
  cursor: pointer;
}

.service .icon {
  float: left;
  margin-bottom: 10px;
}

.service i {
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.service h4 {
  padding-left: 20px;
}

.service .content {
  clear: both;
}

.service-block {
  padding: 20px;
  margin-top: 40px;
  border: 1px solid rgba(0, 0, 0, 0.03);
  box-shadow: 0 0 38px rgba(21, 40, 82, 0.07);
}

.service-block img {
  width: 100%;
  margin-top: -60px;
  border: 5px solid #fff;
}

.department-service {
  margin-bottom: 40px;
}

.department-service li {
  margin-bottom: 10px;
}

.department-service li i {
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.doctors .btn-group .btn {
  border-radius: 0px;
  margin: 0px 2px;
  text-transform: capitalize;
  font-size: 16px;
  padding: .6rem 1.5rem;
  cursor: pointer;
}

.doctors .btn-group .btn.active {
  box-shadow: none !important;
  border-color: transparent;
  background:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
  color: #fff;
}

.doctors .btn-group .btn.focus {
  box-shadow: none !important;
  border-color: transparent;
}

.doctors .btn-group .btn:focus {
  box-shadow: none !important;
  border-color: transparent;
  background:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
  color: #fff;
}

.doctors .btn-group .btn:hover {
  box-shadow: none !important;
  border-color: transparent;
  background:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
  color: #fff;
}

.doctors .btn-group > .btn-group:not(:last-child) > .btn, .doctors .btn-group > .btn:not(:last-child):not(.dropdown-toggle), .doctors .btn-group > .btn:not(:first-child) {
  border-radius: 3px;
}

.doctor-inner-box {
  overflow: hidden;
}

.doctor-inner-box .doctor-profile {
  overflow: hidden;
  position: relative;
  box-shadow: 0px 8px 16px 0px rgba(200, 183, 255, 0.2);
}

.doctor-inner-box .doctor-profile .doctor-img {
  transition: all .35s ease;
}

.doctor-inner-box .doctor-profile .doctor-img:hover {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.lh-35 {
  line-height: 35px;
}

.doctor-info li {
  margin-bottom: 10px;
  color: #222;
}

.doctor-info li i {
  margin-right: 20px;
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.read-more {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

@media (max-width: 480px) {
  .doctors .btn-group {
    display: block;
  }
  .doctors .btn-group .btn {
    margin: 8px 3px;
  }
}

@media (max-width: 400px) {
  .doctors .btn-group {
    display: block;
  }
  .doctors .btn-group .btn {
    margin: 8px 3px;
  }
}

@media (max-width: 768px) {
  .doctors .btn-group {
    display: block;
  }
  .doctors .btn-group .btn {
    margin: 8px 3px;
  }
}

.cta {

  position: relative;
}

.cta:before {
  position: absolute;
  content: "";
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  background: none;
}

.mb-30 {
  margin-bottom: 30px;
}

.text-color-primary {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.cta-section {
  background: url("../../img/bg_count.svg") no-repeat;
  background-size: 100%;
  height: 369px;
}

.cta-2 {
  background: url("../images/bg/cta-bg.html") no-repeat;
  background-position: center center;
}

.cta-page {
  background: url("../images/bg/banner.jpg") no-repeat;
  background-size: cover;
  position: relative;
}

.testimonial {
  position: relative;
}

.testimonial:before {
  width: 48%;
  height: 100%;
  top: 0;
  left: 0px;
  position: absolute;
  content: "";
  background: url("../images/bg/bg-2.jpg") no-repeat 50% 50%;
}

.testimonial .slick-dots {
  text-align: left;
}

.testimonial-block {
  position: relative;
  margin-bottom: 20px;
}

.testimonial-block p {
  background: #fff;
  font-size: 13px;
  line-height: 1.8;
  margin-top: 15px;
  color: #898989;
}

.testimonial-block .client-info {
  margin-bottom: 20px;
}

.testimonial-block .client-info h4 {
  margin-bottom: 0px;
}

.testimonial-block i {
  font-size: 225px;
  position: absolute;
  right: 46px;
  bottom: 89px;
  opacity: .08;
  z-index: 0;
}

.testimonial-block .slick-dots {
  text-align: left;
}

.testimonial-wrap-2 .slick-dots {
  margin-left: -10px;
}

.testimonial-block.style-2 {
  background: #fff;
  padding: 30px;
  margin: 0px 4px;
  margin-bottom: 30px;
}

.testimonial-block.style-2 .testimonial-thumb {
  float: none;
}

.testimonial-block.style-2 .testimonial-thumb img {
  width: 80px;
  height: 80px;
  border-radius: 100%;
  margin-right: 20px;
  margin-bottom: 6px;
  border: 2px solid #eff0f3;
  margin-top: -5px;
}

.testimonial-block.style-2 .client-info p {
  clear: both;
  background: transparent;
}

.testimonial-block.style-2 i {
  bottom: -20px;
  color: #ededed;
  opacity: .3;
}

@media (max-width: 480px) {
  .testimonial-wrap {
    margin-left: 0px;
  }
  .testimonial::before {
    display: none;
  }
}

@media (max-width: 400px) {
  .testimonial-wrap {
    margin-left: 0px;
  }
  .testimonial::before {
    display: none;
  }
}

@media (max-width: 768px) {
  .testimonial-wrap {
    margin-left: 0px;
  }
  .testimonial::before {
    display: none;
  }
}

@media (max-width: 992px) {
  .testimonial-wrap {
    margin-left: 0px;
  }
  .testimonial::before {
    display: none;
  }
}

.contact-form-wrap .form-group {
  margin-bottom: 20px;
}

.contact-form-wrap .form-group .form-control {
  height: 60px;
  border: 1px solid #EEF2F6;
  box-shadow: none;
  width: 100%;
  background: #f4f9fc;
}

.contact-form-wrap .form-group-2 {
  margin-bottom: 13px;
}

.contact-form-wrap .form-group-2 textarea {
  height: auto;
  border: 1px solid #EEF2F6;
  box-shadow: none;
  background: #f4f9fc;
  width: 100%;
}

.social-icons li {
  margin: 0 6px;
}

.social-icons a {
  margin-right: 10px;
  font-size: 18px;
}

.google-map {
  position: relative;
}

.google-map #map {
  width: 100%;
  height: 500px;
}

.mt-90 {
  margin-top: 90px;
}

.contact-block {
  text-align: center;
  border: 5px solid #EEF2F6;
  padding: 50px 25px;
}

.contact-block i {
  font-size: 50px;
  margin-bottom: 15px;
  display: inline-block;
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.blog-item-content h2 {
  font-weight: 600;
  font-size: 38px;
}

/*=================================================================
  Single Blog Page
==================================================================*/
.nav-links .page-numbers {
  display: inline-block;
  width: 50px;
  height: 50px;
  border-radius: 100%;
  background: #eee;
  text-align: center;
  padding-top: 13px;
  font-weight: 600;
  margin-right: 10px;
}

.nav-links .page-numbers:hover {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  color: #fff;
}

.nav-links .page-numbers.current {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  color: #fff;
}

.comment-area .comment-thumb {
  margin-right: 20px;
  margin-bottom: 30px;
}

.comment-area h5 {
  font-size: 18px;
  font-weight: 500;
}

.comment-area span {
  font-size: 14px;
}

.posts-nav h6 {
  font-weight: 500;
}

.quote {
  font-size: 22px;
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  padding: 40px;
  font-style: italic;
  border-left: 5px solid   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
  margin: 25px 0px;
}

.tag-option a {
  border: 1px solid #eff0f3;
  padding: 6px 12px;
  color: #6F8BA4;
  font-size: 14px;
}

.comment-form .form-control {
  background: #f7f8fb;
  border-radius: 5px;
  border-color: #f7f8fb;
  height: 50px;
}

.comment-form textarea.form-control {
  height: auto;
}

.post.post-single {
  border: none;
}

.post.post-single .post-thumb {
  margin-top: 30px;
}

.post-sub-heading {
  border-bottom: 1px solid #dedede;
  padding-bottom: 20px;
  letter-spacing: 2px;
  text-transform: uppercase;
  font-size: 16px;
  margin-bottom: 20px;
}

.post-social-share {
  margin-bottom: 50px;
}

.post-comments {
  margin: 30px 0;
}

.post-comments .media {
  margin-top: 20px;
}

.post-comments .media > .pull-left {
  padding-right: 20px;
}

.post-comments .comment-author {
  margin-top: 0;
  margin-bottom: 0px;
  font-weight: 500;
}

.post-comments .comment-author a {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  font-size: 14px;
  text-transform: uppercase;
}

.post-comments time {
  margin: 0 0 5px;
  display: inline-block;
  color: #808080;
  font-size: 12px;
}

.post-comments .comment-button {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  display: inline-block;
  margin-left: 5px;
  font-size: 12px;
}

.post-comments .comment-button i {
  margin-right: 5px;
  display: inline-block;
}

.post-comments .comment-button:hover {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.post-excerpt {
  margin-bottom: 60px;
}

.post-excerpt h3 a {
  color: #000;
}

.post-excerpt p {
  margin: 0 0 30px;
}

.post-excerpt blockquote.quote-post {
  margin: 20px 0;
}

.post-excerpt blockquote.quote-post p {
  line-height: 30px;
  font-size: 20px;
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.comments-section {
  margin-top: 35px;
}

.author-about {
  margin-top: 40px;
}

.post-author {
  margin-right: 20px;
}

.post-author > img {
  border: 1px solid #dedede;
  max-width: 120px;
  padding: 5px;
  width: 100%;
}

.comment-list ul {
  margin-top: 20px;
}

.comment-list ul li {
  margin-bottom: 20px;
}

.comment-wrap {
  border: 1px solid #dedede;
  border-radius: 1px;
  margin-left: 20px;
  padding: 10px;
  position: relative;
}

.comment-wrap .author-avatar {
  margin-right: 10px;
}

.comment-wrap .media .media-heading {
  font-size: 14px;
  margin-bottom: 8px;
}

.comment-wrap .media .media-heading a {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  font-size: 13px;
}

.comment-wrap .media .comment-meta {
  font-size: 12px;
  color: #888;
}

.comment-wrap .media p {
  margin-top: 15px;
}

.comment-reply-form {
  margin-top: 80px;
}

.comment-reply-form input, .comment-reply-form textarea {
  height: 35px;
  border-radius: 0;
  box-shadow: none;
}

.comment-reply-form input:focus, .comment-reply-form textarea:focus {
  box-shadow: none;
  border: 1px solid @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.comment-reply-form textarea, .comment-reply-form .btn-main {
  height: auto;
}

.sidebar-widget {
  margin-bottom: 30px;
  padding-bottom: 35px;
}

.sidebar-widget h5 {
  margin-bottom: 30px;
  position: relative;
  padding-bottom: 15px;
}

.sidebar-widget h5:before {
  position: absolute;
  content: "";
  left: 0px;
  bottom: 0px;
  width: 35px;
  height: 3px;
  background:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.sidebar-widget.latest-post .media img {
  border-radius: 7px;
}

.sidebar-widget.latest-post .media h6 {
  font-weight: 500;
  line-height: 1.4;
}

.sidebar-widget.latest-post .media p {
  font-size: 12px;
}

.sidebar-widget.category ul li {
  margin-bottom: 10px;
}

.sidebar-widget.category ul li a {
  color: #222;
  transition: all 0.3s ease;
}

.sidebar-widget.category ul li a:hover {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  padding-left: 5px;
}

.sidebar-widget.category ul li span {
  margin-left: 10px;
}

.sidebar-widget.tags a {
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: .075em;
  line-height: 41px;
  height: 41px;
  font-weight: 500;
  border-radius: 20px;
  color: #666;
  display: inline-block;
  background-color: #eff0f3;
  margin: 0 7px 10px 0;
  padding: 0 25px;
  transition: all .2s ease;
}

.sidebar-widget.tags a:hover {
  color: #fff;
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.sidebar-widget.schedule-widget {
  background: #f4f9fc;
  padding: 25px;
}

.sidebar-widget.schedule-widget ul li {
  padding: 10px 0px;
  border-bottom: 1px solid #eee;
}

.search-form {
  position: relative;
}

.search-form i {
  position: absolute;
  right: 15px;
  top: 35%;
}

.footer {
  padding-bottom: 10px;
  background: @isset(site_info()->footerbackground)
{{site_info()->footerbackground}}
                                @endisset;
  color: @isset(site_info()->footercolors)
{{site_info()->footercolors}}
                                @endisset;
}

.footer .copyright a {
  font-weight: 600;
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.lh-35 {
  line-height: 35px;
}

.logo {
  font-weight: 600;
  letter-spacing: 1px;
}

.logo h3 {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.logo span {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}

.widget .divider {
  height: 3px;
}

.widget h4 {
    color: @isset(site_info()->basic_colors_1){{site_info()->basic_colors_1}}@endisset;
}

.widget .footer-menu a {
  color: @isset(site_info()->footercolors)
{{site_info()->footercolors}}
                                @endisset;
}

.widget .footer-menu a:hover {
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.footer-contact-block span {
  font-weight: 400;
  color: #6F8BA4;
}

.footer-contact-block i {
  font-size: 20px;
}

.footer-btm {
  border-top: 1px solid rgba(0, 0, 0, 0.06);
}

.footer-socials li a {
  width: 45px;
  height: 45px;
  background: transparent;
  color: @isset(site_info()->basic_colors_1){{site_info()->basic_colors_1}}@endisset;;
  display: inline-block;
  text-align: center;
  border-radius: 100%;
  padding-top: 12px;
}

.widget-contact h6 {
  font-weight: 500;
  margin-bottom: 18px;
}

.widget-contact h6 i {
  color:   @isset(site_info()->basic_colors_2){{site_info()->basic_colors_1}}@endisset;
}

.subscribe {
  position: relative;
}

.subscribe .form-control {
  border-radius: 50px;
  height: 60px;
  padding-left: 25px;
  border-color: #eee;
}

.subscribe .btn {
  position: absolute;
  right: 6px;
  top: 6px;
}

.backtop {
  position: fixed;
  background: @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset;
  z-index: 9999;
  display: inline-block;
  right: 55px;
  width: 50px;
  height: 50px;
  bottom: 50px;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  border-radius: 50px;
  transition: .3s;
  border: 1px solid #fff;
}

@media (max-width: 992px) {
  .backtop {
    bottom: 40px;
    right: 15px;
  }
}

@media (max-width: 768px) {
  .backtop {
    width: 45px;
    height: 45px;
  }
}

.backtop:hover {
  background-color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}

.backtop i {
  color: #fff;
  font-size: 20px;
}

.reveal {
  transition: all .3s;
  cursor: pointer;
  opacity: 1;
}

/*# sourceMappingURL=style.css.map */
/*=====================================
          PORTFOLIO CARD STYLE
======================================*/
.port__card {
  margin: 25px;
  border-radius: 8px;
  position: relative;
  border: 1px solid #ddd;
  transition: all 0.5s;
}

.port__card:hover .portfolio__hover {
  -webkit-transform: scale(1);
          transform: scale(1);
  -webkit-transform-origin: center;
          transform-origin: center;
}

.portfolio__img img {
  width: 100%;
  border-radius: 8px;
  transition: all 0.5s;
}

.portfolio__hover {
  position: absolute;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
  border-radius: 8px;
  background: rgba(0, 0, 0, 0.6);
  -webkit-transform: scale(0);
          transform: scale(0);
  transition: all linear .3s;
  -webkit-transition: all linear .3s;
  -moz-transition: all linear .3s;
  -ms-transition: all linear .3s;
  -o-transition: all linear .3s;
}

.protfolio__btn {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  text-align: center;
  width: 160px;
}
a.icon.icon-outline {
    color: #f00;
}
.protfolio__btn .btn {
  font-size: 14px;
  font-weight: 500;
  text-transform: capitalize;
  padding: 10px 25px;
  margin: 12px 0px;
  border-radius: 5px;
  letter-spacing: 0.3px;
  transition: all linear .3s;
  -webkit-transition: all linear .3s;
  -moz-transition: all linear .3s;
  -ms-transition: all linear .3s;
  -o-transition: all linear .3s;
}

.protfolio__btn .btn__custome {
  color: var(--first-color);
  background: #ffffff;
}

.protfolio__btn .btn__custome:hover {
  color: #fff;
  background: var(--first-color);
}

.portfolio__text {
  position: absolute;
  bottom: 30px;
  left: 50%;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  width: 100%;
  padding: 0px 25px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
}

.portfolio__text h6 {
  color: #ffffff;
  font-weight: 500;
  text-transform: capitalize;
  letter-spacing: 0.3px;
  margin-left: 15px;
  position: relative;
}

.portfolio__text h6::before {
  position: absolute;
  content: "";
  top: 50%;
  left: -15px;
  width: 3px;
  height: 100%;
  background: var(--first-color);
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

.portfolio__text a {
  width: 38px;
  height: 36px;
  line-height: 36px;
  text-align: center;
  border-radius: 8px;
  font-size: 16px;
  background: #dddddd;
  color: var(--heading-color);
}

.portfolio__text a:hover {
  color: #ffffff;
  background: var(--first-color);
}


.port {
  padding: 85px 0px 0px;
}

.port .container {
  max-width: 1300px;
}

.port__head h2 {
  width: 570px;
}



.portfolio__slide .dandik,
.portfolio__slide .bamdik {
  top: -80px;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  margin-left: -18px;
  visibility: visible;
  opacity: 1;
}

.portfolio__slide .bamdik {
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  visibility: visible;
  opacity: 1;
  left: 92%;
}

.protfolio__view__more {
  text-align: center;
  margin-top: 60px;
}

@media (max-width: 575px) {
  .port {
    padding: 50px 0px 0px;
  }
  .port__card {
    margin: 0px 15px;
  }
}

@media (max-width: 767px) {
  .port__head h2 {
    width: 100%;
  }
}

@media (min-width: 576px) and (max-width: 991px) {
  .port {
    padding: 70px 0px 0px;
  }
  .port__card {
    margin: 0px 15px;
  }
}



/*=====================================
     PORTFOLIO CONTENT PART STYLE
======================================*/
.portfolio__sec {
  padding: 100px 0px 0px;
  margin-top: 100px;
}

.port-con-title {
  margin-bottom: 30px;
}

.port-con-title h2 a {
  color: var(--heading-color);
}

.port-con-img {
  margin-bottom: 20px;
}

.port-con-img img {
  width: 100%;
  border-radius: 10px;
}

.port-con-meta {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  margin-bottom: 30px;
  margin-right: 30px;
}

.port-con-meta li {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

.port-con-meta li:hover p span {
  color: var(--first-color);
}

.port-con-meta li i {
  font-size: 14px;
  margin-right: 5px;
}

.port-con-meta li p {
  font-size: 14px;
}

.port-con-meta li p span {
  margin-left: 5px;
}

.port-con-btn {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  margin-bottom: 30px;
}

.port-con-btn .btn {
  width: 280px;
  padding: 12px 0px;
  text-align: center;
  border-radius: 8px;
}

.port-con-btn .icon {
  width: 45px;
  height: 45px;
  line-height: 45px;
  border-radius: 8px;
  -webkit-box-shadow: none;
          box-shadow: none;
  margin-left: 20px;
}

.port-con-btn .icon__outline {
  color: var(--first-color);
  border-color: var(--first-color);
}

.port-con-btn .icon__outline:hover {
  color: #ffffff;
}

.port-con-color {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

.port-con-color span {
  width: 160px;
  height: 160px;
  line-height: 145px;
  text-align: center;
  font-weight: 500;
  margin: 0px 8px;
  display: inline-block;
  border-radius: 50%;
}

.port-con-color span:nth-child(1) {
  border: 10px solid var(--first-color);
}

.port-con-color span:nth-child(1):hover {
  color: #ffffff;
  background: var(--first-color);
}

.port-con-color span:nth-child(2) {
  border: 10px solid var(--heading-color);
}

.port-con-color span:nth-child(2):hover {
  color: #ffffff;
  background: var(--heading-color);
}

@media (max-width: 767px) {
  .portfolio__sec {
    padding: 60px 0px 0px;
  }
  .port-con-title h2 {
    font-size: 24px;
    line-height: 32px;
  }
  .port-con-meta {
    margin-right: 0px;
    -ms-flex-wrap: wrap;
        flex-wrap: wrap;
  }
  .port-con-btn .btn {
    width: 100%;
  }
}
.mb-100{
  margin-bottom:100px;
}

.site_color{
  background-color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
  color: #fff;
}
.portfolio__img:hover img {
  box-shadow: 0px 0px 30px 0px rgb(0 42 106 / 10%);
}
.plan_list .shadow {
  background: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset !important;
  color: #fff;
}
.plan_list .shadow h1 {
  color: #fff;
}
.plan_list .shadow h2 {
  color:   @isset(site_info()->basic_colors_2)
{{site_info()->basic_colors_1}}
                                @endisset
;
}
.plan_list .shadow .btn {
  background:   @isset(site_info()->btnbackground)
{{site_info()->btnbackground}}
                                @endisset
 !important;
}
.client-thumb img {
  filter: gray;
  -webkit-filter: grayscale(100%);
}
.client-thumb img:hover {
  filter: none;
  -webkit-filter: grayscale(0);
}
.card.card-primary {
  border-top: 2px solid @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}
.card .card-header h4 {
  color: @isset(site_info()->basic_colors_1)
{{site_info()->basic_colors_1}}
                                @endisset;
}
.basicbtn {
  box-shadow: 0 2px 6px #acb5f6;
    background-color: #4a4186;
    border-color: #4a4186;
}
.slider-thumb::before {
	position: absolute;
	content: "";
	left: 20%;
    top: 14%;
    width: 150px;
    height: 150px;
    background: #5345b3;
	border-radius: 62% 47% 82% 35% / 45% 45% 80% 66%;
	will-change: border-radius, transform, opacity;
	animation: sliderShape 5s linear infinite;
	display: block;
	z-index: -1;
	-webkit-animation: sliderShape 5s linear infinite;
    display: none;
}
@keyframes sliderShape{
  0%,100%{
  border-radius: 42% 58% 70% 30% / 45% 45% 55% 55%;
    transform: translate3d(0,0,0) rotateZ(0.01deg);
  }
  34%{
      border-radius: 70% 30% 46% 54% / 30% 29% 71% 70%;
    transform:  translate3d(0,5px,0) rotateZ(0.01deg);
  }
  50%{
    transform: translate3d(0,0,0) rotateZ(0.01deg);
  }
  67%{
    border-radius: 100% 60% 60% 100% / 100% 100% 60% 60% ;
    transform: translate3d(0,-3px,0) rotateZ(0.01deg);
  }
}
#cover {
  background: #4AA594;
  position: absolute;
  height: 100%;
  width: 100%;
}
.spinner {
  width: 40px;
  height: 40px;
  top: 30%;

  position: relative;
  margin: 100px auto;
}

.double-bounce1, .double-bounce2 {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #333;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;

  -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
  animation: sk-bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

@-webkit-keyframes sk-bounce {
  0%, 100% { -webkit-transform: scale(0.0) }
  50% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bounce {
  0%, 100% {
    transform: scale(0.0);
    -webkit-transform: scale(0.0);
  } 50% {
    transform: scale(1.0);
    -webkit-transform: scale(1.0);
  }
}

 </style>
