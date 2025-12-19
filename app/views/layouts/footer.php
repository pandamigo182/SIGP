    </div>

    <!-- Footer -->
    <?php $sys = get_system_settings(); ?>
    <footer class="site-footer mt-auto w-100">
        <div class="container">
            <div class="row mb-3">
                <!-- Col 1: Brand -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="d-flex flex-column mb-2">
                    <div class="d-flex flex-column mb-2">
                        <img src="<?php echo URLROOT; ?>/img/logo-completo.svg" alt="SIGP" height="80" class="me-2 p-1">
                    </div>
                    </div>
                    <p class="small text-muted mb-0">
                        SIGP - Sistema Integral de Gestión de Pasantías
                    </p>
                </div>

                <!-- Col 2: Quick Links / Modules -->
                <div class="col-md-4 mb-3 mb-md-0">
                     <h5 class="fw-bold mb-3 border-bottom border-primary pb-2 d-inline-block footer-title">
                        Módulos
                    </h5>
                    <ul class="list-unstyled">
                        <?php if(isset($_SESSION['user_role'])): ?>
                            <!-- Validar Rol -->
                            <?php if($_SESSION['user_role'] == 1): // Admin ?>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin/users" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Usuarios</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin/empresas" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Empresas</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin/logs" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Bitácora</a></li>
                            <?php elseif($_SESSION['user_role'] == 2): // Empresa ?>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/dashboard" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/plazas/manage" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Mis Plazas</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/usuarios/postulaciones_recibidas" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Candidatos</a></li>
                            <?php elseif($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5): // Estudiante ?>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/dashboard" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/plazas" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Pasantías</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/postulaciones/mis_postulaciones" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Mis Postulaciones</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/users/profile" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Hoja de Vida</a></li>
                            <?php else: ?>
                                <!-- Default Authenticated -->
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/dashboard" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- Guest -->
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Inicio</a></li>
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>/plazas" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Pasantías</a></li>
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>/auth/login" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Iniciar Sesión</a></li>
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>/auth/register" class="footer-link"><i class="fas fa-angle-right me-2 text-primary"></i>Registrarse</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Col 3: Contact -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 border-bottom border-primary pb-2 d-inline-block footer-title">Contacto</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2 d-flex"><i class="fas fa-map-marker-alt mt-1 me-3 text-primary"></i> <span>San Salvador, El Salvador</span></li>
                        <li class="mb-2 d-flex"><i class="fas fa-envelope mt-1 me-3 text-primary"></i> <span>contacto@sigp.sv</span></li>
                        <li class="mb-2 d-flex"><i class="fas fa-phone-alt mt-1 me-3 text-primary"></i> <span>+503 2222-0000</span></li>
                        <li class="mb-2 d-flex"><i class="fab fa-whatsapp mt-1 me-3 text-success"></i> <span>50370000000</span></li>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary opacity-25">

            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                     <p class="mb-0 small text-muted">© <?php echo date('Y'); ?> SIGP Solutions - Todos los Derechos Reservados.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer" style="z-index: 1100;"></div>

    <!-- Global Loader Overlay -->
    <div id="loader-overlay">
        <div class="spinner-custom mb-3"></div>
        <h5 class="fw-bold text-primary">Cargando...</h5>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/theme-toggle.js"></script>
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>

    <?php if(isset($_SESSION['user_id'])): ?>
    <!-- Chat Widget -->
    <div id="chat-widget-container" class="position-fixed bottom-0 end-0 mb-4 me-4" style="z-index: 1050;">
        <button id="chat-toggle-btn" class="btn btn-primary rounded-circle shadow-lg p-3" style="width: 60px; height: 60px;">
            <i class="fas fa-comment-dots fa-lg"></i>
        </button>
    </div>

    <div id="chat-window" class="card shadow-lg position-fixed bottom-0 end-0 mb-5 me-5 d-none" style="width: 320px; height: 400px; z-index: 1060; border-radius: 15px;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-3">
            <h6 class="mb-0 fw-bold"><i class="fas fa-headset me-2"></i>Soporte</h6>
            <button type="button" class="btn-close btn-close-white btn-sm" id="chat-close-btn"></button>
        </div>
        <div class="card-body p-3 overflow-auto bg-light" id="chat-messages" style="height: 290px;">
            <!-- Messages will be loaded here -->
            <div class="text-center text-muted small mt-5">
                <i class="fas fa-spinner fa-spin fa-2x"></i><br>Cargando...
            </div>
        </div>
        <div class="card-footer bg-white p-2">
            <div class="input-group">
                <input type="text" id="chat-input" class="form-control border-0" placeholder="Escribe tu mensaje..." autocomplete="off">
                <button class="btn btn-primary" id="chat-send-btn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatToggleBtn = document.getElementById('chat-toggle-btn');
            const chatCloseBtn = document.getElementById('chat-close-btn');
            const chatWindow = document.getElementById('chat-window');
            const chatMessages = document.getElementById('chat-messages');
            const chatInput = document.getElementById('chat-input');
            const chatSendBtn = document.getElementById('chat-send-btn');
            let isChatOpen = false;
            let pollingInterval;

            // Toggle Chat
            chatToggleBtn.addEventListener('click', () => {
                chatWindow.classList.remove('d-none');
                isChatOpen = true;
                scrollToBottom();
                loadMessages();
                pollingInterval = setInterval(loadMessages, 5000); // Poll every 5s
            });

            chatCloseBtn.addEventListener('click', () => {
                chatWindow.classList.add('d-none');
                isChatOpen = false;
                clearInterval(pollingInterval);
            });

            // Send Message
            function sendMessage() {
                const msg = chatInput.value.trim();
                if(!msg) return;

                // Optimistic UI Append
                appendMessage(msg, false, true); // msg, isAdmin, isSelf
                chatInput.value = '';
                scrollToBottom();

                fetch('<?php echo URLROOT; ?>/chat/send_message', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: msg })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status !== 'success') {
                        // Handle Error (maybe remove message or show alert)
                        console.error('Failed to send');
                    }
                    loadMessages(); // Refresh to get correct timestamp/id
                })
                .catch(err => console.error(err));
            }

            chatSendBtn.addEventListener('click', sendMessage);
            chatInput.addEventListener('keypress', (e) => {
                if(e.key === 'Enter') sendMessage();
            });

            // Load Messages
            function loadMessages() {
                if(!isChatOpen) return;

                fetch('<?php echo URLROOT; ?>/chat/get_messages')
                .then(res => res.json())
                .then(data => {
                    chatMessages.innerHTML = '';
                    if(data.length === 0) {
                         chatMessages.innerHTML = '<div class="text-center text-muted small mt-4">Empieza a chatear con soporte.</div>';
                         return;
                    }
                    
                    data.forEach(msg => {
                        // Determine if message is from Self (User) or Admin
                        // In DB: is_admin_reply = 0 (User), 1 (Admin)
                        // If we are User: 0 is Self, 1 is Other.
                        const isSelf = (msg.is_admin_reply == 0);
                        appendMessage(msg.message, !isSelf, isSelf);
                    });
                    scrollToBottom();
                })
                .catch(err => {
                    console.error(err);
                    // Don't clear innerHTML on error to keep history visible
                });
            }

            function appendMessage(text, isAdmin, isSelf) {
                const div = document.createElement('div');
                div.className = `d-flex mb-2 ${isSelf ? 'justify-content-end' : 'justify-content-start'}`;
                
                const bubble = document.createElement('div');
                bubble.className = `p-2 px-3 rounded-3 shadow-sm ${isSelf ? 'bg-primary text-white' : 'bg-white text-dark border'}`;
                bubble.style.maxWidth = '80%';
                bubble.style.fontSize = '0.9rem';
                bubble.textContent = text;
                
                div.appendChild(bubble);
                chatMessages.appendChild(div);
            }

            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
    <?php endif; ?>

    <script>
        function showToast(message, type = 'primary') {
            // Map Bootstrap Alert classes to Toast types if needed
            if(type.includes('alert-danger')) type = 'danger';
            else if(type.includes('alert-success')) type = 'success';
            else if(type.includes('alert-warning')) type = 'warning';
            else if(type.includes('alert-info')) type = 'info';
            
            // Icon Mapping
            let icon = 'fa-info-circle';
            if(type === 'success') icon = 'fa-check-circle';
            if(type === 'danger') icon = 'fa-exclamation-circle';
            if(type === 'warning') icon = 'fa-exclamation-triangle';

            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();
            
            // Create Toast HTML
            const toastHtml = `
                <div id="${toastId}" class="toast align-items-center text-white bg-${type} border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body d-flex align-items-center">
                            <i class="fas ${icon} fa-lg me-3"></i>
                            <div>${message}</div>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            
            // Append to container
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            
            // Initialize and Show
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, { delay: 5000 });
            toast.show();
            
            // Cleanup after hidden
            toastElement.addEventListener('hidden.bs.toast', () => {
                toastElement.remove();
            });
        }
    </script>
</body>
</html>
