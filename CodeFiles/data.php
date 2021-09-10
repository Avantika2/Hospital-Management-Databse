<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      href="https://fonts.googleapis.com/css2?family=Signika:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />

    <title>SSA Hospital Data Page</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      
    body {
    background: url(./data.jpg);
    min-height: 100vh;
    background-size: cover;
    }

    header {
      display: flex;
      align-items: center;
      flex-direction: column;
      color: rgb(88, 84, 84);
      background: radial-gradient(#ffffff, #aaaaaa);
    }
    
    .nav {
      /* opacity: 0.3; */
      color: #fff;
      text-align: center;
      padding-top: 20px;
      margin: 1rem;
    }
    
    ul {
      margin-bottom: 1rem;
      /* opacity: 0.4; */
    }
    
    li {
      list-style-type: none;
      display: inline-block;
      padding: 1rem;
      background: radial-gradient(#ffffff, #fce5e5);
      border-radius: 3px;
      margin: 1rem;
      font-weight: 700;
      font-family: "Poppins", sans-serif;
    }
    
    ul > li > a {
      text-decoration: none;
      color: rgb(51, 30, 30);
    }
    
    a {
      text-decoration: none;
      color: rgb(51, 30, 30); 
       }
    
    a:hover {
      color: #fff;
      color: #000;
      letter-spacing: 3px;
      opacity: 1 !important;
    }
    
    h1 {
      font-family: "Signika", sans-serif;
      font-weight: 900;
      font-size: 2.5rem;
      padding: 1rem;
      color: rgb(88, 84, 84);
    }
    
    h3 {
      font-family: "Roboto Slab", serif;
      font-weight: 700;
      font-size: 1rem;
      letter-spacing: 10px;
    
      padding-bottom: 1.5rem;
    }
    
    .images {
      display: flex;
      align-items: center;
      flex-direction: column;
      font-family: "Noto Sans", sans-serif;
      padding: 1.5rem;
    }
    
    p {
      display: block;
      width: 30%;
      color: rgb(46, 43, 43);
    }
    
    .container{
        /* opacity: 0.3; */
        color: #fff;
        text-align: center;
        padding-top: 20px;
        margin: 1rem;
    }
    .text {
      color: #000;
      text-align: center;
      padding-top: 20px;
      margin: 1rem;
      font-size: 1.2rem;
      font-weight: 700;
      font-family: "Poppins", sans-serif;
      line-height: 3rem;
      display: block;
      
    }
    </style>
  </head>
  <body>
    <header id="top">
      <h1>SSA HOSPITAL</h1>
      <h3>PERSONALISING HEALTHCARE</h3>
    </header>
    <div class="nav">
      <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="data.php">DATA</a></li>
        <li><a href="contact.php">CONTACT</a></li>
      </ul>
    </div>
      <?php 
   
        echo "
          
          <div class='text'>
            <ul>
              <li> <a href='covid_patients.php'> Patients Table Details </a></li>
              <li><a href='covid_hospital.php'> Hospital Table Details </a></li>
            </ul>
          ";
   
      ?>
  </body>
</html>