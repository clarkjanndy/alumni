<?php include 'db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
}
.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 60vh !important;background: black;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
	}
	#imagesCarousel img{
		width: auto!important;
		height: auto!important;
		max-height: calc(100%)!important;
		max-width: calc(100%)!important;
	}
</style>
<div class="container-fluid small">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back ". $_SESSION['login_name']."!"  ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM alumnus_bio where status = 1")->num_rows; ?>
                                        </b></h4>
                                        <p><b>Alumni</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-comments"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM forum_topics")->num_rows; ?>
                                        </b></h4>
                                        <p><b>Forum Topics</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-warning">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-briefcase"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM careers")->num_rows; ?>
                                        </b></h4>
                                        <p><b>Posted jobs</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-calendar-day"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '".date('Y-m-d')."' ")->num_rows; ?>
                                        </b></h4>
                                        <p class="smaller"><b>Upcoming Events</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	

                    
                </div>
            </div>  
            <br>
<?php 
    $employed = 0;
    $jobless = 0;
    $get_all_users = mysqli_query($conn,"SELECT * FROM users");
    foreach($get_all_users as $get_all_users){
        $alumni_id = $get_all_users['alumnus_id'];
        $check_for_job = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM employment_status WHERE id='".$alumni_id."'"));
        if($check_for_job>0){
            $employed = $employed+1;
        }else{
            $jobless = $jobless+1;
        }
    }
    
