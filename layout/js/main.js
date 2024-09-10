$(function () {

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

    function displayData() {

        const displayTableData = true;

        $.ajax({
            url: 'display.php',
            type: 'POST',
            data: {
                displaySend: displayTableData
            },
            success: function (data, status) {
                $('.table').html(data);
            }
        })
    }



    // Add User To Database
    $('.add-submit').on('click', function (e) {

        e.preventDefault();

        // Get User Data

        let userName = $('#name').val();
        let userEmail = $('#email').val();
        let userPhone = $('#phone').val();
        let userPlace = $('#place').val();

        $.ajax({
            url: 'insert.php',
            type: 'POST',
            data: {
                name: userName,
                email: userEmail,
                phone: userPhone,
                place: userPlace
            },
            success: function (data, status) {
                // console.log(status);
                displayData();
            }
        })
    });




    function deleteUser(id) {

        $.ajax({
            url: 'deleteUser.php',
            type: 'POST',
            data: {
                deleteUserID: id
            },
            success: function (data, status) {
                displayData();
            }
        })
    }



    // Display Table On Screen
    displayData();

});