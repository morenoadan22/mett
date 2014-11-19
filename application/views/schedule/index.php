<!DOCTYPE html>
<html lang="en">
<head><script type="text/javascript" src="/CFIDE/scripts/cfform.js"></script>
<script type="text/javascript" src="/CFIDE/scripts/masks.js"></script>

    <meta charset="utf-8">
    <title>Schedule a Test</title>
	
    

<script type="text/javascript">/* <![CDATA[ */
	if (window.ColdFusion) ColdFusion.required['ItemCode']=true;
/* ]]> */</script>

<script type="text/javascript">/* <![CDATA[ */
	if (window.ColdFusion) ColdFusion.required['ItemName']=true;
/* ]]> */</script>
<script type="text/javascript">
<!--
    _CF_checkmainform = function(_CF_this)
    {
        //reset on submit
        _CF_error_exists = false;
        _CF_error_messages = new Array();
        _CF_error_fields = new Object();
        _CF_FirstErrorField = null;

        //form element ItemCode required check
        if( !_CF_hasValue(_CF_this['ItemCode'], "TEXT", false ) )
        {
            _CF_onError(_CF_this, "ItemCode", _CF_this['ItemCode'].value, "Error in ItemCode text.");
            _CF_error_exists = true;
        }

        //form element ItemName required check
        if( !_CF_hasValue(_CF_this['ItemName'], "TEXT", false ) )
        {
            _CF_onError(_CF_this, "ItemName", _CF_this['ItemName'].value, "Error in ItemName text.");
            _CF_error_exists = true;
        }


        //display error messages and return success
        if( _CF_error_exists )
        {
            if( _CF_error_messages.length > 0 )
            {
                // show alert() message
                _CF_onErrorAlert(_CF_error_messages);
                // set focus to first form error, if the field supports js focus().
                if( _CF_this[_CF_FirstErrorField].type == "text" )
                { _CF_this[_CF_FirstErrorField].focus(); }

            }
            return false;
        }else {
            return true;
        }
    }
//-->
</script>
</head>

<body>
</ul></li></ul></div></div></div>	
			
	
	
	
	
	
	<div class="container" id="content">
		
<fieldset>
<legend>Schedule a Test</legend>


<script type="text/javascript">
function textCounter( field, maxlimit ) {
	var charsleft = maxlimit - field.value.length;	
	if ( charsleft < 0)
	{
	 document.getElementById('charcheck').innerHTML=0;
	 field.value = field.value.substring(0, maxlimit)
	 alert( 'Textarea value can only be 1000 characters in length.' );
	 return false;
	}
	else
	{
	 document.getElementById('charcheck').innerHTML=charsleft;
	 return true;
	}
}

</script>



<div align="left">
<br />

<!--add link below-->
<!--or get rid of it, doesnt matter-->




<form name="mainform" id="mainform" action="register.cfm" method="post">
	
	<table cellpadding=5 style="width:900px; table-layout:auto;">
	
		<tr style="font-weight:bold;">
			<td align="left" valign="bottom" >Test ID</td>
			<td align="left" valign="bottom" >Test Name</td>
			<td align="right" valign="bottom" >Drop-Box <br />Order</td>
			<td align="right" valign="bottom" >Date and<br /> Time</td>
			<td align="right" valign="bottom" >Room <br />Number</td>
			<td align="left" valign="bottom" align="right" style="width:70px;">Status</td>
			<td align="left" valign="bottom" align="right" style="width:50px;">&nbsp;</td>
		</tr>
				
		<tr style="height:100px;">
			<td align="left" valign="top">
				<input name="TestID" id="TestID"  type="text" maxlength="50"  style="width:70px;"  size="40"  />
			</td>
			<td align="left" nowrap valign="top">
				<input name="TestName" id="TestName"  type="text" maxlength="100"  style="width:300px;"  size="20"  />
			</td>	
			<td align="right" nowrap valign="top">
				<input name="DropBox" id="DropBox"  type="text" maxlength="4"  style="width:70px;"  size="2"  />
			</td>
			<td align="right" nowrap valign="top">
				<input name="DateTime" id="DateTime"  type="text" maxlength="10"  style="width:80px;"  size="5"  />
			</td>
			<td align="right" nowrap valign="top">
				<input name="RoomNumber" id="RoomNumber"  type="text" maxlength="4"  style="width:70px;"  size="2"  />
			</td>
			<td align="left" valign="top">
				<select name="ItemAvail" style="width:auto;">
					<option value="1">Active</option>
					<option value="0">Inactive</option>
				</select>
			</td>
		</tr>
		
		<tr style="height:100px;">
			<td align="left" valign="top">
				<input type="submit" value="Submit">
			</td>
		</tr>
		
	</table>
	
	<input type="hidden" name="SourceID" value="508">
	<input type="hidden" name="CSRFtoken" value="D4SAnu7AwO3YxzMqqD68U2eKxY9gTLFUCY5swzcx">

</form>

	
</div>	



<!--what is this for??-->
<script>
$(document).ready(function() { $('input[type=password]').val(''); });
</script>
<!----->

</body>

</html>

