<?php
    $event_name = " ";
    $event_link = " ";

    if (isset($_POST["event_submit"])) {
        $con = mysqli_connect("localhost", "root", "", "eeea") or die("Could not connect to the server");

        $event_name = $_POST["event_name"];
        $academic_year = $_POST["academic_year"];
        $event_desc = $_POST["event_desc"];
        $event_link = $_POST["event_link"];
        $file = $_FILES["event_image"];
        $event_date = $_POST["event_date"];

        if ($file["size"] > 256000) {
            echo("<div class=\"alert alert-danger\" role=\"alert\">File size is more the 250kb</div>");
        }
        else if ($file["error"]) {
            echo("<div class=\"alert alert-danger\" role=\"alert\">Error in uploading an image</div>");
        }
        else {
            $image = addslashes(file_get_contents($file["tmp_name"]));

            $query = "";
            if ($event_link == "")  {
                $query = "insert into events (date,	event_name,	academic_year, description, image, event_date) values(NOW(), '$event_name', '$academic_year', '$event_desc', '$image', '$event_date')";
            }
            else {
                $query = "insert into events (date,	event_name,	academic_year, description, link, image, event_date) values(NOW(), '$event_name', '$academic_year', '$event_desc', '$event_link', '$image', '$event_date')";
            }

            $action = mysqli_query($con, $query);

            if (!$action) {
                die("<div class=\"alert alert-danger\" role=\"alert\">Error in uploading data</div>");
            }
            echo("<div class=\"alert alert-success\" role=\"alert\">Successfully updated</div>");
        }

        mysqli_close($con);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpzort" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Events form</title>
</head>
<body>
    <div class="">
        <form action="events_form.php" method="POST" enctype="multipart/form-data" class="m-2 m-md-5" >
            <div class="mb-3">
                <label for="event_name" class="form-label">Event name</label>
                <input type="text" name="event_name" class="form-control" id="event_name" aria-describedby="eventName" required>
            </div>
            <div class="mb-3">
                <label for="academic_year">Academic year: </label>
                <select name="academic_year" id="academic_year" class="form-select" required>
                    <option value="2021" selected>2021-2022</option>
                    <option value="2020">2020-2021</option>
                    <option value="2019">2019-2020</option>
                    <option value="2018">2018-2019</option>
                    <option value="2017">2017-2018</option>
                    <option value="2016">2016-2017</option>
                </select>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="event_desc" placeholder="Enter the event description" id="event_description" required ></textarea>
                <label for="event_description">Description</label>
            </div>
            <div class="">
                <label for="basic-url" class="form-label">Youtube Link</label>
                <div class="input-group mb-3">
                    <span class="input-group-text text-sm" id="basic-addon3">URL</span>
                    <input type="text" name="event_link" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="">
                <label for="event_date" class="form-label">Event Date</label>
                <div class="input-group mb-3">
                    <input type="date" name="event_date" id="event_date">
                </div>
            </div>
            <div class="mb-3">
                <label for="image_upload" class="form-label">Event image: </label>
                <input class="form-control" name="event_image" type="file" id="image_upload" required>
                <p class="fs-6">File size must be less than 250kb</p>
            </div>
            <div class="mb-3">
                <input type="submit" name="event_submit" value="Upload" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>