<?php
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     $store_id = $_GET['store_id']; // รับค่า store_id จากการส่ง request

//     try {
//         // สร้างตัวแปรสำหรับเก็บผลลัพธ์
//         $result = [
//             'pending' => [
//                 'orders' => [],
//                 'count' => 0,
//                 'total_revenue' => 0
//             ],
//             'approved' => [
//                 'orders' => [],
//                 'count' => 0,
//                 'total_revenue' => 0
//             ],
//             'cancel' => [
//                 'orders' => [],
//                 'count' => 0,
//                 'total_revenue' => 0
//             ],
//             // 'shipping_status_counts' => [
//             //     'pending' => 0,
//             //     'shipped' => 0
//             // ],
//             'preparation_status_counts' => [
//                 'awaiting_payment_verification' => 0,
//                 'preparing' => 0,
//                 'shipped' => 0
//             ]
//         ];

//         // กำหนด query สำหรับการดึงข้อมูลแยกตามสถานะ payment_status
//         $statuses = ['pending', 'approved', 'cancel'];
//         foreach ($statuses as $status) {
//             // SQL สำหรับดึงข้อมูลตามสถานะ
//             $sql = "SELECT order_id, order_number, order_date, quantity, total_price, payment_status, shipping_status, preparation_status, line_token
//                     FROM orders 
//                     WHERE store_id = :store_id AND payment_status = :payment_status";
            
//             $stmt = $conn->prepare($sql);
//             $stmt->execute([
//                 ':store_id' => $store_id,
//                 ':payment_status' => $status
//             ]);

//             // เก็บข้อมูลคำสั่งซื้อใน result ตามสถานะ
//             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//                 $result[$status]['orders'][] = $row;
//                 $result[$status]['count']++;
//                 $result[$status]['total_revenue'] += $row['total_price'];

//                 // นับ shipping_status
//                 // if ($row['shipping_status'] === 'pending') {
//                 //     $result['shipping_status_counts']['pending']++;
//                 // } elseif ($row['shipping_status'] === 'shipped') {
//                 //     $result['shipping_status_counts']['shipped']++;
//                 // }

//                 // นับ preparation_status
//                 if ($row['preparation_status'] === 'awaiting_payment_verification') {
//                     $result['preparation_status_counts']['awaiting_payment_verification']++;
//                 } elseif ($row['preparation_status'] === 'preparing') {
//                     $result['preparation_status_counts']['preparing']++;
//                 }elseif ($row['preparation_status'] === 'shipped') {
//                     $result['preparation_status_counts']['shipped']++;
//                 }
//             }
//         }

//         // ส่งข้อมูล response กลับ
//         (new Response())->success($result, 'Data retrieved successfully', 200);
//     } catch (PDOException $e) {
//         (new Response())->error("Failed to retrieve data: " . $e->getMessage(), 500);
//     }
// } else {
//     (new Response())->error("Invalid request method", 405);
// }


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $today = date('Y-m-d');

// เพิ่ม 1 วัน
$tomorrow = date('Y-m-d', strtotime('+1 day'));
    $store_id = $_GET['store_id'];
    // ตั้งค่า $start_date โดยถ้า $_GET['start_date'] ไม่ว่างจะใช้ค่า $_GET['start_date'] มิฉะนั้นใช้ $today
$start_date = !empty($_GET['start_date']) ? $_GET['start_date'] : $today;

// ตั้งค่า $end_date โดยถ้า $_GET['end_date'] ไม่ว่างจะใช้ค่า $_GET['end_date'] มิฉะนั้นใช้ $tomorrow
$end_date = !empty($_GET['end_date']) ? $_GET['end_date'] : $tomorrow;

// ตั้งค่า $filter_status โดยถ้า $_GET['payment_status'] ไม่ว่างจะใช้ค่า $_GET['payment_status'] มิฉะนั้นใช้ null
$filter_status = !empty($_GET['payment_status']) ? $_GET['payment_status'] : null;

    try {
// echo   $start_date; '<br>'; echo   $end_date; 
        // สร้างตัวแปรสำหรับเก็บผลลัพธ์
        $result = [
            'pending' => [
                'orders' => [],
                'count' => 0,
                'total_revenue' => 0
            ],
            'approved' => [
                'orders' => [],
                'count' => 0,
                'total_revenue' => 0
            ],
            'cancel' => [
                'orders' => [],
                'count' => 0,
                'total_revenue' => 0
            ],
            'All_order' => [
                'orders' => [],
                'count' => 0,
                'total_revenue' => 0
            ],
            'preparation_status_counts' => [
                'awaiting_payment_verification' => 0,
                'preparing' => 0,
                'shipped' => 0
            ]
        ];

        // กำหนด query สำหรับการดึงข้อมูลแยกตามสถานะ payment_status
        $statuses = ['pending', 'approved', 'cancel'];
        if ($filter_status && in_array($filter_status, $statuses)) {
            $statuses = [$filter_status];
        }

        foreach ($statuses as $status) {
            $sql = "SELECT order_id, order_number, order_date, quantity, total_price, payment_status, shipping_status, preparation_status,payment_method, line_token
                    FROM orders 
                    WHERE store_id = :store_id AND payment_status = :payment_status";

            // กำหนดเงื่อนไขการเลือกวัน
            if ($start_date && $end_date) {
                if ($start_date === $end_date) {
                    $sql .= " AND order_date = :start_date"; // วันเดียวกัน
                } else {
                    $sql .= " AND order_date BETWEEN :start_date AND DATE_ADD(:end_date, INTERVAL 1 DAY)"; // ช่วงวัน
                }
            }

            $stmt = $conn->prepare($sql);

            $params = [
                ':store_id' => $store_id,
                ':payment_status' => $status
            ];

            if ($start_date && $end_date) {
                $params[':start_date'] = $start_date;
                if ($start_date !== $end_date) {
                    $params[':end_date'] = $end_date;
                }
            }

            $stmt->execute($params);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$status]['orders'][] = $row;
                $result[$status]['count']++;
                $result[$status]['total_revenue'] += $row['total_price'];

                $result['All_order']['orders'][] = $row;
                $result['All_order']['count']++;
                $result['All_order']['total_revenue'] += $row['total_price'];

                if ($row['preparation_status'] === 'awaiting_payment_verification') {
                    $result['preparation_status_counts']['awaiting_payment_verification']++;
                } elseif ($row['preparation_status'] === 'preparing') {
                    $result['preparation_status_counts']['preparing']++;
                } elseif ($row['preparation_status'] === 'shipped') {
                    $result['preparation_status_counts']['shipped']++;
                }
            }
        }

        (new Response())->success($result, 'Data retrieved successfully', 200);
    } catch (PDOException $e) {
        (new Response())->error("Failed to retrieve data: " . $e->getMessage(), 500);
    }
} else {
    (new Response())->error("Invalid request method", 405);
}



?>
