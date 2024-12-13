<?php


try {


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // รับข้อมูลจาก Request
        $address_name = $_POST['address_name'] ?? null;
        $address_phone = $_POST['address_phone'] ?? null;
        $address_full = $_POST['address_full'] ?? null;
        $address_road = $_POST['address_road'] ?? null;
        $address_province = $_POST['address_province'] ?? null;
        $address_district = $_POST['address_district'] ?? null;
        $address_subdistrict = $_POST['address_subdistrict'] ?? null;
        $address_code = $_POST['address_code'] ?? null;
        $id_user = $_POST['id_user'] ?? null;

        if ($address_name && $address_phone && $address_full && $address_road && $address_province && $address_district && $address_subdistrict && $address_code && $id_user) {
            // สร้างคำสั่ง SQL เพื่อ Insert ข้อมูล
            $sql = "INSERT INTO user_address (address_name, address_phon, address_full, address_road, address_province, address_district, address_subdistrict, address_code, id_user) 
                    VALUES (:address_name, :address_phone, :address_full, :address_road, :address_province, :address_district, :address_subdistrict, :address_code, :id_user)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':address_name', $address_name);
            $stmt->bindParam(':address_phone', $address_phone);
            $stmt->bindParam(':address_full', $address_full);
            $stmt->bindParam(':address_road', $address_road);
            $stmt->bindParam(':address_province', $address_province);
            $stmt->bindParam(':address_district', $address_district);
            $stmt->bindParam(':address_subdistrict', $address_subdistrict);
            $stmt->bindParam(':address_code', $address_code);
            $stmt->bindParam(':id_user', $id_user);

            // Execute and check if insert was successful
            if ($stmt->execute()) {
        
                $response->success([], 'Address added successfully.', 200);
            } else {
        
                $response->error('Failed to add address.', 500);
            }
        } else {
    
            $response->error('Missing required parameters.', 400);
        }
    } else {

        $response->error('Invalid request method.', 405);
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
