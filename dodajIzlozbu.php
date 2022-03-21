<html>
<link rel="stylesheet" href="dodajIzlozbu.css" >
<div class='signup-container'>
  <div class='left-container'>
    <h1>
    IZLOZBE
    </h1>
    <div class='puppy'>
      <img src='pocetna/Screenshot_95.png'>
    </div>
  </div>
  <div class='right-container'>
  <div class="right1">
  <div class="right11">
    <header>
    <h1>Dodaj izlozbu</h1>
    <form action="dodavanje.php" method="post" id="forma1">
      <div class='set'>
        <div class='pets-name'>
          <label for='pets-name'>Naziv</label>
          <input id='pets-name' placeholder="Naziv izlozbe" name="naziv" type='text' required>
        </div>
        <div class='pets-breed'>
          <label for='pets-breed'>Grad</label>
          <input id='pets-breed' placeholder="Grad" name="grad" type='text' required>
        </div>
        <div class='pets-birthday'>
          <label for='pets-birthday'>Datum i vreme</label>
          <input id='pets-birthday' name="datum" placeholder='YYYY-MM-DD H:M' type='datetime-local' required>
        </div>
      </div>
    </form>
    </header>
  </div>

  <div class="right2">
    <header>
    <h1>Izmeni izlozbu</h1>
    <form action="azuriranje.php" method="post" id="forma2">
      <div class='set'>
        <div class='pets-name'>
        <label for='pets-name'>Naziv</label>
        <select name="izlozba" id="izlozba" required>
            <?php
              include_once 'dbConfig.php';
              session_start();
              $user=$_POST['userL'];
              $sqli = "SELECT id,naziv FROM izlozba where kreator='$user';";
              $result = pg_query($cn, $sqli);
              while ($row = pg_fetch_array($result)) {
                echo '<option value='.$row['id'].'>'.$row['naziv'].'</option>';
                  }
            ?> 
        </select>
        </div>
        <div class='pets-birthday'>
          <label for='pets-birthday'>Datum i vreme</label>
          <input id='pets-birthday' name="novidatum" placeholder='YYYY-MM-DD H:M' type='datetime-local' required>
        </div>
      </div>
    </form>
    </header>
  </div>
  </div>
    <footer>
      <div class='set'>
        <button type="sumbit" form="forma1" name="dodaj" id='next'>Dodaj izlozbu</button>
        <button type="sumbit" form="forma2" name="izmeni" id='izmeni'>Izmeni izlozbu</button>
      </div>
      

    </footer>
</div>
</div>
</html>