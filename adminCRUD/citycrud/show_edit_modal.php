<!-- Edit Model -->

<div class="modal fade" id="edit<?php echo $row['city_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit</h4></center>
            </div>
            <div class="modal-body">
            <?php
                $edit=$dbc->query("select * from city where city_id=" . $row['city_id']);
                $erow=$edit->fetch_assoc();
            ?>
            <div class="container-fluid">
                <form method="POST" action="update.php?id=<?php echo $erow['city_id']; ?>" enctype="multipart/form-data">
                <div class="row">
                <div class="col-lg-4" align="left">
                    <label style="position:relative; top:7px;">City Name:</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" name="name" class="form-control" value="<?php echo $erow['city_name']; ?>">
                </div>
            </div>
            <div style="height:10px;"></div>
                <div class="row">
                    <div class="col-lg-4" align="left">
                        <label style="position:relative; top:7px;">Address:</label>
                    </div>
                    <div class="col-lg-8">
                    <textarea class="form-control" name="description" rows="10"><?php echo $erow['description']; ?></textarea>
                </div>
            </div>
                <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-4" align="left">
                            <label class="control-label" style="position:relative; top:7px;">Profile Image:
                            </label>
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