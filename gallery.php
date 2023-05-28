<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.gallery-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}
.gallery-img,.gallery-list .card-body {
    width: calc(100%)
}
.gallery-img img{
    border-radius: 5px;
    min-height: 50vh;
    max-width: calc(100%);
}
span.hightlight{
    background: yellow;
}
.carousel,.carousel-inner,.carousel-item{
   min-height: calc(100%)
}
header.masthead,header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important
    }
.row-items{
    position: relative;
}
.card-left{
    left:0;
}
.card-right{
    right:0;
}
.rtl{
    direction: rtl ;
}
.gallery-text{
    justify-content: center;
    align-items: center ;
}
.masthead{
        min-height: 23vh !important;
        height: 23vh !important;
    }
     .masthead:before{
        min-height: 23vh !important;
        height: 23vh !important;
    }

</style>
        <header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                        <h3 class="text-white">Gallery</h3>
                        <hr class="divider my-4" />

                    <div class="col-md-12 mb-2 justify-content-center">
                    </div>                        
                    </div>
                    
                </div>
            </div>
        </header>
            <div class="container-fluid mt-3 pt-2">
               
                <div class="row-items">
                <div class="col-lg-12">
                    <div class="row">
                <?php
                $rtl ='rtl';
                $ci= 0;
                $img = array();
                $fpath = 'admin/assets/uploads/gallery';
                $files= is_dir($fpath) ? scandir($fpath) : array();
                foreach($files as $val){
                    if(!in_array($val, array('.','..'))){
                        $n = explode('_',$val);
                        $img[$n[0]] = $val;
                    }
                }
                $gallery = $conn->query("SELECT * from gallery order by id desc");
                while($row = $gallery->fetch_assoc()):
                   
                    $ci++;
                    if($ci < 3){
                        $rtl = '';
                    }else{
                        $rtl = 'rtl';
                    }
                    if($ci == 4){
                        $ci = 0;
                    }

                
                
                if(isset($_GET['pass'])){
                    $react_color = "btn-danger";
                    $check_for_react = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM reaction_counter WHERE data_id='".$_GET['action']."'"));
                        if($check_for_react>0){
                            foreach(mysqli_query($conn,"SELECT * FROM reaction_counter WHERE data_id='".$_GET['action']."'") as $counter2){
                               echo  $react_count2 = $counter2['count'];
                               break;
                            }
                            $react_count3  = $react_count2 + 1;
                            mysqli_query($conn,"UPDATE reaction_counter SET count='".$react_count3 ."' WHERE data_id = '".$_GET['action']."'");    
                            }else{
                            mysqli_query($conn, "INSERT INTO reaction_counter(data_id,count) VALUES('".$_GET['action']."','1')");
                        }
                        
                    }
                
                else{
                    $react_color = "btn-primary";
                }
                foreach(mysqli_query($conn,"SELECT * FROM reaction_counter WHERE data_id='".$row['id']."'") as $counter){
                    $react_count = $counter['count'];
                }
                
                ?>
              
               <div class="col-md-4">
                <div class="card gallery-list <?php echo $rtl ?>" data-id="<?php echo $row['id'] ?>">
                        <div class="text-center p-2 gallery-img" card-img-top>

                            <img src="<?php echo isset($img[$row['id']]) && is_file($fpath.'/'.$img[$row['id']]) ? $fpath.'/'.$img[$row['id']] :'' ?>" alt="">
                            <span class="truncate" style="font-size: inherit;"><small><?php echo ucwords($row['about']) ?></small></span>
                           <!-- <?php 
                               if(isset($_GET['action'])){ ?>
                                <div class=""><a class="btn <?php echo $react_color; ?>"><i class="fa fa-heart"></i></a></div>
                            <?php }else{ ?>
                                <div class=""><a href="./index.php?page=gallery&&pass=TRUE&&action=<?php echo $row['id'] ?>" class="btn <?php echo $react_color; ?>"><i class="fa fa-heart"></i></a></div> 
                            <?php } ?>
                            <br><p class="small"><?php echo $react_count; ?> alumni hearted this picture</p> -->
                        </div>        
                        </div>
                        
                <br>
                </div>
                <?php endwhile; ?>
                </div>
                </div>
                </div>
            </div>


<script>
    // $('.card.gallery-list').click(function(){
    //     location.href = "index.php?page=view_gallery&id="+$(this).attr('data-id')
    // })
    $('.book-gallery').click(function(){
        uni_modal("Submit Booking Request","booking.php?gallery_id="+$(this).attr('data-id'))
    })
    $('.gallery-img img').click(function(){
        viewer_modal($(this).attr('src'))
    })

</script>