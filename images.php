<?php include('partials-front/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div id="side-menu" class="fas fa-bars"></div>   

<div class="side-bar">
   <h1 style="color: black class="heading">Filter Images</h1>
   <div class="box">
      <h3 class="title">search image :</h3>
      <input type="text" placeholder="search image..." id="search-box">
   </div>
   <div class="box">
      <h3 class="title">category :</h3>
      <div class="category">
         <div class="btn active" data-category="all"> all </div>
         <div class="btn" data-category="Cake">Cake</div>
         <div class="btn" data-category="Mix">Mix</div>
         <div class="btn" data-category="Doorgift">Doorgift</div>
         <div class="btn" data-category="Raya">Raya</div>
         <div class="btn" data-category="Pack">Packing</div>
      </div>
   </div>
   <div class="reset-btn"><div class="btn">reset all</div></div>
</div>

<div class="gallery">

   <h1 class="heading">image gallery</h1>

   <div class="image-container">
      <img src="images/img-1.jpg" data-cat="Cake" data-search="cake lumut cheese" alt="">
      <img src="images/img-2.jpg" data-cat="Cake" data-search="vector cookies christmas" alt="">
      <img src="images/img-3.jpg" data-cat="Cake" data-search="food corn cartoon png" alt="">
      <img src="images/img-4.jpg" data-cat="Cake" data-search="animal fish dolphin" alt="">
      <img src="images/img-5.jpg" data-cat="Raya" data-search="animal squirrel cute" alt="">
      <img src="images/img-6.jpg" data-cat="Pack" data-search="animal panda png cartoon" alt="">
      <img src="images/img-7.jpg" data-cat="Mix" data-search="animal penguine bird cartoon" alt="">
      <img src="images/img-8.jpg" data-cat="Doorgift" data-search="animal bird cute" alt="">
      <img src="images/img-9.jpg" data-cat="Mix" data-search="animal cat mouse cute png" alt="">
      <img src="images/img-10.jpg" data-cat="Raya" data-search="animal fish shark vector" alt="">
      <img src="images/img-11.jpg" data-cat="Raya" data-search="food orange" alt="">
      <img src="images/img-12.jpg" data-cat="Raya" data-search="food vector juice drink" alt="">
      <img src="images/img-13.jpg" data-cat="Raya" data-search="food chicken cartoon png" alt="">
      <img src="images/img-14.jpg" data-cat="Mix" data-search="food coffee bread breakfast" alt="">
      <img src="images/img-15.jpg" data-cat="Cake" data-search="food burger png cartoon" alt="">
      <img src="images/img-16.jpg" data-cat="Pack" data-search="food popcorn vector" alt="">
      <img src="images/img-17.jpg" data-cat="Doorgift" data-search="food pancake breakfast" alt="">
      <img src="images/img-18.jpg" data-cat="Cake" data-search="flower plants nature vector" alt="">
      <img src="images/img-19.jpg" data-cat="Raya" data-search="flower plants nature cartoon" alt="">
      <img src="images/img-20.jpg" data-cat="Cake" data-search="flower plants nature" alt="">
      <img src="images/img-21.jpg" data-cat="Cake" data-search="food popcorn vector" alt="">
      <img src="images/img-22.jpg" data-cat="Cake" data-search="food pancake breakfast" alt="">
      <img src="images/img-23.jpg" data-cat="Cake" data-search="flower plants nature vector" alt="">
      <img src="images/img-24.jpg" data-cat="Cake" data-search="flower plants nature cartoon" alt="">
      <img src="images/img-25.jpg" data-cat="Cake" data-search="flower plants nature" alt="">
      <img src="images/img-26.jpg" data-cat="Cake" data-search="animal bird cute chicks" alt="">
      <img src="images/img-27.jpg" data-cat="Raya" data-search="vector cookies christmas" alt="">
      <img src="images/img-28.jpg" data-cat="Pack" data-search="food corn cartoon png" alt="">
      <img src="images/img-29.jpg" data-cat="Cake" data-search="animal fish dolphin" alt="">
      <img src="images/img-30.jpg" data-cat="Pack" data-search="animal squirrel cute" alt="">
      <img src="images/img-31.jpg" data-cat="Pack" data-search="animal panda png cartoon" alt="">
      <img src="images/img-32.jpg" data-cat="Raya" data-search="animal penguine bird cartoon" alt="">
      <img src="images/img-33.jpg" data-cat="Cake" data-search="animal bird cute" alt="">
      <img src="images/img-34.jpg" data-cat="Pack" data-search="animal cat mouse cute png" alt="">
      <img src="images/img-35.jpg" data-cat="Cake" data-search="animal fish shark vector" alt="">
      <img src="images/img-36.jpg" data-cat="Doorgift" data-search="food orange" alt="">
      <img src="images/img-37.jpg" data-cat="Mix" data-search="food vector juice drink" alt="">
      <img src="images/img-38.jpg" data-cat="Mix" data-search="food chicken cartoon png" alt="">
      <img src="images/img-39.jpg" data-cat="Doorgift" data-search="food coffee bread breakfast" alt="">
      <img src="images/img-40.jpg" data-cat="Raya" data-search="food burger png cartoon" alt="">
      <img src="images/img-41.jpg" data-cat="Cake" data-search="food popcorn vector" alt="">
      <img src="images/img-42.jpg" data-cat="Cake" data-search="food pancake breakfast" alt="">
      <img src="images/img-43.jpg" data-cat="Mix" data-search="flower plants nature vector" alt="">
      <img src="images/img-44.jpg" data-cat="Cake" data-search="flower plants nature cartoon" alt="">
      <img src="images/img-45.jpg" data-cat="Doorgift" data-search="flower plants nature" alt="">
      <img src="images/img-46.jpg" data-cat="Cake" data-search="food popcorn vector" alt="">
      <img src="images/img-47.jpg" data-cat="Raya" data-search="food pancake breakfast" alt="">
      <img src="images/img-48.jpg" data-cat="Pack" data-search="flower plants nature vector" alt="">
      <img src="images/img-49.jpg" data-cat="Cake" data-search="flower plants nature cartoon" alt="">
      <img src="images/img-50.jpg" data-cat="Cake" data-search="flower plants nature" alt="">
      <img src="images/img-51.jpg" data-cat="Cake" data-search="animal panda png cartoon" alt="">
      <img src="images/img-52.jpg" data-cat="Raya" data-search="animal penguine bird cartoon" alt="">
      <img src="images/img-53.jpg" data-cat="Cake" data-search="animal bird cute" alt="">
      <img src="images/img-54.jpg" data-cat="Pack" data-search="animal cat mouse cute png" alt="">
      <img src="images/img-55.jpg" data-cat="Cake" data-search="animal fish shark vector" alt="">
      <img src="images/img-56.jpg" data-cat="Cake" data-search="food orange" alt="">
      <img src="images/img-57.jpg" data-cat="Cake" data-search="food vector juice drink" alt="">
      <img src="images/img-58.jpg" data-cat="Pack" data-search="food chicken cartoon png" alt="">
      <img src="images/img-59.jpg" data-cat="Raya" data-search="food coffee bread breakfast" alt="">
      <img src="images/img-60.jpg" data-cat="Cake" data-search="food burger png cartoon" alt="">
      <img src="images/img-61.jpg" data-cat="Doorgift" data-search="food popcorn vector" alt="">
      <img src="images/img-62.jpg" data-cat="Cake" data-search="food pancake breakfast" alt="">
   </div>

</div>

<div class="image-popup">
   <img src="" alt="">
</div>


<script src="js/script.js"></script>

</body>
</html>


<?php include('partials-front/footer.php'); ?>


<script>

let sideMenu = document.querySelector('#side-menu');
let sideBar = document.querySelector('.side-bar');

sideMenu.onclick = () =>{
   sideMenu.classList.toggle('fa-times');
   sideBar.classList.toggle('active');
};

let galleryImages = document.querySelectorAll('.image-container img');
let imagePop = document.querySelector('.image-popup');

galleryImages.forEach(img =>{
   img.onclick = () =>{
      let imageSrc = img.getAttribute('src');
      imagePop.style.display = 'flex';
      imagePop.querySelector('img').src = imageSrc;
   };
});

imagePop.onclick = () =>{
   imagePop.style.display = 'none';
};

document.querySelector('#search-box').oninput = () =>{
   var value = document.querySelector('#search-box').value.toLowerCase();
   galleryImages.forEach(img =>{
      var filter = img.getAttribute('data-search').toLowerCase();
      if(filter.indexOf(value) > -1){
         img.style.display = 'block';
      }else{
         img.style.display = 'none';
      };
   });
};

let categoryBtn = document.querySelectorAll('.category .btn');

categoryBtn.forEach(btn =>{
   btn.onclick = () =>{
      categoryBtn.forEach(remove => remove.classList.remove('active'));
      let dataCategory = btn.getAttribute('data-category');
      galleryImages.forEach(img =>{
         var imgCat = img.getAttribute('data-cat');
         if(dataCategory == 'all'){
            img.style.display = 'block';
         }else if(dataCategory == imgCat){
            img.style.display = 'block';
         }else{
            img.style.display = 'none';
         }
      });
      btn.classList.add('active');
   };
});

let typeBtn = document.querySelectorAll('.type .btn');

typeBtn.forEach(btn =>{
   btn.onclick = () =>{
      typeBtn.forEach(remove => remove.classList.remove('active'));
      let datatype = btn.getAttribute('data-type');
      galleryImages.forEach(img =>{
         var imgtype = img.getAttribute('src').split('.').pop();
         if(datatype == 'all'){
            img.style.display = 'block';
         }else if(datatype == imgtype){
            img.style.display = 'block';
         }else{
            img.style.display = 'none';
         }
      });
      btn.classList.add('active');
   };
});

document.querySelector('.reset-btn .btn').onclick = () =>{
   window.location.reload();
};

    </script>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root{
   --crimson:crimson;
   --black:#333;
   --white:#fff;
   --light-black:#666;
   --light-bg:#eee;
   --dark-bg:rgba(0,0,0,.7);
   --border:1px solid #999;
   --box-shadow:0 5px 10px rgba(0,0,0,.1);
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   transition: all .2s linear;
}

body{
   background-color: black;
}

::-webkit-scrollbar{
   width: 10px;
}

::-webkit-scrollbar-track{
   background-color: transparent;
}

::-webkit-scrollbar-thumb{
   background-color: var(--black);
}

.heading{
   margin-bottom: 20px;
   font-size: 30px;
   color:white;
   text-transform: uppercase;
   text-align: center;
}

.btn{
   margin-top: 10px;
   display: inline-block;
   padding:10px 30px;
   cursor: pointer;
   font-size: 17px;
   background-color: var(--light-bg);
   color:var(--black);
   text-transform: capitalize;
   text-align: center;
}

.btn:hover{
   background-color: var(--crimson);
   color:var(--white);
}

.gallery{
   padding:20px;
   text-align: center;
   padding-left: 320px;
}

.gallery .image-container{
   gap:15px;
   columns:3 350px;
}

.gallery .image-container img{
   break-inside: avoid;
   width: 100%;
   background-color: var(--white);
   object-fit: cover;
   cursor: pointer;
   margin-bottom: 10px;
   box-shadow: var(--box-shadow);
}

.gallery .image-container img:hover{
   transform: scale(.95);
}

.side-bar{
   height: 100vh;
   width: 300px;
   position: fixed;
   top:0; left:0;
   z-index: 1000;
   background-color: var(--white);
   padding:20px;
   border-right: var(--border);
   overflow-y: scroll;
}

.side-bar::-webkit-scrollbar{
   width: 5px;
}

.side-bar .box{
   border-bottom: var(--border);
   padding:20px 0;
}

.side-bar .box .title{
   margin-bottom: 10px;
   color:var(--black);
   font-size: 20px;
   text-transform: uppercase;
}

.side-bar .btn{
   margin-left: 5px;
}

.side-bar .btn.active{
   background-color: var(--crimson);
   color:var(--white);
}

.side-bar .box #search-box{
   border:var(--border);
   padding:12px;
   text-transform: none;
   color:var(--light-black);
   width: 100%;
   font-size: 17px;
}

