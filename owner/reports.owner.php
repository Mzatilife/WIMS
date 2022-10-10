<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
?>
<!Doctype HTML>
<html>

<head>
  <title>Warehouses</title>
  <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
  <!-- font awesome file link  -->
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
</head>


<body>
  <!-- header link file -->
  <?php include "header.owner.php" ?>
  <div class="clearfix"></div>
  </div>
  </br>
  <div class="col-div-12">
    <div class="box-8">
      <div class="content-box">
        <p>Reports</p>
        <br />
        <table>
          <tr>
            <th>Report Type</th>
            <th></th>
            <th style="width: 5%">Action</th>
          </tr>
          <tr>
            <td>Warehouse Report</td>
            <td>Report on warehouse information (uploads, full as well as empty)</td>
            <td><a href="warehouse_report.owner.php" style="text-decoration: none; font-weight:bold;"><span>Analyse</span></a></td>
          </tr>
          <tr>
            <td>Financial Report</td>
            <td>This contains analysis of payment and other financial transactions</td>
            <td><a href="financial_report.owner.php" style="text-decoration: none; font-weight:bold;"><span>Analyse</span></a></td>
          </tr>
          <tr>
        </table>
      </div>
    </div>
  </div>
  </br>

  <div class="clearfix"></div>
  <!-- footer link file -->
  <?php include "footer.owner.php" ?>
  </div>


</body>


</html>