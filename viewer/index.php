<?php
require "../inc/database.php";
$mysql_table = 'triton_translations';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>data-viewer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-1.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search.css">
</head>

<body>
    <!-- Start: Table With Search -->
    <div class="col-md-12 search-table-col">
        <div class="form-group pull-right col-lg-4"><input type="text" placeholder="Search by typing here.." class="search form-control"></div><span class="counter pull-right"></span>
        <div class="table-responsive table-bordered table table-hover table-bordered results">
            <table class="table table-bordered table-hover">
                <thead class="bill-header cs">
                    <tr>
                        <th id="trs-hd" class="col-lg-1" style="width: 5%;">Code</th>
                        <th id="trs-hd" class="col-lg-2" style="width: 5%;">Type</th>
                        <th id="trs-hd" class="col-lg-3" style="width: 5%;">Prefix</th>
                        <th id="trs-hd" class="col-lg-2" style="width: 40%;">English</th>
                        <th id="trs-hd" class="col-lg-2" style="width: 40%;">Spanish</th>
                        <th id="trs-hd" class="col-lg-2" style="width: 25%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="warning no-result">
                        <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No result</td>
                    </tr>
                    <tr>
                      <?php
                      $sql = "SELECT * FROM $mysql_table ORDER BY id";
                      $result = mysqli_query($db, $sql);

                      while ($data = mysqli_fetch_assoc($result)) {
                        $id = $data['id'];
                        $type = $data['type'];
                        $prefix = $data['has_prefix'];
                        $english = $data['english'];
                        $spanish = $data['spanish'];

                      switch ($prefix) {
                        case '1':
                          $prefix = 'Yes';
                          break;
                        case '0':
                          $prefix = 'No';
                          break;
                      }

                      switch ($type) {
                        case 'text':
                          $type = 'Text';
                          break;
                        case 'sign':
                          $type = 'Sign';
                          break;
                      }
                      ?>
                        <td><?php echo $id ?></td>
                        <td><?php echo $type ?></td>
                        <td><?php echo $prefix ?></td>
                        <td><?php echo $english ?></td>
                        <td><?php echo $spanish ?></td>
                        <td class="d-xl-flex justify-content-xl-center">
                        <form action="delete.php" method="post">
                          <button name="delete" value="<?php echo $id ?>" class="btn btn-danger" type="submit" style="margin-left: 5px;"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
                        </form>
                        </td>
                    </tr>
                    <?
                  }
                    ?>
                </tbody>
            </table>

            <form action="write.php" method="post">
              <button name="write" value="1" type="submit">Write data</button>
            </form>
        </div>
    </div>
    <!-- End: Table With Search -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Table-With-Search.js"></script>
</body>

</html>
