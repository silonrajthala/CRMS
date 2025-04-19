$(document).ready(function() {
    getData();
});


function getData()
{
    $('#datatables-reponsive').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/user",
        columns: [
            { "data": "username" },
            { "data": "email" },
            { "data": "mobilenumber" },
            { "data": "typename" },
            { "data": "action" },
        ],
    });
}

$(document).off('click','#addData',function(){});
$(document).on('click','#addData',function(e){
    e.preventDefault();
    $('#formModal').modal('show');
    $('.form').attr('id','dataForm');
    $('#dataForm')[0].reset();
    $('#btnSubmit').show();
    $('#btnUpdate').hide();
})


$(document).off('submit','#dataForm',function(){});
$(document).on('submit','#dataForm',function(e){
    e.preventDefault();
    let dataurl=$('#dataForm').attr('action');
    let postdata=new FormData(this);
    
    var request = ajaxRequest(dataurl,postdata,'POST',true);
		request.done(function (res) {
			if(res.status ===true)
            {
                showNotification(res.message,'success');
                $('#formModal').modal('hide');
                $('#dataForm')[0].reset();
                $('#datatables-reponsive').dataTable().fnClearTable();
                $('#datatables-reponsive').dataTable().fnDestroy();
                getData();

			}else
            {
                showNotification(res.message,'error')
			}
		});
})

$(document).off('click','.editData',function(){});
$(document).on('click','.editData',function(e){
    e.preventDefault();
    let id=$(this).attr('data-pid');
    let dataurl=$(this).attr('data-url');
    var request = getRequest(dataurl);
		request.done(function (res) {
            if(res.status===true)
            {
                $('#btnSubmit').hide();
                $('#btnUpdate').show();
                $('.form').attr('id','updatedataForm');
                $('#formModal').modal('show');
                $('#fname').val(res.response.fname);
                $('#lname').val(res.response.lname);
                $('#usertype').val(res.response.usertype);
                $('#mobilenumber').val(res.response.mobilenumber);
                $('#email').val(res.response.email);
                $('#id').val(res.response.id);

            }
            else
            {
                showNotification(res.message,'error')

            }
			
		});
})

$(document).off('submit','#updatedataForm',function(){});
$(document).on('submit','#updatedataForm',function(e){
    e.preventDefault();
    let id=$('#id').val();
    let dataurl='user/'+id;
    let postdata=new FormData(this);
    postdata.append('_method','PATCH');

    var request = ajaxRequest(dataurl,postdata,'POST',true);
		request.done(function (res) {
			if(res.status ===true)
            {
                 showNotification(res.message,'success');
                 $('#formModal').modal('hide');
                 $('#updatedataForm')[0].reset();
                 $('#datatables-reponsive').dataTable().fnClearTable();
                 $('#datatables-reponsive').dataTable().fnDestroy();
                 getData();

			}else
            {
                showNotification(res.message,'error')
			}
		});
})

$(document).off('click','.deleteData',function(){});
$(document).on('click','.deleteData',function(e){
    e.preventDefault();
    let currbtn=$(this);
    let dataurl=currbtn.attr('data-url');
    var request = ajaxRequest(dataurl,{},'DELETE');
		request.done(function (res) {
            if(res.status===true)
            {
             //   currbtn.closest("tr").remove();
                showNotification(res.message,'success')
                $('#datatables-reponsive').dataTable().fnClearTable();
                $('#datatables-reponsive').dataTable().fnDestroy();
                getData();

            }
            else
            {
                showNotification(res.message,'error')

            }
			
		});
})

function readURL(input) {
    if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                        $('#imagereader').attr('src', e.target.result);
                        $('.imagediv').removeClass('d-none');
                }
                reader.readAsDataURL(input.files[0]);
    }
}
    $(document).on('change',"#userimage",function(){
        readURL(this);
    });