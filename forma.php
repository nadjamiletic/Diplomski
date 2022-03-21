<html>
<body>
<link rel="stylesheet" href="forma.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class='signup-container'>
  <div class='left-container'>
    <h1>
    <i class="fa fa-paw"></i>
      DODAJ PSA
    </h1>
    <div class='puppy'>
      <img src='pocetna/pas.png'>
    </div>
  </div>
  <form action="dodajKraj.php" method="post" enctype="multipart/form-data">
  <div class='right-container'>
    <header>
      <div class='set'>
        <div class='pets-name'>
          <label for='pets-name'>Ime psa</label>
          <input name="ime" id='pets-name' placeholder="Ime" type='text' required>
        </div>
        <div class='pets-photo'>
          <label for='pets-upload'>Dodaj sliku</label>
          <input type="file" id='pets-name' name="image" required/>
        </div>
      </div>
      <div class='set'>
        <div class='pets-breed'>
          <label for='pets-breed'>Rasa</label>
          <select name="rasa" id="pets-name" required>
                        <?php
                        include_once 'dbConfig.php';
                        $query="SELECT unnest(rasa) from kategorija order by unnest(rasa) asc;";
                        $res=pg_query($cn,$query);
                        while ($row = pg_fetch_row($res)) {
                        foreach($row as $r)
                        {     
                            echo '<option>'.$r.'</option>';
                        }
                        }
                        ?>
        </select>
        </div>
        <div class='pets-birthday'>
          <label for='pets-birthday'>Starost</label>
          <input id='pets-birthday' name="starost" placeholder='Starost' type='text' required>
        </div>
      </div>
      <div class='set'>
        <div class='pets-gender'>
          <label for='pet-gender-female'>Pol</label>
          <div class='radio-container'>
            <input checked='' id='pet-gender-female' name='pol' type='radio' value='Z' required>
            <label for='pet-gender-female'>Zenski</label>
            <input id='pet-gender-male' name='pol' type='radio' value='M' required>
            <label for='pet-gender-male'>Muski</label>
          </div>
        </div>
      </div>
      <div class='pets-weight'>
        <label for='pet-weight-0-25'>Tezina</label>
        <div class='radio-container'>
          <input checked='' id='pet-weight-0-25' name='tezina' type='radio' value='5' required>
          <label for='pet-weight-0-25'>0-10 kg</label>
          <input id='pet-weight-25-50' name='tezina' type='radio' value='15' required>
          <label for='pet-weight-25-50'>10-20 kg</label>
          <input id='pet-weight-50-100' name='tezina' type='radio' value='35' required>
          <label for='pet-weight-50-100'>20-50 kg</label>
          <input id='pet-weight-100-plus' name='tezina' type='radio' value='75' required>
          <label for='pet-weight-100-plus'>50+ kg</label>
        </div>
      </div>
    </header>
    <footer>
      <div class='set'>
        <button name="uploadfile" id='next'>Dodaj</button>
      </div>
    </footer>
  </div>
</form>
</div>
</body>
</html>
