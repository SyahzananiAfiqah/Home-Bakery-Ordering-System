<?php include('partials-front/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

    <h1 class="heading">Frequently Asked Questions</h1>

    <div class="accordion-container">

        <div class="accordion active">
            <div class="accordion-heading">
                <h3>How do I place an order?</h3>
                <i class="fas fa-angle-down"></i>
            </div>
            <p class="accordion-content">
            Placing an order is simple! Just browse our selection of kek lapis, choose your desired flavors and quantities, and proceed to the checkout page. Fill in your delivery details and payment information, and you're all set!
            </p>
        </div>

        <div class="accordion">
            <div class="accordion-heading">
                <h3>What payment methods do you accept?</h3>
                <i class="fas fa-angle-down"></i>
            </div>
            <p class="accordion-content">
            We accept various payment methods, including credit/debit cards and online payment platforms. Cash on delivery may also be available for certain locations.
            </p>
        </div>

        <div class="accordion">
            <div class="accordion-heading">
                <h3>What is the lead time for placing an order?</h3>
                <i class="fas fa-angle-down"></i>
            </div>
            <p class="accordion-content">
            We recommend placing your order at least two weeks in advance. This allows us to bake your kek lapis to perfection and arrange for timely delivery.
            </p>
        </div>

        <div class="accordion">
            <div class="accordion-heading">
                <h3>How should I store the kek lapis after receiving it?</h3>
                <i class="fas fa-angle-down"></i>
            </div>
            <p class="accordion-content">
            To maintain the freshness and flavor, store the kek lapis in an airtight container at room temperature. Avoid direct sunlight and keep it away from heat sources. Properly stored, our kek lapis can stay delicious for several days.
            </p>
        </div>

        <div class="accordion">
            <div class="accordion-heading">
                <h3> Do you offer international shipping?</h3>
                <i class="fas fa-angle-down"></i>
            </div>
            <p class="accordion-content">
            Currently, we only offer shipping within Malaysia. We're working on expanding our services in the future, so stay tuned for updates!
            </p>
        </div>

    </div>

</div>


<script>

let accordions = document.querySelectorAll('.accordion-container .accordion');

accordions.forEach(acco =>{
    acco.onclick = () =>{
        accordions.forEach(subAcco => { subAcco.classList.remove('active') });
        acco.classList.add('active');
    }
})

</script>

    
</body>
</html>

<?php include('partials-front/footer.php'); ?>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');

body{
  background: black;
}

.container .heading{
  text-align: center;
  font-size: 30px;
  padding:20px;
  margin-bottom: 20px;
  color: white;
}

.container .accordion-container .accordion.active .accordion-heading{
  background: crimson;
}

.container .accordion-container .accordion.active .accordion-heading h3{
  color:#fff;
}

.container .accordion-container .accordion.active .accordion-heading i{
  color:#fff;
  transform: rotate(180deg);
  transition: transform .2s .1s;
}

.container .accordion-container .accordion.active .accordion-content{
  display: block;
}

.container .accordion-container .accordion .accordion-heading{
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap:10px;
  background: #fff;
  border:2px solid #000;
  padding:15px 20px;
}

.container .accordion-container .accordion .accordion-heading h3{
  font-size: 18px;;
}

.container .accordion-container .accordion .accordion-heading i{
  font-size: 25px;;
}

.container .accordion-container .accordion .accordion-content{
  padding:15px 20px;
  border:2px solid #000;
  font-size: 15px;
  background: #fff;
  border-top: 0;
  display: none;
  animation: animate .2s linear backwards;
  line-height: 2;
  transform-origin: top;
}

@keyframes animate {
  0%{
    transform: scaleY(0);
  }
}

</style>