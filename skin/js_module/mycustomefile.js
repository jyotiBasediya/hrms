
$(document).ready(function() {


    
});

function setValinactive(id)
	{
		 $('#activeInactive-modal').modal('show');
		 $('#inActive_token').val(id);
	}
function setEmpValinactive(id)
	{
		 $('#activeInactiveEmp-modal').modal('show');
		 $('#inActiveEmp_token').val(id);
	}

function setContractDelete(id)
	{
		 $('#deleteContract-modal').modal('show');
		 $('#deleteContract_token').val(id);
	}
function setContractUpdate(id,name)
{
	$('#updateContract-modal').modal('show');
	$('#updateContract_token').val(id);
	$('#contractUpdate_type').val(name);
}		
function activeBtn()
{
		var id = $('#inActive_token').val();
		var dataString = 'id='+id;

		var url = 'company/activeInactive';
		var errorMsg ="";
		$.ajax({
		type:"POST",
		data:dataString,
		url:url,
		dataType:"json",
		async: false,
		success:function(response) {
			location.reload();

		},
		error: function(error){
		return false;
		}
		});	
	
}

function activeInactiveEmpBtn()
{
	var id = $('#inActiveEmp_token').val();
		var dataString = 'id='+id;

		var url = 'employees/activeInactive';
		var errorMsg ="";
		$.ajax({
		type:"POST",
		data:dataString,
		url:url,
		dataType:"json",
		async: false,
		success:function(response) {
			location.reload();

		},
		error: function(error){
		return false;
		}
		});	
}
function deleteContract()
{
	var id = $('#deleteContract_token').val();
		var dataString = 'id='+id;

		var url = 'contract_type/deleteContrct';
		var errorMsg ="";
		$.ajax({
		type:"POST",
		data:dataString,
		url:url,
		dataType:"json",
		async: false,
		success:function(response) {
			location.reload();

		},
		error: function(error){
		return false;
		}
		});	
}

function updateContract()
{
	var id = $('#updateContract_token').val();
		var dataString = 'id='+id;

		var url = 'contract_type/updateContract';
		var errorMsg ="";
		$.ajax({
		type:"POST",
		data:dataString,
		url:url,
		dataType:"json",
		async: false,
		success:function(response) {
			location.reload();

		},
		error: function(error){
		return false;
		}
		});	
}