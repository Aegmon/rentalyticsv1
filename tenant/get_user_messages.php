<?php
include('session.php');
if (isset($_GET['owner_id'])) {
    $owner_id = $_GET['owner_id'];

?>
 <?php

$sql = "SELECT m.owner_id, o.name, m.message, m.date, m.message_from FROM message m
        LEFT JOIN owner o ON m.owner_id = o.owner_id
        WHERE m.tenant_id = '$id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $message_from = ($row['message_from'] == 'tenant') ? "outgoing-chat" : "incoming-chat";
        ?>
        <div class="flex-1 <?php echo $message_from; ?>">
            <div class="chat-text-box">
                <div class="media d-flex">
                    <?php if ($message_from == 'incoming-chat') { ?>
                        <div class="chat-text-box__photo">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                        </div>
                    <?php } ?>
                    <div class="media-body">
                        <div class="chat-text-box__content">
                            <?php if ($message_from == 'outgoing-chat') { ?>
                                <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                    <span class="chat-text-box__time fs-12 color-light fw-400"><?php echo date('H:i a', strtotime($row['date'])); ?></span>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="chat-text-box__subtitle p-20 bg-deep" style="min-width: 150px; max-width: 70%; word-wrap: break-word;">
                                        <p class="color-gray"><?php echo $row['message']; ?></p>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="chat-text-box__title d-flex align-items-center">
                                    <h6 class="fs-14"><?php echo $row['name']; ?></h6>
                                    <span class="chat-text-box__time fs-12 color-light fw-400 ms-15"><?php echo date('H:i a', strtotime($row['date'])); ?></span>
                                </div>
                                <div class="d-flex align-items-center mb-20 mt-10">
                                    <div class="chat-text-box__subtitle p-20 bg-primary" style="min-width: 150px; max-width: 70%; word-wrap: break-word;">
                                        <p class="color-white"><?php echo $row['message']; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "No Message";
}}

?>

