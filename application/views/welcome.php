<div style="height:300px;width:100%;border:1px solid chocolate;" align="center">
    <span style="color:brown;font-weight:bold;font-size:20;">
        <?php
        echo "Version".PI_VERSION." Beta<br>";
        echo "Welcome to PHP-ignite";
        
        ?>
    </span> <br>
    <?php //var_dump($userdetails); ?>
    <span  style="font-weight:bold;margin-top:15px;"> <?php echo "This is Beta version. Soon you can enjoy all its features and simplicity."; ?></span>
</div>
<?php echo $errors; ?>

<form method="post" action="<?php echo  "http://localhost/phpignite/index.php/welcome/index";  ?>" >  
    <input type="text"  name="name" />
    <input type="text"  name="country" />
    <input type="submit" name="txtSubmit" value="Submit"/>
</form>