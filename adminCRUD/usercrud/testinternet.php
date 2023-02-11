<!DOCTYPE html>

<html>
    <head>
        <title>PHP/MySQLi CRUD Operation using Bootstrap/Modal</title>
        <script src="jquery.min.js"></script>
        <link rel="stylesheet" href="bootstrap.min.css" />
        <script src="bootstrap.min.js"></script>
        <link rel="stylesheet" href="jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="bootstrap-filestyle.min.js"> </script>
        <link href="fonts.css" rel="stylesheet">
        <script>
            $(document).ready(function(){
            $('#empTable').dataTable();
            $('.file-upload').file_upload();
            });
        </script>
    </head>
    <body style="margin:20px auto">
        <center><h2><span style="font-size:25px; color:blue">Simple CRUD Operation using PHP, MySQL and Bootstrap</span></h2></center>
        <div class="container"><br/><br/>
            <div class="row header col-sm-12" style="text-align:center;color:green">
                <span class="pull-left"><a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>
                <div style="height:50px;"></div>
                <table class="table table-striped table-bordered table-responsive table-hover" id="empTable" >
                    <thead>
                        <th><center>Picture</center></th>
                        <th><center>Name</center></th>
                        <th><center>Address</center></th>
                        <th><center>Phone</center></th>
                        <th><center>Action</center></th>
                    </thead>
                    <tbody>
                            <?php
                                include('database.php');
                                $result=$mysqli->query("select * from employee_basics");
                                while($row=$result->fetch_assoc()){
                                $img = "http://localhost/php_crud/profile_images/".$row['id']. ".jpg";
                            ?>
                        <tr>
                            <td> <img src='<?php echo $img ?>' height="50px" width="70px" /></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>
                                <a href="#detail<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open"></span>Detail</a>&nbsp;
                                <a href="#edit<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>&nbsp;
                                <a href="#del<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                <!-- Detail Model -->
                                <div class="modal fade" id="detail<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3> Profile Details </h3>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                    $edit=$mysqli->query("select * from employee_basics where id=".$row['id']);
                                                    $erow=$edit->fetch_assoc();
                                                ?>
                                                <div class="container-fluid">
                                                    <form method="POST" action="update.php?id=<?php echo $erow['id']; ?>" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-12" align="center">
                                                                <?php $img = "http://localhost/php_crud/profile_images/".$row['id']. ".jpg";?><img src='<?php echo $img ?>' height="150px" width="170px" />
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
                                                                <label style="position:relative; top:7px;">Gender:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['gender']; ?>
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
                                                                <label class="control-label" style="position:relative; top:7px;">Phone:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['phone']; ?>
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">Post:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <?php echo $erow['post']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                                <!-- /.modal -->
                                                <!-- Edit Model -->
                                <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><h4 class="modal-title" id="myModalLabel">Edit</h4></center>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                    $edit=$mysqli->query("select * from employee_basics where id=".$row['id']);
                                                    $erow=$edit->fetch_assoc();
                                                ?>
                                                <div class="container-fluid">
                                                    <form method="POST" action="update.php?id=<?php echo $erow['id']; ?>" enctype="multipart/form-data">
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
                                                                <label style="position:relative; top:7px;">Gender:</label>
                                                            </div>
                                                            <div class="col-lg-8" align="left">
                                                                <select name="gender">
                                                                    <?php if ($erow['gender']=="Male") {?>
                                                                    <option selected>Male</option>
                                                                    <option>Female</option>
                                                                    <?php }else{ ?>
                                                                    <option>Male</option>
                                                                    <option selected>Female</option>
                                                                    <?php }?>
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
                                                                <input type="text" class="form-control" name="phone" value="<?php echo $erow['phone']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">Post:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" name="post" value="<?php echo $erow['post']; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="height:10px;"></div>
                                                        <div class="row">
                                                            <div class="col-lg-4" align="left">
                                                                <label class="control-label" style="position:relative; top:7px;">Profile Image:</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="file" class="filestyle" name="pimage" />
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
                                    <div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
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
                                                <label class="control-label" style="position:relative; top:7px;">Name:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div style="height:10px;"></div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="control-label" style="position:relative; top:7px;">Gender:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select name="gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
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
                                                    <label class="control-label" style="position:relative; top:7px;">Phone:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="phone">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Post:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="post">
                                                </div>
                                            </div>
                                            <div style="height:10px;"></div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="control-label" style="position:relative; top:7px;">Profile Image:</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input type="file" class="filestyle" name="pimage" />
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
                </body>
                </html>