<?php
    include 'Swebtite.php';
    $conn = OpenCon();

    closeCon($conn);
    ?>


<html lang="en">
<body>
  <form action="insert.php" method="POST">
    <table>
      <tr>
        <td>Voornaam :</td>
        <td><input type="text" name="firstName"></td>
      </tr>
      <tr>
        <td>Achternaam :</td>
        <td><input type="text" name="lastName"></td>
      </tr>
      <tr>
        <td>Email :</td>
        <td><input type="email" name="email"></td>
      </tr>
      <tr>
        <td>Versturen :</td>
        <td><input type="submit" name="submit" value="submit"></td>
      </tr>
    </table>
  </form>
</body>
</html>