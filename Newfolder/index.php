<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
        <?php
        include_once 'function.php';
        
        if (isset($_POST['submit'])) {

            $name = $_POST['fname'];
            $lname = $_POST['lname'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];


            if (emailchek($email)) {

                insert($email, $pass1, $name, $lname, $mobile);
                echo 'ثبت نام موفقیت آمیز بود';
                


                }
                else {


                ?>


                <form action="index.php">


                    <input  type="submit" value="بازگشت" name="submit2">
                </form>   




                <?php
                echo 'این ایمیل قبلا ثبت شده است';
            }
        } else {
            ?>


            <div align="right" dir="rtl">   
                <form action="index.php" method="post">


                    <label for="fname">نام : </label><br>
                    <input type="text" id="fname" name="fname" placeholder="نام" required><br>

                    <label for="lname">نام خانوادگی:</label><br>
                    <input type="text" id="lname" name="lname" placeholder="نام خانوادگی" required><br>

                    <label for="pass1">رمز عبور : </label><br>
                    <input type="password" onChange="onChange()" id="pass1" name="pass1" placeholder="Password" required><br>

                    <label for="pass2"> تکرار رمز عبور:  </label><br>
                    <input type="password" onChange="onChange()" id="pass2" name="pass2" placeholder="Password" required><br>

                    <label for="email">ایمیل : </label><br>
                    <input type="text" id="email" name="email" placeholder="exa@example.com" required><br>

                    <label for="mobile">شماره موبایل : </label><br>
                    <input type="text"  id="mobile" name="mobile" placeholder="--------091" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / ><br>
                    <br>
                    <input  type="submit" value="ثبت نام" name="submit">
                    <input type="reset" value="پاک کردن">


                </form> 

            </div>
<?php }; ?>
    </body>
    <script>

        var password = document.getElementById("pass1")
                , confirm_password = document.getElementById("pass2");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("کلید واژه ها یکی نیستند");
            } else {
                confirm_password.setCustomValidity('');
            }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

    </script>
</html>




