<?php

$this->load->view('header'); 
$this->load->view('sidebar'); 
echo "this is a login script";
?>

<script>
function chkForm ()
{
	chkEmail();
	chkPassword();
}
	
function chkEmail(){
	//testing regular expressio
	var a = $("#email").val();
	var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
	//if it's valid email
	if(filter.test(a))
	{
		$('#tube').animate({ width: 'show' });
		return false;
	}
	else
	{
		
		$('#tube').animate({ width: 'hide' });
		return false;	
	}		
}

function chkPassword()
{
	var pass1 = $("#password");
	
	if(pass1.val().length < 5){
		$('#tube2').animate({ width: 'hide' });
		return false;
	}
	else
	{
		$('#tube2').animate({ width: 'show' });
	}

}
</script>
<?php

$this->load->view('footer'); 

?>