<?php
define('TITLE','submitrequest');
define('PAGE','submitrequest');
include('includes/header.php');
include('connect.php');

session_start();
$msg = "";

if(isset($_POST['submitrequest'])){
    // Check for empty fields
    if(empty($_POST['requestinfo']) || empty($_POST['requestdesc']) || empty($_POST['requestername']) || empty($_POST['requesteradd1']) || empty($_POST['requesteradd2']) || empty($_POST['requestercity']) || empty($_POST['requesterstate']) || empty($_POST['requesterzip']) || empty($_POST['requesteremail']) || empty($_POST['requestermobile']) || empty($_POST['requesterdate'])) {
        $msg = "<div class='alert alert-warning col-sm-6 ml-5 mt-2'>Fill All fields</div>";
    } else {
        $rinfo=$_POST['requestinfo'];
        $rdesc=$_POST['requestdesc'];
        $rname=$_POST['requestername'];
        $radd1=$_POST['requesteradd1'];
        $radd2=$_POST['requesteradd2'];
        $rcity=$_POST['requestercity'];
        $rstate=$_POST['requesterstate'];
        $rzip=$_POST['requesterzip'];
        $remail=$_POST['requesteremail'];
        $rmobile=$_POST['requestermobile'];
        $rdate=$_POST['requesterdate'];

        // Insert into database
        $sql= "INSERT INTO submitrequest_tb(request_info,request_desc,requester_name,requester_add1,requester_add2,requester_city,requester_state,requester_zip,requester_email,requester_mobile,request_date) VALUES('$rinfo','$rdesc' ,'$rname','$radd1' ,'$radd2' , '$rcity' ,'$rstate' , '$rzip' ,'$remail' , '$rmobile' , '$rdate')";
        
        if($conn->query($sql) === TRUE){
            $genid = mysqli_insert_id($conn);
            $msg="<div class='alert alert-success col-sm-6 ml-5 mt-2'>Request submitted successfully!</div>";
            $_SESSION['myid'] = $genid;
            header("Location: receipt.php?id=$genid");
            exit(); // Ensure script stops here to prevent further execution
        } else {
            $msg="<div class='alert alert-danger col-sm-6 ml-5 mt-2'>Request not submitted.</div>";
        }

    }
}
?>

<div class="col-sm-9 col-md-10 mt-3"><!--start service request form-->
<?php if (isset($msg)){echo $msg;} ?>
<form class="mx-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <div class="form-group">
        <label for="inputrequestinfo">Request Info</label>
        <input type="text" class="form-control" id="inputrequestinfo" placeholder="Request Info" name="requestinfo">
    </div>

    <div class="form-group">
        <label for="inputrequestdescription">Description</label></label>
        <input type="text" class="form-control" id="inputrequestdescription" placeholder="Write Description" name="requestdesc">
    </div>

    <div class="form-group">
        <label for="inputname">Name</label>
        <input type="text" class="form-control" id="inputname" placeholder="Write Name" name="requestername">
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputaddress">Adress Line 1</label>
            <input type="text" class="form-control" id="inputaddress" placeholder="Write address" name="requesteradd1">
        </div>
        <div class="form-group col-md-6">
            <label for="inputaddress2">Adress Line 2</label>
            <input type="text" class="form-control" id="inputaddress2" placeholder="Write address" name="requesteradd2">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputcity">City</label>
            <input type="text" class="form-control" id="inputcity" placeholder="city" name="requestercity">
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <input type="text" class="form-control" id="inputstate" placeholder="state" name="requesterstate">
        </div>
        <div class="form-group col-md-2">
            <label for="inputzip">Zip</label>
            <input type="text" class="form-control" id="inputzip"  name="requesterzip" onkeypress="isInputNumber(event)">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputemail">Email Id</label>
            <input type="email" class="form-control" id="inputemail" name="requesteremail">
        </div>
        <div class="form-group col-md-2">
            <label for="inputmobile">Mobile No.</label>
            <input type="text" class="form-control" id="inputmobile"  name="requestermobile" onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group col-md-2">
            <label for="inputdate">Date</label>
            <input type="date" class="form-control" id="inputdate"  name="requesterdate">
        </div>
    </div>

    <button type="submit" class="btn btn-primary" name="submitrequest">Submit</button>
    <input type="submit" name="submit" style="display:none;">
    <button type="reset" class="btn btn-secondary">Reset</button>
</form>
</div><!--end service request form-->

<script>
    function isInputNumber(evt){
        var ch=String.fromCharCode(evt.which);
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }
    }
</script>

<?php
include('includes/footer.php');
?>
