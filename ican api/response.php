<?php 
class Response {

    public function success($result = [], $message, $code) {
        $response = array(
            'status' => true,
            'response' => $result,
            'message' => 'Success'
        );
        http_response_code($code);
        echo json_encode($response);
    }
    
    public function error($message, $code) {
        $response = array(
            'status' => false,
            'response' => 'error',
            'message' => 'fales'
        );
        // http_response_code($code);
        echo json_encode($response);
    }
    

}
?>