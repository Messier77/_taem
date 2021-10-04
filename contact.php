<?php include "./includes/db.php";?>

<?php 

$errors = [];

$name = '';
$email = '';
$phone = '';
$message = '';

if(isset($_POST['submit'])) {
    // add product to database

    $name = $_POST['name'];
    if(empty($name)) {
        $errors['name'] = 'Name cannot be empty!';
    }

    $email = $_POST['email'];
    if(empty($email)) {
        $errors['email'] = 'Email cannot be empty!';
    }

    $phone = $_POST['phone'];
    
    $message = $_POST['message'];
    
    if(empty($errors)) {
        insert_message($name, $email, $phone, $message);

        $success_message = "It worked";
        $_SESSION['success_message'] = 'Message succesfully sent';
        
    } 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="shortcut icon" href="./images/icons/Logo-simbol-black.svg" type="image/x-icon">
    <title>Trial and Error Makers | Crafting and shit</title>
</head>

<body>
    <!-- This is the navigation menu -->
    <nav>
        <!-- Social icons in the header -->
        <div class="social-header">
            <ul>
                <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon.svg" alt=""></a></li>
                <li><a href="https://www.facebook.com/TrialAndErrorMakers/" target="_blank"><img src="./images/icons/facebook-icon.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/trialanderrormakers/" target="_blank"><img src="./images/icons/instagram-icon.svg" alt=""></a></li>
                <li><a href="https://twitter.com/taemakers/" target="_blank"><img src="./images/icons/twitter-icon.svg" alt=""></a></li>
                <li class="header-icon-mobile"><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon-header-mobile.svg" alt=""></a></li>
            </ul>
        </div>

        <!-- Logo -->
        <a href="./"><div class="logo">
        </div>
        <div class="logo2">
        </div></a>

        <!-- Navigation menu -->
        <div class="nav-menu">
            <ul>
                <li><a href="./work.php">Work</a></li>
                <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank">YouTube Channel</a></li>
                <li><a href="./contact.php" class="menu-active">Meet us</a></li>
                <li class="header-icon-mobile"><img class="burger-image" src="./images/icons/burger-menu.svg" alt=""></li>
            </ul>
        </div>
    </nav>
    <div class="mobile-nav">
        <ul>
            <li><a href="./work.php">Work</a></li>
            <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank">YouTube Channel</a></li>
            <li><a href="./contact.php">Meet us</a></li>
        </ul>

        <ul class="burger-social">
            <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon.svg" alt=""></a></li>
            <li><a href="https://www.facebook.com/TrialAndErrorMakers/" target="_blank"><img src="./images/icons/facebook-icon.svg" alt=""></a></li>
            <li><a href="https://www.instagram.com/trialanderrormakers/" target="_blank"><img src="./images/icons/instagram-icon.svg" alt=""></a></li>
            <li><a href="https://twitter.com/taemakers/" target="_blank"><img src="./images/icons/twitter-icon.svg" alt=""></a></li>
        </ul>
    </div>

    <!-- About us section -->
    <section class="projects">
        <div class="section-title">
            <h1 class="h1-work">Meet us</h1>
            <p class="meet-us">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex facilis doloribus sunt quisquam, animi ratione quibusdam quod doloremque culpa, iste nobis non beatae cupiditate? Dolorum magnam repellat iusto, eum voluptatum ratione vitae necessitatibus recusandae illo, amet, ex aspernatur aliquam facere natus ullam autem alias quasi accusantium adipisci suscipit assumenda. Debitis ipsam quas tenetur nihil quia consequuntur, veritatis, commodi excepturi dolorem illo, repellendus eligendi dolores mollitia harum cupiditate dolor velit neque. Commodi ab minima fugiat placeat.</p>
        </div>

        <div class="us">
            <div class="dragos">
                <div class="mypicture">
                    <img src="./images/contact/dragos.jpg" alt="">
                </div>
                <div class="about-me">
                    <h2>Hi, I'm Dragos!</h2>
                    <h5>Description</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit eos placeat, hic beatae iure minima omnis tempore error saepe? Quos qui recusandae nostrum, at exercitationem dolores odit. Quod voluptates at natus quos nesciunt voluptas necessitatibus odio dolorum, laborum modi porro consequuntur qui temporibus eius?</p>
                </div>
            </div>

            <div class="teo">
                <div class="mypicture">
                    <img src="./images/contact/teo.jpg" alt="">
                </div>
                <div class="about-me">
                    <h2>Hi, I'm Teo!</h2>
                    <h5>Description</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit eos placeat, hic beatae iure minima omnis tempore error saepe? Quos qui recusandae nostrum, at exercitationem dolores odit. Quod voluptates at natus quos nesciunt voluptas necessitatibus odio dolorum, laborum modi porro consequuntur qui temporibus eius?</p>
                </div>
            </div>
        </div>

        <div class="where">
            <h3>Where can you find us?</h3>
            <div class="platforms">
                <div class="platform">
                    <h5>On YouTube</h5>
                    <div class="link">
                        <a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon.svg" alt="">youtube.com/trialanderrormakers</a>
                    </div>
                </div>
                <div class="platform">
                    <h5>On Facebook</h5>
                    <div class="link">
                        <a href="https://www.facebook.com/trialanderrormakers" target="_blank"><img src="./images/icons/facebook-icon.svg" alt="">facebook.com/trialanderrormakers</a>
                    </div>
                </div>
                <div class="platform">
                    <h5>On Instagram</h5>
                    <div class="link">
                        <a href="https://www.instagram.com/trialanderrormakers" target="_blank"><img src="./images/icons/instagram-icon.svg" alt="">instagram.com/trialanderrormakers</a>
                    </div>
                </div>
                <div class="platform">
                    <h5>On Twitter</h5>
                    <div class="link">
                        <a href="https://www.twitter.com/trialanderrormakers" target="_blank"><img src="./images/icons/twitter-icon.svg" alt="">twitter.com/trialanderrormakers</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="contact-form">
        <div class="contact-container">
            <h3>Contact Us</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row100">
                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="name" required="required" autocomplete="off">
                            <span class="text">Name *</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="inputBox">
                            <input type="email" name="email" required="required" autocomplete="off">
                            <span class="text">Email *</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="phone" required="required" autocomplete="off">
                            <span class="text">Phone number</span>
                        </div>
                    </div>
                </div>
                <div class="row100">
                    <div class="col textarea-col">
                        <div class="inputBox textarea">
                            <textarea required="required" id="textarea-resize" name="message" autocomplete="off" oninput="auto_grow(this)"></textarea>
                            <span class="text">Message</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>
                <div class="row100">
                    <div class="col submit">
                        <input type="submit" name="submit" value="Send">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- This is the footer -->
    <div class="footer">
        <div class="info-footer">
            <p>&copy; 2020 <span>Trial And Error Makers</span></p>
        </div>

        <div class="footer-logo">
            <a href="./"><img src="./images/icons//Footer-logo.svg" alt=""></a>
        </div>

        <div class="social-footer">
            <ul>
                <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon-white.svg" alt=""></a></li>
                <li><a href="https://www.facebook.com/TrialAndErrorMakers/" target="_blank"><img src="./images/icons/facebook-icon-white.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/trialanderrormakers/" target="_blank"><img src="./images/icons/instagram-icon-white.svg" alt=""></a></li>
                <li><a href="https://twitter.com/taemakers/" target="_blank"><img src="./images/icons/twitter-icon-white.svg" alt=""></a></li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./scripts/scripts.js"></script>
</body>

</html>