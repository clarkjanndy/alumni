<!-- Masthead-->
<link rel="stylesheet" href="./officers/css/bootstrap.min.css">
<style type="text/css">
  .officerheader {
    font-family: Century Gothic;
    font-weight: bold;
  }

  .officer h3 {
    font-family: Century Gothic;
    font-weight: bold;
    padding-left: 1cm;
  }

  .officer p {
    font-family: Century Gothic;
    text-align: justify;
    text-justify: inter-word;
    padding-left: 1cm;
    padding-right: 1cm;
  }

  .Officerinfo img {

    width: 200px;
    height: 220px;
    border-radius: 20%;
    padding-top: 3px;
  }

  .Officerinfo .name {
    font-weight: bold;
  }

  .Officerinfo .position {
    font-style: italic;
    margin-top: -20px;
  }
</style>
<header class="masthead" style="height:100vh;">
  <div class="container h-50">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end mb-4" style="background: transparent;">
        <h1 class="text-uppercase text-white font-weight-bold">LIST OF OFFICERS</h1>
      </div>

    </div>
  </div>
</header>

<section class="">
  <div class="container-fluid bg-theme">
    <h3 class="officerheader text-center p-5">Buenavista Community College<br><br>Alumni Officers</h3>

    <div class="Officerinfo container text-center">
      <div class="row">
        <?php
        foreach (mysqli_query($conn, "SELECT * FROM officers ORDER BY counter ASC") as $list_of_officers) { ?>
          <div class="col-sm-4">
            <img src="./admin/officer_uploads/<?php echo $list_of_officers['id']; ?>.png"
              onerror="this.src='./admin/officer_uploads/bcc_logo.jpg'">
            <p class="name">
              <?php echo $list_of_officers['name']; ?>
            </p>
            <p class="position">
              <?php echo $list_of_officers['position']; ?>
            </p>
          </div>

        <?php }

        ?>
      </div>
    </div>
    <h3 class="officerheader text-center p-5">Batch Officers</h3>

    <div class="Officerinfo container text-center">
      <?php
      $batch_query = mysqli_query($conn, "SELECT DISTINCT batch FROM batch_officers ORDER BY batch DESC;");
      if (mysqli_num_rows($batch_query) > 0) {
        while ($batch = mysqli_fetch_assoc($batch_query)) {
          ?>

          <div class="container">
          <h6><b>Batch of <?php echo $batch["batch"]?></b></h6>
            <div class="row">
              <?php
              foreach (mysqli_query($conn, "SELECT * FROM batch_officers WHERE batch = '".$batch["batch"]."'") as $officer) { 
                $user_query = mysqli_query($conn,  "SELECT * FROM alumnus_bio WHERE id = '".$officer["alumnus_id"]."' LIMIT 1");
                $alumnus = mysqli_fetch_assoc($user_query);
                if ($alumnus){
                ?>
                <div class="col-sm-4">
                  <img src="admin/assets/uploads/<?php echo $alumnus["avatar"] ?>"
                    onerror="this.src='./admin/officer_uploads/bcc_logo.jpg'">
                  <p class="name">
                    <?php echo $alumnus["firstname"]." ".$alumnus["middlename"]." ". $alumnus["lastname"]?>
                  </p>
                  <p class="position">
                    <?php echo $officer['position']; ?>
                  </p>
                </div>

              <?php }} ?>
            </div>

          <?php
        }
      }
      ?>

      </div>
    </div>




  </div>
</section>