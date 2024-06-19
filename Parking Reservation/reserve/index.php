<?php include('connection.php'); 

session_start();

// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Check if the user is not logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['fname'])) {
    // Redirect to error page
    header('Location: error.php');
    exit;
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    <title>Admin Page</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif !important;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #C9CCD3;
            background-image: linear-gradient(-180deg, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%);
            background-blend-mode: lighten;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.5);
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 30px 40px;
            border-radius: 20px;
            width: 90%;
            height: 90%;
        }
    </style>

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="header-container text-center">
                    <h2>Parking Reservation</h2>
                    <div class="btnAdd">
                    <a href="http://localhost/login-signup/Park.php" class="btn btn-primary">Go to Monitor</a>
                       
                        <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-dark">Add User</a>
                    </div>
                </div>
                <hr>
                    <table id="example" class="table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Vehicle & PlateNum</th>
                        <th>ParkNum</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
                },
                'serverSide': 'true',
                'processing': 'true',
                'paging': 'true',
                'order': [],
                'ajax': {
                    'url': 'fetch_data.php',
                    'type': 'post',
                },
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [5]
                },

                ]
            });
        });
        $(document).on('submit', '#addUser', function(e) {
            e.preventDefault();
            var date = $('#addDateField').val();
            var username = $('#addUserField').val();
            var vehicle = $('#addVehicleField').val();
            var parknum = $('#addParkNumField').val();
            if (date != '' && username != '' && vehicle != '' && parknum != '') {
                $.ajax({
                    url: "add_user.php",
                    type: "post",
                    data: {
                        date: date,
                        username: username,
                        vehicle: vehicle,
                        parknum: parknum
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'true') {
                            mytable = $('#example').DataTable();
                            mytable.draw();
                            $('#addUserModal').modal('hide');
                        } else {
                            alert('failed');
                        }
                    }
                });
            } else {
                alert('Fill all the required fields');
            }
        });
        $(document).on('submit', '#updateUser', function(e) {
            e.preventDefault();
            //var tr = $(this).closest('tr');
            var date = $('#dateField').val();
            var username = $('#nameField').val();
            var vehicle = $('#vehicleField').val();
            var parknum = $('#parknumField').val();
            var trid = $('#trid').val();
            var id = $('#id').val();
            if (date != '' && username != '' && vehicle != '' && parknum != '') {
                $.ajax({
                    url: "update_user.php",
                    type: "post",
                    data: {
                        date: date,
                        username: username,
                        vehicle: vehicle,
                        parknum: parknum,
                        id: id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'true') {
                            table = $('#example').DataTable();
                            var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-secondary btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
                            var row = table.row("[id='" + trid + "']");
                            row.row("[id='" + trid + "']").data([id, username, vehicle, parknum, date, button]);
                            $('#exampleModal').modal('hide');
                        } else {
                            alert('failed');
                        }
                    }
                });
            } else {
                alert('Fill all the required fields');
            }
        });
        $('#example').on('click', '.editbtn ', function(event) {
            var table = $('#example').DataTable();
            var trid = $(this).closest('tr').attr('id');
            // console.log(selectedRow);
            var id = $(this).data('id');
            $('#exampleModal').modal('show');

            $.ajax({
                url: "get_single_data.php",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#nameField').val(json.username);
                    $('#vehicleField').val(json.vehicle);
                    $('#parknumField').val(json.parknum);
                    $('#dateField').val(json.date);
                    $('#id').val(id);
                    $('#trid').val(trid);
                }
            })
        });

        $(document).on('click', '.deleteBtn', function(event) {
            var table = $('#example').DataTable();
            event.preventDefault();
            var id = $(this).data('id');
            if (confirm("Are you sure want to delete this User ? ")) {
                $.ajax({
                    url: "delete_user.php",
                    data: {
                        id: id
                    },
                    type: "post",
                    success: function(data) {
                        var json = JSON.parse(data);
                        status = json.status;
                        if (status == 'success') {
                            $("#" + id).closest('tr').remove();
                        } else {
                            alert('Failed');
                            return;
                        }
                    }
                });
            } else {
                return null;
            }
        })
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateUser">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="trid" id="trid" value="">
                        <div class="mb-3 row">
                            <label for="nameField" class="col-md-3 form-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="nameField" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="vehicleField" class="col-md-3 form-label">Vehicle & PlateNumber</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="vehicleField" name="vehicle">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="parknumField" class="col-md-3 form-label">ParkNum</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="parknumField" name="parknum">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="dateField" class="col-md-3 form-label">Date</label>
                            <div class="col-md-9">
                            <input type="datetime-local" class="form-control" id="dateField" name="date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add user Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUser" action="">
                        <div class="mb-3 row">
                            <label for="addUserField" class="col-md-3 form-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="addUserField" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="addVehicleField" class="col-md-3 form-label">Vehicle & PlateNumber</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="addVehicleField" name="vehicle">
                            </div>
                        </div>
                        <div class="mb-3 row">
    <label for="addParkNumField" class="col-md-3 form-label">ParkNum</label>
    <div class="col-md-9">
        <select class="form-select" id="addParkNumField" name="parknum">
            <optgroup label="Car">
                <option value="Car 1">Car 1</option>
                <option value="Car 2">Car 2</option>
                <option value="Car 3">Car 3</option>
                <option value="Car 4">Car 4</option>
            </optgroup>
            <optgroup label="Motorcycle">
                <option value="Motor 1">Motor 1</option>
                <option value="Motor 2">Motor 2</option>
                <option value="Motor 3">Motor 3</option>
                <option value="Motor 4">Motor 4</option>
                <option value="Motor 5">Motor 5</option>
                <option value="Motor 6">Motor 6</option>
                <option value="Motor 7">Motor 7</option>
                <option value="Motor 8">Motor 8</option>
                <option value="Motor 9">Motor 9</option>
                <option value="Motor 10">Motor 10</option>
                <option value="Motor 11">Motor 11</option>
                <option value="Motor 12">Motor 12</option>
                <option value="Motor 13">Motor 13</option>
                <option value="Motor 14">Motor 14</option>
                <option value="Motor 15">Motor 15</option>
                <option value="Motor 16">Motor 16</option>
                <option value="Motor 17">Motor 17</option>
                <option value="Motor 18">Motor 18</option>
                <option value="Motor 19">Motor 19</option>
                <option value="Motor 20">Motor 20</option>
            </optgroup>
        </select>
    </div>
</div>

                        <div class="mb-3 row">
                            <label for="addDateField" class="col-md-3 form-label">Date</label>
                            <div class="col-md-9">
                            <input type="datetime-local" class="form-control" id="addDateField" name="date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>