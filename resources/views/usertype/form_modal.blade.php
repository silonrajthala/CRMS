<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $form_title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="dataForm" class="form" method="POST" action="{{ route('usertype.store') }}">
             @csrf
            <div class="modal-body m-3">
            <input type="hidden"  id="id" name="id"  />



               <div class="row">
                 <div class="form-group">
                    <label>Usertype Name <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="typename" name="typename" placeholder="Enter Usertype Name" />
                 </div>
               </div>
           

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-close"></i> Close</button>
                <button type="submit" id="btnSubmit" class="btn btn-success"><i class="fas fa-save"></i> Submit</button>
                @if($access['isupdate']=='Y')
                <button type="submit" id="btnUpdate" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                @endif
            </div>
            </form>
        </div>
    </div>
</div>