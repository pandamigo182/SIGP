<?php
session_start();

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered');
// DISPLAY IN VIEW - echo flash('register_success');
function flash($name = '', $message = '', $class = 'alert alert-success alert-dismissible fade show'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name. '_class'])){
                unset($_SESSION[$name. '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        } elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : 'primary';
            $msg = $_SESSION[$name];
            
            // Clean strings for JS
            $msg = addslashes($msg);
            
            // Check for specific fatal error to use SweetAlert
            if($name == 'fatal_error'){
                 echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error del Sistema',
                            text: '$msg',
                            footer: 'El administrador ha sido notificado.'
                        });
                    });
                  </script>";
            } elseif($name == 'welcome_msg') {
                 echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true
                        });
                        Toast.fire({
                          icon: 'success',
                          title: '$msg'
                        });
                    });
                  </script>";
            } elseif($name == 'logout_msg') {
                 echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'info',
                            title: '¡Hasta luego!',
                            text: '$msg',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    });
                  </script>";
            } else {
                // Toast for others
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if(typeof showToast === 'function'){
                                showToast('$msg', '$class');
                            }
                        });
                      </script>";
            }
            
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}

function redirect($page){
    header('location: ' . URLROOT . '/' . $page);
    exit;
}

function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}