?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><br><br><br>
                            <canvas id="mychart" width="30px" height="30px;"></canvas>
                        </div>
                        <div class="col-md-9">
                            <canvas id="mychart2"></canvas>
                       </div>
                    <table  class="table table-sm table-bordered">
                        <thead class="text-center">
                                <th>Course</th>
                                <th>Total</th>
                                <th>Unemployed</th>
                                <th>Employed</th>
                                <th>Self-Employed</th>
                        </thead>
                        <tbody class="text-center">
                                <?php
                                    $employment_counter=0;
                                    $unemployment_counter = 0; 
                                    $self_employed = 0;
                                    $total_self_employed = 0;
                                    $total_alumnus =  0;
                                    $total_employed = 0;
                                    $total_unemployed = 0;
                                    $get_all_encoded_courses = [];
                                    $get_self_employed = [];
                                    $get_jobs = [];
                                    $get_jobless = [];
                                    $get_all_courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY id ASC");
                                    foreach($get_all_courses as $get_all_courses){
                                        $get_alumni_count = mysqli_query($conn, "SELECT * FROM alumnus_bio WHERE course_id='".$get_all_courses['id']."'");
                                        $get_total_alumni = mysqli_num_rows($get_alumni_count);
                                        foreach($get_alumni_count as $get_alumni_count){
                                            $get_alumni_info = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM employment_status WHERE id='".$get_alumni_count['id']."'"));
                                            if($get_alumni_info > 0){
                                                $get_alumni_info_employed = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM employment_status WHERE id='".$get_alumni_count['id']."' AND status = 'Self-Employed'"));
                                            
                                                if($get_alumni_info_employed > 0){
                                                    $self_employed++;
                                                }else{
                                                    $employment_counter++;
                                                }
                                            }
                                            else{
                                                $unemployment_counter++;
                                            }
                                        }
                                        echo "<tr><td class='text-left'>".$get_all_courses['course']."</td><td>".$get_total_alumni."</td><td>".$employment_counter."</td><td>".$unemployment_counter."</td><td>".$self_employed."</td></tr>";
                                       $total_alumnus = $total_alumnus+$get_total_alumni;
                                       $total_self_employed = $total_self_employed + $self_employed;
                                       $total_employed = $total_employed+$employment_counter;
                                       $total_unemployed = $total_unemployed+$unemployment_counter;
                                        array_push($get_all_encoded_courses,$get_all_courses['course']);
                                        array_push($get_jobs,$employment_counter);
                                        array_push($get_self_employed,$self_employed);
                                        array_push($get_jobless,$unemployment_counter);
                                        $employment_counter=0;
                                        $unemployment_counter = 0;
                                        $self_employed = 0;
                                    }
                                    echo "<tr><td class='text-left'>Total</td><td>".$total_alumnus."</td><td>".$total_employed."</td><td>".$total_unemployed."</td><td>".$total_self_employed."</td></tr>";
                                ?>

                        </tbody>
                    </table>
                    
                    </div>
                </div>
            </div><br>
            <div class="card">
                <div class="card-body">
                <!--<canvas id="jobs_per_course"></canvas>-->
                <?php $list_courses = [];
                    $list_jobs_on_course=[];
                    $list_all_courses=[];
                ?><div class="row">
                <?php foreach(mysqli_query($conn, "SELECT * FROM courses ORDER BY id ASC") as $courses){ ?>
                    <div class="col-md-4">
                    <div class="card m-1">
                        <div class="card-header bg-primary text-white">
                            <?php echo $courses['course']; ?>
                            <?php array_push($list_courses, $courses['course']); ?>
                        </div>
                        <div class="card-body">
                            <?php 
                                $count_job_per_course=0;
                                $list_all_jobs = [];
                                $list_all_employed = [];
                                $counter=0;
                                $jobs = [];
                                $list_jobs_with_count=[];
                                $student_per_course = mysqli_query($conn, "SELECT DISTINCT id FROM alumnus_bio WHERE course_id='".$courses['id']."'");
                                $check_all_jobs = mysqli_query($conn, "SELECT DISTINCT position FROM employment_status");
                                echo "<table class='table table-sm'>";
                                foreach($check_all_jobs as $check_all_jobs){
                                    array_push($jobs, $check_all_jobs['position']);
                                   $count_employed = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM employment_status as es INNER JOIN alumnus_bio as ab ON es.id = ab.id WHERE ab.course_id='".$courses['id']."' AND es.position = '".$check_all_jobs['position']."'"));
                                    if($count_employed > 0){
                                        echo"<tr>";
                                        echo "<td>".$check_all_jobs['position']. "</td><td  class='pull-right'>". $count_employed."</td>";
                                        echo "</tr>";
                                    }

                                }
                                echo "</table>";
                                
                        echo "</div>";                   
                               
                                foreach($student_per_course as $student_per_course){
                                    for($j=0;$j<count($jobs);$j++){
                                        $job_per_student = mysqli_query($conn, "SELECT * FROM employment_status WHERE id='".$student_per_course['id']."' AND position = '".$jobs[$j]."'"); 
                                        $count_jobs_per_student = mysqli_num_rows($job_per_student);
                                        if($counter==0){
                                            if($count_jobs_per_student > 0){
                                                //"<tr><td>".$jobs[$j]."</td>";
                                                array_push($list_all_jobs, $jobs[$j]); 
                                                $count_employed = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM employment_status as es INNER JOIN alumnus_bio as ab ON es.id = ab.id WHERE ab.course_id='".$courses['id']."' AND es.position = '".$jobs[$j]."'"));
                                                $count_job_per_course = $count_job_per_course + $count_jobs_per_student;
                                                $counter = 1;
                                                $list_jobs_with_count[$jobs[$j]] = $count_job_per_course; 
                                                //"<td>".$count_employed."</td>";
                                                break; 
                                            }

                                            
                                        }
                                        if($counter ==  1){
                                            $count_job_per_course = $count_job_per_course + $count_jobs_per_student;;
                                            $counter=0;
                                            $list_jobs_with_count[$jobs[$j]] = $count_job_per_course; 
                                        }
                                        
                                    }
                                 }
                                $counter=0; 
                                $lists = $courses['course'];
                                $list_all_courses[$lists]=$list_jobs_with_count;

                                
                            ?>
                            
                            </div>
                            </div>
                    <?php } ?>

                    <div class="col-md-4">
                        <div class="card m-1">
                            <div class="card-header bg-primary text-white">
                                Self Employed
                            </div>
                            <div class="card-body">
                                <?php
                                    $result = mysqli_query($conn, "SELECT position, COUNT(*) as count FROM employment_status WHERE status = 'Self-Employed' GROUP BY position"); 
                                   
                                ?>
                                <table class='table table-sm'>

                                <?php while ($row = $result->fetch_assoc()) {?>
                                    <tr>
                                        <td><?php echo $row["position"]?></td>
                                        <td><?php echo $row["count"]?></td>
                                    </tr>
                                <?php }?>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </>
        </div>
    </div>
