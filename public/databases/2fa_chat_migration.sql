-- 2FA Feature
ALTER TABLE usuarios ADD COLUMN secret_2fa VARCHAR(32) DEFAULT NULL;

-- Support Chat Feature
CREATE TABLE mensajes_soporte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Index optimization for chat queries
CREATE INDEX idx_chat_sender ON mensajes_soporte(sender_id);
CREATE INDEX idx_chat_receiver ON mensajes_soporte(receiver_id);