.side-bar .reset-btn .btn{
   margin-top: 20px;
   width: 100%;
}

#side-menu{
   position: fixed;
   top:20px; left:20px;
   height: 50px;
   width: 50px;
   line-height: 50px;
   text-align: center;
   background-color: var(--white);
   color:var(--black);
   cursor: pointer;
   font-size: 25px;
   z-index: 1100;
   box-shadow: var(--box-shadow);
   border:var(--border);
   display: none;
}

.image-popup{
   position: fixed;
   top:0; left:0;
   z-index: 1200;
   background-color: var(--dark-bg);
   height: 100vh;
   width: 100%;
   display: none;
   align-items: center;
   justify-content: center;
   padding:100px 20px;
   overflow-y: scroll;
}

.image-popup img{
   width:600px;
   cursor: pointer;
   border:10px solid var(--white);
   background-color: var(--white);
}





@media (max-width:1200px){

   .gallery{
      padding-left: 20px;
   }

   #side-menu{
      display: block;
   }

   #side-menu.fa-times{
      top:0;
      left: 300px;
   }

   .side-bar{
      left: -350px;
   }

   .side-bar.active{
      box-shadow: 0 0 0 100vw var(--dark-bg);
      left:0;
      z-index: 1000;
   }

}

@media (max-width:768px){

   .image-popup img{
      width: 100%;
   }

}

@media (max-width:450px){

   #side-menu.fa-times{
      top:10px;
      left: 10px;
   }

   .side-bar.active{
      padding-top: 70px;
   }

}

    </style>