<?php

// ตรวจสอบสิทธิ์ของผู้ใช้ และตรวจสอบเมนูที่เรียกใช้
$user_role = $_POST['role']; // แสดงบทบาทของผู้ใช้

switch ($user_role) {
    case 'admin':
        adminMenu(); // เรียกใช้งานเมนูสำหรับ Admin
        break;
    case 'user':
        userMenu(); // เรียกใช้งานเมนูสำหรับ Users
        break;
    case 'caretaker':
        caretakerMenu(); // เรียกใช้งานเมนูสำหรับ Caretaker
        break;
    default:
        echo json_encode(array("message" => "Invalid role specified"));
        break;
}

// เมนูสำหรับผู้ดูแลระบบ (Admin)
function adminMenu() {
    // ทำงานที่เกี่ยวกับเมนูของ Admin ที่ต้องการ
    $menu = [
        [
            "Topic" => "รายการสินทรัพย์",
            "Other_items" => [
                ["Name" => "เพิ่มรายการสินทรัพย์", "Page" => "page1-1.php"],
                ["Name" => "แก้ไขรายการสินทรัพย์", "Page" => "page1-2.php"],
                ["Name" => "ลบรายการสินทรัพย์", "Page" => "page1-3.php"]
            ]
        ],
        [
            "Topic" => "รายการหนี้สิน",
            "Other_items" => [
                ["Name" => "เพิ่มรายการหนี้สิน", "Page" => "page2-1.php"],
                ["Name" => "แก้ไขรายการหนี้สิน", "Page" => "page2-2.php"],
                ["Name" => "ลบรายการหนี้สิน", "Page" => "page2-3.php"]
            ]
        ],
        [
            "Topic" => "รายการอื่นๆ",
            "Other_items" => [
                ["Name" => "จัดการสิทธิ์ผู้ใช้งาน", "Page" => "page3-1.php"],
                ["Name" => "ตั้งค่าระบบ", "Page" => "page3-2.php"]
            ]
        ]
    ];
    
    // ส่งข้อมูลเป็น JSON กลับ
    echo json_encode($menu);
} 



// เมนูสำหรับผู้ใช้ทั่วไป (Users)
function userMenu() {
    // ทำงานที่เกี่ยวกับเมนูของ Users ที่ต้องการ
  // ทำงานที่เกี่ยวกับเมนูของ Admin ที่ต้องการ
  $menu = array(
    "0" => array(
        "Topic" => "รายการสินทรัพย์",
        "Other_items" => array(
            "เพิ่มรายการสินทรัพย์",
            "แก้ไขรายการสินทรัพย์",
            "ลบรายการสินทรัพย์"
        )
    ),
    "1" => array(
        "Topic" => "รายการหนี้สิน",
        "Other_items" => array(
            "เพิ่มรายการหนี้สิน",
            "แก้ไขรายการหนี้สิน",
            "ลบรายการหนี้สิน"
        )
    ),
   
);
echo json_encode($menu);
}


// เมนูสำหรับผู้ดูแลระบบ (Caretaker)
function caretakerMenu() {
    // ทำงานที่เกี่ยวกับเมนูของ Caretaker ที่ต้องการ
  // ทำงานที่เกี่ยวกับเมนูของ Admin ที่ต้องการ
  $menu = array(
    "0" => array(
        "Topic" => "########",
        "Other_items" => array(
            "-",
            "-",
            "-"
        )
    ),
    "1" => array(
        "Topic" => "########",
        "Other_items" => array(
            "-",
            "-",
            "-"
        )
    ),
    "2" => array(
        "Topic" => "########",
        "Other_items" => array(
            "-",
            "-"
        )
    )
);
echo json_encode($menu);
}

?>