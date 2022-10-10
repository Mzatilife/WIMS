<!--pop up for customer login-------------------------------------------------------------->
<div id="popup2" class="overlay">
  <div class="popup">
    <a class="close" href="#">&times;</a>
    <div class="content">
      <div class="upform">
        <h1 style="margin-bottom: 40px;"><span class="fa"> Login</span></h1>
        <hr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
          <div class="inputBox2">
            <span class="fas fa-user"></span>
            <input type="email" name="email" placeholder="example@company.com" required="required">
          </div>
          <div class="inputBox2">
            <span class="fas fa-key"></span>
            <input type="password" name="password" placeholder="password" required="required">
          </div>
          <button name="login" class="btn-stall" style="margin-top: 20px;"><span class="fa fa-paper-plane"> Login</span></button>
        </form>
      </div>
    </div>
  </div>
</div>

