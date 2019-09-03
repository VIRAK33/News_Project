<?php
include "header.php";
include "nav_bar.php";
?>

<div class="contact-body">
    <div class="text">
        <h1><span>Contact</span> Us</h1>
        <p>Please fill out the form below to contact us</p>
    </div>
    <form method="POST">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="form-control" type="text" name="username" id="username" value="" required="">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="form-group">
                        <label>Email:</label>
                        <input class="form-control" type="Email" name="email" id="email" value="" required="">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="form-group">
                        <label>Message:</label>
                        <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>

                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12 ">
                    <div class="form-group">
                        <button class="btn btn-success">Login</button>
                    <br><br>
                        <p class="text-danger">
                                                    </p>
                    </div>
                </div>

                
            </div>
        </form>



</div>

<div class="info">
    <div class="location">
        <h3>Location</h3><br>
        <p>271 st, Phnom Penh, Cambodia</p>
    </div>
    <div class="phone">
        <h3>Phone Number</h3><br>
        <p>(855)969 633-694</p>
    </div>
    <div class="email">
        <h3>Email Address</h3><br>
        <p>seamvirak.itc@gmail.com</p>
    </div>
</div>


<?php
include "footer.php";

?>