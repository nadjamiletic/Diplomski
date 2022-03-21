<!DOCTYPE html>
<html>
    <link href="kreatorPrijava.css" rel="stylesheet">   
<body>
<section class="forms-section">
    <h1 class="section-title">Zahtev za sudiju</h1>
    <div class="forms">
      <div class="form-wrapper is-active">
        <button type="button" class="switcher switcher-signup">
          Kreiranje naloga
          <span class="underline"></span>
        </button>
        <form action="dodajSudiju.php" method="post" class="form form-signup">
          <fieldset>
            <div class="input-block">
                <label for="signup-ime">Ime</label>
                <input id="signup-ime" name="ime" type="text" required>
            </div>
            <div class="input-block">
                <label for="signup-prezime">Prezime</label>
                <input id="signup-prezime" name="prezime" type="text" required>
            </div>
            <div class="input-block">
              <label for="signup-username">Username</label>
              <input id="signup-username" name="userS" type="text" required>
            </div>
            <div class="input-block">
              <label for="signup-password">Password</label>
              <input id="signup-password" name="passS" type="password" required>
            </div>

            <div class="input-block">
              <label for="signup-password">Kategorija: </label>
              <select name="nizkat" id="izlozba" required>
              <?php
              include_once 'dbConfig.php';
              $sqli = "SELECT kategorija FROM kategorija order by kategorija asc;"; 
              $result = pg_query($cn, $sqli);
              while ($ro = pg_fetch_array($result)) {
                echo '<option value="'.$ro['kategorija'].'">'.$ro['kategorija'].'</option>';
              }
              ?> 
              </select>
            </div>
          </fieldset>
          <button type="submit" name="submit" class="btn-signup">Kreiraj nalog</button>
        </form>
      </div>
    </div>
</section>
</body>
</html>