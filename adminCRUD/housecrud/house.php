<?php
include('../database.php');
session_start();
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: ../../login.php");
}
$_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Houses CRUD</title>
        <script src="../citycrud/js/jquery.min.js"></script>
        <link rel="stylesheet" href="../citycrud/css/bootstrap.min.css" />
        <script src="../citycrud/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../citycrud/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="../citycrud/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../citycrud/js/bootstrap-filestyle.min.js"> </script>
        <link href="../citycrud/css/fonts.css" rel="stylesheet">
        <script type="text/javascript" src="../citycrud/js/js.js"></script>
        <script>
            $(document).ready(function(){
            $('#empTable').dataTable();
            $('.file-upload').file_upload();
            });
        </script>
    </head>
    <?php include('header.php');?>
    <body style="margin:20px auto">
        <center><h2><span style="font-size:25px; color:blue">Admin DashBoard</span></h2></center>
        <div class="container"><br/><br/>
            <div class="row header col-sm-12" style="text-align:center;color:green">
                <span class="pull-left"><a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>
                <div style="height:50px;"></div>
                <table class="table table-striped table-bordered table-responsive table-hover" id="empTable" >
                    <thead>
                        <th><center>Picture</center></th>
                        <th><center>Owner</center></th>
                        <th><center>City</center></th>
                        <th><center>Address</center></th>
                        <th><center>Activation</center></th>
                        <th><center>action</center></th>
                    </thead>
                    <tbody>
                            <?php
                                $choice= "SELECT distinct * from choice ch inner join  house h on h.choice_id = ch.choice_id inner join pic on id = ch.choice_id where type_id='choice' group by id";
                                $ch_result = mysqli_query($dbc, $choice);
                                while($row=$ch_result->fetch_assoc()){
                                $city=$dbc->query("select city_name from city where city_id = {$row['city_id']}");
                                $c_result = $city->fetch_assoc();
                                $city_name = $c_result['city_name'];
                            ?>
                        <tr>
                            <td><?php echo '<img src="../../pic/' . $row['path'] . '.jpg" height="50px" width="70px"/>'; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $city_name; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php if ($row['activation'] == 'active') {
                                        echo '<span style="color: green; font-weight: bold;">' . $row['activation'] . '</span>';
                            }else{
                                echo '<span style="color: red; font-weight: bold;">' . $row['activation'] . '</span>';
                            }?>
                            <td>
                                <a href="#detail<?php echo $row['choice_id']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open"></span>Detail</a><br><br>
                                <a href="#edit<?php echo $row['choice_id']; ?>" data-toggle="modal" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a><br><br>
                                <a href="#del<?php echo $row['choice_id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a><br>
                                            <!-- Detail Model -->
                                <div class="modal fade" id="detail<?php echo $row['choice_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3> Choice Details </h3>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                    $edit=$dbc->query("select * from choice where choice_id=".$row['choice_id']);
                                                    $erow=$edit->fetch_assoc();
                                                ?>
                                                <div class="container-fluid">
                                                    <form method="POST" action="houseupdate.php?id=<?php echo $erow['choice_id']; ?>" enctype="multipart/form-data"> 
                                                        <div class="row">
                                                            <div class="col-lg-12" align="center">
                                                                <?php echo '<img src="../../pic/' . $row['path'] . '.jpg" height="230px" width="230px"/>'; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Name:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['name']; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Address:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['address']; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Phone_number:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['phone_number']; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">Description:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['description']; ?>
                                                            </div>
                                                        </div> 
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">Status:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php  if ($row['activation'] == 'active') {
                                                                            echo '<span style="color: green; font-weight: bold;">' . $row['activation'] . '</span>';
                                                                        }else{
                                                                            echo '<span style="color: red; font-weight: bold;">' . $row['activation'] . '</span>'; 
                                                                        }?>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                                            <!-- /.modal -->
                                                            <!-- Edit Model -->
                                <div class="modal fade" id="edit<?php echo $row['choice_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><h4 class="modal-title" id="myModalLabel">Edit</h4></center>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                    $edit=$dbc->query("select * from choice where choice_id=" . $row['choice_id']);
                                                    $erow=$edit->fetch_assoc();
                                                ?>
                                                <div class="container-fluid">
                                                    <form method="POST" action="houseupdate.php?id=<?php echo $row['choice_id']; ?>" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Name:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="name" class="form-control" value="<?php echo $erow['name']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">City: </label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php
                                                                //Σε ποια πόλη Ανήκει η επιλογή που επέλεξε ο admin
                                                                    $city_query = "SELECT * FROM choice ch inner JOIN city c ON ch.city_id = c.city_id WHERE ch.choice_id = " .$erow['choice_id'];
                                                                    $city_result = mysqli_query($dbc, $city_query);
                                                                    $city_row = mysqli_fetch_assoc($city_result);
                                                                    $city_from_database = $city_row['city_id'];
                                                                ?>
                                                                <select name="city">
                                                                    <?php   
                                                                        $sql= "select * from city group by city_id ";
                                                                        $city_res = mysqli_query($dbc, $sql);
                                                                        while($crow=$city_res->fetch_assoc()){
                                                                            $selected = '';
                                                                            if ($crow['city_id'] == $city_from_database) {
                                                                                $selected = 'selected';
                                                                            }
                                                                            echo" <option name='city' value='".$crow['city_id']."' ".$selected.">" . $crow['city_name'] ." </option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Category: </label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php
                                                                    $category_query = "SELECT * FROM choice ch inner JOIN category c ON ch.category_id = c.category_id WHERE ch.choice_id = " .$erow['choice_id'];
                                                                    $category_result = mysqli_query($dbc, $category_query);
                                                                    $category_row = mysqli_fetch_assoc($category_result);
                                                                    $category_from_database = $category_row['category_id'];
                                                                ?>
                                                                <select name="category">
                                                                    <?php   
                                                                        $sql= "select * from category group by category_id ";
                                                                        $category_res = mysqli_query($dbc, $sql);
                                                                        while($crow=$category_res->fetch_assoc()){
                                                                            $selected = '';
                                                                            if ($crow['category_id'] == $category_from_database) {
                                                                                $selected = 'selected';
                                                                            }
                                                                        
                                                                            echo" <option name='category' value='".$crow['category_id']."' ".$selected.">" . $crow['category_name'] ." </option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Address:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="address" class="form-control" value="<?php echo $erow['address']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">Phone:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="phone" value="<?php echo $erow['phone_number']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label class="control-label" style="position:relative; top:7px;">Avalaible From:</label>
                                                                </div>
                                                            <div class="col-lg-8">
                                                                <input type="date" class="form-control" name="availability" value="<?php echo $row['ch_date']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Description:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <textarea class="form-control" name="description" rows="10"><?php echo $erow['description']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">Profile Image:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="file" name="fileToUpload" id="fileToUpload" >
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Status: </label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php
                                                                    $status_query = "SELECT * FROM house h  WHERE h.choice_id = " .$erow['choice_id'];
                                                                    $status_result = mysqli_query($dbc, $status_query);
                                                                    $status_row = mysqli_fetch_assoc($status_result);
                                                                    $status_from_database = $status_row['activation'];
                                                                ?>
                                                                <select name="activation">
                                                                    <option name='activation' value= "active">Active</option>
                                                                    <option name='activation' value= "not active">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                            <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                                            <button type="submit" class="btn btn-warning">
                                                            <span class="glyphicon glyphicon-check"></span> Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                                            <!-- /.modal -->
                                                            <!-- Delete -->
                                        <div class="modal fade" id="del<?php echo $row['choice_id']; ?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <center><h4 class="modal-title" id="myModalLabel">Delete</h4></center>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <h5><center>Do you want to delete <strong><?php echo $row['name']; ?>?</strong></center></h5>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                                        <a href="housedelete.php?id=<?php echo $row['choice_id']; ?>" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-trash"></span> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                                    <!-- /.modal -->
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                                                            <!-- Add New House-->
                    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <center><h4 class="modal-title" id="myModalLabel">Add New</h4></center>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <form method="POST" action="houseinsert.php" class="form-horizontal" enctype="multipart/form-data" >
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Owner:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="name">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">City:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="city_id">
                                                        <?php   $cities= "select * from city group by city_id ";
                                                                $result = mysqli_query($dbc, $cities);
                                                                while($crow=$result->fetch_assoc()){
                                                                    echo" <option value='".$crow['city_id']."'>" . $crow['city_name'] ." </option>";
                                                                }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">City:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="category_id">
                                                        <?php   $categories= "select * from category group by category_id ";
                                                                $result = mysqli_query($dbc, $categories);
                                                                while($catrow=$result->fetch_assoc()){
                                                                    echo" <option value='".$catrow['category_id']."'>" . $catrow['category_name'] ." </option>";
                                                                }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Address:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="address">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Phone_number:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="phone">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Avalaible From:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="date" class="form-control" name="availability">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Description:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <textarea class="form-control" name="description" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-lg-4" align="left">
                                                    <label style="position:relative; top:7px;">Status: </label>
                                                </div>
                                                <div class="col-lg-8" align="left">
                                                    <?php
                                                        $status_query = "SELECT * FROM house h  WHERE h.choice_id = " .$erow['choice_id'];
                                                        $status_result = mysqli_query($dbc, $status_query);
                                                        $status_row = mysqli_fetch_assoc($status_result);
                                                        $status_from_database = $status_row['activation'];
                                                    ?>
                                                    <select name="activation">
                                                        <?php   
                                                            $sql= "select activation from house ";
                                                            $status_res = mysqli_query($dbc, $sql);
                                                            while($crow=$status_res->fetch_assoc()){
                                                                $selected = '';
                                                                if ($crow['activation'] == $category_from_database) {
                                                                    $selected = 'selected';
                                                                }
                                                                echo "<option name='category' value='active' " . ($crow['activation'] == 'active' ? 'selected' : '') . ">Active</option>";
                                                                echo "<option name='category' value='not_active' " . ($crow['activation'] == 'not_active' ? 'selected' : '') . ">Inactive</option>";                                                                        
                                                            }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Image:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                        <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
                                        </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </body>
        </html>