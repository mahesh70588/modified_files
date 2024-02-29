<?php
define('TITLE','Receipt');
define('PAGE','receipt');
include('includes/header.php');
include('connect.php');

session_start();
$msg = "";

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql= "SELECT * FROM submitrequest_tb WHERE request_id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        $msg="<div class='alert alert-danger col-sm-6 ml-5 mt-2'>No Data Found</div>";
    }
} else {
    $msg="<div class='alert alert-danger col-sm-6 ml-5 mt-2'>Invalid Request</div>";
}
?>

<div class="col-sm-6 mt-5">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Request ID</td>
                <td><?php echo $row['request_id'];?></td>
            </tr>
            <tr>
                <td>Request Info</td>
                <td><?php echo $row['request_info'];?></td>
            </tr>
            <tr>
                <td>Request Description</td>
                <td><?php echo $row['request_desc'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $row['requester_name'];?></td>
            </tr>
            <tr>
                <td>Address Line 1</td>
                <td><?php echo $row['requester_add1'];?></td>
            </tr>
            <tr>
                <td>Address Line 2</td>
                <td><?php echo $row['requester_add2'];?></td>
            </tr>
            <tr>
                <td>City</td>
                <td><?php echo $row['requester_city'];?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo $row['requester_state'];?></td>
            </tr>
            <tr>
                <td>Zip</td>
                <td><?php echo $row['requester_zip'];?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $row['requester_email'];?></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td><?php echo $row['requester_mobile'];?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><?php echo $row['request_date'];?></td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <button onclick="printHTML()" class="btn btn-primary">Print Receipt</button>
    </div>
</div>

<script>
function printHTML() {
    var content = document.documentElement.innerHTML;
    var newWindow = window.open();
    newWindow.document.open();
    newWindow.document.write('<html><head><title>Print Receipt</title></head><body>');
    newWindow.document.write(content);
    newWindow.document.write('</body></html>');
    newWindow.document.close();
    newWindow.print();
    newWindow.close();
}
</script>

<?php
include('includes/footer.php');
?>
