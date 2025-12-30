<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $bookingID = $_POST['bookingID'];
    $clientID = $_POST['clientID'];
    $clientName = $_POST['clientName'];
    $course = $_POST['course'];
    $fee = $_POST['fee'];
    $paymentMethod = $_POST['paymentMethod'];
    $paymentCode = $_POST['paymentCode'];
    $bookingDate = $_POST['bookingDate'];

    // First, update the bookings table
    $update = "UPDATE bookings SET booking_status = '2' WHERE booking_id = '$bookingID'";

    if (mysqli_query($con, $update)) {

        // Then, insert into service_payment table
        $insert = "INSERT INTO service_payment (booking_id, client_id, client_name, course, amount, payment_method, payment_code, payment_date) 
                   VALUES ('$bookingID', '$clientID', '$clientName', '$course', '$fee', '$paymentMethod', '$paymentCode', '$bookingDate')";

        if (mysqli_query($con, $insert)) {
            $response['status'] = 1;
            $response['message'] = 'Approved and payment recorded successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Booking updated, but failed to insert into service_payment';
        }

    } else {
        $response['status'] = 0;
        $response['message'] = 'Failed to update booking status';
    }

    echo json_encode($response);
}
?>
