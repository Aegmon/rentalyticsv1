<?php
include('session.php');
if (isset($_GET['tenant_id'])) {
    $tenant_id = $_GET['tenant_id'];


$sql = "SELECT m.tenant_id, o.name, m.message, m.date, m.message_from,o.profile_pic
        FROM message m
        LEFT JOIN tenant o ON m.tenant_id = o.tenant_id
        WHERE m.owner_id = '$id' AND m.tenant_id = '$tenant_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
         <?php if ($row['message_from'] == 'owner') { ?>
    <div class="flex-1 justify-content-end d-flex outgoing-chat mt-20">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">
                                  <?php echo date('h:i a', strtotime($row['date'])); ?></span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray"><?php echo $row['message']; ?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
 

              <?php }else{ ?>
                <div class="flex-1 outgoing-chat">
                      <div class="chat-text-box ">
                        <div class="media d-flex">
                          <div class="chat-text-box__photo ">
                            <img src="../uploads/<?php echo $row['profile_pic']; ?>" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                          
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">
                                <?php echo date('h:i a', strtotime($row['date'])); ?></span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white"><?php echo $row['message']; ?></p>
                                </div>
                              
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                 <?php }?>



        <?php
    }
} else {
    echo "No Message";
}
}

?>

