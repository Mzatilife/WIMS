<!--popup to input reasons for declining a property-------------------------------------------------------------->
<div id="popup" class="overlay">
  <div class="popup">
    <a class="close" href="#">&times;</a>
    <div class="content">
        <div class="upform"> 
        <h4><span class="fa"> Why reject the warehouse</span></h4><hr>
        <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?rejid=<?php echo $_SESSION['ware_id']; ?>" enctype = "multipart/form-data">
          <textarea name="reasons" placeholder="type in here" cols="40" rows="15" required=""></textarea><br>
          <button name="reject" class="btn-stall"><span class="fa fa-paper-plane"> submit</span></button>
        </form>
        </div>                         
    </div>
  </div>
</div>