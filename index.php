<?php
    if(isset($_POST['btn_submit']))
    {
        if (isset($_POST['text_track']))
        {
            if (empty($_POST['text_track'])) 
            {
                $ref_track ="No Result";
            }
            else
            {
                $ref_track =  htmlspecialchars($_POST['text_track'],ENT_QUOTES,'UTF-8');
                $ref_track_like = "%$ref_track%";
                include 'db.php';
                $stmt = $db->prepare("SELECT * FROM parcel_list WHERE sl_no LIKE :sl_no");
                $stmt->bindParam(':sl_no',$ref_track_like);
                $stmt->execute();
            }
        }
    }
?>

<!doctype html>
<html lang="en"> 
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        
        <title>PARCEL TRACK || SHIBLU_VAI</title>
        
    </head>

    <body>
        <div class="container mt-5">
            <!--<div class="mx-auto" style="width: 80%;">-->
            <!--<h2 class="mb-5 text-center">PARCEL TRACK || 7 STAR AIR CARGO</h2>-->
            <!--</div>-->
            <form action="index.php" method="POST">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Track by Ref" name="text_track"/>
                    <input type="submit" class="btn btn-outline-primary" name="btn_submit" value="Track"/>
                </div>
            </form>
        </div>
        <div class="container mt-3">
            <div class="card">
                <div class="card-body table-responsive">
                    <?php  
                        if (isset($ref_track)) 
                        {
                            echo '<h5>Search Result of : <i>'.$ref_track.'</i></h5>';
                        }
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Shipment</th>
                                <th scope="col">AWB</th>
                                <th scope="col">Lot</th>
                                <th scope="col">Booking</th>
                                <th scope="col">Dalivery</th>
                                <th scope="col">Ref</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Number</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Note</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                if(isset($stmt))
                                {
                                    while ($row = $stmt->fetch()) 
                                    {
                                        $id = $row['id'];
                                        $shipment = $row['shipment'];
                                        $air_bl_no = $row['air_bl_no'];
                                        $lot_no = $row['lot_no'];
                                        $b_status = $row['b_status'];
                                        $d_status = $row['d_status'];
                                        $sl_no = $row['sl_no'];
                                        $pis = $row['pis'];
                                        $name = $row['name'];
                                        $address = $row['address'];
                                        $number = $row['number'];
                                        $kg = $row['kg'];
                                        $remark = $row['remark'];

                                    echo '<tr>';
                                        echo '<td>'.$id.'</td>';
                                        echo '<td>'.$shipment.'</td>';
                                        echo '<td>'.$air_bl_no.'</td>';
                                        echo '<td>'.$lot_no.'</td>';
                                        echo '<td>'.$b_status.'</td>';
                                        echo '<td>'.$d_status.'</td>';
                                        echo '<td>'.$sl_no.'</td>';
                                        echo '<td>'.$pis.'</td>';
                                        echo '<td>'.$name.'</td>';
                                        echo '<td>'.$address.'</td>';
                                        echo '<td>'.$number.'</td>';
                                        echo '<td>'.$kg.'</td>';
                                        echo '<td>'.$remark.'</td>';
                                    echo '</tr>';
                                    }
                                }
                                else
                                {
                                    echo "<tr><td colspan='12' class='text-center'><b>Search Something....</b><td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        
    </body>
</html>