</div>

<script>
        window.onload = function () {
        var ctx = document.getElementById('mychart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
            labels: ['Unemployed', 'Employed', 'Selfemployed'], 
            datasets: [{
                    label: '', fill: '#a6001a,#ffc107,#18d26e',backgroundColor:['#e06000','#ffc107','#18d26e'], data: [<?php echo $total_employed.", ".$total_unemployed.", ".$total_self_employed ; ?>] 
                }]
            },
            options: { 
                plugins:{
                    datalabels:{
                        
                        labels:{ render: 'label'},
                    }
                }
            }
        });
        var ctx = document.getElementById('mychart2').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['Unemployed', 'Employed', 'Self-Employed'], 
            datasets: [
                    <?php 
                    $colors = ['#e83e8c','#007bff','#212529','#28a745','#20ee5b','#e720ee','#eeb420','#20c9ee','#17a2b8'];
                    for($count_job=0;$count_job<count($get_all_encoded_courses);$count_job++){
                        echo "{label:'".$get_all_encoded_courses[$count_job]."',fill:'".$colors[$count_job]."',backgroundColor:'".$colors[$count_job]."',data:[".$get_jobs[$count_job].", ".$get_jobless[$count_job].",".$get_self_employed[$count_job]."]},"; 
                    } ?>
                   // label: 'Information  Technology', fill: '#e83e8c',backgroundColor:'#e83e8c', data: [<?php echo $employed.", ".$jobless; ?>]},{
                  //  label: 'Education', fill: '#007bff',backgroundColor:'#007bff', data: [<?php echo ($employed-1).", ".($jobless+3); ?>]},{ 
                  //  label: 'Criminology', fill: '#212529',backgroundColor:'#212529', data: [<?php echo $employed.", ".$jobless; ?>]},{
                  //  label: 'Hospitality Management', fill: '#28a745',backgroundColor:'#28a745', data: [<?php echo ($employed-1).", ".($jobless+3); ?>]
            ]
            },
            options: { 
                plugins:{
                    datalabels:{
                        
                        labels:{ render: 'percentage'},
                    }
                },
                    scales:{ 
                        yAxes:[{ticks: {suggestedMax:<?php echo ($employed+$jobless+5); ?>, suggestedMin:1 } }]
                }
                
            }
        });
        var ctx = document.getElementById('jobs_per_course').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php for($k=0;$k<count($list_courses);$k++){ echo "'".$imploded_key = implode(array_keys($list_all_courses[$list_courses[$k]]))."', "; } ?>], 
                datasets: [
                    <?php
                        for($k=0;$k<count($list_courses);$k++){
                            $imploded_key = implode(array_keys($list_all_courses[$list_courses[$k]])); 
                            if($imploded_key==""){
                                $imploded_key = "way data";
                            }
                            $imploded = implode($list_all_courses[$list_courses[$k]]);
                            if($imploded==""){
                                $imploded=0;
                            } ?>
                            {   
                                label:'<?php echo $imploded_key; ?>',
                                fill: '#e83e8c',backgroundColor:'#e83e8c', 
                                data: [<?php echo $imploded; ?>,0]
                            },
                    <?php } ?>
                ]},
            options: { 
                plugins:{
                    datalabels:{
                        
                        labels:{ render: 'value'},
                    }
                },
                    scales:{ 
                        yAxes:[{ticks: {suggestedMax:50, suggestedMin:1 } }]
                }
                
            }
        });


        };
        
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }

</script>