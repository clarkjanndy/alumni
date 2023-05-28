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
              foreach(mysqli_query($conn,"SELECT * FROM officers ORDER BY counter ASC") as $list_of_officers){ ?>
                 <div class="col-sm-4">
                  <img src="./admin/officer_uploads/<?php echo $list_of_officers['id']; ?>.png" onerror="this.src='./admin/officer_uploads/bcc_logo.jpg'">
                  <p class="name"> <?php echo $list_of_officers['name']; ?></p>
                  <p class="position"> <?php echo $list_of_officers['position']; ?></p>
                </div> 

             <?php }

            ?>
          </div>
        </div>


<!--
<div class="Officerinfo container text-center">
  <div class="row">
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> JOE FAITH DEGAMO</p>
      <p class="position"> ALUMNI PRESIDENT</p>
    </div>
    <div class="col-sm-4 ">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> MA.MAY N. CUPTA</p>
      <p class="position"> Alumni Vice President</p>
    </div>
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> TESSIE VIODOR</p>
      <p class="position"> Alumni Secretary</p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name">LOVELLA ANORA</p>
      <p class="position"> Alumni Assistant Secretary</p>
    </div>
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> AZENITH INOJOKS</p>
      <p class="position"> Alumni Treasurer</p>
    </div>
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> ANA  MAY CENABRE</p>
      <p class="position"> Alumni assistant treasurer</p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> JEWARD TORREGOSA</p>
      <p class="position"> Alumni Auditor</p>
    </div>
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> ELIZABETH TORREGOSA</p>
      <p class="position"> Alumni Assistant Auditor</p>
    </div>
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> JAQUILOU DELA CRUS</p>
      <p class="position"> Alumni PIO</p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      <img src="./officers/img/bcc.jpg">
      <p class="name"> GLENTON DUMAYAU</p>
      <p class="position"> Alumni PIO</p>
    </div>
    <div class="col-sm-4">
    <img src="./officers/img/bcc.jpg">
      <p class="name"> GENESA CERIO</p>
      <p class="position"> Alumni PIO</p>
    </div>
    <div class="col-sm-4">
    <img src="./officers/img/bcc.jpg">
      <p class="name"> NOEMI LOFRANCO</p>
      <p class="position"> Alumni Muse</p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
    <img src="./officers/img/bcc.jpg">
      <p class="name"> ELEUTERIO MELENCION JR.</p>
      <p class="position"> Alumni Prince Charming</p>
    </div>
  </div>

</div>

<h3 class="officerheader text-center my-5"><br>Alumni Batch Officers </h3>

<!--<div class="Officerinfo container text-center">
  <div class="row">
    <div class="col-sm-4">
      <img src="('images/Officer/g.jpeg')">
      <p class="name"> TRUSTEE ATTY. DAVE D. DUALLO</p>
      <p class="position"> Municipal Mayor / Chairman, BCC BOT</p>
    </div>
    <div class="col-sm-4 ">
      <img src="{% static 'img/Officer/Dr. Analiza Chua.jpg' %}">
      <p class="name"> TRUSTEE ANALIZA L. CHUA, Ph.D.,E.M.</p>
      <p class="position"> College President / Vice Chairman</p>
    </div>
    <div class="col-sm-4">
      <img src="{% static 'img/Officer/Eduardo Ompad.JPG' %}">
      <p class="name"> TRUSTEE EDUARDO OMPAD</p>
      <p class="position"> ALCU Representative / Member</p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      <img src="{% static 'img/Officer/Rena Erojo.jpg' %}">
      <p class="name">TRUSTEE RENA S. EROJO</p>
      <p class="position"> SB Member / Chair, Education Committee</p>
    </div>
    <div class="col-sm-4">
      <img src="{% static 'img/Officer/Elsa Tirol.jpg' %}">
      <p class="name"> TRUSTEE ELSA G. TIROL</p>
      <p class="position"> SB Member, Chair, Appropriations Committee</p>
    </div>
    <div class="col-sm-4">
      <img src="{% static 'img/Officer/Artemio Membreve.jpg' %}">
      <p class="name"> TRUSTEE ARTEMIO MEMBREVE</p>
      <p class="position"> SB Member, ABC President / Member</p>
    </div>
  </div>
</div>
<hr> -->


            
        </div>
        </section>