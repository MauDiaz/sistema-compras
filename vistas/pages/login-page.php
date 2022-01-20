
  <!-- /.login-logo -->
  <div class="login-page"> 
  <div class="login-box">
  <div class="login-logo">
    <a href="https://www.palladium.com.mx/" target="_blank"><b>Palladium</b>Compras</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia tu sesión</p>

      <form method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email-user" placeholder="Email" required>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="pass-user" placeholder="Contraseña" required>
        </div>
        <div class="row">
           <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
        <?php
        $login = new staffController();
        $login -> ctrLoginStaff();
        ?>      
        </form>
     
    </div>
    <!-- /.login-card-body -->  
  </div>
</div>
</div>
  