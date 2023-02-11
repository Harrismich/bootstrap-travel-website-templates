<!-- Add New employee-->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" 
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" 
        aria-hidden="true">&times;</button>
        <center><h4 class="modal-title" id="myModalLabel">Add New City</h4></center>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <form method="POST" action="insert.php" class="form-horizontal" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-lg-4">
                <label class="control-label" style="position:relative; top:7px;">City:</label>
            </div>
            <div class="col-lg-8">
            <input type="text" class="form-control" name="city_name">
        </div>
    </div>
</div>
<div style="height:10px;"></div>
    <div class="row">
        <div class="col-lg-4">
            <label class="control-label" style="position:relative; top:7px;">Description:</label>
        </div>
        <div class="col-lg-8">
        <textarea class="form-control" name="description" rows="5"></textarea>
        </div>
    </div>
    <div style="height:10px;"></div>
        <div style="height:10px;"></div>
            <div class="row">
                <div class="col-lg-4">
                    <label class="control-label" style="position:relative; top:7px;">City Image:</label>
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
    </div>
</form>
</div>
</div>
</div>
</div>