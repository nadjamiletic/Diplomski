<!DOCTYPE html>
<html>
    <link href="administrator.css" rel="stylesheet">   
<body>
<section class="forms-section">
    <h1 class="section-title">Administrator</h1>
    <div class="forms">
      <div class="form-wrapper is-active">
        <form action="proveraIzlozbi.php" method="post" class="form form-login">
          <fieldset>
            <div class="input-block">
              <label for="login-user">Username</label>
              <input id="login-user" type="text" name="user" required>
            </div>
            <div class="input-block">
              <label for="login-password">Password</label>
              <input id="login-password" type="password" name="pass" required>
            </div>
          </fieldset>
          <button type="submit" name="submit1" class="btn-login">Prijavi se</button>
        </form>
      </div>
    </div>
</section>
</body>
</html>