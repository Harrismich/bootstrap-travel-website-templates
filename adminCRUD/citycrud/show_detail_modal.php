<!-- Detail Model -->
<div class="modal fade" id="detail<?php echo $row['city_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3> City Details </h3>
            </div>
            <div class="modal-body">
                <?php 
                        $edit=$dbc->query("select * from city where city_id=" . $row['city_id']);
                        $erow=$edit->fetch_assoc();
                ?>
                <div class="container-fluid">
                    <form method="POST" action="update.php?id=<?php echo $erow['city_id']; ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12" align="center">
                                <?php  echo '<img src="../../images/' . $row['path'] . '.jpg" height="230px" width="230px"/>';?>
                            </div>
                        </div>
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-4" align="left">
                                <abel style="position:relative; top:7px;">City Name:</label>
                            </div>
                            <div class="col-lg-8" align="left">
                                <?php echo $erow['city_name']; ?>
                            </div>
                        </div>
                        <div style="height:10px;"></div>
                            <div class="row">
                                <div class="col-lg-4" align="left">
                                    <label style="position:relative; top:7px;">Description:</label>
                                </div>
                                <div class="col-lg-8" align="left"> 
                                    <?php echo $row['description']; ?>
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