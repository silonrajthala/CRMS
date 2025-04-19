<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $form_title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="dataForm" class="form" method="POST"  action="{{ route('user.store') }}">
            <div class="modal-body m-3">
            <input type="hidden"  id="id" name="id"  />

               <div class="row">
                 <div class="form-group">
                    <label>User Type <sup class="text-danger">*</sup></label>
                    <select class="form-control" id="usertype" name="usertype">
                       <option value="-1">Please Select</option>
                       @foreach($usertype as $li)
                       <option value="{{$li->id}}">{{$li->typename}}</option>
                       @endforeach
                    </select>
                 </div>
               </div>

               <div class="row">
                 <div class="form-group">
                    <label>First Name <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" />
                 </div>
               </div>
               <div class="row">
                 <div class="form-group">
                    <label>Last Name <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" />
                 </div>
               </div>
               <div class="row">
                 <div class="form-group">
                    <label>Email <sup class="text-danger">*</sup></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" />
                 </div>
               </div>
               <div class="row">
                 <div class="form-group">
                    <label>Mobilenumber <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Enter Mobile Number" />
                 </div>
               </div>
               <div class="row">
                 <div class="form-group">
                    <label>Password <sup class="text-danger">*</sup></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" />
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