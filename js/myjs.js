
// $(document).ready(function() {
//     $('#contactForm').submit(function(e) {
//         e.preventDefault();
//         $.ajax({
//             url: 'submit',
//             type: 'POST',
//             data: $(this).serialize(),
//             dataType: 'json',
//             success: function(response) {
//                 if (response.status === 'success') {
//                     alert('Message submitted successfully!');
//                     $('#contactForm')[0].reset();
//                 } else {
//                     alert(response.message);
//                 }
//             },
//             error: function() {
//                 alert('An error occurred.');
//             }
//         });
//     });
// });

function getsettings(){
    $.ajax({
        type: "POST",
        url: "appcontroller",
        data: {getsettings: 1},
        success: function (response) {
            $('#settingsbd').html(response);
            $('#dtb').DataTable().destroy();
            $('#dtb').DataTable();
        }
    });
}

function getcategory(){
    $.ajax({
        type: "POST",
        url: "reqcontroller",
        data: {getsettings: 1},
        success: function (response) {
            $('#settingsbd').html(response);
            // $('#dtb').DataTable().destroy();
            // $('#dtb').DataTable();
        }
    });
}
