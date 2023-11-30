<?php
class database{
    public function __construct()
    {
        try{
            $serverName = 'localhost';
            $userName = 'root';
            $password = '';
            $dbName = 'laundry';
            $this-> pdo = new PDO("mysql:host=$serverName;port=3306;dbname=$dbName",$userName, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo 'Error, dikarenakan ' . $e ->getMessage();
        }
    }

    public function tambah_data($nama, $email, $password, $phone_no){
        $sql = "INSERT INTO users (name, email, password, phone_no) 
        VALUES (:name, :email, :password, :phone_no)";
        $stmt = $this-> pdo-> prepare($sql);
        $stmt->execute(array(
          ':name' => $nama,
          ':email' => $email,
          ':password' => password_hash($password, PASSWORD_DEFAULT),
          ':phone_no' => $phone_no));
        return $stmt;
    }

    public function check_data($email){
        $result = $this -> pdo -> prepare("SELECT email FROM users WHERE email = :email");
        $result -> bindParam(':email', $email);
        $result -> execute();
        return $result -> rowCount();
    }

    public function banyak_data(){
        $result = $this -> pdo -> query("SELECT COUNT(*) FROM users");
        //$result -> execute();
        return $result -> fetchColumn();
    }

    public function banyak_pesanan(){
        $result = $this -> pdo -> query("SELECT COUNT(*) FROM `Order`");
        //$result -> execute();
        return $result -> fetchColumn();
    }

    public function login($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> bindParam(':email', $email);
        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    public function showData(){
        $sql = "SELECT id, name, email, password, phone_no FROM users";
        $stmt = $this -> pdo ->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteData($id){
        $sql = "DELETE FROM users WHERE id = :zip";
        $stmt = $this-> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $id));
        return $stmt;
    }

    public function getData($edit){
        $sql = "SELECT * FROM users WHERE id = :zip";
        $stmt = $this -> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $edit));
        return $stmt -> fetch();
    }

    public function updateData($nama, $email, $password, $phone_no, $id){
        $sql = "UPDATE users SET name=:name, email=:email, password=:password, phone_no=:phone_no WHERE id=:id";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt->execute(array(
            ':name' => $nama,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':phone_no' => $phone_no,
            ':id' => $id));
        return $stmt;
    }

    public function add_order($laundry_type, $item_mass, $item_quantity, $pickup_time, $delivery_time, $address, $note, $total_price, $garis_bujur, $price_total, $status, $id, $unit_list){
        $sql = "INSERT INTO `Order` (laundry_type, item_mass, item_quantity, pickup_time, delivery_time, address, note, total_price, garis_bujur, price_total, order_status, user_id, unit_list)
        VALUES (:laundry_type, :item_mass, :item_quantity, :pickup_time, :delivery_time, :address, :note, :total_price, :garis_bujur, :price_total, :order_status, :user_id, :unit_list)";
        $stmt = $this-> pdo-> prepare($sql);
        $stmt->execute(array(
          ':laundry_type' => $laundry_type,
          ':item_mass' => $item_mass,
          ':item_quantity' => $item_quantity,
          ':pickup_time' => $pickup_time,
          ':delivery_time' => $delivery_time,
          ':address' => $address,
          ':note' => $note,
          ':total_price' => $total_price,
          ':garis_bujur' => $garis_bujur,
          ':price_total' => $price_total,
          ':order_status' => $status,
          ':user_id' => $id,
          ':unit_list' => $unit_list));
        return $stmt;
    }
    
    public function addStaff($name, $email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO staff (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
    }

    public function getprice(){
        $sql = "SELECT * FROM price";
        $stmt = $this -> pdo ->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showorder(){
        $sql = "SELECT id, laundry_type, item_mass, item_quantity, pickup_time, delivery_time, address, note, total_price, garis_bujur, price_total, order_status, user_id, unit_list FROM `Order`";
        $stmt = $this -> pdo -> query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPesanan($name_filter){
        $sql = "SELECT laundry_type, item_mass, item_quantity, pickup_time, delivery_time, address, note, price_total, order_status, user_id FROM `Order` WHERE user_id = :zip";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(array(':zip' => $name_filter));
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetEditorder($edit){
        $sql = "SELECT * FROM users WHERE id = :zip";
        $stmt = $this -> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $edit));
        return $stmt -> fetch();
    }

    public function getOrder($edit){
        $sql = "SELECT * FROM `Order` WHERE id = :zip";
        $stmt = $this -> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $edit));
        return $stmt -> fetch();
    }

    public function updateStatus($status, $id){
        $sql = "UPDATE `Order` SET order_status=:order_status WHERE id=:id";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt->execute(array(
            ':order_status' => $status,
            ':id' => $id));
        return $stmt;
    }
}
?>