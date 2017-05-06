<?php
    /**
     * Class User untuk melakukan login dan registrasi user baru
     */
    class User
    {
        private $db; //Menyimpan Koneksi database
        private $error; //Menyimpan Error Message

        // Contructor untuk class User, membutuhkan satu parameter yaitu koneksi ke databse
        public function __construct($db_conn)
        {
            $this->db = $db_conn;

            // Mulai session
            session_start();
        }

        //Login user
        public function login($nip, $password)
        {
            try {
                // Ambil data dari database
                $query = $this->db->prepare("SELECT * FROM staf WHERE nip = :nip");
                $query->bindParam(":nip", $nip);
                $query->execute();
                $data = $query->fetch();

                // Jika jumlah baris > 0
                if ($query->rowCount() > 0) {
                    // jika password yang dimasukkan sesuai dengan yg ada di database
                    if ($password == $data['password']) {
                        $_SESSION['user_session'] = $data['nip'];
                        return true;
                    } else {
                        $this->error = "Password Salah";
                        return false;
                    }
                } else {
                    $this->error = "NIP Salah";
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        // Cek apakah user sudah login
        public function isLoggedIn()
        {
            // Apakah user_session sudah ada di session
            if (isset($_SESSION['user_session'])) {
                return true;
            }
        }

        // Ambil data user yang sudah login
        public function getUser()
        {
            // Cek apakah sudah login
            if (!$this->isLoggedIn()) {
                return false;
            }

            try {
                // Ambil data user dari database
                $query = $this->db->prepare("SELECT * FROM staf WHERE nip = :nip");
                $query->bindParam(":nip", $_SESSION['user_session']);
                $query->execute();
                return $query->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        // Logout user
        public function logout()
        {
            // Hapus session
            session_destroy();
            // Hapus user_session
            unset($_SESSION['user_session']);
            return true;
        }

        // Ambil error terakhir yg disimpan di variable error
        public function getLastError()
        {
            return $this->error;
        }
    }
