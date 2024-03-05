<!-- view MORE SHOP INFO Modal -->
<div class="modal" id="viewMoreShopInfo">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">SHOP INFO</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div style="width: 90%; margin: 0 auto; overflow-x: auto;">
                    <table id="shopinfo-tables" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Owner Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Business Permit</th>
                                <th scope="col">Edit Info</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="cancelViewMoreShopInfo">Back</button>
            </div>
        </div>
    </div>
</div>


<!-- ADD MORE SHOP INFO Modal -->
<div class="modal" id="addShopInfo">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ADD SHOP INFO</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Owner Name</label>
                        <input type="text" class="form-control" id="O_name">
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="text" class="form-control" id="O_age">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="O_gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file">Upload Permit (PDF only)</label>
                        <input type="file" class="form-control-file" id="O_permit" name="file" accept="application/pdf">
                    </div>


                    <input type="hidden" id="shop_barangayNo">
                    <input type="hidden" id="shop_featureID">
                </form>
            </div>


            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="canceladdShopInfo">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveButton" onclick="saveShopInfotodb()">Save</button>
            </div>

        </div>
    </div>
</div>


<!-- Edit deleteOwner info -->
<div class="modal fade" id="deleteOwner" tabindex="-1" role="dialog" aria-labelledby="deleteOwnerLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
      </div>
      <div class="modal-body">
      <h5 class="modal-title" id="deleteOwnerLabel">Deleting Shop Owner are you sure?..</h5>
        <form id="deleteOwnerForm">
        <input type="hidden" id="deleteOwnerID" name="OwnerID">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel" onclick="closeModal()">Close</button>
        <button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="deleteOwner()">Delete Owner</button>
      </div>
    </div>
  </div>
</div>


<!-- Toast  -->
<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
   
    <div class="toast-body">

    </div>
  </div>
</div>