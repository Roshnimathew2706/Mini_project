<?php 
                if ($view_order == false){
                    // Kosong
                }
                else{
            ?>
                    <h2 class="center">View Data</h2>
                    
                        <p>ID User : <?php echo $userId; ?></li><br>
                        laundry_type : <?php echo $laundry_type; ?></li><br>
                        List Satuan : <?php echo $listSatuan; ?></li><br>
                        item_mass : <?php echo $item_mass; ?></li><br>
                        Item quantity : <?php echo $item_quantity; ?></li><br>
                        pickup date : <?php echo $pickup_time; ?></li><br>
                        Delivery date : <?php echo $delivery_time; ?></li><br>
                        Address : <?php echo $address; ?></li><br>
                        Note : <?php echo $note; ?></li><br>
                        price Total : <?php echo $priceTotal; ?><br>
                        
                        <form method="post">
                        <h2>Order Status:<br></h2>
<input type="radio" id="waiting_confirmation" name="status" value="Waiting for Confirmation" checked>
<label for="waiting_confirmation">Waiting for Confirmation</label><br>
<input type="radio" id="courier_pickup" name="status" value="Courier picks up laundry">
<label for="courier_pickup">Courier picks up laundry</label><br>
<input type="radio" id="being_washed" name="status" value="Currently being washed">
<label for="being_washed">Currently being washed</label><br>
<input type="radio" id="courier_delivery" name="status" value="Courier delivers laundry">
<label for="courier_delivery">Courier delivers laundry</label><br>

<input type="radio" id="completed" name="status" value="Completed">
<label for="completed">Completed</label>
                    <p>
                    <?php
                }
                    ?>
                <?php 
                    if($view_order == false){
                        //Kosong
                    } 
                    else{ ?>
                        <p class="center">
                            <input type="submit" name="update_order" value="Update"/>
                            <input type="submit" name="cancel_update" value="Cancel"/>
                        </p>
                    </form>
                <?php
                    } 
                ?>
        </div>
    </div>