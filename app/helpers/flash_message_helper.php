<?php

function setRedirectFlashMessage($type, $title, $text, $redirectUrl) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'title' => $title,
        'text' => $text,
        'redirect' => $redirectUrl
    ];
}

function setFlashMessage($type, $title, $text) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'title' => $title,
        'text' => $text
    ];
    unset($_SESSION['flash_message']['redirect']);
}

function displayFlashMessage() {
    if (isset($_SESSION['flash_message']) && !isset($_SESSION['flash_message']['redirect'])) {
        $message = $_SESSION['flash_message'];
        $swalConfig = json_encode([
            'icon' => $message['type'],
            'title' => $message['title'],
            'text' => $message['text'],
            'width' => '400px',
            'confirmButtonColor' => '#2F4858',
            'customClass' => [
                'popup' => 'swal-custom-popup',
                'title' => 'swal-custom-title',
                'confirmButton' => 'swal-custom-confirm-button'
            ]
        ]);

        echo "<script>
            document.addEventListener('DOMContentLoaded', () => Swal.fire($swalConfig));
        </script>";

        unset($_SESSION['flash_message']);
    }
}

function displayRedirectingFlashMessage() {
    if (isset($_SESSION['flash_message']) && isset($_SESSION['flash_message']['redirect'])) {
        $message = $_SESSION['flash_message'];
        $swalConfig = json_encode([
            'icon' => $message['type'],
            'title' => $message['title'],
            'text' => $message['text'],
            'width' => '400px',
            'confirmButtonColor' => '#2F4858',
            'customClass' => [
                'popup' => 'swal-custom-popup',
                'title' => 'swal-custom-title',
                'confirmButton' => 'swal-custom-confirm-button'
            ]
        ]);

        echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire($swalConfig).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{$message['redirect']}';
                    }
                });
            });
        </script>";
        
        unset($_SESSION['flash_message']);
    }
}