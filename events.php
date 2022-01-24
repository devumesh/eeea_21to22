<?php
        $year = $_GET['year'];
        $con = mysqli_connect("localhost", "root", "", "eeea") or die("Could not connect to the server");
        $selected_data = mysqli_query($con, "select * from events where academic_year='$year'");
        $rem_year = mysqli_query($con, "select distinct academic_year from events where academic_year <> '$year' order by academic_year desc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="events.css" rel="stylesheet" type="text/css" />
    <link href="timeline.css" rel="stylesheet" type="text/css" />

    <!-- Google Fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Events - EEEA</title>
</head>
<body>
    <div class="header">
       <img src="./images/PSG_Logo.png"/>
       <div class="brand_div">
           <h2 class="brand_clge">PSG College of Technology</h2>
           <h2 class="brand_eeea">EEEA - <?php echo("(".$year."-".($year+1).")") ?></h2>
       </div>
    </div>
    
    <div class="__containter">
        <?php
            $card_position_left = true;
            while ($row = mysqli_fetch_array($selected_data)) {
        ?>
        
        <div class="timeline">
            <?php if ($card_position_left) {
                echo('<div class="container left">');
                $card_position_left = !$card_position_left;
            }
            else {
                echo('<div class="container right">');
                $card_position_left = !$card_position_left;
            }
            ?>
                <div class="content" type="button" data-bs-toggle="modal" <?php echo('data-bs-target="#events_modal_'.$row['id'].'"'); ?> >
                <h2 class=""><?php  echo($row['event_name']) ?></h2>
                <div class="__card-prev-img">
                    <?php echo '<img src="data:image/png;base64,'.base64_encode($row['image']).'" />'; ?>
                </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" <?php echo('id="events_modal_'.$row['id'].'"'); ?> tabindex="-1" aria-labelledby="events_modal_lable_1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="events_modal_lable_1"><?php  echo($row['event_name']) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo($row['description']) ?>
                    </div>
                    <?php 
                        if($row['link']) echo('<div class="modal-footer"><a href="'.$row['link'].'" class="text-decoration-none text-white" target="blank"><button type="button" class="btn btn-danger">Youtube</button></a></div>');
                    ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <?php 
            }
        ?>
    </div>

    <div class="other-events">
        <h3 class="">Events</h3> 
        <ul class="">
            <?php
                while ($row = mysqli_fetch_array($rem_year)) {
            ?>
            <li class="events-list" ><a href=<?php echo ("./events.php?year=".$row['academic_year'].'>'.$row['academic_year']."-".($row['academic_year']+1)) ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <footer class="copyrights">
        <h4>&copy Copyrights <br/>Web Designing Team EEEA, PSG TECH</h4>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>