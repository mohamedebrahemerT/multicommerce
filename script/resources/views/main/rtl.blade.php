<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap');
html,body{
    direction: rtl;
    text-align: right;
    font-family: 'Tajawal', sans-serif;
}
h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 , .btn{
    font-family: 'Tajawal', sans-serif;
}
.banner {
    background-image: url(../../img/banner_rtl.svg) !important;
    background-position: right top;
}
.navbar-brand {
    margin-right: 0;
    margin-left: 5rem;
}
.mr-auto{
    margin-left: auto!important;
    margin-right: 0 !important;
}
.ml-auto{
    margin-right: auto!important;
    margin-left: 0 !important;
}
.lang {
    margin-left: 0;
    margin-right: 20px;
}
.service h4 {
    padding-left: 20px;
    padding-right: 20px;
}
.text-left {
    text-align: right!important;
}
.text-right {
    text-align: left!important;
}
.footer-menu {
    padding: 0;
}
.footer-socials {
    padding: 0;
}
.slick-slider{direction: ltr}
.testimonial-block i{
    left: 46px;
    right: auto;
}
.testimonial-block.style-2 .testimonial-thumb img {
    margin-right: 0;
    display: inline-block;
}
.slider-thumb::before {
    left: auto  ;
    right: 20%;
}
@media (max-width: 567px) { 
    .banner{
        background-position: center !important;
        margin-top: 0;
        padding-top: 0;
    }
    nav {
        background: #544aa4;
        
    }
    .navbar-brand {
        margin-left: 0;
    }
    .icofont-navigation-menu {
        color: #fff;
    }
    .nav-item , .lang {
        text-align: right;
    }
    .features {
        margin-top: -270px;
    }
    .cta-section {
        background: #6051d7 url(../../img/bg_count.svg) no-repeat;
        background-size: 100%;
        height: auto;
    }
    .service .icon {
        float: none;
        flex-direction: column;
    }
    .service .content {
        clear: both;
        text-align: center;
    }
    .service .service-item {
        border: 1px solid #f1f1f1;
    }
    .testimonial-block i {
        font-size: 70px;
    }
    .overlay:before {
        background: #544aa4;
    }
 }

 @media (min-width: 768px) and (max-width: 979px) { 
    .overlay:before {
        background: #544aa4;
    }
    .banner {
        background-size: 100%;
    }
    .navigation {
        text-align: right;
        background: #574da7;
    }
    .icofont-navigation-menu {
        color: #fff;
    }
    .banner .block {
        padding: 20px 0px 203px;
    }
    .section.about {
        padding: 50px 0;
    }
    .cta-section {
        height: auto;
        background-color: #584bbe;
    }
  }
</style>