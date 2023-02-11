<?php
include('../database.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Choices CRUD</title>
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
                        <th><center>First Name</center></th>
                        <th><center>Last Name</center></th>
                        <th><center>Username</center></th>
                        <th><center>e-mail</center></th>
                        <th><center>Acction</center></th>
                    </thead>
                    <tbody>
                            <?php
                                $user= "select * from user ";
                                $user_result = mysqli_query($dbc, $user);
                                while($row=$user_result->fetch_assoc()){
                            ?>
                        <tr>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <a href="#detail<?php echo $row['user_id']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open"></span>Detail</a><br><br>
                                <a href="#edit<?php echo $row['user_id']; ?>" data-toggle="modal" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a><br><br>
                                <a href="#del<?php echo $row['user_id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a><br>
                                            <!-- Detail Model -->
                                <div class="modal fade" id="detail<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3> Users </h3>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                    $user_edit=$dbc->query("select * from user where user_id=".$row['user_id']);
                                                    $erow=$user_edit->fetch_assoc();
                                                ?>
                                                <div class="container-fluid">
                                                    <form method="POST" action="update.php?id=<?php echo $erow['user_id']; ?>" enctype="multipart/form-data"> 
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">First Name:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['first_name']; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Last_name:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['last_name']; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Username:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['username']; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">E-mail:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['email']; ?>
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
                                <div class="modal fade" id="edit<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><h4 class="modal-title" id="myModalLabel">Edit</h4></center>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                    $user_detail=$dbc->query("select * from user where user_id=" . $row['user_id']);
                                                    $erow=$user_detail->fetch_assoc();
                                                ?>
                                                <div class="container-fluid">
                                                    <form method="POST" action="update.php?id=<?php echo $row['user_id']; ?>" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">First Name:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="first_name" class="form-control" value="<?php echo $erow['first_name']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label style="position:relative; top:7px;">Last Name:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="last_name" class="form-control" value="<?php echo $erow['last_name']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">User Name:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="user_name" value="<?php echo $erow['user_name']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">E-mail:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="email" value="<?php echo $erow['email']; ?>">
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
                                        <div class="modal fade" id="del<?php echo $row['user_id']; ?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <center><h4 class="modal-title" id="myModalLabel">Delete</h4></center>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <h5><center>Do you want to delete <strong><?php echo $row['username']; ?>?</strong></center></h5>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                                        <a href="delete.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger">
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
                                                            <!-- Add New employee-->
                    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <center><h4 class="modal-title" id="myModalLabel">Add New</h4></center>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <form method="POST" action="insert.php" class="form-horizontal" enctype="multipart/form-data" >
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">First Name:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="first_name">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Last name:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="last_name">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">username:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="user_name">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">email:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="email">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label class="control-label" style="position:relative; top:7px;">Password:</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="password" class="form-control" name="password" />
                                                    </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Confirm Password:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="password" class="form-control" name="confirm" />
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