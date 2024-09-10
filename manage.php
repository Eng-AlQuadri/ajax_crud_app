<?php 

    $page_title = 'Manage';

    include 'init.php';

?>

    <div class="users">
        <div id='edit-message' class="edit-message-overlay">
            <div id='edit-message-con' class="edit-message-content">
                <div class="head">
                    <h3>Add User</h3>
                    <span id='close-insert-user'>x</span>
                </div>
                <div class="form">
                    <form action="">
                        <div>
                            <label>Name:</label>
                            <input type="text" name='name' id='name'>
                        </div>
                        <div>
                            <label>Email:</label>
                            <input type="text" name='email' id='email'>
                        </div>
                        <div>
                            <label>Phone:</label>
                            <input type="text" name='phone' id='phone'>
                        </div>
                        <div>
                            <label>Place:</label>
                            <input type="text" name='place' id='place'>
                        </div>
                        <button class='add-submit'>Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div id='edit-user' class="edit-message-overlay">
            <div id='edit-user-con' class="edit-message-content">
                <div class="head">
                    <h3>Edit User</h3>
                    <span id='close-edit-user'>x</span>
                </div>
                <div class="form">
                    <form action="">
                        <div>
                            <label>Name:</label>
                            <input type="text" name='name' id='editName'>
                        </div>
                        <div>
                            <label>Email:</label>
                            <input type="text" name='email' id='editEmail'>
                        </div>
                        <div>
                            <label>Phone:</label>
                            <input type="text" name='phone' id='editPhone'>
                        </div>
                        <div>
                            <label>Place:</label>
                            <input type="text" name='place' id='editPlace'>
                            <input type="hidden" id="hiddendata">
                        </div>
                        <button class='edit-submit'>Edit</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="container">
            <h2>Manage Users (AJAX)</h2>
            <button class="add-user">Add New User</button>
            <div class="table">

            </div>
        </div>
    </div>

    <script src="./layout/js/jquery.js"></script>
    <script src="./layout/js/main.js"></script>

    <script>

        $(document).ready(function() {

            function displayData() {
                const displayTableData = true;
                $.ajax({
                    url: 'display.php',
                    type: 'POST',
                    data: { displaySend: displayTableData },
                    success: function (data, status) {
                        $('.table').html(data);
                    }
                });
            }

            $('.edit-submit').on('click', function (e) {
                e.preventDefault();
                
                updateDetails();
            });

            function updateDetails() {
                
                let updateName = $('#editName').val();
                let updateEmail = $('#editEmail').val();
                let updatePhone = $('#editPhone').val();
                let updatePlace = $('#editPlace').val();
                let id = $('#hiddendata').val();

                $.ajax({
                    url: 'update.php',
                    type: 'POST',
                    data: {
                        hiddendata: id,
                        editName: updateName,
                        editEmail: updateEmail,
                        editPhone: updatePhone,
                        editPlace: updatePlace
                    },
                    success: function(data,status) {
                        // alert('here');
                        // Close Edit Form
                        $('#edit-user').removeClass('show');
                        $('#edit-user-con').removeClass('show');
                        
                        displayData();
                        
                    }
                });
            }

            

            // Open Insert User Form
            $('.add-user').click(function () {
                $('#edit-message').addClass('show');
                $('#edit-message-con').addClass('show');
            });

            // Close Insert User Form
            $('#close-insert-user').click(function () {
                $('#edit-message').removeClass('show');
                $('#edit-message-con').removeClass('show');
            });

            // Event Delegation for Edit Buttons
            $(document).on('click', '.edit', function() {
                let id = $(this).attr('data-id');
                getDetails(id);
            });

            // Display Data Table
            displayData();

            // Function to Fetch User Details and Show the Edit Form
            function getDetails(id) {

                $('#hiddendata').val(id);

                $.ajax({
                    url: 'update.php',
                    type: 'POST',
                    data: {
                        updateId : id
                    },
                    success: function(data,status) {

                        let userData = JSON.parse(data);
                        
                        console.log('hello');

                        // Add Data In Edit Form

                        $('#editName').val(userData.Name);
                        $('#editEmail').val(userData.Email);
                        $('#editPhone').val(userData.Phone);
                        $('#editPlace').val(userData.Place);
                    }
                });

                $('#edit-user').addClass('show');
                $('#edit-user-con').addClass('show');
                
            }

            // Close Edit Form
            $('#close-edit-user').click(function () {
                $('#edit-user').removeClass('show');
                $('#edit-user-con').removeClass('show');
            });

            

            // Delete User
            $(document).on('click', '.delete', function() {
                let id = $(this).attr('data-id');
                deleteUser(id);
            });

            function deleteUser(id) {
                $.ajax({
                    url: 'deleteUser.php',
                    type: 'POST',
                    data: { deleteUserID: id },
                    success: function (data, status) {
                        displayData();
                    }
                });
            }
        });


    </script>

    
</body>

</html>