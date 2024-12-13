<?php


// Get email and name from request
$name = $_POST['name'] ?? '';
$token = $_POST['token'] ?? ''; 
$email = $_POST['email'];

if (empty($token) || empty($name)) {
    $response->error('Email or Name is missing', 200);
    exit;
}

// Check if the email already exists in the database
$query = $conn->prepare("SELECT * FROM user_login WHERE email = :email");
$query->bindParam(':email', $email);
$query->execute();

if ($query->rowCount() > 0) {
    // Email already exists, return the existing user data
    $userData = $query->fetch(PDO::FETCH_ASSOC);
    $response->success($userData, 'User already exists', 200);
} else {
    // Email does not exist, insert new user data
    $insert = $conn->prepare("INSERT INTO user_login (name, email, token) VALUES (:name, :email, :token)");
    $insert->bindParam(':name', $name);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':token', $token);

    if ($insert->execute()) {
        // Retrieve the newly inserted data
        $userData = [
            'id' => $conn->lastInsertId(),
            'name' => $name,
            'email' => $email,
            'token' => $token
        ];
        $response->success($userData, 'User created successfully', 201);
    } else {
        $response->error('Failed to create user', 500);
    }
}
?>
