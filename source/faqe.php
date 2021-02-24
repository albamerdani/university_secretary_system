<header id="header">
<link rel="stylesheet" type="text/css" href="style/header.css">
<h1>Miresevini ne portalin e sekretarise mesimore</h1><img src="images/logo.jpg" id="logo">



	<div id = "cover">
		<img class="slide" src="images/upt.jpg">
		<img class = "slide" src="images/fti.jpg">
		<img class = "slide" src="images/fie.jpg">
		<button  class="btn" id = "prev" onclick = "plusIndex(-1)">&#10094;</button>
		<button class="btn" id = "next" onclick = "plusIndex(1)">&#10095;</button>
	</div>
<script>
jQuery(window).load(function(){
jQuery('#cover').flexslider({
namespace: "flex-",                             
selector: "div > img",                        
animation: "fade",          
easing: "swing",                                 
direction: "horizontal",          
reverse: false,                                  
animationLoop: true,                             
smoothHeight: false,                            
startAt: 0,                                      
slideshow: true,                                 
slideshowSpeed: "5000", 
animationSpeed: 1500,                            
initDelay: 0,                                   
randomize: false,                                
pauseOnAction: true,                             
pauseOnHover: false,                             
useCSS: true,                                   
touch: true,                                     
video: false,                                   
controlNav: 1,           
directionNav: 1,       
prevText: "Previous",                            
nextText: "Next",                               
keyboard: true,                                  
multipleKeyboard: false,                         
mousewheel: false,                               
pausePlay: false,                               
pauseText: "Pause",                              
playText: "Play",                                
controlsContainer: "",                           
manualControls: "",                              
sync: "",                                       
asNavFor: "",                                   
itemWidth: 0,                                    
itemMargin: 0,                                  
minItems: 0,                                     
maxItems: 0,                                     
move: 0,                                         
});
});
</script>
<script type="text/javascript">

var slideIndex = 1;
showSlides(slideIndex);

	
function plusIndex(n){  
	showSlides(slideIndex +=n);

}

function showSlides(n) {
    var i;
    var slide = document.getElementsByClassName("slide");
	
	if (n > slide.length) {slideIndex = 1};
	if (n < 1) {slideIndex = slide.length};	
    for (i = 0; i < slide.length; i++)
	{
       slide[i].style.display = "none";  
    }
	
	slide[slideIndex-1].style.display = "block";
	setInterval(showSlides,2000);
}
</script>



<!--
<div class="container" id="slider">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators --
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="item1 active"></li>
    <li data-target="#myCarousel" data-slide-to="1" class="item2"></li>
    <li data-target="#myCarousel" data-slide-to="2" class="item3"></li>
  </ol>

  <!-- Wrapper for slides --
  <div class="carousel-inner">
    <div class="item active">
      <img src="upt.jpg" alt="UPT">
      <div class="carousel-caption">
        <p>Universiteti Politeknik i Tiranes!</p>
      </div>
    </div>

    <div class="item">
      <img src="fti.jpg" alt="FTI">
      <div class="carousel-caption">
        <p>Fakulteti i Teknologjise se Informacionit</p>
      </div>
    </div>

    <div class="item">
      <img src="fie.jpg" alt="FIE">
      <div class="carousel-caption">
        <p>Fakulteti i Inxhinierise Elektrike</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls --
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>



<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myCarousel").carousel();
    
    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#myCarousel").carousel(2);
    });
    
    // Enable Carousel Controls
    $(".left").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".right").click(function(){
        $("#myCarousel").carousel("next");
    });
});
</script>
-->
</header>