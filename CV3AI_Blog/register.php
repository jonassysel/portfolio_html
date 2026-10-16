<?php
require_once('layout/header.php');
?>

<?php
require_once('layout/navigation.php');
?>

<main class="container">

   <form method="POST" action="form_control/register_form.php">
       <label for="nickname">Nickname:</label>
       <input name="nickname" type="text" id="nickname">
       <br>
       <label for="password">Password:</label>
       <input name="password" type="password" id="password">
       <br>

       <label for="password2">Password again:</label>
       <input name="password2" type="password" id="password2">
       <br>
       <input type="submit" value="Registrovat se">
   </form>

</main>

<?php
require_once('layout/footer.php');
?>

</body>
</html>