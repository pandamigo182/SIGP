<?php
class Settings {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getSettings(){
        $this->db->query("SELECT * FROM configuracion LIMIT 1");
        return $this->db->single();
    }

    public function updateSettings($data){
        $this->db->query('UPDATE configuracion SET 
            nombre_sistema = :nombre_sistema,
            nombre_empresa = :nombre_empresa,
            direccion = :direccion,
            email = :email,
            telefono = :telefono,
            whatsapp = :whatsapp,
            facebook = :facebook,
            instagram = :instagram,
            twitter = :twitter,
            linkedin = :linkedin,
            map_embed_url = :map_embed_url,
            email_alertas = :email_alertas,
            email_smtp_host = :email_smtp_host,
            email_smtp_user = :email_smtp_user,
            email_smtp_pass = :email_smtp_pass,
            email_smtp_port = :email_smtp_port,
            logo_path = :logo_path,
            favicon_path = :favicon_path
            WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre_sistema', $data['nombre_sistema']);
        $this->db->bind(':nombre_empresa', $data['nombre_empresa']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':whatsapp', $data['whatsapp']);
        $this->db->bind(':facebook', $data['facebook']);
        $this->db->bind(':instagram', $data['instagram']);
        $this->db->bind(':twitter', $data['twitter']);
        $this->db->bind(':linkedin', $data['linkedin']);
        $this->db->bind(':map_embed_url', $data['map_embed_url']);
        $this->db->bind(':email_alertas', $data['email_alertas']);
        $this->db->bind(':email_smtp_host', $data['email_smtp_host']);
        $this->db->bind(':email_smtp_user', $data['email_smtp_user']);
        $this->db->bind(':email_smtp_pass', $data['email_smtp_pass']);
        $this->db->bind(':email_smtp_port', $data['email_smtp_port']);
        $this->db->bind(':logo_path', $data['logo_path']);
        $this->db->bind(':favicon_path', $data['favicon_path']);

        return $this->db->execute();
    }
}
